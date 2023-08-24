<?php
session_start();

if (isset($_SESSION['last_activity'])) {
    $inactive_time = time() - $_SESSION['last_activity'];

    if ($inactive_time > 280) {
        session_unset();
        session_destroy();
        header('location: ../');
        exit;
    }
}

$_SESSION['last_activity'] = time();
?>
