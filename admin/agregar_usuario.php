<?php
session_start();
require("../backend/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? null;
    $nombre = $_POST['nombre'] ?? null;
    $apellido = $_POST['apellido'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $rol = $_POST['rol'] ?? 'editor';
    $dni = $_POST['dni'] ?? null;
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
    $genero = $_POST['genero'] ?? null;
    $provincia = $_POST['provincia'] ?? null;
    $departamento = $_POST['departamento'] ?? null;
    $localidad = $_POST['localidad'] ?? null;

    // Validar que ningún campo esté vacío
    if (!$usuario || !$nombre || !$apellido || !$email || !$password || !$dni || !$fecha_nacimiento || !$genero || !$provincia || !$departamento || !$localidad) {
        die("Por favor complete todos los campos obligatorios.");
    }

    $sql = "INSERT INTO usuarios (
                usuario, nombre, apellido, email, password, rol,
                dni, fecha_nacimiento, genero, provincia, departamento, localidad
            ) VALUES (
                :usuario, :nombre, :apellido, :email, :password, :rol,
                :dni, :fecha_nacimiento, :genero, :provincia, :departamento, :localidad
            )";

    $stmt = $conexion->prepare($sql);

    try {
        $stmt->execute([
            ':usuario' => $usuario,
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':rol' => $rol,
            ':dni' => $dni,
            ':fecha_nacimiento' => $fecha_nacimiento,
            ':genero' => $genero,
            ':provincia' => $provincia,
            ':departamento' => $departamento,
            ':localidad' => $localidad
        ]);
        echo "<div class='alert alert-success text-center'>Usuario agregado correctamente.</div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger text-center'>Error al agregar usuario: " . $e->getMessage() . "</div>";
    }
}
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
                <?php if ($_SESSION['rol'] == "admin"): ?>
                    <h1> Registrar nuevo usuario</h1>
                <?php else: ?>
                   <h1>Crear cuenta</h1>
                <?php endif; ?>
            </div>
   <form action="agregar_usuario.php" method="POST" class="mx-auto" style="max-width:600px;">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Apellido" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" id="usuario" name="usuario" placeholder="Usuario" required class="form-control">
        <small id="nombre-usuario-error" class="form-text"></small>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Contraseña" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="rol" class="form-label">Rol</label>
        <select id="rol" name="rol" required class="form-select">
            <option value="editor" selected>Editor</option>
            <option value="admin">Admin</option>
            <option value="lector">Lector</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="dni" class="form-label">DNI</label>
        <input type="text" id="dni" name="dni" placeholder="DNI" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="genero" class="form-label">Género</label>
        <select id="genero" name="genero" required class="form-select">
            <option value="" disabled selected>Seleccione género</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            <option value="Otro">Otro</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="provincia" class="form-label">Provincia</label>
        <input type="text" id="provincia" name="provincia" placeholder="Provincia" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="departamento" class="form-label">Departamento</label>
        <input type="text" id="departamento" name="departamento" placeholder="Departamento" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="localidad" class="form-label">Localidad</label>
        <input type="text" id="localidad" name="localidad" placeholder="Localidad" required class="form-control">
    </div>

    <button type="submit" id="crear_cuenta_btn" class="btn btn-primary w-100">Agregar Usuario</button>
</form>



        </div>
    </main>

    <?php require("../noticias/footer.php"); ?>

    <script>
        document.getElementById("usuario").addEventListener("input", function () {
            var nombreUsuario = this.value;
            var nombreUsuarioError = document.getElementById("nombre-usuario-error");
            var crearCuentaButton = document.getElementById("crear_cuenta_btn");

            // Realiza la solicitud Ajax para verificar la disponibilidad del nombre de usuario
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../backend/usuario_disponible.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var respuesta = xhr.responseText;

                        // Verificar si el nombre de usuario cumple con las condiciones
                        var regex = /^[a-zA-Z0-9]+$/; // Expresión regular que permite letras y números
                        var esValido = regex.test(nombreUsuario);

                        if (nombreUsuario !== "") {
                            if (esValido) {
                                // La respuesta debe ser "disponible" o "ocupado"
                                if (respuesta === "disponible") {
                                    crearCuentaButton.disabled = false;
                                    nombreUsuarioError.classList.remove("text-danger");
                                    nombreUsuarioError.classList.add("text-success");
                                    nombreUsuarioError.textContent = "Disponible";
                                } else if (respuesta === "ocupado") {
                                    crearCuentaButton.disabled = true;
                                    nombreUsuarioError.classList.remove("text-success");
                                    nombreUsuarioError.classList.add("text-danger");
                                    nombreUsuarioError.textContent = "No disponible";
                                }
                            } else {
                                crearCuentaButton.disabled = true;
                                nombreUsuarioError.classList.remove("text-success");
                                nombreUsuarioError.classList.add("text-danger");
                                nombreUsuarioError.textContent = "Inválido";
                            }
                        } else {
                            nombreUsuarioError.textContent = "";
                        }
                    }
                }
            };

            // Envia el nombre de usuario al servidor para verificar
            xhr.send("nombreUsuario=" + encodeURIComponent(nombreUsuario));
        });


    </script>
</body>

</html>