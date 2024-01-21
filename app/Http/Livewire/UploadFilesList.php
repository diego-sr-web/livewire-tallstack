<?php

namespace App\Http\Livewire;

use App\Models\UploadFiles\Uploadfiles;
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
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use WireUi\Traits\Actions;


final class UploadFilesList extends PowerGridComponent
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
        ];
    }

    public function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'refreshComponent' => '$refresh',
                'confirmDelete',
                'copyImage',
            ]
        );
    }


    public function datasource(): Builder
    {
        return UploadFiles::query();
    }


    public function relationSearch(): array
    {
        return [];
    }

   
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('user_id')
            ->addColumn('company_id')
            ->addColumn('thumb_file', function (Uploadfiles $model) {
        switch ($model->thumb_file) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
            case 'gif':
            case 'webp':
                return "<img src='" . asset("storage/{$model->file}") . "' class='w-auto h-10'>";
            
            case 'mp4':
            case 'avi':
            case 'mkv':
            case 'wmv':
                return "<p class='text-sm w-14 h-10 bg-indigo-500 rounded-lg p-2 pt-3 shadow-md text-white text-center'>Vídeo</p>";

            case 'mp3':
            case 'wav':
                return "<p class='w-14 h-10 bg-cyan-500 rounded-lg p-2 shadow-md text-white text-center'>Audio</p>";
            

            case 'xls':
            case 'xlsx':
                return "<p class='w-14 h-10 bg-gray-500 rounded-lg p-2 shadow-md text-white text-center'>Exel</p>";

            case 'doc':
            case 'docx': 
                return "<p class='text-sm w-14 h-10 bg-blue-500 rounded-lg p-2 shadow-md text-white text-center'>Word</p>";

            case 'txt':
                return "<p class='w-14 h-10 bg-violet-500 rounded-lg p-2 shadow-md text-white text-center'>TXT</p>";

            case 'pdf':
                return "<p class='w-14 h-10 bg-green-500 rounded-lg p-2 shadow-md text-white text-center'>PDF</p>";

            case 'zip':
            case 'rar':
            case '7z':
                return "<p class='w-14 h-10 bg-red-500 rounded-lg p-2 pt-3 shadow-md text-white text-center'>ZIP</p>";

            default:
                return "<p class='text-sm w-14 h-10 bg-purple-500 rounded-lg p-2 shadow-md text-white text-center'>Outros</p>";
        }
    })

            ->addColumn('thumb_file_lower', fn (Uploadfiles $model) => strtolower(e($model->thumb_file)))

            ->addColumn('title')
            ->addColumn('nameFile', function (Uploadfiles $model) {
                return  asset("storage/{$model->file}");     
            })
            ->addColumn('file', function (Uploadfiles $model) {
                return "<span class='text-sm'>" . asset("storage/{$model->file}") . "</span>";     
            })
            ->addColumn('status', function (Uploadfiles $model) {
                return $model->status == 1 ? '<span class="text-green-400 pl-4">Sim</span>' : '<span class="text-red-600 pl-4">Não</span>';
                
            })
            ->addColumn('created_at_formatted', fn (Uploadfiles $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    
    public function columns(): array
    {
        return [
    
            Column::make('Miniatura', 'thumb_file')
                ->sortable()
                ->searchable(),

            Column::make('Titulo', 'title')
                ->sortable()
                ->searchable(),

            Column::make('Arquivo', 'file')
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
            Filter::inputText('thumb_file')->operators(['contains']),
            Filter::inputText('title')->operators(['contains']),
            Filter::inputText('file')->operators(['contains']),
            Filter::boolean('status'),
            Filter::datetimepicker('created_at'),
        ];
    }


    public function actions(): array
    {
    return [
    // Button::make('copy', 'Copiar')
    //     ->caption(
    //         '
    //         <svg class="w-6 h-6 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
    //         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7.708 2.292.706-.706A2 2 0 0 1 9.828 1h6.239A.97.97 0 0 1 17 2v12a.97.97 0 0 1-.933 1H15M6 5v4a1 1 0 0 1-1 1H1m11-4v12a.97.97 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V9.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 5h5.239A.97.97 0 0 1 12 6Z"/>
    //         </svg>
    //         '
    //     )
    //     ->tooltip('Copiar Arquivo')
    //     ->class(
    //         '
    //             inline-block px-4 py-2 mr-1 font-bold text-center text-white align-middle ease-soft-in
    //             transition-all rounded-lg cursor-pointer bg-teal-500 leading-pro text-xs tracking-tight-soft
    //             shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs
    //         '
    //     )
    //     ->emit('copyImage', ['nameFile' => 'nameFile']),
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
        ->openModal('upload-file.upload-file', ['id' => 'id','isEdit' => true,]),
        
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
    
        $model = UploadFiles::find($id);

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

    public function copyImage($params): void
    {
        $nameFile = $params['nameFile'];
   
        $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
        if ($isWindows) {
            exec("echo $nameFile | clip");
            $this->notification([
                'title' => getErrorLabelTypeNotification('success'),
                'description' => 'Arquivo copiado',
            ]);
        } else {
            exec("echo $nameFile | pbcopy");
            $this->notification([
                'title' => getErrorLabelTypeNotification('success'),
                'description' => 'Arquivo copiado',
            ]);
        }
    }
     
}
