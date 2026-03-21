<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../../inc/sesion.php";
require_once __DIR__ . "/../../inc/conectar.php";

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../front/login.php");
    exit;
}

$user_id = (int) $_SESSION['id_usuario'];

$nickname = $conexion->real_escape_string($_POST['nickname']);
$hunter_rank = (int)$_POST['hunter_rank'];
$prefs = $conexion->real_escape_string($_POST['prefs_json']);

$sql = "UPDATE profiles 
        SET nickname='$nickname',
            hunter_rank=$hunter_rank,
            prefs_json='$prefs'
        WHERE user_id=$user_id";

$conexion->query($sql);

header("Location: ../../front/perfil.php");
exit;