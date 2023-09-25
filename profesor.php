<?php
session_start();

// Verificar si el usuario está autenticado y tiene el rol correcto
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'profesor') {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página de Profesor</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['username']; ?> (Rol: <?php echo $_SESSION['role']; ?>)</h1>
    <p>Contenido para profesores.</p>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
