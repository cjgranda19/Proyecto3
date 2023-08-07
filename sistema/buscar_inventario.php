<?php
	session_start();
	include "../conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista Inventario</title>
	<link type="text/css" rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<?php
			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda)){
				header('location: lista_utilidad.php');
				mysqli_close($conection);
			}
		?>

		<h1>Lista de materia prima</h1>
		<a href="nueva_utilidad.php" class="btn_new">Nueva materia prima</a>

		<form action="buscar_inventario.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" class="btn_search">
		</form>

		<table>
			<tr>
				<th>Código</th>
				<th>Materia prima</th>
				<th>Cantidad</th>
				<th>Proveedor</th>
				<th>Acciones</th>
			</tr>
		<?php

			//paginador
			$sql_registre = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM inventario WHERE (cod_inventario LIKE '%busqueda%' OR nombre_inventario LIKE '%busqueda%' OR cantidad_inventario LIKE '%busqueda%' OR proveedor LIKE '%busqueda%') AND estatus = 1 ");
			$result_registre = mysqli_fetch_array($sql_registre);
			$total_registro = $result_registre['total_registro'];

			$por_pagina = 4;

			if(empty($_GET['pagina'])){
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde= ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection, "SELECT * FROM inventario WHERE 
								(cod_inventario LIKE '%$busqueda%' OR 
								nombre_inventario LIKE '%$busqueda%' OR 
								cantidad_inventario LIKE '%$busqueda%' OR 
								proveedor LIKE '%$busqueda%') 
								AND 
								estatus = 1 ORDER BY cod_inventario ASC LIMIT $desde, $por_pagina");

			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result>0){
				while ($data = mysqli_fetch_array($query)){
		?>
			<tr>
				<td><?php echo $data['cod_inventario']; ?></td>
				<td><?php echo $data['nombre_inventario']; ?></td>
				<td><?php echo $data['cantidad_inventario']; ?></td>
				<td><?php echo $data['proveedor']; ?></td>

				<?php if($_SESSION['rol'] == 1){ ?>
				<td>
					<a class="link_edit" href="editar_inventario.php?id=<?php echo $data['cod_inventario']; ?>">Editar</a>
					<a class="link_delete" href="eliminar_confirmar_inventario.php?id=<?php echo $data['cod_inventario']; ?>"> Eliminar</a>
				</td>
				<?php } ?>
			</tr>

		<?php
				}
			}
		?>
			
		</table>

		<div class="paginador">
			<ul>
				<?php
					if($pagina != 1){
				?>
					<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
					<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
				<?php
					}
					for ($i=1; $i <= $total_paginas; $i++){
						if($i==$pagina){
							echo '<li class="pageSelected">'.$i.'</li>';
						}else{
							echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
						}
					}

					if($pagina != $total_paginas){
				?>	
					<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
					<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
				<?php } ?>
			</ul>
		</div>

	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>