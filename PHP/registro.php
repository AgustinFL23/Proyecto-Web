<?php
// Configuración de la conexión a la base de datos
$servername = "localhost"; // Nombre del servidor MySQL (generalmente localhost)
$username_db = "root"; // Usuario de la base de datos MySQL
$password_db = "root"; // Contraseña de la base de datos MySQL
$database = "saloneventos"; // Nombre de la base de datos

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username_db, $password_db, $database);
// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// Recibir datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $userlastname = $_POST['apellido'];
    $email = $_POST['mail'];
    $password = $_POST['password'];

    // Encriptar la contraseña (opcional, pero recomendado)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Preparar y ejecutar la consulta SQL para insertar el usuario en la tabla
    $sql = "INSERT INTO usuarios (nombre, apellido, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }

    $stmt->bind_param("ssss", $username, $userlastname, $email, $hashed_password);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Registro exitoso, redirigir a la página index.html
        header("Location: ../HTML/index.html");
        exit();
    } else {
        echo "Error al insertar datos: " . $stmt->error;
    }

    // Cerrar la conexión y el statement
    $stmt->close();
    $conn->close();
}
?>
