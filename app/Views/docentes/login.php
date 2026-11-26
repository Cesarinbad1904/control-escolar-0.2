<!DOCTYPE html>
<html lang="es" data-theme="emerald"> <!-- emerald corporate winter cupcake pastel  dim nigth -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Docentes | Control Escolar</title>
    <!-- Ajusta la ruta de tu CSS compilado de Tailwind + DaisyUI si tiene otro nombre -->
    <link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet">
</head>
<body class="min-h-screen bg-base-200 flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <!-- Tarjeta de Login -->
        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body p-8">
                
                <!-- Encabezado e Ícono -->
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-primary/10 text-primary mb-3">
                        <svg xmlns="http://w3.org" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-base-content">Portal Docentes</h1>
                    <p class="text-sm text-base-content/60 mt-1">Ingresa tus credenciales para gestionar tu grupo</p>
                </div>

                <!-- Alertas -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div role="alert" class="alert alert-error text-sm py-3 mb-4">
                        <svg xmlns="http://w3.org" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span><?= esc(session()->getFlashdata('error')) ?></span>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div role="alert" class="alert alert-success text-sm py-3 mb-4">
                        <svg xmlns="http://w3.org" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span><?= esc(session()->getFlashdata('success')) ?></span>
                    </div>
                <?php endif; ?>

                <!-- Formulario -->
                <form action="<?= base_url('docentes/autenticar') ?>" method="post" class="space-y-4">
                    <?= csrf_field() ?>

                    <div class="form-control">
                        <label class="label" for="usuario">
                            <span class="label-text font-semibold">Usuario</span>
                        </label>
                        <label class="input input-bordered flex items-center gap-2 focus-within:input-primary">
                            <svg xmlns="http://w3.org" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-60">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
                            </svg>
                            <input 
                                type="text" 
                                id="usuario" 
                                name="usuario" 
                                value="<?= old('usuario') ?>"
                                placeholder="Ej. docente1a" 
                                class="grow" 
                                required 
                                autofocus
                            />
                        </label>
                    </div>

                    <div class="form-control">
                        <label class="label" for="password">
                            <span class="label-text font-semibold">Contraseña</span>
                        </label>
                        <label class="input input-bordered flex items-center gap-2 focus-within:input-primary">
                            <svg xmlns="http://w3.org" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-60">
                                <path fill-rule="evenodd" d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z" clip-rule="evenodd" />
                            </svg>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="••••••••" 
                                class="grow" 
                                required 
                            />
                            <button type="button" onclick="togglePassword()" class="btn btn-ghost btn-xs text-base-content/60" title="Mostrar/Ocultar contraseña">
                                <svg id="icon_eye" xmlns="http://w3.org" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn btn-primary w-full text-base">
                            Iniciar Sesión
                        </button>
                    </div>
                </form>

                <div class="divider text-xs text-base-content/40 my-4">Acceso exclusivo personal docente</div>

                <div class="text-center">
                    <a href="<?= base_url('/') ?>" class="link link-hover text-xs text-base-content/60">
                        ← Volver al inicio
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = (input.type === 'password') ? 'text' : 'password';
        }
    </script>
</body>
</html>
