<?php
$servername = "localhost"; // Nombre del servidor de la base de datos
$username = "root";        // Nombre de usuario de la base de datos
$password = "";            // Contraseña de la base de datos
$database = "mi_tienda";   // Nombre de la base de datos
include 'config.php';
// Obtener datos del formulario
$id = $_REQUEST['id'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];

// $Imagen = addslashes(file_get_contents($_FILES['Imagen']['tmp_name']));

// Verificar si se cargó un archivo de imagen
if (isset($_FILES['Imagen']['tmp_name']) && !empty($_FILES['Imagen']['tmp_name'])) {
    $Imagen = addslashes(file_get_contents($_FILES['Imagen']['tmp_name']));
} else {
    // Si no se cargó una imagen, conserva la imagen existente en la base de datos
    $sql = "SELECT Imagen FROM productos WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $Imagen = $row['Imagen'];
}


// Actualizar los datos en la base de datos
$sql = "UPDATE productos SET nombre=?, precio=?, descripcion=?, Imagen=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $nombre, $precio, $descripcion, $Imagen, $id);

if ($stmt->execute()) {
    $response = array(
        'success' => true,
        'message' => 'Producto editado con éxito.'
    );
} else {
    $response = array(
        'success' => false,
        'message' => 'Error al editar el producto: ' . $stmt->error
    );
}

$stmt->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Resultado de la inserción</title>
</head>
<body>
<script>
    // Procesa la respuesta del servidor
    var response = <?php echo json_encode($response); ?>;
    if (response.success) {
        // Muestra un aviso de éxito
        alert(response.message);
        // Redirige al usuario a "productos.php"
        window.location.href = 'productos.php';
    } else {
        // Muestra un aviso de error si la inserción falló
        alert(response.message);
    }
</script>
</body>
</html>