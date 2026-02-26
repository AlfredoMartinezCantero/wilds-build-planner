<?php

/**
 * Genera las <option> para un <select> a partir de la BD.
 *
 * @param string      $tabla  "armas" o "armaduras"
 * @param string|null $tipo   Para armaduras: 'head','chest','gloves','waist','legs'. Para armas: null.
 * @return string             HTML con varias <option>
 */
function cargarOpciones($tabla, $tipo = null) {
    global $conexion;       // Usa la conexión global de la BBDD
    $html = '';             

    if ($tabla === 'armas') {
        // Ignora $tipo, sacando todas las armas
        $sql = "SELECT id, nombre FROM armas ORDER BY nombre ASC";
        $resultado = $conexion->query($sql);

        if ($resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                $id     = (int)$fila['id'];
                $nombre = htmlspecialchars($fila['nombre']);
                $html  .= "<option value=\"{$id}\">{$nombre}</option>\n";
            }
        }
    } elseif ($tabla === 'armaduras') {
        // Para las armaduras se usa el tipo head, chest, gloves, waist y legs
        $tipoSeg = $conexion->real_escape_string($tipo);    // Evita inyección en query
        $sql = "
            SELECT id, nombre
            FROM armaduras
            WHERE tipo = '{$tipoSeg}'
            ORDER BY rareza DESC, nombre ASC
        ";
        $resultado = $conexion->query($sql);

        if ($resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                $id     = (int)$fila['id'];
                $nombre = htmlspecialchars($fila['nombre']);
                $html  .= "<option value=\"{$id}\">{$nombre}</option>\n";
            }
        }
    }

    return $html;   // Devuelve las <option> ya generadas como string
}
