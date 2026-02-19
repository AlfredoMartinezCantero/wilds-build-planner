<?php
include "../inc/cabecera.php";
?>
<link rel="stylesheet" href="../front/css/estilo.css">

<main>
    <section class="panel-admin">
        <h1>Panel de Administración</h1>
        <p class="subtexto">Gestiona usuarios, revisa builds y controla el estado del sistema.</p>

        <div class="admin-grid">
            admin/gestionar_usuarios.php" class="admin-card">
                <h3>👤 Usuarios</h3>
                <p>Ver, editar y eliminar usuarios registrados.</p>
            </a>

            admin/moderar_builds.php" class="admin-card">
                <h3>🛠 Builds</h3>
                <p>Moderar builds públicas o reportadas.</p>
            </a>

            back/php/admin_actions.php?action=sync" class="admin-card">
                <h3>🔄 Sincronización</h3>
                <p>Actualizar catálogo desde la API externa.</p>
            </a>
        </div>
    </section>
</main>

<?php include "../inc/pie.php"; ?>