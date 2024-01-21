<?php

namespace App\Http\Livewire\Admin\RolePermissions;

use App\Models\Permissions\Permission;
use App\Models\Permissions\Role;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class IndexRolePermission extends Component
{
    use Actions;

    public array $permission_ids = [];

    public $role;

    public $listeners = [
        'refreshPermissions',
        'updatePermissionIds',
    ];

    public function render()
    {
        $this->mountPermissions();

        return view('livewire.admin.role-permissions.index-role-permission', [
            'permissions' => Permission::whereNull('permission_id')->where('global', 1)->get(),
            'roles' => Role::where('company_id', companyId())->get(),
        ]);
    }

    public function mountPermissions(): void
    {
        if ($this->role) {
            foreach ($this->role->permissions as $permission) {
                $this->permission_ids[$permission->id] = $permission->id;
            }
        }
    }

    public function refreshPermissions($permission_ids): void
    {
        $this->permission_ids = $permission_ids;
    }

    public function updatePermissionIds($permissionIds): void
    {
        $this->permission_ids = $permissionIds;

        $this->skipRender();
    }

    public function setRole($roleId): void
    {
        $this->role = Role::find($roleId);

        $this->mountPermissions();
    }

    public function cancel(): void
    {
        $this->reset('role');
    }

    public function save(): void
    {
        try {
            DB::beginTransaction();

            $role = Role::findOrFail($this->role->id);
            $role->permissions()->sync($this->permission_ids);

            DB::commit();

            // $this->mountPermissions();

            $this->notification([
                'title' => getErrorLabelTypeNotification('success'),
                'description' => 'Permissões salvas com sucesso!',
                'icon' => 'success',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->notification([
                'title' => getErrorLabelTypeNotification('error'),
                'description' => 'Houve um erro, entre em contato com o administrador!',
                'icon' => 'error',
            ]);
        }

        $this->skipRender();
    }
}
