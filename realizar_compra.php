<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Realizar Compra</h2>
        <?php
        // Conectar a la base de datos (reemplaza 'host', 'usuario', 'contraseña' y 'basededatos' con tus propios datos)
        $conexion = new mysqli('localhost:3306', 'root', 'G0r1ll4szoe120.', 'restaurante');

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Verificar si se ha enviado el formulario para realizar la compra
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Generar un número de factura único (puedes implementar tu propia lógica para esto)
            $numero_factura = uniqid('FACTURA_');

            // Insertar la factura en la tabla de Factura
            $sql_insertar_factura = "INSERT INTO Factura (Numero_Factura, Tipo_Factura) VALUES ('$numero_factura', 'Venta')";
            if ($conexion->query($sql_insertar_factura) === TRUE) {
                echo "<p>Factura generada correctamente. Número de factura: $numero_factura</p>";

                // Obtener los productos del carrito de compras del estudiante (supongamos que el ID del estudiante es 1)
                $id_estudiante = 1;
                $sql_carrito = "SELECT cc.ID_Carrito, c.Nombre, c.Precio, cc.Cantidad FROM Carrito_Compras cc INNER JOIN Comida c ON cc.ID_Comida = c.ID_Comida WHERE cc.ID_Estudiante = $id_estudiante";
                $resultado_carrito = $conexion->query($sql_carrito);

                if ($resultado_carrito->num_rows > 0) {
                    // Crear un archivo de texto para la factura
                    $archivo_factura = fopen("factura_$numero_factura.txt", "w");

                    // Escribir los detalles de la factura en el archivo de texto
                    fwrite($archivo_factura, "Número de factura: $numero_factura\n\n");
                    fwrite($archivo_factura, "Detalles de la compra:\n");

                    // Iterar sobre los productos del carrito y escribirlos en el archivo de texto
                    while ($fila = $resultado_carrito->fetch_assoc()) {
                        $nombre_producto = $fila['Nombre'];
                        $precio_producto = $fila['Precio'];
                        $cantidad_producto = $fila['Cantidad'];

                        fwrite($archivo_factura, "Producto: $nombre_producto\n");
                        fwrite($archivo_factura, "Precio: $precio_producto\n");
                        fwrite($archivo_factura, "Cantidad: $cantidad_producto\n\n");
                    }

                    fclose($archivo_factura);

                    echo "<p>Archivo de factura generado: <a href='factura_$numero_factura.txt' download>factura_$numero_factura.txt</a></p>";
                } else {
                    echo "<p>No hay productos en el carrito de compras.</p>";
                }
            } else {
                echo "<p>Error al generar la factura: " . $conexion->error . "</p>";
            }

            // Eliminar todos los productos del carrito después de realizar la compra
            $sql_eliminar_carrito = "DELETE FROM Carrito_Compras WHERE ID_Estudiante = $id_estudiante";
            $conexion->query($sql_eliminar_carrito);
        }

        // Cerrar la conexión
        $conexion->close();
        ?>
        <a href="carrito_compras.php" class="btn">Volver al Carrito de Compras</a>
    </div>
</body>
</html>
