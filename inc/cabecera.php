<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($_SESSION['lang'] ?? 'es'); ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($LANG['site_title'] ?? 'MH Wilds Builder'); ?></title>

    <!-- CSS SIEMPRE desde ruta absoluta -->
    <link rel="stylesheet" href="/wilds-build-planner/front/css/estilo.css">

    <?php if (isset($css_propio)): ?>
    <link rel="stylesheet" href="/wilds-build-planner/front/css/<?= htmlspecialchars($css_propio) ?>">
    <?php endif; ?>
</head>

<body>

<nav>
    <a href="../front/index.php"><?php echo htmlspecialchars($LANG['nav_home'] ?? 'Inicio'); ?></a>
    <a href="../front/planner.php"><?php echo htmlspecialchars($LANG['nav_planner_full'] ?? 'Planificador de Builds'); ?></a>
    <?php 
        if(isset($_SESSION['id_usuario'])):
    ?>
        <!-- Usuario logeado -->
        <a href="../front/perfil.php"><?php echo htmlspecialchars($LANG['nav_profile'] ?? 'Mi Perfil'); ?></a>
        <a href="../front/mis_builds.php"><?php echo htmlspecialchars($LANG['nav_builds'] ?? 'Mis Builds'); ?></a>
        <a href="../front/logout.php"><?php echo htmlspecialchars($LANG['nav_logout'] ?? 'Cerrar sesión'); ?></a>

        <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
            <a href="../admin/index.php"><?php echo htmlspecialchars($LANG['nav_admin'] ?? 'Panel Admin'); ?></a>
        <?php endif; ?>

    <?php else: ?>
        <!-- Usuario no logeado -->
        <a href="../front/login.php"><?php echo htmlspecialchars($LANG['nav_login'] ?? 'Iniciar sesión'); ?></a>
        <a href="../front/register.php"><?php echo htmlspecialchars($LANG['nav_register'] ?? 'Registrarse'); ?></a>
    <?php endif; ?>
    <!-- Botón de tema claro/oscuro -->
    <button type="button" id="theme-toggle" style="margin-left:10px; padding:6px 10px; 
            background:none; border:1px solid var(--border); border-radius:6px; 
            color:var(--text); cursor:pointer; font-size:0.9rem;">
        <?php echo htmlspecialchars($LANG['theme_dark'] ?? '🌙 Oscuro'); ?>
    </button>
    <a href="../inc/cambiar_idioma.php" class="btn-lang" id="lang-toggle"><?php echo htmlspecialchars($LANG['lang_toggle'] ?? '🌐 ES'); ?></a>
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
