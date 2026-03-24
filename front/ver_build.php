<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../inc/sesion.php";
require_once __DIR__ . "/../inc/conectar.php";

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$build_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($build_id <= 0) {
    die("Build no válida.");
}

// Cargar datos de la build
$sqlBuild = "
    SELECT b.*, u.email 
    FROM builds b
    JOIN users u ON b.user_id = u.id
    WHERE b.id = $build_id
";
$resBuild = $conexion->query($sqlBuild);
if (!$resBuild) {
    die("ERROR SQL en ver_build (build): " . $conexion->error);
}
$build = $resBuild->fetch_assoc();
if (!$build) {
    die("La build no existe.");
}

// Cargar items de la build
$sqlItems = "
    SELECT item_type, item_ref_id, position
    FROM build_items
    WHERE build_id = $build_id
";
$resItems = $conexion->query($sqlItems);
if (!$resItems) {
    die("ERROR SQL en ver_build (build_items): " . $conexion->error);
}

// Estructura para guardar los slots
$slots = [
    'weapon_main' => ['label' => $LANG['weapon_main'] ?? 'Arma principal',  'data' => null],
    'weapon_sub'  => ['label' => $LANG['weapon_sub'] ?? 'Arma secundaria','data' => null],
    'head'        => ['label' => $LANG['helmet'] ?? 'Casco',           'data' => null],
    'chest'       => ['label' => $LANG['chest'] ?? 'Pechera',         'data' => null],
    'arms'        => ['label' => $LANG['gloves'] ?? 'Brazales',        'data' => null],
    'waist'       => ['label' => $LANG['waist'] ?? 'Faja',            'data' => null],
    'legs'        => ['label' => $LANG['legs'] ?? 'Piernas',         'data' => null],
    'charm'       => ['label' => $LANG['charm'] ?? 'Amuleto',         'data' => null],
];

// Resolver cada item (arma/armadura) contra su tabla
while ($row = $resItems->fetch_assoc()) {
    $position = $row['position'];
    $type     = $row['item_type'];
    $ref_id   = (int)$row['item_ref_id'];

    if (!isset($slots[$position])) {
        continue; // posición que aun no se muestra
    }

    $nombre = null;

    if ($type === 'weapon') {
        $sql = "SELECT nombre, tipo FROM armas WHERE id = $ref_id";
        $res = $conexion->query($sql);
        if ($res && $arma = $res->fetch_assoc()) {
            $nombre = $arma['nombre'] . " (" . $arma['tipo'] . ")";
        }
    } elseif ($type === 'armor') {
        $sql = "SELECT nombre, tipo FROM armaduras WHERE id = $ref_id";
        $res = $conexion->query($sql);
        if ($res && $armadura = $res->fetch_assoc()) {
            $nombre = $armadura['nombre']; 
        }
    } else {
        // Otros tipos futuros
        $nombre = "Item #$ref_id ($type)";
    }

    $slots[$position]['data'] = [
        'nombre' => $nombre
    ];
}

include __DIR__ . "/../inc/cabecera.php";
?>

<main>
    <div class="build-box" style="background:var(--bg-panel); padding:20px; border-radius:12px; max-width:800px; margin:20px auto;">
        <h2 style="color:var(--gold); margin-bottom:10px;">
            <?= htmlspecialchars($build['titulo']); ?>
        </h2>

        <p><strong><?php echo htmlspecialchars($LANG['notes'] ?? 'Notas'); ?>:</strong><br><?= nl2br(htmlspecialchars($build['notas'] ?? "")); ?></p>

        <p><strong><?php echo htmlspecialchars($LANG['visibility'] ?? 'Visibilidad'); ?>:</strong> <?= $build['es_publica'] ? htmlspecialchars($LANG['public'] ?? 'Pública') : htmlspecialchars($LANG['private'] ?? 'Privada'); ?></p>

        <?php $monstruo = $build['target_monster'] ?? ""; ?>
        <p><strong><?php echo htmlspecialchars($LANG['target_monster'] ?? 'Monstruo objetivo'); ?>:</strong> <?= $monstruo !== "" ? htmlspecialchars($monstruo) : htmlspecialchars($LANG['none'] ?? 'Ninguno'); ?></p>

        <hr style="border-color:var(--border); margin:15px 0;">

        <h3 style="color:var(--gold-bright); margin-bottom:10px;"><?php echo htmlspecialchars($LANG['equipment'] ?? 'Equipo'); ?></h3>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:10px;">
            <?php foreach ($slots as $key => $slot): ?>
                <div style="background:var(--bg-card); padding:10px; border-radius:8px;">
                    <strong><?= htmlspecialchars($slot['label']); ?>:</strong><br>
                    <?php if ($slot['data'] && !empty($slot['data']['nombre'])): ?>
                        <?= htmlspecialchars($slot['data']['nombre']); ?>
                    <?php else: ?>
                        <span style="color:var(--text-muted);">Sin seleccionar</span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div style="margin-top:20px;">
            <a href="mis_builds.php" style="color:var(--gold); text-decoration:none;"><?php echo htmlspecialchars($LANG['back'] ?? 'Volver'); ?></a>
        </div>
    </div>
</main>

<?php include __DIR__ . "/../inc/pie.php"; ?>