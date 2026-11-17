<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('contenido') ?>

<?= view('partials/_form-error'); ?>


<div class="flex min-h-screen items-center justify-center bg-base-200 p-4">

  <div class="card w-full max-w-2xl bg-base-100 shadow-xl border border-base-300">
    <div class="card-body">

<div class="card card-md bg-error text-primary-content shadow-sm">
  <div class="card-body">
    <h2 class="card-title"><?= $nombre_completo_alumno ?></h2>
    <p>El(La) alumno(a) ya se encuentra registrado en este ciclo escolar, desde aquí puede acceder a los comprobantes PDF y actualización de datos de inscripción.</p>
  </div>
</div>
<br/>


<form class="space-y-6" action="<?= base_url('/pdf/ficha_inscripcion') ?>" method="post" data-parsley-validate>
<?= csrf_field() ?>
<input type='hidden' name='curp' value="<?= $curp ?>" />

<p class="mx-auto w-1/2"><input class="btn btn-success btn-wide" type="submit" value="Ficha de inscripción" /></p>

</form>

<br />

<form class="space-y-6" action="<?= base_url('/pdf/historial_medico') ?>" method="post" data-parsley-validate>
<?= csrf_field() ?>
<input type='hidden' name='curp' value="<?= $curp ?>" />

<p class="mx-auto w-1/2"><input class="btn btn-accent btn-wide" type="submit" value="Historial médico" /></p>

</form>


<br />

<form class="space-y-6" action="<?= base_url('inscripciones/edit') ?>" method="post" data-parsley-validate>
<?= csrf_field() ?>
<input type='hidden' name='id_alumno' value="<?= esc($id_alumno) ?>" />

<div class="mx-auto w-1/2"><button class="btn btn-primary btn-wide" type="submit">Actualizar datos del alumno</button></div>

</form>

</div>
</div>
</div>

<?= $this->endSection() ?>