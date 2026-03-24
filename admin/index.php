<?php
require_once "../inc/sesion.php";
include "../inc/cabecera.php";
?>
<link rel="stylesheet" href="../front/css/estilo.css">

<main>
    <section class="panel-admin">
        <h1><?php echo htmlspecialchars($LANG['admin_panel_title'] ?? 'Panel de Administración'); ?></h1>
        <p class="subtexto">
            <?php echo htmlspecialchars($LANG['admin_welcome'] ?? 'Bienvenido al panel...'); ?>
        </p>

        <div class="admin-grid">

            <a href="dashboard.php" class="admin-card">
                <h3>📊 Dashboard</h3>
                <p><?php echo htmlspecialchars($LANG['admin_stats_public_builds'] ?? 'Vista general...'); ?></p>
            </a>

            <a href="gestionar_usuarios.php" class="admin-card">
                <h3>👥 <?php echo htmlspecialchars($LANG['admin_users'] ?? 'Usuarios'); ?></h3>
                <p><?php echo htmlspecialchars($LANG['admin_users_desc'] ?? 'Listado, edición...'); ?></p>
            </a>

            <a href="moderar_builds.php" class="admin-card">
                <h3>🛠 <?php echo htmlspecialchars($LANG['admin_moderate_builds'] ?? 'Moderar Builds'); ?></h3>
                <p><?php echo htmlspecialchars($LANG['admin_moderate_builds_desc'] ?? 'Gestiona builds...'); ?></p>
            </a>

        </div>
    </section>
</main>

<?php include "../inc/pie.php"; ?>