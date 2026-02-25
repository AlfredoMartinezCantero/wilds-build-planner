<?php
include "../inc/sesion.php";

// Si no hay sesión o no es admin se va fuera
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../front/index.php");
    exit;
}