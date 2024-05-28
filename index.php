<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Inicio de página" />
    <title>Inicio</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="css/slider_main.css"/>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/icons-social.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap"
      rel="stylesheet"
    />
    <script src="https://kit.fontawesome.com/1c2c2462bf.js" crossorigin="anonymous"></script>
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
    <div class="separador"></div>

    <div id="app"></div>

    <section class="mainContent">
        <?php
        // Establecer la conexión con la base de datos (reemplaza 'host', 'usuario', 'contraseña' y 'basededatos' con tus propios datos)
        $conexion = new mysqli('localhost:3306', 'root', '', 'restaurante');

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Consulta SQL para obtener los datos de la tabla Comida
        $sql = "SELECT ID_Comida, Nombre, Descripcion, Precio FROM Comida";
        $resultado = $conexion->query($sql);

        // Verificar si se obtuvieron resultados
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                ?>
                <div class="card">
                    <img src="images/image8.jpg" alt="">
                    <div class="cards">
                        <h2><?php echo $fila['Nombre']; ?></h2>
                        <h3><?php echo '$' . $fila['Precio']; ?></h3>
                        <p><?php echo $fila['Descripcion']; ?></p>
                        <!-- Formulario de compra -->
                        <form action="carrito_compras.php" method="POST">
                            <!-- Input oculto para enviar el ID del producto -->
                            <input type="hidden" name="id_producto" value="<?php echo $fila['ID_Comida']; ?>">
                            <!-- Botón para comprar -->
                            <button type="submit">Comprar</button>
                        </form>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No se encontraron resultados.";
        }

        // Cerrar la conexión
        $conexion->close();
        ?>
    </section>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/react/17.0.1/umd/react.production.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/17.0.1/umd/react-dom.production.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/classnames/2.2.6/index.min.js"></script>
    <script type="text/javascript" src="script-slide.js"></script>
</body>
<footer>
    <div class="footer-container">
        
        <ul>
            <li><a href="#">Política de privacidad</a></li>
            <li><a href="#">Términos y condiciones</a></li>
            <li><a href="#">Contacto</a></li>
        </ul>
    </div>
    <div class="social-icons">
        <a class="social-icon twitter" href="https://twitter.com/?lang=es">
            <i class="fab fa-twitter"></i>
        </a>
        <a class="social-icon facebook" href="https://www.facebook.com/">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a class="social-icon instagram" href="https://www.instagram.com/">
            <i class="fab fa-instagram"></i>
        </a>
        <a class="social-icon github" href="https://github.com/">
            <i class="fab fa-tiktok"></i>
        </a> 
    <div></div>
</footer>
</html>