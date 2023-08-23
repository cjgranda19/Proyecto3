<?php
	include('includes/session_timeout.php');

session_start();

if (!isset($_SESSION['rol'])) {
    header('location: ../index.php');
} else if ($_SESSION['rol'] != 1) {
    header('location: ../index.php');
}

$id = intval($_GET['id']);

if (empty($id)) {
    header('location: lista_htecnica.php');
}

include "../conexion.php";

$query_delete = mysqli_query($conection, "DELETE FROM rule_recipe WHERE id_recipe = $id");
$query_delete = mysqli_query($conection, "DELETE FROM id_recipe WHERE id = $id");

header('location: lista_htecnica.php');