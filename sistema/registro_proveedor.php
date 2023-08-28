<?php


session_start();
if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2) {
	header("location: ./");
	exit;
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
	<link rel="icon" type="image/jpg" href="img/favicon.png" />


</head>


<body>
	<section id="container-2">
		<span class="close-button" onclick="closePopup()">&times;</span>


		<div class="form_register">
			<h1>Registro Proveedor</h1>
			<div class="alert">
				<?php
				echo isset($alert) ? $alert : '';
				echo isset($_SESSION['popup_message']) ? '<p class="msg_info" id="popupMessage">' . $_SESSION['popup_message'] . '</p>' : '';
				unset($_SESSION['popup_message']);
				?>
			</div>
			<form id="registroForm" action="process/process_register_supplier.php" method="post">
				<label for="proveedor">Proveedor: </label>
				<input type="text" name="proveedor" id="proveedor" placeholder="Nombre del proveedor"
					pattern="[a-zA-Z0-9\s/]+">
				<label for="cedula">DNI: </label>
				<input type="text" name="cedula" id="cedula" placeholder="Número de CI" pattern="\d{10}" required>
				<label for="contacto">Nombre: </label>
				<input type="text" id="contacto" name="contacto" placeholder="Nombre Apellido"
					pattern="^[A-Za-z]+\s[A-Za-z]+$" title="El formato debe ser 'Nombre Apellido'" required>
				<label for="telefono">Teléfono: </label>
				<input type="text" name="telefono" id="telefono" placeholder="Teléfono" required>
				<div id="mensajeErrorTelefono" style="color: red;"></div>
				<label for="correo">Correo electrónico: </label>
				<input type="email" name="correo" id="correo" placeholder="texto@dominio.com"
					pattern="[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-]([\.]?[a-zA-Z0-9!#$%&'*\/=?^_`\{\|\}~\+\-])+@[a-zA-Z0-9]([^@&%$\/\(\)=?¿!\.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?"
					title="Ingresa un correo con dominio .com o .net válido" required>
				<label for="direccion">Dirección: </label>
				<input type="text" name="direccion" id="direccion" placeholder="Dirección completa"
					pattern="[a-zA-Z0-9\s/]+">

				<div class="button-container">

					<input type="submit" name="submit" value="Registrar" class="btn_save">
				</div>
			</form>
		</div>

	</section>
	<script>
		var cedulaInput = document.getElementById("cedula");
		var validationMessage = document.getElementById("validationMessage");

		cedulaInput.addEventListener("input", function () {
			var cedulaValue = cedulaInput.value;
			if (isValidCI(cedulaValue)) {
				validationMessage.textContent = "";
			} else {
				validationMessage.textContent = "El número de DNI no es válido.";
			}
		});

		function isValidCI(ci) {
			if (!/^\d{10}$/.test(ci)) {
				return false;
			}

			var total = 0;
			var coeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2];

			for (var i = 0; i < 9; i++) {
				var temp = parseInt(ci[i]) * coeficientes[i];
				if (temp > 9) {
					temp -= 9;
				}
				total += temp;
			}

			var verificador = 10 - (total % 10);
			if (verificador === 10) {
				verificador = 0;
			}

			return parseInt(ci[9]) === verificador;
		}
	</script>
</body>

</html>