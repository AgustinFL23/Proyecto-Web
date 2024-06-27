<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    echo json_encode(['status' => 'error', 'message' => 'Usuario no ha iniciado sesión.']);
    exit();
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
    echo json_encode(['status' => 'error', 'message' => 'Conexión fallida: ' . $conn->connect_error]);
    exit();
}

// Obtener los eventos del usuario
$usernameS = $_SESSION['username'];
$sql_select = "SELECT id_Usuario FROM usuarios WHERE email = ?";
$stmt_s = $conn->prepare($sql_select);
$stmt_s->bind_param("s", $usernameS);
$stmt_s->execute();
$stmt_s->bind_result($id);
$stmt_s->fetch();
$stmt_s->close();

$sql_select_Eventos = "SELECT tipo_Evento, fecha, hora, menu FROM eventos WHERE id_Usuario = ?";
$stmt_E = $conn->prepare($sql_select_Eventos);
$stmt_E->bind_param("i", $id);
$stmt_E->execute();
$stmt_E->bind_result($tipo_Evento, $fecha, $hora, $menu);

$events = array();
while ($stmt_E->fetch()) {
    $events[] = array(
        'tipo_Evento' => $tipo_Evento,
        'fecha' => $fecha,
        'hora' => $hora,
        'menu' => $menu
    );
}

$stmt_E->close();
$conn->close();

echo json_encode(['status' => 'success', 'events' => $events]);
?>
