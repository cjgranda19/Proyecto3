<?php
session_start();

include "../conexion.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Destinatario</title>
</head>

<body>
	<section id="container-2">
    <span class="close-button" onclick="closePopup()">&times;</span>

		<div class="form_register">
			<h1>Registro destinatario</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form id="registroForm" action="process/process_register_client.php" method="post">
				<label for="cedula">Cédula: </label>
				<input type="text" name="cedula" id="cedula" placeholder="Número de CI">
				<div id="cedula" style="color: red;"></div>
				<label for="nombre">Nombre: </label>
				<input type="text" name="nombre" placeholder="Nombre Apellido">
				<div id="mensajeErrorNombre" style="color: red;"></div>			
				<label for="telefono">Teléfono: </label>
				<input type="text" name="telefono" id="telefono" placeholder="Teléfono">
				<div id="mensajeErrorTelefono" style="color: red;"></div>			
				<label for="direccion">Dirección: </label>
				<input type="text" name="direccion" id="direccion" placeholder="Dirección completa">
                <div class="button-container">

				<input type="submit" value="Guardar destinatario" class="btn_save" id="btn_sb">
                </div>
			</form>
		</div>
	</section>
	
	
</body>
</html>