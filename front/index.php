<?php include "../inc/sesion.php"; 
include "../inc/cabecera.php"; 
?>

<main>

    <!-- HERO PRINCIPAL -->
    <section id="hero" class="hero-modern">
        <h1 class="title-hero"><?php echo htmlspecialchars($LANG['site_title'] ?? 'MH Wilds Builder'); ?></h1>
        <p class="subtitle-hero">
            <?php echo htmlspecialchars($LANG['hero_subtitle'] ?? 'La herramienta definitiva para optimizar tu equipo de cazador.'); ?>
        </p>

        <a href="planner.php" class="btn-hero">
            <?php echo htmlspecialchars($LANG['cta_planner'] ?? 'Ir al Planificador de Builds'); ?>
        </a>
    </section>

    <!-- SECCIÓN NOTICIAS -->
<section class="noticias-modern">

    <h2><?php echo htmlspecialchars($LANG['latest_news'] ?? 'Últimas Noticias'); ?></h2>

    <div class="noticia-card">
        <div class="noticia-img">
            <img src="img/mh-official.jpg" alt="Monster Hunter Official">
        </div>

        <div class="noticia-texto">
            <h3><?php echo htmlspecialchars($LANG['news_question'] ?? '¿Te gusta Monster Hunter?'); ?></h3>
            <p>
                <?php echo htmlspecialchars($LANG['news_description'] ?? 'Si estás interesado en los juegos de la saga, te recomiendo visitar la web oficial. Descubre novedades, monstruos, armas y todo el contenido exclusivo.'); ?>
            </p>

            <a href="https://www.monsterhunter.com/" 
               target="_blank" 
               class="btn-mh"
               style="margin-top:10px; display:inline-block;">
                <?php echo htmlspecialchars($LANG['visit_official'] ?? 'Visitar web oficial →'); ?>
            </a>
        </div>
    </div>

</section>


</main>

<?php include "../inc/pie.php"; ?>