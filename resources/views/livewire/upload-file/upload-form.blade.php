<div  class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm">
    <x-loading.modal wire:loading/>
    <!-- Form header -->
    <div wire:loading class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Upload de Arquivos
        </h3>
        <button
            type="button"
            wire:click="$emit('closeModal')"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover-bg-gray-600 dark:hover-text-white"
            data-modal-toggle="createProductModal">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
    </div>
    <!-- Form body -->
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        
        <div class="grid gap-3 sm:grid-cols-1 mt-2">
            <div class="sm:col-span-1">
                <input class="w-full px-3 py-2 border rounded-md transition duration-300 focus:outline-none focus:ring focus:border-blue-300" wire:model.lazy="title"  name="title" label="Titulo do Arquivo" placeholder="Imagem do Banner" />
            </div>
        </div>
           
        <div class="flex items-center justify-center w-full mt-6">
            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Selecione um arquivo</span> para Upload</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Tamanho máximo 5mb</p>
                </div>
                <input wire:model.lazy="file" id="dropzone-file" type="file" class="hidden" />
            </label>
        </div>
        <p class="text-sm">{{ $file }}</p>
        <div class="mt-6 flex">
            <div class="flex items-center p-4 border border-gray-200 rounded dark:border-gray-700">
                <input wire:model="status" id="bordered-radio-1" type="radio" value="1" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="bordered-radio-1" class="py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ativo</label>
            </div>
            <div class="flex items-center p-4 border border-gray-200 rounded dark:border-gray-700">
                <input wire:model="status" id="bordered-radio-2" type="radio" value="0" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="bordered-radio-2" class="py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Inativo</label>
            </div>
        </div>
        
        <div class="mb-4 mt-6">
            <div class="items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                <x-form.button type="submit" class="uppercase" primary>
                    <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                      </svg>&nbsp
                     Salvar
                </x-form.button>
                <x-form.button type="button" class="uppercase" wire:click="$emit('closeModal')" secundary>
                    <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Cancelar
                </x-form.button>
            </div>
        </div>
    </form>
</div>
