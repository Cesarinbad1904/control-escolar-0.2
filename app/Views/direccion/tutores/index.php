<?= $this->extend('layouts/main') ?>

<?= $this->section('contenido') ?>
<div class="container mx-auto px-4 py-6">
    
    <!-- Encabezado y Buscador -->
    <div class="card bg-base-100 shadow-md border border-base-200 mb-6">
        <div class="card-body">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-base-content">Directorio de Tutores</h1>
                    <p class="text-sm text-base-content/70">Consulta de tutores registrados y alumnos tutorados</p>
                </div>

                <!-- Formulario de Búsqueda -->
                <form action="<?= base_url('direccion/tutores') ?>" method="get" class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                    <div class="join w-full md:w-96">
                        <input 
                            type="text" 
                            name="q" 
                            value="<?= esc($busqueda ?? '') ?>" 
                            placeholder="Buscar por tutor, CURP o alumno..." 
                            class="input input-bordered join-item w-full focus:outline-none"
                        />
                        <button type="submit" class="btn btn-primary join-item">
                            <svg xmlns="http://w3.org" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Buscar
                        </button>
                    </div>

                    <?php if (!empty($busqueda)): ?>
                        <a href="<?= base_url('direccion/tutores') ?>" class="btn btn-ghost btn-sm text-error">
                            Limpiar
                        </a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabla de Resultados -->
    <div class="card bg-base-100 shadow-md border border-base-200">
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead class="bg-base-200 text-base-content">
                        <tr>
                            <th>Primer Tutor</th>
                            <th>CURP (1er Tutor)</th>
                            <th>Sexo</th>
                            <th>Segundo Tutor</th>
                            <th>Alumno Tutorado</th>
                            <th class="text-center">Grado y Grupo</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($tutores)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-8 text-base-content/60">
                                    No se encontraron registros de tutores con los criterios de búsqueda.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($tutores as $tutor): ?>
                                <?php
                                    $nombreTutor1 = trim($tutor->nombre_tutor . ' ' . $tutor->primer_apellido_tutor . ' ' . $tutor->segundo_apellido_tutor);
                                    $nombreTutor2 = trim($tutor->nombre_tutor2 . ' ' . $tutor->primer_apellido_tutor2 . ' ' . $tutor->segundo_apellido_tutor2);
                                    $nombreAlumno = trim($tutor->nombre_alumno . ' ' . $tutor->primer_apellido_alumno . ' ' . $tutor->segundo_apellido_alumno);
                                ?>
                                <tr class="hover">
                                    <td class="font-medium">
                                        <?= esc($nombreTutor1) ?>
                                    </td>
                                    <td class="font-mono text-xs">
                                        <?= esc($tutor->curp_tutor) ?>
                                    </td>
                                    <td>
                                        <?php if ($tutor->sexo_tutor === 'MUJER'): ?>
                                            <span class="badge badge-secondary badge-outline badge-sm">MUJER</span>
                                        <?php else: ?>
                                            <span class="badge badge-info badge-outline badge-sm">HOMBRE</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-sm text-base-content/80">
                                        <?= esc($nombreTutor2) ?>
                                    </td>
                                    <td class="font-medium">
                                        <?= esc($nombreAlumno) ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-neutral font-semibold">
                                            <?= esc($tutor->grado) ?>° "<?= esc($tutor->grupo) ?>"
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('direccion/alumnos/ver/' . $tutor->id_alumno) ?>" 
                                           class="btn btn-sm btn-outline btn-primary gap-1"
                                           title="Ver ficha completa de datos">
                                            <svg xmlns="http://w3.org" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Ficha
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Total de registros -->
            <?php if (!empty($tutores)): ?>
                <div class="p-4 border-t border-base-200 text-sm text-base-content/70">
                    Total de registros mostrados: <span class="font-semibold"><?= count($tutores) ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
