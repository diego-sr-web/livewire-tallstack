<!-- Form -->
<div x-show="AddMachineModal" class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50">
<div id="createMachineModal">
  <div class="modal-create">
    <div class="close-createMachine">
        <img src="./imgs/close.svg" wire:click="closeModal" alt="" class="close-createMachine-img"/>
    </div>
    <p class="modal-create-title">
        {{ $isEditing ? 'Editar máquina de vendas' : 'Nova máquina de vendas' }}
    </p>
    <p class="modal-create-text">
        Você pode {{ $isEditing ? 'Editar' : 'criar' }}
        uma nova máquina de vendas preenchendo corretamente os dados abaixo
    </p>

    <form wire:submit.prevent="submitForm" wire:ignore class="create-form" id="create-form" enctype="multipart/form-data">
        @csrf
        <span id="machine-name-error" class="timeout-validate text-red-500"></span>
        <input wire:model.lazy="machine_name" wire:ignore type="text" name="machine_name" placeholder="Nome da máquina" id="machine-name" class="create-input-name"/>
        <span class="input-file-title">Imagem da capa</span>
        <span id="image-error" class="timeout-validate text-red-500"></span>
        <div class="drop-zone-area">
        <div class="drop-zone">
            <span class="drop-zone-prompt">Clique ou arraste a imagem</span>
            <input wire:model="file" wire:ignore type="file" name="file" id="fileInput" class="drop-zone--input">
        </div>
        <p class="drop-zone-text">
            A dimensão recomendada é de <strong>1600 x 838</strong> (mesma proporção do formato utilizado nas páginas de evento no Facebook).
            Formato <strong>JPEG, GIF ou PNG</strong> de no máximo <strong>2MB.</strong> Imagens com dimensões diferentes serão redimensionadas.
        </p>
        </div>

        <div wire:loading.attr="disabled" class="button-div">
        <button wire:loading.class="button-loading" id="submit-btn" class="button-create">
            SALVAR
        </button>
        </div>
        <div wire:loading>
            <img src="/imgs/loading.gif" style="height: 30px;">
        </div>
    </form>
  </div>
</div>
</div>
<!-- Popup de confirmação -->
<div x-show="ConfirmMachineModal" x-cloak
    class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50">

  <div class="modalSuccessDivBg1 successDivBgRemove1">
    <div class="successDiv">
    <img @click="ConfirmMachineModal = false"
        src="./imgs/close.svg" alt="" class="close-createMachine-img2">
    <img class="successDivImg" src="./imgs/confirmation-create-machine.svg">
    <p class="successDivTitle">Sucesso operação realizada!</p>
    <p class="successDivText">Aproveite o máximo possível da sua máquina de vendas, envie e monitore lista de emails</p>
    <p class="successDivButton" @click="ConfirmMachineModal = false">ENTENDIDO!</p>
    </div>
</div>
