<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
extract($_REQUEST);

if (!isset($_SESSION['usuario_logueado'])) {
    header("location:form_login.php");
    exit;
}
$rol = $_SESSION['rol'] ?? '';
if ($rol != "admin") {
    header("location:mis_publicaciones.php?mensaje=Usted no posee permisos de administrador");
    exit;
}

require("../backend/admin_usuarios.php"); // Aquí debes asegurarte que $usuarios contiene todos los campos

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Administrador de usuarios</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FontAwesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-light bg-gradient">
    <div class="container-fluid mb-5 min-vh-100">
        <div class="container">
            <h1 class="text-center my-4">Administrador de usuarios</h1>
        </div>

        <?php if (!empty($mensaje)) : ?>
            <div class="alert alert-success text-center" role="alert">
                <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between mb-3">
            <a href="../admin/agregar_usuario.php" class="btn btn-sm btn-dark">
                <i class="fa-solid fa-square-plus"></i> Agregar
            </a>
            <div class="dropdown">
                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Filtrar por rol
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="index.php">Todo</a></li>
                    <li><a class="dropdown-item" href="?rol_tipo=admin">Admin</a></li>
                    <li><a class="dropdown-item" href="?rol_tipo=editor">Editor</a></li>
                    <li><a class="dropdown-item" href="?rol_tipo=lector">Lector</a></li>
                </ul>
            </div>
        </div>

        <div class="row shadow">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm table-bordered align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Usuario</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Fecha Nac.</th>
                                <th>Género</th>
                                <th>Provincia</th>
                                <th>Departamento</th>
                                <th>Localidad</th>
                                <th>Publicaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($usuario['usuario']) ?></td>
                                    <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                                    <td><?= htmlspecialchars($usuario['apellido']) ?></td>
                                    <td><?= htmlspecialchars($usuario['dni'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                                    <td><?= htmlspecialchars($usuario['rol']) ?></td>
                                    <td><?= !empty($usuario['fecha_nacimiento']) ? date('d/m/Y', strtotime($usuario['fecha_nacimiento'])) : '' ?></td>
                                    <td><?= htmlspecialchars($usuario['genero'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($usuario['provincia'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($usuario['departamento'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($usuario['localidad'] ?? '') ?></td>
                                    <td>
                                        <a href="todas_publicaciones.php?autor=<?= urlencode($usuario["id_usuario"]) ?>">Ver</a>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="editar_usuario.php?edit_usuario=<?= urlencode($usuario["id_usuario"]) ?>"
                                                class="btn btn-sm btn-outline-primary" title="Editar">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="../backend/borrar_usuario.php?del_usuario=<?= urlencode($usuario["id_usuario"]) ?>"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('¿Desea eliminar a <?= htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']) ?>?')"
                                                title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-info" title="Ver detalles"
                                                data-bs-toggle="modal" data-bs-target="#detalleModal<?= $usuario['id_usuario'] ?>">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal detalles usuario -->
                                <div class="modal fade" id="detalleModal<?= $usuario['id_usuario'] ?>" tabindex="-1"
                                    aria-labelledby="detalleModalLabel<?= $usuario['id_usuario'] ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header bg-dark text-white">
                                                <h5 class="modal-title" id="detalleModalLabel<?= $usuario['id_usuario'] ?>">
                                                    Detalles del usuario
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                    aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <p><strong>Usuario:</strong> <?= htmlspecialchars($usuario['usuario']) ?></p>
                                                <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario['nombre']) ?></p>
                                                <p><strong>Apellido:</strong> <?= htmlspecialchars($usuario['apellido']) ?></p>
                                                <p><strong>DNI:</strong> <?= htmlspecialchars($usuario['dni'] ?? 'No informado') ?></p>
                                                <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
                                                <p><strong>Fecha de nacimiento:</strong>
                                                    <?= !empty($usuario['fecha_nacimiento']) ? date('d/m/Y', strtotime($usuario['fecha_nacimiento'])) : 'No informado' ?>
                                                </p>
                                                <p><strong>Género:</strong> <?= htmlspecialchars($usuario['genero'] ?? 'No informado') ?></p>
                                                <p><strong>Provincia:</strong> <?= htmlspecialchars($usuario['provincia'] ?? 'No informado') ?></p>
                                                <p><strong>Departamento:</strong> <?= htmlspecialchars($usuario['departamento'] ?? 'No informado') ?></p>
                                                <p><strong>Localidad:</strong> <?= htmlspecialchars($usuario['localidad'] ?? 'No informado') ?></p>
                                                <p><strong>Rol:</strong> <?= htmlspecialchars($usuario['rol']) ?></p>
                                                <p><strong>Fecha creación:</strong>
                                                    <?= !empty($usuario['fecha_creacion']) ? date('d/m/Y H:i:s', strtotime($usuario['fecha_creacion'])) : 'No informado' ?>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (Popper + Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
                                