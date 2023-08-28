<?php
session_start();

?>
<nav>
	<ul>
		<li><a href="index.php"><i class="fa-solid fa-house"></i> Inicio</a></li>
		<?php
		if ($_SESSION['rol'] == 1) {
			?>
			<li class="principal">
				<a href="lista_usuarios.php"><i class="fa-solid fa-user"></i> Usuarios</a>

			</li>
		<?php } ?>



		<?php
		if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
			?>

			<li class="principal">

				<a href="lista_proveedor.php"><i class="fa-solid fa-truck-field"></i> Proveedores</a>

			</li>
		<?php } ?>
		<li class="principal">
			<a href="lista_producto.php"><i class="fa-solid fa-box-open"></i> Productos</a>

		</li>



		<?php if ($_SESSION['rol'] == 3 || $_SESSION['rol'] == 1 ) { ?>
			<li class="principal">
				<a href="lista_htecnica.php"><i class="fa-solid fa-clipboard-list"></i> Hoja Técnica</a>
				<ul>
					<li><a href="lista_htecnica.php"><i class="fa-solid fa-list"></i> Lista</a></li>
					<li><a href="registro_htecnica.php"><i class="fa-solid fa-plus"></i> Crear</a></li>
				</ul>
			</li>

			<li class="principal">
				<a href="lista_ordenes.php"><i class="fa-solid fa-arrow-up-wide-short"></i> Órdenes</a>
				<ul>
					<li><a href="lista_ordenes.php"><i class="fa-solid fa-list"></i> Lista de órdenes</a></li>
					<li><a href="crear_orden.php"><i class="fa-solid fa-plus"></i> Crear</a></li>
				</ul>
			</li>
		<?php } ?>



		<li class="principal">

		
				<a href="lista_clientes.php"><i class="fa-solid fa-person"></i> Clientes</a>
				<ul>

			
			</ul>
		</li>
		<li class="principal">

			<?php
			if ($_SESSION['rol'] == 1) {
				?>
				<a href="#"><i class="fa-solid fa-person"></i> Reportes</a>
				<ul>
					<li><a href="inventario_original.php">Inventario inicial completo</a></li>
					<li><a href="report_product.php">Reporte Producto</a></li>
					<li><a href="report_cliente.php">Reporte Cliente</a></li>
				<?php } ?>
			</ul>
		</li>
	</ul>
</nav>