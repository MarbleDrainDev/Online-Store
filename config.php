<?php
// Conexión a la base de datos
$servername = "localhost:3306";
$username = "root";
$password = "G0r1ll4szoe120.";
$database = "restaurante"; // Nombre de la base de datos

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
