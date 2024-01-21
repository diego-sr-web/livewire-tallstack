<?php

namespace App\Http\Livewire\Admin\Roles\Role;

use App\Models\Permissions\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Form extends ModalComponent
{
    use Actions;

    public $role;
    public string $name;
    public bool $active;
    public int $is_admin = 0;

    public $rules = [
        'name' => 'required|string',
    ];

    public function mount(Role $role = null)
    {
        if (data_get($role, 'id')) {
            $this->role = $role;
            $this->name = $role->name;
            $this->active = $role->active;
            $this->is_admin = (int)$role->is_admin;
        }
    }

    public function render()
    {
        return view('livewire.admin.roles.role.form');
    }

    public function updated($fieldName)
    {
        $this->validateOnly($fieldName);
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $notificationType = 'success';
            $notificationTitle = 'Sucesso!';

            $data = [
                'company_id' => companyId(),
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'active' => $this->active,
                'is_admin' => $this->is_admin,
            ];

            if (data_get($this->role, 'id')) {
                $this->role->update($data);
                
                $message = 'Atualizado com sucesso!';
            } else {
                Role::create($data);

                $message = 'Cadastrado com sucesso!';
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            $notificationType = 'error';
            $notificationTitle = 'Erro!';
            $message = 'Erro ao tentar cadastrar, contacte com o administrador!';
        }

        $this->notification([
            'title'       => $notificationTitle,
            'description' => $message,
            'icon'        => $notificationType
        ]);
        
        $this->emit('refreshComponent');
        $this->closeModal();
    }
}
