<?php
    $servidor = "localhost";
    $usuario = "alfredo"; 
    $password = "Wilds2025$"; 
    $base_de_datos = "wilds_planner";

    $conexion = mysqli_connect($servidor, $usuario, $password, $base_de_datos);

    // Verificación (Human-centric: si falla, queremos saber por qué)
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    
    // Configuramos el idioma para que las tildes de las armas se vean bien
    mysqli_set_charset($conexion, "utf8mb4");
?>