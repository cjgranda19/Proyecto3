<?php

session_start();
if ($_SESSION['rol'] != 1) {
	header("location: ./");
}
include "../conexion.php";

if (!empty($_POST)) {

	$alert = '';

	if (empty($_POST['producto']) || empty($_POST['proveedor']) || empty($_POST['precio']) || empty($_POST['cantidad'])  || $_POST['precio'] <= 0 || $_POST['cantidad'] <= 0) {
		$alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
	} else {

		$producto = $_POST['producto'];
		$proveedor = $_POST['proveedor'];
		$precio = $_POST['precio'];
		$cantidad = $_POST['cantidad'];
		$usuario_id = $_SESSION['idUser'];

		$query_insert = mysqli_query($conection, "INSERT INTO producto(descripcion, proveedor, precio,existencia, usuario_id) VALUES('$producto', '$proveedor', '$precio','$cantidad', '$usuario_id')");

		if ($query_insert) {
			$alert = '<p class="msg_save">Producto guardado correctamente.</p>';
		} else {
			$alert = '<p class="msg_error">Error al guardar producto.</p>';
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Producto</title>
	<link rel="stylesheet" href="css/nuevo_producto.css">
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<div class="form_register">
			<h1>Registro Producto</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">

				<label for="producto">Producto: </label>
				<input type="text" name="producto" id="producto" placeholder="Nombre del producto">

				<label for="proveedor">Proveedor</label>

				<?php

				$query_proveedor = mysqli_query($conection, "SELECT codproveedor, proveedor FROM proveedor WHERE estatus = 1 ORDER BY proveedor ASC");
				$result_proveedor = mysqli_num_rows($query_proveedor);
				mysqli_close($conection);
				?>

				<select name="proveedor" id="proveedor">
					<?php

					if ($result_proveedor > 0) {
						while ($proveedor = mysqli_fetch_array($query_proveedor)) {
					?>
							<option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?>
							</option>
					<?php
						}
					}
					?>

				</select>

				<label for="precio">Precio: </label>
				<input type="number" name="precio" id="precio" step="0.01" placeholder="Precio del producto">
				<label for="cantidad">Cantidad: </label>
				<input type="number" name="cantidad" id="cantidad" placeholder="Stock">
				<input type="submit" value="Guardar producto" class="btn_save">

			</form>
		</div>

	</section>

	<?php include "includes/footer.php"; ?>


</body>

</html>
