<x-app-layout>
  <div class="main-home-wrapper">     

    @include('layouts.sidebar')
    
    <div class="main-home-content-table p-5 overflow-hidden">
      <div class="flex justify-between ">
        <h2 class="text-2xl font-bold">Email - Marketing</h2>
        
        <a 
        href="{{ route('mail-marketing.create') }}"
        class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 hover:text-white transition duration-300 ease-in-out">
          Adicionar
        </a>
        
      </div>
      
      <div class="pt-5">

        <livewire:list-mail-marketing/> 
      
      </div>

    </div>
  </div>  
</x-app-layout> 
