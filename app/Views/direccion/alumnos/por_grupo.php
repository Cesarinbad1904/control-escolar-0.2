<?= $this->extend('layouts/main') ?>

<?= $this->section('contenido') ?>

<!-- Tarjeta de Filtros de Búsqueda -->
<div class="card bg-base-100 shadow-sm border border-base-200 mb-6 print:hidden">
    <div class="card-body p-5">
        <h2 class="card-title text-base mb-2">Filtros de Búsqueda</h2>
        
        <form method="get" action="<?= site_url('direccion/alumnos/por-grupo') ?>" class="flex flex-col sm:flex-row gap-4 items-stretch sm:items-end">
            
            <!-- Selector de Grado -->
            <div class="form-control w-full sm:w-48">
                <label class="label py-1"><span class="label-text text-xs font-semibold">Grado</span></label>
                <select name="grado" class="select select-bordered select-sm" required>
                    <option value="" disabled <?= empty($gradoSeleccionado) ? 'selected' : '' ?>>Selecciona grado...</option>
                    <?php if (!empty($gradosDisponibles)): ?>
                        <?php foreach ($gradosDisponibles as $g): ?>
                            <option value="<?= esc($g->grado) ?>" <?= $gradoSeleccionado === $g->grado ? 'selected' : '' ?>>
                                <?= esc($g->grado) ?>° Grado
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php foreach (['1', '2', '3', '4', '5', '6'] as $g): ?>
                            <option value="<?= $g ?>" <?= $gradoSeleccionado === $g ? 'selected' : '' ?>><?= $g ?>° Grado</option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <!-- Selector de Grupo -->
            <div class="form-control w-full sm:w-48">
                <label class="label py-1"><span class="label-text text-xs font-semibold">Grupo</span></label>
                <select name="grupo" class="select select-bordered select-sm" required>
                    <option value="" disabled <?= empty($grupoSeleccionado) ? 'selected' : '' ?>>Selecciona grupo...</option>
                    <?php if (!empty($gruposDisponibles)): ?>
                        <?php foreach ($gruposDisponibles as $grp): ?>
                            <option value="<?= esc($grp->grupo) ?>" <?= $grupoSeleccionado === $grp->grupo ? 'selected' : '' ?>>
                                Grupo <?= esc($grp->grupo) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="A">Grupo A</option>
                    <?php endif; ?>
                </select>
            </div>

            <!-- Botones -->
            <div class="flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm gap-2">
                    <svg xmlns="http://w3.org" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" /></svg>
                    Consultar Grupo
                </button>

                <?php if (!empty($alumnos)): ?>
                    <button type="button" onclick="window.print()" class="btn btn-outline btn-sm gap-1">
                        🖨️ Imprimir Lista
                    </button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<?php if (!empty($gradoSeleccionado) && !empty($grupoSeleccionado)): ?>

    <!-- Resumen Estadístico del Grupo -->
    <div class="card bg-base-100 shadow-sm border border-base-200 mb-6">
        <div class="card-body p-4 sm:p-5 flex flex-col sm:flex-row justify-between sm:items-center gap-3">
            <div>
                <h3 class="font-bold text-base text-base-content">
                    Lista Oficial: <span class="text-primary"><?= esc($gradoSeleccionado) ?>° Grado · Grupo "<?= esc($grupoSeleccionado) ?>"</span>
                </h3>
                <p class="text-xs text-base-content/60">Alumnos vigentes ordenados alfabéticamente por apellido</p>
            </div>

            <div class="flex flex-wrap gap-2 text-xs font-semibold">
                <span class="badge badge-neutral badge-md">Total: <?= esc($resumen['total']) ?> Alumnos</span>
                <span class="badge badge-info badge-outline badge-md">Hombres: <?= esc($resumen['hombres']) ?></span>
                <span class="badge badge-secondary badge-outline badge-md">Mujeres: <?= esc($resumen['mujeres']) ?></span>
            </div>
        </div>
    </div>

    <!-- Tabla de Alumnos del Grupo -->
    <div class="card bg-base-100 shadow-sm border border-base-200">
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table table-zebra table-sm">
                    <thead class="bg-base-200/80 text-base-content text-xs uppercase">
                        <tr>
                            <th class="w-12 text-center">#</th>
                            <th>Nombre Completo (Apellidos, Nombre)</th>
                            <th>CURP</th>
                            <th class="text-center">Sexo</th>
                            <th class="text-center">Edad</th>
                            <th class="text-center print:hidden">Expediente</th>
                            <!-- Espacio preparado para futuras columnas de documentos -->
                            <th class="text-center print:hidden">Ficha de inscripción</th>
                            <th class="text-center print:hidden">Historial Médico</th>
                            <th class="text-center print:hidden">Hermanos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($alumnos)): ?>
                            <?php $numLista = 1; ?>
                            <?php foreach ($alumnos as $alumno): ?>
                                <?php
                                    // Formato oficial de lista escolar: Primer Apellido Segundo Apellido, Nombre
                                    $nombreLista = "{$alumno->primer_apellido_alumno} {$alumno->segundo_apellido_alumno}, {$alumno->nombre_alumno}";
                                    
                                  // Calcular edad del alumno
                                    helper('funciones');
                                   
                                    $datos_curp_alumno = datosCurp($alumno->curp);
                                    $fecha_nac_alumno  = $datos_curp_alumno['fecha_nacimiento'];
                                    $fecha_comparacion = $escuela->fecha_referencia;
                                    $edad_alumno       = calculaEdad($fecha_nac_alumno, $fecha_comparacion);
                                    
                                ?>
                                <tr class="hover">
                                    <td class="text-center font-bold text-base-content/70 tabular-nums"><?= $numLista++ ?></td>
                                    <td class="font-semibold text-sm"><?= esc($nombreLista) ?></td>
                                    <td class="font-mono text-xs"><?= esc($alumno->curp) ?></td>
                                    <td class="text-center">
                                        <?php if ($alumno->sexo_alumno === 'HOMBRE'): ?>
                                            <span class="badge badge-info badge-soft badge-xs font-bold text-info">HOMBRE</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary badge-soft badge-xs font-bold text-secondary">MUJER</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="font-mono text-center text-xs"><?= $edad_alumno['anios'] ?></td>

                                    <!-- Enlace al Expediente Completo -->
                                    <td class="text-center print:hidden">
                                        <a href="<?= site_url('direccion/alumnos/ver/' . $alumno->id_alumno) ?>"
                                           class="btn btn-xs btn-outline btn-primary">
                                            Ver Expediente
                                        </a>
                                    </td>

                                    <!-- Columna Ficha de inscripción -->
                                    <td class="text-center print:hidden">
                                        <a href="<?= site_url('pdf/ficha_inscripcion/' . $alumno->curp) ?>"
                                        class="btn btn-xs btn-outline btn-success gap-1"
                                        title="Descargar Ficha de Inscripción en PDF">
                                            📄 Ficha de Inscripción
                                        </a>
                                    </td>

                                    <!-- Nueva Columna: Historial Médico PDF -->
                                    <td class="text-center print:hidden">
                                        <a href="<?= site_url('pdf/historial_medico/' . $alumno->curp) ?>"
                                        class="btn btn-xs btn-outline btn-error gap-1"
                                        title="Descargar Historial Médico en PDF">
                                            🩺 H. Médico
                                        </a>
                                    </td>


<!-- Nueva Columna: Hermanos por Tutor Principal -->
                                    <td class="text-center print:hidden">
                                        <?php $totalHermanos = count($alumno->hermanos ?? []); ?>
                                        <?php if ($totalHermanos > 0): ?>
                                            <button type="button"
                                                    onclick="abrirModalHermanos(this)"
                                                    data-alumno="<?= esc("{$alumno->nombre_alumno} {$alumno->primer_apellido_alumno} {$alumno->segundo_apellido_alumno}") ?>"
                                                    data-tutor="<?= esc(trim("{$alumno->nombre_tutor} {$alumno->primer_apellido_tutor}")) ?>"
                                                    data-hermanos="<?= esc(json_encode($alumno->hermanos)) ?>"
                                                    class="btn btn-xs btn-outline btn-info gap-1">
                                                👨‍👩‍👧‍👦 Hermanos (<?= $totalHermanos ?>)
                                            </button>
                                        <?php else: ?>
                                            <span class="text-xs text-base-content/40">—</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center py-8 text-base-content/60">
                                    No hay alumnos activos inscritos en <strong><?= esc($gradoSeleccionado) ?>° <?= esc($grupoSeleccionado) ?></strong>.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php else: ?>

    <!-- Estado inicial antes de seleccionar grado y grupo -->
    <div class="card bg-base-100 shadow-sm border border-base-200">
        <div class="card-body py-12 text-center">
            <div class="text-4xl mb-2">📋</div>
            <h3 class="font-bold text-base text-base-content">Selecciona un Grado y Grupo</h3>
            <p class="text-xs text-base-content/60 max-w-md mx-auto">
                Elige el grado y grupo en los filtros superiores y presiona <strong>Consultar Grupo</strong> para generar la lista de alumnos vigentes.
            </p>
        </div>
    </div>

<?php endif; ?>

<!-- Modal de Hermanos Registrados -->
<dialog id="modal_hermanos" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        
        <h3 class="font-bold text-lg text-base-content flex items-center gap-2">
            👨‍👩‍👧‍👦 Hermanos Inscritos en el Plantel
        </h3>
        
        <div class="bg-base-200/70 rounded-lg p-3 my-3 text-xs space-y-1 border border-base-300">
            <div><span class="font-semibold">Alumno consultado:</span> <span id="hm_alumno" class="font-bold"></span></div>
            <div><span class="font-semibold">Tutor en común:</span> <span id="hm_tutor"></span></div>
        </div>

        <div class="overflow-x-auto border border-base-200 rounded-lg">
            <table class="table table-zebra table-sm">
                <thead class="bg-base-200 text-xs uppercase">
                    <tr>
                        <th>Nombre del Hermano(a)</th>
                        <th class="text-center">Grado</th>
                        <th class="text-center">Grupo</th>
                    </tr>
                </thead>
                <tbody id="hm_lista_body" class="text-xs sm:text-sm">
                    <!-- Se llena dinámicamente al abrir el modal -->
                </tbody>
            </table>
        </div>

        <div class="modal-action">
            <button type="button" onclick="document.getElementById('modal_hermanos').close()" class="btn btn-primary btn-sm">Cerrar</button>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>cerrar</button>
    </form>
</dialog>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function abrirModalHermanos(btn) {
    document.getElementById('hm_alumno').textContent = btn.dataset.alumno;
    document.getElementById('hm_tutor').textContent  = btn.dataset.tutor || 'Mismo tutor principal';

    const hermanos = JSON.parse(btn.dataset.hermanos || '[]');
    const tbody = document.getElementById('hm_lista_body');
    tbody.innerHTML = '';

    hermanos.forEach(h => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="font-semibold">${h.nombre}</td>
            <td class="text-center"><span class="badge badge-ghost badge-sm font-bold">${h.grado}°</span></td>
            <td class="text-center"><span class="badge badge-info badge-outline badge-sm font-bold">${h.grupo}</span></td>
        `;
        tbody.appendChild(tr);
    });

    document.getElementById('modal_hermanos').showModal();
}
</script>
<?= $this->endSection() ?>


 