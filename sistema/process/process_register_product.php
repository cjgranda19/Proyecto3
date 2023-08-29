<?php
session_start();
include "../../conexion.php";

if (!isset($_SESSION['permisos']['permiso_crear_productos']) || $_SESSION['permisos']['permiso_crear_productos'] != 1) {
	header("location: index.php");
	exit();
}

$alert = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto = $_POST['producto'];
    $proveedor = $_POST['proveedor'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $usuario_id = $_SESSION['idUser'];

    if (empty($producto) || empty($proveedor) || empty($precio) || empty($cantidad) || $precio <= 0 || $cantidad <= 0) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {

        $query_insert = "INSERT INTO producto (descripcion, proveedor, precio, existencia, usuario_id ) VALUES ('$producto', '$proveedor', '$precio', '$cantidad', '$usuario_id')";
        $result = mysqli_query($conection, $query_insert);

        if ($result) {
            $_SESSION['popup_message'] = 'Inserción exitosa.';
        } else {
            $_SESSION['popup_message'] = 'Error al guardar producto: ' . mysqli_error($conection);
        }
        header("location: ../lista_producto.php");
        exit();
    }
}

echo $alert;
?>