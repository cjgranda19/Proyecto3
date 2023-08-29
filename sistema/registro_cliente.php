<?php
session_start();

include "../conexion.php";

if (!isset($_SESSION['permisos']['permiso_crear_clientes']) || $_SESSION['permisos']['permiso_crear_clientes'] != 1) {
	header("location: index.php");
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Destinatario</title>
	<link rel="icon" type="image/jpg" href="img/favicon.png" />

</head>

<body>
	<section id="container-2">
    <span class="close-button" onclick="closePopup()">&times;</span>

		<div class="form_register">
			<h1>Registro destinatario</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form id="registroForm" action="process/process_register_client.php" method="post" >

				<label for="cedula">Cédula: </label>
				<input type="text" name="cedula" id="cedula" placeholder="Número de CI" onchange="validarCliente()">
				<div id="mensajeErrorCedula" class="mensaje-error"></div>	

				<label for="nombre">Nombre: </label>
				<input type="text" id="nombre" name="nombre" placeholder="Nombre Apellido" title="El formato debe ser 'Nombre Apellido'" required onchange="validarCliente()">
				<div id="mensajeErrorNombre" class="mensaje-error"></div>	

				<label for="telefono">Teléfono: </label>
				<input type="text" name="telefono" id="telefono" placeholder="Teléfono" onchange="validarCliente()">
				<div id="mensajeErrorTelefono" class="mensaje-error"></div>		

				<label for="direccion">Dirección: </label>
				<input type="text" name="direccion" id="direccion" placeholder="Dirección completa" onchange="validarCliente()">
				<div id="mensajeErrorDireccion" class="mensaje-error"></div>	
                <div class="button-container">

				<input type="submit" value="Guardar destinatario" class="btn_save" id="btn_sb">
                </div>
			</form>
		</div>
	</section>
	
	
</body>
</html>