<?= $this->extend('layouts/main') ?>

<?= $this->section('contenido') ?>
<div class="container mx-auto px-4 py-6 max-w-6xl">

    <!-- Encabezado -->
    <div class="mb-6">
        <div class="flex flex-wrap items-center gap-3">
            <h1 class="text-2xl font-bold text-base-content">Autorizados por Grado y Grupo</h1>
            <span class="badge badge-info text-white font-semibold px-3 py-3 rounded-md">Padrón Base</span>
        </div>
        <p class="text-sm text-base-content/60 mt-1">
            Matrícula autorizada por grupo y avance de registro por parte de los tutores
        </p>
    </div>

    <!-- Tarjeta de la Tabla Estadística -->
    <div class="card bg-base-100 shadow-sm border border-base-200 overflow-hidden">
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead class="bg-base-200/70 text-xs uppercase text-base-content/70 border-b border-base-200">
                        <tr>
                            <th class="text-center py-4">GRADO</th>
                            <th class="text-center py-4">GRUPO</th>
                            <th class="text-center py-4">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-info"></span>
                                    HOMBRES
                                </span>
                            </th>
                            <th class="text-center py-4">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-secondary"></span>
                                    MUJERES
                                </span>
                            </th>
                            <th class="text-center py-4">
                                <span class="inline-flex items-center gap-1.5 text-success">
                                    <span class="w-2 h-2 rounded-full bg-success"></span>
                                    COMPLETADOS
                                </span>
                            </th>
                            <th class="text-center py-4">
                                <span class="inline-flex items-center gap-1.5 text-warning">
                                    <span class="w-2 h-2 rounded-full bg-warning"></span>
                                    PENDIENTES
                                </span>
                            </th>
                            <th class="text-center py-4 bg-info/10 text-info font-bold">
                                TOTAL GRUPO
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-base-200">
                        <?php if (empty($estadisticas)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-10 text-base-content/50">
                                    No hay alumnos autorizados registrados en el padrón base.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($estadisticas as $fila): ?>
                                <tr class="hover:bg-base-200/30 transition-colors">
                                    <!-- Grado -->
                                    <td class="text-center py-3">
                                        <span class="badge badge-ghost font-bold text-xs px-2.5 py-2.5">
                                            <?= esc($fila->grado) ?>°
                                        </span>
                                    </td>

                                    <!-- Grupo -->
                                    <td class="text-center py-3">
                                        <?php if (!empty($fila->grupo)): ?>
                                            <span class="inline-flex items-center justify-center border border-base-300 bg-base-100 rounded px-2.5 py-0.5 text-xs font-bold text-base-content">
                                                <?= esc($fila->grupo) ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-xs text-base-content/40 italic">Sin grupo</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Hombres -->
                                    <td class="text-center py-3 font-medium text-base-content/80">
                                        <?= (int) $fila->hombres ?>
                                    </td>

                                    <!-- Mujeres -->
                                    <td class="text-center py-3 font-medium text-base-content/80">
                                        <?= (int) $fila->mujeres ?>
                                    </td>

                                    <!-- Completados -->
                                    <td class="text-center py-3">
                                        <span class="badge badge-success badge-outline font-semibold text-xs">
                                            <?= (int) $fila->completados ?>
                                        </span>
                                    </td>

                                    <!-- Pendientes -->
                                    <td class="text-center py-3">
                                        <?php if ((int) $fila->pendientes > 0): ?>
                                            <span class="badge badge-warning badge-outline font-semibold text-xs">
                                                <?= (int) $fila->pendientes ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-xs text-base-content/40 font-medium">0</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Total Grupo -->
                                    <td class="text-center py-3 bg-info/5 font-bold text-info">
                                        <?= (int) $fila->total ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>

                    <!-- Fila de Total General -->
                    <?php if (!empty($estadisticas)): ?>
                        <tfoot class="bg-base-200/70 border-t-2 border-base-300 font-bold">
                            <tr>
                                <td colspan="2" class="text-right py-3.5 pr-6 text-xs uppercase tracking-wider text-base-content">
                                    TOTAL GENERAL
                                </td>
                                <td class="text-center py-3.5 text-info text-sm">
                                    <?= $totalGeneralHombres ?>
                                </td>
                                <td class="text-center py-3.5 text-base-content text-sm">
                                    <?= $totalGeneralMujeres ?>
                                </td>
                                <td class="text-center py-3.5 text-success text-sm">
                                    <?= $totalGeneralCompletados ?>
                                </td>
                                <td class="text-center py-3.5 text-warning text-sm">
                                    <?= $totalGeneralPendientes ?>
                                </td>
                                <td class="text-center py-3.5 bg-info/10">
                                    <span class="badge badge-info text-white font-bold px-3.5 py-3 rounded-md text-sm">
                                        <?= $totalGeneralAlumnos ?>
                                    </span>
                                </td>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

    <!-- Pie de Página Informativo -->
    <?php if (!empty($estadisticas)): ?>
        <div class="flex flex-col sm:flex-row items-center justify-between text-xs text-base-content/50 mt-3 px-1">
            <span>Ordenado ascendentemente por grado y grupo</span>
            <span><?= $totalGrupos ?> <?= $totalGrupos === 1 ? 'grupo activo' : 'grupos activos' ?></span>
        </div>
    <?php endif; ?>

</div>
<?= $this->endSection() ?>
