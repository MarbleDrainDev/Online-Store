<?php
include 'config.php';

$id = $_REQUEST['id'];

$sql = "DELETE FROM productos WHERE id = '$id'";
$resultado = $conn->query($sql);

if ($resultado) {
    echo '<script>';
    echo 'alert("Producto eliminado correctamente.");';
    echo 'window.location.href = "crud.php";';
    echo '</script>';
} else {
    echo '<script>';
    echo 'alert("No se eliminó.");';
    echo 'window.location.href = "crud.php";';
    echo '</script>';
}
?>
