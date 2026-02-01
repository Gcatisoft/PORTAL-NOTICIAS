<?php
session_start();
extract($_REQUEST);
if (!isset($_SESSION['usuario_logueado']))
    header("location:index.php");

require("../backend/conexion.php");

$instruccion = "SELECT * FROM usuarios WHERE id_usuario = '$edit_usuario'";
$resultado = $conexion->query($instruccion);
$resultado = $resultado->fetch(PDO::FETCH_ASSOC);
$conexion = null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cac8e89f4d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../estaticos/css/style.css">
    <title>DIARIO</title>
</head>

<body>
    <div class="">
        <?php require("menu.php"); ?>
    </div>
    <main class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1> Editar registro de usuario </h1>
            </div>
      <form action="../backend/editar_usuario.php" method="POST"
      class="col-8 offset-2 card text-bg-light shadow-lg p-3 mt-3">

    <!-- Usuario -->
    <div class="input-group input-group-sm mb-3">
        <label for="usuario" class="input-group-text">Usuario</label>
        <input type="text" class="form-control" name="usuario" id="usuario"
               value="<?= $resultado['usuario']; ?>" required>
    </div>

    <!-- Nombre -->
    <div class="input-group input-group-sm mb-3">
        <label for="nombre" class="input-group-text">Nombre</label>
        <input type="text" class="form-control" name="nombre" id="nombre"
               value="<?= $resultado['nombre']; ?>" required>
    </div>

    <!-- Apellido -->
    <div class="input-group input-group-sm mb-3">
        <label for="apellido" class="input-group-text">Apellido</label>
        <input type="text" class="form-control" name="apellido" id="apellido"
               value="<?= $resultado['apellido']; ?>" required>
    </div>

    <!-- DNI -->
    <div class="input-group input-group-sm mb-3">
        <label for="dni" class="input-group-text">DNI</label>
        <input type="text" class="form-control" name="dni" id="dni" 
               value="<?= $resultado['dni']; ?>" required>
    </div>

    <!-- Fecha de nacimiento -->
    <div class="input-group input-group-sm mb-3">
        <label for="fecha_nacimiento" class="input-group-text">Fecha de nacimiento</label>
        <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" 
               value="<?= $resultado['fecha_nacimiento']; ?>" required>
    </div>

    <!-- Género -->
    <div class="input-group input-group-sm mb-3">
        <label for="genero" class="input-group-text">Género</label>
        <select class="form-select" name="genero" id="genero" required>
            <option value="">Seleccione</option>
            <option value="Masculino" <?= $resultado['genero'] == 'Masculino' ? 'selected' : '' ?>>Masculino</option>
            <option value="Femenino" <?= $resultado['genero'] == 'Femenino' ? 'selected' : '' ?>>Femenino</option>
            <option value="Otro" <?= $resultado['genero'] == 'Otro' ? 'selected' : '' ?>>Otro</option>
        </select>
    </div>

    <!-- Provincia -->
    <div class="input-group input-group-sm mb-3">
        <label for="provincia" class="input-group-text">Provincia</label>
        <input type="text" class="form-control" name="provincia" id="provincia" 
               value="<?= $resultado['provincia']; ?>" required>
    </div>

    <!-- Departamento -->
    <div class="input-group input-group-sm mb-3">
        <label for="departamento" class="input-group-text">Departamento</label>
        <input type="text" class="form-control" name="departamento" id="departamento" 
               value="<?= $resultado['departamento']; ?>" required>
    </div>

    <!-- Localidad -->
    <div class="input-group input-group-sm mb-3">
        <label for="localidad" class="input-group-text">Localidad</label>
        <input type="text" class="form-control" name="localidad" id="localidad" 
               value="<?= $resultado['localidad']; ?>" required>
    </div>

    <!-- Rol -->
    <div class="input-group input-group-sm mb-3">
        <label for="rol" class="input-group-text">Rol</label>
        <select class="form-select" id="rol" name="rol" required>
            <option value="admin" <?= $resultado['rol'] == "admin" ? "selected" : "" ?>>Admin</option>
            <option value="autor" <?= $resultado['rol'] == "autor" ? "selected" : "" ?>>Autor</option>
        </select>
    </div>

    <!-- Campos ocultos -->
    <input type="hidden" name="id_usuario" value="<?= $resultado['id_usuario'] ?>">
    <input type="hidden" name="password" value="<?= $resultado['password'] ?>">

    <!-- Botones -->
    <div class="col-12 justify-content-center text-center mt-3">
        <button class="btn btn-sm btn-dark" type="submit">Editar</button>
        <a href="index.php" class="btn btn-sm btn-outline-danger">Cancelar</a>
    </div>

</form>

        </div>
    </main>
    <?php require("../noticias/footer.php"); ?>
</body>

</html>