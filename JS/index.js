var elementos = document.querySelectorAll('.Arrastrable');
function manejarClic(evento) {
  var idElemento = evento.target.id; 
  console.log("ID del elemento: " + idElemento); 
}
elementos.forEach(function(elemento) {
  elemento.addEventListener('click', manejarClic);
});
