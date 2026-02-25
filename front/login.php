<?php
include "../inc/sesion.php";
include "../inc/conectar.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario = $_POST["usuario"];
    $pass = $_POST["password"];

    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$usuario' LIMIT 1";
    $res = mysqli_query($conexion, $sql);

    if ($res && mysqli_num_rows($res) == 1) {
        $u = mysqli_fetch_assoc($res);

        if (password_verify($pass, $u['password'])) {

            $_SESSION['id_usuario'] = $u['id'];
            $_SESSION['usuario'] = $u['nombre_usuario'];
            $_SESSION['rol'] = $u['rol'];

            header("Location: index.php");
            exit;
        }
    }
    $error = "Usuario o contraseña incorrectos";
}
?>

<?php include "../inc/cabecera.php"; ?>

<main class="panel-admin" style="max-width:400px;margin:60px auto;">
    <h1>Iniciar Sesión</h1>

    <?php if($error): ?>
        <p style="color:#ff8888;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Usuario</label>
        <input type="text" name="usuario" required>

        <label>Contraseña</label>
        <input type="password" name="password" required>

        <button class="btn-hero" style="margin-top:20px;">Entrar</button>
    </form>

    <p style="margin-top:20px;">
        ¿No tienes cuenta?
    <a href="../front/register.php">Regístrate</a>
    </p>

</main>

<?php include "../inc/pie.php"; ?>
