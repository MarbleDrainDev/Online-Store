<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "mi_tienda"; // Nombre de la base de datos

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
