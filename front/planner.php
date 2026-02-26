<?php
    $css_propio = "planner.css"; 

    include "../inc/conectar.php"; 
    include "../inc/funciones.php"; 

    /**
     * Renderiza un bloque de pieza de equipo (armadura)
     * @param string $icono          Nombre del archivo de icono (sin .png)
     * @param string $etiqueta       Texto descriptivo ("Casco", "Pechera", etc.)
     * @param string $nameSelect     Atributo name del <select>
     * @param string $tabla          Tabla de la BD ("armaduras")
     * @param string|null $tipo      Tipo de armadura ("head","chest",...)
     * @param string $textoHabs      Texto que aparece debajo (habilidades / stats)
     * @return string                HTML del bloque
     */
    function renderPieza($icono, $etiqueta, $nameSelect, $tabla, $tipo = null, $textoHabs = 'Sin habilidades') {
        // Output buffering para construir el HTML y devolverlo como string
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
        // Se devuelve todo el HTML
        return ob_get_clean();
    }

    /**
     * Devuelve una etiqueta para el tipo de arma por ejemplo, great_sword se refleja como Gran Espada en la web
     */
    function labelTipoArma($tipo) {
        $map = [
            'great_sword'   => 'Gran Espada',
            'long_sword'    => 'Espada Larga',
            'sword_shield'  => 'Espada y Escudo',
            'dual_blades'   => 'Doble Espadas',
            'lance'         => 'Lanza',
            'gunlance'      => 'Lanza Pistola',
            'hammer'        => 'Martillo',
            'hunting_horn'  => 'Cornamusa',
            'switch_axe'    => 'Hacha Espada',
            'charge_blade'  => 'Hacha Cargada',
            'insect_glaive' => 'Insectoglaive',
            'lbg'           => 'Ballesta Ligera',
            'hbg'           => 'Ballesta Pesada',
            'bow'           => 'Arco',
        ];

        // Si no está mapeado genera una etiqueta genérica
        return $map[$tipo] ?? ucwords(str_replace('_', ' ', $tipo));
    }

    // Cargo todas las armas y las agrupo por tipo
    $armasPorTipo = [];

    // id, nombre y tipo de todas las armas desde la BBDD
    $sqlArmas = "SELECT id, nombre, tipo FROM armas ORDER BY tipo, nombre";
    $resArmas = $conexion->query($sqlArmas);

    if (!$resArmas) {
        // Si la query falla se detiene la página con un mensaje
        die("Error al cargar armas: " . $conexion->error);
    }

    // Se agrupan las armas por su tipo para facilitar el rellenado en el front
    while ($fila = $resArmas->fetch_assoc()) {
        $tipo = $fila['tipo'];
        if (!isset($armasPorTipo[$tipo])) {
            $armasPorTipo[$tipo] = [];
        }
        $armasPorTipo[$tipo][] = [
            'id'     => (int)$fila['id'],
            'nombre' => $fila['nombre'],
        ];
    }

    include "../inc/cabecera.php"; 
?>

<main>
    <section id="planner">
        <div id="grid-armadura">

            <?php
                // ARMA PRINCIPAL
            ?>
            <div id="weapon-main" class="pieza-bloque">
                <div class="info-pieza">
                    <img src="img/iconos/arma.png" alt="Arma principal">
                    <div class="weapon-selects">
                        <!-- Select de tipo de arma -->
                        <select name="weapon_main_tipo" class="select-tipo-arma">
                            <option value="">Tipo de arma...</option>
                            <?php foreach ($armasPorTipo as $tipo => $lista): ?>
                                <option value="<?php echo htmlspecialchars($tipo); ?>">
                                    <?php echo htmlspecialchars(labelTipoArma($tipo)); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <!-- Select de arma concreta (se rellena por JS) -->
                        <select name="weapon_main_id" class="select-arma">
                            <option value="">Selecciona arma...</option>
                        </select>
                    </div>
                </div>
                <div class="habilidades-mini">Estadísticas arma principal</div>
            </div>

            <?php
                // ARMA SECUNDARIA
            ?>
            <div id="weapon-sub" class="pieza-bloque">
                <div class="info-pieza">
                    <img src="img/iconos/arma.png" alt="Arma secundaria">
                    <div class="weapon-selects">
                        <!-- Select de tipo de arma -->
                        <select name="weapon_sub_tipo" class="select-tipo-arma">
                            <option value="">Tipo de arma...</option>
                            <?php foreach ($armasPorTipo as $tipo => $lista): ?>
                                <option value="<?php echo htmlspecialchars($tipo); ?>">
                                    <?php echo htmlspecialchars(labelTipoArma($tipo)); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <!-- Select de arma concreta (se rellena por JS) -->
                        <select name="weapon_sub_id" class="select-arma">
                            <option value="">Selecciona arma...</option>
                        </select>
                    </div>
                </div>
                <div class="habilidades-mini">Estadísticas arma secundaria</div>
            </div>

            <?php
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

<!-- JS específico del planner: rellena las armas según el tipo elegido -->
<script>
    // Objeto con las armas agrupadas por tipo, generado desde PHP
    const ARMAS_POR_TIPO = <?php echo json_encode($armasPorTipo, JSON_UNESCAPED_UNICODE); ?>;
    console.log('ARMAS_POR_TIPO:', ARMAS_POR_TIPO);
    

    /* 
    Inicializa el comportamiento de selects (arma + arma concreta)
    dentro de un contenedor dado por su ID (weapon-main o weapon-sub)
    */
    function initWeaponSelects(containerId) {
        const cont = document.getElementById(containerId);
        if (!cont) {
            console.warn('No se encontró el contenedor', containerId);
            return;
        }

        const tipoSelect = cont.querySelector('.select-tipo-arma');
        const armaSelect = cont.querySelector('.select-arma');

        if (!tipoSelect || !armaSelect) {
            console.warn('Faltan selects dentro de', containerId);
            return;
        }

        // Rellena el select de armas cuando cambia el tipo
        function rellenarArmas() {
            const tipo = tipoSelect.value;
            armaSelect.innerHTML = '<option value="">Selecciona arma...</option>';

            if (!tipo || !ARMAS_POR_TIPO[tipo]) {
                return;
            }

            ARMAS_POR_TIPO[tipo].forEach(arma => {
                const opt = document.createElement('option');
                opt.value = arma.id;
                opt.textContent = arma.nombre;
                armaSelect.appendChild(opt);
            });
        }

        tipoSelect.addEventListener('change', rellenarArmas);
    }
    
    // Al cargar la página, se activa la lógica en arma principal y secundaria
    document.addEventListener('DOMContentLoaded', function() {
        initWeaponSelects('weapon-main');
        initWeaponSelects('weapon-sub');
    });
</script>

<?php 
    include "../inc/pie.php"; 
?>