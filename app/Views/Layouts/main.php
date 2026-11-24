<!DOCTYPE html>
<html lang="es" data-theme="corporate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($titulo ?? 'Control Escolar') ?></title>

    <!-- Enlace al archivo css compilado en public/assets/css/app.css -->
    <link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet">

<!-- Agregar Parsley JS -->
<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/parsley.min.js') ?>"></script>
<script src="<?= base_url('assets/js/i18n/es.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/js/parsley.css') ?>"> 

<script>
    window.Parsley.setLocale('es');
</script>

<script>
// Validador Parsley para campos de teléfono y CURP repetidos
    window.Parsley.addValidator('notequalto', {
        requirementType: 'string',
        validateString: function (value, requirement) {
            // Compara el valor actual con el valor del campo objetivo por su ID
            return value !== $(requirement).val();
        },
        messages: {
            es: 'El número debe ser diferente al número anterior.',
         }
    });
</script>

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
