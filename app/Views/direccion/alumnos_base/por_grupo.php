<?= $this->extend('layouts/main') ?>

<?= $this->section('contenido') ?>
<div class="container mx-auto px-4 py-6">

    <!-- Título Superior -->
    <div class="border-b border-base-300 pb-4 mb-6">
        <h1 class="text-2xl font-bold text-base-content">Consulta de Alumnos Autorizados por Grupo</h1>
    </div>

    <!-- Tarjeta de Filtros de Búsqueda -->
    <div class="card bg-base-100 shadow-sm border border-base-200 mb-6">
            <!-- Tarjeta de Filtros de Búsqueda -->
        <div class="card bg-base-100 shadow-sm border border-base-200 mb-6 print:hidden">

        <div class="card-body p-6">
            <h2 class="text-base font-bold text-base-content mb-3">Filtros de Búsqueda</h2>
            
            <form action="<?= base_url('direccion/alumnos-base/por-grupo') ?>" method="get" class="flex flex-wrap items-end gap-4">
                <div class="form-control w-full sm:w-56">
                    <label class="label pt-0" for="grado">
                        <span class="label-text text-xs font-medium text-base-content/70">Grado</span>
                    </label>
                    <select id="grado" name="grado" class="select select-bordered select-sm h-10 w-full focus:select-primary" required>
                        <option value="" disabled <?= ($grado === null || $grado === '') ? 'selected' : '' ?>>Selecciona grado...</option>
                        <option value="1" <?= $grado === '1' ? 'selected' : '' ?>>1° Grado</option>
                        <option value="2" <?= $grado === '2' ? 'selected' : '' ?>>2° Grado</option>
                        <option value="3" <?= $grado === '3' ? 'selected' : '' ?>>3° Grado</option>
                        <option value="4" <?= $grado === '4' ? 'selected' : '' ?>>4° Grado</option>
                        <option value="5" <?= $grado === '5' ? 'selected' : '' ?>>5° Grado</option>
                        <option value="6" <?= $grado === '6' ? 'selected' : '' ?>>6° Grado</option>
                    </select>
                </div>

                <div class="form-control w-full sm:w-56">
                    <label class="label pt-0" for="grupo">
                        <span class="label-text text-xs font-medium text-base-content/70">Grupo</span>
                    </label>
                    <select id="grupo" name="grupo" class="select select-bordered select-sm h-10 w-full focus:select-primary" required>
                        <option value="" disabled <?= empty($grupo) ? 'selected' : '' ?>>Selecciona grupo...</option>
                        <option value="A" <?= $grupo === 'A' ? 'selected' : '' ?>>Grupo A</option>
                        <option value="B" <?= $grupo === 'B' ? 'selected' : '' ?>>Grupo B</option>
                        <option value="C" <?= $grupo === 'C' ? 'selected' : '' ?>>Grupo C</option>
                        <option value="D" <?= $grupo === 'D' ? 'selected' : '' ?>>Grupo D</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn btn-info text-white btn-sm h-10 px-5 gap-2">
                        <svg xmlns="http://w3.org" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Consultar Grupo
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Contenedor de Resultados -->
    <div class="card bg-base-100 shadow-sm border border-base-200">
        <div class="card-body p-0">
            <?php if (!$busquedaRealizada): ?>
                <!-- Estado Inicial (Igual a tu imagen) -->
                <div class="flex flex-col items-center justify-center py-16 px-4 text-center">
                    <div class="text-base-content/40 mb-3">
                        <svg xmlns="http://w3.org" class="h-14 w-14 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-base-content">Selecciona un Grado y Grupo</h3>
                    <p class="text-sm text-base-content/60 max-w-md mt-1">
                        Elige el grado y grupo en los filtros superiores y presiona <span class="font-semibold text-base-content/80">Consultar Grupo</span> para generar la lista de alumnos autorizados.
                    </p>
                </div>

            <?php elseif (empty($alumnos)): ?>
                <!-- Estado Sin Resultados -->
                <div class="flex flex-col items-center justify-center py-14 px-4 text-center">
                    <h3 class="text-base font-bold text-base-content">Sin alumnos registrados en este grupo</h3>
                    <p class="text-sm text-base-content/60 mt-1">
                        No se encontraron alumnos autorizados para <span class="font-semibold"><?= esc($grado) ?>° "<?= esc($grupo) ?>"</span>.
                    </p>
                </div>

            <?php else: ?>

                                <!-- Cabecera de Estadísticas del Grupo -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-5 border-b border-base-200 bg-base-200/30">
                    <div>
                        <h3 class="text-lg font-bold text-base-content">
                            Lista del Grupo: <span class="text-primary"><?= esc($grado) ?>° "<?= esc($grupo) ?>"</span>
                        </h3>
                        <p class="text-xs text-base-content/60">Padrón de alumnos autorizados</p>
                    </div>

                    <!-- Contadores y Botón de Impresión -->
                    <div class="flex flex-wrap items-center gap-2">
                        <div class="badge badge-secondary badge-lg gap-1.5 text-white font-semibold py-3">
                            <span>Mujeres:</span>
                            <span><?= $totalMujeres ?></span>
                        </div>
                        <div class="badge badge-info badge-lg gap-1.5 text-white font-semibold py-3">
                            <span>Hombres:</span>
                            <span><?= $totalHombres ?></span>
                        </div>
                        <div class="badge badge-neutral badge-lg gap-1.5 font-semibold py-3">
                            <span>Total:</span>
                            <span><?= count($alumnos) ?></span>
                        </div>

                        <!-- Botón Imprimir (se oculta al imprimir) -->
                        <button 
                            type="button" 
                            onclick="window.print()" 
                            class="btn btn-outline btn-sm h-8 ml-2 gap-1.5 print:hidden"
                            title="Imprimir lista del grupo">
                            <svg xmlns="http://w3.org" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Imprimir
                        </button>
                    </div>
                </div>


                                             <!-- Tabla de Alumnos -->
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead class="bg-base-200 text-base-content">
                            <tr>
                                <th class="w-12 text-center">#</th>
                                <th>Nombre Completo</th>
                                <th>CURP</th>
                                <th class="text-center">Sexo</th>
                                <th class="text-center">Estatus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $num = 1; ?>
                            <?php foreach ($alumnos as $alumno): ?>
                                <?php 
                                    $estaInscrito = !is_null($alumno->id_inscrito); 
                                    $letraSexo = strtoupper(substr($alumno->curp, 10, 1));
                                ?>
                                <tr class="hover">
                                    <td class="text-center font-medium text-base-content/60">
                                        <?= $num++ ?>
                                    </td>
                                    <td class="font-medium">
                                        <?= esc($alumno->nombre) ?>
                                    </td>
                                    <td class="font-mono text-xs">
                                        <?= esc($alumno->curp) ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($letraSexo === 'M'): ?>
                                            <span class="badge badge-secondary badge-outline badge-sm font-medium">MUJER</span>
                                        <?php elseif ($letraSexo === 'H'): ?>
                                            <span class="badge badge-info badge-outline badge-sm font-medium">HOMBRE</span>
                                        <?php else: ?>
                                            <span class="text-xs text-base-content/40">-</span>
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
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

