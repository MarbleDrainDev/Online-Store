<?php
// Iniciar la sesión
session_start();

// Conexión a la base de datos
$conexion = mysqli_connect("localhost:3306", "root", "G0r1ll4szoe120.", "restaurante");

// Verificar la conexión
if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

// Obtener los datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Consultar la base de datos para verificar las credenciales
$sql = "SELECT * FROM restaurantes WHERE email='$email'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) == 1) {
    $row = mysqli_fetch_assoc($resultado);
    if (password_verify($password, $row['password'])) {
        // Credenciales correctas, iniciar sesión
        $_SESSION['restaurante_id'] = $row['id'];
        $_SESSION['restaurante_nombre'] = $row['nombre'];
        // Redireccionar a la página para añadir comidas
        header("Location: agregar_comida.php");
        exit();
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Email no registrado";
}

// Cerrar la conexión
mysqli_close($conexion);
?>

</html>
