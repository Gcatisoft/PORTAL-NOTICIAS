<?php
session_start();
require("conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    // Buscamos al usuario en la base de datos
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
    $stmt->execute(['usuario' => $usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Comparamos la contraseña ingresada con el hash guardado
        if (password_verify($password, $user['password'])) {
            // Login correcto: guardamos datos en sesión
            $_SESSION['usuario_logueado'] = true;
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['apellido'] = $user['apellido'];
            $_SESSION['id_usuario'] = $user['id_usuario'];
            $_SESSION['rol'] = $user['rol'];

            // Redirigimos al panel de admin
            header("Location: ../admin/index.php");
            exit;
        }
    }
    
    // Si no encontró usuario o la contraseña es incorrecta:
    $_SESSION['mensaje'] = "Usuario o contraseña incorrectos";
    header("Location: ../admin/form_login.php");
    exit;
} else {
    // Si no es POST, redirigimos al login
    header("Location: ../admin/form_login.php");
    exit;
}
