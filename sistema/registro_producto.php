<?php

session_start();
if (!isset($_SESSION['permisos']['permiso_crear_productos']) || $_SESSION['permisos']['permiso_crear_productos'] != 1) {
	header("location: index.php");
	exit();
}
include "../conexion.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Registro Producto</title>
	<link rel="stylesheet" href="css/popup.css">
	<link rel="icon" type="image/jpg" href="img/favicon.png" />

</head>

<body>
	<section id="container-2">
		<span class="close-button" onclick="closePopup()">&times;</span>

		<div class="form_register">

			<div class="alert">
				<?php echo isset($alert) ? $alert : ''; ?>
			</div>

			<form id="registroForm" action="process/process_register_product.php" method="post">
				<h1>Registro Producto</h1>

				<label for="producto">Producto </label>
				<input type="text" name="producto" id="producto" placeholder="Nombre del producto" required>

				<label for="medida">Medida </label>
				<input type="text" name="medida" id="medida" placeholder="Medida del producto" required>

				<label for="medida-test">Medida Test </label>
				<select name="medida-test" id="medida-test">
					<option value="" disabled selected>Selecciona una medida</option>
					<?php
					$query_medida = mysqli_query($conection, "SELECT id_measurement, measurement FROM product_measurement ORDER BY measurement ASC");
					while ($medida = mysqli_fetch_array($query_medida)) {
						echo '<option value="' . $medida['id_measurement'] . '">' . $medida['measurement'] . '</option>';
					}
					?>
					<option value="nueva_medida">Crear Nueva Medida</option>
				</select>

				<label for="nueva_medida" id="label-nueva-medida" style="display: none;">Registre la medida necesitada
				</label>
				<input type="text" name="nueva_medida" id="nueva_medida" placeholder="Nueva Medida"
					style="display: none;">
				<script>
					const labelNuevaMedida = document.getElementById("label-nueva-medida");
					const nuevaMedidaInput = document.getElementById("nueva_medida");

					document.getElementById("medida-test").addEventListener("change", function () {
						if (this.value === "nueva_medida") {
							labelNuevaMedida.style.display = "block";
							nuevaMedidaInput.style.display = "block";
							nuevaMedidaInput.setAttribute("required", "required");
						} else {
							labelNuevaMedida.style.display = "none";
							nuevaMedidaInput.style.display = "none";
							nuevaMedidaInput.removeAttribute("required");
						}
					});
				</script>




				<label for="proveedor">Proveedor</label>
				<select name="proveedor" id="proveedor" required>
					<?php
					$query_proveedor = mysqli_query($conection, "SELECT id_supplier, proveedor FROM proveedor WHERE estatus = 1 ORDER BY proveedor ASC");
					while ($proveedor = mysqli_fetch_array($query_proveedor)) {
						echo '<option value="' . $proveedor['id_supplier'] . '">' . $proveedor['proveedor'] . '</option>';
					}
					mysqli_close($conection);
					?>
				</select>

				<label for="precio">Precio </label>
				<input type="number" name="precio" id="precio" step="0.01" placeholder="Precio del producto" min="0"
					required>

				<label for="contenedores">Cantidad de Contenedores</label>
				<input type="number" name="contenedores" id="contenedores" placeholder="Contenedores" min="0" required>

				<label for="cajasPorContenedor">Cajas por Contenedor</label>
				<input type="number" name="cajasPorContenedor" id="cajasPorContenedor"
					placeholder="Cajas por Contenedor" min="0" required>

				<label for="unidadesPorCaja">Unidades por Caja</label>
				<input type="number" name="unidadesPorCaja" id="unidadesPorCaja" placeholder="Unidades por Caja" min="0"
					required>

				<div class="button-container">
					<input type="submit" name="submit" value="Registrar" class="btn_save">
				</div>
			</form>
		</div>
	</section>

</body>

</html>