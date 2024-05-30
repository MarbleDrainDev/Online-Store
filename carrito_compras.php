<?php
// Establecer la conexión con la base de datos (reemplaza 'host', 'usuario', 'contraseña' y 'basededatos' con tus propios datos)
$conexion = new mysqli('localhost:3306', 'root', '', 'restaurante');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se ha enviado el formulario de compra
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
    // Obtener el ID del producto desde el formulario
    $id_producto = $_POST['id_producto'];
    $id_estudiante = 1; // Supongamos que el ID del estudiante es 1 (puedes ajustar esto según tu sistema)
    $cantidad = 1; // Supongamos que la cantidad es 1 por ahora

    // Insertar el producto en el carrito de compras
    $sql_insertar = "INSERT INTO Carrito_Compras (ID_Estudiante, ID_Comida, Cantidad) VALUES ($id_estudiante, $id_producto, $cantidad)";
    if ($conexion->query($sql_insertar) === TRUE) {
        echo "Producto agregado al carrito correctamente.";
    } else {
        echo "Error al agregar el producto al carrito: " . $conexion->error;
    }
}

// Verificar si se ha enviado el formulario para eliminar un producto del carrito
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_carrito'])) {
    // Obtener el ID del producto del carrito desde el formulario
    $id_carrito = $_POST['id_carrito'];

    // Consulta SQL para eliminar el producto del carrito
    $sql_eliminar = "DELETE FROM Carrito_Compras WHERE ID_Carrito = $id_carrito";
    if ($conexion->query($sql_eliminar) === TRUE) {
        echo "Producto eliminado del carrito correctamente.";
    } else {
        echo "Error al eliminar el producto del carrito: " . $conexion->error;
    }
}

// Obtener productos del carrito de compras del estudiante (supongamos que el ID del estudiante es 1)
$id_estudiante = 1;
$sql_carrito = "SELECT cc.ID_Carrito, c.Nombre, c.Precio, cc.Cantidad FROM Carrito_Compras cc INNER JOIN Comida c ON cc.ID_Comida = c.ID_Comida WHERE cc.ID_Estudiante = $id_estudiante";
$resultado_carrito = $conexion->query($sql_carrito);

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/carrito_compras.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">

    <title>Carrito de Compras</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <h1>Unicart</h1>
            </div>
            <div class="boton">
                <label for="btn-menu">Menu</label>
            </div>
            <input type="checkbox" name="" id="btn-menu">
            <nav class="menu">
                <a href="index.php" class="inicio">Inicio</a>
                <a href="carrito_compras.php">Carrito</a>
                <a href="register.html" class="modelos">Register</a>
                <a href="login.html" class="modelos">Login</a>
            </nav>
        </div>
    </header>

    <section class="primary">
        <h2>Carrito de Compras</h2>
        <?php if ($resultado_carrito->num_rows > 0) : ?>
            <?php while ($fila = $resultado_carrito->fetch_assoc()) : ?>
                <div class="info">
                    <p><?php echo $fila['Nombre']; ?> - $<?php echo $fila['Precio']; ?></p>
                    <!-- Formulario para eliminar productos del carrito -->
                    <form action="carrito_compras.php" method="POST">
                        <input type="hidden" name="id_carrito" value="<?php echo $fila['ID_Carrito']; ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </div>
            <?php endwhile; ?>
            <!-- Botón para realizar la compra de todos los productos -->
            <form action="seleccionar_pago_ubicacion.php" method="GET">
                <input type="hidden" name="ids_productos" value="1,2,3"> <!-- Ejemplo de IDs de productos -->
                <button type="submit">Realizar Compra</button>
            </form>
        <?php else : ?>
            <p>No hay productos en el carrito de compras.</p>
        <?php endif; ?>
    </section>
    <!-- Tu código HTML para el pie de página aquí... -->
</body>
</html>

