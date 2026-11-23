<?= $this->extend('layouts/main') ?>

<?= $this->section('contenido') ?>

<!-- Fila 1: Tarjetas de Resumen (KPIs) -->
<div class="stats stats-vertical lg:stats-horizontal shadow w-full bg-base-100 mb-6">
    <div class="stat">
        <div class="stat-title">Alumnos Activos (Existencia)</div>
        <div class="stat-value text-primary"><?= esc($total_alumnos) ?></div>
        <div class="stat-desc">
            <?= esc($totales_existencia['hombres']) ?> Hombres · <?= esc($totales_existencia['mujeres']) ?> Mujeres
        </div>
    </div>

    <div class="stat">
        <div class="stat-title">SAID</div>
        <div class="stat-value text-secondary"><?= esc($origen_said) ?></div>
        <div class="stat-desc">Origen (SAID) registrados</div>
    </div>

    <div class="stat">
        <div class="stat-title">Nuevo ingreso</div>
        <div class="stat-value text-secondary"><?= esc($origen_ni) ?></div>
        <div class="stat-desc">Origen (Nuevo ingreso) registrados</div>
    </div>

    <div class="stat">
        <div class="stat-title">Reinscripciones</div>
        <div class="stat-value text-info"><?= esc($origen_me) ?></div>
        <div class="stat-desc">Origen (Misma Escuela) Registrados</div>
    </div>

    <div class="stat">
        <div class="stat-title">Tutores Activos</div>
        <div class="stat-value text-accent"><?= esc($tutores_activos) ?></div>
        <div class="stat-desc">Expedientes vinculados</div>
    </div>

    <div class="stat">
        <div class="stat-title">Situación Reprobado</div>
        <div class="stat-value text-error"><?= esc($alumnos_reprobados) ?></div>
        <div class="stat-desc">Alumnos marcados con "SI"</div>
    </div>
</div>





<!-- Fila 3: Estadística General por Grado y Género (Diseño Moderno) -->
<div class="card bg-base-100 shadow-sm border border-base-200 mb-6">
    <div class="card-body p-5 sm:p-6">
        
        <!-- Encabezado de la tarjeta -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3 mb-4">
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="card-title text-lg font-bold text-base-content">
                        Inscripciones, Altas, Bajas y Existencia por Grado y Género
                    </h2>
                    <span class="badge badge-primary badge-sm">Estadística</span>
                </div>
                <p class="text-xs text-base-content/60 mt-0.5">
                    Desglose oficial por movimiento escolar (<strong>H</strong> = Hombres · <strong>M</strong> = Mujeres · <strong>T</strong> = Total)
                </p>
            </div>

            <!-- Nota preventiva estilizada -->
            <div role="alert" class="alert alert-warning py-2 px-3 text-xs max-w-xl rounded-lg shadow-none">
                <svg xmlns="http://w3.org" class="stroke-current shrink-0 h-4 w-4" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>Los resultados reflejan datos reales al registrar correctamente los movimientos de <strong>Alta</strong> y <strong>Baja</strong>.</span>
            </div>
        </div>

        <!-- Contenedor responsivo con bordes redondeados -->
        <div class="overflow-x-auto rounded-xl border border-base-200">
            <table class="table table-xs sm:table-sm text-center tabular-nums">
                <thead>
                    <!-- Nivel 1: Categorías Agrupadas -->
                    <tr class="bg-base-200/80 text-base-content text-xs uppercase tracking-wider border-b border-base-300">
                        <th rowspan="2" class="sticky left-0 z-10 bg-base-200 border-r border-base-300 align-middle font-bold">
                            Grado
                        </th>
                        <th colspan="3" class="border-r border-base-300 py-2 text-info">
                            Inscripciones
                        </th>
                        <th colspan="3" class="border-r border-base-300 py-2 text-success">
                            Altas
                        </th>
                        <th colspan="3" class="border-r border-base-300 py-2 text-warning">
                            Bajas
                        </th>
                        <th colspan="3" class="border-r border-base-300 py-2 text-primary bg-primary/5">
                            Existencia
                        </th>
                        <th colspan="3" class="py-2 text-error">
                            Reprobados
                        </th>
                    </tr>

                    <!-- Nivel 2: Subcolumnas H / M / T -->
                    <tr class="bg-base-200/40 text-[11px] font-semibold text-base-content/70 border-b border-base-300">
                        <!-- Inscripciones -->
                        <th>H</th>
                        <th>M</th>
                        <th class="border-r border-base-300 bg-base-200/60 text-base-content font-bold">T</th>
                        <!-- Altas -->
                        <th>H</th>
                        <th>M</th>
                        <th class="border-r border-base-300 bg-base-200/60 text-base-content font-bold">T</th>
                        <!-- Bajas -->
                        <th>H</th>
                        <th>M</th>
                        <th class="border-r border-base-300 bg-base-200/60 text-base-content font-bold">T</th>
                        <!-- Existencia (destacada sutilmente por ser la matrícula real) -->
                        <th class="bg-primary/5">H</th>
                        <th class="bg-primary/5">M</th>
                        <th class="border-r border-base-300 bg-primary/10 text-primary font-bold">T</th>
                        <!-- Reprobados -->
                        <th>H</th>
                        <th>M</th>
                        <th class="bg-base-200/60 text-base-content font-bold">T</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-base-200">
                    <?php foreach ($estadistica_grados as $grado => $valores): ?>
                        <tr class="hover:bg-base-200/40 transition-colors">
                            <!-- Grado fijo a la izquierda -->
                            <td class="sticky left-0 z-10 bg-base-100 border-r border-base-200 font-bold">
                                <span class="badge badge-ghost badge-sm font-bold"><?= esc($grado) ?>°</span>
                            </td>

                            <!-- Inscripciones -->
                            <td class="text-base-content/80"><?= esc($valores['ins_h']) ?></td>
                            <td class="text-base-content/80"><?= esc($valores['ins_m']) ?></td>
                            <td class="border-r border-base-200 bg-base-200/30 font-semibold"><?= esc($valores['ins_t']) ?></td>

                            <!-- Altas -->
                            <td class="text-base-content/80"><?= esc($valores['alt_h']) ?></td>
                            <td class="text-base-content/80"><?= esc($valores['alt_m']) ?></td>
                            <td class="border-r border-base-200 bg-base-200/30 font-semibold"><?= esc($valores['alt_t']) ?></td>

                            <!-- Bajas -->
                            <td class="text-base-content/80"><?= esc($valores['baj_h']) ?></td>
                            <td class="text-base-content/80"><?= esc($valores['baj_m']) ?></td>
                            <td class="border-r border-base-200 bg-base-200/30 font-semibold"><?= esc($valores['baj_t']) ?></td>

                            <!-- Existencia -->
                            <td class="bg-primary/5 text-base-content/90"><?= esc($valores['exi_h']) ?></td>
                            <td class="bg-primary/5 text-base-content/90"><?= esc($valores['exi_m']) ?></td>
                            <td class="border-r border-base-200 bg-primary/10 font-bold text-primary"><?= esc($valores['exi_t']) ?></td>

                            <!-- Reprobados -->
                            <td class="text-base-content/80"><?= esc($valores['rep_h']) ?></td>
                            <td class="text-base-content/80"><?= esc($valores['rep_m']) ?></td>
                            <td class="bg-base-200/30 font-semibold <?= $valores['rep_t'] > 0 ? 'text-error' : '' ?>">
                                <?= esc($valores['rep_t']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <!-- Fila Final de Totales -->
                <tfoot class="bg-base-200/90 border-t-2 border-base-300 font-bold text-base-content">
                    <tr>
                        <td class="sticky left-0 z-10 bg-base-200 border-r border-base-300 uppercase text-xs tracking-wider">
                            Total
                        </td>

                        <!-- Total Inscripciones -->
                        <td><?= esc($totales_estadistica['ins_h']) ?></td>
                        <td><?= esc($totales_estadistica['ins_m']) ?></td>
                        <td class="border-r border-base-300">
                            <span class="badge badge-info badge-sm font-bold"><?= esc($totales_estadistica['ins_t']) ?></span>
                        </td>

                        <!-- Total Altas -->
                        <td><?= esc($totales_estadistica['alt_h']) ?></td>
                        <td><?= esc($totales_estadistica['alt_m']) ?></td>
                        <td class="border-r border-base-300">
                            <span class="badge badge-success badge-sm font-bold"><?= esc($totales_estadistica['alt_t']) ?></span>
                        </td>

                        <!-- Total Bajas -->
                        <td><?= esc($totales_estadistica['baj_h']) ?></td>
                        <td><?= esc($totales_estadistica['baj_m']) ?></td>
                        <td class="border-r border-base-300">
                            <span class="badge badge-warning badge-sm font-bold"><?= esc($totales_estadistica['baj_t']) ?></span>
                        </td>

                        <!-- Total Existencia -->
                        <td class="bg-primary/10"><?= esc($totales_estadistica['exi_h']) ?></td>
                        <td class="bg-primary/10"><?= esc($totales_estadistica['exi_m']) ?></td>
                        <td class="border-r border-base-300 bg-primary/15">
                            <span class="badge badge-primary badge-sm font-bold"><?= esc($totales_estadistica['exi_t']) ?></span>
                        </td>

                        <!-- Total Reprobados -->
                        <td><?= esc($totales_estadistica['rep_h']) ?></td>
                        <td><?= esc($totales_estadistica['rep_m']) ?></td>
                        <td>
                            <span class="badge badge-error badge-sm font-bold"><?= esc($totales_estadistica['rep_t']) ?></span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>





<!-- Años Cursados en Preescolar (Primer Grado - Diseño Moderno) -->
<div class="card bg-base-100 shadow-sm border border-base-200 mb-6">
    <div class="card-body p-5 sm:p-6 flex flex-col justify-between">
        
        <!-- Encabezado de la tarjeta -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4">
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="card-title text-base sm:text-lg font-bold text-base-content">
                        Años Cursados en Preescolar
                    </h2>
                    <span class="badge badge-warning badge-sm font-semibold">1° Grado</span>
                </div>
                <p class="text-xs text-base-content/60 mt-0.5">
                    Antecedente preescolar de alumnos activos en primer grado (<strong>H</strong> · <strong>M</strong> · <strong>T</strong>)
                </p>
            </div>
        </div>

        <!-- Tabla moderna con números tabulares -->
        <div class="overflow-x-auto rounded-xl border border-base-200 my-auto">
            <table class="table table-xs sm:table-sm text-center tabular-nums">
                <thead>
                    <!-- Nivel 1: Años cursados (0, 1, 2, 3) y Total -->
                    <tr class="bg-base-200/80 text-base-content text-xs uppercase tracking-wider border-b border-base-300">
                        <th colspan="3" class="border-r border-base-300 py-2 text-base-content/70">
                            0 Años
                        </th>
                        <th colspan="3" class="border-r border-base-300 py-2 text-info">
                            1 Año
                        </th>
                        <th colspan="3" class="border-r border-base-300 py-2 text-secondary">
                            2 Años
                        </th>
                        <th colspan="3" class="border-r border-base-300 py-2 text-success">
                            3 Años
                        </th>
                        <th rowspan="2" class="align-middle bg-primary/10 text-primary font-bold px-3">
                            Total
                        </th>
                    </tr>

                    <!-- Nivel 2: Subcolumnas H / M / T -->
                    <tr class="bg-base-200/40 text-[11px] font-semibold text-base-content/70 border-b border-base-300">
                        <?php for ($i = 0; $i <= 3; $i++): ?>
                            <th class="px-1.5">H</th>
                            <th class="px-1.5">M</th>
                            <th class="px-1.5 border-r border-base-300 bg-base-200/60 text-base-content font-bold">T</th>
                        <?php endfor; ?>
                    </tr>
                </thead>

                <tbody>
                    <tr class="hover:bg-base-200/30 transition-colors text-xs sm:text-sm">
                        <?php
                            $coloresSubtotal = [
                                '0' => 'badge-ghost',
                                '1' => 'badge-info',
                                '2' => 'badge-secondary',
                                '3' => 'badge-success',
                            ];
                        ?>
                        <?php foreach (['0', '1', '2', '3'] as $anio): ?>
                            <td class="px-1.5 py-3 text-base-content/80">
                                <?= esc($preescolar[$anio]['H']) ?>
                            </td>
                            <td class="px-1.5 py-3 text-base-content/80">
                                <?= esc($preescolar[$anio]['M']) ?>
                            </td>
                            <td class="px-1.5 py-3 border-r border-base-200 bg-base-200/30">
                                <span class="badge <?= $coloresSubtotal[$anio] ?> badge-sm font-bold">
                                    <?= esc($preescolar[$anio]['T']) ?>
                                </span>
                            </td>
                        <?php endforeach; ?>

                        <!-- Total General de 1° Grado -->
                        <td class="px-3 py-3 bg-primary/10">
                            <span class="badge badge-primary badge-md font-extrabold">
                                <?= esc($preescolar['total_general']) ?>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pie sutil informativo -->
        <div class="mt-3 flex justify-between items-center text-[11px] text-base-content/50">
            <span>Contabiliza únicamente alumnos vigentes (sin baja)</span>
            <span>H = Hombres · M = Mujeres · T = Total</span>
        </div>

    </div>
</div>





<!-- Resumen Estadístico de Existencia por Grupo (Diseño Moderno) -->
<div class="card bg-base-100 shadow-sm border border-base-200 mb-6">
    <div class="card-body p-5 sm:p-6 flex flex-col justify-between">
        
        <!-- Encabezado de la tarjeta -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4">
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="card-title text-base sm:text-lg font-bold text-base-content">
                        Existencia por Grado y Grupo
                    </h2>
                    <span class="badge badge-primary badge-sm font-semibold">Ciclo Actual</span>
                </div>
                <p class="text-xs text-base-content/60 mt-0.5">
                    Matrícula vigente por salón (excluye bajas con movimiento <strong>"B"</strong>)
                </p>
            </div>
        </div>

        <!-- Tabla moderna -->
        <div class="overflow-x-auto rounded-xl border border-base-200 my-auto">
            <table class="table table-xs sm:table-sm text-center tabular-nums">
                <thead>
                    <tr class="bg-base-200/80 text-base-content text-xs uppercase tracking-wider border-b border-base-300">
                        <th class="py-2.5 border-r border-base-300">Grado</th>
                        <th class="py-2.5 border-r border-base-300">Grupo</th>
                        <th class="py-2.5">
                            <span class="inline-flex items-center gap-1.5 text-info">
                                <span class="w-2 h-2 rounded-full bg-info"></span> Hombres
                            </span>
                        </th>
                        <th class="py-2.5 border-r border-base-300">
                            <span class="inline-flex items-center gap-1.5 text-secondary">
                                <span class="w-2 h-2 rounded-full bg-secondary"></span> Mujeres
                            </span>
                        </th>
                        <th class="py-2.5 bg-primary/10 text-primary font-bold">Total Grupo</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-base-200">
                    <?php if (!empty($resumen_grupos)): ?>
                        <?php foreach ($resumen_grupos as $grupo): ?>
                            <tr class="hover:bg-base-200/40 transition-colors text-xs sm:text-sm">
                                <td class="border-r border-base-200 font-bold">
                                    <span class="badge badge-ghost badge-sm font-bold"><?= esc($grupo->grado) ?>°</span>
                                </td>
                                <td class="border-r border-base-200">
                                    <span class="badge badge-outline badge-sm font-semibold"><?= esc($grupo->grupo) ?></span>
                                </td>
                                <td class="text-base-content/80 font-medium"><?= esc($grupo->hombres) ?></td>
                                <td class="border-r border-base-200 text-base-content/80 font-medium"><?= esc($grupo->mujeres) ?></td>
                                <td class="bg-primary/5 font-bold">
                                    <span class="badge badge-primary badge-soft badge-sm font-bold text-primary">
                                        <?= esc($grupo->total) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-base-content/60 py-6">
                                No hay alumnos activos registrados en ningún grupo
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

                <?php if (!empty($resumen_grupos)): ?>
                    <tfoot class="bg-base-200/90 border-t-2 border-base-300 font-bold text-base-content text-xs sm:text-sm">
                        <tr>
                            <td colspan="2" class="text-right uppercase text-xs tracking-wider border-r border-base-300">
                                Total General
                            </td>
                            <td class="text-info"><?= esc($totales_existencia['hombres']) ?></td>
                            <td class="border-r border-base-300 text-secondary"><?= esc($totales_existencia['mujeres']) ?></td>
                            <td class="bg-primary/15">
                                <span class="badge badge-primary badge-md font-extrabold">
                                    <?= esc($totales_existencia['total']) ?>
                                </span>
                            </td>
                        </tr>
                    </tfoot>
                <?php endif; ?>
            </table>
        </div>

        <!-- Pie informativo -->
        <div class="mt-3 flex justify-between items-center text-[11px] text-base-content/50">
            <span>Ordenado ascendentemente por grado y grupo</span>
            <span><?= count($resumen_grupos) ?> grupos activos</span>
        </div>

    </div>
</div>





<!-- Fila 3: Tablas de Acción Rápida -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
    
    <!-- Tabla 1: Últimos Alumnos Registrados -->
    <div class="card bg-base-100 shadow">
        <div class="card-body">
            <div class="flex justify-between items-center mb-2">
                <h2 class="card-title text-base">Últimos Alumnos Registrados</h2>
                <a href="<?= site_url('inscripciones') ?>" class="btn btn-primary btn-xs">+ Inscribir</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="table table-zebra table-sm">
                    <thead>
                        <tr>
                            <th>Alumno</th>
                            <th>CURP</th>
                            <th>Grado/Grupo</th>
                            <th>Origen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ultimos_alumnos)): ?>
                            <?php foreach ($ultimos_alumnos as $alumno): ?>
                                <tr>
                                    <td class="font-medium">
                                        <?= esc($alumno->nombre_alumno . ' ' . $alumno->primer_apellido_alumno . ' ' . $alumno->segundo_apellido_alumno) ?>
                                    </td>
                                    <td class="font-mono text-xs"><?= esc($alumno->curp) ?></td>
                                    <td>
                                        <span class="badge badge-outline badge-sm">
                                            <?= esc($alumno->grado . '° ' . $alumno->grupo) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                            $badgeOrigen = match($alumno->origen) {
                                                'SA' => 'badge-info',
                                                'NI' => 'badge-success',
                                                default => 'badge-ghost',
                                            };
                                        ?>
                                        <span class="badge <?= $badgeOrigen ?> badge-xs"><?= esc($alumno->origen) ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center text-base-content/60 py-4">No hay alumnos registrados aún</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tabla 2: Tutores con Restricción para Recoger Alumno -->
    <div class="card bg-base-100 shadow">
        <div class="card-body">
            <div class="flex justify-between items-center mb-2">
                <h2 class="card-title text-base">Aviso: Tutores No Autorizados a Recoger</h2>
                <span class="badge badge-warning badge-sm">Seguridad</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="table table-zebra table-sm">
                    <thead>
                        <tr>
                            <th>Alumno</th>
                            <th>Grado</th>
                            <th>Tutor Registrado</th>
                            <th>Parentesco</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($alertas_tutores)): ?>
                            <?php foreach ($alertas_tutores as $alerta): ?>
                                <tr>
                                    <td class="font-medium">
                                        <?= esc($alerta->nombre_alumno . ' ' . $alerta->primer_apellido_alumno) ?>
                                    </td>
                                    <td><?= esc($alerta->grado . '° ' . $alerta->grupo) ?></td>
                                    <td><?= esc($alerta->nombre_tutor . ' ' . $alerta->primer_apellido_tutor) ?></td>
                                    <td><span class="badge badge-error badge-outline badge-xs"><?= esc($alerta->parentesco_tutor) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center text-base-content/60 py-4">Todos los tutores principales tienen autorización</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
