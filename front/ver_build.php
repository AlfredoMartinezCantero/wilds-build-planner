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

// 1) Cargar datos de la build
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

// 2) Cargar items de la build
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
    'weapon_main' => ['label' => 'Arma principal',  'data' => null],
    'weapon_sub'  => ['label' => 'Arma secundaria','data' => null],
    'head'        => ['label' => 'Casco',           'data' => null],
    'chest'       => ['label' => 'Pechera',         'data' => null],
    'arms'        => ['label' => 'Brazales',        'data' => null],
    'waist'       => ['label' => 'Faja',            'data' => null],
    'legs'        => ['label' => 'Piernas',         'data' => null],
    'charm'       => ['label' => 'Amuleto',         'data' => null],
];

// 3) Resolver cada item (arma/armadura) contra su tabla
while ($row = $resItems->fetch_assoc()) {
    $position = $row['position'];
    $type     = $row['item_type'];
    $ref_id   = (int)$row['item_ref_id'];

    if (!isset($slots[$position])) {
        continue; // posición que no estamos mostrando aún
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
            $nombre = $armadura['nombre']; // si quieres, puedes añadir " (head/chest...)"
        }
    } else {
        // Otros tipos futuros: jewel, charm...
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

        <p><strong>Notas:</strong><br><?= nl2br(htmlspecialchars($build['notas'] ?? "")); ?></p>

        <p><strong>Visibilidad:</strong> <?= $build['es_publica'] ? "Pública" : "Privada"; ?></p>

        <?php $monstruo = $build['target_monster'] ?? ""; ?>
        <p><strong>Monstruo objetivo:</strong> <?= $monstruo !== "" ? htmlspecialchars($monstruo) : "Ninguno"; ?></p>

        <hr style="border-color:var(--border); margin:15px 0;">

        <h3 style="color:var(--gold-bright); margin-bottom:10px;">Equipo</h3>
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
            <a href="mis_builds.php" style="color:var(--gold); text-decoration:none;">Volver</a>
        </div>
    </div>
</main>

<?php include __DIR__ . "/../inc/pie.php"; ?>