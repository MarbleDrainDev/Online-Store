<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registrar_pedido.css">
    <title>Registrar Pedido</title>
</head>
<body>
    <h2>Registrar Pedido</h2>

    <?php
    // Conexión a la base de datos
    $conexion = new mysqli('localhost:3306', 'root', '', 'restaurante');

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO Restaurante (Nombre, Direccion, Id_Numero_telefono) VALUES ('$nombre', '$direccion', '$telefono')";
    if ($conexion->query($sql) === TRUE) {
        echo "<p>Registro exitoso. ¡Bienvenido!</p>";
    } else {
        echo "<p>Error al registrar el restaurante: " . $conexion->error . "</p>";
    }

    // Cerrar la conexión
    $conexion->close();
    ?>
</body>
</html>
