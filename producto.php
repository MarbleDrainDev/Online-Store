<?php
include 'config.php';
// Supongamos que tienes el ID del producto que deseas mostrar (puedes obtenerlo de la URL, por ejemplo)
$id = $_GET['id'];
// Consulta la base de datos para obtener los detalles del producto con el ID dado
$sql = "SELECT * FROM productos WHERE id = $id";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $nombre = $row['nombre'];
    $precio = $row['precio'];
    $descripcion = $row['descripcion'];
    // Asegúrate de que los datos del producto estén disponibles aquí
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Información detallada del producto de la tienda online">
    <title><?php echo $nombre; ?></title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/productophp.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <h1>Online Store</h1>
            </div>
            <div class="boton">
                <label for="btn-menu">Menu</label>
            </div>
            <input type="checkbox" name="" id="btn-menu">
            <nav class="menu">
                <a href="index.html" class="inicio">Inicio</a>
                <a href="productos.php" class="modelos">Productos</a>
                <a href="crud.php" class="modelos">CRUD</a>
            </nav>
        </div>
    </header>

    <div class="separador"></div>


    <section id="prodetails" class="section-p1">
        <div class="caja-producto">

        <div class="containerproduct">
            <div class="single-pro-image">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Imagen']); ?>" alt="producto-img">
            </div>
            <div class="single-pro-details">
            <h1 class="product-title"><?php echo $nombre; ?></h1>
            <p class="product-price">$<?php echo $precio; ?></p>

            <div class="product-description">
            <h2>Descripción</h2>
                <p><?php echo $descripcion; ?></p>
            </div>

                <form method="post" action="proceso_de_compra.php">
                    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                    <button class="button-rosa" type="submit">Comprar ahora</button>
                </form>
            </div>
        </div>

        </div>
        
    </section>

    <!-- <div class="separador2"></div> -->

    <script src="https://kit.fontawesome.com/1c2c2462bf.js" crossorigin="anonymous"></script>
</body>
</html>



<style>
    /* Añade tus estilos personalizados aquí */



</style>