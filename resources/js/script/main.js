
// // Evento de submissão do formulário
// // document.getElementById('create-form').addEventListener('submit', function(event) {
// //   event.preventDefault(); 

// //   const dropZoneElement = document.querySelector(".drop-zone");
// //   const inputElement = dropZoneElement.querySelector(".drop-zone--input");
// //   const file = inputElement.files[0];
// //   const machineNameElement = document.getElementById('machine-name');
// //   const machineName = machineNameElement.value;

// //   const isImageValid = validateImage(file);
// //   const isMachineNameValid = validateMachineName(machineName);

// //   if (isImageValid && isMachineNameValid) {
// //     Livewire.emit('submitForm');  

// //     updateThumbnail(dropZoneElement, null);// Limpar a imagem temporária
// //     inputElement.value = ""; // Limpar o valor do input de arquivo
// //   }
// // });

// function validateImage(file) {
//   const imageErrorElement = document.getElementById('image-error');

//   if (!file) {
//     imageErrorElement.textContent = "Nenhuma imagem selecionada.";
//     return false;
//   }

//   const fileSizeInMB = file.size / (1024 * 1024);
//   const maxSizeInMB = 2;
  
//   if (fileSizeInMB > maxSizeInMB) {
//     imageErrorElement.textContent = `O tamanho máximo é ${maxSizeInMB} MB.`;
//     return false;
//   } else {
//     imageErrorElement.textContent = "";// Limpa a mensagem de erro se a imagem for válida
//     return true;
//   }
// }

// function validateMachineName(machineName) {
//   const machineNameErrorElement = document.getElementById('machine-name-error');

//   if (!machineName) {
//     machineNameErrorElement.textContent = "O nome da máquina é obrigatório.";
//     return false;
//   }
//     machineNameErrorElement.textContent = "";
//     return true;
// }

// // Eventos para manipular a entrada de arquivo
// document.querySelectorAll(".drop-zone--input").forEach((inputElement) => {
//   const dropZoneElement = inputElement.closest(".drop-zone");
//   // Evento de clique na área de soltar
//   dropZoneElement.addEventListener("click", (e) => {
//     inputElement.click();
//   });
//   // Evento de alteração da entrada de arquivo
//   inputElement.addEventListener("change", (e) => {
//     if (inputElement.files.length) {
//       updateThumbnail(dropZoneElement, inputElement.files[0]);
//     }
//   });
//   // Evento de arrastar sobre a área de soltar
//   dropZoneElement.addEventListener("dragover", (e) => {
//     e.preventDefault();
//     dropZoneElement.classList.add("drop-zone--over");
//   });
//   // Eventos de "sair do arrasto" e "arrasto terminado" na área de soltar
//   ["dragleave", "dragend"].forEach((type) => {
//     dropZoneElement.addEventListener(type, (e) => {
//       dropZoneElement.classList.remove("drop-zone--over");
//     });
//   });
//   // Evento de soltar na área de soltar
//   dropZoneElement.addEventListener("drop", (e) => {
//     e.preventDefault();

//     if (e.dataTransfer.files.length) {
//       inputElement.files = e.dataTransfer.files;
//       inputElement.dispatchEvent(new Event('change')); // Chamar explicitamente o evento change
//       updateThumbnail(dropZoneElement, inputElement.files[0]);
//     }
//     dropZoneElement.classList.remove("drop-zone--over");
//   });
// });

// function updateThumbnail(dropZoneElement, file) {
//   let thumbnailElement = dropZoneElement.querySelector(".drop-zone--thumb");

//   if (thumbnailElement) {
//     thumbnailElement.remove();
//   }
//   // Crie novamente o elemento inicial com seu HTML original
//   thumbnailElement = document.createElement("div");
//   thumbnailElement.classList.add("drop-zone--thumb");
//   thumbnailElement.innerHTML = `
//   <span class="drop-zone-prompt"></span>    
//   <label class="drop-zone--label"></label>
//   `;

//   dropZoneElement.appendChild(thumbnailElement);

//   if (file) {
//     thumbnailElement.querySelector(".drop-zone--label").textContent = file.name;

//     if (file.type.startsWith("image/")) {
//       const reader = new FileReader();

//       reader.readAsDataURL(file);
//       reader.onload = () => {
//         thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
//       };
//     } else {
//       thumbnailElement.style.backgroundImage = null;
//     }

//   } else {
//       // Limpar a imagem quando o arquivo for nulo
//       thumbnailElement.style.backgroundImage = null;
//       thumbnailElement.querySelector(".drop-zone--label").textContent = ""; // Limpar o nome do arquivo
//     }
// }
  
// // document.addEventListener('livewire:load', function () {
// //   Livewire.on('loadExistingImage', image => {
// //     const dropZoneElement = document.querySelector(".drop-zone");

// //     // Verifica se o elemento .drop-zone--thumb já existe
// //     const thumbnailElement = dropZoneElement.querySelector(".drop-zone--thumb");
// //     if (thumbnailElement) {
// //       thumbnailElement.remove(); // Remove o elemento existente, se houver
// //     }

// //     // Define o background e adiciona a classe .drop-zone--thumb ao elemento
// //     dropZoneElement.style.backgroundImage = `url('storage/${image}')`;
// //     dropZoneElement.classList.add("drop-zone--thumb");

// //     // Adicione o CSS para a classe .drop-zone--thumb
// //     dropZoneElement.style.width = "214px";
// //     dropZoneElement.style.height = "128px";
// //     dropZoneElement.style.backgroundSize = "cover";
// //     dropZoneElement.style.backgroundPosition = "center";
// //   });

// //   Livewire.on('clearThumb', () => {
// //     const dropZoneElements = document.querySelectorAll(".drop-zone--thumb[style*='background']");
// //     dropZoneElements.forEach((dropZoneElement) => {
// //         dropZoneElement.style.background = "none";
// //         const fileLabelElement = dropZoneElement.querySelector("label");
// //         if (fileLabelElement) {
// //             fileLabelElement.textContent = ""; // Remove o conteúdo do elemento label
// //             fileLabelElement.classList.remove("drop-zone--label");
// //         }
// //     });
// //   });
  
// // });
// // Adiciona um event de timeout na resposta de erro
// // document.getElementById('submit-btn').addEventListener('click', function() {
// //   const timeoutElements = document.getElementsByClassName('timeout-validate');

// //   if (timeoutElements.length > 0) {
// //     for (const element of timeoutElements) {
// //       setTimeout(function() {
// //         element.style.opacity = 0;//Efeito fade
// //         setTimeout(function() {
// //           element.textContent = "";
// //           element.style.opacity = 1;//Efeito fade
// //         }, 500);
// //       }, 5000);
// //     }
// //   }
// // });