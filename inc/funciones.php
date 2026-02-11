<?php
include "conectar.php";

function obtenerOpciones($tabla, $tipo = null) {
    global $conexion;
    $sql = "SELECT id, nombre FROM $tabla";
    
    // Si es armadura, filtramos por el tipo (head, chest, etc.)
    if ($tipo != null) {
        $sql .= " WHERE tipo = '$tipo'";
    }
    
    $sql .= " ORDER BY nombre ASC";
    return mysqli_query($conexion, $sql);
}
?>