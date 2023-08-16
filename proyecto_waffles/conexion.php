<?php
$host = 'citaviso.com';
$user = 'u900659423_crud';
$password = 'Pdigi2019@';
$db = 'u900659423_crud';

$conection = @mysqli_connect($host, $user, $password, $db);

if (!$conection) {
    die("Error en la conexión: " . mysqli_connect_error());
}

?>
