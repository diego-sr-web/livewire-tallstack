<?php

namespace App\Http\Livewire\Admin\Settings\Permissions;

use App\Models\Permissions\Permission;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class SubPermission extends Component
{
    use Actions;

    public $permissions;

    public $level; // = "&nbsp;&nbsp;&nbsp;&nbsp;&rsaquo;&rsaquo;";

    public function render()
    {
        return view('livewire.admin.permissions.sub-permission');
    }

    public function edit($permissionId)
    {
        $this->emitUp('permissionEdit', $permissionId);
    }

    public function confirmDelete($permissionId)
    {
        try {
            DB::beginTransaction();

            $permission = Permission::findOrFail($permissionId);

            $this->dialog()->confirm([
                'title' => "Exluir Permissão [{$permission->name}]",
                'description' => 'Você tem certeza que deseja excluir?',
                'acceptLabel' => 'Sim, pode excluir',
                'method' => 'delete',
                'params' => $permission,
            ]);

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();

            $this->notification([
                'title' => getErrorLabelTypeNotification('error'),
                'description' => 'Houve um erro ao excluir a permissão!',
                'icon' => 'error',
            ]);
        }

        $this->skipRender();
    }

    public function delete(Permission $permission)
    {
        if ($permission->permissions->count()) {
            $type = 'error';
            $message = 'A permissão não pode ser exluída no momento!';
        } else {
            $permission->delete();
            $type = 'success';
            $message = 'Permissão excluída com sucesso!';
        }

        $this->notification([
            'title' => getErrorLabelTypeNotification($type),
            'description' => $message,
            'icon' => $type,
        ]);

        $this->emit('refreshComponent');
        $this->skipRender();
    }
}
