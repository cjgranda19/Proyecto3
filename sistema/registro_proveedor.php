<?php


session_start();
if ($_SESSION['rol'] != 1) {
	header("location: ./");
}
include "../conexion.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Proveedor</title>
	<link rel="stylesheet" type="text/css" href="css/popup.css">

</head>


<body>
	<section id="container-2">
		<span class="close-button" onclick="closePopup()">&times;</span>


		<div class="form_register">
			<h1>Registro Proveedor</h1>
			<hr>
			<div class="alert">
				<?php echo isset($alert) ? $alert : ''; ?>
			</div>
			<form id="registroForm" action="process/process_register_supplier.php" method="post">
				<label for="proveedor">Proveedor: </label>
				<input type="text" name="proveedor" id="proveedor" placeholder="Nombre del proveedor">
				<div id="mensajeErrorProveedor" style="color: red;"></div>
				<label for="cedula">DNI: </label>
				<input type="text" name="cedula" id="cedula" placeholder="Número de CI">
				<div id="cedula" style="color: red;"></div>
				<label for="contacto">Nombre: </label>
				<input type="text" name="contacto" id="contacto" placeholder="Nombre completo del contacto">
				<div id="mensajeErrorNombre" style="color: red;"></div>
				<label for="telefono">Teléfono: </label>
				<input type="text" name="telefono" id="telefono" placeholder="Teléfono">
				<div id="mensajeErrorTelefono" style="color: red;"></div>
				<label for=correo>Correo electónico: </label>
				<input type="email" name="correo" id="correo" placeholder="texto@dominio.com">
				<div id="mensajeError" style="color: red;"></div>
				<label for="direccion">Dirección: </label>
				<input type="text" name="direccion" id="direccion" placeholder="Dirección completa">
				<div class="button-container">

					<input type="submit" name="submit" value="Registrar" class="btn_save">
				</div>
			</form>
		</div>

	</section>

</body>

</html>