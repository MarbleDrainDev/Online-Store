<?php
// Verificar si el restaurante está logueado
session_start();
if (!isset($_SESSION['restaurante_id'])) {
    header("Location: login.php");
    exit();
}

// Conexión a la base de datos
$conexion = mysqli_connect("localhost:3306", "usuario", "contraseña", "restaurante_db");

// Verificar la conexión
if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

// Obtener el ID del restaurante logueado
$restaurante_id = $_SESSION['restaurante_id'];

// Procesar el formulario para agregar una comida
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Insertar los datos en la tabla de comidas
    $sql = "INSERT INTO comida (nombre, descripcion, precio, restaurante_id) VALUES ('$nombre', '$descripcion', '$precio', '$restaurante_id')";
    if (mysqli_query($conexion, $sql)) {
        echo "Comida agregada correctamente.";
    } else {
        echo "Error al agregar la comida: " . mysqli_error($conexion);
    }
}

// Cerrar la conexión
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Comida</title>
</head>
<body>
    <h2>Agregar Comida</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Nombre: <input type="text" name="nombre"><br>
        Descripción: <textarea name="descripcion"></textarea><br>
        Precio: <input type="number" name="precio"><br>
        <input type="submit" value="Agregar Comida">
    </form>
</body>
</html>
