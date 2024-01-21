<?php

namespace App\Http\Livewire\Admin\RolePermissions;

use App\Models\Permissions\Permission;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class SubRolePermission extends Component
{
    use Actions;

    public $role;
    public $permissions;
    public $permission_ids = [];

    public $level; // = "&nbsp;&nbsp;&nbsp;&nbsp;&rsaquo;&rsaquo;";

    protected $listeners = [
        'checkParent',
        'uncheckPermissions',
        'refreshComponent' => '$refresh',
    ];

    public function mount()
    {
        $this->mountPermissionIds();
    }

    public function render()
    {
        return view('livewire.admin.role-permissions.sub-role-permission');
    }

    public function mountPermissionIds()
    {
        if ($this->role && $this->role->permissions) {
            $this->reset('permission_ids');
            foreach ($this->role->permissions as $permission) {
                $this->permission_ids[$permission->id] = $permission->id;
            }
        }
    }

    public function checkParent($id, array $permission)
    {
        if (count($permission)) {
            foreach ($permission as $value) {
                if (!array_key_exists($value, $this->permission_ids)) {
                    $this->permission_ids[$value] = $value;
                }
            }
        }

        if (!array_key_exists($id, $this->permission_ids)) {
            $this->permission_ids[$id] = $id;
        }

        $permission = Permission::find($id);

        if ($permission->parent) {
            $this->emitUp('checkParent', $permission->parent->id, $this->permission_ids);
        } else {
            $this->emit('updatePermissionIds', $this->permission_ids);
        }
    }
    
    public function uncheckPermissions($id, array $permissions)
    {
        if (count($permissions)) {
            foreach ($permissions as $item) {                
                if (array_key_exists(data_get($item, 'id'), $this->permission_ids)) {
                    unset($this->permission_ids[data_get($item, 'id')]);
                }
            }
        }

        if (array_key_exists($id, $this->permission_ids)) {
            unset($this->permission_ids[$id]);
        }

        $permission = Permission::find($id);

        if ($permission->parent) {
            $this->emitUp('uncheckPermissions', $id, $permissions);
        }

        $this->emit('updatePermissionIds', $this->permission_ids);
    }

    public function edit($permissionId)
    {
        $this->emitUp('permissionEdit', $permissionId);
    }

    public function setPermission($value)
    {
        $permission = Permission::find($value);

        if (!array_key_exists($value, $this->permission_ids)) {
            $this->permission_ids = array_merge($this->permission_ids, [$value => $value]);

            if ($permission->parent) {
                $this->emitUp('checkParent', $permission->parent->id, $this->permission_ids);
            }
        } else {
            unset($this->permission_ids[$value]);

            if ($permission->permissions->count()) {
                foreach ($permission->permissions as $uncheckPermission) {
                    if (array_key_exists($uncheckPermission->id, $this->permission_ids)) {
                        unset($this->permission_ids[$uncheckPermission->id]);
                    }
                }

                $this->emitUp('uncheckPermissions', $value, $permission->permissions);                
            }
        }        
    }

}
