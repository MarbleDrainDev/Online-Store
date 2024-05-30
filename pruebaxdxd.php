<?php
$serverName = "NombreDelServidor";
$connectionInfo = array(
    "Database" => "restaurante",
    "UID" => "localhost",
    "PWD" => ""
);
$conn = sqlsrv_connect($serverName, $connectionInfo);
if ($conn) {
    echo "Conexión establecida.";
} else {
    echo "Error al conectar: " . sqlsrv_errors();
}
?>
[6:36 p. m., 26/5/2024] David Ramos: <?php
// Configuración de la conexión
$serverName = "tu_servidor"; // Nombre o dirección IP del servidor SQL Server
$connectionOptions = array(
    "Database" => "restaurante", // Nombre de la base de datos
    "Uid" => "tu_usuario", // Nombre de usuario
    "PWD" => "tu_contraseña" // Contraseña
);

// Intentar establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Consulta SQL para seleccionar todos los estudiantes
$sql = "SELECT * FROM estudiante";

// Ejecutar la consulta
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Procesar resultados
echo "<h1>Listado de Estudiantes</h1>";
echo "<table border='1'>";
echo "<tr><th>ID Estudiante</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Fecha Nacimiento</th><th>Ubicación</th><th>ID Num. Telefónico</th></tr>";

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['ID_Estudiante'] . "</td>";
    echo "<td>" . $row['Nombre'] . "</td>";
    echo "<td>" . $row['Apellido'] . "</td>";
    echo "<td>" . $row['Email'] . "</td>";
    echo "<td>" . $row['Fecha_Nacimiento']->format('Y-m-d') . "</td>";
    echo "<td>" . $row['Ubicacion'] . "</td>";
    echo "<td>" . ($row['ID_Numero_telefonico'] ?? 'N/A') . "</td>";
    echo "</tr>";
}

echo "</table>";

// Cerrar la conexión
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>