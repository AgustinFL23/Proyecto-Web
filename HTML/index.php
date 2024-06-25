<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    die("Error: Usuario no ha iniciado sesión.");
}

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "root";
$database = "saloneventos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la opción seleccionada del combobox
    $selectedEvent = $_POST['evento'];
    $selectedDate = $_POST['calendario'];
    $selectedTime = $_POST['horaSelect'];
    $selectedOption = $_POST['meal-option'];
    $usernameS = $_SESSION['username'];

    // Obtener el ID de usuario
    $sql_select = "SELECT id_Usuario FROM usuarios WHERE email = ?";
    $stmt_s = $conn->prepare($sql_select);
    $stmt_s->bind_param("s", $usernameS);
    $stmt_s->execute();

    // Vincular resultado
    $stmt_s->bind_result($id);

    // Obtener resultado
    $stmt_s->fetch();

    // Cerrar statement de la consulta SELECT
    $stmt_s->close();

    // Preparar y ejecutar la consulta para guardar el evento
    $sql_insert = "INSERT INTO eventos (id_Usuario, tipo_Evento, fecha, hora, menu) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("issss", $id, $selectedEvent, $selectedDate, $selectedTime, $selectedOption);

    if ($stmt_insert->execute()) {
        echo "Evento guardado con éxito.";
    } else {
        echo "Error al guardar el evento: " . $stmt_insert->error;
    }

    // Cerrar statement de la consulta INSERT
    $stmt_insert->close();
    
    // Cerrar conexión
    $conn->close();
}
?>
