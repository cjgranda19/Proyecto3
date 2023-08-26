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
	<title>Registro Producto</title>
	<link rel="stylesheet" href="css/popup.css">
</head>

<body>
	<section id="container-2">
	<span class="close-button" onclick="closePopup()">&times;</span>

		<div class="form_register">
			<hr>
			<div class="alert">
				<?php echo isset($alert) ? $alert : ''; ?>
			</div>

			<form id="registroForm" action="process/process_registro_producto.php" method="post">
				<h1>Registro Producto</h1>

				<label for="producto">Producto: </label>
				<input type="text" name="producto" id="producto" placeholder="Nombre del producto" required>

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

				<label for="precio">Precio: </label>
				<input type="number" name="precio" id="precio" step="0.01" placeholder="Precio del producto" required>

				<label for="cantidad">Cantidad: </label>
				<input type="number" name="cantidad" id="cantidad" placeholder="Stock" required>

				<div class="button-container">
					<input type="submit" name="submit" value="Registrar" class="btn_save">
				</div>
			</form>
		</div>
	</section>

</body>

</html>