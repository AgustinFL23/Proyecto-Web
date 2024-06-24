<?php
// Configuración de la conexión a la base de datos
$servername = "localhost"; // Nombre del servidor MySQL (generalmente localhost)
$username_db = "root"; // Usuario de la base de datos MySQL
$password_db = "root"; // Contraseña de la base de datos MySQL
$database = "saloneventos"; // Nombre de la base de datos
// Crear conexión
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $campo1 = $_POST['campo1'];
    $campo4 = $_POST['campo4'];

    // Preparar la consulta SQL
    // Crear una tabla si no existe
    
    $sql = "INSERT INTO pruebas (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }

    // Vincular parámetros
    // Las letras en "ssds" representan los tipos de datos de los parámetros:
    // s - string (cadena)
    // i - integer (entero)
    // d - double (decimal)
    // b - blob (datos binarios)
    $stmt->bind_param("ss", $campo1, $campo4);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error al insertar datos: " . $stmt->error;
    }

    // Cerrar la conexión y el statement
    $stmt->close();
    $conn->close();
}
?>
