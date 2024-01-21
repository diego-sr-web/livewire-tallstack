<?php

namespace App\Http\Livewire\Admin\Collaborators\Collaborator;

use App\Actions as CollaboratorActions;
use App\Models\Collaborators\Collaborator;
use App\Models\Contacts\ContactType;
use App\Models\Documents\DocumentType;
use App\Models\Permissions\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Form extends ModalComponent
{
    use Actions;

    public $collaborator;
    public string $name;
    public string $email;
    public string $phone_number;
    public int $is_admin = 0;
    public int $role;

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
    public $password_confirmation;

    public $rules = [
        'name' => 'required|string',
        'email' => 'required|string',
        'zip_code' => 'required',
        'street' => 'required|string',
        'number' => 'required',
        'neighborhood' => 'required',
        'city' => 'required|string',
        'state' => 'required|string',
    ];

    public function mount(Collaborator $collaborator = null)
    {
        $this->collaborator = $collaborator;

        $this->documentTypes = DocumentType::query()
            ->where('type', 'COL')
            ->where('active', 1)
            ->get();

        $this->contactTypes = ContactType::query()
            ->where('active', 1)
            ->get();

        foreach ($this->documentTypes as $documentType) {
            switch ($documentType->name) {
                case 'cpf':
                    $this->rules['document.cpf'] = 'required|cpf';
                    break;
                case 'cnpj':
                    $this->rules['document.cnpj'] = 'required|cnpj';
                    break;
                default:
                    if ($documentType->required) {
                        $this->rules['document.'.$documentType->name] = 'required';
                    }
                    break;
            }
        }

        foreach ($this->contactTypes as $contactType) {
            switch ($contactType->name) {
                case 'email':
                    $this->rules['contact.email'] = 'required|email';
                    break;
                default:
                    if ($contactType->required) {
                        $this->rules['contact.'.$contactType->name] = 'required';
                    }
                    break;
            }
        }

        if (data_get($this->collaborator, 'id')) {
            $this->name = $this->collaborator->name;
            $this->email = $this->collaborator->profile->user->email;
            $this->is_admin = $this->collaborator->profile->user->is_admin;
            $this->role = $this->collaborator->profile->role_id;

            if ($this->collaborator->contacts->count()) {
                foreach ($this->collaborator->contacts as $contact) {
                    $this->contact[$contact->contactType->name] = formatPhone($contact->contactType->name, $contact->contact);
                }
            }

            if ($this->collaborator->documents->count()) {
                foreach ($this->collaborator->documents as $document) {
                    $this->document[$document->documentType->name] = formatCnpjCpf($document->documentType->name, $document->document);
                }
            }

            $this->address = $this->collaborator->addresses->first();

            if ($this->address) {
                $this->zip_code = $this->address->zip_code;
                $this->street = $this->address->street;
                $this->number = $this->address->number;
                $this->complement = $this->address->complement;
                $this->neighborhood = (string) $this->address->neighborhood;
                $this->city = $this->address->city;
                $this->state = $this->address->state;
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.collaborators.collaborator.form', [
            'roles' => Role::where('company_id', companyId())->get(),
        ]);
    }

    public function updated($fieldName)
    {
        $this->validateOnly($fieldName);
    }

    public function updatedZipCode($value)
    {
        if (preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $value)) {
            $response = Http::get("https://viacep.com.br/ws/{$value}/json/")->json();

            if (! data_get($response, 'erro')) {
                $this->zip_code = data_get($response, 'cep');
                $this->street = data_get($response, 'logradouro');
                $this->neighborhood = data_get($response, 'bairro');
                $this->city = data_get($response, 'localidade');
                $this->state = data_get($response, 'uf');
            }
        }
    }

    public function updatedRole($value)
    {
        $role = Role::find($value);

        $this->is_admin = $role->is_admin;
    }

    public function save()
    {
        if (!data_get($this->collaborator, 'id')) {
            $this->rules['password'] = 'required';
            $this->rules['password_confirmation'] = 'required|same:password';
        }

        $this->validate();

        try {
            DB::beginTransaction();

            $notificationType = 'success';
            $message = 'Erro ao tentar cadastrar, contacte com o administrador!';

            if (data_get($this->collaborator, 'id')) {
                CollaboratorActions\Collaborators\CollaboratorUpdate::run($this, $this->collaborator);
                CollaboratorActions\Users\UserUpdate::run($this, $this->collaborator);
                CollaboratorActions\Addresses\AddressUpdate::run($this, $this->address);

                foreach ($this->collaborator->documents as $document) {
                    $document->delete();
                }
                CollaboratorActions\Documents\DocumentStore::run($this, $this->collaborator);

                foreach ($this->collaborator->contacts as $contact) {
                    $contact->delete();
                }
                CollaboratorActions\Contacts\ContactStore::run($this, $this->collaborator);

                $message = 'Atualizado com sucesso!';
            } else {
                $collaborator = CollaboratorActions\Collaborators\CollaboratorStore::run($this);
                CollaboratorActions\Users\UserStore::run($this, $collaborator);
                CollaboratorActions\Addresses\AddressStore::run($this, $collaborator);
                CollaboratorActions\Documents\DocumentStore::run($this, $collaborator);
                CollaboratorActions\Contacts\ContactStore::run($this, $collaborator);

                $message = 'Cadastrado com sucesso!';
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            // dd(
            //     $this,
            //     $e
            // );
            $notificationType = 'error';
        }

        $this->emit('notification', $notificationType, $message);
        $this->dispatchBrowserEvent('notification');
        $this->emit('refreshComponent');
        $this->closeModal();
    }
}
