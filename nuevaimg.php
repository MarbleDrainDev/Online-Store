<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>

<header class="header">
        <div class="container">
            <div class="logo">
                <h1>Logo</h1>
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


<?php
include 'config.php';

    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM productos WHERE id = '$id'";
    $resultado = $conn->query($sql);
    $row = $resultado->fetch_assoc();

?>
<h2>Editar Producto</h2>

<!-- Se usa value para insertar el nombre del producto -->

    <form action="modificar_img.php?id=<?php echo $row['id']?>" method="post" enctype="multipart/form-data">

        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Imagen']); ?>" alt="">
        
        <input type="file" name="imagen"><br><br>
        
        <input type="submit" value="Editar Cambios">
    </form>
</body>
</html>