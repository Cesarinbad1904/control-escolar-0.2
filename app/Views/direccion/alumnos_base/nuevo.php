<?= $this->extend('layouts/main') ?>

<?= $this->section('contenido') ?>
<div class="container mx-auto px-4 py-8 max-w-3xl">

    <!-- Alertas de Éxito o Errores de Validación -->
    <?php if (session()->getFlashdata('success')): ?>
        <div role="alert" class="alert alert-success shadow-md mb-6">
            <svg xmlns="http://w3.org" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span><?= esc(session()->getFlashdata('success')) ?></span>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div role="alert" class="alert alert-error shadow-md mb-6">
            <svg xmlns="http://w3.org" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <h3 class="font-bold">Por favor corrige los siguientes errores:</h3>
                <ul class="list-disc list-inside text-sm mt-1">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <!-- Tarjeta Principal del Formulario -->
    <div class="card bg-base-100 shadow-xl border border-base-200">
        <div class="card-body p-6 sm:p-8">
            
            <!-- Encabezado -->
            <div class="flex items-center gap-3 border-b border-base-200 pb-4 mb-6">
                <div class="p-3 bg-primary/10 text-primary rounded-xl">
                    <svg xmlns="http://w3.org" class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-base-content">Nuevo Alumno</h1>
                    <p class="text-sm text-base-content/60">Autorización en padrón base para registro de tutores</p>
                </div>
            </div>

            <form action="<?= base_url('direccion/alumnos-base/guardar') ?>" method="post" class="space-y-6" data-parsley-validate>
                <?= csrf_field() ?>

                <!-- Sección 1: CURP -->
                <div class="form-control w-full sm:w-2/3">
                    <label class="label" for="curp">
                        <span class="label-text font-semibold text-base-content">
                            <span class="text-error">*</span> CURP DEL ALUMNO:
                        </span>
                    </label>
                    <input 
                        type="text" 
                        id="curp" 
                        name="curp" 
                        maxlength="18"
                        value="<?= old('curp') ?>"
                        placeholder="INGRESA LOS 18 CARACTERES"
                        class="input input-bordered font-mono uppercase tracking-wider w-full focus:input-primary"
                        autofocus
                        required 
                        pattern="/^[A-Z]{1}[XAEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/i"
                        data-parsley-pattern-message="Formato de CURP inválido." 
                        data-parsley-trigger="keyup"
                    />
                </div>

                <div class="divider my-2"></div>

                <!-- Sección 2: Nombre separado en 3 campos -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="form-control">
                        <label class="label" for="primer_apellido">
                            <span class="label-text font-semibold"><span class="text-error">*</span> PRIMER APELLIDO</span>
                        </label>
                        <input 
                            type="text" 
                            id="primer_apellido" 
                            name="primer_apellido" 
                            maxlength="25"
                            value="<?= old('primer_apellido') ?>"
                            placeholder="APELLIDO PATERNO"
                            class="input input-bordered uppercase w-full focus:input-primary"
                            required
                        />
                    </div>

                    <div class="form-control">
                        <label class="label" for="segundo_apellido">
                            <span class="label-text font-semibold">SEGUNDO APELLIDO</span>
                        </label>
                        <input 
                            type="text" 
                            id="segundo_apellido" 
                            name="segundo_apellido" 
                            maxlength="25"
                            value="<?= old('segundo_apellido') ?>"
                            placeholder="APELLIDO MATERNO"
                            class="input input-bordered uppercase w-full focus:input-primary"
                            required
                        />
                    </div>

                    <div class="form-control">
                        <label class="label" for="nombres">
                            <span class="label-text font-semibold"><span class="text-error">*</span> NOMBRE(S)</span>
                        </label>
                        <input 
                            type="text" 
                            id="nombres" 
                            name="nombres" 
                            maxlength="25"
                            value="<?= old('nombres') ?>"
                            placeholder="NOMBRE(S)"
                            class="input input-bordered uppercase w-full focus:input-primary"
                            required
                        />
                    </div>
                </div>

                <!-- Sección 3: Grado, Grupo y Origen -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="form-control">
                        <label class="label" for="grado">
                            <span class="label-text font-semibold"><span class="text-error">*</span> GRADO QUE CURSARÁ</span>
                        </label>
                        <select id="grado" name="grado" class="select select-bordered w-full focus:select-primary" required>
                            <option value="" disabled <?= old('grado') ? '' : 'selected' ?>>Selecciona grado...</option>
                            <option value="1" <?= old('grado') === '1' ? 'selected' : '' ?>>1° Grado</option>
                            <option value="2" <?= old('grado') === '2' ? 'selected' : '' ?>>2° Grado</option>
                            <option value="3" <?= old('grado') === '3' ? 'selected' : '' ?>>3° Grado</option>
                            <option value="4" <?= old('grado') === '4' ? 'selected' : '' ?>>4° Grado</option>
                            <option value="5" <?= old('grado') === '5' ? 'selected' : '' ?>>5° Grado</option>
                            <option value="6" <?= old('grado') === '6' ? 'selected' : '' ?>>6° Grado</option>
                        </select>
                    </div>

                    <div class="form-control">
                        <label class="label" for="grupo">
                            <span class="label-text font-semibold">GRUPO (OPCIONAL)</span>
                        </label>
                        <select id="grupo" name="grupo" class="select select-bordered w-full focus:select-primary">
                            <option value="" <?= old('grupo') === '' ? 'selected' : '' ?>>Sin asignar</option>
                            <option value="A" <?= old('grupo') === 'A' ? 'selected' : '' ?>>Grupo A</option>
                            <option value="B" <?= old('grupo') === 'B' ? 'selected' : '' ?>>Grupo B</option>
                            <option value="C" <?= old('grupo') === 'C' ? 'selected' : '' ?>>Grupo C</option>
                            <option value="D" <?= old('grupo') === 'D' ? 'selected' : '' ?>>Grupo D</option>
                            <option value="E" <?= old('grupo') === 'E' ? 'selected' : '' ?>>Grupo E</option>
                            <option value="F" <?= old('grupo') === 'F' ? 'selected' : '' ?>>Grupo F</option>
                        </select>
                    </div>

                    <div class="form-control">
                        <label class="label" for="origen">
                            <span class="label-text font-semibold"><span class="text-error">*</span> ORIGEN</span>
                        </label>
                        <select id="origen" name="origen" class="select select-bordered w-full focus:select-primary" required>
                            <option value="ME" <?= old('origen', 'ME') === 'ME' ? 'selected' : '' ?>>Misma Escuela (ME)</option>
                            <option value="SA" <?= old('origen') === 'SA' ? 'selected' : '' ?>>SAID (SA)</option>
                            <option value="NI" <?= old('origen') === 'NI' ? 'selected' : '' ?>>Nuevo Ingreso (NI)</option>
                        </select>
                    </div>
                </div>

                <!-- Sección 4: Movimiento Inicial y Fecha de Alta condicional -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end bg-base-200/50 p-4 rounded-xl border border-base-200">
                    <div class="form-control">
                        <label class="label" for="mov_i">
                            <span class="label-text font-semibold"><span class="text-error">*</span> MOVIMIENTO INICIAL:</span>
                        </label>
                        <select id="mov_i" name="mov_i" class="select select-bordered w-full focus:select-primary" required>
                            <option value="I" <?= old('mov_i', 'I') === 'I' ? 'selected' : '' ?>>INSCRIPCIÓN (Inicio de ciclo)</option>
                            <option value="A" <?= old('mov_i') === 'A' ? 'selected' : '' ?>>ALTA (Ingreso extemporáneo)</option>
                        </select>
                    </div>

                    <div id="contenedor_fecha_alta" class="form-control <?= old('mov_i') === 'A' ? '' : 'hidden' ?>">
                        <label class="label" for="fecha_alta">
                            <span class="label-text font-semibold text-primary">
                                <span class="text-error">*</span> FECHA DE ALTA:
                            </span>
                        </label>
                        <input 
                            type="date" 
                            id="fecha_alta" 
                            name="fecha_alta" 
                            value="<?= old('fecha_alta', date('Y-m-d')) ?>"
                            class="input input-bordered w-full focus:input-primary"
                        />
                    </div>
                </div>

                <!-- Botón de envío -->
                <div class="card-actions justify-end pt-4 border-t border-base-200">
                    <a href="<?= base_url('direccion/panel') ?>" class="btn btn-ghost">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-success text-white px-8 gap-2">
                        <svg xmlns="http://w3.org" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        INGRESAR
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Script para mostrar/ocultar Fecha de Alta según el movimiento -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectMovimiento = document.getElementById('mov_i');
    const contenedorFecha = document.getElementById('contenedor_fecha_alta');
    const inputFecha = document.getElementById('fecha_alta');

    function toggleFechaAlta() {
        if (selectMovimiento.value === 'A') {
            contenedorFecha.classList.remove('hidden');
            inputFecha.setAttribute('required', 'required');
        } else {
            contenedorFecha.classList.add('hidden');
            inputFecha.removeAttribute('required');
        }
    }

    selectMovimiento.addEventListener('change', toggleFechaAlta);
    toggleFechaAlta(); // Ejecutar al cargar por si hubo error de validación y regresó con old('mov_i') === 'A'
});
</script>
<?= $this->endSection() ?>
