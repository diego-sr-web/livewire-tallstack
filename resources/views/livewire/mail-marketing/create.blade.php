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
          <h2 class="text-2xl font-bold mb-4">Email - Marketing</h2>
    
          <form method="POST" action="{{ route('mail-marketing.store') }}" class="mb-8">
              @csrf
              <div class="grid grid-cols-2 gap-4">
                  <div>
                      <label for="name" class="block font-medium text-gray-700">Identificação</label>
                      <input type="text" id="name" name="name" value="" placeholder="Identificação" class="mt-1 p-2 border rounded-lg w-full" maxlength="100">
                  </div>
                  <div>
                      <h6>ativo</h6>
                      <label class="inline-flex items-center">
                          <input type="radio" name="status" value="1" class="form-radio text-blue-600" checked>
                          <span class="ml-2">Sim</span>
                      </label>
                      <label class="inline-flex items-center">
                          <input type="radio" name="status" value="0" class="form-radio text-blue-600">
                          <span class="ml-2">Não</span>
                      </label>
                  </div>
              </div>
              <div class="mt-4">
                  <label for="title" class="block font-medium text-gray-700">Título</label>
                  <input type="text" id="title" name="title" value="" placeholder="Título" class="mt-1 p-2 border rounded-lg w-full" maxlength="100">
              </div>
              <div class="mt-4">
                  <label for="subject" class="block font-medium text-gray-700">Assunto</label>
                  <input type="text" id="subject" name="subject" value="" placeholder="Assunto" class="mt-1 p-2 border rounded-lg w-full" maxlength="100">
              </div>
              <div class="mt-4">
                  <label for="subject" class="block font-medium text-gray-700">Resumo Curto</label>
                  <input type="text" id="subject" name="preheader" value="" placeholder="Breve descrição do E-mail." class="mt-1 p-2 border rounded-lg w-full" maxlength="140">
              </div>
              <div class="mt-4">
                  <label for="editor" class="block font-medium text-gray-700">HTML da Template</label>
                  <textarea id="editor" name="body"  class="mt-1 p-2 border rounded-lg w-full h-48" placeholder="HTML da Template"></textarea>
              </div>
                              
              <div class="flex justify-between mt-4">
                  <div>
                      <a href="{{ route('mail-marketing.index') }}" class="text-blue-500 hover:underline">Voltar</a>
                  </div>
                  <div>
                      <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 hover:text-white transition duration-300 ease-in-out">Enviar</button>
                  </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>  
</x-app-layout>


<script>
	CKEDITOR.replace( 'editor', {
		allowedContent: true,
		fullPage: true,
		height: 125,
	});
</script>
  