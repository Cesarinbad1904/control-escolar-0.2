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
            
            <!-- Configuración del Nombre -->
            <div class="card bg-base-100 shadow-sm border border-base-200 lg:col-span-5">
                <div class="card-body p-5 space-y-4">
                    <h2 class="text-sm font-bold uppercase tracking-wider text-primary">2. Formato del Nombre</h2>

                    <!-- Mayúsculas / Tipo Título -->
                    <div>
                        <span class="text-xs font-semibold text-base-content/70 block mb-1.5">Capitalización:</span>
                        <div class="flex flex-col gap-1.5">
                            <label class="label cursor-pointer justify-start gap-2 py-1">
                                <input type="radio" name="opt_case" value="upper" class="radio radio-primary radio-sm" checked onchange="renderizarTabla()">
                                <span class="label-text text-sm">TODO EN MAYÚSCULAS</span>
                            </label>
                            <label class="label cursor-pointer justify-start gap-2 py-1">
                                <input type="radio" name="opt_case" value="title" class="radio radio-primary radio-sm" onchange="renderizarTabla()">
                                <span class="label-text text-sm">Minúsculas con Iniciales en Mayúscula</span>
                            </label>
                        </div>
                    </div>

                    <!-- Orden -->
                    <div>
                        <span class="text-xs font-semibold text-base-content/70 block mb-1.5">Orden de aparición:</span>
                        <div class="flex flex-col gap-1.5">
                            <label class="label cursor-pointer justify-start gap-2 py-1">
                                <input type="radio" name="opt_order" value="apellidos_nombre" class="radio radio-primary radio-sm" checked onchange="renderizarTabla()">
                                <span class="label-text text-sm">Apellidos primero (Paterno Materno Nombre)</span>
                            </label>
                            <label class="label cursor-pointer justify-start gap-2 py-1">
                                <input type="radio" name="opt_order" value="nombre_apellidos" class="radio radio-primary radio-sm" onchange="renderizarTabla()">
                                <span class="label-text text-sm">Nombre primero (Nombre Paterno Materno)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Símbolo separador -->
                    <div>
                        <label class="text-xs font-semibold text-base-content/70 block mb-1.5" for="opt_sep">Símbolo separador:</label>
                        <div class="flex gap-2">
                            <select id="opt_sep" class="select select-bordered select-sm flex-1" onchange="toggleSepCustom()">
                                <option value=" ">Espacio normal (Ej: PÉREZ LÓPEZ JUAN)</option>
                                <option value=" * ">Asterisco entre bloques (Ej: PÉREZ * LÓPEZ * JUAN)</option>
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
                                oninput="renderizarTabla()"
                            >
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
                                <input type="checkbox" class="checkbox checkbox-xs checkbox-primary col-check" value="tutor" onchange="renderizarTabla()">
                                <span class="label-text text-xs">Nombre del Tutor</span>
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
                            Copiar Nombres
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

                     
            // Diccionario de definiciones de columnas opcionales
            const definicionColumnas = {
                curp:          { label: 'CURP', getValue: a => a.curp || '' },
                sexo:          { label: 'Sexo', getValue: a => a.sexo_alumno || '' },
                fec_nac:       { label: 'Fec. Nacimiento', getValue: a => a.fec_nac_alumno || '' },
                sangre:        { label: 'Tipo Sangre', getValue: a => a.tipo_sangre || 'NR' },
                tutor:         { label: 'Tutor Principal', getValue: a => [a.nombre_tutor, a.primer_apellido_tutor, a.segundo_apellido_tutor].filter(Boolean).join(' ') },
                tel1:          { label: 'Teléfono', getValue: a => a.telefono_1 || '' },
                tel_emer:      { label: 'Tel. Emergencia', getValue: a => a.telefono_emer || '' },
                domicilio:     { label: 'Domicilio', getValue: a => [a.calle_num_dom, a.colonia_dom, a.municipio_dom].filter(Boolean).join(', ') },
                firma:         { label: 'Firma', getValue: () => '', minWidth: 'min-w-[140px]' },
                observaciones: { label: 'Observaciones', getValue: () => '', minWidth: 'min-w-[180px]' }
            };

            function toggleSepCustom() {
                const select = document.getElementById('opt_sep');
                const customInput = document.getElementById('opt_sep_custom');
                if (select.value === 'custom') {
                    customInput.classList.remove('hidden');
                    customInput.focus();
                } else {
                    customInput.classList.add('hidden');
                }
                renderizarTabla();
            }

            function aTipoTitulo(texto) {
                if (!texto) return '';
                const minusculas = ['de', 'del', 'la', 'las', 'los', 'y'];
                return texto.toLowerCase().split(' ').map((palabra, idx) => {
                    if (idx > 0 && minusculas.includes(palabra)) return palabra;
                    return palabra.charAt(0).toUpperCase() + palabra.slice(1);
                }).join(' ');
            }

            function formatearNombre(alumno) {
                const modoCase  = document.querySelector('input[name="opt_case"]:checked').value;
                const modoOrden = document.querySelector('input[name="opt_order"]:checked').value;
                const sepSelect = document.getElementById('opt_sep').value;
                const separador = (sepSelect === 'custom') 
                    ? (document.getElementById('opt_sep_custom').value || ' ') 
                    : sepSelect;

                let nom = (alumno.nombre_alumno || '').trim();
                let pat = (alumno.primer_apellido_alumno || '').trim();
                let mat = (alumno.segundo_apellido_alumno || '').trim();

                if (modoCase === 'upper') {
                    nom = nom.toUpperCase();
                    pat = pat.toUpperCase();
                    mat = mat.toUpperCase();
                } else {
                    nom = aTipoTitulo(nom);
                    pat = aTipoTitulo(pat);
                    mat = aTipoTitulo(mat);
                }

                // Si el separador es coma ", ", se coloca entre el bloque de apellidos y el nombre
                if (separador === ', ') {
                    const apellidos = [pat, mat].filter(Boolean).join(' ');
                    return modoOrden === 'apellidos_nombre'
                        ? [apellidos, nom].filter(Boolean).join(', ')
                        : [nom, apellidos].filter(Boolean).join(', ');
                }

                // Para cualquier otro separador (espacio, guion, diagonal, personalizado)
                const partes = (modoOrden === 'apellidos_nombre')
                    ? [pat, mat, nom]
                    : [nom, pat, mat];

                return partes.filter(Boolean).join(separador);
            }

            function obtenerColumnasActivas() {
                return Array.from(document.querySelectorAll('.col-check:checked')).map(cb => cb.value);
            }

            function renderizarTabla() {
                const thead = document.getElementById('tabla_head');
                const tbody = document.getElementById('tabla_body');
                const colsActivas = obtenerColumnasActivas();

                // Construir encabezados
                let headHtml = '<tr><th class="w-10 text-center">#</th><th>Nombre del Alumno</th>';
                colsActivas.forEach(col => {
                    if (col === 'asistencia_5') {
                        headHtml += '<th class="text-center w-8">L</th><th class="text-center w-8">M</th><th class="text-center w-8">M</th><th class="text-center w-8">J</th><th class="text-center w-8">V</th>';
                    } else if (definicionColumnas[col]) {
                        const extraClass = definicionColumnas[col].minWidth || '';
                        headHtml += `<th class="${extraClass}">${definicionColumnas[col].label}</th>`;
                    }
                });
                headHtml += '</tr>';
                thead.innerHTML = headHtml;

                // Construir filas
                let bodyHtml = '';
                alumnosData.forEach((alumno, index) => {
                    const nombreFormateado = formatearNombre(alumno);
                    bodyHtml += `<tr class="hover">
                        <td class="text-center font-medium text-base-content/60">${index + 1}</td>
                        <td class="font-medium whitespace-nowrap">${escapeHtml(nombreFormateado)}</td>`;

                    colsActivas.forEach(col => {
                        if (col === 'asistencia_5') {
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
                const nombres = alumnosData.map(a => formatearNombre(a)).join('\n');
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
                let headers = ['#', 'Nombre del Alumno'];
                
                colsActivas.forEach(col => {
                    if (col === 'asistencia_5') {
                        headers.push('L', 'M', 'M', 'J', 'V');
                    } else if (definicionColumnas[col]) {
                        headers.push(definicionColumnas[col].label);
                    }
                });

                let filas = [headers.map(h => `"${h}"`).join(',')];

                alumnosData.forEach((alumno, index) => {
                    let fila = [index + 1, `"${formatearNombre(alumno).replace(/"/g, '""')}"`];
                    colsActivas.forEach(col => {
                        if (col === 'asistencia_5') {
                            fila.push('""', '""', '""', '""', '""');
                        } else if (definicionColumnas[col]) {
                            const val = String(definicionColumnas[col].getValue(alumno)).replace(/"/g, '""');
                            fila.push(`"${val}"`);
                        }
                    });
                    filas.push(fila.join(','));
                });

                // BOM UTF-8 para que Excel abra acentos y Ñ correctamente
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

            // Inicializar tabla al cargar
            document.addEventListener('DOMContentLoaded', renderizarTabla);
        </script>
    <?php endif; ?>

</div>
<?= $this->endSection() ?>

