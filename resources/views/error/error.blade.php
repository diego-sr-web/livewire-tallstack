<x-app-layout>
  <div class="main-home-wrapper">     

    @include('layouts.sidebar')
      
    <div class="main-home-content">
        <div class="flex justify-center items-start min-h-screen">
            <div class="w-full p-3">
              <div class="error-container">

                <h1>Erro</h1>
                <p>Ocorreu um erro ao processar sua solicitação.</p>

            <p>{{ is_array(session('error')) ? implode(', ', session('error')) : session('error') }}</p>

           
              </div>
            </div>    
        </div>    
    </div>
  </div>

</x-app-layout>


