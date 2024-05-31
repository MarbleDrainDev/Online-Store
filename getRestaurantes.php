<?php
// Conexión a la base de datos
$servername = "localhost:3306";
$username = "root";
$password = "G0r1ll4szoe120.";
$dbname = "restaurante";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener los restaurantes
$sql = "SELECT Nombre, Direccion FROM Restaurante";
$result = $conn->query($sql);

$restaurantes = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $restaurantes[] = $row;
    }
}

$conn->close();

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($restaurantes);
?>
