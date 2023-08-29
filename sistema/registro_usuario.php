<?php
session_start();
if (!isset($_SESSION['permisos']['permiso_crear_usuarios']) || $_SESSION['permisos']['permiso_crear_usuarios'] != 1) {
	header("location: index.php");
	exit();
}


include "../conexion.php";


?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Usuario</title>
	<link rel="stylesheet" type="text/css" href="css/popup.css">
	<link rel="icon" type="image/jpg" href="img/favicon.png" />
	<style>
		/* Estilo para el contenedor del selector */
		#rolesSelect {
			width: 100%;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 4px;
			background-color: #fff;
			appearance: none;
			-webkit-appearance: none;
			cursor: pointer;
		}

		/* Estilo para las opciones */
		#rolesSelect option {
			padding: 5px;
		}
	</style>
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
				<label for="nombre">Nombre </label>
				<input type="text" id="nombre" name="nombre" placeholder="Nombre Apellido"
					pattern="^[A-Za-z]+\s[A-Za-z]+$" title="El formato debe ser 'Nombre Apellido'" required>
				<label for="correo">Correo electrónico </label>
				<input type="email" name="correo" id="correo" placeholder="texto@dominio.com"
					pattern="[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?"
					title="Ingresa un correo con dominio .com o .net válido" required>
				<label for="usuario">Usuario </label>
				<input type="text" name="usuario" id="usuario" placeholder="usuario" pattern="^[a-z]+$"
					title="Ingresa un usuario válido con solo minúsculas" required>
				<label for="clave">Clave </label>
				<input type="password" name="clave" id="clave" placeholder="Clave de acceso"
					pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,16}$"
					title="La clave debe tener al menos 8 caracteres, incluir una mayúscula y un carácter especial"
					required>
				<label for="cargo">Cargo </label>
				<input type="text" name="cargo" id="cargo" placeholder="Cargo" pattern="^[A-Za-z]+$">
				<label for="rolesSelect">Rol:</label>
				<select id="rolesSelect" multiple="multiple" name="roles[]"
					title="Aplasta Control para seleccionar varios a la vez">
					<optgroup label="Usuarios">
						<option value="Crear usuarios"> - Crear/Editar usuarios</option>
						<option value="Ver usuarios"> - Ver usuarios</option>
					</optgroup>
					<optgroup label="Proveedores">
						<option value="Ver proveedores"> - Ver proveedores</option>
						<option value="Crear proveedor"> - Crear proveedor</option>
					</optgroup>
					<optgroup label="Productos">
						<option value="Ver productos"> - Ver productos</option>
						<option value="Crear productos"> - Crear/Editar productos</option>
						<option value="Agregar productos"> - Agregar productos</option>
					</optgroup>
					<optgroup label="Hojas técnicas">
						<option value="Ver hojas técnicas"> - Ver hojas técnicas</option>
						<option value="Crear hoja técnica"> - Crear/Editar hoja técnica</option>
					</optgroup>
					<optgroup label="Órdenes">
						<option value="Ver órdenes"> - Ver órdenes</option>
						<option value="Crear órdenes"> - Crear/Editar órdenes</option>
					</optgroup>
					<optgroup label="Clientes">
						<option value="Ver clientes"> - Ver clientes</option>
						<option value="Crear clientes"> - Crear/Editar clientes</option>
					</optgroup>
					<optgroup label="Reportes">
						<option value="Ver reportes"> - Ver reportes</option>
					</optgroup>
				</select>
				<div class="button-container">
					<input type="submit" name="submit" value="Crear Usuario" class="btn_save">
				</div>
			</form>

		</div>

	</section>

</body>

</html>