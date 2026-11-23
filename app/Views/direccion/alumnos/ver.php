<?= $this->extend('layouts/main') ?>

<?= $this->section('contenido') ?>

<?php
    $nombreCompleto = "{$alumno->nombre_alumno} {$alumno->primer_apellido_alumno} {$alumno->segundo_apellido_alumno}";
    $esBaja = ($alumno->mov_f === 'B');
    $esAlta = (!$esBaja && $alumno->mov_i === 'A');
?>

<!-- Barra Superior de Navegación e Impresión (Oculta al imprimir) -->
<div class="flex flex-wrap justify-between items-center gap-3 mb-6 print:hidden">
    <a href="<?= site_url('direccion/alumnos') ?>" class="btn btn-ghost btn-sm gap-2">
        ← Volver al Directorio
    </a>
    <button type="button" onclick="window.print()" class="btn btn-primary btn-sm gap-2">
        🖨️ Imprimir Expediente
    </button>
</div>

<!-- Encabezado Principal del Expediente -->
<div class="card bg-base-100 shadow-sm border border-base-200 mb-6">
    <div class="card-body p-5 sm:p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-base-200 pb-4">
            <div class="flex items-center gap-4">
                <div class="avatar placeholder">
                    <div class="bg-primary text-primary-content rounded-full w-14 text-xl font-bold">
                        <span><?= esc(mb_substr($alumno->nombre_alumno, 0, 1) . mb_substr($alumno->primer_apellido_alumno, 0, 1)) ?></span>
                    </div>
                </div>
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-base-content"><?= esc($nombreCompleto) ?></h2>
                    <p class="text-xs text-base-content/60 font-mono mt-0.5">CURP: <?= esc($alumno->curp) ?></p>
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                <span class="badge badge-info badge-lg font-bold"><?= esc($alumno->grado) ?>° <?= esc($alumno->grupo) ?></span>
                <?php if ($esBaja): ?>
                    <span class="badge badge-error badge-lg text-white font-semibold">Baja (<?= esc($alumno->fecha_baja) ?>)</span>
                <?php elseif ($esAlta): ?>
                    <span class="badge badge-info badge-lg text-white font-semibold">Alta (<?= esc($alumno->fecha_alta) ?>)</span>
                <?php else: ?>
                    <span class="badge badge-success badge-lg text-white font-semibold">Inscripción Activa</span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Resumen Rápido -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4 text-xs">
            <div>
                <span class="text-base-content/60 block">Fecha de Nacimiento</span>
                <span class="font-bold text-sm"><?= esc($alumno->fec_nac_alumno) ?></span>
            </div>
            <div>
                <span class="text-base-content/60 block">Sexo / Nacionalidad</span>
                <span class="font-bold text-sm"><?= esc($alumno->sexo_alumno) ?> · <?= esc($alumno->nacionalidad_alumno) ?></span>
            </div>
            <div>
                <span class="text-base-content/60 block">Teléfono Emergencia</span>
                <span class="font-bold text-sm text-error"><?= esc($alumno->telefono_emer) ?></span>
            </div>
            <div>
                <span class="text-base-content/60 block">Tipo de Sangre</span>
                <span class="badge badge-error badge-outline font-bold mt-0.5"><?= esc($historial->tipo_sangre ?? 'Sin registro') ?></span>
            </div>
        </div>
    </div>
</div>

<!-- Grid Principal: 2 Columnas en Escritorio -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    <!-- Bloque 1: Domicilio y Contacto -->
    <div class="card bg-base-100 shadow-sm border border-base-200">
        <div class="card-body p-5">
            <h3 class="card-title text-base border-b border-base-200 pb-2">📍 Domicilio y Contacto</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs mt-2">
                <div class="sm:col-span-2">
                    <span class="text-base-content/60 block">Calle y Número</span>
                    <span class="font-semibold"><?= esc($alumno->calle_num_dom) ?></span>
                </div>
                <div>
                    <span class="text-base-content/60 block">Colonia / Localidad</span>
                    <span class="font-semibold"><?= esc($alumno->colonia_dom) ?>, <?= esc($alumno->localidad_dom) ?></span>
                </div>
                <div>
                    <span class="text-base-content/60 block">Municipio / Entidad / CP</span>
                    <span class="font-semibold"><?= esc($alumno->municipio_dom) ?>, <?= esc($alumno->entidad_dom) ?> (CP <?= esc($alumno->cp) ?>)</span>
                </div>
                <div class="sm:col-span-2">
                    <span class="text-base-content/60 block">Entre Calles y Referencia</span>
                    <span class="font-semibold">Entre <?= esc($alumno->entre_calle_1) ?> y <?= esc($alumno->entre_calle_2) ?>. Ref: <?= esc($alumno->referencia_dom) ?></span>
                </div>
                <div>
                    <span class="text-base-content/60 block">Teléfonos (1 y 2)</span>
                    <span class="font-semibold"><?= esc($alumno->telefono_1) ?> / <?= esc($alumno->telefono_2) ?></span>
                </div>
                <div>
                    <span class="text-base-content/60 block">Correo y Red Social</span>
                    <span class="font-semibold"><?= esc($alumno->email_alumno) ?> (<?= esc($alumno->rs_alumno) ?>: <?= esc($alumno->rs_user_alumno) ?>)</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bloque 2: Datos Académicos, Familiares y Apoyos Tecnológicos -->
    <div class="card bg-base-100 shadow-sm border border-base-200">
        <div class="card-body p-5">
            <h3 class="card-title text-base border-b border-base-200 pb-2">🎓 Antecedentes y Entorno Familiar</h3>
            <div class="grid grid-cols-2 gap-3 text-xs mt-2">
                <div class="col-span-2">
                    <span class="text-base-content/60 block">Escuela de Procedencia (CCT)</span>
                    <span class="font-semibold"><?= esc($alumno->nombre_escuela_procedencia) ?> <?= $alumno->cct_anterior ? '(' . esc($alumno->cct_anterior) . ')' : '' ?></span>
                </div>
                <div>
                    <span class="text-base-content/60 block">Años Preescolar / Origen</span>
                    <span class="font-semibold"><?= esc($alumno->anios_prescolar) ?> años · Origen: <?= esc($alumno->origen) ?></span>
                </div>
                <div>
                    <span class="text-base-content/60 block">Situación Reprobado</span>
                    <span class="font-semibold"><?= esc($alumno->reprobado) ?></span>
                </div>
                <div>
                    <span class="text-base-content/60 block">Vive con / Sostén Económico</span>
                    <span class="font-semibold"><?= esc($alumno->vive_con) ?> / <?= esc($alumno->sosten_econ) ?> (<?= esc($alumno->num_personas) ?> personas en hogar)</span>
                </div>
            </div>

            <div class="divider my-2 text-xs text-base-content/60">Apoyos Tecnológicos en Casa</div>
            <div class="flex flex-wrap gap-1.5">
                <?php
                    $tecnologias = [
                        'computadora'    => 'Computadora',
                        'tablet'         => 'Tablet',
                        'internet_casa'  => 'Internet Casa',
                        'internet_movil' => 'Internet Móvil',
                        'tv_paga'        => 'TV Paga',
                        'tv_abierta'     => 'TV Abierta',
                        'radio'          => 'Radio',
                    ];
                ?>
                <?php foreach ($tecnologias as $campo => $etiqueta): ?>
                    <?php $tiene = ($alumno->$campo === 'SI'); ?>
                    <span class="badge badge-sm <?= $tiene ? 'badge-success text-white' : 'badge-ghost opacity-50' ?>">
                        <?= $tiene ? '✓' : '✕' ?> <?= $etiqueta ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>

<!-- Bloque 3: Tutores Registrados -->
<div class="card bg-base-100 shadow-sm border border-base-200 mb-6">
    <div class="card-body p-5">
        <div class="flex flex-wrap justify-between items-center border-b border-base-200 pb-2 gap-2">
            <h3 class="card-title text-base">👨‍👩‍👦 Tutores Registrados</h3>
            <?php if ($tutor): ?>
                <div class="flex gap-2">
                    <span class="badge badge-sm <?= $tutor->responsabilidad === 'SI' ? 'badge-info' : 'badge-warning' ?>">
                        Responsabilidad: <?= esc($tutor->responsabilidad) ?>
                    </span>
                    <span class="badge badge-sm <?= $tutor->recoge === 'SI' ? 'badge-success text-white' : 'badge-error text-white' ?>">
                        Autorizado a recoger: <?= esc($tutor->recoge) ?>
                    </span>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($tutor): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-3 text-xs">
                <!-- Tutor 1 -->
                <div class="bg-base-200/50 p-4 rounded-xl border border-base-200 space-y-1.5">
                    <div class="font-bold text-sm text-primary">1. <?= esc("{$tutor->nombre_tutor} {$tutor->primer_apellido_tutor} {$tutor->segundo_apellido_tutor}") ?></div>
                    <div><span class="text-base-content/60">Parentesco:</span> <strong><?= esc($tutor->parentesco_tutor) ?></strong> · CURP: <span class="font-mono"><?= esc($tutor->curp_tutor) ?></span></div>
                    <div><span class="text-base-content/60">Ocupación / Estudios:</span> <?= esc($tutor->ocupacion_tutor) ?> · <?= esc($tutor->estudios_tutor) ?></div>
                    <div><span class="text-base-content/60">Estado Civil / Ingreso:</span> <?= esc($tutor->estado_civil_tutor) ?> · <?= esc($tutor->salario_tutor) ?></div>
                    <div><span class="text-base-content/60">Contacto:</span> <?= esc($tutor->email_tutor) ?> (<?= esc($tutor->rs_tutor) ?>: <?= esc($tutor->rs_user_tutor) ?>)</div>
                </div>

                <!-- Tutor 2 -->
                <div class="bg-base-200/50 p-4 rounded-xl border border-base-200 space-y-1.5">
                    <div class="font-bold text-sm text-secondary">2. <?= esc("{$tutor->nombre_tutor2} {$tutor->primer_apellido_tutor2} {$tutor->segundo_apellido_tutor2}") ?></div>
                    <div><span class="text-base-content/60">Parentesco:</span> <strong><?= esc($tutor->parentesco_tutor2) ?></strong> · CURP: <span class="font-mono"><?= esc($tutor->curp_tutor2) ?></span></div>
                    <div><span class="text-base-content/60">Ocupación / Estudios:</span> <?= esc($tutor->ocupacion_tutor2) ?> · <?= esc($tutor->estudios_tutor2) ?></div>
                    <div><span class="text-base-content/60">Estado Civil / Ingreso:</span> <?= esc($tutor->estado_civil_tutor2) ?> · <?= esc($tutor->salario_tutor2) ?></div>
                    <div><span class="text-base-content/60">Contacto:</span> <?= esc($tutor->email_tutor2) ?> (<?= esc($tutor->rs_tutor2) ?>: <?= esc($tutor->rs_user_tutor2) ?>)</div>
                </div>
            </div>
        <?php else: ?>
            <p class="text-xs text-base-content/60 py-4">No hay datos de tutores vinculados a este alumno.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Bloque 4: Historial Médico y Salud -->
<div class="card bg-base-100 shadow-sm border border-base-200 mb-6">
    <div class="card-body p-5">
        <h3 class="card-title text-base border-b border-base-200 pb-2 text-error">🩺 Historial Médico y Salud</h3>

        <?php if ($historial): ?>
            <!-- Somatometría y Datos Generales de Salud -->
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 bg-base-200/50 p-3 rounded-xl text-xs mt-2">
                <div><span class="text-base-content/60 block">Estatura / Peso</span><strong><?= esc($historial->estatura) ?> m · <?= esc($historial->peso) ?> kg</strong></div>
                <div><span class="text-base-content/60 block">Tipo de Sangre</span><strong class="text-error"><?= esc($historial->tipo_sangre) ?></strong></div>
                <div><span class="text-base-content/60 block">Lentes / Zapato Ort.</span><strong>Lentes: <?= esc($historial->lentes) ?> · Ort: <?= esc($historial->zapato_orto) ?></strong></div>
                <div><span class="text-base-content/60 block">Vacunas / COVID</span><strong>Vac: <?= esc($historial->vacunas) ?> · COVID: <?= esc($historial->covid) ?> (<?= esc($historial->covid_dosis) ?>)</strong></div>
                <div><span class="text-base-content/60 block">Institución / Médico</span><strong><?= esc($historial->institucion_dh) ?> (<?= esc($historial->tel_medico) ?>)</strong></div>
            </div>

            <!-- Alertas Críticas y Observaciones -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 text-xs">
                <div class="border border-error/30 bg-error/5 rounded-xl p-3 space-y-1.5">
                    <div class="font-bold text-error uppercase tracking-wider">Alertas Médicas y Alergias</div>
                    <div><span class="font-semibold">Alergia a Medicamentos:</span> <?= esc($historial->alergia_medicamento ?: 'NINGUNA') ?></div>
                    <div><span class="font-semibold">Alergia a Alimentos:</span> <?= esc($historial->alergia_alimento ?: 'NINGUNA') ?></div>
                    <div><span class="font-semibold">Discapacidad / Impedimento:</span> <?= esc($historial->discapacidad ?: 'NINGUNA') ?> · <?= esc($historial->impedimento ?: 'SIN IMPEDIMENTO') ?></div>
                    <div><span class="font-semibold">Enfermedad Crónica:</span> <?= esc($historial->enfermedad_cronica ?: 'NINGUNA') ?></div>
                </div>

                <div class="border border-base-300 rounded-xl p-3 space-y-1.5">
                    <div class="font-bold uppercase tracking-wider text-base-content/80">Observaciones y Antecedentes</div>
                    <div><span class="font-semibold">Médico Tratante:</span> <?= esc($historial->nombre_medico ?: 'N/A') ?></div>
                    <div><span class="font-semibold">Recomendaciones:</span> <?= esc($historial->recomendaciones ?: 'SIN RECOMENDACIONES ESPECIALES') ?></div>
                    <div><span class="font-semibold">Intervención Quirúrgica / Transfusión:</span> <?= esc($historial->intervencion_quirurgica ?: 'NO') ?> · Transfusión: <?= esc($historial->transfusion) ?></div>
                    <div><span class="font-semibold">Apoyos:</span> <?= esc(implode(', ', array_filter([$historial->apoyo_1, $historial->apoyo_2, $historial->apoyo_3, $historial->apoyo_4, $historial->apoyo_5, $historial->otro_apoyo])) ?: 'NINGUNO') ?></div>
                </div>
            </div>

            <!-- Padecimientos Reportados con "SI" -->
            <?php
                $padecimientos = [
                    'sobrepeso' => 'Sobrepeso', 'corazon' => 'Corazón', 'bronquitis' => 'Bronquitis',
                    'hemorragias' => 'Hemorragias', 'epilepsia' => 'Epilepsia', 'fiebre_reumatica' => 'Fiebre Reumática',
                    'cancer' => 'Cáncer', 'diabetes' => 'Diabetes', 'amigdalitis' => 'Amigdalitis',
                    'anemia' => 'Anemia', 'hepatitis' => 'Hepatitis', 'neoplasias' => 'Neoplasias',
                    'dificultad_dormir' => 'Dificultad p/ dormir', 'fiebre_frecuente' => 'Fiebre frecuente',
                    'falta_aire' => 'Falta de aire', 'dolor_piernas' => 'Dolor de piernas',
                    'desmayos_frecuentes' => 'Desmayos frecuentes', 'hemorragias_frecuentes' => 'Hemorragias frecuentes',
                ];
                $activos = [];
                foreach ($padecimientos as $campo => $nombrePad) {
                    if (isset($historial->$campo) && strtoupper((string) $historial->$campo) === 'SI') {
                        $activos[] = $nombrePad;
                    }
                }
            ?>
            <div class="mt-4 text-xs">
                <span class="font-semibold block mb-1.5">Padecimientos o Síntomas Reportados (SI):</span>
                <?php if (!empty($activos)): ?>
                    <div class="flex flex-wrap gap-1.5">
                        <?php foreach ($activos as $item): ?>
                            <span class="badge badge-warning badge-sm font-semibold"><?= esc($item) ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <span class="text-base-content/60">Ningún padecimiento clínico reportado con "SI".</span>
                <?php endif; ?>
            </div>

            <!-- Antecedentes Familiares -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 mt-4 pt-3 border-t border-base-200 text-xs">
                <div><span class="text-base-content/60 block">Fam. Diabetes</span><strong><?= esc($historial->familiar_diabetes ?: 'NO') ?></strong></div>
                <div><span class="text-base-content/60 block">Fam. Corazón</span><strong><?= esc($historial->familiar_corazon ?: 'NO') ?></strong></div>
                <div><span class="text-base-content/60 block">Fam. Hipertensión</span><strong><?= esc($historial->familiar_hipertension ?: 'NO') ?></strong></div>
                <div><span class="text-base-content/60 block">Fam. Cáncer</span><strong><?= esc($historial->familiar_cancer ?: 'NO') ?></strong></div>
            </div>
        <?php else: ?>
            <p class="text-xs text-base-content/60 py-4">Este alumno aún no tiene un historial médico registrado.</p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
