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
    <title>Nombre del Producto - Tienda Online</title>
    <style>
        /* Reset de estilos y fuentes */
        body, h1, h2, h3, p {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
            color: #333;
        }

        /* Contenedor principal */
        .product-container {
            display: flex;
            flex-wrap: wrap;
            max-width: 800px;
            margin: 50px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        /* Imagen del producto */
        .product-image {
            flex: 1;
            overflow: hidden;
            border-radius: 8px 0 0 8px;
        }

        .product-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Detalles del producto */
        .product-details {
            flex: 1;
            padding: 20px;
            box-sizing: border-box; /* Añadido para incluir el padding en el ancho total */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }

    .product-title,
    .product-price,
    .product-description {
    text-align: left; /* Alinea el texto a la izquierda */
    margin-bottom: 10px; /* Añade un espacio entre los elementos */
}


.product-image {
    order: -1; /* Cambia el orden para que la imagen aparezca arriba en dispositivos pequeños */
}
        .product-title {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        .product-price {
            font-size: 2rem;
            font-weight: bold;
            color: #e44d26;
            /* margin-bottom: 20px; */
        }

        .product-description {
            margin-top: 20px;
        }

        .product-description h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }

        .product-description p {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
            margin-bottom: 20px;
        }

        .buy-button {
            background-color: #e44d26;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .buy-button:hover {
            background-color: #333;
        }

        /* Estilos para el header */
        .header {
            background-color: #333;
            color: #fff;
            padding: 15px 0;
            text-align: center;
        }

        .logo h1 {
            font-size: 24px;
        }

        .menu {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        .menu a {
            margin: 0 15px;
            text-decoration: none;
            color: #fff;
            font-size: 18px;
            transition: color 0.3s;
        }

        .menu a:hover {
            color: #e44d26;
        }

        /* Media queries */
        @media screen and (max-width: 768px) {
            .product-container {
                max-width: 100%;
                border-radius: 0;
            }

            .product-details {
                padding: 15px;
            }

            .product-details {
        align-items: center; /* Centra verticalmente en dispositivos pequeños */
        text-align: center; /* Alinea el texto al centro en dispositivos pequeños */
    }

    .product-image {
        order: 0; /* Restablece el orden predeterminado en dispositivos pequeños */
        margin-bottom: 20px; /* Añade espacio entre la imagen y el resto de los elementos */
    }
        }

        @media screen and (max-width: 480px) {
            .product-title {
                font-size: 20px;
            }

            .product-price {
                font-size: 16px;
            }

            .product-description p {
                font-size: 14px;
            }

            .buy-button {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="product-container">
        <div class="product-image">
            <!-- Agrega la etiqueta img con el src correspondiente -->
            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Imagen']); ?>" alt="producto-img">
        </div>
        <div class="product-details">
            <h1 class="product-title"><?php echo $nombre; ?></h1>
            <p class="product-price">$<?php echo $precio; ?></p>
            <div class="product-description">
            <h2>Descripción</h2>
                <p><?php echo $descripcion; ?></p>
            </div>
            <form method="post" action="proceso_de_compra.php">
                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                <button class="buy-button" type="submit">Comprar ahora</button>
            </form>
        </div>
    </div>

</body>
</html>
