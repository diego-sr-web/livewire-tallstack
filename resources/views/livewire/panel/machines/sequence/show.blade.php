<div class="main-home-with-machine-created mb-4" sequence-id="{{ $sequence->id }}">
    <div class="container-inicio cursor-move">
        <p class="machines-created-title">{{ $sequence->name }}</p>
        <div class="div-juntar-icon">
            <div class="flex-inicio">
                <img class="flex-inicio-img" src="{{ asset('im2/icon-heart.svg') }}" alt="">
                <p>Leads: 2585</p>
            </div>
            <div>
                <img class="seta-baixo-img" src="{{ asset('im2/icone-seta-baixo.png') }}" alt="">
            </div>
        </div>
    </div>
    <div class="card-total"
        x-data=""
        x-init="Sortable.create($el, {
            animation: 150,
            handle: '.sua-div',
            onSort({ to }) {
                const stepIds = Array.from(to.children).map(item => item.getAttribute('step-id'));
                @this.reorderSteps(stepIds);
            }
        })"
    >
        @forelse ($steps as $step)
        <div class="flex" step-id="{{ $step->id }}">
            <livewire:panel.machines.sequence.step.show :step="$step" :key="microtime()" />

            <!-- seta -->
            <div class="icone-seta">
                <img src="{{ asset('im2/icon-seta.png') }}" alt="Ícone">
            </div>

        </div>
        @empty                        
        @endforelse

        <button 
            class="card-render-wrapper-button"
            wire:click="$emit('openModal', 'panel.machines.sequence.step.form', {{ json_encode(['sequence' => $sequence->id]) }})"
            >
            <div class="card-render-wrapper-2">
                <img src="{{ asset('im2/machine-icon.svg') }}" alt="Adicionar Etapa">
                <span>Adicionar Etapa</span>
            </div>
        </button>    
    </div>
</div>