const selectD = document.getElementById('deporteElegido');
const boton = document.getElementById('miBoton');
//Borrar
const volverBtn = document.querySelector("#volverBtn");
volverBtn.addEventListener("click", ()=>{
 window.location.href = "../../index.html";
});
//Guardar
const borrar = document.querySelector("#borrar");
borrar.addEventListener("click", function (){
  window.location.href = "borrar.html";
})
const formModificacion = document.querySelector("#formModificacion");
formModificacion.addEventListener("click", ()=>{
  window.location.href = "modificar.html";
});
const formModificacionC = document.querySelector("#formModificacionC");
formModificacionC.addEventListener("click", ()=>{
  window.location.href = "modificarC.html";
});


// Función para manejar el cambio en el select
function handleSelectChange() {
  if (selectD.classList.contains('abierto')) {
    boton.style.marginTop = '40px'; // Ajusta según sea necesario
  } else {
    boton.style.marginTop = '0';
  }
}

// Listener para el evento 'change' del select
selectD.addEventListener('change', function() {
  handleSelectChange();
});

// Listener para el evento 'focus' del select
selectD.addEventListener('focus', function() {
  selectD.classList.add('abierto');
  handleSelectChange();
});

// Listener para el evento 'blur' del select
selectD.addEventListener('blur', function() {
  selectD.classList.remove('abierto');
  handleSelectChange();
});

// Listener para el clic en cualquier parte del documento
document.addEventListener('click', function(event) {
  if (!event.target.matches('#deporteElegido')) {
    selectD.classList.remove('abierto');
    handleSelectChange();
  }
});
function redirigir() {
    setTimeout(function() {
        window.location.href = 'index.html';
    }, 2000);
}
