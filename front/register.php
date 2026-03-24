<?php
include "../inc/sesion.php";
include "../inc/conectar.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario = trim($_POST["usuario"] ?? "");
    $email   = trim($_POST["email"] ?? "");
    $pass_raw = $_POST["password"] ?? "";

    // Validación de contraseña 
    $errores = [];

    if (strlen($pass_raw) < 8) {
        $errores[] = "La contraseña debe tener al menos 8 caracteres.";
    }
    if (!preg_match('/[A-Z]/', $pass_raw)) {
        $errores[] = "La contraseña debe incluir al menos una letra mayúscula.";
    }
    if (!preg_match('/[a-z]/', $pass_raw)) {
        $errores[] = "La contraseña debe incluir al menos una letra minúscula.";
    }
    if (!preg_match('/[0-9]/', $pass_raw)) {
        $errores[] = "La contraseña debe incluir al menos un número.";
    }
    if (!preg_match('/[\W_]/', $pass_raw)) {
        $errores[] = "La contraseña debe incluir al menos un carácter especial.";
    }

    if (!empty($errores)) {
        $mensaje = implode("<br>", $errores);
    } 
    else {
        // Hash seguro
        $pass = password_hash($pass_raw, PASSWORD_DEFAULT);

        // Insert en users
        $sql = "INSERT INTO users (email, password_hash)
                VALUES ('$email', '$pass')";

        if (mysqli_query($conexion, $sql)) {

            $user_id = mysqli_insert_id($conexion);

            // Insert en profiles
            $usuario_esc = mysqli_real_escape_string($conexion, $usuario);

            $sql2 = "INSERT INTO profiles (user_id, nickname)
                     VALUES ($user_id, '$usuario_esc')";
            mysqli_query($conexion, $sql2);

            $mensaje = $LANG['user_registered'] ?? 'Usuario registrado. Ahora puedes iniciar sesión.';

        } else {
            $mensaje = $LANG['email_exists'] ?? 'Error: el email ya existe.';
        }
    }
}
?>

<?php include "../inc/cabecera.php"; ?>

<main>
    <div class="form-container">

        <h2><?php echo htmlspecialchars($LANG['register_title'] ?? 'Registro de Usuario'); ?></h2>

        <?php if($mensaje): ?>  <!-- Muestra mensaje de éxito o error si existe -->
            <p style="color:#88ff88;text-align:center;margin-bottom:15px;">
                <?= htmlspecialchars($mensaje) ?>
            </p>
        <?php endif; ?>
        
        <!-- Formulario de registro: usuario, email, contraseña -->
        <form method="POST">

            <div class="form-group">
                <label for="usuario"><?php echo htmlspecialchars($LANG['hunter_name'] ?? 'Nombre del cazador'); ?></label>
                <input type="text" id="usuario" name="usuario" required>
            </div>

            <div class="form-group">
                <label for="email"><?php echo htmlspecialchars($LANG['email'] ?? 'Correo electrónico'); ?></label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password"><?php echo htmlspecialchars($LANG['password'] ?? 'Contraseña'); ?></label>
                <input type="password" id="password" name="password" required>
                <div id="password-requisitos" style="margin-top:10px;">
                <p style="color:var(--text-muted); margin-bottom:8px;"><?php echo htmlspecialchars($LANG['password_requirements_title'] ?? 'Requisitos de la contraseña:'); ?></p>
                <ul id="password-checklist" style="list-style:none; padding-left:0; font-size:0.9rem;">
                    <li id="req-length"   class="req-item">❌ <?php echo htmlspecialchars($LANG['password_req_length'] ?? 'Mínimo 8 caracteres'); ?></li>
                    <li id="req-upper"    class="req-item">❌ <?php echo htmlspecialchars($LANG['password_req_upper'] ?? 'Al menos una MAYÚSCULA'); ?></li>
                    <li id="req-lower"    class="req-item">❌ <?php echo htmlspecialchars($LANG['password_req_lower'] ?? 'Al menos una minúscula'); ?></li>
                    <li id="req-number"   class="req-item">❌ <?php echo htmlspecialchars($LANG['password_req_number'] ?? 'Al menos un número'); ?></li>
                    <li id="req-special"  class="req-item">❌ <?php echo htmlspecialchars($LANG['password_req_special'] ?? 'Al menos un símbolo especial'); ?></li>
                </ul>
</div>
        <button type="submit"><?php echo htmlspecialchars($LANG['register'] ?? 'Registrarse'); ?></button>
        </form>

        <div class="bottom-text">
            <?php echo htmlspecialchars($LANG['have_account'] ?? '¿Ya tienes cuenta?'); ?>
            <a href="../front/login.php"><?php echo htmlspecialchars($LANG['login_link'] ?? 'Inicia sesión'); ?></a>
        </div>

    </div>
</main>

<?php include "../inc/pie.php"; ?>

<script>
document.getElementById("password").addEventListener("input", function () {
    const p = this.value;
    const rules = document.getElementById("password-rules");

    const msg = {
        length: "<?php echo htmlspecialchars($LANG['password_req_length'] ?? 'Mínimo 8 caracteres'); ?>",
        upper: "<?php echo htmlspecialchars($LANG['password_req_upper'] ?? 'Al menos una MAYÚSCULA'); ?>",
        lower: "<?php echo htmlspecialchars($LANG['password_req_lower'] ?? 'Al menos una minúscula'); ?>",
        number: "<?php echo htmlspecialchars($LANG['password_req_number'] ?? 'Al menos un número'); ?>",
        special: "<?php echo htmlspecialchars($LANG['password_req_special'] ?? 'Al menos un símbolo especial'); ?>",
        strong: "<?php echo htmlspecialchars($LANG['password_strong'] ?? 'Contraseña fuerte'); ?>"
    };

    let ok = true;
    let html = "";

    if (p.length < 8) { ok = false; html += `• ${msg.length}<br>`; }
    if (!/[A-Z]/.test(p)) { ok = false; html += `• ${msg.upper}<br>`; }
    if (!/[a-z]/.test(p)) { ok = false; html += `• ${msg.lower}<br>`; }
    if (!/[0-9]/.test(p)) { ok = false; html += `• ${msg.number}<br>`; }
    if (!/[\W_]/.test(p)) { ok = false; html += `• ${msg.special}<br>`; }

    rules.innerHTML = html || `✔ ${msg.strong}`;
    rules.style.color = html ? "var(--text-muted)" : "var(--gold-bright)";
});
</script>

<script>
document.getElementById("password").addEventListener("input", function () {
    const p = this.value;

    const reqLength  = document.getElementById("req-length");
    const reqUpper   = document.getElementById("req-upper");
    const reqLower   = document.getElementById("req-lower");
    const reqNumber  = document.getElementById("req-number");
    const reqSpecial = document.getElementById("req-special");

    // Longitud
    toggle(reqLength,  p.length >= 8);

    // Mayúscula
    toggle(reqUpper,   /[A-Z]/.test(p));

    // Minúscula
    toggle(reqLower,   /[a-z]/.test(p));

    // Número
    toggle(reqNumber,  /[0-9]/.test(p));

    // Símbolo especial
    toggle(reqSpecial, /[\W_]/.test(p));
});

// Función para marcar ✔ o ❌
function toggle(element, condition) {
    if (condition) {
        element.classList.add("ok");
        element.innerHTML = "✔ " + element.innerHTML.slice(2);
    } else {
        element.classList.remove("ok");
        element.innerHTML = "❌ " + element.innerHTML.slice(2);
    }
}
</script>