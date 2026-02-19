<?php
include "../../inc/conectar.php";

$action = $_GET['action'] ?? '';
$id = intval($_GET['id'] ?? 0);

switch($action){

    case "delete_user":
        mysqli_query($conexion, "DELETE FROM usuarios WHERE id = $id LIMIT 1");
        header("Location: ../../admin/gestionar_usuarios.php");
        exit;

    case "delete_build":
        mysqli_query($conexion, "DELETE FROM builds WHERE id = $id LIMIT 1");
        header("Location: ../../admin/moderar_builds.php");
        exit;

    case "sync":
        echo "⏳ Simulación de sincronización de datos...";
        break;

    default:
        echo "Acción no válida.";
}
