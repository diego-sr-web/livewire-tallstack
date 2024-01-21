<div x-data="{ open: false, isConfirmationVisible: false, machineIdToDelete: null }" @click.outside="open = false" @close.stop="open = false">
  <!-- Elemento que controla o dropbox -->
  <div @click="open = !open">
    <button class="active-item inline-flex items-center border border-transparent text-sm leading-6 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
      <div class="ml-1">
        <img src="./imgs/settings.svg"/>
      </div>
    </button>
  </div>

  <!-- Restante do conteúdo do dropbox -->
  <div x-show="open" x-transition:enter="transition ease-out duration-200" 
       x-transition:enter-start="transform opacity-0 scale-95" 
       x-transition:enter-end="transform opacity-100 scale-100" 
       x-transition:leave="transition ease-in duration-75" 
       x-transition:leave-start="transform opacity-100 scale-100" 
       x-transition:leave-end="transform opacity-0 scale-95"
       class="absolute z-40 mt-2 w-24 rounded-md shadow-lg origin-top-right bottom-6 right-0"
       @click="open = false">
    <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white border border-gray-300">
      <!-- Itens do dropbox -->
      @if($status)
        <!-- Show "Pause" button when $status is true (active) -->
        <div class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-indigo-100 focus:outline-none focus:bg-indigo-200 transition duration-150 ease-in-out"
            aria-label="Pause"
            wire:click="machineStatus({{ $machine->id }})">
            <button type="button" class="flex items-center">
                <img src="imgs/pause.svg" alt="Pause Icon" class="mr-2">
                <span>Pausar</span>
            </button>
        </div>
      @else
        <!-- Show "Play" button when $status is false (inactive) -->
        <div class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-indigo-100 focus:outline-none focus:bg-indigo-200 transition duration-150 ease-in-out active-item"
            aria-label="Play"
            wire:click="machineStatus({{ $machine->id }})">
            <button type="button" class="flex items-center">
                <img src="imgs/play.svg" alt="Play Icon" class="mr-2">
                <span>Play</span>
            </button>
        </div>
      @endif

      <div class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-indigo-100 focus:outline-none focus:bg-indigo-200 transition duration-150 ease-in-out" aria-label="Edit">
        <button type="button" class="flex items-center" wire:click="edit({{ $machine->id }})">
            <img src="imgs/edit.svg" alt="Edit Icon" class="mr-2">
            <span>Editar</span>
        </button>
      </div>

      <div class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-indigo-100 focus:outline-none focus:bg-indigo-200 transition duration-150 ease-in-out" aria-label="Delete">
        <button @click="isConfirmationVisible = true; machineIdToDelete = 1" type="button" class="flex items-center">
          <img src="imgs/close2.svg" alt="Delete Icon" class="mr-2">
          <span>Delete</span>
        </button>
      </div>
    </div>
  </div>

  <!-- Pop-up de Confirmação -->
  <div x-show="isConfirmationVisible" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded p-4">
      <p>Tem certeza de que deseja excluir a máquina <span class="bg-yellow-200">"{{ $machine->machine_name }}"</span> ?</p>
      <div class="flex justify-end mt-4">
        <button @click="isConfirmationVisible = false" class="px-4 py-2 bg-gray-300 rounded">Cancelar</button>
        <button wire:click="delete({{ $machine->id }})" @click="isConfirmationVisible = false" class="px-4 py-2 bg-red-500 text-white rounded ml-4">Excluir</button>
      </div>
    </div>
  </div>
</div>
