<?php
session_start();
include "../conexion.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista Productos</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="css/lista_producto.css">
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
	<h1>Lista de Productos</h1>

	<?php
		if ($_SESSION['rol'] == 1) {
			?>
		<a href="registro_producto.php" class="btn_new">Nuevo producto</a>
		<a href="ingreso_producto.php" class="btn_new">Ingreso Producto</a>

		<?php } ?>

		<form action="buscar_producto.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" class="btn_search">
		</form>

		<table>
			<tr>
				<th>Código</th>
				<th>Nombre producto</th>
				<th>Proveedor</th>
				<th>Precio</th>
				<th>Stock</th>
				<th>Medida</th>
				<?php
			if ($_SESSION['rol'] == 1) {
				?>
				<th>Acciones</th>
				<?php } ?>
			</tr>
			<?php
			$sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM producto WHERE estatus = 1 ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 10;

			if (empty($_GET['pagina'])) {
				$pagina = 1;
			} else {
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina - 1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = "SELECT p.codproducto, p.proveedor, p.descripcion, p.precio, p.existencia, p.medida_pro, pr.proveedor FROM producto p INNER JOIN proveedor pr ON p.proveedor = pr.codproveedor WHERE p.estatus = 1 ORDER BY p.codproducto ASC LIMIT $desde,$por_pagina";

			$result = mysqli_query($conection, $query);

			if (!$result) {
				die("Error en la consulta: " . mysqli_error($conection));
			}

			while ($data = mysqli_fetch_array($result)) {
				?>
				<tr>
					<td>
						<?php echo $data['codproducto']; ?>
					</td>
					<td>
						<?php echo $data['descripcion']; ?>
					</td>
					<td>
						<?php echo $data['proveedor']; ?>
					</td>
					<td>
						<?php echo $data['precio']; ?>
					</td>
					<td>
						<?php echo $data['existencia']; ?>
					</td>
					<td>
						<?php echo $data['medida_pro']; ?>
					</td>
					<?php if ($_SESSION['rol'] == 1) { ?>
						<td>
							<a class="link_edit" href="editar_producto.php?id=<?php echo $data['codproducto']; ?>"><i
									class="fa-solid fa-pen-to-square"></i> Editar</a>

							<a class="link_delete"
								href="eliminar_confirmar_producto.php?id=<?php echo $data['codproducto']; ?>"><i
									class="fa-solid fa-trash"></i> Eliminar</a>
						</td>
					<?php } ?>
				</tr>
			<?php } ?>

		</table>

		<div class="paginador">
			<ul>
				<?php
				if ($pagina != 1) {
					?>
					<li><a href="?pagina=<?php echo 1; ?>"><i class="fa-solid fa-backward-step"></i></a></li>
					<li><a href="?pagina=<?php echo $pagina - 1; ?>"><i class="fa-solid fa-backward"></i></a></li>
					<?php
				}
				for ($i = 1; $i <= $total_paginas; $i++) {
					if ($i == $pagina) {
						echo '<li class="pageSelected">' . $i . '</li>';
					} else {
						echo '<li><a href="?pagina=' . $i . '">' . $i . '</a></li>';
					}
				}

				if ($pagina != $total_paginas) {
					?>
					<li><a href="?pagina=<?php echo $pagina + 1; ?>"><i class="fa-solid fa-forward"></i></a></li>
					<li><a href="?pagina=<?php echo $total_paginas; ?> "><i class="fa-solid fa-forward-step"></i></a></li>
				<?php } ?>
			</ul>
		</div>

	</section>
	<?php include "includes/footer.php"; ?>
</body>

</html>
