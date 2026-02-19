<?php
include "../inc/cabecera.php";
include "../inc/conectar.php";
?>

<link rel="stylesheet" href="../front/css/estilo.css">

<main>
    <section class="panel-admin">
        <h1>Gestión de Usuarios</h1>

        <?php
        $resultado = mysqli_query($conexion, "SELECT * FROM usuarios ORDER BY fecha_registro DESC");
        ?>

        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Fecha registro</th>
                <th>Acciones</th>
            </tr>

            <?php while($u = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= $u['nombre_usuario'] ?></td>
                    <td><?= $u['email'] ?></td>
                    <td><?= $u['fecha_registro'] ?></td>
                    <td>
                        back/php/admin_actions.php?action=delete_user&id=<?= $u['id'] ?>" class="btn-delete">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>

        </table>
    </section>
</main>

<?php include "../inc/pie.php"; ?>
