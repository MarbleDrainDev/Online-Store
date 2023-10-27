<?php
include 'config.php';

// Suponiendo que ya tengas una conexión a la base de datos ($conn) y el ID de la imagen ($id)
$sql = "SELECT Imagen FROM productos WHERE id = 25";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imagenCodificada = $row['Imagen'];

    // Guarda la imagen en el servidor para verificarla
    file_put_contents('imagen_prueba.jpg', $imagenCodificada);

    // A partir de aquí, puedes continuar con tu lógica
    // ...

} else {
    $response = array(
        'success' => false,
        'message' => 'Imagen no encontrada'
    );
}
?>
