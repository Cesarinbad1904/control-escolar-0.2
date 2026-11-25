<?php

namespace App\Controllers\Direccion;

use App\Controllers\BaseController;
use App\Models\AlumnoBaseModel;

class AlumnosBaseController extends BaseController
{
    public function nuevo()
    {
        $data = [
            'titulo' => 'Autorizar Nuevo Alumno',
        ];

        return view('direccion/alumnos_base/nuevo', $data);
    }




    public function guardar()
    {
        // Ejecuta la validación llamando al grupo centralizado
        if (! $this->validate('nuevoAlumno')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Validación condicional para fecha_alta cuando es Alta ('A')
        $movimiento = $this->request->getPost('mov_i');
        $fechaAlta  = $this->request->getPost('fecha_alta');

        if ($movimiento === 'A' && empty($fechaAlta)) {
            return redirect()->back()->withInput()->with('errors', [
                'fecha_alta' => 'Debes especificar la fecha de alta para este movimiento.'
            ]);
        }

        // 3. Concatenar nombre completo en mayúsculas y limitar a 50 caracteres
        $paterno = mb_strtoupper(trim($this->request->getPost('primer_apellido')));
        $materno = mb_strtoupper(trim($this->request->getPost('segundo_apellido')));
        $nombres = mb_strtoupper(trim($this->request->getPost('nombres')));
        
        $nombreCompleto = preg_replace('/\s+/', ' ', trim("$paterno $materno $nombres"));
        $nombreCompleto = mb_substr($nombreCompleto, 0, 50);

        $grupo = mb_strtoupper(trim($this->request->getPost('grupo') ?? ''));
        $grado = (string) ($this->request->getPost('grado')); 

        $alumnoBaseModel = new AlumnoBaseModel();

        $datosInsertar = [
            'nombre'     => $nombreCompleto,
            'curp'       => mb_strtoupper(trim($this->request->getPost('curp'))),
            'grado'      => $grado,
            'grupo'      => $grupo,
            'origen'     => $this->request->getPost('origen'),
            'mov_i'      => $movimiento,
            'fecha_alta' => ($movimiento === 'A') ? $fechaAlta : null,
        ];

        $alumnoBaseModel->insert($datosInsertar);

        return redirect()->to(base_url('direccion/alumnos-base/nuevo'))
                         ->with('success', "Alumno ($nombreCompleto) autorizado correctamente. El tutor ya puede iniciar su registro.");
    }




        public function index()
    {
        $alumnoBaseModel = new AlumnoBaseModel();
        $busqueda = $this->request->getGet('q');
        $estatus  = $this->request->getGet('estatus'); // 'completado' | 'pendiente' | ''

        $alumnoBaseModel->select([
            'alumnos_base.id_alumno',
            'alumnos_base.nombre',
            'alumnos_base.curp',
            'alumnos_base.grado',
            'alumnos_base.grupo',
            'alumnos_base.origen',
            'alumnos_base.mov_i',
            'alumnos_inscritos.id_alumno AS id_inscrito' // Será NULL si aún no se registra
        ]);

        $alumnoBaseModel->join('alumnos_inscritos', 'alumnos_inscritos.curp = alumnos_base.curp', 'left');

        // Filtro por texto (Nombre o CURP)
        if (!empty($busqueda)) {
            $alumnoBaseModel->groupStart()
                ->like('alumnos_base.nombre', $busqueda)
                ->orLike('alumnos_base.curp', $busqueda)
            ->groupEnd();
        }

        // Filtro opcional por estatus
        if ($estatus === 'completado') {
            $alumnoBaseModel->where('alumnos_inscritos.id_alumno IS NOT NULL');
        } elseif ($estatus === 'pendiente') {
            $alumnoBaseModel->where('alumnos_inscritos.id_alumno IS NULL');
        }

        $alumnoBaseModel->orderBy('alumnos_base.nombre', 'ASC');

        $data = [
            'titulo'   => 'Padrón de Alumnos Autorizados',
            'alumnos'  => $alumnoBaseModel->findAll(),
            'busqueda' => $busqueda,
            'estatus'  => $estatus,
        ];

        return view('direccion/alumnos_base/index', $data);
    }




    public function actualizarGradoGrupo()
    {
        $idAlumno = $this->request->getPost('id_alumno');
        $grado    = $this->request->getPost('grado');
        $grupo    = mb_strtoupper(trim($this->request->getPost('grupo') ?? ''));

        $alumnoBaseModel = new AlumnoBaseModel();
        $alumno = $alumnoBaseModel->find($idAlumno);

        if (!$alumno) {
            return redirect()->back()->with('error', 'El registro seleccionado no existe.');
        }

        // Seguridad extra en servidor: verificar que NO esté inscrito aún
        $db = \Config\Database::connect();
        $yaInscrito = $db->table('alumnos_inscritos')
                         ->where('curp', $alumno->curp)
                         ->countAllResults() > 0;

        if ($yaInscrito) {
            return redirect()->back()->with('error', 'No se puede editar desde el padrón porque el alumno ya completó su inscripción.');
        }

        $alumnoBaseModel->update($idAlumno, [
            'grado' => $grado,
            'grupo' => $grupo,
        ]);

        return redirect()->to(base_url('direccion/alumnos-base'))
                         ->with('success', "Se actualizó el grado y grupo de {$alumno->nombre}.");
    }



        public function porGrupo()
    {
        $grado = $this->request->getGet('grado');
        $grupo = $this->request->getGet('grupo');

        $alumnos      = [];
        $totalHombres = 0;
        $totalMujeres = 0;
        $busquedaRealizada = ($grado !== null && $grado !== '' && !empty($grupo));

        if ($busquedaRealizada) {
            $alumnoBaseModel = new AlumnoBaseModel();

            $alumnos = $alumnoBaseModel->select([
                    'alumnos_base.id_alumno',
                    'alumnos_base.nombre',
                    'alumnos_base.curp',
                    'alumnos_base.grado',
                    'alumnos_base.grupo',
                    'alumnos_inscritos.id_alumno AS id_inscrito'
                ])
                ->join('alumnos_inscritos', 'alumnos_inscritos.curp = alumnos_base.curp', 'left')
                ->where('alumnos_base.grado', $grado)
                ->where('alumnos_base.grupo', $grupo)
                ->orderBy('alumnos_base.nombre', 'ASC')
                ->findAll();

            // Contabilizar mujeres y hombres a partir de la posición 11 (índice 10) de la CURP
            foreach ($alumnos as $alumno) {
                $letraSexo = strtoupper(substr($alumno->curp, 10, 1));
                if ($letraSexo === 'M') {
                    $totalMujeres++;
                } elseif ($letraSexo === 'H') {
                    $totalHombres++;
                }
            }
        }

        $data = [
            'titulo'            => 'Consulta de Alumnos Autorizados por Grupo',
            'grado'             => $grado,
            'grupo'             => $grupo,
            'alumnos'           => $alumnos,
            'totalMujeres'      => $totalMujeres,
            'totalHombres'      => $totalHombres,
            'busquedaRealizada' => $busquedaRealizada,
        ];

        return view('direccion/alumnos_base/por_grupo', $data);
    }



           public function estadistica()
    {
        $db = \Config\Database::connect();

        // Consulta agrupada por grado y grupo con conteo de sexo y avance de inscripción
        $builder = $db->table('alumnos_base b');
        $builder->select("
            b.grado,
            b.grupo,
            SUM(CASE WHEN SUBSTRING(b.curp, 11, 1) = 'H' THEN 1 ELSE 0 END) AS hombres,
            SUM(CASE WHEN SUBSTRING(b.curp, 11, 1) = 'M' THEN 1 ELSE 0 END) AS mujeres,
            COUNT(*) AS total,
            SUM(CASE WHEN i.id_alumno IS NOT NULL THEN 1 ELSE 0 END) AS completados,
            SUM(CASE WHEN i.id_alumno IS NULL THEN 1 ELSE 0 END) AS pendientes
        ");
        $builder->join('alumnos_inscritos i', 'i.curp = b.curp', 'left');
        $builder->groupBy(['b.grado', 'b.grupo']);
        $builder->orderBy('b.grado', 'ASC');
        $builder->orderBy('b.grupo', 'ASC');

        $estadisticas = $builder->get()->getResult();

        // Calcular totales generales
        $totalGeneralHombres     = 0;
        $totalGeneralMujeres     = 0;
        $totalGeneralAlumnos     = 0;
        $totalGeneralCompletados = 0;
        $totalGeneralPendientes  = 0;

        foreach ($estadisticas as $fila) {
            $totalGeneralHombres     += (int) $fila->hombres;
            $totalGeneralMujeres     += (int) $fila->mujeres;
            $totalGeneralAlumnos     += (int) $fila->total;
            $totalGeneralCompletados += (int) $fila->completados;
            $totalGeneralPendientes  += (int) $fila->pendientes;
        }

        $data = [
            'titulo'                  => 'Estadística de Alumnos Autorizados',
            'estadisticas'            => $estadisticas,
            'totalGeneralHombres'     => $totalGeneralHombres,
            'totalGeneralMujeres'     => $totalGeneralMujeres,
            'totalGeneralAlumnos'     => $totalGeneralAlumnos,
            'totalGeneralCompletados' => $totalGeneralCompletados,
            'totalGeneralPendientes'  => $totalGeneralPendientes,
            'totalGrupos'             => count($estadisticas),
        ];

        return view('direccion/alumnos_base/estadistica', $data);
    }



    

        public function eliminar()
    {
        $idAlumno = $this->request->getPost('id_alumno');

        $alumnoBaseModel = new AlumnoBaseModel();
        $alumno = $alumnoBaseModel->find($idAlumno);

        if (!$alumno) {
            return redirect()->back()->with('error', 'El registro seleccionado no existe.');
        }

        // Seguridad en servidor: verificar que NO esté registrado en alumnos_inscritos
        $db = \Config\Database::connect();
        $yaInscrito = $db->table('alumnos_inscritos')
                         ->where('curp', $alumno->curp)
                         ->countAllResults() > 0;

        if ($yaInscrito) {
            return redirect()->back()->with('error', 'No se puede eliminar este registro porque el alumno ya completó su inscripción.');
        }

        $nombreEliminado = $alumno->nombre;
        $alumnoBaseModel->delete($idAlumno);

        return redirect()->to(base_url('direccion/alumnos-base'))
                         ->with('success', "Se eliminó a {$nombreEliminado} del padrón de alumnos autorizados.");
    }




   
}
