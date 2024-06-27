document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();

        let eventType = document.getElementById('evento').value;
        let eventDate = document.getElementById('calendario').value;
        let eventTime = document.getElementById('horaSelect').value;
        let eventMenu = document.getElementById('meal-options').value;

        let xmlContent = '<?xml version="1.0" encoding="UTF-8"?>\n';
        xmlContent += '<!DOCTYPE event SYSTEM "event.dtd">\n';

        xmlContent += '<event>\n';
        xmlContent += `    <type>${eventType}</type>\n`;
        xmlContent += `    <date>${eventDate}</date>\n`;
        xmlContent += `    <time>${eventTime}</time>\n`;
        xmlContent += `    <menu>${eventMenu}</menu>\n`;
        xmlContent += '</event>';

        // Enviar el XML al servidor
        fetch('save_event.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/xml'
            },
            body: xmlContent
        })
        .then(response => response.text())
        .then(data => {
            alert('Evento creado con éxito');
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

function updateCombobox() {
    let timeValue = document.getElementById("horaSelect").value;

    // Verificar si se obtuvo un valor
    if (!timeValue) {
        console.log("No se seleccionó ninguna hora.");
        alert("Por favor, selecciona una hora.");
        return;
    }

    let [hours, minutes] = timeValue.split(":").map(Number);
    let MenuOpc = [];
    if (hours < 12) {
        MenuOpc = ["Desayuno continental", "Desayuno mexicano", "Desayuno mediterráneo"];
    } else if (hours < 18) {
        MenuOpc = ["Tartar de atún con aguacate", "Pollo con verduras al horno", "Portobellos Rellenos"];
    } else {
        MenuOpc = ["Pasta Carbonara", "Salmón con esparragos", "Tacos de carne asada con guacamole"];
    }
    let mealSelect = document.getElementById("meal-options");

    mealSelect.innerHTML = "";
    MenuOpc.forEach(function(option) {
        var newOption = document.createElement("option");
        newOption.value = option;
        newOption.text = option;
        mealSelect.appendChild(newOption);
    });
}
