<?php
    require_once(__DIR__ . '/functions.php');

    if (!isset($_SESSION)) {
        session_start();
    }

	if(empty($_SESSION['active'])){
		header('location: ../');
	}
	

?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<header>
		<div class="header">
			
			<h1>Citaviso</h1>
			<div class="optionsBar">
				<p>Ecuador, <?php echo fechaC(); ?></p>
				<span>|</span>
				<img class="photouser" src="img/user.png" alt="Usuario">
				<a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>
		<?php include "nav.php"; ?>
	</header>


