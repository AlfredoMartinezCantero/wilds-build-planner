<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../inc/sesion.php";
require_once __DIR__ . "/../inc/conectar.php";

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$user_id = (int)$_SESSION['id_usuario'];

// Cargar perfil
$sql = "SELECT nickname, hunter_rank, prefs_json 
        FROM profiles 
        WHERE user_id = $user_id";
$res = $conexion->query($sql);

$profile = $res->fetch_assoc() ?: [
    'nickname' => '',
    'hunter_rank' => 1,
    'prefs_json' => '{}'
];

// Evitar warnings (NULL → cadena vacía)
$nickname = $profile['nickname'] ?? '';
$hunter_rank = $profile['hunter_rank'] ?? 1;
$prefs = $profile['prefs_json'] ?? '{}';

include __DIR__ . "/../inc/cabecera.php";
?>

<main>
    <div class="form-container" style="max-width:500px; margin:auto;">
        <h2 style="text-align:center; margin-bottom:20px; color:var(--gold);">
            Editar Perfil
        </h2>

        <form action="../back/php/save_profile.php" method="POST">

            <div class="form-group">
                <label>Nickname</label>
                <input type="text" name="nickname" value="<?= htmlspecialchars($nickname) ?>">
            </div>

            <div class="form-group">
                <label>Hunter Rank</label>
                <input type="number" name="hunter_rank"
                       value="<?= htmlspecialchars($hunter_rank) ?>">
            </div>

            <div class="form-group">
                <label>Preferencias (JSON)</label>
                <textarea name="prefs_json" rows="5"><?= htmlspecialchars($prefs) ?></textarea>
            </div>

            <button type="submit" class="btn-guardar-build">Guardar cambios</button>
        </form>

        <div class="bottom-text">
            <a href="perfil.php">Volver al perfil</a>
        </div>
    </div>
</main>

<?php include __DIR__ . "/../inc/pie.php"; ?>