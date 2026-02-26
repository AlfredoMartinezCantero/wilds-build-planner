<?php
include "../inc/sesion.php";
include "../inc/conectar.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);

    /* INSERT EN users */
    $sql = "INSERT INTO users (email, password_hash)
            VALUES ('$email', '$pass')";

    if (mysqli_query($conexion, $sql)) {

        // Recupera el ID del usuario recién creado
        $user_id = mysqli_insert_id($conexion);

        /* INSERT EN profiles, se guarda el perfil asociado al usuario */
        $sql2 = "INSERT INTO profiles (user_id, nickname)
                 VALUES ($user_id, '$usuario')";
        mysqli_query($conexion, $sql2);

        $mensaje = "Usuario registrado. Ahora puedes iniciar sesión.";
    } 
    else {
        // Si falla el insert se muestra un mensaje genérico
        $mensaje = "Error: el email ya existe.";
    }
}
?>

<?php include "../inc/cabecera.php"; ?>

<main>
    <div class="form-container">

        <h2>Registro de Usuario</h2>

        <?php if($mensaje): ?>  <!-- Muestra mensaje de éxito o error si existe -->
            <p style="color:#88ff88;text-align:center;margin-bottom:15px;">
                <?= $mensaje ?>
            </p>
        <?php endif; ?>
        
        <!-- Formulario de registro: usuario, email, contraseña -->
        <form method="POST">

            <div class="form-group">
                <label for="usuario">Nombre del cazador</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Registrarse</button>
        </form>

        <div class="bottom-text">
            ¿Ya tienes cuenta?
            <a href="../front/login.php">Inicia sesión</a>
        </div>

    </div>
</main>

<?php include "../inc/pie.php"; ?>