<?php
session_start();
include "../conexion.php";

if ($_SESSION['rol'] != 1) {
    header("location: ./");
    exit(); 
}

$alert = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto = $_POST['producto'];
    $proveedor = $_POST['proveedor'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    if (empty($producto) || empty($proveedor) || empty($precio) || empty($cantidad) || $precio <= 0 || $cantidad <= 0) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {
        
        $query_insert = "INSERT INTO producto (descripcion, proveedor, precio, existencia) VALUES ('$producto', '$proveedor', '$precio', '$cantidad')";
        $result = mysqli_query($conection, $query_insert);

        if ($result) {
            header("location: ../");
        } else {
            $alert = '<p class="msg_error">Error al guardar producto: ' . mysqli_error($conection) . '</p>';
        }
    }
}

echo $alert;
?>
