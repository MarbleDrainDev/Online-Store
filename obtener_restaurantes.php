<?php
include 'config.php'; // Incluir el archivo de conexión

$sql = "SELECT Nombre, Direccion FROM Restaurante"; // Consulta SQL para obtener los nombres y direcciones de los restaurantes
$result = $conn->query($sql);

$restaurants = array(); // Array para almacenar los datos de los restaurantes

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $restaurant = array(
            'name' => $row['Nombre'],
            'availability' => $row['Direccion'],
            'img' => 'https://www.apple.com/v/ipad-pro/al/images/meta/ipad-pro_overview__glcw458o4byq_og.png?202305310334'
        );
        array_push($restaurants, $restaurant); // Agregar el restaurante al array
    }
}

// Convertir el array de restaurantes a formato JSON y devolverlo
echo json_encode($restaurants);

$conn->close(); // Cerrar la conexión
?>