const openCreateMachineBtn = document.querySelector("#open-create-modal");
const openCreateMachineBtn2 = document.querySelector("#open-create-modal-2");
const openCreateMachineBtn3 = document.querySelector("#open-create-modal-3");
const createMachineModal = document.querySelector("#createMachineModal");
const backgroundModal = document.querySelector(".background-modal");
const createMachineCloseButton = document.querySelector(".close-createMachine");
const submitBtn = document.querySelector("#submit-btn");
const cardRender = document.querySelector("#card-render");
const machineNameInput = document.querySelector("#machine-name");
const machineCounter = document.querySelector("#machine-counter");
const machineCreateDone = document.querySelector(".modal-create-done");
const successDiv = document.createElement("div");
const modalSuccessDivBg = document.createElement("div");

let counter = 0;

function createMachineOpen() {
  createMachineModal.classList.add("modal-create-wrapper-active");
}
function createMachineClose() {
  createMachineModal.classList.remove("modal-create-wrapper-active");

  if (cardMachine) {
    const machineHome = document.querySelector(".main-home-content");
    machineHome.classList.add("close-machine-home");
    const machineBoard = document.querySelector(".machine-board");
    machineBoard.classList.add("board-machine-open");
  }
}
modalSuccessDivBg.addEventListener("click", function () {
  modalSuccessDivBg.classList.add("successDivBgRemove");
});
openCreateMachineBtn.addEventListener("click", createMachineOpen);
openCreateMachineBtn2.addEventListener("click", createMachineOpen);
openCreateMachineBtn3.addEventListener("click", createMachineOpen);
backgroundModal.addEventListener("click", createMachineClose);
createMachineCloseButton.addEventListener("click", createMachineClose);

document.querySelectorAll(".drop-zone--input").forEach((inputElement) => {
  const dropZoneElement = inputElement.closest(".drop-zone");

  dropZoneElement.addEventListener("click", (e) => {
    inputElement.click();
  });

  inputElement.addEventListener("change", (e) => {
    if (inputElement.files.length) {
      updateThumbnail(dropZoneElement, inputElement.files[0]);
    }
  });

  dropZoneElement.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZoneElement.classList.add("drop-zone--over");
  });

  ["dragleave", "dragend"].forEach((type) => {
    dropZoneElement.addEventListener(type, (e) => {
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });

  dropZoneElement.addEventListener("drop", (e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
      inputElement.files = e.dataTransfer.files;
      updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
    }

    dropZoneElement.classList.remove("drop-zone--over");
  });
});

/**
 * Updates the thumbnail on a drop zone element.
 *
 * @param {HTMLElement} dropZoneElement
 * @param {File} file
 */
function updateThumbnail(dropZoneElement, file) {
  let thumbnailElement = dropZoneElement.querySelector(".drop-zone--thumb");

  // First time - remove the prompt
  if (dropZoneElement.querySelector(".drop-zone--prompt")) {
    dropZoneElement.querySelector(".drop-zone--prompt").remove();
  }

  // First time - there is no thumbnail element, so lets create it
  if (!thumbnailElement) {
    thumbnailElement = document.createElement("div");
    thumbnailElement.classList.add("drop-zone--thumb");
    dropZoneElement.appendChild(thumbnailElement);
  }

  if (file) {
    thumbnailElement.dataset.label = file.name;

    // Show thumbnail for image files
    if (file.type.startsWith("image/")) {
      const reader = new FileReader();

      reader.readAsDataURL(file);
      reader.onload = () => {
        thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
      };
    } else {
      thumbnailElement.style.backgroundImage = null;
    }
  }
}
let cardMachine;
function renderImage(inputElement) {
  cardMachine = document.createElement("div");
  const file = inputElement.files[0];

  const img = document.createElement("img");
  img.src = URL.createObjectURL(file);

  cardMachine.classList.add("cardMachine");
  cardMachine.appendChild(img);

  const machineName = document.createElement("p");
  machineName.textContent = machineNameInput.value;

  const viewsLikeAndSettings = document.createElement("div");
  viewsLikeAndSettings.classList.add("views-like-and-settings");

  const viewsCard = document.createElement("div");
  viewsCard.classList.add("views-card");

  const viewCardImage = document.createElement("img");
  viewCardImage.classList.add("view-card-image");
  viewCardImage.src = "./imgs/views-card.svg";

  const viewCardQtd = document.createElement("span");
  viewCardQtd.classList.add("view-card-qtd");
  viewCardQtd.innerText = "1380";

  const likeCard = document.createElement("div");
  likeCard.classList.add("like-card");

  const likeCardImage = document.createElement("img");
  likeCardImage.classList.add("like-card-image");
  likeCardImage.src = "./imgs/views-card.svg";

  const likeCardQtd = document.createElement("span");
  likeCardQtd.classList.add("like-card-qtd");
  likeCardQtd.innerText = "24";

  const settingsCard = document.createElement("div");
  settingsCard.classList.add("settings-card");

  const settingsCardimg = document.createElement("img");
  settingsCardimg.classList.add("settings-card-image");
  settingsCardimg.src = "./imgs/settings.svg";

  settingsCardimg.appendChild(settingsCard);

  likeCard.appendChild(likeCardImage);
  likeCard.appendChild(likeCardQtd);

  viewsCard.appendChild(viewCardImage);
  viewsCard.appendChild(viewCardQtd);

  viewsLikeAndSettings.appendChild(viewsCard);
  viewsLikeAndSettings.append(likeCard);
  viewsLikeAndSettings.appendChild(settingsCardimg);

  cardMachine.appendChild(machineName);
  cardMachine.appendChild(viewsLikeAndSettings);
  cardRender.appendChild(cardMachine);

  // Clear thumbnail
  const thumbnailElement = inputElement
    .closest(".drop-zone")
    .querySelector(".drop-zone--thumb");
  thumbnailElement.style.backgroundImage = null;

  // seu código para renderizar o cardMachine
  counter++;
  machineCounter.textContent = counter;

  modalSuccessDivBg.classList.add("modalSuccessDivBg");
  modalSuccessDivBg.classList.remove("successDivBgRemove");

  successDiv.innerHTML = `<img src="./imgs/close.svg" alt="" class="close-createMachine-img2" /> <img class="successDivImg" src="./imgs/confirmation-create-machine.svg"/> <p class="successDivTitle">Máquina de vendas criada com sucesso!</p> <p class="successDivText">Aproveite o máximo possível da sua máquina de vendas, envie e monitore lista de emails</p> <p class="successDivButton">ENTENDIDO</p>`;
  successDiv.classList.add("successDiv");

  modalSuccessDivBg.appendChild(successDiv);
  cardRender.appendChild(modalSuccessDivBg);

  // remove a div de sucesso após 3 segundos
  // setTimeout(() => {
  //   successDiv.remove();
  // }, 3000);
}

submitBtn.addEventListener("click", function (event) {
  event.preventDefault();

  // Get the input element
  const inputElement = document.querySelector(".drop-zone--input");

  // Render the image
  renderImage(inputElement);

  // Reset the input element
  inputElement.value = "";
  machineNameInput.value = "";
  // Close the modal
  createMachineClose();
});
