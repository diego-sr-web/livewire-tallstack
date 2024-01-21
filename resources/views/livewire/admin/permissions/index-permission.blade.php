<div class="main-home-wrapper">
    @push('css')
        <link href="{{ asset('css/loading/ball-clip-rotate-multiple.css') }}" rel="stylesheet" />
    @endpush
    <x-loading.modal wire:loading />
    @include('layouts.sidebar')

    <div class="relative p-4 w-full h-full md:h-auto">
        <!-- Form content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Form header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Gerenciamento de permissões
                </h3>
            </div>

            <!-- Form body -->
            <form wire:submit.prevent="save" action="#" method="POST">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <div class="{{ !$this->permission ? '' : 'hidden' }}">
                            <x-select
                                label="Permissão"
                                placeholder="Selecione uma permissão"
                                :options="$permissions"
                                option-label="name"
                                option-value="id"
                                wire:model="permission_id"
                            />
                        </div>
                        @forelse ($subPermissions as $listPermissions)
                            <div class="{{ !$this->permission ? '' : 'hidden' }} mt-4">
                                <x-select
                                    label="Sub Permissão"
                                    placeholder="Selecione uma sub permissão"
                                    :options="$listPermissions"
                                    option-label="name"
                                    option-value="id"
                                    wire:model="permission_id"
                                />
                            </div>
                        @empty
                        @endforelse
                        <div class="mt-4">
                            <x-input wire:model.lazy="name" placeholder="Nome da permissão" label="Nome" />
                        </div>
                    </div>
                    <div>
                        @if ($permissions->count())
                            <livewire:admin.permissions.sub-permission
                                :key="microtime()"
                                :permissions="$permissions" />
                        @endif
                    </div>
                </div>

                <x-button wire:click="cancelar" warning label="Cancelar" class="{{ $this->permission ? '' : 'hidden' }}" />
                <x-button type="submit" primary label="Salvar" class="{{ $this->permission ? '' : 'hidden' }}" />
                <x-button type="submit" icon="pencil" primary label="+ Adicionar nova permissão" class="{{ $this->permission ? 'hidden' : '' }}" />
            </form>
        </div>
    </div>
</div>
