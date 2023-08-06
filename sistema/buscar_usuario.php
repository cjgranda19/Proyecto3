<?php
	session_start();
	if($_SESSION['rol'] != 1){
		header("location: ./");
	}
	include "../conexion.php";
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista Usuarios</title>
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
				header('location: lista_usuarios.php');
				mysqli_close($conection);
			}

		?>


		<h1>Lista de usuarios</h1>
		<a href="registro_usuario.php" class="btn_new">Crear usuario</a>

		<form action="buscar_usuario.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" class="btn_search">
		</form>

		<table>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Correo</th>
				<th>Usuario</th>
				<th>Rol</th>
				<th>Acciones</th>
			</tr>
		<?php

			//paginador

			$rol = '';
			if($busqueda == 'administrador'){
				$rol = "OR rol LIKE '%1%'";
			}else if($busqueda == 'supervisor'){
				$rol = "OR rol LIKE '%2%'";
			}else if($busqueda == 'vendedor'){
				$rol = "OR rol LIKE '%3%'";
			}

			$sql_registre = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM usuario WHERE (idusuario LIKE '%busqueda%' OR nombre LIKE '%busqueda%' OR correo LIKE '%busqueda%' OR usuario LIKE '%busqueda%' $rol) AND estatus = 1 ");
			$result_registre = mysqli_fetch_array($sql_registre);
			$total_registro = $result_registre['total_registro'];

			$por_pagina = 8;

			if(empty($_GET['pagina'])){
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde= ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol 
								WHERE 
								(u.idusuario LIKE '%$busqueda%' OR 
								u.nombre LIKE '%$busqueda%' OR 
								u.correo LIKE '%$busqueda%' OR 
								u.usuario LIKE '%$busqueda%' OR
								r.rol LIKE '%$busqueda%') 
								AND 
								estatus = 1 ORDER BY u.usuario ASC LIMIT $desde, $por_pagina");

			$result = mysqli_num_rows($query);
			if($result>0){
				while ($data = mysqli_fetch_array($query)){
		?>
			<tr>
				<td><?php echo $data['idusuario']; ?></td>
				<td><?php echo $data['nombre']; ?></td>
				<td><?php echo $data['correo']; ?></td>
				<td><?php echo $data['usuario']; ?></td>
				<td><?php echo $data['rol']; ?></td>
				<td>
					<a class="link_edit" href="editar_usuario.php?id=<?php echo $data['idusuario']; ?>">Editar</a>

					<?php if($data["idusuario"] != 1){ ?>
					<a class="link_delete" href="eliminar_confirmar_usuario.php?id=<?php echo $data['idusuario']; ?>">Eliminar</a>
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