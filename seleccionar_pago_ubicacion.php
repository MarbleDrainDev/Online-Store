<?php
// Conectar a la base de datos (reemplaza 'host', 'usuario', 'contraseña' y 'basededatos' con tus propios datos)
$conexion = new mysqli('localhost:3306', 'root', '1234', 'restaurante');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los IDs de los productos a comprar desde el formulario
$ids_productos = $_GET['ids_productos']; // Esto debería ser un array de IDs separados por comas

// Consulta SQL para obtener los métodos de pago disponibles
$sql_metodos_pago = "SELECT ID_MetodoPago, Nombre FROM MetodoPago";
$resultado_metodos_pago = $conexion->query($sql_metodos_pago);

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/seleccionar_pago_ubicacion.css">
    <title>Seleccionar Método de Pago y Ubicación</title>
</head>
<body>
    <h2>Seleccionar Método de Pago y Ubicación</h2>

    <form action="registrar_pedido.php" method="POST">
        <!-- Mostrar los métodos de pago disponibles -->
        <label for="metodo_pago">Selecciona un método de pago:</label>
        <select name="metodo_pago" id="metodo_pago">
            <?php while ($row = $resultado_metodos_pago->fetch_assoc()) : ?>
                <option value="<?php echo $row['ID_MetodoPago']; ?>"><?php echo $row['Nombre']; ?></option>
            <?php endwhile; ?>
        </select>

        <!-- Formulario para los datos del usuario/estudiante -->
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
        <label for="ubicacion">Ubicación:</label>
        <input type="text" id="ubicacion" name="ubicacion" required>
        <label for="numero_telefonico">Número Telefónico:</label>
        <input type="text" id="numero_telefonico" name="numero_telefonico" required>

        <!-- Hidden input para pasar los IDs de los productos a comprar -->
        <input type="hidden" name="ids_productos" value="<?php echo $ids_productos; ?>">

        <!-- Botón para enviar los datos -->
        <button type="submit">Confirmar Pedido</button>
    </form>
</body>
</html>
