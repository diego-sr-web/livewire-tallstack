<div class="main-home-wrapper">     
    <x-loading.modal wire:loading />
    @include('layouts.sidebar')
    <div class="{{ ($machines->count() xor (!$machines->count() and $search)) ? 'machine-board board-machine-open' : 'hidden' }}">
        <header class="machine-board-header w-full">
            <div class="machine-icon-qtd w-6/12">
                <img src="{{ asset('imgs/machine-icon.svg') }}" alt="" class="machine-icon">
                <div class="flex">
                    <span class="flex p-1 font-bold">{{ $machines->count() }}</span>
                    <span class="flex p-1">Máquina(s)</span>
                </div>
                <div class="flex">
                    <span class="flex p-1 font-bold">{{ $machines->where('status', 1)->count() }}</span>
                    <span class="flex p-1">Rodando</span>
                </div>
                <div class="flex">
                    <span class="flex p-1 font-bold">{{ $machines->where('status', 0)->count() }}</span>
                    <span class="flex p-1">Pausado</span>
                </div>
            </div>

            <div class="flex w-6/12">
                <div class="p-1 ml-auto w-full md:w-6/12 lg:w-6/12">
                    <x-input class="w-full" wire:model.debounce.500ms="search" placeholder="Pesquisar nome da máquina..."/>
                </div>
                <div class="p-1 mr-0">
                    <x-button label="Adicionar Máquina" onclick="Livewire.emit('openModal', 'panel.machines.machine.modal')" class="w-full" primary /> 
                </div>
            </div>
        </header>

        <div class="main-home-with-machine-created">
            <p class="machines-created-title">Minhas máquinas</p>
            <p class="machines-created-text">
                Gerencie todas suas máquinas criadas em um só lugar.
            </p>

            @if ($search)
                <span class="text-red-500 font-bold text-lg">Buscado por: {{ $search }}</span>                    
            @endif

            <div class="card-render-wrapper">
                <div id="card-render">
                    <div 
                        id="open-create-modal-3" 
                        class="inside-button-create-machine" 
                        onclick="Livewire.emit('openModal', 'panel.machines.machine.form')">
                        <img src="{{ asset('imgs/create-machine-icon.svg') }}" alt="Adicionar Máquina">
                        <span>Adicionar Máquina</span>
                    </div>
                    
                    @foreach ($machines as $machine)
                        <div class="cardMachine shadow-sm hover:shadow-lg hover:bg-gray-50 {{ $machine->status ? 'border-green-300 border-2' : '' }} ">
                            <p>{{ $machine->name }}</p>
                            <a href="{{ route('machine-sequences', $machine) }}">
                                <img src="{{ asset('storage/' . $machine->file) }}">
                            </a>
                            <div class="views-like-and-settings">

                                <div class="views-card">
                                    <img class="view-card-image" src="{{ asset('imgs/views-card.svg') }}">
                                    <span class="view-card-qtd">1380</span>
                                </div>
                                <div class="like-card">
                                    <img class="like-card-image" src="{{ asset('imgs/views-card.svg') }}">
                                    <span class="like-card-qtd">24</span>
                                </div>

                                <livewire:panel.machines.machine.dropdown :machine="$machine" :key="microtime()" />
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pt-4">
                    <!-- Paginador -->
                </div>
            </div>
        </div>
    </div>

    <div class="main-home-content {{ ($machines->count() xor (!$machines->count() && $search)) ? 'hidden' : '' }}">
        <div class="home-content">
            <!-- Evento de modal -->
            <div>
                <img src="{{ asset('imgs/image-content.png') }}" alt="" class="image-maquinas" />
    
                <p class="content-maquinas-text1">
                    Você ainda não possuí máquinas criadas
                </p>
    
                <p class="content-maquinas-text2">
                    Crie a sua primeira audiência clicando no botão abaixo
                </p>
    
                <div class="button-div">
                    <button 
                        class="button-create uppercase" 
                        type="button" 
                        onclick="Livewire.emit('openModal', 'panel.machines.machine.form')">
                        Criar Maquina
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>