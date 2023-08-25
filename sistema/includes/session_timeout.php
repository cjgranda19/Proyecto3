<?php
if (isset($_SESSION['last_activity']) && isset($_SESSION['user_id'])) {
    $inactive_time = time() - $_SESSION['last_activity'];

    if ($inactive_time > 600) { // 10 minutes of inactivity
        session_unset();
        session_destroy();
        header('location: ../');
        exit;
    } else {
        // Agregar un mensaje para la consola del navegador
        echo '<script>console.log("Usuario y actividad verificados.");</script>';
    }
}

$_SESSION['last_activity'] = time();
?>
