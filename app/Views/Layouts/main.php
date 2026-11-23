<!DOCTYPE html>
<html lang="es" data-theme="corporate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($titulo ?? 'Control Escolar') ?></title>

    <!-- Enlace al archivo css compilado en public/assets/css/app.css -->
    <link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet">

</head>
<body class="bg-base-200 min-h-screen">
   
<div class="drawer lg:drawer-open">
        <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />
        
        <!-- Contenido Principal -->
        <div class="drawer-content flex flex-col">
            <!-- Barra Superior Reutilizable -->
            <?= $this->include('partials/navbar') ?>

            <!-- Área Dinámica de cada Vista -->
            <main class="p-6 flex-1">
                <?= $this->renderSection('contenido') ?>
            </main>
        </div>

        <!-- Menú Lateral Reutilizable -->
        <?= $this->include('partials/sidebar') ?>
    </div>

    <?= $this->renderSection('scripts') ?>
</body>
</html>
