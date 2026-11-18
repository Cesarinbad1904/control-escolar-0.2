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


<form class="space-y-6" action="<?= base_url('/pdf/ficha_inscripcion') ?>" method="post" >
  <?= csrf_field() ?>
  <input type="hidden" name="curp" value="<?= $curp ?>" />

  <div class="flex justify-center">
    <button type="submit" class="btn btn-accent btn-wide">
      <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
      </svg>
      Descargar ficha de inscripción
    </button>
  </div>
</form>

<br />

<form class="space-y-6" action="<?= base_url('/pdf/historial_medico') ?>" method="post" >
  <?= csrf_field() ?>
  <input type="hidden" name="curp" value="<?= $curp ?>" />

  <div class="flex justify-center">
    <button type="submit" class="btn btn-success btn-wide">
      <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
      </svg>
      Descargar historial médico
    </button>
  </div>
</form>


<br />

<form class="space-y-6" action="<?= base_url('inscripciones/edit') ?>" method="post" >
  <?= csrf_field() ?>
  <input type="hidden" name="id_alumno" value="<?= esc($id_alumno) ?>" />

  <div class="flex justify-center">
    <button class="btn btn-primary btn-wide" type="submit">
      <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
      </svg>
      Actualizar datos del alumno
    </button>
  </div>
</form>

</div>
</div>
</div>

<?= $this->endSection() ?>