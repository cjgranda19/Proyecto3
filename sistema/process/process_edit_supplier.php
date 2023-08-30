<?php
session_start();
include "../../conexion.php";
if (!isset($_SESSION['permisos']['permiso_crear_proveedor']) || $_SESSION['permisos']['permiso_crear_proveedor'] != 1) {
	header("location: ../index.php");
	exit();
}
$alert = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$id_supplier = $_POST['id_supplier'];
	$proveedor = $_POST['proveedor'];
	$contacto = $_POST['contacto'];
	$telefono = $_POST['telefono'];
	$direccion = $_POST['direccion'];
	$cedula = $_POST['cedula'];
	$correo = $_POST['correo'];

	echo "<script>console.log('Se recibio el update :D');</script>";



	$sql_update = mysqli_query($conection, "UPDATE proveedor SET proveedor = '$proveedor', correo = '$correo'
	, contacto='$contacto', telefono='$telefono', direccion='$direccion', cedula = '$cedula' WHERE id_supplier = $id_supplier ");

	if ($sql_update) {
		$_SESSION['popup_message'] = 'Actualización exitosa.';
		header("location: ../lista_proveedor.php");

	} else {
		$_SESSION['popup_message'] = 'Error, intente de nuevo o contacte al administrador.' . mysqli_error($conection);
		header("location: ../lista_proveedor.php");
	}
	mysqli_close($conection);
	

	echo $alert;

}