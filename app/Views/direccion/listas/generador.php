<?= $this->extend('layouts/main') ?>

<?= $this->section('contenido') ?>
<div class="container mx-auto px-4 py-6">

    <!-- Encabezado (se oculta al imprimir) -->
    <div class="mb-6 print:hidden">
        <h1 class="text-2xl font-bold text-base-content">Generador de Listas Personalizadas</h1>
        <p class="text-sm text-base-content/70">Configura el formato de los nombres, elige las columnas requeridas y exporta o imprime la lista</p>
    </div>

    <!-- Paso 1: Selección de Grado y Grupo -->
    <div class="card bg-base-100 shadow-sm border border-base-200 mb-6 print:hidden">
        <div class="card-body p-5">
            <h2 class="text-sm font-bold uppercase tracking-wider text-primary mb-3">1. Selección de Grupo</h2>
            <form action="<?= base_url('direccion/listas/generador') ?>" method="get" class="flex flex-wrap items-end gap-4">
                <div class="form-control w-full sm:w-52">
                    <label class="label pt-0" for="grado">
                        <span class="label-text text-xs font-semibold">Grado</span>
                    </label>
                    <select id="grado" name="grado" class="select select-bordered select-sm h-10 w-full" required>
                        <option value="" disabled <?= empty($grado) ? 'selected' : '' ?>>Selecciona grado...</option>
                        <?php for ($g = 1; $g <= 6; $g++): ?>
                            <option value="<?= $g ?>" <?= (string)$grado === (string)$g ? 'selected' : '' ?>><?= $g ?>° Grado</option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="form-control w-full sm:w-52">
                    <label class="label pt-0" for="grupo">
                        <span class="label-text text-xs font-semibold">Grupo</span>
                    </label>
                    <select id="grupo" name="grupo" class="select select-bordered select-sm h-10 w-full" required>
                        <option value="" disabled <?= empty($grupo) ? 'selected' : '' ?>>Selecciona grupo...</option>
                        <?php foreach (['A', 'B', 'C', 'D'] as $grp): ?>
                            <option value="<?= $grp ?>" <?= $grupo === $grp ? 'selected' : '' ?>>Grupo <?= $grp ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-sm h-10 px-6 gap-2">
                    <svg xmlns="http://w3.org" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    Cargar Alumnos
                </button>
            </form>
        </div>
    </div>

    <?php if (!$busquedaRealizada): ?>
        <!-- Estado Inicial -->
        <div class="card bg-base-100 shadow-sm border border-base-200">
            <div class="card-body items-center text-center py-16">
                <svg xmlns="http://w3.org" class="h-14 w-14 text-base-content/30 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="font-bold text-lg">Selecciona un grado y grupo para comenzar</h3>
                <p class="text-sm text-base-content/60 max-w-md">Una vez cargados los alumnos podrás personalizar el formato de los nombres y elegir exactamente qué columnas mostrar.</p>
            </div>
        </div>

    <?php elseif (empty($alumnos)): ?>
        <!-- Sin resultados -->
        <div class="alert alert-warning shadow-sm">
            <span>No se encontraron alumnos inscritos activos en <strong><?= esc($grado) ?>° "<?= esc($grupo) ?>"</strong>.</span>
        </div>

    <?php else: ?>
        
            <!-- Paso 2: Panel de Personalización (Se oculta al imprimir) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6 print:hidden">
            
            <!-- Configuración de Formatos con Pestañas (Alumno / Tutor) -->
            <div class="card bg-base-100 shadow-sm border border-base-200 lg:col-span-5">
                <div class="card-body p-5">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-primary">2. Formato de Nombres</h2>
                        
                        <!-- Selector de Pestañas DaisyUI -->
                        <div role="tablist" class="tabs tabs-boxed tabs-xs bg-base-200">
                            <button type="button" role="tab" id="tab_alumno" class="tab tab-active font-semibold" onclick="cambiarTabFormato('alumno')">
                                Alumno
                            </button>
                            <button type="button" role="tab" id="tab_tutor" class="tab font-semibold" onclick="cambiarTabFormato('tutor')">
                                Tutor
                            </button>
                        </div>
                    </div>

                    <div class="bg-base-200/40 px-3 py-1.5 rounded-md text-xs text-base-content/70 mb-2">
                        Configurando formato para: <strong id="etiqueta_target" class="text-primary uppercase">Alumno</strong>
                    </div>

                    <div class="space-y-3.5">
                        <!-- Presentación: Unificado vs Separado -->
                        <div>
                            <span class="text-xs font-semibold text-base-content/70 block mb-1">Presentación en tabla:</span>
                            <div class="flex flex-col gap-1">
                                <label class="label cursor-pointer justify-start gap-2 py-0.5">
                                    <input type="radio" name="opt_split" value="unified" class="radio radio-primary radio-xs" checked onchange="actualizarEstadoDesdeUI()">
                                    <span class="label-text text-xs">En una sola columna (Nombre completo)</span>
                                </label>
                                <label class="label cursor-pointer justify-start gap-2 py-0.5">
                                    <input type="radio" name="opt_split" value="separated" class="radio radio-primary radio-xs" onchange="actualizarEstadoDesdeUI()">
                                    <span class="label-text text-xs">Separado en 3 columnas (Paterno | Materno | Nombre)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Capitalización -->
                        <div>
                            <span class="text-xs font-semibold text-base-content/70 block mb-1">Capitalización:</span>
                            <div class="flex flex-col gap-1">
                                <label class="label cursor-pointer justify-start gap-2 py-0.5">
                                    <input type="radio" name="opt_case" value="upper" class="radio radio-primary radio-xs" checked onchange="actualizarEstadoDesdeUI()">
                                    <span class="label-text text-xs">TODO EN MAYÚSCULAS</span>
                                </label>
                                <label class="label cursor-pointer justify-start gap-2 py-0.5">
                                    <input type="radio" name="opt_case" value="title" class="radio radio-primary radio-xs" onchange="actualizarEstadoDesdeUI()">
                                    <span class="label-text text-xs">Minúsculas con Iniciales en Mayúscula</span>
                                </label>
                                <label class="label cursor-pointer justify-start gap-2 py-0.5">
                                    <input type="radio" name="opt_case" value="lower" class="radio radio-primary radio-xs" onchange="actualizarEstadoDesdeUI()">
                                    <span class="label-text text-xs">todo en minúsculas</span>
                                </label>
                            </div>
                        </div>

                        <!-- Orden -->
                        <div>
                            <span class="text-xs font-semibold text-base-content/70 block mb-1">Orden de aparición:</span>
                            <div class="flex flex-col gap-1">
                                <label class="label cursor-pointer justify-start gap-2 py-0.5">
                                    <input type="radio" name="opt_order" value="apellidos_nombre" class="radio radio-primary radio-xs" checked onchange="actualizarEstadoDesdeUI()">
                                    <span class="label-text text-xs">Apellidos primero (Paterno Materno Nombre)</span>
                                </label>
                                <label class="label cursor-pointer justify-start gap-2 py-0.5">
                                    <input type="radio" name="opt_order" value="nombre_apellidos" class="radio radio-primary radio-xs" onchange="actualizarEstadoDesdeUI()">
                                    <span class="label-text text-xs">Nombre primero (Nombre Paterno Materno)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Símbolo separador -->
                        <div id="contenedor_sep">
                            <label class="text-xs font-semibold text-base-content/70 block mb-1" for="opt_sep">Símbolo separador:</label>
                            <div class="flex gap-2">
                                <select id="opt_sep" class="select select-bordered select-sm flex-1" onchange="actualizarEstadoDesdeUI()">
                                    <option value=" ">Espacio normal (Ej: PÉREZ LÓPEZ JUAN)</option>
                                    <option value=" * ">Asterisco (Ej: PÉREZ * LÓPEZ * JUAN)</option>
                                    <option value=", ">Coma entre bloques (Ej: PÉREZ LÓPEZ, JUAN)</option>
                                    <option value=" - ">Guion (Ej: PÉREZ - LÓPEZ - JUAN)</option>
                                    <option value=" / ">Diagonal (Ej: PÉREZ / LÓPEZ / JUAN)</option>
                                    <option value=" | ">Barra vertical (Ej: PÉREZ | LÓPEZ | JUAN)</option>
                                    <option value="custom">Otro símbolo personalizado...</option>
                                </select>
                                <input 
                                    type="text" 
                                    id="opt_sep_custom" 
                                    maxlength="5" 
                                    placeholder="Ej: *" 
                                    class="input input-bordered input-sm w-20 hidden text-center font-bold"
                                    oninput="actualizarEstadoDesdeUI()"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Selector de Columnas -->
            <div class="card bg-base-100 shadow-sm border border-base-200 lg:col-span-7">
                <div class="card-body p-5">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-primary">3. Columnas a Incluir en la Lista</h2>
                        <span class="text-xs text-base-content/60">Marca o desmarca las casillas</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                        <!-- Grupo: Datos del Alumno -->
                        <div class="space-y-1">
                            <p class="text-xs font-bold text-base-content/60 uppercase border-b pb-1">Alumno</p>
                            <label class="label cursor-pointer justify-start gap-2 py-1">
                                <input type="checkbox" class="checkbox checkbox-xs checkbox-primary col-check" value="curp" checked onchange="renderizarTabla()">
                                <span class="label-text text-xs">CURP</span>
                            </label>
                            <label class="label cursor-pointer justify-start gap-2 py-1">
                                <input type="checkbox" class="checkbox checkbox-xs checkbox-primary col-check" value="sexo" onchange="renderizarTabla()">
                                <span class="label-text text-xs">Sexo</span>
                            </label>
                            <label class="label cursor-pointer justify-start gap-2 py-1">
                                <input type="checkbox" class="checkbox checkbox-xs checkbox-primary col-check" value="fec_nac" onchange="renderizarTabla()">
                                <span class="label-text text-xs">Fecha de Nacimiento</span>
                            </label>
                            <label class="label cursor-pointer justify-start gap-2 py-1">
                                <input type="checkbox" class="checkbox checkbox-xs checkbox-primary col-check" value="sangre" onchange="renderizarTabla()">
                                <span class="label-text text-xs">Tipo de Sangre</span>
                            </label>
                        </div>

                            <!-- Grupo: Contacto y Domicilio -->
                        <div class="space-y-1">
                            <p class="text-xs font-bold text-base-content/60 uppercase border-b pb-1">Contacto / Domicilio</p>
                            <label class="label cursor-pointer justify-start gap-2 py-1">
                                <input type="checkbox" id="chk_tutor" class="checkbox checkbox-xs checkbox-primary col-check" value="tutor" onchange="renderizarTabla()">
                                <span class="label-text text-xs font-medium">Nombre del Tutor</span>
                            </label>
                            <label class="label cursor-pointer justify-start gap-2 py-1">
                                <input type="checkbox" class="checkbox checkbox-xs checkbox-primary col-check" value="tel1" onchange="renderizarTabla()">
                                <span class="label-text text-xs">Teléfono Principal</span>
                            </label>
                            <label class="label cursor-pointer justify-start gap-2 py-1">
                                <input type="checkbox" class="checkbox checkbox-xs checkbox-primary col-check" value="tel_emer" onchange="renderizarTabla()">
                                <span class="label-text text-xs">Teléfono Emergencia</span>
                            </label>
                            <label class="label cursor-pointer justify-start gap-2 py-1">
                                <input type="checkbox" class="checkbox checkbox-xs checkbox-primary col-check" value="domicilio" onchange="renderizarTabla()">
                                <span class="label-text text-xs">Domicilio Completo</span>
                            </label>
                        </div>

                        <!-- Grupo: Columnas en Blanco para Impresión -->
                        <div class="space-y-1">
                            <p class="text-xs font-bold text-base-content/60 uppercase border-b pb-1">Para Impresión</p>
                            <label class="label cursor-pointer justify-start gap-2 py-1">
                                <input type="checkbox" class="checkbox checkbox-xs checkbox-secondary col-check" value="firma" onchange="renderizarTabla()">
                                <span class="label-text text-xs">Columna de Firma</span>
                            </label>
                            <label class="label cursor-pointer justify-start gap-2 py-1">
                                <input type="checkbox" class="checkbox checkbox-xs checkbox-secondary col-check" value="observaciones" onchange="renderizarTabla()">
                                <span class="label-text text-xs">Observaciones</span>
                            </label>
                            <label class="label cursor-pointer justify-start gap-2 py-1">
                                <input type="checkbox" class="checkbox checkbox-xs checkbox-secondary col-check" value="asistencia_5" onchange="renderizarTabla()">
                                <span class="label-text text-xs">5 Casillas (L-M-M-J-V)</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vista Previa y Botones de Exportación -->
        <div class="card bg-base-100 shadow-md border border-base-200 print:shadow-none print:border-none">
            <div class="card-body p-0">
                
                <!-- Barra de Acciones -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-5 border-b border-base-200 bg-base-200/30 print:bg-transparent print:px-0">
                    <div>
                        <h3 class="text-lg font-bold text-base-content">
                            Lista de Grupo: <?= esc($grado) ?>° "<?= esc($grupo) ?>"
                        </h3>
                        <p class="text-xs text-base-content/60">Total de alumnos: <strong><?= count($alumnos) ?></strong></p>
                    </div>

                    <div class="flex flex-wrap items-center gap-2 print:hidden">
                        <button type="button" onclick="copiarNombres()" class="btn btn-sm btn-outline gap-1.5" id="btn_copiar">
                            <svg xmlns="http://w3.org" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                            </svg>
                            Copiar Nombres (<span id="lbl_btn_copiar">Alumnos</span>)
                        </button>

                        <button type="button" onclick="exportarCSV()" class="btn btn-sm btn-success text-white gap-1.5">
                            <svg xmlns="http://w3.org" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Excel (CSV)
                        </button>

                        <button type="button" onclick="window.print()" class="btn btn-sm btn-neutral gap-1.5">
                            <svg xmlns="http://w3.org" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Imprimir
                        </button>
                    </div>
                </div>

                <!-- Tabla Dinámica -->
                <div class="overflow-x-auto">
                    <table class="table table-zebra table-sm w-full" id="tabla_generada">
                        <thead class="bg-base-200 text-base-content" id="tabla_head"></thead>
                        <tbody id="tabla_body"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            const alumnosData = <?= json_encode($alumnos, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
            const gradoActual = "<?= esc($grado, 'js') ?>";
            const grupoActual = "<?= esc($grupo, 'js') ?>";

            // Estado independiente para Alumno y Tutor
            let targetActual = 'alumno';
            const configFormato = {
                alumno: { split: 'unified', case: 'upper', order: 'apellidos_nombre', sep: ' ', sepCustom: '' },
                tutor:  { split: 'unified', case: 'upper', order: 'apellidos_nombre', sep: ' ', sepCustom: '' }
            };

            const definicionColumnas = {
                curp:          { label: 'CURP', getValue: a => a.curp || '' },
                sexo:          { label: 'Sexo', getValue: a => a.sexo_alumno || '' },
                fec_nac:       { label: 'Fec. Nacimiento', getValue: a => a.fec_nac_alumno || '' },
                sangre:        { label: 'Tipo Sangre', getValue: a => a.tipo_sangre || 'NR' },
                tel1:          { label: 'Teléfono', getValue: a => a.telefono_1 || '' },
                tel_emer:      { label: 'Tel. Emergencia', getValue: a => a.telefono_emer || '' },
                domicilio:     { label: 'Domicilio', getValue: a => [a.calle_num_dom, a.colonia_dom, a.municipio_dom].filter(Boolean).join(', ') },
                firma:         { label: 'Firma', getValue: () => '', minWidth: 'min-w-[140px]' },
                observaciones: { label: 'Observaciones', getValue: () => '', minWidth: 'min-w-[180px]' }
            };

            function cambiarTabFormato(nuevoTarget) {
                targetActual = nuevoTarget;

                // Actualizar estilos de pestañas
                document.getElementById('tab_alumno').classList.toggle('tab-active', nuevoTarget === 'alumno');
                document.getElementById('tab_tutor').classList.toggle('tab-active', nuevoTarget === 'tutor');
                document.getElementById('etiqueta_target').textContent = (nuevoTarget === 'alumno') ? 'Alumno' : 'Tutor Principal';
                document.getElementById('lbl_btn_copiar').textContent = (nuevoTarget === 'alumno') ? 'Alumnos' : 'Tutores';

                // Si cambia a Tutor, marcar automáticamente la casilla de Nombre del Tutor para ver cambios en vivo
                if (nuevoTarget === 'tutor') {
                    const chkTutor = document.getElementById('chk_tutor');
                    if (!chkTutor.checked) chkTutor.checked = true;
                }

                // Cargar valores guardados en los controles de la UI
                const cfg = configFormato[nuevoTarget];
                document.querySelector(`input[name="opt_split"][value="${cfg.split}"]`).checked = true;
                document.querySelector(`input[name="opt_case"][value="${cfg.case}"]`).checked = true;
                document.querySelector(`input[name="opt_order"][value="${cfg.order}"]`).checked = true;
                document.getElementById('opt_sep').value = cfg.sep;
                document.getElementById('opt_sep_custom').value = cfg.sepCustom;

                sincronizarVisibilidadControles();
                renderizarTabla();
            }

            function actualizarEstadoDesdeUI() {
                const cfg = configFormato[targetActual];
                cfg.split     = document.querySelector('input[name="opt_split"]:checked').value;
                cfg.case      = document.querySelector('input[name="opt_case"]:checked').value;
                cfg.order     = document.querySelector('input[name="opt_order"]:checked').value;
                cfg.sep       = document.getElementById('opt_sep').value;
                cfg.sepCustom = document.getElementById('opt_sep_custom').value;

                sincronizarVisibilidadControles();
                renderizarTabla();
            }

            function sincronizarVisibilidadControles() {
                const cfg = configFormato[targetActual];
                const contenedorSep = document.getElementById('contenedor_sep');
                const customInput = document.getElementById('opt_sep_custom');

                if (cfg.split === 'separated') {
                    contenedorSep.classList.add('opacity-40', 'pointer-events-none');
                } else {
                    contenedorSep.classList.remove('opacity-40', 'pointer-events-none');
                }

                if (cfg.sep === 'custom' && cfg.split === 'unified') {
                    customInput.classList.remove('hidden');
                } else {
                    customInput.classList.add('hidden');
                }
            }

            function aTipoTitulo(texto) {
                if (!texto) return '';
                const minusculas = ['de', 'del', 'la', 'las', 'los', 'y'];
                return texto.toLowerCase().split(' ').map((palabra, idx) => {
                    if (idx > 0 && minusculas.includes(palabra)) return palabra;
                    return palabra.charAt(0).toUpperCase() + palabra.slice(1);
                }).join(' ');
            }

            function aplicarCapitalizacion(texto, modoCase) {
                if (!texto) return '';
                if (modoCase === 'upper') return texto.toUpperCase();
                if (modoCase === 'lower') return texto.toLowerCase();
                return aTipoTitulo(texto);
            }

            function obtenerPartesPersona(alumno, tipo) {
                const cfg = configFormato[tipo];
                const nomRaw = (tipo === 'alumno') ? alumno.nombre_alumno : alumno.nombre_tutor;
                const patRaw = (tipo === 'alumno') ? alumno.primer_apellido_alumno : alumno.primer_apellido_tutor;
                const matRaw = (tipo === 'alumno') ? alumno.segundo_apellido_alumno : alumno.segundo_apellido_tutor;

                return {
                    nom: aplicarCapitalizacion((nomRaw || '').trim(), cfg.case),
                    pat: aplicarCapitalizacion((patRaw || '').trim(), cfg.case),
                    mat: aplicarCapitalizacion((matRaw || '').trim(), cfg.case)
                };
            }

            function formatearPersonaUnificada(alumno, tipo) {
                const cfg = configFormato[tipo];
                const separador = (cfg.sep === 'custom') ? (cfg.sepCustom || ' ') : cfg.sep;
                const { nom, pat, mat } = obtenerPartesPersona(alumno, tipo);

                if (separador === ', ') {
                    const apellidos = [pat, mat].filter(Boolean).join(' ');
                    return cfg.order === 'apellidos_nombre'
                        ? [apellidos, nom].filter(Boolean).join(', ')
                        : [nom, apellidos].filter(Boolean).join(', ');
                }

                const partes = (cfg.order === 'apellidos_nombre') ? [pat, mat, nom] : [nom, pat, mat];
                return partes.filter(Boolean).join(separador);
            }

            function obtenerColumnasActivas() {
                return Array.from(document.querySelectorAll('.col-check:checked')).map(cb => cb.value);
            }

            function renderizarTabla() {
                const thead = document.getElementById('tabla_head');
                const tbody = document.getElementById('tabla_body');
                const colsActivas = obtenerColumnasActivas();
                const cfgAlumno = configFormato.alumno;
                const cfgTutor  = configFormato.tutor;

                // 1. Encabezados
                let headHtml = '<tr><th class="w-10 text-center">#</th>';

                if (cfgAlumno.split === 'separated') {
                    headHtml += (cfgAlumno.order === 'apellidos_nombre')
                        ? '<th>Primer Apellido</th><th>Segundo Apellido</th><th>Nombre(s)</th>'
                        : '<th>Nombre(s)</th><th>Primer Apellido</th><th>Segundo Apellido</th>';
                } else {
                    headHtml += '<th>Nombre del Alumno</th>';
                }

                colsActivas.forEach(col => {
                    if (col === 'tutor') {
                        if (cfgTutor.split === 'separated') {
                            headHtml += (cfgTutor.order === 'apellidos_nombre')
                                ? '<th>1er Apellido Tutor</th><th>2do Apellido Tutor</th><th>Nombre(s) Tutor</th>'
                                : '<th>Nombre(s) Tutor</th><th>1er Apellido Tutor</th><th>2do Apellido Tutor</th>';
                        } else {
                            headHtml += '<th>Tutor Principal</th>';
                        }
                    } else if (col === 'asistencia_5') {
                        headHtml += '<th class="text-center w-8">L</th><th class="text-center w-8">M</th><th class="text-center w-8">M</th><th class="text-center w-8">J</th><th class="text-center w-8">V</th>';
                    } else if (definicionColumnas[col]) {
                        const extraClass = definicionColumnas[col].minWidth || '';
                        headHtml += `<th class="${extraClass}">${definicionColumnas[col].label}</th>`;
                    }
                });
                headHtml += '</tr>';
                thead.innerHTML = headHtml;

                // 2. Filas
                let bodyHtml = '';
                alumnosData.forEach((alumno, index) => {
                    bodyHtml += `<tr class="hover"><td class="text-center font-medium text-base-content/60">${index + 1}</td>`;

                    if (cfgAlumno.split === 'separated') {
                        const { nom, pat, mat } = obtenerPartesPersona(alumno, 'alumno');
                        bodyHtml += (cfgAlumno.order === 'apellidos_nombre')
                            ? `<td class="font-medium whitespace-nowrap">${escapeHtml(pat)}</td><td class="font-medium whitespace-nowrap">${escapeHtml(mat)}</td><td class="font-medium whitespace-nowrap">${escapeHtml(nom)}</td>`
                            : `<td class="font-medium whitespace-nowrap">${escapeHtml(nom)}</td><td class="font-medium whitespace-nowrap">${escapeHtml(pat)}</td><td class="font-medium whitespace-nowrap">${escapeHtml(mat)}</td>`;
                    } else {
                        bodyHtml += `<td class="font-medium whitespace-nowrap">${escapeHtml(formatearPersonaUnificada(alumno, 'alumno'))}</td>`;
                    }

                    colsActivas.forEach(col => {
                        if (col === 'tutor') {
                            if (cfgTutor.split === 'separated') {
                                const t = obtenerPartesPersona(alumno, 'tutor');
                                bodyHtml += (cfgTutor.order === 'apellidos_nombre')
                                    ? `<td class="text-xs whitespace-nowrap">${escapeHtml(t.pat)}</td><td class="text-xs whitespace-nowrap">${escapeHtml(t.mat)}</td><td class="text-xs whitespace-nowrap">${escapeHtml(t.nom)}</td>`
                                    : `<td class="text-xs whitespace-nowrap">${escapeHtml(t.nom)}</td><td class="text-xs whitespace-nowrap">${escapeHtml(t.pat)}</td><td class="text-xs whitespace-nowrap">${escapeHtml(t.mat)}</td>`;
                            } else {
                                bodyHtml += `<td class="text-xs whitespace-nowrap">${escapeHtml(formatearPersonaUnificada(alumno, 'tutor'))}</td>`;
                            }
                        } else if (col === 'asistencia_5') {
                            bodyHtml += '<td class="border-l border-base-300"></td><td class="border-l border-base-300"></td><td class="border-l border-base-300"></td><td class="border-l border-base-300"></td><td class="border-l border-base-300"></td>';
                        } else if (definicionColumnas[col]) {
                            const valor = definicionColumnas[col].getValue(alumno);
                            const claseMono = col === 'curp' ? 'font-mono text-xs' : 'text-xs';
                            bodyHtml += `<td class="${claseMono}">${escapeHtml(valor)}</td>`;
                        }
                    });

                    bodyHtml += '</tr>';
                });
                tbody.innerHTML = bodyHtml;
            }

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            function copiarNombres() {
                const cfg = configFormato[targetActual];
                const nombres = alumnosData.map(a => {
                    if (cfg.split === 'separated') {
                        const { nom, pat, mat } = obtenerPartesPersona(a, targetActual);
                        return cfg.order === 'apellidos_nombre' ? `${pat}\t${mat}\t${nom}` : `${nom}\t${pat}\t${mat}`;
                    }
                    return formatearPersonaUnificada(a, targetActual);
                }).join('\n');

                navigator.clipboard.writeText(nombres).then(() => {
                    const btn = document.getElementById('btn_copiar');
                    const original = btn.innerHTML;
                    btn.classList.add('btn-success', 'text-white');
                    btn.innerHTML = '¡Copiados al portapapeles!';
                    setTimeout(() => {
                        btn.classList.remove('btn-success', 'text-white');
                        btn.innerHTML = original;
                    }, 2000);
                });
            }

            function exportarCSV() {
                const colsActivas = obtenerColumnasActivas();
                const cfgAlumno = configFormato.alumno;
                const cfgTutor  = configFormato.tutor;
                const escCsv    = val => `"${String(val).replace(/"/g, '""')}"`;

                let headers = ['#'];
                if (cfgAlumno.split === 'separated') {
                    headers.push(...(cfgAlumno.order === 'apellidos_nombre'
                        ? ['Primer Apellido', 'Segundo Apellido', 'Nombre(s)']
                        : ['Nombre(s)', 'Primer Apellido', 'Segundo Apellido']));
                } else {
                    headers.push('Nombre del Alumno');
                }
                
                colsActivas.forEach(col => {
                    if (col === 'tutor') {
                        if (cfgTutor.split === 'separated') {
                            headers.push(...(cfgTutor.order === 'apellidos_nombre'
                                ? ['1er Apellido Tutor', '2do Apellido Tutor', 'Nombre(s) Tutor']
                                : ['Nombre(s) Tutor', '1er Apellido Tutor', '2do Apellido Tutor']));
                        } else {
                            headers.push('Tutor Principal');
                        }
                    } else if (col === 'asistencia_5') {
                        headers.push('L', 'M', 'M', 'J', 'V');
                    } else if (definicionColumnas[col]) {
                        headers.push(definicionColumnas[col].label);
                    }
                });

                let filas = [headers.map(h => escCsv(h)).join(',')];

                alumnosData.forEach((alumno, index) => {
                    let fila = [index + 1];

                    if (cfgAlumno.split === 'separated') {
                        const { nom, pat, mat } = obtenerPartesPersona(alumno, 'alumno');
                        fila.push(...(cfgAlumno.order === 'apellidos_nombre'
                            ? [escCsv(pat), escCsv(mat), escCsv(nom)]
                            : [escCsv(nom), escCsv(pat), escCsv(mat)]));
                    } else {
                        fila.push(escCsv(formatearPersonaUnificada(alumno, 'alumno')));
                    }

                    colsActivas.forEach(col => {
                        if (col === 'tutor') {
                            if (cfgTutor.split === 'separated') {
                                const t = obtenerPartesPersona(alumno, 'tutor');
                                fila.push(...(cfgTutor.order === 'apellidos_nombre'
                                    ? [escCsv(t.pat), escCsv(t.mat), escCsv(t.nom)]
                                    : [escCsv(t.nom), escCsv(t.pat), escCsv(t.mat)]));
                            } else {
                                fila.push(escCsv(formatearPersonaUnificada(alumno, 'tutor')));
                            }
                        } else if (col === 'asistencia_5') {
                            fila.push('""', '""', '""', '""', '""');
                        } else if (definicionColumnas[col]) {
                            fila.push(escCsv(definicionColumnas[col].getValue(alumno)));
                        }
                    });
                    filas.push(fila.join(','));
                });

                const csvContent = "\uFEFF" + filas.join('\n');
                const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', `Lista_${gradoActual}${grupoActual}.csv`);
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }

            document.addEventListener('DOMContentLoaded', renderizarTabla);
        </script>
    <?php endif; ?>

</div>
<?= $this->endSection() ?>
