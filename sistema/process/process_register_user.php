<?php
session_start();

include "../../conexion.php";

if ($_SESSION['rol'] != 1) {
    header("location: ./");
    exit();
}
$alert = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $email = $_POST['correo'];
    $user = $_POST['usuario'];
    $clave = md5($_POST['clave']);
    $rol = $_POST['rol'];

    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {



        $query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email' ");
        $result = mysqli_num_rows($query);

        if ($result > 0) {
            $alert = '<p class="msg_error">El correo o el usuario ya existe.</p>';
        } else {
            $query_insert = mysqli_query($conection, "INSERT INTO usuario(nombre,correo,usuario,clave,rol) VALUES('$nombre','$email','$user','$clave','$rol')");

            $result = mysqli_query($conection, $query_insert);

            if ($result) {
                $_SESSION['popup_message'] = 'Inserción exitosa.';
            } else {
                $_SESSION['popup_message'] = 'Error al guardar producto: ' . mysqli_error($conection);
            }
            header("location: ../lista_usuarios.php");

            mysqli_close($conection);

        }
    }
}
echo $alert;

?>