<?php

namespace App\Http\Livewire\Panel\ListMeis;

use App\Models\Meis\Mei;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Exportable;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use WireUi\Traits\Actions;


final class ListMeis extends PowerGridComponent
{
    use ActionButton;
    use WithExport;
    use ActionButton, Actions;

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
            //Responsive::make()
        ];
    }


    public function datasource(): Builder
    {
        return Mei::query();
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


    public function relationSearch(): array
    {
        return [];
    }


    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            //->addColumn('id')
            ->addColumn('id')
            ->addColumn('mei_cnpj')

           /** Example of custom column using a closure **/
            ->addColumn('mei_cnpj_lower', fn (Mei $model) => strtolower(e($model->mei_cnpj)))

            ->addColumn('mei_nome')
            ->addColumn('mei_email')
            ->addColumn('mei_telefone')
            ->addColumn('mei_entregue')
            ->addColumn('mei_cep')
            ->addColumn('mei_lastupdate_formatted', fn (Mei $model) => Carbon::parse($model->mei_lastupdate)->format('d/m/Y H:i:s'))
            ->addColumn('mei_situacao')
            ->addColumn('mei_status')
            ->addColumn('mei_ano')
            ->addColumn('mei_endereco')
            ->addColumn('mei_numero')
            ->addColumn('mei_complemento')
            ->addColumn('mei_bairro')
            ->addColumn('mei_cidade')
            ->addColumn('mei_uf')
            ->addColumn('mei_cnae')
            ->addColumn('mei_cnae_desc')
            ->addColumn('created_at_formatted', fn (Mei $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }



    public function columns(): array
    {
        return [
            //Column::make('Id', 'id'),
            Column::make('Mei cnpj', 'mei_cnpj')
                ->sortable()
                ->searchable(),

            Column::make('Mei nome', 'mei_nome')
                ->sortable()
                ->searchable(),

            Column::make('Mei email', 'mei_email')
                ->sortable()
                ->searchable(),

            Column::make('Mei entregue', 'mei_entregue'),
        
            Column::make('Mei situacao', 'mei_situacao')
                ->sortable()
                ->searchable(),

            Column::make('Mei status', 'mei_status'),
            Column::make('Mei ano', 'mei_ano'),
        
            Column::make('Mei uf', 'mei_uf')
                ->sortable()
                ->searchable(),
        ];
    }


    public function filters(): array
    {
        return [
            Filter::inputText('mei_cnpj')->operators(['contains']),
            Filter::inputText('mei_nome')->operators(['contains']),
            Filter::inputText('mei_situacao')->operators(['contains']),
            Filter::inputText('mei_endereco')->operators(['contains']),
            Filter::inputText('mei_uf')->operators(['contains']),
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
                ->openModal('panel.list-meis.mei-form', ['mei' => 'id','isEdit' => true,]),
                
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
        $model = Mei::find($id);

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
