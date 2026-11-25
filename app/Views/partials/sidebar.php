<div class="drawer-side z-20">
    <label for="sidebar-drawer" aria-label="cerrar menú" class="drawer-overlay"></label>
    <aside class="bg-neutral text-neutral-content w-64 min-h-full flex flex-col">
        <div class="p-5 text-xl font-bold border-b border-neutral-focus flex items-center gap-2">
            <span>🎓 Control Escolar</span>
        </div>

        <ul class="menu p-4 w-full flex-1 gap-1">
            <?php //if (session('rol') === 'direccion'): ?>
                <li class="menu-title text-neutral-content/60">Administración</li>
                <li><a href="<?= site_url('direccion/panel') ?>" class="active">Dashboard</a></li>
                <li><a href="<?= site_url('direccion/alumnos') ?>">Búsqueda de alumnos inscritos</a></li>
                <li><a href="<?= site_url('direccion/alumnos/por-grupo') ?>">Listas por Grupo</a></li>
                <li><a href="<?= site_url('direccion/tutores') ?>">Directorio de Tutores</a></li>
                <li><a href="<?= site_url('direccion/calificaciones') ?>">Calificaciones</a></li>
                <li class="menu-title text-neutral-content/60 mt-4">Procesos</li>
                <li><a href="<?= site_url('direccion/alumnos-base/nuevo') ?>">Nueva Inscripción</a></li>
                <li><a href="<?= site_url('direccion/alumnos-base') ?>">Alumnos autorizados</a></li>
                <li><a href="<?= site_url('direccion/alumnos-base/por-grupo') ?>">Alumnos autorizados por grupo</a></li>
                <li><a href="<?= site_url('direccion/alumnos-base/estadistica') ?>">Estadística de alumnos autorizados</a></li>
            <?php //elseif (session('rol') === 'docente'): ?>
                <li class="menu-title text-neutral-content/60">Docencia</li>
                <li><a href="<?= site_url('docentes/panel') ?>">Mi Panel</a></li>
                <li><a href="<?= site_url('docentes/calificaciones') ?>">Capturar Calificaciones</a></li>
            <?php //endif; ?>
        </ul>
    </aside>
</div>
