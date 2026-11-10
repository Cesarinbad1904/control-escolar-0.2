<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control escolar</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">

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
<body>

<section>
    <?= $this->renderSection('contenido') ?>
</section>

</body>
</html>