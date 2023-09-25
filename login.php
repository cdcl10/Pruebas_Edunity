<?php
session_start();

// Configuración de la base de datos
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "Proyecto";

// Conexión a la base de datos
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Obtener datos del formulario (asegúrate de validar y sanear los datos de entrada)
$username = $conn->real_escape_string($_POST['username']);
$password = $conn->real_escape_string($_POST['password']);

// Consulta SQL segura para verificar las credenciales (evita la inyección SQL)
$query = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";

$result = $conn->query($query);

if ($result) {
    if ($result->num_rows == 1) {
        // Credenciales válidas, iniciar sesión
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        // Redirigir según el rol
        if ($_SESSION['role'] == 'admin') {
            echo "<script>alert('Inicio de sesión exitoso como administrador.'); window.location.href = 'admin.php';</script>";
        } elseif ($_SESSION['role'] == 'profesor') {
            echo "<script>alert('Inicio de sesión exitoso como profesor.'); window.location.href = 'profesor.php';</script>";
        }
    } else {
        // Credenciales inválidas
        echo "<script>alert('Credenciales inválidas, por favor, inténtalo nuevamente.'); window.location.href = 'index.html';</script>";
    }
} else {
    // Error en la consulta SQL
    echo "<script>alert('Error en la consulta SQL, por favor, inténtalo nuevamente.'); window.location.href = 'index.html';</script>";
}

$conn->close();
?>
