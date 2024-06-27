<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Proyecto PHP</title>
</head>
<body>
    <h1>Bienvenido a mi Proyecto PHP</h1>

    <?php
    // Código PHP para conectar a la base de datos y crear tablas
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "saloneventos";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    echo "<p>Conectado exitosamente a la base de datos</p>";

    $conn->close();
    ?>
</body>
</html>