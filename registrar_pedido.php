<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// Establecer la conexión con la base de datos (reemplaza 'host', 'usuario', 'contraseña' y 'basededatos' con tus propios datos)
$conexion = new mysqli('localhost:3306', 'root', '1234', 'restaurante');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los datos del formulario
$ids_productos = $_POST['ids_productos']; // Array de IDs de productos
$metodo_pago = $_POST['metodo_pago'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$ubicacion = $_POST['ubicacion'];
$numero_telefonico = $_POST['numero_telefonico'];

// Insertar datos en la tabla Estudiante
$sql_insert_estudiante = "INSERT INTO Estudiante (Nombre, Apellido, Email, Fecha_Nacimiento, Ubicacion, ID_Numero_telefonico) VALUES ('$nombre', '$apellido', '$email', '$fecha_nacimiento', '$ubicacion', $numero_telefonico)";
if ($conexion->query($sql_insert_estudiante) === TRUE) {
    $id_estudiante = $conexion->insert_id;

    // Obtener IDs de productos a partir del array y realizar inserción en Historial_Pedido
    $productos = explode(',', $ids_productos);
    foreach ($productos as $id_producto) {
        // Insertar datos en la tabla Historial_Pedido
        $sql_insert_historial = "INSERT INTO Historial_Pedido (ID_Estudiante, ID_Comida, Cantidad, Fecha_Pedido) VALUES ($id_estudiante, $id_producto, 1, NOW())";
        $conexion->query($sql_insert_historial);
    }

    // Insertar datos en la tabla Pago (no incluir ID_HistorialPedido en la lista de columnas)
    $sql_insert_pago = "INSERT INTO Pago (ID_HistorialPedido, ID_MetodoPago, Monto, Fecha_Pago) VALUES (LAST_INSERT_ID(), $metodo_pago, 0.00, NOW())";
    if ($conexion->query($sql_insert_pago) === TRUE) {
        echo "<p>Pedido registrado correctamente.</p>";
    } else {
        echo "<p>Error al registrar el pago: " . $conexion->error . "</p>";
    }
} else {
    echo "<p>Error al registrar al estudiante: " . $conexion->error . "</p>";
}

// Cerrar la conexión
$conexion->close();
?>


</body>
</html>