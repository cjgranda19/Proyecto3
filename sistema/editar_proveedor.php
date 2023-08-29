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


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Proveedor</title>
	<link rel="icon" type="image/jpg" href="img/favicon.png" />
</head>

<style>
	.form_register {
		width: 450px;
		margin: auto;
	}

	.form_register h1 {
		color: #3c93b0;
	}

	hr {
		border: 0;
		background: #ccc;
		height: 1px;
		margin: 10px 0;
		display: block;
	}

	form {
		background: #fff;
		margin: auto;
		padding: 20px 50px;
		border: 1px solid #d1d1d1;
	}

	label {
		display: block;
		font-size: 12pt;
		font-family: 'Roboto', sans-serif;
		margin: 15px auto 5px auto;
	}

	input,
	select {
		display: block;
		width: 100%;
		font-size: 13pt;
		padding: 5px;
		border: 1px solid #85929e;
		border-radius: 5px;
	}

	.btn_save {
		font-size: 12pt;
		background: #12a4c6;
		padding: 10px;
		letter-spacing: 1px;
		border: 0;
		cursor: pointer;
		margin: 15px auto;
	}

	.alert {
		width: 100%;
		background: #66e07d66;
		border-radius: 6px;
		margin: 20px auto;
	}

	.msg_error {
		color: #e65656;
	}

	.msg_save {
		color: #126e00;
	}

	.alert p {
		padding: 10px;
	}
</style>



<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<div class="form_register">
			<h1>Actualizar proveedor</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $idproveedor; ?>">
				<label for="proveedor">Proveedor: </label>
				<input type="text" name="proveedor" id="proveedor" placeholder="Nombre del proveedor"  value="<?php echo $proveedor; ?>">
				<div id="mensajeErrorProveedor" class="mensaje-error"></div>

				<label for="contacto">Nombre y Apellido: </label>
				<input type="text" name="contacto" id="contacto" onchange="validar()" placeholder="Nombre Apellido" value="<?php echo $contacto; ?>">
				<div id="mensajeErrorNombre" class="mensaje-error"></div>

				<label for="cedula">Cédula: </label>
				<input type="text" name="cedula" id="cedula" placeholder="Número de cédula" onchange="validar()" required value="<?php echo $cedula; ?>">
				<div id="mensajeErrorCedula" class="mensaje-error"></div>

				<label for="email">Correo electrónico: </label>
				<input type="email" name="correo" id="correo" placeholder="texto@dominio.com" onchange="validar()" value="<?php echo $correo; ?>" required>
				<div id="mensajeErrorCorreo" class="mensaje-error"></div>

				<label for="telefono">Teléfono: </label>
				<input type="text" name="telefono" id="telefono" onchange="validar()" placeholder="0981515127" value="<?php echo $telefono; ?>">
				<div id="mensajeErrorTelefono" class="mensaje-error"></div>

				<label for="direccion">Dirección: </label>
				<input type="text" name="direccion" id="direccion" onchange="validar()" placeholder="Dirección completa" value="<?php echo $direccion; ?>">
				<div id="mensajeErrorDireccion" class="mensaje-error"></div>

				<input type="submit" value="Actualizar proveedor" class="btn_save">
			</form>

	</section>
</body>

</html>