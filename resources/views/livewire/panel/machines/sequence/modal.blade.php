<div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
    <!-- Form header -->
    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Nova máquina de vendas
        </h3>
        <button
            type="button"
            wire:click="$emit('closeModal')"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-toggle="createProductModal">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Close modal</span>
        </button>
    </div>
    <!-- Form body -->
    <form action="#">
        @if (!isOwner())
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <x-input.text wire:model.lazy="name" type="text" name="name" placeholder="Nome da máquina" />
                </div>
            </div>

            <div class="mb-4">
                <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imagem da capa</span>
                <div class="flex justify-center items-center w-full">
                    <label for="dropzone-file" class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col justify-center items-center pt-5 p-6">
                            <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                A dimensão recomendada é de
                                <span class="font-semibold">1600 x 838</span>
                                (mesma proporção do formato utilizado nas páginas de evento no Facebook).
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Formato <strong>JPEG, GIF ou PNG</strong> de no máximo <strong>2MB.</strong> Imagens com
                                dimensões diferentes serão redimensionadas.</p>
                        </div>
                        <input type="file" wire:model="file" id="dropzone-file" class="hidden">
                    </label>
                </div>
            </div>
            @error('file')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
            <div class="mb-4">

            </div>
            <div class="items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                <x-form.button type="button" class="uppercase" wire:click="save" primary>
                    {{ $isEditing ? 'Salvar Alterações' : 'Criar Maquina' }}
                </x-form.button>
                <x-form.button type="button" class="uppercase" wire:click="$emit('closeModal')" secundary>
                    <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    Cancelar
                </x-form.button>
            </div>
        @else
            <div class="p-10 text-center">
                Adicionar máquina só é permitido para empresa e colaboradores
            </div>
        @endif

    </form>
    {{-- https://sinnbeck.dev/posts/making-a-complete-file-uploader-with-progressbar-using-livewire-and-alpinejs --}}
</div>
