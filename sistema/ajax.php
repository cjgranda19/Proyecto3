<?php
session_start();
include '../conexion.php';



if (!empty($_POST)) {

	if ($_POST['action'] == 'getProducts') {
		$id = intval($_POST['id'] ?? 0);
		$query = mysqli_query($conection, "SELECT * FROM producto " . ($id > 0 ? "WHERE codproducto = $id" : ""));
		mysqli_close($conection);
		$result = mysqli_num_rows($query);
		$products = [];

		if ($result > 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				$products[] = $row;
			}
		}

		echo json_encode($products, JSON_UNESCAPED_UNICODE);
		exit;
	}

	if ($_POST['action'] == 'infoProducto') {
		$producto_id = $_POST['producto'];

		$query = mysqli_query($conection, "SELECT codproducto, descripcion, precio, existencia FROM producto WHERE codproducto = $producto_id AND estatus = 1");

		mysqli_query($conection);

		$result = mysqli_num_rows($query);
		if ($result > 0) {
			$data = mysqli_fetch_assoc($query);
			echo json_encode($data, JSON_UNESCAPED_UNICODE);
			exit;
		}
		echo 'error';
		exit;
	}

	// Buscar cliente
	if ($_POST['action'] == 'searchCliente') {
		if (!empty($_POST['cliente'])) {
			$cedula = $_POST['cliente'];

			$query = mysqli_query($conection, "SELECT * FROM cliente WHERE cedula LIKE '$cedula' AND estatus = 1 ");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			$data = '';

			if ($result > 0) {
				$data = mysqli_fetch_assoc($query);
			} else {
				$data = 0;
			}
			echo json_encode($data, JSON_UNESCAPED_UNICODE);
		}
		exit;

	}

	
	// Buscar Producto
	if ($_POST['action'] == 'searchProduct') {
		if (!empty($_POST['producto'])) {
			$producto = $_POST['producto'];
			
			$query = mysqli_query($conection, "SELECT * FROM producto WHERE descripcion LIKE '%$producto%' AND estatus = 1 ");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			$data = '';

			if ($result > 0) {
				$data = mysqli_fetch_assoc($query);
			} else {
				$data = 0;
			}
			echo json_encode($data, JSON_UNESCAPED_UNICODE);
		}
		exit;

	}
}
			
exit;

?>