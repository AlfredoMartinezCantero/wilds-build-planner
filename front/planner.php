<?php 
    $css_propio = "planner.css"; 
    include "../inc/conectar.php"; 
    include "../inc/funciones.php"; 
    include "../inc/cabecera.php"; 
?>

<main>
    <section id="planner">
        <div id="grid-armadura">
            <div class="pieza-bloque">
                <div class="info-pieza">
                    <img src="img/iconos/arma.png" alt="Arma">
                    <select name="select-arma">
                        <option value="0">Selecciona arma...</option>
                        <?php echo cargarOpciones('armas'); ?>
                    </select>
                </div>
                <div class="habilidades-mini">Estadísticas del arma</div>
            </div>

            <div class="pieza-bloque">
                <div class="info-pieza">
                    <img src="img/iconos/casco.png" alt="Casco">
                    <select name="select-head">
                        <option value="0">Selecciona casco...</option>
                        <?php echo cargarOpciones('armaduras', 'head'); ?>
                    </select>
                </div>
                <div class="habilidades-mini">Sin habilidades</div>
            </div>

            <div class="pieza-bloque">
                <div class="info-pieza">
                    <img src="img/iconos/pechera.png" alt="Pecho">
                    <select name="select-chest">
                        <option value="0">Selecciona pechera...</option>
                        <?php echo cargarOpciones('armaduras', 'chest'); ?>
                    </select>
                </div>
                <div class="habilidades-mini">Sin habilidades</div>
            </div>

            <div class="pieza-bloque">
                <div class="info-pieza">
                    <img src="img/iconos/brazales.png" alt="Brazales">
                    <select name="select-gloves">
                        <option value="0">Selecciona brazales...</option>
                        <?php echo cargarOpciones('armaduras', 'gloves'); ?>
                    </select>
                </div>
                <div class="habilidades-mini">Sin habilidades</div>
            </div>

            <div class="pieza-bloque">
                <div class="info-pieza">
                    <img src="img/iconos/faja.png" alt="Cintura">
                    <select name="select-waist">
                        <option value="0">Selecciona faja...</option>
                        <?php echo cargarOpciones('armaduras', 'waist'); ?>
                    </select>
                </div>
                <div class="habilidades-mini">Sin habilidades</div>
            </div>

            <div class="pieza-bloque">
                <div class="info-pieza">
                    <img src="img/iconos/piernas.png" alt="Piernas">
                    <select name="select-legs">
                        <option value="0">Selecciona piernas...</option>
                        <?php echo cargarOpciones('armaduras', 'legs'); ?>
                    </select>
                </div>
                <div class="habilidades-mini">Sin habilidades</div>
            </div>
        </div>
    </section>

    <aside id="stats-panel">
        <h2>Estadísticas Totales</h2>
        <div id="total-ataque">Ataque: 0</div>
        <div id="total-defensa">Defensa: 0</div>
    </aside>
</main>