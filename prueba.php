<?php
$serverName = "localhost";
$connectionInfo = array(
    "Database" => "restaurante",
    "UID" => "windous",
    "PWD" => "utf-8"
);
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn===false) {
    die (print_r(sqlsrv_errors(),true));
} else {
    echo "coneccion exitosa: ";
}
?> 