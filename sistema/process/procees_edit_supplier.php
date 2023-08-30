<?php
session_start();
include "../conexion.php";
include "includes/session_timeout.php";
if (!isset($_SESSION['permisos']['permiso_crear_proveedor']) || $_SESSION['permisos']['permiso_crear_proveedor'] != 1) {
	header("location: index.php");
	exit();
}

if (!empty($_POST)) {

	$alert = '';

	if (empty($_POST['proveedor']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['contacto'])) {
		$alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
	} else {
		include "../conexion.php";

		$idproveedor = $_POST['id'];
		$proveedor = $_POST['proveedor'];
		$contacto = $_POST['contacto'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];
		$cedula = $_POST['cedula'];

		$sql_update = mysqli_query($conection, "UPDATE proveedor SET proveedor = '$proveedor', contacto='$contacto', telefono='$telefono', direccion='$direccion', cedula = '$cedula' WHERE id_supplier=$idproveedor ");

		if ($sql_update) {
			$alert = '<p class="msg_save">Proveedor actualizado correctamente.</p>';
		} else {
			$alert = '<p class="msg_error">Error al actualizar el proveedor.</p>';
		}
	}
}

//mostrar datos
if (empty($_REQUEST['id'])) {
	header('Location: lista_proveedor.php');
	mysqli_close($conection);
}
$idproveedor = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT * FROM proveedor WHERE id_supplier = $idproveedor AND estatus=1");

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
	header('Location: lista_proveedor.php');
} else {
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {
		$idproveedor = $data['id_supplier'];
		$proveedor = $data['proveedor'];
		$correo = $data['correo'];
		$contacto = $data['contacto'];
		$telefono = $data['telefono'];
		$direccion = $data['direccion'];
		$cedula = $data['cedula'];
	}
}

?>