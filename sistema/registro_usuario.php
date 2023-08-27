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

			<div class="alert">
				<?php echo isset($alert) ? $alert : ''; ?>
			</div>
			<form id="registroForm" action="process/process_register_user.php" method="post">
				<label for="nombre">Nombre: </label>
				<input type="text" id="nombre" name="nombre" placeholder="Nombre Apellido"
					pattern="^[A-Za-z]+\s[A-Za-z]+$" title="El formato debe ser 'Nombre Apellido'" required>
				<label for="correo">Correo electrónico: </label>
				<input type="email" name="correo" id="correo" placeholder="texto@dominio.com"
					pattern="[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?"
					title="Ingresa un correo con dominio .com o .net válido" required>
				<label for="usuario">Usuario: </label>
				<input type="text" name="usuario" id="usuario" placeholder="usuario" pattern="^[a-z]+$"
					title="Ingresa un usuario válido con solo minúsculas" required>
				<label for="clave">Clave: </label>
				<input type="password" name="clave" id="clave" placeholder="Clave de acceso"
					pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,16}$"
					title="La clave debe tener al menos 8 caracteres, incluir una mayúscula y un carácter especial"
					required>
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