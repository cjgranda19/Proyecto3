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
</head>

<style>
	#container h1{
		font-size: 35px;
		display: inline-block;
	}

	.btn_new{
		display: inline-block;
		background: #239baa;
		color: #fff;
		padding: 5px 25px;
		border-radius: 4px;
		margin: 20px;
	}

	form{
		background: #fff;
		margin: auto;
		padding: 20px 50px;
		border: 1px solid #d1d1d1;
	}

	input, select{
		display: block;
		width: 100%;
		font-size: 13pt;
		padding: 5px;
		border: 1px solid #85929e;
		border-radius: 5px;
	}


	table{
		border-collapse: collapse;
		font-size: 12pt;
		font-family: 'GothamBook';
		width: 100%;
	}

	table th{
		text-align: left;
		padding: 10px;
		background: #3d7ba8;
		color: #fff;
	}

	table tr:nth-child(odd){
		background: #fff;
	}

	table td{
		padding: 10px;
	}

	.link_edit{
		color: #0ca4ce;
	}

	.link_delete{
		color: #f26b6b;
	}

	.paginador ul{
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

	.paginador a, .pageSelected{
		color: #428bca;
		border: 1px solid #ddd;
		display: 5px;
		display: inline-block;
		font-size: 14px;
		text-align: center;
		width: 35px;
	}

	.paginador a:hover{
		background: #ddd;
	}

	.pageSelected{
		color: #fff;
		background: #428bca;
		border: 1px solid #428bca;
	}

	.form_search{
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

	.form_search .btn_search{
		background: #1faac8;
		color: #fff;
		padding: 0 20px;
		border: 0;
		cursor: pointer;
		margin-left: 10px;
	}

</style>



<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<?php

			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda)){
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

			//paginador
			$sql_registre = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM cliente WHERE (idcliente LIKE '%busqueda%' OR nit LIKE '%busqueda%' OR nombre LIKE '%busqueda%' OR telefono LIKE '%busqueda%' OR direccion LIKE '%busqueda%') AND estatus = 1 ");
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

			$query = mysqli_query($conection, "SELECT * FROM cliente WHERE 
								(idcliente LIKE '%$busqueda%' OR 
								nit LIKE '%$busqueda%' OR 
								nombre LIKE '%$busqueda%' OR 
								telefono LIKE '%$busqueda%' OR
								direccion LIKE '%$busqueda%') 
								AND 
								estatus = 1 ORDER BY idcliente ASC LIMIT $desde, $por_pagina");

			$result = mysqli_num_rows($query);
			if($result>0){
				while ($data = mysqli_fetch_array($query)){
		?>
			<tr>
				<td><?php echo $data['idcliente']; ?></td>
				<td><?php echo $data['nit']; ?></td>
				<td><?php echo $data['nombre']; ?></td>
				<td><?php echo $data['telefono']; ?></td>
				<td><?php echo $data['direccion']; ?></td>
				<td>
					<a class="link_edit" href="editar_cliente.php?id=<?php echo $data['idcliente']; ?>">Editar</a>

					<?php if($_SESSION['rol'] == 1){ ?>
					<a class="link_delete" href="eliminar_confirmar_cliente.php?id=<?php echo $data['idcliente']; ?>">Eliminar</a>
				<?php } ?>
				</td>
			</tr>

		<?php
				}
			}
		?>
			
		</table>

		<?php

			if(total_registro != 0){
		?>

		<div class="paginador">
			<ul>
				<?php
					if($pagina != 1){
				?>
					<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<</a></li>
					<li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><<</a></li>
				<?php
					}
					for ($i=1; $i <= $total_paginas; $i++){
						if($i==$pagina){
							echo '<li class="pageSelected">'.$i.'</li>';
						}else{
							echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
						}
					}

					if($pagina != $total_paginas){
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