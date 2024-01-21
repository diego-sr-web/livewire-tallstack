<?php

namespace App\Http\Livewire\Panel\Machines\Machine;

use App\Models\Machines\MachineLog;
use App\Models\Machines\Machine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class Form extends ModalComponent
{
    use WithFileUploads, Actions;

    public $machine;
    public bool $isEditing = false;
    public ?string $name;
    public ?string $description;
    public bool $status = false;
    public bool $delete = false;
    public $file;

    protected $rules = [
        'name' => 'required|string',
        'file' => 'required|image|mimes:gif,jpg,png,jpeg|max:2048',
    ];

    protected $message = [
        'name.required' => 'O nome da máquina é obrigatório.',
        'file.required' => 'A imagem da capa é obrigatória.',
        'file.image' => 'O arquivo deve ser uma imagem.',
        'file.max' => 'O tamanho máximo do arquivo é 2048 KB.',
    ];

    public function mount(Machine $machine, bool $delete = false)
    {
        if (data_get($machine, 'id')) {
            $this->name = $machine->name;
            $this->status = $machine->status;
            $this->description = $machine->description;

            $this->isEditing = true;
        }

        $this->delete = $delete;
    }

    public function render()
    {
        return view('livewire.panel.machines.machine.form');
    }

    public function save()
    {
        if ($this->machine) {
            unset($this->rules['file']);
        }

        $this->validate();

        $imageName = '';
        $log = [
            'rel_id' => user()->profile->relation->id,
            'rel_type' => user()->profile->relation::class,
        ];

        try {
            DB::beginTransaction();

            if ($this->machine) {
                $this->machine = Machine::findOrFail($this->machine);

                $log['log'] = json_encode($this->prepareToArray($this->machine->toArray()));

                $imageName = $this->machine->file;
            }

            if (is_object($this->file)) {
                if (Storage::disk('public')->exists($imageName)) {
                    Storage::disk('public')->delete($imageName);
                }

                $imageName = $this->file->store("images", 'public');
            }

            $data = [
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'file' => $imageName,
                'company_id' => companyId(),
                'status' => $this->status,
            ];

            if (data_get($this->machine, 'id')) {
                $this->machine->update($data);
                $this->machine->save();

                $log['machine_id'] = $this->machine->id;
                $log['action'] = 'U';

                $message = 'atualizada';
            } else {
                $machine = Machine::create($data);

                $log['machine_id'] = $machine->id;
                $message = 'cadastrada';
            }

            MachineLog::create($log);

            DB::commit();

            $this->notification([
                'title'       => 'Sucesso!',
                'description' => "A nova máquina de vendas foi {$message} com sucesso!",
                'icon'        => 'success'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            $this->notification([
                'title'       => 'Sucesso!',
                'description' => "Houve um erro ao {$message} a maquina!",
                'icon'        => 'success'
            ]);
        }

        $this->emit('refreshMachines');
        $this->closeModal();
    }

    public function prepareToArray($data)
    {
        if (array_key_exists('file', $data))
            unset($data['file']);

        if (array_key_exists('created_at', $data))
            unset($data['created_at']);

        if (array_key_exists('updated_at', $data))
            unset($data['updated_at']);

        if (array_key_exists('description', $data))
            unset($data['description']);

        if (array_key_exists('slug', $data))
            unset($data['slug']);

        if (array_key_exists('company_id', $data))
            unset($data['company_id']);

        return $data;
    }

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
