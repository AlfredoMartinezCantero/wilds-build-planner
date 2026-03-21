<?php
session_start();

// Si viene toggle automático
if (!isset($_GET['lang'])) {
    if (isset($_SESSION['lang']) && $_SESSION['lang'] === 'en') {
        $_SESSION['lang'] = 'es';
    } else {
        $_SESSION['lang'] = 'en';
    }
}
// Si viene seleccionado directamente (ES/EN)
else {
    $lang = $_GET['lang'] === 'en' ? 'en' : 'es';
    $_SESSION['lang'] = $lang;
}

// Volver a la página de origen
$origin = $_SERVER['HTTP_REFERER'] ?? '../front/index.php';
header("Location: $origin");
exit;