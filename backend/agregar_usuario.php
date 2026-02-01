<?php
session_start();
extract($_REQUEST);

if (!isset($_SESSION['usuario_logueado']))
    header("location:../admin/form_login.php");

require("conexion.php");

// Datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$rol = $_POST['rol'];

// Nuevos campos
$dni = $_POST['dni'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$genero = $_POST['genero'];
$provincia = $_POST['provincia'];
$departamento = $_POST['departamento'];
$localidad = $_POST['localidad'];

// Saneamiento de datos
$salt = substr($usuario, 0, 2);
$clave_crypt = crypt($password, $salt);

// Consulta SQL con nuevos campos
$sql = "INSERT INTO usuarios (
            usuario, nombre, apellido, password, rol,
            dni, fecha_nacimiento, genero, provincia, departamento, localidad
        ) VALUES (
            :usuario, :nombre, :apellido, :password, :rol,
            :dni, :fecha_nacimiento, :genero, :provincia, :departamento, :localidad
        )";

// Preparar la consulta
$instruccion = $conexion->prepare($sql);

// Asignar valores
$instruccion->bindParam(':usuario', $usuario);
$instruccion->bindParam(':nombre', $nombre);
$instruccion->bindParam(':apellido', $apellido);
$instruccion->bindParam(':password', $clave_crypt);
$instruccion->bindParam(':rol', $rol);

$instruccion->bindParam(':dni', $dni);
$instruccion->bindParam(':fecha_nacimiento', $fecha_nacimiento);
$instruccion->bindParam(':genero', $genero);
$instruccion->bindParam(':provincia', $provincia);
$instruccion->bindParam(':departamento', $departamento);
$instruccion->bindParam(':localidad', $localidad);

// Ejecutar
if ($instruccion->execute()) {
    if ($_SESSION['rol'] == "admin") {
        header("location:../admin/index.php?mensaje=Publicación exitosa");
    } else {
        header("location:login.php?usuario=$usuario&password=$password");
    }
} else {
    header("location:../admin/index.php?mensaje=Ha ocurrido un error");
}

// Cerrar conexión
$conexion = null;
?>
