<x-app-layout>
  <div class="main-home-wrapper">     

    @include('layouts.sidebar')
    <x-loading.modal wire:loading />  
    <div class="main-home-content-table p-5 overflow-hidden">
      <div class="flex justify-between ">
          <h2 class="text-2xl font-bold">Lista de Meis</h2>
          
            <a onclick="Livewire.emit('openModal', 'panel.list-meis.mei-form', { isEdit: false })"
                href="javascript:;" 
                class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 hover:text-white transition duration-300 ease-in-out">
              Adicionar</a>
      </div>
      
      <div class="pt-5">

        <livewire:panel.list-meis.list-meis/>

      </div>

    </div>
  </div>  
</x-app-layout> 
    