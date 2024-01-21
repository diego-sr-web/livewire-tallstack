<?php

namespace App\Http\Livewire\Admin\Settings\Companies\Company;

use App\Actions as CompanyActions;
use App\Models\Companies\Company;
use App\Models\Contacts\ContactType;
use App\Models\Documents\DocumentType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Form extends ModalComponent
{
    use Actions;

    public $company;
    public string $name;
    public string $email;
    public string $phone_number;
    public string $fantasy_name;
    public string $site;

    public $address;
    public string $zip_code;
    public string $street;
    public string $number;
    public $complement;
    public string $neighborhood;
    public string $city;
    public string $state;

    public array $document = [];
    public array $contact = [];

    public $documentTypes;
    public $contactTypes;

    public $password;
    public $confirm_password;

    public $rules = [
        'name' => 'required|string',
        'email' => 'required|string',
        'fantasy_name' => 'required|string',
        'site' => 'required|string',
        'zip_code' => 'required',
        'street' => 'required|string',
        'number' => 'required',
        'neighborhood' => 'required',
        'city' => 'required|string',
        'state' => 'required|string',
    ];

    public function mount(Company $company = null)
    {
        $this->company = $company;

        $this->documentTypes = DocumentType::query()
            ->where('type', 'COM')
            ->where('active', 1)
            ->get();

        $this->contactTypes = ContactType::query()
            ->where('active', 1)
            ->get();

        foreach ($this->documentTypes as $documentType) {
            switch ($documentType->name) {
                case "cpf":
                    $this->rules['document.cpf'] = 'required|cpf';
                    break;
                case "cnpj":
                    $this->rules['document.cnpj'] = 'required|cnpj';
                    break;
                default:
                    if ($documentType->required)
                        $this->rules['document.' . $documentType->name] = 'required';
                    break;
            }
        }

        foreach ($this->contactTypes as $contactType) {
            switch ($contactType->name) {
                case "email":
                    $this->rules['contact.email'] = 'required|email';
                    break;
                default:
                    if ($contactType->required)
                        $this->rules['contact.' . $contactType->name] = 'required';
                    break;
            }
        }

        if (data_get($this->company, 'id')) {
            $this->name = $this->company->name;
            $this->email = $this->company->profile->user->email;
            $this->fantasy_name = $this->company->fantasy_name;
            $this->site = $this->company->site;

            if ($this->company->contacts->count()) {
                foreach ($this->company->contacts as $contact) {
                    $this->contact[$contact->contactType->name] = formatPhone($contact->contactType->name, $contact->contact);
                }
            }

            if ($this->company->documents->count()) {
                foreach ($this->company->documents as $document) {
                    $this->document[$document->documentType->name] = formatCnpjCpf($document->documentType->name, $document->document);
                }
            }

            $this->address = $this->company->addresses->first();
            // dd($this->address);

            $this->zip_code = $this->address->zip_code;
            $this->street = $this->address->street;
            $this->number = $this->address->number;
            $this->complement = $this->address->complement;
            $this->neighborhood = (string) $this->address->neighborhood;
            $this->city = $this->address->city;
            $this->state = $this->address->state;
        }
    }

    public function render()
    {
        return view('livewire.admin.companies.company.form');
    }

    public function updated($fieldName)
    {
        $this->validateOnly($fieldName);
    }

    public function updatedZipCode($value)
    {
        if(preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $value)) {
            $response = Http::get("https://viacep.com.br/ws/{$value}/json/")->json();

            if (!data_get($response, 'erro')) {
                $this->zip_code = data_get($response, 'cep');
                $this->street = data_get($response, 'logradouro');
                $this->neighborhood = data_get($response, 'bairro');
                $this->city = data_get($response, 'localidade');
                $this->state = data_get($response, 'uf');
            }
        }
    }

    public function save()
    {
        // dd($this);
        $this->validate();

        try {
            DB::beginTransaction();

            if (data_get($this->company, 'id')) {
                CompanyActions\Companies\CompanyUpdate::run($this, $this->company);
                CompanyActions\Users\UserUpdate::run($this, $this->company);
                CompanyActions\Addresses\AddressUpdate::run($this, $this->address);

                foreach ($this->company->documents as $document)
                    $document->delete();

                CompanyActions\Documents\DocumentStore::run($this, $this->company);

                foreach ($this->company->contacts as $contact)
                    $contact->delete();

                CompanyActions\Contacts\ContactStore::run($this, $this->company);

                $message = 'Cadastrado com sucesso!';
            } else {
                $company = CompanyActions\Companies\CompanyStore::run($this);
                CompanyActions\Users\UserStore::run($this, $company);
                CompanyActions\Addresses\AddressStore::run($this, $company);
                CompanyActions\Documents\DocumentStore::run($this, $company);
                CompanyActions\Contacts\ContactStore::run($this, $company);

                $message = 'Atualizado com sucesso!';
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

        $this->emit('notification', 'success', $message);
        $this->dispatchBrowserEvent('notification');
        $this->emit('refreshComponent');
        $this->closeModal();
    }

}
