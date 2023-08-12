<?php
	
	session_start();
	if($_SESSION['rol'] != 1){
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST)){

		$alert = '';

		if(empty($_POST['producto']) || empty($_POST['precio']) || empty($_POST['cantidad']) || $_POST['precio'] <= 0 || $_POST['cantidad'] <=0){
			$alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$codproducto = $_POST['id'];
			$producto = $_POST['producto'];
			$proveedor = $_POST['proveedor'];
			$precio = $_POST['precio'];
			$cantidad = $_POST['cantidad'];
			$medida = $_POST['medida'];

			$query_insert = mysqli_query($conection, "UPDATE producto SET descripcion = '$producto', proveedor = $proveedor,  precio = $precio, existencia = $cantidad, medida_pro = '$medida' WHERE codproducto = $codproducto ");

			if($query_insert){
				$alert = '<p class="msg_save">Producto actualizado correctamente.</p>';
			}else{
				$alert = '<p class="msg_error">Error al actualizar producto.</p>';
			}
		}	
	}

	//validar producto
	if(empty($_REQUEST['id'])){
		header("location: lista_producto.php");
	}else{
		$id_producto = $_REQUEST['id'];
		if(!is_numeric($id_producto)){
			header("location: lista_producto.php");
		}

		$query_producto = mysqli_query($conection, "SELECT p.codproducto, p.proveedor, p.descripcion, p.precio, p.existencia, p.medida_pro, pr.proveedor FROM producto p INNER JOIN proveedor pr ON p.proveedor = pr.codproveedor WHERE p.codproducto = $id_producto AND p.estatus = 1");
		$result_producto = mysqli_num_rows($query_producto);

		if($result_producto > 0){
			$data_producto = mysqli_fetch_assoc($query_producto);
		}else{
			header("location: lista_producto.php");
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Producto</title>
	<link rel="stylesheet" href="css/editar_producto.css">
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar Producto</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $data_producto['codproducto']; ?>">
				
				<label for="producto">Producto: </label>
				<input type="text" name="producto" id="producto"placeholder="Nombre del producto" value="<?php echo $data_producto['descripcion']; ?>">

				<label for="proveedor">Proveedor</label>

				<?php
					$query_proveedor = mysqli_query($conection, "SELECT * FROM proveedor WHERE estatus = 1 ORDER BY proveedor ASC");
					$result_proveedor = mysqli_num_rows($query_proveedor);
					mysqli_close($conection);
				?>

				<select name="proveedor" id="proveedor" class="notItemOne">
					<option value="<?php echo $data_producto['codproveedor']; ?>" selected><?php echo $data_producto['proveedor']; ?></option>
				<?php

					if($result_proveedor > 0){
						while($proveedor = mysqli_fetch_array($query_proveedor)){
				?>
					<option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?>
					</option>
				<?php
						}
					}
				?>

				</select>

				<label for="precio">Precio: </label>
				<input type="number" name="precio" id="precio" step="0.01" placeholder="Precio del producto" value="<?php echo $data_producto['precio']; ?>">
				<label for="cantidad">Cantidad: </label>
				<input type="number" name="cantidad" id="cantidad" placeholder="Stock" value="<?php echo $data_producto['existencia']; ?>">

				<label for="medida">Medida</label>
				<select name="medida" id="medida" class="notItemOne">
					<option value="<?php echo $data_producto['medida_pro']; ?>" selected><?php echo $data_producto['medida_pro']; ?></option>
					<option value="Kilogramos">Kilogramos</option>
					<option value="Litros">Litros</option>
					<option value="Unidades">Unidades</option>
					<option value="Onzas">Onzas</option>
					<option value="Libras">Libras</option>
				</select>

				<input type="submit" value="Actualizar producto" class="btn_save">

			</form>
		</div>
		
	</section>
	
	<?php include "includes/footer.php"; ?>

</body>
</html>
