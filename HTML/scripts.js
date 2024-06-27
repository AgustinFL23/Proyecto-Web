// scripts.js

document.addEventListener("DOMContentLoaded", function() {
    var draggableElements = document.querySelectorAll('.draggable');
    var dropArea = document.getElementById('dropArea');

    // Agregar eventos para elementos arrastrables
    draggableElements.forEach(function(element) {
        element.addEventListener('dragstart', function(ev) {
            ev.dataTransfer.setData("text", ev.target.src);
        });
    });

    // Permitir soltar elementos en dropArea
    dropArea.addEventListener('dragover', function(ev) {
        ev.preventDefault();
    });

    dropArea.addEventListener('drop', function(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");

        // Crear un nuevo elemento y configurar sus propiedades
        var draggedElement = document.createElement("img");
        draggedElement.src = data;
        draggedElement.className = "draggable";
        draggedElement.style.left = (ev.clientX - ev.target.getBoundingClientRect().left - 40) + "px";
        draggedElement.style.top = (ev.clientY - ev.target.getBoundingClientRect().top - 40) + "px";

        // Agregar el nuevo elemento al área de soltado
        ev.target.appendChild(draggedElement);

        // Configurar el evento para eliminar el elemento al hacer clic
        draggedElement.addEventListener("click", function() {
            eliminarImagen(draggedElement);
        });
    });

    // Función para eliminar una imagen al hacer clic
    function eliminarImagen(elemento) {
        elemento.remove();
    }
});
