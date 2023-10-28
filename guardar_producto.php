<?php
$servername = "localhost"; // Nombre del servidor de la base de datos
$username = "root";        // Nombre de usuario de la base de datos
$password = "";            // Contraseña de la base de datos
$database = "mi_tienda";   // Nombre de la base de datos
include 'config.php';
// Obtener datos del formulario
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];

$Imagen = addslashes(file_get_contents($_FILES['Imagen']['tmp_name']));

// Insertar datos en la base de datos
$sql = "INSERT INTO productos(nombre, precio, descripcion, Imagen) VALUES ('$nombre', '$precio', '$descripcion', '$Imagen')";

if ($conn->query($sql) === TRUE) {
    $response = array(
        'success' => true,
        'message' => 'Producto guardado con éxito.'
    );
 } else {
     $response = array(
         'success' => false,
         'message' => 'Error al guardar el producto: ' . $conn->error
     );
 }

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resultado de la inserción</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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