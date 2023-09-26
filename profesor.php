<?php
session_start();

// Verificar si el usuario está autenticado y tiene el rol correcto
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'profesor') {
    header('Location: profesor.html');
    exit();
}
?>

