<?= $this->extend('layouts/main') ?>

<?= $this->section('contenido') ?>

<!-- Alertas Flash de Confirmación o Error -->
<?php if (session()->getFlashdata('success')): ?>
    <div role="alert" class="alert alert-success mb-4 shadow-sm">
        <svg xmlns="http://w3.org" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span><?= esc(session()->getFlashdata('success')) ?></span>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div role="alert" class="alert alert-error mb-4 shadow-sm">
        <svg xmlns="http://w3.org" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span><?= esc(session()->getFlashdata('error')) ?></span>
    </div>
<?php endif; ?>

<!-- Barra Superior de Búsqueda y Filtros -->
<div class="card bg-base-100 shadow-sm border border-base-200 mb-6">
    <div class="card-body p-4 sm:p-5">
        <form method="get" action="<?= site_url('direccion/alumnos') ?>" class="flex flex-col lg:flex-row gap-3 items-stretch lg:items-end">
            
            <!-- Buscador por CURP o Nombre -->
            <div class="form-control flex-1">
                <label class="label py-1"><span class="label-text text-xs font-semibold">Buscar Alumno</span></label>
                <label class="input input-bordered input-sm flex items-center gap-2">
                    <svg xmlns="http://w3.org" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70"><path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" /></svg>
                    <input type="text" name="q" value="<?= esc($filtros['q']) ?>" class="grow" placeholder="Buscar por CURP, nombre o apellidos..." />
                </label>
            </div>

            <!-- Filtro Grado -->
            <div class="form-control w-full lg:w-32">
                <label class="label py-1"><span class="label-text text-xs font-semibold">Grado</span></label>
                <select name="grado" class="select select-bordered select-sm">
                    <option value="">Todos</option>
                    <?php foreach (['1', '2', '3', '4', '5', '6'] as $g): ?>
                        <option value="<?= $g ?>" <?= $filtros['grado'] === $g ? 'selected' : '' ?>><?= $g ?>° Grado</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Filtro Grupo -->
            <div class="form-control w-full lg:w-32">
                <label class="label py-1"><span class="label-text text-xs font-semibold">Grupo</span></label>
                <select name="grupo" class="select select-bordered select-sm">
                    <option value="">Todos</option>
                    <?php foreach ($gruposDisponibles as $grp): ?>
                        <option value="<?= esc($grp->grupo) ?>" <?= $filtros['grupo'] === $grp->grupo ? 'selected' : '' ?>>
                            Grupo <?= esc($grp->grupo) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Filtro Estatus -->
            <div class="form-control w-full lg:w-36">
                <label class="label py-1"><span class="label-text text-xs font-semibold">Estatus</span></label>
                <select name="estatus" class="select select-bordered select-sm">
                    <option value="" <?= empty($filtros['estatus']) ? 'selected' : '' ?>>Todos</option>
                    <option value="activos" <?= $filtros['estatus'] === 'activos' ? 'selected' : '' ?>>Solo Activos</option>
                    <option value="bajas" <?= $filtros['estatus'] === 'bajas' ? 'selected' : '' ?>>Solo Bajas</option>
                </select>
            </div>

            <!-- Botones de Acción -->
            <div class="flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
                <?php if (!empty($filtros['q']) || !empty($filtros['grado']) || !empty($filtros['grupo']) || !empty($filtros['estatus'])): ?>
                    <a href="<?= site_url('direccion/alumnos') ?>" class="btn btn-ghost btn-sm">Limpiar</a>
                <?php endif; ?>
                <a href="<?= site_url('inscripciones') ?>" class="btn btn-success btn-sm text-white">+ Nueva Inscripción</a>
            </div>
        </form>
    </div>
</div>

<!-- Tabla Principal de Alumnos -->
<div class="card bg-base-100 shadow-sm border border-base-200">
    <div class="card-body p-0">
        <div class="overflow-x-auto">
            <table class="table table-zebra table-sm">
                <thead class="bg-base-200/80 text-base-content text-xs uppercase">
                    <tr>
                        <th>Alumno</th>
                        <th>CURP</th>
                        <th class="text-center">Grado / Grupo</th>
                        <th class="text-center">Movimiento</th>
                        <th class="text-center">Último mov</th>
                        <th class="text-center">FI</th>
                        <th class="text-center">HM</th>
                        <th class="text-center">Edición</th>
                        <th class="text-center">Edit. Mov.</th>
                        <th class="text-center">Asignación</th>
                        <th class="text-center">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($alumnos)): ?>
                        <?php foreach ($alumnos as $alumno): ?>
                            <?php
                                $nombreCompleto = $alumno->nombre_alumno . ' ' . $alumno->primer_apellido_alumno . ' ' . $alumno->segundo_apellido_alumno;
                                $esBaja = ($alumno->mov_f === 'B');
                                $esAlta = (!$esBaja && $alumno->mov_i === 'A');
                            ?>
                            <tr class="hover <?= $esBaja ? 'opacity-70' : '' ?>">
                                <!-- Nombre con iniciales -->
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar placeholder">
                                            <div class="bg-neutral text-neutral-content rounded-full w-8 text-xs font-bold">
                                                <span><?= esc(mb_substr($alumno->nombre_alumno, 0, 1) . mb_substr($alumno->primer_apellido_alumno, 0, 1)) ?></span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold text-sm"><?= esc($nombreCompleto) ?></div>
                                            <div class="text-[11px] text-base-content/60"><?= esc($alumno->sexo_alumno) ?> · Origen: <?= esc($alumno->origen) ?></div>
                                        </div>
                                    </div>
                                </td>

                                <!-- CURP -->
                                <td class="font-mono text-xs"><?= esc($alumno->curp) ?></td>

                                <!-- Grado y Grupo -->
                                <td class="text-center">
                                    <span class="badge badge-info badge-outline badge-sm font-bold">
                                        <?= esc($alumno->grado) ?>° <?= esc($alumno->grupo) ?>
                                    </span>
                                </td>

                                <!-- Badge de Movimiento -->
                                <td class="text-center">
                                    <?php if ($esBaja): ?>
                                        <span class="badge badge-error badge-sm font-semibold text-white">Baja (B)</span>
                                    <?php elseif ($esAlta): ?>
                                        <span class="badge badge-info badge-sm font-semibold text-white">Alta (A)</span>
                                    <?php else: ?>
                                        <span class="badge badge-success badge-sm font-semibold text-white">Inscripción (I)</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Fecha del último movimiento -->
                                <td class="text-center text-xs text-base-content/70 tabular-nums">
                                    <?php if ($esBaja && !empty($alumno->fecha_baja)): ?>
                                        <?= esc($alumno->fecha_baja) ?>
                                    <?php elseif ($esAlta && !empty($alumno->fecha_alta)): ?>
                                        <?= esc($alumno->fecha_alta) ?>
                                    <?php else: ?>
                                        <?= esc(date('Y-m-d', strtotime($alumno->fecha_registro))) ?>
                                    <?php endif; ?>
                                </td>


                                <!-- Columna Ficha de inscripción -->
                                    <td class="text-center print:hidden">
                                        <a href="<?= site_url('pdf/ficha_inscripcion/' . $alumno->curp) ?>"
                                        class="btn btn-xs btn-outline btn-success gap-1"
                                        title="Descargar Ficha de Inscripción en PDF">
                                            📄 Ficha Ins.
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

                                    <!-- Nueva Columna: Edición completa -->
                                    <td class="text-center print:hidden">
                                        <a href="<?= site_url('inscripciones/edit/' . $alumno->id_alumno) ?>"
                                        class="btn btn-xs btn-outline btn-neutral gap-1"
                                        title="Edición completa">
                                            Editar
                                        </a>
                                    </td>


             <!-- Acciones -->
                                <td class="text-right">
                                    <div class="join">
                                        <button type="button"
                                                onclick="abrirModalMovimiento(this)"
                                                data-id="<?= esc($alumno->id_alumno) ?>"
                                                data-nombre="<?= esc($nombreCompleto) ?>"
                                                data-curp="<?= esc($alumno->curp) ?>"
                                                data-estatus="<?= $esBaja ? 'Baja (B)' : ($esAlta ? 'Alta (A)' : 'Inscripción (I)') ?>"
                                                data-esbaja="<?= $esBaja ? '1' : '0' ?>"
                                                class="btn btn-xs btn-outline btn-primary join-item">
                                            Movimiento
                                        </button>
                                    </div>
                                </td>

                               <!-- Columna Extra: Editar Grado y Grupo -->
                                <td class="text-center">
                                    <button type="button"
                                            onclick="abrirModalGradoGrupo(this)"
                                            data-id="<?= esc($alumno->id_alumno) ?>"
                                            data-nombre="<?= esc($nombreCompleto) ?>"
                                            data-curp="<?= esc($alumno->curp) ?>"
                                            data-grado="<?= esc($alumno->grado) ?>"
                                            data-grupo="<?= esc($alumno->grupo) ?>"
                                            class="btn btn-xs btn-outline btn-secondary">
                                        Grado / Grupo
                                    </button>
                                </td>


                                <!-- Columna Extra: Eliminar Definitivamente -->
                                <td class="text-center">
                                    <button type="button"
                                            onclick="abrirModalEliminar(this)"
                                            data-id="<?= esc($alumno->id_alumno) ?>"
                                            data-nombre="<?= esc($nombreCompleto) ?>"
                                            data-curp="<?= esc($alumno->curp) ?>"
                                            class="btn btn-xs btn-outline btn-error">
                                        Eliminar
                                    </button>
                                </td>

                                
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="text-center py-8 text-base-content/60">
                                No se encontraron alumnos con los filtros seleccionados.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <?php if ($pager->getPageCount() > 1): ?>
            <div class="p-4 border-t border-base-200 flex justify-end">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal de Movimiento Escolar (Alta / Baja) -->
<dialog id="modal_movimiento" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        
        <h3 class="font-bold text-lg text-base-content">Registrar Movimiento Escolar</h3>
        
        <div class="bg-base-200/70 rounded-lg p-3 my-3 text-xs space-y-1 border border-base-300">
            <div><span class="font-semibold">Alumno:</span> <span id="modal_nombre"></span></div>
            <div><span class="font-semibold">CURP:</span> <span id="modal_curp" class="font-mono"></span></div>
            <div><span class="font-semibold">Estatus Actual:</span> <span id="modal_estatus" class="badge badge-sm badge-ghost font-bold"></span></div>
        </div>

        <form method="post" action="<?= site_url('direccion/alumnos/movimiento') ?>" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="id_alumno" id="modal_id_alumno">

            <div>
                <span class="block text-sm font-semibold mb-2">Tipo de Movimiento</span>
                <div class="flex flex-wrap gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="tipo_movimiento" value="A" class="radio radio-info radio-sm" checked />
                        <span class="text-sm font-medium">Alta (A)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="tipo_movimiento" value="B" class="radio radio-error radio-sm" />
                        <span class="text-sm font-medium">Baja (B)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="tipo_movimiento" value="REACTIVAR" class="radio radio-success radio-sm" />
                        <span class="text-sm font-medium">Quitar Baja (Inscripción)</span>
                    </label>
                </div>
            </div>

            <div>
                <label for="modal_fecha" class="block text-sm font-semibold mb-1">Fecha de Movimiento</label>
                <input type="date" name="fecha_movimiento" id="modal_fecha" value="<?= date('Y-m-d') ?>" class="input input-bordered input-sm w-full" required />
            </div>

            <div class="modal-action">
                <button type="button" onclick="document.getElementById('modal_movimiento').close()" class="btn btn-ghost btn-sm">Cancelar</button>
                <button type="submit" class="btn btn-primary btn-sm">Guardar Movimiento</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>cerrar</button>
    </form>
</dialog>


<!-- Modal 2: Editar Grado y Grupo -->
<dialog id="modal_grado_grupo" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        
        <h3 class="font-bold text-lg text-base-content">Cambiar Grado y Grupo</h3>
        
        <div class="bg-base-200/70 rounded-lg p-3 my-3 text-xs space-y-1 border border-base-300">
            <div><span class="font-semibold">Alumno:</span> <span id="gg_nombre"></span></div>
            <div><span class="font-semibold">CURP:</span> <span id="gg_curp" class="font-mono"></span></div>
        </div>

        <form method="post" action="<?= site_url('direccion/alumnos/grado-grupo') ?>" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="id_alumno" id="gg_id_alumno">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="gg_grado" class="block text-sm font-semibold mb-1">Grado</label>
                    <select name="grado" id="gg_grado" class="select select-bordered select-sm w-full" required>
                        <?php foreach (['1', '2', '3', '4', '5', '6'] as $g): ?>
                            <option value="<?= $g ?>"><?= $g ?>° Grado</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="gg_grupo" class="block text-sm font-semibold mb-1">Grupo</label>
                    <input type="text" name="grupo" id="gg_grupo" maxlength="5" placeholder="Ej. A, B, 102-A" class="input input-bordered input-sm w-full uppercase" required />
                </div>
            </div>

            <div class="modal-action">
                <button type="button" onclick="document.getElementById('modal_grado_grupo').close()" class="btn btn-ghost btn-sm">Cancelar</button>
                <button type="submit" class="btn btn-secondary btn-sm">Actualizar Asignación</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>cerrar</button>
    </form>
</dialog>


<!-- Modal 3: Confirmar Eliminación Definitiva -->
<dialog id="modal_eliminar" class="modal">
    <div class="modal-box border-t-4 border-error">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        
        <h3 class="font-bold text-lg text-error flex items-center gap-2">
            <svg xmlns="http://w3.org" class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            ¿Eliminar alumno definitivamente?
        </h3>
        
        <p class="text-sm text-base-content/80 mt-2">
            Esta acción <strong>no se puede deshacer</strong>. Se eliminará permanentemente el expediente del alumno junto con los datos de sus tutores registrados.
        </p>

        <div class="bg-error/10 rounded-lg p-3 my-3 text-xs space-y-1 border border-error/20">
            <div><span class="font-semibold">Alumno:</span> <span id="del_nombre" class="font-bold"></span></div>
            <div><span class="font-semibold">CURP:</span> <span id="del_curp" class="font-mono"></span></div>
        </div>

        <form method="post" action="<?= site_url('direccion/alumnos/eliminar') ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="id_alumno" id="del_id_alumno">
            
            <div class="modal-action">
                <button type="button" onclick="document.getElementById('modal_eliminar').close()" class="btn btn-ghost btn-sm">Cancelar</button>
                <button type="submit" class="btn btn-error btn-sm text-white">Sí, eliminar definitivamente</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>cerrar</button>
    </form>
</dialog>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function abrirModalMovimiento(btn) {
    document.getElementById('modal_id_alumno').value = btn.dataset.id;
    document.getElementById('modal_nombre').textContent = btn.dataset.nombre;
    document.getElementById('modal_curp').textContent = btn.dataset.curp;
    document.getElementById('modal_estatus').textContent = btn.dataset.estatus;
    
    const esBaja = btn.dataset.esbaja === '1';
    const radios = document.getElementsByName('tipo_movimiento');
    radios.forEach(r => {
        if (esBaja && r.value === 'A') r.checked = true;
        if (!esBaja && r.value === 'B') r.checked = true;
    });

    document.getElementById('modal_movimiento').showModal();
}

function abrirModalGradoGrupo(btn) {
    document.getElementById('gg_id_alumno').value = btn.dataset.id;
    document.getElementById('gg_nombre').textContent = btn.dataset.nombre;
    document.getElementById('gg_curp').textContent = btn.dataset.curp;
    document.getElementById('gg_grado').value = btn.dataset.grado;
    document.getElementById('gg_grupo').value = btn.dataset.grupo;

    document.getElementById('modal_grado_grupo').showModal();
}


function abrirModalEliminar(btn) {
    document.getElementById('del_id_alumno').value = btn.dataset.id;
    document.getElementById('del_nombre').textContent = btn.dataset.nombre;
    document.getElementById('del_curp').textContent = btn.dataset.curp;

    document.getElementById('modal_eliminar').showModal();
}

</script>
<?= $this->endSection() ?>
