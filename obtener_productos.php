<?php
// Incluir el archivo de configuración de la base de datos
include 'config.php';

// Consulta SQL para obtener los datos de productos
$sql = "SELECT id, nombre, precio, Imagen FROM productos";
$resultados = array();

if ($resultado = $conn->query($sql)) {
    while ($fila = $resultado->fetch_assoc()) {
        $resultados[] = $fila;
    }
    $resultado->close();
} else {
    // Manejar el error de la consulta
    die("Error en la consulta: " . $conn->error);
}

// Devolver los resultados como JSON
header('Content-Type: application/json');
echo json_encode($resultados);
?>
