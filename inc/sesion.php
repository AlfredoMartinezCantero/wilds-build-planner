<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Idioma por defecto
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'es';
}

// Cargar fichero de idioma
$lang = $_SESSION['lang'];
include __DIR__ . "/../lang/$lang.php";