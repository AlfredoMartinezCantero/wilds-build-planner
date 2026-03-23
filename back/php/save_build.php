<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../../inc/sesion.php";
require_once __DIR__ . "/../../inc/conectar.php";

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../front/login.php");
    exit;
}

$user_id  = (int)$_SESSION['id_usuario'];
$build_id = isset($_POST['build_id']) ? (int)$_POST['build_id'] : 0;

// Datos básicos comunes
$titulo = $conexion->real_escape_string($_POST['titulo'] ?? 'Build sin título');
$notas  = $conexion->real_escape_string($_POST['notas'] ?? '');
$public = isset($_POST['es_publica']) ? 1 : 0;

if ($build_id > 0) {
    // Actualizaciones: solo actualizar datos básicos de una build existente del usuario
    $sqlUpdate = "UPDATE builds 
                  SET titulo = '$titulo',
                      notas = '$notas',
                      es_publica = $public
                  WHERE id = $build_id AND user_id = $user_id";

    if (!$conexion->query($sqlUpdate)) {
        die("ERROR SQL en save_build (update): " . $conexion->error);
    }

    header("Location: ../../front/mis_builds.php");
    exit;
}

// Crear: insertar nueva build + items del planner

// Insertar en tabla builds
$sqlBuild = "INSERT INTO builds (user_id, titulo, notas, es_publica)
             VALUES ($user_id, '$titulo', '$notas', $public)";

if (!$conexion->query($sqlBuild)) {
    die("ERROR SQL en save_build (insert build): " . $conexion->error);
}

$build_id = $conexion->insert_id;

// Recoger IDs seleccionados en el planner
$weapon_main_id = (int)($_POST['weapon_main_id'] ?? 0);
$weapon_sub_id  = (int)($_POST['weapon_sub_id'] ?? 0);

$head_id   = (int)($_POST['select-head']   ?? 0);
$chest_id  = (int)($_POST['select-chest']  ?? 0);
$gloves_id = (int)($_POST['select-gloves'] ?? 0);
$waist_id  = (int)($_POST['select-waist']  ?? 0);
$legs_id   = (int)($_POST['select-legs']   ?? 0);

// Función para insertar en build_items
function insertarItem($conexion, $build_id, $item_id, $position, $type) {
    if ($item_id <= 0) return;

    $position_sql = $conexion->real_escape_string($position);
    $type_sql     = $conexion->real_escape_string($type);

    $sql = "INSERT INTO build_items (build_id, item_type, item_ref_id, position)
            VALUES ($build_id, '$type_sql', $item_id, '$position_sql')";

    if (!$conexion->query($sql)) {
        die("ERROR SQL en save_build (build_items): " . $conexion->error);
    }
}

// Guardar arma principal y secundaria
insertarItem($conexion, $build_id, $weapon_main_id, 'weapon_main', 'weapon');
insertarItem($conexion, $build_id, $weapon_sub_id,  'weapon_sub',  'weapon');

// Guardar armaduras
insertarItem($conexion, $build_id, $head_id,   'head',   'armor');
insertarItem($conexion, $build_id, $chest_id,  'chest',  'armor');
insertarItem($conexion, $build_id, $gloves_id, 'arms',   'armor');
insertarItem($conexion, $build_id, $waist_id,  'waist',  'armor');
insertarItem($conexion, $build_id, $legs_id,   'legs',   'armor');

// Volver a Mis Builds
header("Location: ../../front/mis_builds.php");
exit;
