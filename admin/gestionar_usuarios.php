<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../inc/sesion.php';
require_once __DIR__ . '/../inc/conectar.php';

// SOLO ADMIN
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado.");
}

// Cargar usuarios + perfiles
$sql = "
    SELECT u.id, u.email, u.role, u.created_at,
           p.nickname, p.hunter_rank
    FROM users u
    LEFT JOIN profiles p ON p.user_id = u.id
    ORDER BY u.created_at DESC
";

$res = $conexion->query($sql);
if (!$res) {
    die("Error al cargar usuarios: " . $conexion->error);
}

include __DIR__ . '/../inc/cabecera.php';
?>
<link rel="stylesheet" href="../front/css/estilo.css">
<main class="panel-admin">
    <h1>Gestión de Usuarios</h1>

    <table class="admin-table">
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Nickname</th>
            <th>HR</th>
            <th>Rol</th>
            <th>Registro</th>
            <th>Acciones</th>
        </tr>

        <?php while ($u = $res->fetch_assoc()): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= htmlspecialchars($u['nickname'] ?: "—") ?></td>
                <td><?= (int)$u['hunter_rank'] ?></td>
                <td><?= htmlspecialchars($u['role']) ?></td>
                <td><?= $u['created_at'] ?></td>

                <td>
                    <!-- Editar usuario -->
                    editar_usuarios.php?id=<?= $u['id'] ?>" 
                       class="btn-mh">Editar</a>

                    <!-- Eliminar usuario -->
                    ../back/php/admin_actions.php
                        <input type="hidden" name="action" value="delete_user">
                        <input type="hidden" name="id" value="<?= $u['id'] ?>">
                        <button type="submit" class="btn-delete-build">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>

    </table>
</main>

<?php include __DIR__ . '/../inc/pie.php'; ?>