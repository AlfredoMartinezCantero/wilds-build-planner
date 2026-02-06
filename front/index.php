<?php 
    $css_propio = "planner.css"; // Definimos el archivo antes del include
    include "../inc/cabecera.php"; 
?>

<main>
    <section id="planner">
<div id="grid-armadura">
    <div class="pieza-bloque">
        <div class="info-pieza">
            <img src="img/iconos/casco.png" alt="Casco">
            <select name="select-casco">
                <option value="0">Selecciona el casco...</option>
            </select>
        </div>
        <div class="habilidades-mini">Sin habilidades seleccionadas</div>
    </div>

    <div class="pieza-bloque">
        <div class="info-pieza">
            <img src="img/iconos/pechera.png" alt="Pechera">
            <select name="select-pechera">
                <option value="0">Selecciona la pechera...</option>
            </select>
        </div>
        <div class="habilidades-mini">Sin habilidades seleccionadas</div>
    </div>

    <div class="pieza-bloque">
        <div class="info-pieza">
            <img src="img/iconos/brazales.png" alt="Brazales">
            <select name="select-brazales">
                <option value="0">Selecciona los brazales...</option>
            </select>
        </div>
        <div class="habilidades-mini">Sin habilidades seleccionadas</div>
    </div>

    <div class="pieza-bloque">
        <div class="info-pieza">
            <img src="img/iconos/faja.png" alt="Faja">
            <select name="select-faja">
                <option value="0">Selecciona la faja...</option>
            </select>
        </div>
        <div class="habilidades-mini">Sin habilidades seleccionadas</div>
    </div>

    <div class="pieza-bloque">
        <div class="info-pieza">
            <img src="img/iconos/piernas.png" alt="Piernas">
            <select name="select-piernas">
                <option value="0">Selecciona las piernas...</option>
            </select>
        </div>
        <div class="habilidades-mini">Sin habilidades seleccionadas</div>
    </div>


    </div>
    </section>

    <aside id="stats-panel">
        </aside>
</main>

<?php include "../inc/pie.php"; ?>