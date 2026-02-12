<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MH Wilds Builder</title>
    <link rel="stylesheet" href="css/estilo.css">
    <?php if(isset($css_propio)): ?>
        <link rel="stylesheet" href="css/<?php echo $css_propio; ?>">
    <?php endif; ?>
</head>

<body>
<nav>
    <a href="index.php">Inicio</a>
    <a href="planner.php">Planificador de Builds</a>
    <a href="admin/index.php">Panel Admin</a>
</nav>