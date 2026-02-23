<?php
include "../inc/sesion.php";
include "../inc/conectar.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre_usuario, email, password)
            VALUES ('$usuario', '$email', '$pass')";
    
    if (mysqli_query($conexion, $sql)) {
        $mensaje = "Usuario registrado. Ahora puedes iniciar sesión.";
    } else {
        $mensaje = "Error: el usuario o email ya existe.";
    }
}
?>

<?php include "../inc/cabecera.php"; ?>

<main class="panel-admin" style="max-width:400px;margin:60px auto;">
    <h1>Registro de Usuario</h1>

    <?php if($mensaje): ?>
        <p style="color:#88ff88;"><?= $mensaje ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Usuario</label>
        <input type="text" name="usuario" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Contraseña</label>
        <input type="password" name="password" required>

        <button class="btn-hero" style="margin-top:20px;">Registrarse</button>
    </form>

    <p style="margin-top:20px;">
        ¿Ya tienes cuenta?
        front/login.phpInicia sesión</a>
    </p>

</main>

<?php include "../inc/pie.php"; ?>