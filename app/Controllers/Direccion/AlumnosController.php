<?php

namespace App\Controllers\Direccion;
use App\Controllers\BaseController;


use App\Models\AlumnoModel;
use App\Models\TutorModel;
use App\Models\HistorialMedicoModel;
use App\Models\EscuelaModel;

class AlumnosController extends BaseController
{
    public function index()
    {
        $alumnoModel = new AlumnoModel();

        // Capturamos filtros desde la URL (GET)
        $busqueda = trim((string) $this->request->getGet('q'));
        $grado    = $this->request->getGet('grado');
        $grupo    = $this->request->getGet('grupo');
        $estatus  = $this->request->getGet('estatus'); // 'activos', 'bajas', 'todos'

        // Construimos la consulta dinámicamente
        if ($busqueda !== '') {
            $alumnoModel->groupStart()
                ->like('curp', $busqueda)
                ->orLike('nombre_alumno', $busqueda)
                ->orLike('primer_apellido_alumno', $busqueda)
                ->orLike('segundo_apellido_alumno', $busqueda)
                ->orLike("CONCAT(nombre_alumno, ' ', primer_apellido_alumno, ' ', segundo_apellido_alumno)", $busqueda)
            ->groupEnd();
        }

        if (!empty($grado)) {
            $alumnoModel->where('grado', $grado);
        }

        if (!empty($grupo)) {
            $alumnoModel->where('grupo', $grupo);
        }

        if ($estatus === 'bajas') {
            $alumnoModel->where('mov_f', 'B');
        } elseif ($estatus === 'activos' || empty($estatus)) {
            // Por defecto mostramos los activos, o puedes cambiarlo a 'todos' si prefieres
            if ($estatus === 'activos') {
                $alumnoModel->groupStart()
                    ->where('mov_f !=', 'B')
                    ->orWhere('mov_f', null)
                ->groupEnd();
            }
        }

        // Obtenemos grupos distintos disponibles para llenar el select dinámicamente
        $db = \Config\Database::connect();
        $gruposDisponibles = $db->table('alumnos_inscritos')
            ->select('grupo')
            ->distinct()
            ->orderBy('grupo', 'ASC')
            ->get()
            ->getResult();

        $data = [
            'titulo'            => 'Directorio de Alumnos Inscritos',
            'alumnos'           => $alumnoModel->orderBy('grado', 'ASC')
                                               ->orderBy('grupo', 'ASC')
                                               ->orderBy('primer_apellido_alumno', 'ASC')
                                               ->paginate(15),
            'pager'             => $alumnoModel->pager,
            'gruposDisponibles' => $gruposDisponibles,
            'filtros'           => [
                'q'       => $busqueda,
                'grado'   => $grado,
                'grupo'   => $grupo,
                'estatus' => $estatus,
            ],
        ];

        return view('direccion/alumnos/index', $data);
    }

    

    public function registrarMovimiento()
    {
        $rules = [
            'id_alumno'        => 'required|is_natural_no_zero',
            'tipo_movimiento'  => 'required|in_list[A,B,REACTIVAR]',
            'fecha_movimiento' => 'required|valid_date[Y-m-d]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Por favor verifica los datos del movimiento y la fecha.');
        }

        $alumnoModel = new AlumnoModel();
        $idAlumno    = $this->request->getPost('id_alumno');
        $tipo        = $this->request->getPost('tipo_movimiento');
        $fecha       = $this->request->getPost('fecha_movimiento');

        $alumno = $alumnoModel->find($idAlumno);
        if (!$alumno) {
            return redirect()->back()->with('error', 'El alumno seleccionado no existe.');
        }

        // Preparamos los campos exactos según tu migración
        $datosActualizar = [];

        if ($tipo === 'A') {
            // Movimiento de ALTA
            $datosActualizar = [
                'mov_i'      => 'A',
                'fecha_alta' => $fecha,
                'mov_f'      => null, // Si estaba dado de baja, vuelve a estar activo
                'fecha_baja' => null,
            ];
            $mensaje = 'Movimiento de ALTA registrado correctamente.';
        } elseif ($tipo === 'B') {
            // Movimiento de BAJA
            $datosActualizar = [
                'mov_f'      => 'B',
                'fecha_baja' => $fecha,
            ];
            $mensaje = 'Movimiento de BAJA registrado correctamente.';
        } elseif ($tipo === 'REACTIVAR') {
            // Quitar baja y volver a Inscripción normal
            $datosActualizar = [
                'mov_i'      => 'I',
                'mov_f'      => null,
                'fecha_baja' => null,
            ];
            $mensaje = 'El alumno ha sido reactivado como Inscripción vigente.';
        }

        // Asegúrate de tener mov_i, mov_f, fecha_alta, fecha_baja en $allowedFields de AlumnoModel
        $alumnoModel->update($idAlumno, $datosActualizar);

        return redirect()->to(site_url('direccion/alumnos'))->with('success', $mensaje);
    }





        public function actualizarGradoGrupo()
    {
        $rules = [
            'id_alumno' => 'required|is_natural_no_zero',
            'grado'     => 'required|max_length[1]',
            'grupo'     => 'required|max_length[5]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Por favor selecciona un grado y escribe un grupo válido.');
        }

        $alumnoModel = new AlumnoModel();
        $idAlumno    = $this->request->getPost('id_alumno');
        $grado       = trim((string) $this->request->getPost('grado'));
        $grupo       = strtoupper(trim((string) $this->request->getPost('grupo')));

        if (!$alumnoModel->find($idAlumno)) {
            return redirect()->back()->with('error', 'El alumno seleccionado no existe.');
        }

        // Asegúrate de tener 'grado' y 'grupo' en $allowedFields de AlumnoModel
        $alumnoModel->update($idAlumno, [
            'grado' => $grado,
            'grupo' => $grupo,
        ]);

        return redirect()->back()->with('success', "Grado y grupo actualizados correctamente a {$grado}° {$grupo}.");
    }





// ======= Método eliminar alumno ================
        public function eliminar()
    {
        $rules = [
            'id_alumno' => 'required|is_natural_no_zero',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Solicitud de eliminación no válida.');
        }

        $alumnoModel = new AlumnoModel();
        $idAlumno    = $this->request->getPost('id_alumno');

        $alumno = $alumnoModel->find($idAlumno);
        if (!$alumno) {
            return redirect()->back()->with('error', 'El alumno que intentas eliminar no existe.');
        }

        $nombreCompleto = "{$alumno->nombre_alumno} {$alumno->primer_apellido_alumno} {$alumno->segundo_apellido_alumno}";

        // Si en AlumnoModel tienes $useSoftDeletes = true, usa delete($idAlumno, true) para borrado definitivo
        $alumnoModel->delete($idAlumno, true);

        return redirect()->back()->with('success', "El expediente de {$nombreCompleto} ha sido eliminado definitivamente.");
    }




    // === Método ver el expediente completo ======
    public function ver($idAlumno = null)
    {
        $alumnoModel    = new AlumnoModel();
        $tutorModel     = new TutorModel();
        $historialModel = new HistorialMedicoModel();

        $alumno = $alumnoModel->find($idAlumno);
        if (!$alumno) {
            return redirect()->to(site_url('direccion/alumnos'))
                             ->with('error', 'El expediente solicitado no existe.');
        }

        // Consultamos los registros vinculados por id_alumno
        $tutor     = $tutorModel->where('id_alumno', $idAlumno)->first();
        $historial = $historialModel->where('id_alumno', $idAlumno)->first();

        $data = [
            'titulo'    => 'Expediente Escolar del Alumno',
            'alumno'    => $alumno,
            'tutor'     => $tutor,
            'historial' => $historial,
        ];

        return view('direccion/alumnos/ver', $data);
    }





// === Método consulta alumnos por grupo ===================
    public function porGrupo()
    {
        $alumnoModel = new AlumnoModel();
        $escuelaModel = new EscuelaModel();
        
        // Buscar los datos de la escuela
        $escuela = $escuelaModel->where('id_escuela', 1)->first();

        $db = \Config\Database::connect();

        $gradosDisponibles = $db->table('alumnos_inscritos')
            ->select('grado')
            ->distinct()
            ->orderBy('grado', 'ASC')
            ->get()
            ->getResult();

        $gruposDisponibles = $db->table('alumnos_inscritos')
            ->select('grupo')
            ->distinct()
            ->orderBy('grupo', 'ASC')
            ->get()
            ->getResult();

        $gradoSeleccionado = $this->request->getGet('grado');
        $grupoSeleccionado = $this->request->getGet('grupo');

        $alumnos = [];
        $resumen = ['total' => 0, 'hombres' => 0, 'mujeres' => 0];

        if (!empty($gradoSeleccionado) && !empty($grupoSeleccionado)) {
            // 1. Traemos a los alumnos del grupo junto con la CURP de su tutor principal
            $alumnos = $alumnoModel
                ->select('alumnos_inscritos.*, tutores.curp_tutor, tutores.nombre_tutor, tutores.primer_apellido_tutor')
                ->join('tutores', 'tutores.id_alumno = alumnos_inscritos.id_alumno', 'left')
                ->where('alumnos_inscritos.grado', $gradoSeleccionado)
                ->where('alumnos_inscritos.grupo', $grupoSeleccionado)
                ->groupStart()
                    ->where('alumnos_inscritos.mov_f !=', 'B') // No se seleccionan las bajas
                    ->orWhere('alumnos_inscritos.mov_f', null)
                ->groupEnd()
                ->orderBy('alumnos_inscritos.primer_apellido_alumno', 'ASC')
                ->orderBy('alumnos_inscritos.segundo_apellido_alumno', 'ASC')
                ->orderBy('alumnos_inscritos.nombre_alumno', 'ASC')
                ->findAll();

            // 2. Recopilamos todas las CURP de tutores de este salón (sin duplicados ni vacíos)
            $curpsTutores = [];
            foreach ($alumnos as $al) {
                $resumen['total']++;
                if ($al->sexo_alumno === 'HOMBRE') {
                    $resumen['hombres']++;
                } elseif ($al->sexo_alumno === 'MUJER') {
                    $resumen['mujeres']++;
                }

                if (!empty($al->curp_tutor)) {
                    $curpsTutores[] = $al->curp_tutor;
                }
            }
            $curpsTutores = array_unique($curpsTutores);

            // 3. Buscamos en toda la escuela qué alumnos activos comparten alguna de esas CURP de tutor
            $hermanosPorTutor = [];
            if (!empty($curpsTutores)) {
                $coincidencias = $db->table('tutores')
                    ->select('tutores.curp_tutor, alumnos_inscritos.id_alumno, alumnos_inscritos.nombre_alumno, alumnos_inscritos.primer_apellido_alumno, alumnos_inscritos.segundo_apellido_alumno, alumnos_inscritos.grado, alumnos_inscritos.grupo')
                    ->join('alumnos_inscritos', 'alumnos_inscritos.id_alumno = tutores.id_alumno')
                    ->whereIn('tutores.curp_tutor', $curpsTutores)
                    ->groupStart()
                        ->where('alumnos_inscritos.mov_f !=', 'B')
                        ->orWhere('alumnos_inscritos.mov_f', null)
                    ->groupEnd()
                    ->orderBy('alumnos_inscritos.grado', 'ASC')
                    ->orderBy('alumnos_inscritos.grupo', 'ASC')
                    ->get()
                    ->getResult();

                foreach ($coincidencias as $item) {
                    $hermanosPorTutor[$item->curp_tutor][] = $item;
                }
            }

            // 4. Asignamos a cada alumno su arreglo de hermanos (excluyéndose a sí mismo)
            foreach ($alumnos as $al) {
                $al->hermanos = [];
                if (!empty($al->curp_tutor) && isset($hermanosPorTutor[$al->curp_tutor])) {
                    foreach ($hermanosPorTutor[$al->curp_tutor] as $posibleHermano) {
                        if ((int) $posibleHermano->id_alumno !== (int) $al->id_alumno) {
                            $al->hermanos[] = [
                                'nombre' => "{$posibleHermano->nombre_alumno} {$posibleHermano->primer_apellido_alumno} {$posibleHermano->segundo_apellido_alumno}",
                                'grado'  => $posibleHermano->grado,
                                'grupo'  => $posibleHermano->grupo,
                            ];
                        }
                    }
                }
            }

            
        }

        $data = [
            'titulo'            => 'Consulta de Alumnos por Grupo',
            'gradosDisponibles' => $gradosDisponibles,
            'gruposDisponibles' => $gruposDisponibles,
            'gradoSeleccionado' => $gradoSeleccionado,
            'grupoSeleccionado' => $grupoSeleccionado,
            'alumnos'           => $alumnos,
            'resumen'           => $resumen,
            'escuela'           => $escuela
        ];

        return view('direccion/alumnos/por_grupo', $data);
    }



    
    // === Método para ver la constancia de inscripción (pendiente) ======
    public function constIns($idAlumno = null)
    {
        $alumnoModel    = new AlumnoModel();
        $escuelaModel   = new EscuelaModel();        

        $alumno = $alumnoModel->find($idAlumno);
        if (!$alumno) {
            return redirect()->to(site_url('direccion/alumnos'))
                             ->with('error', 'El expediente solicitado no existe.');
        }

        // Consultamos los registros de la escuela
        $escuela = $escuelaModel->where('id_escuela', 1)->first();

        $data = [
            'alumno'    => $alumno,
            'escuela'     => $escuela,
         
        ];

        return view('direccion/alumnos/constancia_i', $data);
    }



    public function estadisticaEdades()
    {
        $db = \Config\Database::connect();
        $gradoSeleccionado = $this->request->getGet('grado') ?? 'todos'; // Por defecto muestra de 1° a 6°

        // 1. Obtener fecha_referencia de la tabla escuela
        $escuela = $db->table('escuela')->select('fecha_referencia, ciclo_escolar')->get()->getRow();
        $fechaReferencia = $escuela->fecha_referencia ?? date('Y-09-01');

        // 2. Consultar alumnos elegibles (solo mov_i = 'I' y sin baja mov_f != 'B')
        $builder = $db->table('alumnos_inscritos')
            ->select('grado, fec_nac_alumno, sexo_alumno, reprobado')
            ->where('mov_i', 'I')
            ->groupStart()
                ->where('mov_f IS NULL')
                ->orWhere('mov_f !=', 'B')
            ->groupEnd();

        if ($gradoSeleccionado !== 'todos') {
            $builder->where('grado', $gradoSeleccionado);
        }

        $alumnos = $builder->get()->getResult();

        // 3. Definir estructura base de columnas y filas
        $columnasEdad = ['menor_6', 6, 7, 8, 9, 10, 11, 12, 13, 14, '15_mas'];
        $plantillaFila = array_fill_keys($columnasEdad, 0);
        $plantillaFila['total'] = 0;

        $plantillaBloque = [
            'filas' => [
                'HOMBRE_NO' => $plantillaFila, // Hom - Nuevo Ingreso
                'HOMBRE_SI' => $plantillaFila, // Hom - Repetidores
                'MUJER_NO'  => $plantillaFila, // Muj - Nuevo Ingreso
                'MUJER_SI'  => $plantillaFila, // Muj - Repetidores
            ],
            'subtotal' => $plantillaFila,
        ];

        $gradosAMostrar = ($gradoSeleccionado === 'todos') ? ['1', '2', '3', '4', '5', '6'] : [$gradoSeleccionado];
        $datosPorGrado = [];
        foreach ($gradosAMostrar as $g) {
            $datosPorGrado[$g] = $plantillaBloque;
        }

        // Bloque de Totales Generales (igual a la imagen adjunta)
        $totalesGenerales = $plantillaBloque;

        $refDate = new \DateTime($fechaReferencia);

        // 4. Calcular edad exacta y acumular en su grado y en el total general
        foreach ($alumnos as $al) {
            if (empty($al->fec_nac_alumno) || !isset($datosPorGrado[$al->grado])) {
                continue;
            }

            $nacDate = new \DateTime($al->fec_nac_alumno);
            $edad = (int) $nacDate->diff($refDate)->y;

            if ($edad < 6) {
                $claveEdad = 'menor_6';
            } elseif ($edad >= 15) {
                $claveEdad = '15_mas';
            } else {
                $claveEdad = $edad;
            }

            $sexo      = strtoupper($al->sexo_alumno);
            $rep       = strtoupper($al->reprobado ?? 'NO');
            $llaveFila = "{$sexo}_{$rep}";
            $g         = (string) $al->grado;

            if (isset($datosPorGrado[$g]['filas'][$llaveFila])) {
                // Acumular en el grado correspondiente
                $datosPorGrado[$g]['filas'][$llaveFila][$claveEdad]++;
                $datosPorGrado[$g]['filas'][$llaveFila]['total']++;
                $datosPorGrado[$g]['subtotal'][$claveEdad]++;
                $datosPorGrado[$g]['subtotal']['total']++;

                // Acumular en el bloque de Totales Generales
                $totalesGenerales['filas'][$llaveFila][$claveEdad]++;
                $totalesGenerales['filas'][$llaveFila]['total']++;
                $totalesGenerales['subtotal'][$claveEdad]++;
                $totalesGenerales['subtotal']['total']++;
            }
        }

        $data = [
            'titulo'            => 'Estadística por Grado, Sexo y Edad',
            'gradoSeleccionado' => $gradoSeleccionado,
            'fechaReferencia'   => $fechaReferencia,
            'cicloEscolar'      => $escuela->ciclo_escolar ?? '',
            'columnasEdad'      => $columnasEdad,
            'datosPorGrado'     => $datosPorGrado,
            'totalesGenerales'  => $totalesGenerales,
        ];

        return view('direccion/alumnos/estadistica_edades', $data);
    }


       




}
