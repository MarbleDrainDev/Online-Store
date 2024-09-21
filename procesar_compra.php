<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Compra</title>
</head>
<body>
<?php
// Establecer la conexión con la base de datos (reemplaza 'host', 'usuario', 'contraseña' y 'basededatos' con tus propios datos)
$conexion = new mysqli('localhost:3306', 'root', '1234', 'restaurante');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se ha enviado el formulario de compra
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar_compra'])) {
    // Obtener los datos del formulario
    $ids_productos = $_POST['ids_productos'];
    $id_metodo_pago = $_POST['metodo_pago'];
    $ubicacion = $_POST['ubicacion'];
    $id_estudiante = 1; // Supongamos que el ID del estudiante es 1 (puedes ajustar esto según tu sistema)

    // Obtener la fecha actual
    $fecha_actual = date("Y-m-d");

    // Insertar datos en la tabla Pago
    $sql_pago = "INSERT INTO Pago (ID_Estudiante, ID_MetodoPago, Monto, Fecha_Pago) VALUES ($id_estudiante, $id_metodo_pago, 0.00, '$fecha_actual')";
    if ($conexion->query($sql_pago) === TRUE) {
        // Obtener el ID del pago insertado
        $id_pago = $conexion->insert_id;

        // Insertar datos en la tabla Historial_Pedido para cada producto del carrito
        $productos = explode(",", $ids_productos);
        foreach ($productos as $id_producto) {
            $sql_producto = "SELECT Precio FROM Comida WHERE ID_Comida = $id_producto";
            $resultado_producto = $conexion->query($sql_producto);
            if ($resultado_producto->num_rows > 0) {
                $fila_producto = $resultado_producto->fetch_assoc();
                $precio = $fila_producto['Precio'];
                // Insertar en Historial_Pedido
                $sql_historial = "INSERT INTO Historial_Pedido (ID_Estudiante, ID_Comida, Cantidad, Fecha_Pedido) VALUES ($id_estudiante, $id_producto, 1, '$fecha_actual')";
                if ($conexion->query($sql_historial) === FALSE) {
                    echo "Error al registrar historial de pedido: " . $conexion->error;
                    exit();
                }
            } else {
                echo "Error: Producto no encontrado.";
                exit();
            }
        }

        echo "<h1>Compra realizada correctamente.</h1>";
    } else {
        echo "<h1>Error al procesar la compra: " . $conexion->error . "</h1>";
    }
}

// Cerrar la conexión
$conexion->close();
?>
</body>
</html>
