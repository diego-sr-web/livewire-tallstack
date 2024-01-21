<div class="main-home-wrapper">
    @push('css')
        <link href="{{ asset('css/loading/ball-clip-rotate-multiple.css') }}" rel="stylesheet" />
    @endpush
    <x-loading.modal wire:loading />
    @include('layouts.sidebar')
    
    <div class="relative p-4 w-full h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Gerenciamento de permissões {{ $role ? 'do perfil ' . $role->name  : '' }}
                </h3>
            </div>
            
            <div class="grid gap-4 mb-4 md:grid-cols-6 {{ $role ? 'border-b pb-6' : '' }}">
                @forelse ($roles as $item)
                <div>
                    <a href="#" wire:click="setRole({{ $item->id }})" class="inline-flex items-center justify-center p-5 text-base font-medium text-gray-500 rounded-lg bg-gray-50 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5 mr-3" viewBox="0 0 22 31" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_4151_63004)"><path d="M5.50085 30.1242C8.53625 30.1242 10.9998 27.8749 10.9998 25.1035V20.0828H5.50085C2.46546 20.0828 0.00195312 22.332 0.00195312 25.1035C0.00195312 27.8749 2.46546 30.1242 5.50085 30.1242Z" fill="#0ACF83"/><path d="M0.00195312 15.062C0.00195312 12.2905 2.46546 10.0413 5.50085 10.0413H10.9998V20.0827H5.50085C2.46546 20.0827 0.00195312 17.8334 0.00195312 15.062Z" fill="#A259FF"/><path d="M0.00195312 5.02048C0.00195312 2.24904 2.46546 -0.000244141 5.50085 -0.000244141H10.9998V10.0412H5.50085C2.46546 10.0412 0.00195312 7.79193 0.00195312 5.02048Z" fill="#F24E1E"/><path d="M11 -0.000244141H16.4989C19.5343 -0.000244141 21.9978 2.24904 21.9978 5.02048C21.9978 7.79193 19.5343 10.0412 16.4989 10.0412H11V-0.000244141Z" fill="#FF7262"/><path d="M21.9978 15.062C21.9978 17.8334 19.5343 20.0827 16.4989 20.0827C13.4635 20.0827 11 17.8334 11 15.062C11 12.2905 13.4635 10.0413 16.4989 10.0413C19.5343 10.0413 21.9978 12.2905 21.9978 15.062Z" fill="#1ABCFE"/></g><defs><clipPath id="clip0_4151_63004"><rect width="22" height="30.1244" fill="white" transform="translate(0 -0.000244141)"/></clipPath></defs></svg>                                              
                        <span class="w-full">{{ $item->name }}</span>
                        <svg class="w-4 h-4 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
                @empty                        
                @endforelse
            </div>
            
            @if ($role)
                <form wire:submit.prevent="save" action="#" method="POST">
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">                    
                        <div>
                            @if ($permissions->count())
                                <livewire:admin.role-permissions.sub-role-permission 
                                    :key="microtime()" 
                                    :role="$role"
                                    :permissions="$permissions"
                                    :permission_ids="$permission_ids" />                        
                            @endif
                        </div>
                    </div>

                    <x-button type="submit" primary label="Salvar" />
                    <x-button wire:click="cancel" secundary label="Cancelar" />
                </form>                
            @endif
        </div>
    </div>
</div>