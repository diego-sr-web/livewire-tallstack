<div class="main-home-wrapper">     
    <x-loading.modal wire:loading />
    @include('layouts.sidebar')
    
    <div class="w-full p-4">
        <header class="machine-board-header w-full">
            <div class="machine-icon-qtd w-6/12">
                <div class="container-header">
                    <div class="top-line">Máquina: {{ $machine->name }}</div>
                    <div class="bottom-line">
                        <div class="flex"><img src="{{ asset('imgs/settings-switches-checkmark.png') }}" class="pr-2" />3948</div>
                        <div class="flex"><img src="{{ asset('imgs/settings-switches-checkmark.png') }}" class="pr-2" /> 24</div>
                    </div>
                </div>
            </div>
            <div>
                <label class="buscar" for="buscaSequencia"></label>
                <input type="text" id="buscaSequencia" />
                <button wire:click="$emit('openModal', 'panel.machines.sequence.form', {{ json_encode(['machine' => $machine->id]) }})" class="botao-header">
                    <span class="botao-header-text">Adicionar Sequência</span>
                </button>                    
            </div>
        </header>
        
        <div 
            x-data=""
            x-init="Sortable.create($el, {
                animation: 150,
                handle: '.container-inicio',
                onSort({ to }) {
                    const sequenceIds = Array.from(to.children).map(item => item.getAttribute('sequence-id'));
                    @this.reorderSequence(sequenceIds);
                }
            })">
            @forelse ($sequences as $sequence)
                <livewire:panel.machines.sequence.show :sequence="$sequence" :key="microtime()" />                
            @empty
                <div class="main-home-with-machine-created">
                    <div class="container-inicio">
                        <p class="p-10 text-center">Sequência sem etapas cadastradas</p>
                    </div>
                </div>
            @endforelse        
        </div>
    </div>
</div>