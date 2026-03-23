<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../../inc/sesion.php";
require_once __DIR__ . "/../../inc/conectar.php";

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado.");
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

/* ACTUALIZAR USUARIO + PERFIL */
if ($action === 'update_user') {

    $id = (int)$_POST['id'];
    $email = $conexion->real_escape_string($_POST['email']);
    $role  = $conexion->real_escape_string($_POST['role']);

    $nickname = $conexion->real_escape_string($_POST['nickname']);
    $hr = (int)$_POST['hunter_rank'];
    $prefs = $conexion->real_escape_string($_POST['prefs_json']);

    // Actualizar tabla users
    $conexion->query("
        UPDATE users 
        SET email='$email', role='$role'
        WHERE id=$id
    ");

    // Actualizar tabla profiles
    $conexion->query("
        UPDATE profiles
        SET nickname='$nickname', hunter_rank=$hr, prefs_json='$prefs'
        WHERE user_id=$id
    ");

    header("Location: ../../admin/gestionar_usuarios.php");
    exit;
}

/* ELIMINAR USUARIO */
if ($action === 'delete_user') {
    $id = (int)$_POST['id'];

    $conexion->query("DELETE FROM users WHERE id=$id");
    // profiles y builds se borran por ON DELETE CASCADE

    header("Location: ../../admin/gestionar_usuarios.php");
    exit;
}

/* ELIMINAR BUILD */
if ($action === 'delete_build') {
    $id = (int)$_POST['id'];

    $conexion->query("DELETE FROM builds WHERE id=$id");

    header("Location: ../../admin/moderar_builds.php");
    exit;
}

die("Acción no válida.");