<?php
include "../../inc/conectar.php";

$id_usuario = 1; // temporal
$nombre = $_POST['nombre'] ?? 'Build sin nombre';

mysqli_query($conexion, "
    INSERT INTO builds (id_usuario, nombre_build)
    VALUES ($id_usuario, '$nombre')
");

echo "Build guardada (demo).";