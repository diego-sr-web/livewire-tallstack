<div class="main-home-content">
  <div class="home-content">      
    <!-- Evento de modal -->
    <div x-cloak x-data="{ 
      AddMachineModal: @entangle('AddMachineModal'),
      ConfirmMachineModal: @entangle('ConfirmMachineModal') }"
    >
    
    <img src="./imgs/image-content.png" alt="" class="image-maquinas"/>
  
    <p class="content-maquinas-text1">
        Você ainda não possuí máquinas criadas
    </p>
  
    <p class="content-maquinas-text2">
        Crie a sua primeira audiência clicando no botão abaixo
    </p>

    <div class="button-div" >
      <button class="button-create" type="button" @click="AddMachineModal = true">
        CRIAR MÁQUINA</button>
      </div>

    @include('livewire.templates.modal')

    </div>      
  </div>
</div>