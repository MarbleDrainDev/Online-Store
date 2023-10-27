<?php
include 'config.php';
// Obtener datos del formulario
$id = $_REQUEST['id'];

$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];

$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

$sql = "UPDATE productos SET nombre='$nombre', precio='$precio', descripcion='$descripcion', imagen='$imagen' WHERE id= '$id'";

$resultado = $conn->query($sql);

if ($resultado){
    header("location:crud.php");
}
else{
    echo "hubo problemas al modificarse";
}



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