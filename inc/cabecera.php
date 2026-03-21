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
        <a href="../front/perfil.php">Mi Perfil</a>
        <a href="../front/mis_builds.php">Mis Builds</a>
        <a href="../front/logout.php">Cerrar sesión</a>

        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
            <a href="../admin/index.php">Panel Admin</a>
        <?php endif; ?>

    <?php else: ?>
        <!-- Usuario no logeado -->
        <a href="login.php">Iniciar sesión</a>
        <a href="register.php">Registrarse</a>
    <?php endif; ?>
    <!-- Botón de tema claro/oscuro -->
    <button type="button" id="theme-toggle" style="margin-left:10px; padding:6px 10px; 
            background:none; border:1px solid var(--border); border-radius:6px; 
            color:var(--text); cursor:pointer; font-size:0.9rem;">
        🌙 Oscuro
    </button>
    <a href="../inc/cambiar_idioma.php" class="btn-lang" id="lang-toggle">🌐 ES</a>
</nav>

<script>
    (function() {
        const body = document.body;
        const btn = document.getElementById('theme-toggle');

        function aplicarTema(theme) {
            if (theme === 'light') {
                body.classList.add('theme-light');
                if (btn) btn.textContent = '☀️ Claro';
            } else {
                body.classList.remove('theme-light');
                if (btn) btn.textContent = '🌙 Oscuro';
            }
        }

        // Cargar tema desde localStorage
        const temaGuardado = localStorage.getItem('theme') || 'dark';
        aplicarTema(temaGuardado);

        if (btn) {
            btn.addEventListener('click', () => {
                const nuevoTema = body.classList.contains('theme-light') ? 'dark' : 'light';
                localStorage.setItem('theme', nuevoTema);
                aplicarTema(nuevoTema);
            });
        }
    })();
</script>
