<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../inc/sesion.php";
require_once __DIR__ . "/../inc/conectar.php";

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$user_id  = (int)$_SESSION['id_usuario'];
$build_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($build_id <= 0) {
    die("Build no válida.");
}

// Solo permite editar builds del propio usuario
$sql = "SELECT id, titulo, notas, es_publica 
        FROM builds 
        WHERE id = $build_id AND user_id = $user_id";

$res = $conexion->query($sql);
if (!$res) {
    die("ERROR SQL en editar_build: " . $conexion->error);
}

$build = $res->fetch_assoc();
if (!$build) {
    die("No tienes permiso para editar esta build o no existe.");
}

include __DIR__ . "/../inc/cabecera.php";
?>

<main>
    <div class="form-container">
        <h2>Editar Build</h2>

        <form action="../back/php/save_build.php" method="POST">
            <input type="hidden" name="build_id" value="<?= $build['id'] ?>">

            <div class="form-group">
                <label>Título de la build</label>
                <input type="text" name="titulo" value="<?= htmlspecialchars($build['titulo']); ?>">
            </div>

            <div class="form-group">
                <label>Notas</label>
                <textarea name="notas" rows="4"><?= htmlspecialchars($build['notas']); ?></textarea>
            </div>

            <div class="form-group">
                <label class="checkbox-publica">
                    <input type="checkbox" name="es_publica" value="1"
                           <?= $build['es_publica'] ? 'checked' : '' ?>>
                    Hacer pública esta build
                </label>
            </div>

            <button type="submit" class="btn-guardar-build">Guardar cambios</button>
        </form>

        <div class="bottom-text">
            <a href="mis_builds.php">Volver a Mis Builds</a>
        </div>
    </div>
</main>

<?php include __DIR__ . "/../inc/pie.php"; ?>