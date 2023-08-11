<?php

session_start();
if ($_SESSION['rol'] != 1) {
	header("location: ./");
}
include "../conexion.php";

if (!empty($_POST)) {

	$alert = '';

	if (empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['nit'])) {
		$alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
	} else {
		$nit = $_POST('nit');
		$proveedor = $_POST['proveedor'];
		$contacto = $_POST['contacto'];
		$telefono = $_POST['telefono'];
		$correo = $_POST['correo'];
		$direccion = $_POST['direccion'];
		$usuario_id = $_SESSION['idUser'];

		$query_insert = mysqli_query($conection, "INSERT INTO proveedor(nit, proveedor,contacto,correo,telefono,direccion,usuario_id) VALUES('$nit','$proveedor','$contacto','$correo','$telefono','$direccion','$usuario_id')");

		if ($query_insert) {
			$alert = '<p class="msg_save">Cliente guardado correctamente.</p>';
		} else {
			$alert = '<p class="msg_error">Error al guardar cliente.</p>';
		}
	}
	mysqli_close($conection);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Proveedor</title>
	<link href="css/registro_proveedor.css" rel="stylesheet">
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<div class="form_register">
			<h1>Registro Proveedor</h1>
			<hr>
			<div class="alert">
				<?php echo isset($alert) ? $alert : ''; ?>
			</div>

			<form action="" method="post">
				<label for="proveedor">Proveedor: </label>
				<input type="text" name="proveedor" id="proveedor" placeholder="Nombre del proveedor">
				<label for="nit">RUC/NIT: </label>
				<input type="text" name="nit" id="nit" placeholder="Número de CI">
				<div id="cedula" style="color: red;"></div>
				<label for="contacto">Nombre: </label>
				<input type="text" name="nombre" id="contacto" placeholder="Nombre completo del contacto">
				<div id="mensajeErrorNombre" style="color: red;"></div>
				<label for="telefono">Teléfono: </label>
				<input type="text" name="telefono" id="telefono" placeholder="Teléfono">
				<div id="mensajeErrorTelefono" style="color: red;"></div>
				<label for=correo>Correo electónico: </label>
				<input type="email" name="correo" id="correo" placeholder="texto@dominio.com">
				<div id="mensajeError" style="color: red;"></div>
				<label for="direccion">Dirección: </label>
				<input type="text" name="direccion" id="direccion" placeholder="Dirección completa">

				<input type="submit" value="Guardar proveedor" class="btn_save" id="btn_sb">
			</form>
		</div>

	</section>
	<script src="js/validacion.js"></script>

	<?php include "includes/footer.php"; ?>


</body>

</html>