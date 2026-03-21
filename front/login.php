<?php
require_once __DIR__ . "/../inc/sesion.php";
include "../inc/conectar.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario = $_POST["usuario"];
    $pass = $_POST["password"];

    /* Buscar por nickname o email */
    $sql = "SELECT u.id, u.email, u.password_hash, u.role, p.nickname
            FROM users u
            JOIN profiles p ON p.user_id = u.id
            WHERE p.nickname = '$usuario'
            OR u.email = '$usuario'
            LIMIT 1";

    $res = mysqli_query($conexion, $sql);

    if ($res && mysqli_num_rows($res) == 1) {   // Comprueba que haya 1 usuario

        $u = mysqli_fetch_assoc($res);          // Obtiene los datos del user

        // Verifica la contraseña introducida frente al hash almacenado en BBDD
        if (password_verify($pass, $u['password_hash'])) {

            // Guarda datos importantes en la sesión para usar en el resto de la web
            $_SESSION['id_usuario'] = $u['id'];
            $_SESSION['usuario'] = $u['nickname'];
            $_SESSION['rol'] = $u['role'];

            header("Location: index.php");
            exit;
        }
    }

    $error = "Usuario o contraseña incorrectos";
}
?>

<?php include "../inc/cabecera.php"; ?>

<main>
    <div class="form-container">

        <h2>Iniciar Sesión</h2>

        <?php if($error): ?>
            <p style="color:#ff8888;text-align:center;margin-bottom:15px;">
                <?= $error ?>
            </p>
        <?php endif; ?>

        <form method="POST">

            <div class="form-group">
                <label for="usuario">Usuario o Email</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Entrar</button>

        </form>

        <div class="bottom-text">
            ¿No tienes cuenta?
            <a href="../front/register.php">Regístrate</a>
        </div>

    </div>
</main>

<?php include "../inc/pie.php"; ?>