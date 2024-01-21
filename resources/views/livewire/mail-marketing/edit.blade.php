<x-app-layout>
<div class="main-home-wrapper">     
    @include('layouts.sidebar')
    <x-loading.modal wire:loading />  
    <div class="main-home-content-table p-5 overflow-hidden flex flex-col md:flex-row">
        <div class="w-full md:w-1/3 p-3">
            <div class="templates-variables bg-slate-100">
                @include('templates.variables')
            </div>
        </div>
        <div class="w-full md:w-2/3 p-3">
            <div>
                <form action="{{ route('mail-marketing.update', ['id' => $mailTemplate->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Mail - Marketing</h2>
                    </div>
                    <div class="grid grid-cols-2">
                        <div>
                            <label for="name">Nome da template</label>
                            <input type="text" id="name" name="name" value="{{ $mailTemplate->name }}" placeholder="Editar Pessoa" class="mt-1 p-2 border rounded-lg w-full" maxlength="100"/>
                        </div>
                        <div class="pl-3 m-3">
                            <h6>ativo</h6>
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="1" class="form-radio text-blue-600" {{ $mailTemplate->status == 1 ? 'checked' : '' }}>
                                <span class="ml-2">Sim</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="0" class="form-radio text-blue-600" {{ $mailTemplate->status == 0 ? 'checked' : '' }}>
                                <span class="ml-2">Não</span>
                            </label>
                        </div>                      
                        
                    </div>
                    <div class="mt-4">
                        <label for="title">Título</label>
                        <input type="text" id="title" name="title" value="{{ $mailTemplate->title }}" placeholder="Título" class="mt-1 p-2 border rounded-lg w-full" maxlength="100"/>
                    </div>
                    <div class="mt-4">
                        <label for="subject">Assunto</label>
                        <input type="text" id="subject" name="subject" value="{{ $mailTemplate->subject }}" placeholder="Assunto" class="mt-1 p-2 border rounded-lg w-full" maxlength="100"/>
                    </div>
                    <div class="mt-4">
                        <label for="subject">Pré-header</label>
                        <input type="text" id="subject" name="preheader" value="{{ $mailTemplate->preheader }}" placeholder="Breve descrição do e-mail" class="mt-1 p-2 border rounded-lg w-full" maxlength="140"/>
                    </div>
                    <div class="mt-4">
                        <label for="editor">HTML da Template</label>
                        <textarea id="editor" name="body" placeholder="HTML da Template" class="mt-1 p-2 border rounded-lg w-full h-48">{{ $mailTemplate->body }}</textarea>
                    </div>
                
                    <div class="flex justify-between mt-4">
                        <div>                                
                            <a href="{{ route('mail-marketing.index') }}" class="text-blue-500">Voltar</a>
                        </div>
                        <div>
                            <button type="submit" class="ml-auto bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
</x-app-layout>
  


<script>
    CKEDITOR.replace('editor', {
        allowedContent: true,
        fullPage: true,
        height: 125,
    });
</script>

