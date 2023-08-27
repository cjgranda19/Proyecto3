<?php
session_start();
include "../conexion.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista Clientes</title>
	<link rel="stylesheet" type="text/css" href="css/style_tables.css">
	<link rel="stylesheet" type="text/css" href="css/popup.css">
	<link rel="icon" type="image/jpg" href="img/favicon.png" />


</head>


<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="alert">
			<?php
			echo isset($alert) ? $alert : '';
			echo isset($_SESSION['popup_message']) ? '<p class="msg_info" id="popupMessage">' . $_SESSION['popup_message'] . '</p>' : '';
			unset($_SESSION['popup_message']);
			?>
		</div>

		<script>
			setTimeout(function () {
				var popupMessage = document.getElementById("popupMessage");
				if (popupMessage) {
					popupMessage.style.display = "none";
				}
			}, 4000);
		</script>

		<h1>Lista de Clientes </h1>
		<?php if ($_SESSION['rol'] == 1) { ?> <a href="javascript:void(0);"
				onclick="loadPopupContent('registro_cliente.php',event);" class="btn_new">Nuevo
				cliente</a>
		<?php } ?>
		<form action="buscar_cliente.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" class="btn_search">
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

			$sql_registre = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM cliente WHERE estatus = 1 ");
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

			$query = mysqli_query($conection, "SELECT * FROM cliente WHERE estatus = 1 ORDER BY id_cliente ASC LIMIT $desde,$por_pagina");

			mysqli_close($conection);
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
							<a class="link_edit" href="editar_cliente.php?id=<?php echo $data['id_cliente']; ?>"><i
									class="fa-solid fa-pen-to-square"></i> Editar</a>

							<?php if ($_SESSION['rol'] == 1) { ?>
								<a class="link_delete"
									href="eliminar_confirmar_cliente.php?id=<?php echo $data['id_cliente']; ?>"><i
										class="fa-solid fa-trash"></i> Eliminar</a>
							<?php } ?>
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
	<div class="popup-container" id="popupContainer">
		<div class="popup-content" id="popupContent">
		</div>
		<span class="close-button" onclick="closePopup()">&times;</span>
	</div>

	<div class="overlay" id="overlay" onclick="closePopup()"></div>
</body>

</html>