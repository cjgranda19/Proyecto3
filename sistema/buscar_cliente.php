<?php
session_start();
include "../conexion.php";
include('includes/session_timeout.php');


if ($_SESSION['rol'] != 1) {
	if ($_SESSION['rol'] == 3) {
		header("location: index.php");
	} elseif ($_SESSION['rol'] == 2) {
		header("location: index.php");
	} else {
		header("location: ./");
	}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista Clientes</title>
	<link rel="stylesheet" type="text/css" href="css/style_tables.css">
</head>

<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<?php

		$busqueda = strtolower($_REQUEST['busqueda']);
		if (empty($busqueda)) {
			header('location: lista_clientes.php');
			mysqli_close($conection);
		}

		?>


		<h1>Lista de clientes</h1>
		<a href="registro_cliente.php" class="btn_new">Crear cliente</a>

		<form action="buscar_cliente.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<th>ID</th>
				<th>Cédula</th>
				<th>Nombre</th>
				<th>Teléfono</th>
				<th>Dirección</th>
				<th>Acciones</th>
			</tr>
			<?php

			$sql_registre = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM cliente WHERE (id_cliente LIKE '%busqueda%' OR cedula LIKE '%busqueda%' OR nombre LIKE '%busqueda%' OR telefono LIKE '%busqueda%' OR direccion LIKE '%busqueda%') AND estatus = 1 ");
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

			$query = mysqli_query($conection, "SELECT * FROM cliente WHERE 
								cedula LIKE '%$busqueda%' OR 
								nombre LIKE '%$busqueda%' OR 
								telefono LIKE '%$busqueda%' OR
								direccion LIKE '%$busqueda%') 
								AND 
								estatus = 1 ORDER BY id_cliente ASC LIMIT $desde, $por_pagina");

			$result = mysqli_num_rows($query);
			if ($result > 0) {
				while ($data = mysqli_fetch_array($query)) {
					?>
					<tr>
						<td>
							<?php echo $data['id_cliente']; ?>
						</td>
						<td>
							<?php echo $data['cedula']; ?>
						</td>
						<td>
							<?php echo $data['nombre']; ?>
						</td>
						<td>
							<?php echo $data['telefono']; ?>
						</td>
						<td>
							<?php echo $data['direccion']; ?>
						</td>
						<td>
							<a class="link_edit" href="editar_cliente.php?id=<?php echo $data['id_cliente']; ?>">Editar</a>

							<?php if ($_SESSION['rol'] == 1) { ?>
								<a class="link_delete"
									href="eliminar_confirmar_cliente.php?id=<?php echo $data['id_cliente']; ?>">Eliminar</a>
							<?php } ?>
						</td>
					</tr>

					<?php
				}
			}
			?>

		</table>

		<?php

		if (total_registro != 0) {
			?>

			<div class="paginador">
				<ul>
					<?php
					if ($pagina != 1) {
						?>
						<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<< /a>
						</li>
						<li><a href="?pagina=<?php echo $pagina - 1; ?>&busqueda=<?php echo $busqueda; ?>">
								<<< /a>
						</li>
						<?php
					}
					for ($i = 1; $i <= $total_paginas; $i++) {
						if ($i == $pagina) {
							echo '<li class="pageSelected">' . $i . '</li>';
						} else {
							echo '<li><a href="?pagina=' . $i . '&busqueda=' . $busqueda . '">' . $i . '</a></li>';
						}
					}

					if ($pagina != $total_paginas) {
						?>
						<li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>">>></a></li>
						<li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?>">>|</a></li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
	</section>
	<?php include "includes/footer.php"; ?>
</body>

</html>