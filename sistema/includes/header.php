<?php
    require_once(__DIR__ . '/functions.php');

    if (!isset($_SESSION)) {
        session_start();
    }

	if(empty($_SESSION['active'])){
		header('location: ../');
	}

?>

	<link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<header>
		<div class="header">
			
			<h1>Citaviso</h1>
			<div class="optionsBar">
				<p>Ecuador, <?php echo fechaC(); ?></p>
				<span>|</span>
				<span class="user"> <?php echo $_SESSION['user'].' -'.$_SESSION['rol']. '-'.$_SESSION['email']; ?></span>
				<img class="photouser" src="img/user.png" alt="Usuario">
				<a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>
		<?php include "nav.php"; ?>
	</header>

	<div class="modal">
		<div class="bodyModal">
			<form action="" method="post" name="form_anular_factura" id="form_anular_factura" onsubmit="event.preventDefault(); anularFactura();">
				<h1 style="font_size: 45pt;" ><br> Anular Factura</h1>
				<h3>¿Realmente desea anular la factura?</h3>
				<button type="submit" class="btn_ok"> Anular</button>
				<button href="#" class="btn_cancel" onclick="coloseModal();"> Cancelar</button>
			</form>
		</div>
	</div>

