// scripts.js

function allowDrop(ev) {
    ev.preventDefault();
}

function drop(ev) {
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

    // Configurar el evento para mover el elemento
    draggedElement.addEventListener("mousedown", function(event) {
        var shiftX = event.clientX - draggedElement.getBoundingClientRect().left;
        var shiftY = event.clientY - draggedElement.getBoundingClientRect().top;

        function moveAt(pageX, pageY) {
            draggedElement.style.left = pageX - shiftX - ev.target.getBoundingClientRect().left + "px";
            draggedElement.style.top = pageY - shiftY - ev.target.getBoundingClientRect().top + "px";
        }

        function onMouseMove(event) {
            moveAt(event.pageX, event.pageY);
        }

        document.addEventListener("mousemove", onMouseMove);

        draggedElement.onmouseup = function() {
            document.removeEventListener("mousemove", onMouseMove);
            draggedElement.onmouseup = null;
        };
    });

    
}