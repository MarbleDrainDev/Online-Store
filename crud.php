<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Productos</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/crud.css">
    <link rel="stylesheet" href="css/footer.css">
    <script src="https://kit.fontawesome.com/1c2c2462bf.js" crossorigin="anonymous"></script>
    
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
    

    <h2>CRUD de Productos</h2>
    <a class="agregar" href="formulario.html">Agregar Producto</a>
    <table class="crud-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>

    </thead>
    <tbody>
        <?php
            include("config.php");

            $sql = "SELECT * FROM productos";
            $resultado = $conn->query($sql);
        
            while($row = $resultado->fetch_assoc()){
        ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['nombre'] ?></td>
                <td><img height="100px" src="data:image/jpg;base64, <?php echo base64_encode($row['Imagen']); ?>"/></td>
                <td>$<?php echo $row['precio'] ?></td>

                <td class="crud-actions">
                    <a class="editar-link" href="modificar.php?id=<?php echo $row['id']; ?>">Editar</a>
                    <a class="eliminar-link"href="eliminar.php?id=<?php echo $row['id']; ?>">Eliminar</a>
                </td>
                
                   
            </tr>
        <?php
            }
        ?>
        
    
</body>
</html>
