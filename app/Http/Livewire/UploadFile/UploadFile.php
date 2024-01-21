<?php

namespace App\Http\Livewire\UploadFile;

use Illuminate\Support\Str;
use App\Models\Companies\Company;
use App\Models\UploadFiles\Uploadfiles;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class UploadFile extends ModalComponent
{
    use Actions;
    use WithFileUploads;

    public $uploadfile;
    public $title;
    public $thumb_file;
    public $file;
    public $status = 1;
    public $isEdit = false;

    protected $rules = [
        'title' => 'required',
        'thumb_file' => 'required',
        'file' => 'required',
        'status' => 'required',
    ];

    public function mount(Uploadfiles $id = null, $isEdit)
    {
        if ($isEdit && $id) {
            $this->uploadfile = Uploadfiles::find($id)->first();
            if ($this->uploadfile) {
                $this->title = $this->uploadfile->title;
                $this->file = $this->uploadfile->file;
                $this->thumb_file = $this->uploadfile->thumb_file;
                $this->status = $this->uploadfile->status;
            }
        }
    }

    public function save()
    {
    if ($this->title == null) {
        $this->notification([
            'title' => getErrorLabelTypeNotification('error'),
            'description' => 'Insira um titulo.',
            'icon' => 'error',
        ]);
        return;
    }
    if ($this->isEdit) {

        if (is_string($this->file)) {
            //pega o nome da imagem e a extensão quando for editar o arquivo e monta corretamente para salvar no banco
            $fileName = $this->file;
            $lastDotPosition = strrpos($fileName, '.');
            $fileExtension = ($lastDotPosition !== false) ? substr($fileName, $lastDotPosition + 1) : '';          

        }else {
            //se for salvar a imagem monta o nome correto
            $extension = $this->file->getClientOriginalExtension();
            $companyName = Company::find(companyId())->profile->relation->name;
            $fileName = Str::slug($companyName) . '-' . substr(md5(uniqid()), 0, 9) . '.' . $extension;
            $this->file->storeAs('public/'.$fileName);
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        }

        try {
            $this->uploadfile->update([
                'title' => $this->title,
                'thumb_file' => $fileExtension,
                'file' => $fileName,
                'status' => $this->status,
            ]);

            $this->notification([
                'title' => getErrorLabelTypeNotification('success'),
                'description' => 'Atualizado com seucesso!',
            ]);

            $this->reset();
            $this->closeModal();
            return redirect()->to('/uploads/arquivos');
        } catch (\Illuminate\Validation\ValidationException $e) {

            $this->notification([
                'title' => getErrorLabelTypeNotification('error'),
                'description' => 'Erro ao atualizar:' . $e,
                'icon' => 'error',
            ]);
        }

    } else {
        if ($this->file === null) {
            $this->notification([
                'title' => getErrorLabelTypeNotification('error'),
                'description' => 'Selecione um arquivo.',
                'icon' => 'error',
            ]);
            return;
        }

        $companyName = Company::find(companyId())->profile->relation->name;
        $extension = $this->file->getClientOriginalExtension();
        $fileName = Str::slug($companyName) . '-' . substr(md5(uniqid()), 0, 9) . '.' . $extension;
        $this->file->storeAs('public/uploads', $fileName);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        try {
            $uploadfile = new Uploadfiles([
                'user_id' => user()->id,
                'company_id' => companyId(),
                'thumb_file' => $fileExtension,
                'title' => $this->title,
                'file' => 'uploads/' . $fileName,
                'status' => $this->status,
            ]);

            $uploadfile->save();

            $this->notification([
                'title' => getErrorLabelTypeNotification('success'),
                'description' => 'Salvo com sucesso!',
            ]);
            $this->reset();
            $this->closeModal();
            return redirect()->to('/uploads/arquivos');

        }catch (\Illuminate\Validation\ValidationException $e) {
            $this->notification([
                'title' => getErrorLabelTypeNotification('error'),
                'description' => 'Erro ao salvar:' . $e,
                'icon' => 'error',
            ]);
        }
        }
    }

    public function getErrorLabelTypeNotification($type)
    {
        $types = [
            'error' => 'Erro !!!',
            'success' => 'Sucesso !!!',
            'warning' => 'Atenção !!!',
        ];

        return $types[$type];
    }

    public function render()
    {
        return view('livewire.upload-file.upload-form');
    }
}
