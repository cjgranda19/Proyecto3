<?php

	$host = '74.208.221.54';
	$user = 'root';
	$password ='Pdigi2019';
	$db = 'proyecto';

	$conection = @mysqli_connect($host, $user, $password, $db);

	if (!$conection) {
		die("Error en la conexión");
	}