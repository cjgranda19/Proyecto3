<?php
session_start();
include "../conexion.php";
include "includes/session_timeout.php";


if (!empty($_POST)) {

	$alert = '';

	if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['cedula'])) {
		$alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
	} else {
		include "../conexion.php";

		$id_cliente = $_POST['id'];
		$cedula = $_POST['cedula'];
		$nombre = $_POST['nombre'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];

		$query = mysqli_query($conection, "SELECT * FROM cliente WHERE cedula = '$cedula' AND id_cliente != $id_cliente");

		$result = mysqli_fetch_array($query);

		if ($result !== null) {
			$alert = '<p class="msg_error">La cédula ya está registrada.</p>';
		} else {
			$sql_update = mysqli_query($conection, "UPDATE cliente SET cedula = '$cedula', nombre='$nombre', telefono='$telefono', direccion='$direccion' WHERE id_cliente=$id_cliente ");

			if ($sql_update) {
				$alert = '<p class="msg_save">Cliente actualizado correctamente.</p>';
			} else {
				$alert = '<p class="msg_error">Error al actualizar el cliente.</p>';
			}
		}
	}
}

if (empty($_REQUEST['id'])) {
	header('Location: lista_clientes.php');
	mysqli_close($conection);
}
$id_cliente = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT * FROM cliente WHERE id_cliente = $id_cliente ");

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
	header('Location: lista_clientes.php');
} else {
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {
		$id_cliente = $data['id_cliente'];
		$cedula = $data['cedula'];
		$nombre = $data['nombre'];
		$telefono = $data['telefono'];
		$direccion = $data['direccion'];
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Cliente</title>
	<link rel="icon" type="image/jpg" href="img/favicon.png" />
</head>

<style>
	.form_register {
		width: 450px;
		margin: auto;
	}

	.form_register h1 {
		color: #3c93b0;
	}

	hr {
		border: 0;
		background: #ccc;
		height: 1px;
		margin: 10px 0;
		display: block;
	}

	form {
		background: #fff;
		margin: auto;
		padding: 20px 50px;
		border: 1px solid #d1d1d1;
	}

	label {
		display: block;
		font-size: 12pt;
		font-family: 'Roboto', sans-serif;
		margin: 15px auto 5px auto;
	}

	input,
	select {
		display: block;
		width: 100%;
		font-size: 13pt;
		padding: 5px;
		border: 1px solid #85929e;
		border-radius: 5px;
	}

	.btn_save {
		font-size: 12pt;
		background: #12a4c6;
		padding: 10px;
		letter-spacing: 1px;
		border: 0;
		cursor: pointer;
		margin: 15px auto;
	}

	.alert {
		width: 100%;
		background: #66e07d66;
		border-radius: 6px;
		margin: 20px auto;
	}

	.msg_error {
		color: #e65656;
	}

	.msg_save {
		color: #126e00;
	}

	.alert p {
		padding: 10px;
	}
</style>



<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<div class="form_register">
			<h1>Actualizar cliente</h1>
			<hr>
			<div class="alert">
				<?php echo isset($alert) ? $alert : ''; ?>
			</div>

			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $id_cliente; ?>">
				<label for="cedula">Cédula: </label>
				<input type="text" name="cedula" id="cedula" placeholder="Número de CI" maxlength="10" minlength="10"
					value="<?php echo $cedula; ?>">
				<label for="nombre">Nombre: </label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo"
					value="<?php echo $nombre; ?>">
				<label for="telefono">Teléfono: </label>
				<input type="text" name="telefono" id="telefono" placeholder="Teléfono" maxlength="10" minlength="10"
					value="<?php echo $telefono; ?>">
				<label for="direccion">Dirección: </label>
				<input type="text" name="direccion" id="direccion" placeholder="Dirección completa"
					value="<?php echo $direccion; ?>">
				<input type="submit" value="Actualizar cliente" class="btn_save">
			</form>

	</section>
</body>

</html>