<?php
	session_start();
	include "../conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<link type="text/css" rel="stylesheet" href="css/estilo.css">
	<title>Lista Productos</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<?php

			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda)){
				header('location: lista_proveedor.php');
				mysqli_close($conection);
			}

		?>

		<h1>Lista de productos</h1>
		<a href="registro_producto.php" class="btn_new">Nuevo producto</a>

		<form action="buscar_producto.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
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
				<th>Foto</th>
				<th>Acciones</th>
			</tr>
		<?php

			//paginador
			$sql_registre = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM proveedor WHERE (codproducto LIKE '%busqueda%' OR proveedor LIKE '%busqueda%' OR medida_pro LIKE '%busqueda%' OR descripcion LIKE '%busqueda%' OR precio LIKE '%busqueda%' OR existencia LIKE '%busqueda%') AND estatus = 1 ");
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

			$query = mysqli_query($conection, "SELECT * FROM producto WHERE 
								(codproducto LIKE '%$busqueda%' OR 
								descripcion LIKE '%$busqueda%' OR 
								proveedor LIKE '%$busqueda%' OR
								precio LIKE '%$busqueda%' OR 
								medida_pro LIKE '%$busqueda%' OR
								existencia LIKE '%$busqueda%') 
								AND 
								estatus = 1 ORDER BY codproducto ASC LIMIT $desde, $por_pagina");

			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result>0){
				while ($data = mysqli_fetch_array($query)){
					if($data['foto'] != "img_producto.png"){
						$foto = 'img/uploads/'.$data['foto'];
					}else{
						$foto = 'img/'.$data['foto'];
					}
		?>
			<tr>
				<td><?php echo $data['codproducto']; ?></td>
				<td><?php echo $data['descripcion']; ?></td>
				<td><?php echo $data['proveedor']; ?></td>
				<td><?php echo $data['precio']; ?></td>
				<td><?php echo $data['existencia']; ?></td>
				<td><?php echo $data['medida_pro']; ?></td>
				<td class="img_de_producto"><img src="<?php echo $foto; ?>" alt="<?php echo $data['descripcion']; ?>"></td>

				<?php if($_SESSION['rol'] == 1){ ?>
				<td>
					<a class="link_edit" href="editar_producto.php?id=<?php echo $data['codproducto']; ?>">Editar</a>
					<a class="link_delete" href="eliminar_confirmar_producto.php?id=<?php echo $data['codproducto']; ?>"> Eliminar</a>
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