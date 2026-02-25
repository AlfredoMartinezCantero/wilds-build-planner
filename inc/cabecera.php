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
    <a href="../front/index.php">Inicio</a>
    <a href="../front/planner.php">Planificador de Builds</a>
    <?php 
        include_once "sesion.php"; 
        if(isset($_SESSION['id_usuario'])):
    ?>
        <!-- Usuario logeado -->
        <a href="../front/logout.php">Cerrar sesión</a>

        <?php if($_SESSION['rol'] === 'admin'): ?>
            <a href="/admin/index.php">Panel Admin</a>
        <?php endif; ?>

    <?php else: ?>
        <!-- Usuario no logeado -->
        <a href="login.php">Iniciar sesión</a>
        <a href="register.php">Registrarse</a>
    <?php endif; ?>

</nav>