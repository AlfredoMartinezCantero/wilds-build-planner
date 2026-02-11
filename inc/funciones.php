<?php
include "conectar.php";

function cargarOpciones($tabla, $tipo = null) {
    global $conexion;
    
    // Construimos la consulta
    $sql = "SELECT id, nombre FROM $tabla";
    if ($tipo !== null) {
        $sql .= " WHERE tipo = '$tipo'";
    }
    $sql .= " ORDER BY nombre ASC";

    $resultado = mysqli_query($conexion, $sql);
    
    // Si la consulta falla (ej: la tabla no existe o está mal escrita)
    if (!$resultado) {
        return "<option value='0'>Error en tabla $tabla</option>";
    }

    $opciones = "";
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $opciones .= "<option value='".$fila['id']."'>".$fila['nombre']."</option>";
    }
    
    return $opciones;
}
?>

