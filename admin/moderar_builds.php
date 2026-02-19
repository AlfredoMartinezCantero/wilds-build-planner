<?php
include "../inc/cabecera.php";
include "../inc/conectar.php";
?>
<link rel="stylesheet" href="../front/css/estilo.css">
<main>
    <section class="panel-admin">
        <h1>Moderar Builds</h1>

        <?php
        $resultado = mysqli_query($conexion, "
            SELECT b.id, b.nombre_build, u.nombre_usuario, b.fecha_creacion
            FROM builds b
            JOIN usuarios u ON u.id = b.id_usuario
            ORDER BY fecha_creacion DESC
        ");
        ?>

        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>

            <?php while($b = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?= $b['id'] ?></td>
                    <td><?= $b['nombre_build'] ?></td>
                    <td><?= $b['nombre_usuario'] ?></td>
                    <td><?= $b['fecha_creacion'] ?></td>
                    <td>
                        back/php/admin_actions.php?action=delete_build&id=<?= $b['id'] ?>" class="btn-delete">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>

        </table>
    </section>
</main>

<?php include "../inc/pie.php"; ?>