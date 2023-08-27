<nav>
	<ul>
		<li><a href="index.php"><i class="fa-solid fa-house"></i> Inicio</a></li>
		<?php
		if ($_SESSION['rol'] == 1) {
			?>
			<li class="principal">
				<a href="lista_usuarios.php"><i class="fa-solid fa-user"></i> Usuarios</a>
				<ul>
					<li><a href="lista_usuarios.php"><i class="fa-solid fa-users"></i> Lista de Usuarios</a></li>
					<li><a href="registro_usuario.php"><i class="fa-solid fa-user-plus"></i> Nuevo Usuario</a></li>
				</ul>
			</li>
		<?php } ?>
		<?php
		if ($_SESSION['rol'] == 1) {
			?>

			<li class="principal">

				<a href="lista_proveedor.php"><i class="fa-solid fa-truck-field"></i> Proveedores</a>
				<ul>
					<li><a href="lista_proveedor.php"><i class="fa-solid fa-users"></i> Lista de Proveedores</a></li>
					<li><a href="registro_proveedor.php"><i class="fa-solid fa-user-plus"></i> Nuevo Proveedor</a></li>
				</ul>
			</li>
		<?php } ?>
		<li class="principal">
			<a href="lista_producto.php"><i class="fa-solid fa-box-open"></i> Productos</a>
			
		</li>
		<li class="principal">
			<a href="lista_htecnica.php"><i class="fa-solid fa-clipboard-list"></i> Hoja Tecnica</a>
			<ul>
				<li><a href="lista_htecnica.php"><i class="fa-solid fa-list"></i> Lista</a></li>

				<?php
				if ($_SESSION['rol'] == 1) {
					?>
					<li><a href="registro_htecnica.php"><i class="fa-solid fa-plus"></i> Crear</a></li>
				<?php } ?>
			</ul>
		</li>
		<li class="principal">
			<a href="lista_ordenes.php"><i class="fa-solid fa-arrow-up-wide-short"></i> Órdenes</a>
			<ul>
				<li><a href="lista_ordenes.php"><i class="fa-solid fa-list"></i> Lista de órdenes</a></li>
				<li><a href="crear_orden.php"><i class="fa-solid fa-list"></i> Crear</a></li>

			</ul>
		</li>

		<li class="principal">

			<?php
			if ($_SESSION['rol'] == 1) {
				?>
				<a href="lista_clientes.php"><i class="fa-solid fa-person"></i> Clientes</a>
				<ul>
					<li><a href="buscar_cliente.php">Clientes</a></li>
					<li><a href="registro_cliente.php">Registro Cliente</a></li>

				<?php } ?>
			</ul>
		</li>
		<li class="principal">

			<?php
			if ($_SESSION['rol'] == 1) {
				?>
				<a href="lista_clientes.php"><i class="fa-solid fa-person"></i> Reportes</a>
				<ul>
					<li><a href="inventario_original.php">Inventario original</a></li>
					<li><a href="report/report_producto.php">Reportess</a></li>

				<?php } ?>
			</ul>
		</li>
	</ul>
</nav>