<div class="relative w-full h-full md:h-auto">
    <x-loading.modal wire:loading />
    <!-- Form content -->
    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
        <!-- Form header -->
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white uppercase">
                {{ data_get($role, 'id') ? 'Editando' : 'Adicionar' }} Papel
            </h3>
            <button wire:click="$emit('closeModal')" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Fechar modal</span>
            </button>
        </div>
        <!-- Form body -->
        <form wire:submit.prevent="save" action="#" method="POST">
            <h2 class="p-2 mb-1 bg-gray-300 border border-t border-b rounded-t-md font-bold text-md uppercase">Dados principais</h2>
            <div class="grid gap-3 sm:grid-cols-2 sm:gap-3">
                <div class="sm:col-span-2">
                    <x-toggle wire:model.lazy="active" label="Ativo" />
                </div>
                <div class="sm:col-span-2">
                    <x-toggle wire:model.lazy="is_admin" label="Perfil Administrador" />
                </div>
                <div class="sm:col-span-2">
                    <x-input wire:model.lazy="name" label="Nome" placeholder="Digite o nome" />
                </div>
            </div>

            <div class="flex items-center space-x-4 mt-6">
                <x-button type="submit" primary label="Salvar" />
                <x-button wire:click="$emit('closeModal')" secundary label="Cancelar" />
            </div>
        </form>
    </div>
</div>
