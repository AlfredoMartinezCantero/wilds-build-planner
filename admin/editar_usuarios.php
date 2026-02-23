<?php
include "proteger.php";
include "../inc/conectar.php";

$id = $_GET["id"];
$res = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id=$id");
$u = mysqli_fetch_assoc($res);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["usuario"];
    $email = $_POST["email"];
    $rol = $_POST["rol"];

    mysqli_query($conexion, "
        UPDATE usuarios
        SET nombre_usuario='$name', email='$email', rol='$rol'
        WHERE id=$id
    ");

    header("Location: gestionar_usuarios.php");
    exit;
}
?>

<?php include "../inc/cabecera.php"; ?>

<main class="panel-admin" style="max-width:500px;margin:40px auto;">
    <h1>Editar Usuario</h1>

    <form method="POST">
        <label>Usuario</label>
        <input type="text" name="usuario" value="<?= $u['nombre_usuario'] ?>">

        <label>Email</label>
        <input type="email" name="email" value="<?= $u['email'] ?>">

        <label>Rol</label>
        <select name="rol">
            <option value="usuario" <?= $u['rol']=="usuario"?"selected":"" ?>>Usuario</option>
            <option value="admin" <?= $u['rol']=="admin"?"selected":"" ?>>Admin</option>
        </select>

        <button class="btn-hero" style="margin-top:25px;">Guardar cambios</button>
    </form>
</main>