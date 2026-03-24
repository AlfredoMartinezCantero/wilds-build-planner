<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../inc/sesion.php';
require_once __DIR__ . '/../inc/conectar.php';

// Solo administradores
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    die(htmlspecialchars($LANG['admin_access_denied'] ?? 'Acceso denegado.'));
}

$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($user_id <= 0) {
    die(htmlspecialchars($LANG['admin_no_valid_id'] ?? 'ID de usuario inválido.'));
}

// Cargar usuario
$sqlUser = "SELECT * FROM users WHERE id=$user_id";
$resUser = $conexion->query($sqlUser);
if (!$resUser || $resUser->num_rows === 0) {
    die(htmlspecialchars($LANG['admin_user_not_found'] ?? 'Usuario no encontrado.'));
}
$user = $resUser->fetch_assoc();

// Cargar perfil (tabla profiles)
$sqlProfile = "SELECT * FROM profiles WHERE user_id=$user_id";
$resProfile = $conexion->query($sqlProfile);

if ($resProfile->num_rows === 0) {
    // Crear perfil vacío si no existe
    $conexion->query("INSERT INTO profiles (user_id) VALUES ($user_id)");
    $profile = ['nickname' => '', 'hunter_rank' => 1, 'prefs_json' => '{}'];
} else {
    $profile = $resProfile->fetch_assoc();
}

include __DIR__ . '/../inc/cabecera.php';
?>

<main class="panel-admin" style="max-width:600px; margin:auto;">
    <h1 style="color:var(--gold); text-align:center;"><?php echo htmlspecialchars($LANG['admin_edit_title'] ?? 'Editar Usuario'); ?></h1>

    <form action="../back/php/admin_actions.php" method="POST" 
          style="background:var(--bg-panel); padding:20px; border-radius:12px;
                 box-shadow:0 4px 12px var(--shadow); border:1px solid var(--border);">

        <input type="hidden" name="action" value="update_user">
        <input type="hidden" name="id" value="<?= $user_id ?>">

        <h3 style="color:var(--gold-bright);"><?php echo htmlspecialchars($LANG['admin_account_data'] ?? 'Datos de cuenta'); ?></h3>

        <label><?php echo htmlspecialchars($LANG['email'] ?? 'Email'); ?></label>
        <input style="width:100%; padding:10px; margin-bottom:10px;" 
               type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>">

        <label><?php echo htmlspecialchars($LANG['role'] ?? 'Rol'); ?></label>
        <select name="role" style="width:100%; padding:10px; margin-bottom:15px;">
            <option value="user"   <?= $user['role'] === 'user' ? 'selected' : '' ?>><?php echo htmlspecialchars($LANG['account'] ?? 'Usuario'); ?></option>
            <option value="editor" <?= $user['role'] === 'editor' ? 'selected' : '' ?>>Editor</option>
            <option value="admin"  <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
        </select>

        <hr style="margin:20px 0; border-color:var(--border);">

        <h3 style="color:var(--gold-bright);"><?php echo htmlspecialchars($LANG['admin_player_profile'] ?? 'Perfil del jugador'); ?></h3>

        <label><?php echo htmlspecialchars($LANG['nickname'] ?? 'Nickname'); ?></label>
        <input style="width:100%; padding:10px; margin-bottom:10px;"
               type="text" name="nickname" value="<?= htmlspecialchars($profile['nickname']); ?>">

        <label><?php echo htmlspecialchars($LANG['hunter_rank'] ?? 'Hunter Rank'); ?></label>
        <input style="width:100%; padding:10px; margin-bottom:10px;"
               type="number" name="hunter_rank" value="<?= (int)$profile['hunter_rank']; ?>">

        <label><?php echo htmlspecialchars($LANG['admin_preferences'] ?? 'Preferencias (JSON)'); ?></label>
        <textarea name="prefs_json" rows="5" style="width:100%; padding:10px;">
<?= htmlspecialchars($profile['prefs_json']); ?>
        </textarea>

        <button type="submit" class="btn-mh" 
                style="margin-top:20px; width:100%; text-align:center;">
            <?php echo htmlspecialchars($LANG['save_changes'] ?? 'Guardar cambios'); ?>
        </button>
    </form>

    <div style="text-align:center; margin-top:15px;">
        <a href="gestionar_usuarios.php"><?php echo htmlspecialchars($LANG['admin_back_users'] ?? 'Volver a la gestión de usuarios'); ?></a>
    </div>

</main>

<?php include __DIR__ . '/../inc/pie.php'; ?>