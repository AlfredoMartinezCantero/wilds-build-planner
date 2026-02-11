<?php
    $servidor = "localhost";
    $usuario = "root"; 
    $password = ""; 
    $base_de_datos = "wilds_planner";

    $conexion = mysqli_connect($servidor, $usuario, $password, $base_de_datos);

    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    
    // charset para evitar problemas con tildes
    mysqli_set_charset($conexion, "utf8mb4");
?>