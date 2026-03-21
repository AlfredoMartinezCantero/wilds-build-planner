<?php include "../inc/cabecera.php"; 
include "../inc/sesion.php";
?>

<main>

    <!-- HERO PRINCIPAL -->
    <section id="hero" class="hero-modern">
        <h1 class="title-hero">MH Wilds Builder</h1>
        <p class="subtitle-hero">
            La herramienta definitiva para optimizar tu equipo de cazador.
        </p>

        <a href="planner.php" class="btn-hero">
            Ir al Planificador de Builds
        </a>
    </section>

    <!-- SECCIÓN NOTICIAS -->
<section class="noticias-modern">

    <h2>Últimas Noticias</h2>

    <div class="noticia-card">
        <div class="noticia-img">
            <img src="img/mh-official.jpg" alt="Monster Hunter Official">
        </div>

        <div class="noticia-texto">
            <h3>¿Te gusta Monster Hunter?</h3>
            <p>
                Si estás interesado en los juegos de la saga, te recomiendo visitar la web oficial. 
                Descubre novedades, monstruos, armas y todo el contenido exclusivo.
            </p>

            <a href="https://www.monsterhunter.com/" 
               target="_blank" 
               class="btn-mh"
               style="margin-top:10px; display:inline-block;">
                Visitar web oficial →
            </a>
        </div>
    </div>

</section>


</main>

<?php include "../inc/pie.php"; ?>