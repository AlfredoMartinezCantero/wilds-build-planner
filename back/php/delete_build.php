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

if ($build_id <= 0) {
    header("Location: ../../front/mis_builds.php");
    exit;
}

// Solo borra builds del propio usuario
$sql = "DELETE FROM builds WHERE id = $build_id AND user_id = $user_id";

if (!$conexion->query($sql)) {
    die("ERROR SQL en delete_build: " . $conexion->error);
}

header("Location: ../../front/mis_builds.php");
exit;