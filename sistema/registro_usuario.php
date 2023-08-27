<?php
session_start();
if ($_SESSION['rol'] != 1) {
	header("location: ./");
}

include "../conexion.php";

$query_rol = mysqli_query($conection, "SELECT * FROM rol");
$result_rol = mysqli_num_rows($query_rol);
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Usuario</title>
	<script src="js/validacion.js"></script>

	<link rel="stylesheet" type="text/css" href="css/popup.css">
</head>

<body>
	<section id="container-2">
		<span class="close-button" onclick="closePopup()">&times;</span>

		<div class="form_register">
			<h1>Registro usuario</h1>
			<hr>
			<div class="alert">
				<?php echo isset($alert) ? $alert : ''; ?>
			</div>
			<form id="registroForm" action="process/process_register_user.php" method="post">
				<label for="nombre">Nombre: </label>
				<input type="text" name="nombre" placeholder="Nombre Apellido">
				<div id="mensajeErrorNombre" style="color: red;"></div>
				<label for="correo">Correo electrónico: </label>
				<input type="email" name="correo" id="correo" placeholder="texto@dominio.com">
				<div id="mensajeError" style="color: red;"></div>
				<label for="usuario">Usuario: </label>
				<input type="text" name="usuario" id="usuario" placeholder="usuario">
				<div id="mensajeErrorUsuario" style="color: red;"></div>
				<label for="clave">Clave: </label>
				<input type="password" name="clave" id="clave" placeholder="Clave de acceso">
				<div id="mensajeErrorPassword" style="color: red;"></div>
				<label for="rol">Tipo Usuario: </label>
				<select name="rol" id="rol">
					<?php
					if ($result_rol > 0) {
						while ($rol = mysqli_fetch_array($query_rol)) {
							?>
							<option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
							<?php
						}
					}
					?>
				</select>
				<div class="button-container">
				<input type="submit" name="submit" value="Crear Usuario" class="btn_save">
				</div>
			</form>
		</div>
	</section>
</body>

</html>