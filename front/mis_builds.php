<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../inc/sesion.php";
require_once __DIR__ . "/../inc/conectar.php";

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$user_id = (int)$_SESSION['id_usuario'];

$sql = "SELECT id, titulo, es_publica, created_at 
        FROM builds 
        WHERE user_id = $user_id
        ORDER BY created_at DESC";

$res = $conexion->query($sql);
if (!$res) {
    die("ERROR SQL en mis_builds.php --> " . $conexion->error);
}

include __DIR__ . "/../inc/cabecera.php";
?>

<h2 style="color:var(--gold); text-align:center; margin:20px 0;">
    <?= $LANG['page_my_builds'] ?>
</h2>

<div style="text-align:center; margin-bottom:20px;">
    <a href="planner.php" class="btn-crear-build"><?= $LANG['create_new_build'] ?></a>
</div>

<table class="admin-table">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Visibilidad</th>
        <th>Fecha</th>
        <th>Acciones</th>
    </tr>

    <?php while ($b = $res->fetch_assoc()): ?>
    <tr>
        <td><?= $b['id'] ?></td>
        <td><?= htmlspecialchars($b['titulo']); ?></td>
        <td><?= $b['es_publica'] ? "Pública" : "Privada"; ?></td>
        <td><?= $b['created_at']; ?></td>
        <td>        
    <!-- Ver -->
    <a href="ver_build.php?id=<?= $b['id'] ?>" class="btn-mh">Ver</a>

    <!-- Editar -->
    <a href="editar_build.php?id=<?= $b['id'] ?>" class="btn-mh">Editar</a>

    <!-- Eliminar -->
    <form action="../back/php/delete_build.php" method="POST" style="display:inline;"
          onsubmit="return confirm('¿Seguro que quieres eliminar esta build?');">
        <input type="hidden" name="build_id" value="<?= $b['id'] ?>">
        <button type="submit" class="btn-delete-build">Eliminar</button>
    </form>

        </td>
    </tr>
    <?php endwhile; ?>

</table>

<?php include __DIR__ . "/../inc/pie.php"; ?>