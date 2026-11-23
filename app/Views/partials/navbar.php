<header class="navbar bg-base-100 shadow-sm px-4 lg:px-6 sticky top-0 z-10">
    <div class="flex-none lg:hidden">
        <label for="sidebar-drawer" aria-label="abrir menú" class="btn btn-square btn-ghost">
            <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </label>
    </div>
    
    <div class="flex-1">
        <h1 class="text-lg font-bold text-base-content"><?= esc($titulo ?? 'Panel') ?></h1>
    </div>

    <div class="flex-none gap-3">
        <span class="badge badge-ghost hidden sm:inline-flex">
            <?= esc(session('nombre_usuario') ?? 'Dirección Escolar') ?>
        </span>
        <a href="<?= site_url('logout') ?>" class="btn btn-outline btn-error btn-sm">Salir</a>
    </div>
</header>
