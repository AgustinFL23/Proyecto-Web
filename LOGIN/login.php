<?php
session_start();
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

// Procesar formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameS = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para verificar usuario y contraseña
    $sql = "SELECT id_Usuario, password FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usernameS);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // Verificar contraseña usando password_verify()
        if (password_verify($password, $stored_password)) {
            // Contraseña válida, iniciar sesión
            $_SESSION['id_Usuario'] = $id_usuario;
            $_SESSION['username'] = $usernameS;
            var_dump($_SESSION);
            header("Location: ../HTML/index.html");
            
             // Verifica qué hay en $_SESSION // Redirigir a la página de bienvenida
            exit();
        } else {
            // Contraseña incorrecta
            echo "<script>alert('Usuario o contraseña incorrectos.'); window.location.href='login.html';</script>";
        }
    } else {
        // Usuario no encontrado
        echo "<script>alert('Usuario o contraseña incorrectos.'); window.location.href='login.html';</script>";
    }

    // Cerrar statement y conexión
    $stmt->close();
    $conn->close();
}
?>
