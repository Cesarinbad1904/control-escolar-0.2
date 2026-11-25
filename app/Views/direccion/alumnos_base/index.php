<?= $this->extend('layouts/main') ?>

<?= $this->section('contenido') ?>
<div class="container mx-auto px-4 py-6">

    <!-- Alertas -->
    <?php if (session()->getFlashdata('success')): ?>
        <div role="alert" class="alert alert-success shadow-md mb-6">
            <svg xmlns="http://w3.org" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span><?= esc(session()->getFlashdata('success')) ?></span>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div role="alert" class="alert alert-error shadow-md mb-6">
            <svg xmlns="http://w3.org" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span><?= esc(session()->getFlashdata('error')) ?></span>
        </div>
    <?php endif; ?>

    <!-- Encabezado y Filtros -->
    <div class="card bg-base-100 shadow-md border border-base-200 mb-6">
        <div class="card-body">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-base-content">Padrón de Alumnos Autorizados</h1>
                    <p class="text-sm text-base-content/70">Control de alumnos habilitados para realizar su inscripción en línea</p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <a href="<?= base_url('direccion/alumnos-base/nuevo') ?>" class="btn btn-primary gap-2">
                        <svg xmlns="http://w3.org" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Autorizar Alumno
                    </a>
                </div>
            </div>

            <div class="divider my-2"></div>

            <!-- Formulario de Búsqueda y Filtro por Estatus -->
            <form action="<?= base_url('direccion/alumnos-base') ?>" method="get" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <div class="join flex-1">
                    <input 
                        type="text" 
                        name="q" 
                        value="<?= esc($busqueda ?? '') ?>" 
                        placeholder="Buscar por nombre completo o CURP..." 
                        class="input input-bordered join-item w-full focus:outline-none"
                    />
                    <select name="estatus" class="select select-bordered join-item">
                        <option value="" <?= empty($estatus) ? 'selected' : '' ?>>Todos los estatus</option>
                        <option value="pendiente" <?= ($estatus ?? '') === 'pendiente' ? 'selected' : '' ?>>Pendiente de registro</option>
                        <option value="completado" <?= ($estatus ?? '') === 'completado' ? 'selected' : '' ?>>Completado</option>
                    </select>
                    <button type="submit" class="btn btn-neutral join-item">
                        Filtrar
                    </button>
                </div>

                <?php if (!empty($busqueda) || !empty($estatus)): ?>
                    <a href="<?= base_url('direccion/alumnos-base') ?>" class="btn btn-ghost btn-sm text-error">
                        Limpiar filtros
                    </a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Tabla de Resultados -->
    <div class="card bg-base-100 shadow-md border border-base-200">
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                        <thead class="bg-base-200 text-base-content">
                        <tr>
                            <th>Nombre Completo</th>
                            <th>CURP</th>
                            <th class="text-center">Grado</th>
                            <th class="text-center">Grupo</th>
                            <th class="text-center">Estatus</th>
                            <th class="text-center">Editar</th>
                            <th class="text-center">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($alumnos)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-8 text-base-content/60">
                                    No se encontraron alumnos en el padrón autorizado.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($alumnos as $alumno): ?>
                                <?php $estaInscrito = !is_null($alumno->id_inscrito); ?>
                                <tr class="hover">
                                    <td class="font-medium">
                                        <?= esc($alumno->nombre) ?>
                                    </td>
                                    <td class="font-mono text-xs">
                                        <?= esc($alumno->curp) ?>
                                    </td>
                                    <td class="text-center font-semibold">
                                        <?= esc($alumno->grado) ?>°
                                    </td>
                                    <td class="text-center">
                                        <?php if (!empty($alumno->grupo)): ?>
                                            <span class="badge badge-ghost font-semibold"><?= esc($alumno->grupo) ?></span>
                                        <?php else: ?>
                                            <span class="text-xs text-base-content/40 italic">Sin asignar</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($estaInscrito): ?>
                                            <span class="badge badge-success text-white gap-1 font-medium">
                                                <svg xmlns="http://w3.org" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                                Completado
                                            </span>
                                        <?php else: ?>
                                            <span class="badge badge-warning gap-1 font-medium">
                                                <svg xmlns="http://w3.org" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                </svg>
                                                Pendiente de registro
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Columna Editar -->
                                    <td class="text-center">
                                        <?php if (!$estaInscrito): ?>
                                            <button 
                                                type="button"
                                                onclick="abrirModalEditar(<?= $alumno->id_alumno ?>, '<?= esc($alumno->nombre, 'js') ?>', '<?= esc($alumno->grado, 'js') ?>', '<?= esc($alumno->grupo, 'js') ?>')"
                                                class="btn btn-sm btn-outline btn-info gap-1"
                                                title="Modificar grado y grupo autorizado">
                                                <svg xmlns="http://w3.org" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Editar
                                            </button>
                                        <?php else: ?>
                                            <span class="text-xs text-base-content/40 italic" title="El alumno ya está inscrito">
                                                Bloqueado
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Columna Eliminar -->
                                    <td class="text-center">
                                        <?php if (!$estaInscrito): ?>
                                            <button 
                                                type="button"
                                                onclick="abrirModalEliminar(<?= $alumno->id_alumno ?>, '<?= esc($alumno->nombre, 'js') ?>', '<?= esc($alumno->curp, 'js') ?>')"
                                                class="btn btn-sm btn-outline btn-error gap-1"
                                                title="Eliminar autorización del padrón">
                                                <svg xmlns="http://w3.org" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Eliminar
                                            </button>
                                        <?php else: ?>
                                            <span class="text-xs text-base-content/40 italic">—</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if (!empty($alumnos)): ?>
                <div class="p-4 border-t border-base-200 text-sm text-base-content/70">
                    Total de registros mostrados: <span class="font-semibold"><?= count($alumnos) ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal para Editar Grado y Grupo -->
<dialog id="modal_editar_grado_grupo" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg text-base-content">Editar Grado y Grupo Autorizado</h3>
        <p id="modal_nombre_alumno" class="text-sm text-primary font-semibold mt-1 mb-4"></p>

        <form action="<?= base_url('direccion/alumnos-base/grado-grupo') ?>" method="post" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="id_alumno" id="modal_id_alumno">

            <div class="grid grid-cols-2 gap-4">
                <div class="form-control">
                    <label class="label" for="modal_grado">
                        <span class="label-text font-semibold">Grado</span>
                    </label>
                    <select name="grado" id="modal_grado" class="select select-bordered w-full" required>
                        <option value="1">1° Grado</option>
                        <option value="2">2° Grado</option>
                        <option value="3">3° Grado</option>
                        <option value="4">4° Grado</option>
                        <option value="5">5° Grado</option>
                        <option value="6">6° Grado</option>
                    </select>
                </div>

                <div class="form-control">
                    <label class="label" for="modal_grupo">
                        <span class="label-text font-semibold">Grupo</span>
                    </label>
                    <select name="grupo" id="modal_grupo" class="select select-bordered w-full">
                        <option value="">Sin asignar</option>
                        <option value="A">Grupo A</option>
                        <option value="B">Grupo B</option>
                        <option value="C">Grupo C</option>
                        <option value="D">Grupo D</option>
                    </select>
                </div>
            </div>

            <div class="modal-action">
                <button type="button" class="btn btn-ghost" onclick="modal_editar_grado_grupo.close()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>cerrar</button>
    </form>
</dialog>

<!-- Modal de Confirmación para Eliminar -->
<dialog id="modal_eliminar_alumno_base" class="modal">
    <div class="modal-box border-t-4 border-error">
        <div class="flex items-center gap-3 text-error mb-2">
            <svg xmlns="http://w3.org" class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <h3 class="font-bold text-lg">Confirmar Eliminación</h3>
        </div>
        
        <p class="text-sm text-base-content/80 mt-2">
            ¿Estás seguro de que deseas eliminar del padrón autorizado al siguiente alumno?
        </p>

        <div class="bg-base-200/70 p-3 rounded-lg my-3 border border-base-300">
            <p id="eliminar_nombre_alumno" class="font-bold text-base-content"></p>
            <p id="eliminar_curp_alumno" class="font-mono text-xs text-base-content/70 mt-0.5"></p>
        </div>

        <p class="text-xs text-base-content/60">
            Esta acción revocará su autorización y el tutor no podrá iniciar su registro en línea con esta CURP.
        </p>

        <form action="<?= base_url('direccion/alumnos-base/eliminar') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="id_alumno" id="eliminar_id_alumno">

            <div class="modal-action">
                <button type="button" class="btn btn-ghost" onclick="modal_eliminar_alumno_base.close()">Cancelar</button>
                <button type="submit" class="btn btn-error text-white">Sí, Eliminar</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>cerrar</button>
    </form>
</dialog>

<script>
function abrirModalEditar(id, nombre, grado, grupo) {
    document.getElementById('modal_id_alumno').value = id;
    document.getElementById('modal_nombre_alumno').textContent = nombre;
    document.getElementById('modal_grado').value = grado;
    document.getElementById('modal_grupo').value = grupo || '';
    
    document.getElementById('modal_editar_grado_grupo').showModal();
}

function abrirModalEliminar(id, nombre, curp) {
    document.getElementById('eliminar_id_alumno').value = id;
    document.getElementById('eliminar_nombre_alumno').textContent = nombre;
    document.getElementById('eliminar_curp_alumno').textContent = 'CURP: ' + curp;
    
    document.getElementById('modal_eliminar_alumno_base').showModal();
}
</script>
<?= $this->endSection() ?>

