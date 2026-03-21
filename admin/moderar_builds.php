<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../inc/sesion.php';
require_once __DIR__ . '/../inc/conectar.php';

// Solo administradores
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado.");
}

// Cargar todas las builds con datos del usuario y perfil
$sql = "
    SELECT b.id, b.titulo, b.es_publica, b.created_at,
           u.email,
           p.nickname
    FROM builds b
    JOIN users u ON u.id = b.user_id
    LEFT JOIN profiles p ON p.user_id = b.user_id
    ORDER BY b.created_at DESC
";

$res = $conexion->query($sql);
if (!$res) {
    die("Error al cargar builds: " . $conexion->error);
}

include __DIR__ . '/../inc/cabecera.php';
?>
<link rel="stylesheet" href="../front/css/estilo.css">
<main class="panel-admin">
    <h1 style="color:var(--gold);">Moderar Builds</h1>

    <table class="admin-table">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Usuario</th>
            <th>Pública</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>

        <?php while ($b = $res->fetch_assoc()): ?>
            <tr>
                <td><?= $b['id'] ?></td>

                <td><?= htmlspecialchars($b['titulo']) ?></td>

                <td>
                    <?= htmlspecialchars($b['nickname'] ?: '—') ?><br>
                    <span style="font-size:0.85rem; color:var(--text-muted);">
                        <?= htmlspecialchars($b['email']) ?>
                    </span>
                </td>

                <td><?= $b['es_publica'] ? "Sí" : "No" ?></td>

                <td><?= $b['created_at'] ?></td>

                <td style="display:flex; gap:8px;">

                    <!-- Ver equipamiento -->
                    <a href="../front/ver_build.php?id=<?= $b['id'] ?>" class="btn-mh"
                       style="padding:6px 12px; font-size:0.9rem;">
                        Ver
                    </a>

                    <!-- Eliminar build -->
                    <form action="../back/php/admin_actions.php" method="POST" style="display:inline;">
                        <input type="hidden" name="action" value="delete_build">
                        <input type="hidden" name="id" value="<?= $b['id'] ?>">
                        <button type="submit" class="btn-delete-build" 
                                style="padding:6px 12px; font-size:0.9rem;">
                            Eliminar
                        </button>
                    </form>

                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</main>

<?php include __DIR__ . '/../inc/pie.php'; ?>