<!DOCTYPE html>
<html lang="es" data-theme="emerald"> <!-- emerald corporate winter cupcake pastel  dim nigth -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($titulo ?? 'Portal Docentes') ?> | Control Escolar</title>
    <link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet">
</head>
<body class="bg-base-200/60 min-h-screen">

    <div class="drawer lg:drawer-open">
        <input id="drawer-docente" type="checkbox" class="drawer-toggle" />
        
        <!-- Contenido Principal -->
        <div class="drawer-content flex flex-col">
            
            <!-- Barra Superior (Navbar) -->
            <header class="navbar bg-base-100 border-b border-base-200 px-4 lg:px-6 sticky top-0 z-20 print:hidden">
                <div class="flex-none lg:hidden">
                    <label for="drawer-docente" aria-label="abrir menú" class="btn btn-square btn-ghost">
                        <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>

                <div class="flex-1">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-base-content text-sm sm:text-base">Portal Docente</span>
                        <span class="badge badge-primary font-bold">
                            Grupo <?= esc(session()->get('docente_grado')) ?>° "<?= esc(session()->get('docente_grupo')) ?>"
                        </span>
                    </div>
                </div>

                <div class="flex-none gap-3">
                    <div class="hidden sm:block text-right">
                        <p class="text-xs font-bold text-base-content leading-tight"><?= esc(session()->get('docente_nombre')) ?></p>
                        <p class="text-[11px] text-base-content/60">Salón: <?= esc(session()->get('docente_salon') ?: 'N/A') ?></p>
                    </div>
                    <a href="<?= base_url('docentes/logout') ?>" class="btn btn-sm btn-outline btn-error gap-1.5" title="Cerrar sesión">
                        <svg xmlns="http://w3.org" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="hidden md:inline">Salir</span>
                    </a>
                </div>
            </header>

            <!-- Área Dinámica de Vistas -->
            <main class="flex-1">
                <?= $this->renderSection('content') ?>
            </main>
        </div>

        <!-- Menú Lateral (Sidebar) -->
        <aside class="drawer-side z-30 print:hidden">
            <label for="drawer-docente" aria-label="cerrar menú" class="drawer-overlay"></label>
            <div class="menu p-4 w-64 min-h-full bg-base-100 border-r border-base-200 text-base-content flex flex-col justify-between">
                
                <div>
                    <!-- Identidad del Módulo -->
                    <div class="flex items-center gap-3 px-2 py-3 mb-4 border-b border-base-200">
                        <div class="p-2 bg-primary text-primary-content rounded-lg">
                            <svg xmlns="http://w3.org" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-sm leading-tight">Control Escolar</p>
                            <p class="text-xs text-primary font-semibold">Espacio Docente</p>
                        </div>
                    </div>

                    <!-- Enlaces de Navegación -->
                    <ul class="space-y-1 font-medium text-sm">
                        <li>
                            <a href="<?= base_url('docentes/panel') ?>" class="<?= uri_string() === 'docentes/panel' ? 'active' : '' ?>">
                                <svg xmlns="http://w3.org" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Inicio / Mi Panel
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('docentes/mi-grupo') ?>" class="<?= uri_string() === 'docentes/mi-grupo' ? 'active' : '' ?>">
                                <svg xmlns="http://w3.org" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Lista de Mi Grupo
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('docentes/calificaciones') ?>" class="<?= strpos(uri_string(), 'docentes/calificaciones') !== false ? 'active' : '' ?>">
                                <svg xmlns="http://w3.org" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                                Calificaciones
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('docentes/mi-perfil') ?>" class="<?= uri_string() === 'docentes/mi-perfil' ? 'active' : '' ?>">
                                <svg xmlns="http://w3.org" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Mis Datos / Contraseña
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Pie del Sidebar -->
                <div class="pt-4 border-t border-base-200 text-xs text-base-content/50 px-2">
                    <p>Grupo Asignado: <strong class="text-base-content"><?= esc(session()->get('docente_grado')) ?>° "<?= esc(session()->get('docente_grupo')) ?>"</strong></p>
                </div>
            </div>
        </aside>
    </div>

</body>
</html>
