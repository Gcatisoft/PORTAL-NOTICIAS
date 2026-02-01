<?php
session_start();

if (!isset($_SESSION['usuario_logueado'])) {
    header("location:../admin/form_login.php");
    exit();
}

require("conexion.php");

$fecha = date("Y-m-d");
$id_usuario = $_SESSION['id_usuario'];

// Recibir datos del formulario
$titulo = isset($_POST['titulo']) ? trim($_POST['titulo']) : null;
$copete = isset($_POST['copete']) ? trim($_POST['copete']) : null;
$cuerpo = isset($_POST['cuerpo']) ? trim($_POST['cuerpo']) : null;
$contenido = isset($_POST['contenido']) ? trim($_POST['contenido']) : null;
$categoria = isset($_POST['categoria']) ? trim($_POST['categoria']) : null;

// Validar que contenido no esté vacío
if (empty($contenido)) {
    header("location:../admin/mis_publicaciones.php?mensaje=El contenido no puede estar vacío");
    exit();
}

// Manejo de imagen
$nombrefichero = "";
if (isset($_FILES['imagen']) && is_uploaded_file($_FILES['imagen']['tmp_name'])) {
    $nombreDirectorio = "../imagenes/subidas/";
    $idUnico = time();
    $nombrefichero = $idUnico . "-" . basename($_FILES['imagen']['name']);
    move_uploaded_file($_FILES['imagen']['tmp_name'], $nombreDirectorio . $nombrefichero);
}

// Consulta SQL
$sql = "INSERT INTO news (titulo, copete, cuerpo, contenido, imagen, categoria, id_usuario, fecha)
        VALUES (:titulo, :copete, :cuerpo, :contenido, :imagen, :categoria, :id_usuario, :fecha)";

try {
    $instruccion = $conexion->prepare($sql);
    $instruccion->bindParam(':titulo', $titulo);
    $instruccion->bindParam(':copete', $copete);
    $instruccion->bindParam(':cuerpo', $cuerpo);
    $instruccion->bindParam(':contenido', $contenido);
    $instruccion->bindParam(':imagen', $nombrefichero);
    $instruccion->bindParam(':categoria', $categoria);
    $instruccion->bindParam(':id_usuario', $id_usuario);
    $instruccion->bindParam(':fecha', $fecha);

    if ($instruccion->execute()) {
        header("location:../admin/mis_publicaciones.php?mensaje=Publicación exitosa");
    } else {
        header("location:../admin/mis_publicaciones.php?mensaje=Ha ocurrido un error");
    }

} catch (PDOException $e) {
    header("location:../admin/mis_publicaciones.php?mensaje=Error en la base de datos: " . $e->getMessage());
}

$conexion = null;
?>

