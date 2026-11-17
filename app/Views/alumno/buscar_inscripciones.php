<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('contenido') ?>

<?= view('partials/_form-error'); ?>


<div class="flex min-h-screen items-center justify-center bg-base-200 p-4">
  
  <div class="card w-full max-w-2xl bg-base-100 shadow-xl border border-base-300">
    <div class="card-body">

    <div role="alert" class="alert alert-success">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>Capture los 18 caracteres de la CURP del alumno tal como figuran en su constancia oficial (sin espacios).</span>
</div>

<form class="space-y-6" action="<?= base_url('inscripciones/buscar_inscrito') ?>" method="post" data-parsley-validate>
  <?= csrf_field() ?> 
  
  <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-md border p-4">
    <legend class="fieldset-legend" style="color: darkolivegreen;">DIGITE LA CURP DEL ALUMNO:</legend>

   
<div class="form-control" style="margin-bottom: 10px;">
    <input class="input input-neutral" type="text" id="curp" name="curp" autofocus
    required 
    pattern="/^[A-Z]{1}[XAEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/i"
    data-parsley-pattern-message="Formato de CURP inválido." 
    data-parsley-trigger="keyup" />
  </div>

</fieldset>

<p class="mx-auto w-1/2"><input class="btn btn-success btn-wide" type="submit" value="Enviar" /></p>

</form>

</div>
</div>
</div>

<?= $this->endSection() ?>