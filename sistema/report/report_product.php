<?php
session_start();
include "../../conexion.php";

?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<link rel="stylesheet" type="text/css" href="../css/style_tables.css">


</head>

<body>
	<section id="container">

		<h4>Desde</h4>
		<label for="first_date">DateTime:</label>
		<input type="date" name="first_date" id="first_date">
		<h4>Hasta</h4>
		<label for="second_date">DateTime:</label>
		<input type="date" name="second_date" id="second_date">
		<label for="textfield">Text Field:</label>
		<input type="text" name="textfield" id="textfield">
		<input type="submit" value="Enviar">



		<table>
			<tr>
				<th>Nombre</th>
				<th>Precio Actual</th>
				<th>Promedio Precio</th>
				<th>Stock</th>
				<th>Dirección</th>
			</tr>
			<?php

			$sql_registre = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM product_i ");
			$result_registre = mysqli_fetch_array($sql_registre);
			$total_registro = $result_registre['total_registro'];

			$por_pagina = 10;

			if (empty($_GET['pagina'])) {
				$pagina = 1;
			} else {
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina - 1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection, "SELECT * FROM product_i LIMIT $desde, $por_pagina");
			
		
			while ($data = mysqli_fetch_array($query)) {
				$product_id = $data['id_producto'];
				echo "<script>console.log('Product ID:', $product_id);</script>";

				$avg_query = mysqli_query($conection, "SELECT AVG(new_price) as average_price FROM product_log_update WHERE producto_id = $product_id");
				$avg_data = mysqli_fetch_array($avg_query);
				$average_price = $avg_data['average_price'];

				?>
				<tr>
					<td>
						<?php echo $data['name']; ?>
					</td>
					<td>
						<?php echo $data['price']; ?>
					</td>
					<td>
						<?php echo $average_price; ?>
					</td>
					<td>
						<?php echo $data['telefono']; ?>
					</td>
					<td>
						<?php echo $data['direccion']; ?>
					</td>
				</tr>
				<?php
			}
			?>

		</table>

		<div class="paginador">
			<ul>
				<?php
				if ($pagina != 1) {
					?>
					<li><a href="?pagina=1">&laquo;&laquo;</a></li>
					<li><a href="?pagina=<?php echo $pagina - 1; ?>">&laquo;</a></li>
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
					<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
					<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
				<?php } ?>
			</ul>
		</div>
	</section>
</body>

</html>