<?php

namespace App\Controllers\Docentes;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $db      = \Config\Database::connect();
        $session = session();

        $grado = $session->get('docente_grado');
        $grupo = $session->get('docente_grupo');

        // 1. Obtener datos generales de la escuela (ciclo escolar)
        $escuela = $db->table('escuela')->select('nombre, cct, turno, ciclo_escolar')->get()->getRow();

        // 2. Contar alumnos inscritos activos en este grado y grupo
        $alumnos = $db->table('alumnos_inscritos')
            ->select('sexo_alumno')
            ->where('grado', $grado)
            ->where('grupo', $grupo)
            ->groupStart()
                ->where('mov_f IS NULL')
                ->orWhere('mov_f !=', 'B')
            ->groupEnd()
            ->get()
            ->getResult();

        $totalAlumnos = count($alumnos);
        $totalHombres = 0;
        $totalMujeres = 0;

        foreach ($alumnos as $al) {
            if ($al->sexo_alumno === 'HOMBRE') {
                $totalHombres++;
            } elseif ($al->sexo_alumno === 'MUJER') {
                $totalMujeres++;
            }
        }

        // 3. Contar cuántos alumnos autorizados de su grupo aún no completan su inscripción
        $pendientesRegistro = $db->table('alumnos_base b')
            ->join('alumnos_inscritos i', 'i.curp = b.curp', 'left')
            ->where('b.grado', $grado)
            ->where('b.grupo', $grupo)
            ->where('i.id_alumno IS NULL')
            ->countAllResults();

        $data = [
            'titulo'             => 'Mi Panel Docente',
            'escuela'            => $escuela,
            'grado'              => $grado,
            'grupo'              => $grupo,
            'totalAlumnos'       => $totalAlumnos,
            'totalHombres'       => $totalHombres,
            'totalMujeres'       => $totalMujeres,
            'pendientesRegistro' => $pendientesRegistro,
        ];

        return view('docentes/panel', $data);
    }
}
