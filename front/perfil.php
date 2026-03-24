<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../inc/sesion.php";
require_once __DIR__ . "/../inc/conectar.php";

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$user_id = (int) $_SESSION['id_usuario'];

// 1) Cargar datos de users
$sqlUser = "SELECT email, role, created_at FROM users WHERE id = $user_id";
$resUser = $conexion->query($sqlUser);
$user = $resUser->fetch_assoc() ?: ['email' => '', 'role' => 'user', 'created_at' => ''];

// 2) Cargar datos de profiles
$sqlProfile = "SELECT nickname, hunter_rank, prefs_json
               FROM profiles
               WHERE user_id = $user_id";
$resProfile = $conexion->query($sqlProfile);

if ($resProfile->num_rows === 0) {
    // Crear perfil vacío si no existe
    $conexion->query("INSERT INTO profiles (user_id) VALUES ($user_id)");
    $profile = ['nickname' => '', 'hunter_rank' => 1, 'prefs_json' => '{}'];
} else {
    $profile = $resProfile->fetch_assoc();
}

$nickname = $profile['nickname'] ?? "";
$hunter_rank = $profile['hunter_rank'] ?? 1;
$prefs = $profile['prefs_json'] ?? "{}";

include __DIR__ . "/../inc/cabecera.php";
?>

<main>
    <div class="perfil-box"
         style="max-width:650px; margin:40px auto; background:var(--bg-panel);
                padding:25px; border-radius:12px; box-shadow:0 4px 12px var(--shadow);
                border:1px solid var(--border);">

        <h2 style="color:var(--gold); margin-bottom:20px; text-align:center;">
            <?= $LANG['profile_title'] ?>
        </h2>

        <h3 style="color:var(--gold-bright); margin-bottom:10px;"><?= $LANG['account'] ?></h3>
        <p><strong><?= $LANG['email'] ?>:</strong> <?= htmlspecialchars($user['email']); ?></p>
        <p><strong><?= $LANG['role'] ?>:</strong> <?= htmlspecialchars($user['role']); ?></p>
        <p><strong><?= $LANG['registered_on'] ?>:</strong> <?= htmlspecialchars($user['created_at']); ?></p>

        <hr style="margin:20px 0; border-color:var(--border);">

        <h3 style="color:var(--gold-bright); margin-bottom:10px;"><?= $LANG['profile_player'] ?></h3>
        <p><strong><?= $LANG['nickname'] ?>:</strong> <?= htmlspecialchars($nickname); ?></p>
        <p><strong><?= $LANG['hunter_rank'] ?>:</strong> <?= htmlspecialchars($hunter_rank); ?></p>

        <p><strong>Preferencias:</strong></p>
        <pre style="background:var(--bg-card); padding:15px; border-radius:8px;
                    white-space:pre-wrap; color:var(--text);">
<?= htmlspecialchars($prefs); ?>
        </pre>
        <?php
// Historial de builds del usuario
$sqlStats = "
    SELECT 
        COUNT(*) AS total,
        SUM(es_publica = 1) AS publicas,
        MAX(created_at) AS ultima
    FROM builds
    WHERE user_id = $user_id
";
$resStats = $conexion->query($sqlStats);
$stats = $resStats->fetch_assoc() ?: ['total' => 0, 'publicas' => 0, 'ultima' => null];

$sqlUltimas = "
    SELECT id, titulo, es_publica, created_at
    FROM builds
    WHERE user_id = $user_id
    ORDER BY created_at DESC
    LIMIT 5
";
$resUltimas = $conexion->query($sqlUltimas);
?>

<hr style="margin:20px 0; border-color:var(--border);">

<h3 style="color:var(--gold-bright); margin-bottom:10px;"><?php echo htmlspecialchars($LANG['history_builds'] ?? 'Historial de builds'); ?></h3>

<p>
    <strong><?php echo htmlspecialchars($LANG['total_builds'] ?? 'Total builds'); ?>:</strong> <?= (int)$stats['total']; ?> <br>
    <strong><?php echo htmlspecialchars($LANG['public_builds'] ?? 'Builds públicas'); ?>:</strong> <?= (int)$stats['publicas']; ?> <br>
    <strong><?php echo htmlspecialchars($LANG['last_build'] ?? 'Última build'); ?>:</strong> 
    <?= $stats['ultima'] ? htmlspecialchars($stats['ultima']) : htmlspecialchars($LANG['no_builds'] ?? 'Sin builds aún'); ?>
</p>

<?php if ($stats['total'] > 0): ?>
    <h4 style="color:var(--gold); margin-top:15px; margin-bottom:8px;"><?php echo htmlspecialchars($LANG['your_last_builds'] ?? 'Tus últimas builds'); ?></h4>
    <table class="admin-table">
        <tr>
            <th><?php echo htmlspecialchars($LANG['builds_table_title'] ?? 'Título'); ?></th>
            <th><?php echo htmlspecialchars($LANG['builds_table_visibility'] ?? 'Visibilidad'); ?></th>
            <th><?php echo htmlspecialchars($LANG['date'] ?? 'Fecha'); ?></th>
            <th><?php echo htmlspecialchars($LANG['action'] ?? 'Acción'); ?></th>
        </tr>
        <?php while ($b = $resUltimas->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($b['titulo']); ?></td>
                <td><?= $b['es_publica'] ? htmlspecialchars($LANG['public'] ?? 'Pública') : htmlspecialchars($LANG['private'] ?? 'Privada'); ?></td>
                <td><?= $b['created_at']; ?></td>
                <td>
                    <a href="../front/ver_build.php?id=<?= $b['id']; ?>" class="btn-mh"><?php echo htmlspecialchars($LANG['view'] ?? 'Ver'); ?></a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p style="color:var(--text-muted);"><?php echo htmlspecialchars($LANG['no_builds_created'] ?? 'Todavía no has creado ninguna build.'); ?>
        <a href="mis_builds.php"><?php echo htmlspecialchars($LANG['create_first_build'] ?? 'Crea tu primera build'); ?></a>.
    </p>
<?php endif; ?>
        <div style="text-align:center; margin-top:25px; display:flex; justify-content:center; gap:15px;">
            <a href="editar_perfil.php" class="btn-mh"><?php echo htmlspecialchars($LANG['edit_profile'] ?? 'Editar Perfil'); ?></a>
            <a href="mis_builds.php" class="btn-mh"><?php echo htmlspecialchars($LANG['page_my_builds'] ?? 'Mis Builds'); ?></a>
        </div>
    </div>
</main>

<?php include __DIR__ . "/../inc/pie.php"; ?>