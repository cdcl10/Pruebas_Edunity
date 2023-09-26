<?php
session_start();

// Configuración de la base de datos
$db_host = "containers-us-west-112.railway.app";
$db_user = "root";
$db_pass = "AyeDy0FZxAeLbIAcS0pP";
$db_name = "railway";
$db_port = "7627"; 

// Conexión a la base de datos
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Obtener datos del formulario
$identificacion = $_POST['identificacion'];
$password = $_POST['contraseña'];

// Consulta SQL para autenticar al usuario
$query = "SELECT * FROM usuarios WHERE identificacion = '$identificacion' AND contraseña = '$password'";

$result = $conn->query($query);

if (!$result) {
    die("Error en la consulta SQL: " . $conn->error);
}

if ($result->num_rows == 1) {
    // Usuario autenticado, iniciar sesión
    $row = $result->fetch_assoc();
    $_SESSION['username'] = $row['identificacion'];
    $_SESSION['role'] = $row['id_perfil'];

    // Redirigir según el rol (asumiendo que el campo 'id_perfil' representa los roles)
    if ($_SESSION['role'] == 1) {
        echo "<script>alert('Inicio de sesión exitoso como administrador.'); window.location.href = 'admin.php';</script>";
    } elseif ($_SESSION['role'] == 2) {
        echo "<script>alert('Inicio de sesión exitoso como profesor.'); window.location.href = 'profesor.php';</script>";
    }
} else {
    // Usuario no autenticado
    echo "<script>alert('Credenciales incorrectas, por favor, inténtalo nuevamente.'); window.location.href = 'index.html';</script>";
}

$conn->close();
?>
