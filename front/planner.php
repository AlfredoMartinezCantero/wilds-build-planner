<?php
    // Indicamos el CSS específico de esta página
    $css_propio = "planner.css"; 

    // Conexión y funciones
    include "../inc/conectar.php"; 
    include "../inc/funciones.php"; 

    /**
     * Renderiza un bloque de pieza de equipo (arma o armadura)
     * Renderiza un arma o armadura
     * @param string $icono          Nombre del archivo de icono (sin .png)
     * @param string $etiqueta       Texto descriptivo ("Arma", "Casco", etc.)
     * @param string $nameSelect     Atributo name del <select>
     * @param string $tabla          Tabla de la BD ("armas" o "armaduras")
     * @param string|null $tipo      Tipo de armadura ("head","chest",...) o null para armas
     * @param string $textoHabs      Texto que aparece debajo (habilidades / stats)
     * @return string                HTML del bloque
     */
    function renderPieza($icono, $etiqueta, $nameSelect, $tabla, $tipo = null, $textoHabs = 'Sin habilidades') {
        // Usamos output buffering para construir el HTML y devolverlo como string
        ob_start();
        ?>
        <div class="pieza-bloque">
            <div class="info-pieza">
                <img src="img/iconos/<?php echo $icono; ?>.png" alt="<?php echo htmlspecialchars($etiqueta); ?>">
                <select name="<?php echo htmlspecialchars($nameSelect); ?>">
                    <option value="0">Selecciona <?php echo strtolower($etiqueta); ?>...</option>
                    <?php echo cargarOpciones($tabla, $tipo); ?>
                </select>
            </div>
            <div class="habilidades-mini"><?php echo $textoHabs; ?></div>
        </div>
        <?php
        return ob_get_clean();
    }

    // Cabecera HTML (nav, <head>, etc.)
    include "../inc/cabecera.php"; 
?>

<main>
    <section id="planner">
        <div id="grid-armadura">

            <?php
                // ARMA
                echo renderPieza(
                    "arma",                // icono (img/iconos/arma.png)
                    "Arma",                // etiqueta
                    "select-arma",         // name del select
                    "armas",               // tabla
                    null,                  // tipo (no aplica a armas)
                    "Estadísticas del arma"// texto de habilidades
                );

                // CASCO (HEAD)
                echo renderPieza(
                    "casco",
                    "Casco",
                    "select-head",
                    "armaduras",
                    "head"
                );

                // PECHERA (CHEST)
                echo renderPieza(
                    "pechera",
                    "Pechera",
                    "select-chest",
                    "armaduras",
                    "chest"
                );

                // BRAZALES (GLOVES)
                echo renderPieza(
                    "brazales",
                    "Brazales",
                    "select-gloves",
                    "armaduras",
                    "gloves"
                );

                // FAJA (WAIST)
                echo renderPieza(
                    "faja",
                    "Faja",
                    "select-waist",
                    "armaduras",
                    "waist"
                );

                // PIERNAS (LEGS)
                echo renderPieza(
                    "piernas",
                    "Piernas",
                    "select-legs",
                    "armaduras",
                    "legs"
                );
            ?>

        </div>
    </section>

    <aside id="stats-panel">
        <h2>Estadísticas Totales</h2>
        <div id="total-ataque">Ataque: 0</div>
        <div id="total-defensa">Defensa: 0</div>
    </aside>
</main>

<?php 
    // Cierre de la página (footer, </body>, </html>) si lo tienes en pie.php
    include "../inc/pie.php"; 
?>