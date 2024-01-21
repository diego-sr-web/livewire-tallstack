<?php

namespace App\Http\Livewire;

use App\Models\MailTransactionalTemplates\MailTransactionalTemplate;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use WireUi\Traits\Actions;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class ListMailTransactional extends PowerGridComponent
{
    use WithExport;
    use ActionButton, actions;
    
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
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
                'editMail',
            ]
        );
    }

    
    public function datasource(): Builder
    {
        return MailTransactionalTemplate::query();
    }

    
    public function relationSearch(): array
    {
        return [];
    }

    
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('title')
            ->addColumn('preheader')
            ->addColumn('subject')
            ->addColumn('status', function (MailTransactionalTemplate $model) {
                return $model->status == 1 ? '<span class="text-green-400 pl-4">Sim</span>' : '<span class="text-red-600 pl-4">Não</span>';})
            ->addColumn('created_at_formatted', fn (MailTransactionalTemplate $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    
    public function columns(): array
    {
        return [

            Column::make('Nome', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Titulo', 'title')
                ->sortable()
                ->searchable(),

            Column::make('Assunto', 'subject')
                ->sortable()
                ->searchable(),

            Column::make('Texto de Apoio', 'preheader')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),
        ];
    }

    
    public function filters(): array
    {
        return [
            Filter::inputText('name')->operators(['contains']),
            Filter::inputText('preheader')->operators(['contains']),
            Filter::inputText('subject')->operators(['contains']),
            Filter::boolean('status'),
            Filter::datetimepicker('created_at'),
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
        ->emit('editMail', ['id' => 'id']),

        Button::add('delete')
        ->caption(
            '
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ffffff" viewBox="0 0 256 256"><path d="M216,48H180V36A28,28,0,0,0,152,8H104A28,28,0,0,0,76,36V48H40a12,12,0,0,0,0,24h4V208a20,20,0,0,0,20,20H192a20,20,0,0,0,20-20V72h4a12,12,0,0,0,0-24ZM100,36a4,4,0,0,1,4-4h48a4,4,0,0,1,4,4V48H100Zm88,168H68V72H188ZM116,104v64a12,12,0,0,1-24,0V104a12,12,0,0,1,24,0Zm48,0v64a12,12,0,0,1-24,0V104a12,12,0,0,1,24,0Z"></path></svg>
            '
        )
        ->tooltip('Deletar')
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

    public function editMail($id)
    {
        try {
            return redirect()->route('mail-transactional.edit', $id);                   
        } catch (\Exception $e) {
            $this->dialog()->error(
                $title = 'Erro !!!',
                $description = 'Erro ao abrir a pagina de editar.'
            );
        }
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
    
        $model = MailTransactionalTemplate::find($id);

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
