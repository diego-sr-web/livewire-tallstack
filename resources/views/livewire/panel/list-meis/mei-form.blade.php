<div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
    <!-- Form header -->
    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Formulário MEI
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
    <form wire:submit.prevent="save" action="#">
        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4 sm:gap-3">
            <div class="sm:col-span-2">
                <x-input x-mask="99.999.999/9999-99" wire:model.lazy="mei_cnpj" name="mei_cnpj" label="CNPJ" placeholder="00.000.000/0000-00"/>
            </div>
            <div class="sm:col-span-2">
                <x-input wire:model.lazy="mei_nome" name="mei_nome" label="Nome" placeholder="José da Silva" />
            </div>
            <div class="sm:col-span-2">
                <x-input wire:model.lazy="mei_email" name="mei_email" label="Email" placeholder="seu@email.com" />
            </div>
            <div class="sm:col-span-2">
                <x-input x-mask:dynamic="$input.length > 14 ? '(99) 99999-9999' : '(99) 9999-9999'" wire:model.lazy="mei_telefone" name="mei_telefone" label="Telefone" placeholder="(11)99999-9999"/>
            </div>
            <div class="sm:col-span-1">
                <x-input wire:model.lazy="mei_entregue" name="mei_entregue" label="Entregue" />
            </div>
            <div class="sm:col-span-1">
                <x-input wire:model.lazy="mei_situacao" name="mei_situacao" label="Situação"/>
            </div>
            <div class="sm:col-span-1">
                <x-input wire:model.lazy="mei_status" name="mei_status" label="Status"  />
            </div>
            <div class="sm:col-span-1">
                <x-input wire:model.lazy="mei_ano" name="Ano" label="Ano" />
            </div>
        </div>

        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4 sm:gap-3 mt-2">
            <div class="sm:col-span-1">
                <x-input x-mask="99999-999" wire:model.lazy="mei_cep" name="mei_cep" label="CEP" placeholder="000000-000" />
            </div>
            <div class="sm:col-span-2">
                <x-input wire:model.lazy="mei_endereco" name="endereco" label="Rua" placeholder="Av. Brasil"  />
            </div>
            <div class = "sm:col-span-1">
                <x-input wire:model.lazy="mei_numero" name="mei_numero" label="Número" placeholder="000" />
            </div>
            <div class="sm:col-span-2">
                <x-input wire:model.lazy="mei_complemento" name="mei_complemento" label="Complemento" placeholder="Casa 2" />
            </div>
            <div class="sm:col-span-2">
                <x-input wire:model.lazy="mei_bairro" name="mei_bairro" label="Bairro" placeholder="Água Verde" />
            </div>
            <div class="sm:col-span-2">
                <x-input wire:model.lazy="mei_cidade" name="mei_cidade" label="Cidade" placeholder="Curitiba" />
            </div>
            <div class="sm:col-span-2">
                <x-input wire:model.lazy="mei_uf" name="mei_uf" label="Estado" placeholder="PR"  maxlength="2"  pattern="[A-Za-z]{2}"/>
            </div>
            <div class="sm:col-span-2">
                <x-input wire:model.lazy="mei_cnae" name="mei_cnae" label="Cnae"/>
            </div>
            <div class="sm:col-span-2">
                <x-input wire:model.lazy="mei_cnae_desc" name="mei_cnae_desc" label="Cnae Descrição"/>
            </div>
        </div>
 

        <div class="mb-4 mt-6">
            <div class="items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                <x-form.button type="submit" class="uppercase" primary>
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
