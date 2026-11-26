<?= $this->extend('layouts/main') ?>

<?= $this->section('contenido') ?>
<div class="container mx-auto px-4 py-6 max-w-7xl">

    <!-- Encabezado y Filtro -->
    <div class="card bg-base-100 shadow-sm border border-base-200 mb-6 print:shadow-none print:border-none">
        <div class="card-body p-5 sm:p-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h1 class="text-xl sm:text-2xl font-bold text-base-content">
                            Alumnas y alumnos por grado, sexo, nuevo ingreso, repetidores y edad
                        </h1>
                        <?php if (!empty($cicloEscolar)): ?>
                            <span class="badge badge-primary badge-outline font-semibold"><?= esc($cicloEscolar) ?></span>
                        <?php endif; ?>
                    </div>
                    <p class="text-xs sm:text-sm text-base-content/70 mt-1">
                        Edad calculada en años cumplidos al: 
                        <span class="badge badge-ghost font-mono font-semibold">
                            <?= date('d/m/Y', strtotime($fechaReferencia)) ?>
                        </span>
                    </p>
                </div>

                <!-- Filtro de Vista y Botón Imprimir -->
                <div class="flex flex-wrap items-center gap-3 print:hidden">
                    <form action="<?= base_url('direccion/alumnos/estadistica-edades') ?>" method="get" class="flex items-center gap-2">
                        <label for="grado" class="text-sm font-semibold text-base-content/80">Mostrar:</label>
                        <select id="grado" name="grado" class="select select-bordered select-sm h-10 w-44 font-semibold" onchange="this.form.submit()">
                            <option value="todos" <?= $gradoSeleccionado === 'todos' ? 'selected' : '' ?>>Todos (1° a 6°)</option>
                            <?php for ($g = 1; $g <= 6; $g++): ?>
                                <option value="<?= $g ?>" <?= (string)$gradoSeleccionado === (string)$g ? 'selected' : '' ?>>
                                    Solo <?= $g ?>° Grado
                                </option>
                            <?php endfor; ?>
                        </select>
                    </form>

                    <button type="button" onclick="window.print()" class="btn btn-neutral btn-sm h-10 gap-2">
                        <svg xmlns="http://w3.org" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Imprimir
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla Estadística Completa -->
    <div class="card bg-base-100 shadow-md border border-base-200 overflow-hidden print:shadow-none">
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table table-xs sm:table-sm w-full border-collapse text-center">
                    <thead class="bg-base-200/90 text-base-content text-xs">
                        <tr class="border-b border-base-300">
                            <th colspan="3" class="bg-base-100 border-r border-base-300"></th>
                            <th class="py-3 px-1.5 leading-tight font-semibold">Menos de<br>6 años</th>
                            <th class="py-3 px-1.5 font-semibold">6 años</th>
                            <th class="py-3 px-1.5 font-semibold">7 años</th>
                            <th class="py-3 px-1.5 font-semibold">8 años</th>
                            <th class="py-3 px-1.5 font-semibold">9 años</th>
                            <th class="py-3 px-1.5 font-semibold">10 años</th>
                            <th class="py-3 px-1.5 font-semibold">11 años</th>
                            <th class="py-3 px-1.5 font-semibold">12 años</th>
                            <th class="py-3 px-1.5 font-semibold">13 años</th>
                            <th class="py-3 px-1.5 font-semibold">14 años</th>
                            <th class="py-3 px-1.5 leading-tight font-semibold">15 años<br>y más</th>
                            <th class="py-3 px-3 bg-primary/10 text-primary font-bold border-l border-base-300">Total</th>
                        </tr>
                    </thead>

                    <tbody class="text-xs sm:text-sm">
                        <?php foreach ($datosPorGrado as $gradoNum => $bloque): ?>
                            <!-- HOMBRES - NUEVO INGRESO -->
                            <tr class="hover:bg-base-200/30 border-t border-base-300">
                                <td rowspan="4" class="font-bold text-base sm:text-lg text-primary bg-base-200/40 border-r border-base-300 w-12 align-middle">
                                    <?= esc($gradoNum) ?>°
                                </td>
                                <td rowspan="2" class="font-bold text-info bg-info/5 border-r border-base-300 w-14 align-middle">
                                    Hom
                                </td>
                                <td class="text-left font-medium px-3 py-2 border-r border-base-300 whitespace-nowrap">
                                    Nuevo Ingreso
                                </td>
                                <?php foreach ($columnasEdad as $col): ?>
                                    <?php $val = $bloque['filas']['HOMBRE_NO'][$col]; ?>
                                    <td class="border-r border-base-200 <?= $val > 0 ? 'font-semibold text-base-content' : 'text-base-content/35' ?>">
                                        <?= $val ?>
                                    </td>
                                <?php endforeach; ?>
                                <td class="font-bold bg-primary/5 text-primary border-l border-base-300">
                                    <?= $bloque['filas']['HOMBRE_NO']['total'] ?>
                                </td>
                            </tr>

                            <!-- HOMBRES - REPETIDORES -->
                            <tr class="hover:bg-base-200/30 border-t border-base-200">
                                <td class="text-left font-medium px-3 py-2 border-r border-base-300 whitespace-nowrap text-base-content/80">
                                    Repetidores
                                </td>
                                <?php foreach ($columnasEdad as $col): ?>
                                    <?php 
                                        $val = $bloque['filas']['HOMBRE_SI'][$col];
                                        $bgCelda = ($col === 'menor_6') ? 'bg-base-200/80' : '';
                                    ?>
                                    <td class="border-r border-base-200 <?= $bgCelda ?> <?= $val > 0 ? 'font-semibold text-base-content' : 'text-base-content/35' ?>">
                                        <?= $val ?>
                                    </td>
                                <?php endforeach; ?>
                                <td class="font-bold bg-primary/5 text-primary border-l border-base-300">
                                    <?= $bloque['filas']['HOMBRE_SI']['total'] ?>
                                </td>
                            </tr>

                            <!-- MUJERES - NUEVO INGRESO -->
                            <tr class="hover:bg-base-200/30 border-t border-base-300">
                                <td rowspan="2" class="font-bold text-secondary bg-secondary/5 border-r border-base-300 w-14 align-middle">
                                    Muj
                                </td>
                                <td class="text-left font-medium px-3 py-2 border-r border-base-300 whitespace-nowrap">
                                    Nuevo Ingreso
                                </td>
                                <?php foreach ($columnasEdad as $col): ?>
                                    <?php $val = $bloque['filas']['MUJER_NO'][$col]; ?>
                                    <td class="border-r border-base-200 <?= $val > 0 ? 'font-semibold text-base-content' : 'text-base-content/35' ?>">
                                        <?= $val ?>
                                    </td>
                                <?php endforeach; ?>
                                <td class="font-bold bg-primary/5 text-primary border-l border-base-300">
                                    <?= $bloque['filas']['MUJER_NO']['total'] ?>
                                </td>
                            </tr>


                            <!-- MUJERES - REPETIDORES -->
                            <tr class="hover:bg-base-200/30 border-t border-base-200">
                                <td class="text-left font-medium px-3 py-2 border-r border-base-300 whitespace-nowrap text-base-content/80">
                                    Repetidores
                                </td>
                                <?php foreach ($columnasEdad as $col): ?>
                                    <?php 
                                        $val = $bloque['filas']['MUJER_SI'][$col];
                                        $bgCelda = ($col === 'menor_6') ? 'bg-base-200/80' : '';
                                    ?>
                                    <td class="border-r border-base-200 <?= $bgCelda ?> <?= $val > 0 ? 'font-semibold text-base-content' : 'text-base-content/35' ?>">
                                        <?= $val ?>
                                    </td>
                                <?php endforeach; ?>
                                <td class="font-bold bg-primary/5 text-primary border-l border-base-300">
                                    <?= $bloque['filas']['MUJER_SI']['total'] ?>
                                </td>
                            </tr>

                            <!-- SUBTOTAL DEL GRADO -->
                            <tr class="bg-base-200/70 font-bold border-t border-b-2 border-base-300">
                                <td colspan="3" class="text-right pr-4 py-2 text-xs uppercase tracking-wider text-base-content border-r border-base-300">
                                    Subtotal <?= esc($gradoNum) ?>°
                                </td>
                                <?php foreach ($columnasEdad as $col): ?>
                                    <td class="py-2 border-r border-base-300 <?= $bloque['subtotal'][$col] > 0 ? 'text-base-content' : 'text-base-content/40' ?>">
                                        <?= $bloque['subtotal'][$col] ?>
                                    </td>
                                <?php endforeach; ?>
                                <td class="py-2 bg-primary/15 text-primary border-l border-base-300">
                                    <?= $bloque['subtotal']['total'] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <!-- BLOQUE DE TOTALES GENERALES (Solo cuando se muestran todos los grados) -->
                        <?php if ($gradoSeleccionado === 'todos'): ?>
                            <tr class="bg-base-200/30 border-t-4 border-primary/40">
                                <td rowspan="4" class="font-bold text-sm uppercase tracking-wider text-base-content bg-base-300/60 border-r border-base-300 align-middle">
                                    Total
                                </td>
                                <td rowspan="2" class="font-bold text-info bg-info/10 border-r border-base-300 align-middle">
                                    Hom
                                </td>
                                <td class="text-left font-semibold px-3 py-2 border-r border-base-300 whitespace-nowrap">
                                    Nuevo Ingreso
                                </td>
                                <?php foreach ($columnasEdad as $col): ?>
                                    <?php $val = $totalesGenerales['filas']['HOMBRE_NO'][$col]; ?>
                                    <td class="border-r border-base-200 font-semibold <?= $val > 0 ? 'text-base-content' : 'text-base-content/35' ?>">
                                        <?= $val ?>
                                    </td>
                                <?php endforeach; ?>
                                <td class="font-bold bg-primary/10 text-primary border-l border-base-300">
                                    <?= $totalesGenerales['filas']['HOMBRE_NO']['total'] ?>
                                </td>
                            </tr>

                            <tr class="bg-base-200/30 border-t border-base-200">
                                <td class="text-left font-semibold px-3 py-2 border-r border-base-300 whitespace-nowrap text-base-content/80">
                                    Repetidores
                                </td>
                                <?php foreach ($columnasEdad as $col): ?>
                                    <?php 
                                        $val = $totalesGenerales['filas']['HOMBRE_SI'][$col];
                                        $bgCelda = ($col === 'menor_6') ? 'bg-base-300/70' : '';
                                    ?>
                                    <td class="border-r border-base-200 font-semibold <?= $bgCelda ?> <?= $val > 0 ? 'text-base-content' : 'text-base-content/35' ?>">
                                        <?= $val ?>
                                    </td>
                                <?php endforeach; ?>
                                <td class="font-bold bg-primary/10 text-primary border-l border-base-300">
                                    <?= $totalesGenerales['filas']['HOMBRE_SI']['total'] ?>
                                </td>
                            </tr>

                            <tr class="bg-base-200/30 border-t border-base-300">
                                <td rowspan="2" class="font-bold text-secondary bg-secondary/10 border-r border-base-300 align-middle">
                                    Muj
                                </td>
                                <td class="text-left font-semibold px-3 py-2 border-r border-base-300 whitespace-nowrap">
                                    Nuevo Ingreso
                                </td>
                                <?php foreach ($columnasEdad as $col): ?>
                                    <?php $val = $totalesGenerales['filas']['MUJER_NO'][$col]; ?>
                                    <td class="border-r border-base-200 font-semibold <?= $val > 0 ? 'text-base-content' : 'text-base-content/35' ?>">
                                        <?= $val ?>
                                    </td>
                                <?php endforeach; ?>
                                <td class="font-bold bg-primary/10 text-primary border-l border-base-300">
                                    <?= $totalesGenerales['filas']['MUJER_NO']['total'] ?>
                                </td>
                            </tr>

                            <tr class="bg-base-200/30 border-t border-base-200">
                                <td class="text-left font-semibold px-3 py-2 border-r border-base-300 whitespace-nowrap text-base-content/80">
                                    Repetidores
                                </td>
                                <?php foreach ($columnasEdad as $col): ?>
                                    <?php 
                                        $val = $totalesGenerales['filas']['MUJER_SI'][$col];
                                        $bgCelda = ($col === 'menor_6') ? 'bg-base-300/70' : '';
                                    ?>
                                    <td class="border-r border-base-200 font-semibold <?= $bgCelda ?> <?= $val > 0 ? 'text-base-content' : 'text-base-content/35' ?>">
                                        <?= $val ?>
                                    </td>
                                <?php endforeach; ?>
                                <td class="font-bold bg-primary/10 text-primary border-l border-base-300">
                                    <?= $totalesGenerales['filas']['MUJER_SI']['total'] ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                    <!-- FILA FINAL: TOTAL GENERAL -->
                    <tfoot class="bg-base-300/80 border-t-2 border-base-300 font-bold text-xs sm:text-sm">
                        <tr>
                            <td colspan="3" class="text-right pr-4 py-3 uppercase tracking-wider text-base-content border-r border-base-300">
                                Total
                            </td>
                            <?php foreach ($columnasEdad as $col): ?>
                                <td class="py-3 border-r border-base-300 <?= $totalesGenerales['subtotal'][$col] > 0 ? 'text-base-content' : 'text-base-content/40' ?>">
                                    <?= $totalesGenerales['subtotal'][$col] ?>
                                </td>
                            <?php endforeach; ?>
                            <td class="py-3 bg-primary text-primary-content text-base border-l border-base-300">
                                <?= $totalesGenerales['subtotal']['total'] ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row justify-between items-center text-xs text-base-content/60 mt-3 px-1 gap-2">
        <span>* Nuevo Ingreso = No repetidor (reprobado = NO) | Repetidores = Reprobado = SI</span>
        <span>Considera únicamente Inscripciones (I) y excluye Altas (A) y Bajas (B)</span>
    </div>

</div>
<?= $this->endSection() ?>
