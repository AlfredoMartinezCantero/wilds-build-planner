<?php include "../inc/cabecera.php"; ?>
<link rel="stylesheet" href="../front/css/estilo.css">

<main>
    <section class="panel-admin">
        <h1>Panel de Administración</h1>
        <p class="subtexto">
            Bienvenido al panel donde podrás gestionar usuarios, revisar builds 
            y controlar el estado general del sistema.
        </p>

        <div class="admin-grid">

            <a href="dashboard.php" class="admin-card">
                <h3>📊 Dashboard</h3>
                <p>Vista general del estado del sistema.</p>
            </a>

            <a href="gestionar_usuarios.php" class="admin-card">
                <h3>👥 Usuarios</h3>
                <p>Listado, edición y eliminación de usuarios.</p>
            </a>

            <a href="moderar_builds.php" class="admin-card">
                <h3>🛠 Moderar Builds</h3>
                <p>Gestiona builds públicas o reportadas por usuarios.</p>
            </a>

        </div>
    </section>
</main>

<?php include "../inc/pie.php"; ?>