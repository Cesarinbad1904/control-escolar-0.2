<?= $this->extend('layouts/docente') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-6 max-w-6xl space-y-6">

    <!-- Banner de Bienvenida -->
    <div class="card bg-base-100 shadow-sm border border-base-200">
        <div class="card-body p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex flex-wrap items-center gap-2 mb-1">
                    <span class="badge badge-primary badge-outline font-semibold text-xs">
                        Ciclo Escolar <?= esc($escuela->ciclo_escolar ?? 'Actual') ?>
                    </span>
                    <?php if (!empty($escuela->nombre)): ?>
                        <span class="text-xs text-base-content/60 font-medium"><?= esc($escuela->nombre) ?></span>
                    <?php endif; ?>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold text-base-content">
                    Bienvenido(a), <?= esc(session()->get('docente_nombre')) ?>
                </h1>
                <p class="text-sm text-base-content/70 mt-1">
                    Estás gestionando el grupo <strong class="text-primary"><?= esc($grado) ?>° "<?= esc($grupo) ?>"</strong>
                    <?php if (session()->get('docente_salon')): ?>
                        • Salón <strong><?= esc(session()->get('docente_salon')) ?></strong>
                    <?php endif; ?>
                </p>
            </div>

            <div class="flex-shrink-0">
                <a href="<?= base_url('docentes/calificaciones') ?>" class="btn btn-primary gap-2">
                    <svg xmlns="http://w3.org" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Capturar Calificaciones
                </a>
            </div>
        </div>
    </div>

    <!-- Tarjetas de Estadísticas del Grupo -->
    <div class="stats stats-vertical md:stats-horizontal shadow-sm border border-base-200 bg-base-100 w-full">
        
        <div class="stat">
            <div class="stat-figure text-primary">
                <svg xmlns="http://w3.org" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div class="stat-title font-medium">Total Inscritos</div>
            <div class="stat-value text-primary"><?= $totalAlumnos ?></div>
            <div class="stat-desc">Alumnos activos en <?= esc($grado) ?>° "<?= esc($grupo) ?>"</div>
        </div>

        <div class="stat">
            <div class="stat-figure text-info">
                <div class="badge badge-info badge-outline font-bold p-3">H</div>
            </div>
            <div class="stat-title font-medium">Hombres</div>
            <div class="stat-value text-info"><?= $totalHombres ?></div>
            <div class="stat-desc">
                <?= $totalAlumnos > 0 ? round(($totalHombres / $totalAlumnos) * 100) : 0 ?>% del grupo
            </div>
        </div>

        <div class="stat">
            <div class="stat-figure text-secondary">
                <div class="badge badge-secondary badge-outline font-bold p-3">M</div>
            </div>
            <div class="stat-title font-medium">Mujeres</div>
            <div class="stat-value text-secondary"><?= $totalMujeres ?></div>
            <div class="stat-desc">
                <?= $totalAlumnos > 0 ? round(($totalMujeres / $totalAlumnos) * 100) : 0 ?>% del grupo
            </div>
        </div>

        <div class="stat">
            <div class="stat-figure text-warning">
                <svg xmlns="http://w3.org" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="stat-title font-medium">Pendientes de Registro</div>
            <div class="stat-value text-warning"><?= $pendientesRegistro ?></div>
            <div class="stat-desc">Autorizados sin ficha completa</div>
        </div>

    </div>

    <!-- Accesos Directos -->
    <div>
        <h2 class="text-base font-bold text-base-content mb-3">Herramientas de Gestión</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            
            <!-- Card 1: Lista de Grupo -->
            <a href="<?= base_url('docentes/mi-grupo') ?>" class="card bg-base-100 shadow-sm border border-base-200 hover:border-primary transition-all">
                <div class="card-body p-5">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="p-2.5 bg-info/10 text-info rounded-lg">
                            <svg xmlns="http://w3.org" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="card-title text-base">Directorio de Mi Grupo</h3>
                    </div>
                    <p class="text-xs text-base-content/70">
                        Consulta datos de contacto de tutores, teléfonos de emergencia, CURP e imprime listas de asistencia.
                    </p>
                </div>
            </a>

            <!-- Card 2: Calificaciones -->
            <a href="<?= base_url('docentes/calificaciones') ?>" class="card bg-base-100 shadow-sm border border-base-200 hover:border-primary transition-all">
                <div class="card-body p-5">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="p-2.5 bg-success/10 text-success rounded-lg">
                            <svg xmlns="http://w3.org" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="card-title text-base">Captura de Calificaciones</h3>
                    </div>
                    <p class="text-xs text-base-content/70">
                        Registra evaluaciones e inasistencias de los cuatro campos formativos por trimestre.
                    </p>
                </div>
            </a>

            <!-- Card 3: Perfil y Contraseña -->
            <a href="<?= base_url('docentes/mi-perfil') ?>" class="card bg-base-100 shadow-sm border border-base-200 hover:border-primary transition-all">
                <div class="card-body p-5">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="p-2.5 bg-warning/10 text-warning rounded-lg">
                            <svg xmlns="http://w3.org" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                        </div>
                        <h3 class="card-title text-base">Mis Datos y Contraseña</h3>
                    </div>
                    <p class="text-xs text-base-content/70">
                        Revisa tu expediente profesional registrado en la escuela y actualiza tu contraseña de acceso.
                    </p>
                </div>
            </a>

        </div>
    </div>

</div>
<?= $this->endSection() ?>
