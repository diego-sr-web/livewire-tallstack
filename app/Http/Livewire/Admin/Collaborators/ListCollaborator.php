<?php

namespace App\Http\Livewire\Admin\Collaborators;

use App\Models\Collaborators\Collaborator as Collaborator;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use WireUi\Traits\Actions;

final class ListCollaborator extends PowerGridComponent
{
    use ActionButton, Actions;

    public function setUp(): array
    {
        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'refreshComponent' => '$refresh',
                'confirmDelete',
            ]
        );
    }

    public function datasource(): Builder
    {
        return Collaborator::query();
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('email', function ($model) {
                return $model->profile->user->email;
            })
            ->addColumn('role', function ($model) {
                return $model->profile->role->name;
            })
            ->addColumn('status', function (Collaborator $model) {
                return CollaboratorStatus($model->status, false);
            });
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('Colaborador', 'name')
                ->searchable()
                ->sortable(),

            Column::make('E-mail', 'email')
                ->searchable()
                ->sortable(),

            Column::make('Papel', 'role')
                ->searchable()
                ->sortable(),

            Column::make('Status', 'status')
                ->searchable()
                ->sortable(),
        ];
    }

    public function actions(): array
    {
        return [
            Button::make('edit', 'Editar')
                ->caption(
                    '
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 dark:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    '
                )
                ->tooltip('Editar')
                ->class(
                    '
                        inline-block px-4 py-2 mr-1 font-bold text-center text-white align-middle ease-soft-in
                        transition-all rounded-lg cursor-pointer bg-gray-500 leading-pro text-xs tracking-tight-soft
                        shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs
                    '
                )
                ->openModal('admin.collaborators.collaborator.form', ['collaborator' => 'id']),

            Button::add('delete')
                ->caption(
                    '
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ffffff" viewBox="0 0 256 256"><path d="M216,48H180V36A28,28,0,0,0,152,8H104A28,28,0,0,0,76,36V48H40a12,12,0,0,0,0,24h4V208a20,20,0,0,0,20,20H192a20,20,0,0,0,20-20V72h4a12,12,0,0,0,0-24ZM100,36a4,4,0,0,1,4-4h48a4,4,0,0,1,4,4V48H100Zm88,168H68V72H188ZM116,104v64a12,12,0,0,1-24,0V104a12,12,0,0,1,24,0Zm48,0v64a12,12,0,0,1-24,0V104a12,12,0,0,1,24,0Z"></path></svg>
                    '
                )
                ->class(
                    '
                        inline-block px-4 py-2 mr-1 font-bold text-center text-white align-middle ease-soft-in
                        transition-all rounded-lg cursor-pointer bg-red-500 leading-pro text-xs tracking-tight-soft
                        shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs
                    '
                )
                ->emit('confirmDelete', ['id' => 'id']),
        ];
    }

    public function confirmDelete($param): void
    {         
        $this->dialog()->confirm([
            'title' => 'Você tem certeza?',
            'description' => 'Deseja realmente excluir este registro?',
            'acceptLabel' => 'Sim, pode excluir',
            'method' => 'deleteConfirmation',
            'params' => data_get($param, 'id')
        ]);
    }

    public function deleteConfirmation($id): void
    {
        $model = Collaborator::find($id);

        if ($model && $model->delete()) {
            $this->deleteConfirmed();
        } else {
            $this->deleteError();
        }
    }

    public function deleteConfirmed(): void
    {
        $this->dialog()->success(
            $title = 'Deletado',
            $description = 'O registro foi deletado com sucesso',
        );
    }

    public function deleteError(): void
    {
        $this->dialog()->error(
            $title = 'Erro !!!',
            $description = 'Erro, não foi possível excluir o seu registro'
        );
    }
}
