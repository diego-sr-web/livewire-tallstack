<div class="machine-board board-machine-open">
  <!-- Evento de modal -->
  <div x-cloak x-data="{
     AddMachineModal: @entangle('AddMachineModal'),
     ConfirmMachineModal: @entangle('ConfirmMachineModal') }"
  >

  <header class="machine-board-header">
    <div class="machine-icon-qtd">
      <img src="./imgs/machine-icon.svg" alt="" class="machine-icon">
      <div class="qtd-machines">
      <span id="machine-counter">{{$count}}</span>
      <span class="machine-name-indicator">Máquinas</span>
      </div>
    </div>

    <div class="search-and-add-machine">
      <div class="search-input-wrapper">
        <input wire:model="search"
          placeholder="Pesquisar nome da máquina..." 
          type="text" name="" id="search-machine">
      </div>
      <div class="button-create3 button-create" @click="AddMachineModal = true">
        Adicionar Máquina
      </div>
    </div>
  </header>
  <div class="main-home-with-machine-created">
  <p class="machines-created-title">Minhas máquinas</p>
  <p class="machines-created-text">Gerencie todas suas máquinas criadas em um só lugar.</p>

  @if ($search)
  <span class="text-red-500 font-bold text-lg">Buscado por: {{ $search }} </span>
  @endif
  
  <div class="card-render-wrapper">
    <div id="card-render">
      <div id="open-create-modal-3" class="inside-button-create-machine" @click="AddMachineModal = true">
        <img src="./imgs/create-machine-icon.svg" alt="">
        <span>Adicionar Máquina</span>
      </div>
      @foreach ($machines as $machine)  
      @php
        $status = $machine->status ?? false;
      @endphp

      <div class="cardMachine">
        <p>{{ $machine->machine_name }}</p>
        <a class="{{ $status ? '' : 'inactive-card' }}" href=" /maquina-sequencia "> 
          <img src="{{ asset('storage/' . $machine->file) }}"> 
        </a>
        <div class="views-like-and-settings">
          <div class="views-card">
            <img class="view-card-image" src="./imgs/views-card.svg">
            <span class="view-card-qtd">1380</span>
          </div>
          <div class="like-card">
            <img class="like-card-image" src="./imgs/views-card.svg">
            <span class="like-card-qtd">24</span>
          </div>

          @include('livewire.templates.dropdown-menu') 
                        
        </div>
      </div>
      @endforeach
    </div>      
    <div class="pt-4">
      <!-- Paginador -->
      {{ $machines->links() }}
    </div>
  </div>

  @include('livewire.templates.modal')
