<?php

namespace App\Http\Livewire\Admin\Settings\Permissions;

use App\Models\Permissions\Permission;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use WireUi\Traits\Actions;

class IndexPermission extends Component
{
    use Actions;

    public $permission;

    public $permission_id;
    public $subPermissions = [];
    public $historyPermission = [];
    public string $name = '';

    protected $rules = [
        'name' => 'required|string',
    ];

    public $listeners = [
        'refreshComponent' => '$refresh',
        'permissionEdit' => 'edit',
    ];

    public function render()
    {
        return view('livewire.admin.permissions.index-permission', [
            'permissions' => Permission::whereNull('permission_id')->get(),
        ]);
    }

    public function updatedPermissionId($value)
    {
        $permission = $this->getPermission($value);

        if ($permission) {
            $this->mountCategories($permission->permission_id ?? 0, $permission->id, $permission->permissions);
        } else {
            $this->reset();
        }
    }

    public function mountCategories($parentId, $childId, $collect, $add = true)
    {
        if (array_key_exists($parentId, $this->historyPermission)) {
            $newParentId = $this->historyPermission[$parentId];
            unset($this->historyPermission[$parentId]);

            if (array_key_exists($newParentId, $this->subPermissions)) {
                unset($this->subPermissions[$newParentId]);
            }

            if ($add) {
                $this->historyPermission[$parentId] = $childId;

                if ($collect->count()) {
                    $this->subPermissions[$childId] = $collect;
                }
            }

            $this->mountCategories($newParentId, $childId, $collect, false);
        } else {
            if ($add) {
                $this->historyPermission[$parentId] = $childId;
            }

            if ($collect && $collect->count()) {
                $this->subPermissions[$childId] = $collect;
            }
        }
    }

    private function getPermission($permissionId)
    {
        return Permission::find($permissionId);
    }

    public function edit($permissionId)
    {
        $this->permission = $this->getPermission($permissionId);

        if ($this->permission) {
            $this->name = $this->permission->name;
        }
    }

    public function confirmDelete($permissionId)
    {
        $this->dialog()->confirm([
            'title' => 'Exluir Permissão',
            'description' => 'Você tem certeza que deseja excluir?',
            'acceptLabel' => 'Sim, pode excluir',
            'method' => 'delete',
            'params' => $permissionId,
        ]);
    }

    public function delete($permissionId)
    {
        $permission = $this->getPermission($permissionId);

        if ($permission) {
            if ($permission->permissions->count()) {
                $type = 'error';
                $message = 'A permissão não pode ser exluída no momento!';
            } else {
                $permission->delete();
                $type = 'success';
                $message = 'Permissão excluída com sucesso!';
            }

            $this->notification([
                'title'       => getErrorLabelTypeNotification($this),
                'description' => $message,
                'icon'        => $type
            ]);
        }
    }

    public function cancelar()
    {
        $this->reset('permission', 'name');
    }

    public function getPermissionAttribute()
    {
        return $this->permission;
    }

    private function mountSlug(?int $permissionId, array $slug): mixed
    {
        if (is_null($permissionId)) {
            return Str::slug($this->name);
        }

        $permission = Permission::find($permissionId);

        if ($permission) {
            $slug[] = Str::slug($permission->name);

            if ($permission->parent) {
                $this->mountSlug($permission->parent->id, $slug);
            }
        }

        $slug[] = Str::slug($this->name);

        return implode('-', $slug);
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            if (data_get($this->permission, 'id')) {
                $this->permission->name = $this->name;
                $this->permission->slug = $this->mountSlug($this->permission_id, []);
                $this->permission->save();

                $message = 'Alterada com sucesso!';
            } else {
                Permission::create([
                    'name' => $this->name,
                    'slug' => $this->mountSlug($this->permission_id, []),
                    'permission_id' => $this->permission_id,
                ]);

                $message = 'Cadastrada com sucesso!';
            }

            DB::commit();

            $this->reset();

            $this->notification([
                'title'       => getErrorLabelTypeNotification('success'),
                'description' => $message,
                'icon'        => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            $this->notification([
                'title'       => getErrorLabelTypeNotification('error'),
                'description' => 'Erro ao tentar cadastrar a permissão!'.$e->getMessage(),
                'icon'        => 'error'
            ]);
        }

        $this->dispatchBrowserEvent('notification');
        $this->emitSelf('refreshComponent');
    }

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '6xl';
    }
}
