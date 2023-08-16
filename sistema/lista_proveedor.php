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
	<?php include "includes/scripts.php"; ?>
	<title>Lista Proveedores</title>
</head>

<style>
	#container h1 {
		font-size: 35px;
		display: inline-block;
	}

	.btn_new {
		display: inline-block;
		background: rgb(107, 2, 46);
		color: #fff;
		padding: 5px 25px;
		border-radius: 4px;
		margin: 20px;
	}

	.btn_new {
		transition: transform 0.3s ease-in-out;
	}

	.btn_new:hover {
		transform: scale(1.02);
	}

	form {
		background: #fff;
		margin: auto;
		padding: 20px 50px;
		border: 1px solid #d1d1d1;
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


	table {
		border-collapse: collapse;
		font-size: 12pt;
		font-family: 'GothamBook';
		width: 100%;
	}

	table th {
		text-align: left;
		padding: 10px;
		background: rgb(192, 27, 96);
		color: #fff;
	}

	table tr:nth-child(odd) {
		background: #fff;
	}

	table td {
		padding: 10px;
	}

	.link_edit {
		color: #0ca4ce;
	}

	.link_delete {
		color: #f26b6b;
	}

	.link_edit:hover {
		color: #13a727;
	}

	.link_delete:hover {
		color: #fc0101;
	}

	.paginador ul {
		padding: 15px;
		list-style: none;
		background: #fff;
		margin-top: 15px;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flex;
		display: flex;
		justify-content: flex-end;
	}

	.paginador a,
	.pageSelected {
		color: #428bca;
		border: 1px solid #ddd;
		display: 5px;
		display: inline-block;
		font-size: 14px;
		text-align: center;
		width: 35px;
	}

	.paginador a:hover {
		background: #ddd;
	}

	.pageSelected {
		color: #fff;
		background: #428bca;
		border: 1px solid #428bca;
	}

	.form_search {
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flex;
		display: -o-flex;
		display: flex;
		float: right;
		background: initial;
		padding: 10px;
		border-radius: 10px;
	}

	.form_search .btn_search {
		background: rgb(107, 2, 46);
		color: #fff;
		padding: 0 20px;
		border: 0;
		cursor: pointer;
		margin-left: 10px;
	}

	.btn_search {
		transition: transform 0.3s ease-in-out;
	}

	.btn_search:hover {
		transform: scale(1.02);
	}
</style>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<h1>Lista de proveedores</h1>
		<?php
		if ($_SESSION['rol'] == 1) {
			?>
			<a href="registro_proveedor.php" class="btn_new">Nuevo proveedor</a>
		<?php } ?>
		<form action="buscar_proveedor.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" class="btn_search">
		</form>

		<table>
			<tr>
				<th>ID</th>
				<th>Proveedor</th>
				<th>Contacto</th>
				<th>Teléfono</th>
				<th>Dirección</th>
				<th>Fecha</th>
				<th>Acciones</th>
			</tr>
			<?php

			//paginador
			$sql_registre = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM proveedor WHERE estatus = 1 ");
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

			$query = mysqli_query($conection, "SELECT * FROM proveedor WHERE estatus = 1 ORDER BY codproveedor ASC LIMIT $desde,$por_pagina");

			mysqli_close($conection);
			$result = mysqli_num_rows($query);
			if ($result > 0) {
				while ($data = mysqli_fetch_array($query)) {

					$formato = 'Y-m-d H:i:s';
					$fecha = DateTime::createFromFormat($formato, $data['date_add']);
					?>
					<tr>
						<td>
							<?php echo $data['codproveedor']; ?>
						</td>
						<td>
							<?php echo $data['proveedor']; ?>
						</td>
						<td>
							<?php echo $data['contacto']; ?>
						</td>
						<td>
							<?php echo $data['telefono']; ?>
						</td>
						<td>
							<?php echo $data['direccion']; ?>
						</td>
						<td>
							<?php echo $fecha->format('d-m-Y'); ?>
						</td>
						<td>
							<a class="link_edit" href="editar_proveedor.php?id=<?php echo $data['codproveedor']; ?>"><i
									class="fa-solid fa-pen-to-square"></i> Editar</a>

							<a class="link_delete"
								href="eliminar_confirmar_proveedor.php?id=<?php echo $data['codproveedor']; ?>"><i
									class="fa-solid fa-trash"></i> Eliminar</a>
						</td>
					</tr>

					<?php
				}
			}
			?>

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