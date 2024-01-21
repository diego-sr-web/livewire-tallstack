<div class="relative w-full h-full md:h-auto">
    <x-loading.modal wire:loading />
    <!-- Form content -->
    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
        <!-- Form header -->
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white uppercase">
                {{ data_get($company, 'id') ? 'Editando' : 'Adicionar' }} Empresa
            </h3>
            <button wire:click="$emit('closeModal')" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Fechar modal</span>
            </button>
        </div>
        <!-- Form body -->
        <form wire:submit.prevent="save" action="#" method="POST">
            <h2 class="p-2 mb-1 bg-gray-300 border border-t border-b rounded-t-md font-bold text-md uppercase">Dados principais</h2>
            <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4 sm:gap-3">
                <div class="sm:col-span-2">
                    <x-input wire:model.lazy="name" label="Nome" placeholder="Digite o nome" />
                </div>
                <div class="sm:col-span-2">
                    <x-input wire:model.lazy="fantasy_name" name="fantasy_name" label="Nome fantasia" placeholder="Digite o nome fantasia" />
                </div>
                <div class="sm:col-span-2">
                    <x-input wire:model.lazy="site" name="site" label="Site" placeholder="Digite o endereço do site" />
                </div>
                <div class="sm:col-span-2">
                    <x-input wire:model.lazy="email" label="Email*" placeholder="Digite o email" />
                </div>
            </div>

            <h2 class="p-2 mb-1 mt-6 bg-gray-300 border border-t border-b rounded-t-md font-bold text-md uppercase">Documentos</h2>
            <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4 sm:gap-3">
                @foreach ($documentTypes as $documentType)
                    @switch($documentType->name)
                        @case('cpf')
                            <div class="sm:col-span-2">
                                <x-input x-mask="999.999.999-99" wire:model.lazy="document.{{ $documentType->name }}" label="{{ $documentType->label }}" placeholder="Digite o {{ $documentType->label }}" />
                            </div>
                            @break
                        @case('cnpj')
                            <div class="sm:col-span-2">
                                <x-input x-mask="99.999.999.9999-99" wire:model.lazy="document.{{ $documentType->name }}" label="{{ $documentType->label }}" placeholder="Digite o {{ $documentType->label }}" />
                            </div>
                            @break
                        @default
                            <div class="sm:col-span-2">
                                <x-input wire:model.lazy="document.{{ $documentType->name }}" label="{{ $documentType->label }}" placeholder="Digite o {{ $documentType->label }}" />
                            </div>
                            @break
                    @endswitch
                @endforeach
            </div>

            <h2 class="p-2 mb-1 mt-6 bg-gray-300 border border-t border-b rounded-t-md font-bold text-md uppercase">Contatos</h2>
            <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4 sm:gap-3">
                @foreach ($contactTypes as $contactType)
                    @if (in_array($contactType->name, ['phone', 'phone_aditional']))
                        <div class="sm:col-span-2">
                            <x-input x-mask:dynamic="$input.length > 14 ? '(99) 99999-9999' : '(99) 9999-9999'" wire:model.lazy="contact.{{ $contactType->name }}" label="{{ $contactType->label }}" placeholder="Digite o {{ $contactType->label }}" />
                        </div>
                    @else
                        <div class="sm:col-span-2">
                            <x-input wire:model.lazy="contact.{{ $contactType->name }}" label="{{ $contactType->label }}" placeholder="Digite o {{ $contactType->label }}" />
                        </div>
                    @endif
                    @endforeach
            </div>

            <h2 class="p-2 mb-1 mt-6 bg-gray-300 border border-t border-b rounded-t-md font-bold text-md uppercase">Endereço</h2>
            <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4 sm:gap-3">
                <div class="sm:col-span-1">
                    <x-input wire:model.lazy="zip_code" name="zip_code" label="CEP" placeholder="000000-000" />
                </div>
                <div class="sm:col-span-3">
                    <x-input wire:model.lazy="street" name="street" label="Rua" placeholder="Av. Brasil" />
                </div>
                <div class="sm:col-span-1">
                    <x-input wire:model.lazy="number" name="number" label="Numero" placeholder="000" />
                </div>
                <div class="sm:col-span-2">
                    <x-input wire:model.lazy="complement" name="complement" label="Complemento" placeholder="Casa 2" />
                </div>
                <div class="sm:col-span-1">
                    <x-input wire:model.lazy="neighborhood" name="neighborhood" label="Bairro" placeholder="Água verde" />
                </div>
                <div class="sm:col-span-3">
                    <x-input wire:model.lazy="city" name="city" label="Cidade" placeholder="Curitiba" />
                </div>
                <div class="sm:col-span-1">
                    <x-input wire:model.lazy="state" name="state" label="Estado" placeholder="PR" />
                </div>
            </div>

            @if (!data_get($company, 'id'))
                <h2 class="p-2 mt-6 bg-gray-300 border border-t border-b rounded-t-md font-bold text-md uppercase">Acesso</h2>
                <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4 sm:gap-3 mt-4">
                    <div class="sm:col-span-2">
                        <x-input wire:model.lazy="password" label="Senha*" placeholder="********" />
                    </div>
                    <div class="sm:col-span-2">
                        <x-input wire:model.lazy="confirm_password" label="Confirme a Senha*" placeholder="********" />
                    </div>
                </div>
            @endif

            <div class="flex items-center space-x-4 mt-6">
                <x-button type="submit" primary label="Salvar" />
                <x-button wire:click="$emit('closeModal')" secundary label="Cancelar" />
            </div>
        </form>
    </div>
</div>
