<?php if (session()->getFlashdata('mensaje')) : ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('mensaje'); ?>
    </div>
<?php endif; ?>

