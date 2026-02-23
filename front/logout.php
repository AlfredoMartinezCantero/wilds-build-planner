<?php
include "../inc/sesion.php";
session_destroy();
header("Location: login.php");
exit;