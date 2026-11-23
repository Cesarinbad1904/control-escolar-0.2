<?php

namespace App\Controllers\Direccion;

use App\Controllers\BaseController;
use App\Models\AlumnoModel;
use App\Models\TutorModel;
use App\Models\EscuelaModel;


class DashboardController extends BaseController
{
    public function index()
    {
        $alumnoModel = new AlumnoModel();
        $tutorModel  = new TutorModel();
        $escuelaModel  = new EscuelaModel();

        
        // buscar y recuperar datos de la tabla escuela
            $datos_escuela = $escuelaModel->where('id_escuela', 1)->first();   
            $nombre_escuela = $datos_escuela->nombre;

        
            // 1. Consulta agrupada por Grado y Grupo (solo alumnos activos sin baja 'B')
        $resumenGrupos = $alumnoModel
            ->select("
                grado,
                grupo,
                SUM(CASE WHEN sexo_alumno = 'HOMBRE' THEN 1 ELSE 0 END) AS hombres,
                SUM(CASE WHEN sexo_alumno = 'MUJER' THEN 1 ELSE 0 END) AS mujeres,
                COUNT(id_alumno) AS total
            ")
            ->groupStart()
                ->where('mov_f !=', 'B')
                ->orWhere('mov_f', null)
            ->groupEnd()
            ->groupBy(['grado', 'grupo'])
            ->orderBy('grado', 'ASC')
            ->orderBy('grupo', 'ASC')
            ->findAll();

        // 2. Calculamos los totales generales al pie de la tabla
        $totalesExistencia = [
            'hombres' => 0,
            'mujeres' => 0,
            'total'   => 0,
        ];

        foreach ($resumenGrupos as $fila) {
            $totalesExistencia['hombres'] += (int) $fila->hombres;
            $totalesExistencia['mujeres'] += (int) $fila->mujeres;
            $totalesExistencia['total']   += (int) $fila->total;
        }


     // Consulta de Años Cursados en Preescolar (Solo Primer Grado activo)
        $datosPreescolar = $alumnoModel
            ->select('anios_prescolar, sexo_alumno, COUNT(id_alumno) AS cantidad')
            ->where('grado', '1')
            ->groupStart()
                ->where('mov_f !=', 'B')
                ->orWhere('mov_f', null)
            ->groupEnd()
            ->groupBy(['anios_prescolar', 'sexo_alumno'])
            ->findAll();

        // Inicializamos la matriz en ceros para 0, 1, 2 y 3 años
        $preescolar = [
            '0' => ['H' => 0, 'M' => 0, 'T' => 0],
            '1' => ['H' => 0, 'M' => 0, 'T' => 0],
            '2' => ['H' => 0, 'M' => 0, 'T' => 0],
            '3' => ['H' => 0, 'M' => 0, 'T' => 0],
            'total_general' => 0,
        ];

        foreach ($datosPreescolar as $row) {
            $anio = (string) $row->anios_prescolar;
            $cant = (int) $row->cantidad;

            if (isset($preescolar[$anio])) {
                if ($row->sexo_alumno === 'HOMBRE') {
                    $preescolar[$anio]['H'] += $cant;
                } elseif ($row->sexo_alumno === 'MUJER') {
                    $preescolar[$anio]['M'] += $cant;
                }
                $preescolar[$anio]['T'] += $cant;
                $preescolar['total_general'] += $cant;
            }
        }


 // Estadística por Grado (1° a 6°): Inscripciones, Altas, Bajas, Existencia y Reprobados
        $rawEstadistica = $alumnoModel
            ->select("
                grado,
                -- INSCRIPCIONES (mov_i = 'I')
                SUM(CASE WHEN mov_i = 'I' AND sexo_alumno = 'HOMBRE' THEN 1 ELSE 0 END) AS ins_h,
                SUM(CASE WHEN mov_i = 'I' AND sexo_alumno = 'MUJER'  THEN 1 ELSE 0 END) AS ins_m,
                SUM(CASE WHEN mov_i = 'I' THEN 1 ELSE 0 END) AS ins_t,

                -- ALTAS (mov_i = 'A')
                SUM(CASE WHEN mov_i = 'A' AND sexo_alumno = 'HOMBRE' THEN 1 ELSE 0 END) AS alt_h,
                SUM(CASE WHEN mov_i = 'A' AND sexo_alumno = 'MUJER'  THEN 1 ELSE 0 END) AS alt_m,
                SUM(CASE WHEN mov_i = 'A' THEN 1 ELSE 0 END) AS alt_t,

                -- BAJAS (mov_f = 'B')
                SUM(CASE WHEN mov_f = 'B' AND sexo_alumno = 'HOMBRE' THEN 1 ELSE 0 END) AS baj_h,
                SUM(CASE WHEN mov_f = 'B' AND sexo_alumno = 'MUJER'  THEN 1 ELSE 0 END) AS baj_m,
                SUM(CASE WHEN mov_f = 'B' THEN 1 ELSE 0 END) AS baj_t,

                -- EXISTENCIA (mov_f IS NULL OR mov_f != 'B')
                SUM(CASE WHEN (mov_f IS NULL OR mov_f != 'B') AND sexo_alumno = 'HOMBRE' THEN 1 ELSE 0 END) AS exi_h,
                SUM(CASE WHEN (mov_f IS NULL OR mov_f != 'B') AND sexo_alumno = 'MUJER'  THEN 1 ELSE 0 END) AS exi_m,
                SUM(CASE WHEN (mov_f IS NULL OR mov_f != 'B') THEN 1 ELSE 0 END) AS exi_t,

                -- REPROBADOS (reprobado = 'SI' en alumnos activos)
                SUM(CASE WHEN reprobado = 'SI' AND (mov_f IS NULL OR mov_f != 'B') AND sexo_alumno = 'HOMBRE' THEN 1 ELSE 0 END) AS rep_h,
                SUM(CASE WHEN reprobado = 'SI' AND (mov_f IS NULL OR mov_f != 'B') AND sexo_alumno = 'MUJER'  THEN 1 ELSE 0 END) AS rep_m,
                SUM(CASE WHEN reprobado = 'SI' AND (mov_f IS NULL OR mov_f != 'B') THEN 1 ELSE 0 END) AS rep_t
            ")
            ->groupBy('grado')
            ->findAll();

        $columnas = ['ins_h', 'ins_m', 'ins_t', 'alt_h', 'alt_m', 'alt_t', 'baj_h', 'baj_m', 'baj_t', 'exi_h', 'exi_m', 'exi_t', 'rep_h', 'rep_m', 'rep_t'];
        $estadisticaGrados  = [];
        $totalesEstadistica = array_fill_keys($columnas, 0);

        // Garantizamos los grados del 1 al 6 como en la imagen
        foreach (['1', '2', '3', '4', '5', '6'] as $g) {
            $estadisticaGrados[$g] = array_fill_keys($columnas, 0);
        }

        foreach ($rawEstadistica as $fila) {
            $g = (string) $fila->grado;
            if (!isset($estadisticaGrados[$g])) {
                $estadisticaGrados[$g] = array_fill_keys($columnas, 0);
            }
            foreach ($columnas as $col) {
                $valor = (int) $fila->$col;
                $estadisticaGrados[$g][$col] = $valor;
                $totalesEstadistica[$col]  += $valor;
            }
        }
        ksort($estadisticaGrados);


        // Resto de indicadores KPI
        $data = [
            'titulo'              => $nombre_escuela.' | Panel de Dirección Escolar',
            'total_alumnos'       => $totalesExistencia['total'], // Reutilizamos el total exacto de activos
            'origen_ni'       => $alumnoModel->whereIn('origen', ['NI'])->countAllResults(),
            'origen_said'       => $alumnoModel->whereIn('origen', ['SA'])->countAllResults(),
            'origen_me'       => $alumnoModel->whereIn('origen', ['ME'])->countAllResults(),
            'alumnos_reprobados'  => $alumnoModel->where('reprobado', 'SI')->countAllResults(),
            'tutores_activos'     => $tutorModel->where('mov_f', null)->countAllResults(),

            // Datos del resumen por grupo
            'resumen_grupos'      => $resumenGrupos,
            'totales_existencia'  => $totalesExistencia,
            'preescolar' => $preescolar,
            'estadistica_grados'  => $estadisticaGrados,
            'totales_estadistica' => $totalesEstadistica,

            // Tablas secundarias
            'ultimos_alumnos'     => $alumnoModel->select('id_alumno, curp, nombre_alumno, primer_apellido_alumno, segundo_apellido_alumno, grado, grupo, origen, fecha_registro')
                                                 ->orderBy('fecha_registro', 'DESC')
                                                 ->findAll(5),

            'alertas_tutores'     => $tutorModel->select('tutores.id_tutor, tutores.nombre_tutor, tutores.primer_apellido_tutor, tutores.parentesco_tutor, tutores.recoge, alumnos_inscritos.nombre_alumno, alumnos_inscritos.primer_apellido_alumno, alumnos_inscritos.grado, alumnos_inscritos.grupo')
                                                ->join('alumnos_inscritos', 'alumnos_inscritos.id_alumno = tutores.id_alumno')
                                                ->where('tutores.recoge', 'NO')
                                                ->findAll(5),
            'nombre_escuela'      => $nombre_escuela
        ];

        return view('direccion/dashboard', $data);
    }
}
