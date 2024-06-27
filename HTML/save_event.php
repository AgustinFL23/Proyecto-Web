<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xmlContent = file_get_contents('php://input');
    $directory = 'events';
    
    // Crear el directorio si no existe
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }

    $fileName = $directory . '/event_' . time() . '.xml';

    if (file_put_contents($fileName, $xmlContent)) {
        echo 'Archivo XML guardado exitosamente.';
    } else {
        echo 'Error al guardar el archivo XML.';
    }
} else {
    echo 'Método no soportado.';
}
?>