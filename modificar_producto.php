<?php
include 'config.php';
// Obtener datos del formulario
$id = $_REQUEST['id'];

$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];

$sql = "UPDATE productos SET nombre='$nombre', precio='$precio', descripcion='$descripcion' WHERE id= '$id'";

$resultado = $conn->query($sql);

if ($resultado){
    $response['success'] = true;
    $response['message'] = "El producto se ha modificado exitosamente.";
}
else{
    $response['success'] = false;
    $response['message'] = "Hubo problemas al modificar el producto.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resultado de la inserción</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Resultado de la edición del producto"/>
</head>
<body>
<script>
    // Procesa la respuesta del servidor
    var response = <?php echo json_encode($response); ?>;
    if (response.success) {
        // Muestra un aviso de éxito
        alert(response.message);
        // Redirige al usuario a "productos.php"
        window.location.href = 'crud.php';
    } else {
        // Muestra un aviso de error si la inserción falló
        alert(response.message);
    }
</script>
</body>
</html>