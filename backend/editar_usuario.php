<?php
session_start();
extract($_REQUEST);

if (!isset($_SESSION['usuario_logueado']))
    header("location:../admin/form_login.php");

require("conexion.php");

// Interacción con la base de datos
$sql = "UPDATE usuarios 
        SET usuario = :usuario, 
            password = :password,  
            nombre = :nombre, 
            apellido = :apellido, 
            rol = :rol,
            dni = :dni,
            fecha_nacimiento = :fecha_nacimiento,
            genero = :genero,
            provincia = :provincia,
            departamento = :departamento,
            localidad = :localidad
        WHERE id_usuario = :id_usuario";

// Preparar la consulta
$instruccion = $conexion->prepare($sql);

// Asignar los valores a los marcadores de posición
$instruccion->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$instruccion->bindParam(':password', $password, PDO::PARAM_STR);
$instruccion->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$instruccion->bindParam(':apellido', $apellido, PDO::PARAM_STR);
$instruccion->bindParam(':rol', $rol, PDO::PARAM_STR);

$instruccion->bindParam(':dni', $dni, PDO::PARAM_STR);
$instruccion->bindParam(':fecha_nacimiento', $fecha_nacimiento, PDO::PARAM_STR);
$instruccion->bindParam(':genero', $genero, PDO::PARAM_STR);
$instruccion->bindParam(':provincia', $provincia, PDO::PARAM_STR);
$instruccion->bindParam(':departamento', $departamento, PDO::PARAM_STR);
$instruccion->bindParam(':localidad', $localidad, PDO::PARAM_STR);

$instruccion->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

// Ejecutar la consulta
$instruccion->execute();

// Cerrar conexión
$conexion = null;

// Actualizar sesión si corresponde
if ($_SESSION['id_usuario'] == $id_usuario && $rol != "admin") {
    $_SESSION['rol'] = "autor";
}

// Redirección
header("location:../admin/index.php?mensaje=Usuario editado con éxito");
?>
