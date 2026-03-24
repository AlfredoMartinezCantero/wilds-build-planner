<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../inc/sesion.php';
require_once __DIR__ . '/../inc/conectar.php';

// Solo admins
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die(htmlspecialchars($LANG['admin_access_denied'] ?? 'Acceso denegado.'));
}

/* MÉTRICAS PRINCIPALES */

// Nº usuarios
$total_usuarios = $conexion->query("SELECT COUNT(*) AS c FROM users")->fetch_assoc()['c'];

// Nº builds
$total_builds = $conexion->query("SELECT COUNT(*) AS c FROM builds")->fetch_assoc()['c'];

// Nº builds públicas
$builds_publicas = $conexion->query("SELECT COUNT(*) AS c FROM builds WHERE es_publica = 1")->fetch_assoc()['c'];

// Builds creadas HOY
$hoy = date("Y-m-d");
$builds_hoy = $conexion->query("SELECT COUNT(*) AS c FROM builds WHERE DATE(created_at) = '$hoy'")->fetch_assoc()['c'];


/* GRÁFICO: Builds por día (últimos 7 días) */

$sqlDias = "
    SELECT DATE(created_at) AS dia, COUNT(*) AS cantidad
    FROM builds
    GROUP BY DATE(created_at)
    ORDER BY dia DESC
    LIMIT 7
";
$resDias = $conexion->query($sqlDias);

$labels_dias = [];
$data_dias = [];

while ($r = $resDias->fetch_assoc()) {
    $labels_dias[] = $r['dia'];
    $data_dias[] = $r['cantidad'];
}

// Invertir (para orden cronológico)
$labels_dias = array_reverse($labels_dias);
$data_dias = array_reverse($data_dias);


/* GRÁFICO: Públicas vs Privadas */

$privadas = $total_builds - $builds_publicas;


/* TABLA RESUMEN */

// Últimas builds
$ultimas_builds = $conexion->query("
    SELECT b.id, b.titulo, b.es_publica, b.created_at, u.email
    FROM builds b
    JOIN users u ON u.id = b.user_id
    ORDER BY b.created_at DESC
    LIMIT 5
");

// Últimos usuarios
$ultimos_users = $conexion->query("
    SELECT * FROM users ORDER BY created_at DESC LIMIT 5
");

include __DIR__ . '/../inc/cabecera.php';
?>
<link rel="stylesheet" href="../front/css/estilo.css">

<main class="panel-admin">
    <h1 style="color:var(--gold);"><?php echo htmlspecialchars($LANG['admin_panel_title'] ?? 'Dashboard'); ?></h1>
    <p class="subtexto"><?php echo htmlspecialchars($LANG['admin_welcome'] ?? 'Vista general...'); ?></p>

    <!-- MÉTRICAS -->
    <div style="display:flex; gap:15px; flex-wrap:wrap; margin-bottom:25px;">
        <div class="admin-card" style="flex:1;">
            <h3>👥 <?php echo htmlspecialchars($LANG['admin_stats_users'] ?? 'Usuarios'); ?></h3>
            <p><?= $total_usuarios ?></p>
        </div>

        <div class="admin-card" style="flex:1;">
            <h3>🛠 <?php echo htmlspecialchars($LANG['admin_stats_builds'] ?? 'Builds'); ?></h3>
            <p><?= $total_builds ?></p>
        </div>

        <div class="admin-card" style="flex:1;">
            <h3>🌐 <?php echo htmlspecialchars($LANG['admin_stats_public_builds'] ?? 'Públicas'); ?></h3>
            <p><?= $builds_publicas ?></p>
        </div>

        <div class="admin-card" style="flex:1;">
            <h3>📅 <?php echo htmlspecialchars($LANG['admin_stats_builds_today'] ?? 'Hoy'); ?></h3>
            <p><?= $builds_hoy ?></p>
        </div>
    </div>

    <!-- GRÁFICOS -->
    <div style="display:flex; gap:30px; flex-wrap:wrap; margin-bottom:40px;">
        <div style="flex:1; min-width:300px; background:var(--bg-card); padding:20px; border-radius:12px;">
            <h3 style="color:var(--gold); margin-bottom:15px;"><?php echo htmlspecialchars($LANG['admin_chart_builds_by_day'] ?? 'Builds por día'); ?></h3>
            <canvas id="chartDias"></canvas>
        </div>

        <div style="flex:1; min-width:300px; background:var(--bg-card); padding:20px; border-radius:12px;">
            <h3 style="color:var(--gold); margin-bottom:15px;"><?php echo htmlspecialchars($LANG['admin_public'] ?? 'Públicas'); ?> / <?php echo htmlspecialchars($LANG['admin_private'] ?? 'Privadas'); ?></h3>
            <canvas id="chartPublicas"></canvas>
        </div>
    </div>

    <!-- TABLAS -->
    <div style="display:flex; gap:30px; flex-wrap:wrap;">
        
        <!-- Últimas builds -->
        <div style="flex:1; min-width:320px;">
            <h3 style="color:var(--gold);"><?php echo htmlspecialchars($LANG['admin_latest_builds'] ?? 'Últimas builds'); ?></h3>
            <table class="admin-table">
                <tr>
                    <th><?php echo htmlspecialchars($LANG['admin_title'] ?? 'Título'); ?></th>
                    <th><?php echo htmlspecialchars($LANG['account'] ?? 'Usuario'); ?></th>
                    <th><?php echo htmlspecialchars($LANG['date'] ?? 'Fecha'); ?></th>
                </tr>
                <?php while ($b = $ultimas_builds->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($b['titulo']) ?></td>
                    <td><?= htmlspecialchars($b['email']) ?></td>
                    <td><?= $b['created_at'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <!-- Últimos usuarios -->
        <div style="flex:1; min-width:320px;">
            <h3 style="color:var(--gold);"><?php echo htmlspecialchars($LANG['admin_latest_users'] ?? 'Últimos usuarios'); ?></h3>
            <table class="admin-table">
                <tr>
                    <th><?php echo htmlspecialchars($LANG['email'] ?? 'Email'); ?></th>
                    <th><?php echo htmlspecialchars($LANG['date'] ?? 'Fecha'); ?></th>
                </tr>
                <?php while ($u = $Ultimos = $ultimos_users->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= $u['created_at'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>

    </div>

</main>

<!-- CHART.JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/* Gráfico de builds por día */
new Chart(document.getElementById('chartDias'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($labels_dias) ?>,
        datasets: [{
            label: <?php echo json_encode($LANG['admin_builds_created'] ?? 'Builds creadas'); ?>,
            data: <?= json_encode($data_dias) ?>,
            backgroundColor: '#e5c784',
            borderColor: '#c6a667',
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});

/* Gráfico públicas vs privadas */
new Chart(document.getElementById('chartPublicas'), {
    type: 'doughnut',
    data: {
        labels: [<?php echo json_encode($LANG['admin_public'] ?? 'Públicas'); ?>, <?php echo json_encode($LANG['admin_private'] ?? 'Privadas'); ?>],
        datasets: [{
            data: [<?= $builds_publicas ?>, <?= $privadas ?>],
            backgroundColor: ['#e5c784', '#555'],
            borderColor: ['#c6a667', '#000'],
            borderWidth: 2
        }]
    }
});
</script>

<?php include __DIR__ . '/../inc/pie.php'; ?>