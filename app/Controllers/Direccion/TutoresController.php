<?php

namespace App\Controllers\Direccion;

use App\Controllers\BaseController;
use App\Models\TutorModel;

class TutoresController extends BaseController
{
    public function index()
    {
        $tutorModel = new TutorModel();
        $busqueda = $this->request->getGet('q');

        $tutorModel->select([
            'tutores.id_tutor',
            'tutores.id_alumno',
            'tutores.curp_tutor',
            'tutores.nombre_tutor',
            'tutores.primer_apellido_tutor',
            'tutores.segundo_apellido_tutor',
            'tutores.sexo_tutor',
            'tutores.nombre_tutor2',
            'tutores.primer_apellido_tutor2',
            'tutores.segundo_apellido_tutor2',
            'alumnos_inscritos.nombre_alumno',
            'alumnos_inscritos.primer_apellido_alumno',
            'alumnos_inscritos.segundo_apellido_alumno',
            'alumnos_inscritos.grado',
            'alumnos_inscritos.grupo'
        ]);
        
        $tutorModel->join('alumnos_inscritos', 'alumnos_inscritos.id_alumno = tutores.id_alumno', 'inner');

        if (!empty($busqueda)) {
            $tutorModel->groupStart()
                ->like('tutores.curp_tutor', $busqueda)
                ->orLike("CONCAT_WS(' ', tutores.nombre_tutor, tutores.primer_apellido_tutor, tutores.segundo_apellido_tutor)", $busqueda)
                ->orLike("CONCAT_WS(' ', tutores.nombre_tutor2, tutores.primer_apellido_tutor2, tutores.segundo_apellido_tutor2)", $busqueda)
                ->orLike("CONCAT_WS(' ', alumnos_inscritos.nombre_alumno, alumnos_inscritos.primer_apellido_alumno, alumnos_inscritos.segundo_apellido_alumno)", $busqueda)
            ->groupEnd();
        }

        $tutorModel->orderBy('tutores.primer_apellido_tutor', 'ASC');

        $data = [
            'titulo'   => 'Directorio de Tutores',
            'tutores'  => $tutorModel->findAll(),
            'busqueda' => $busqueda,
        ];

        return view('direccion/tutores/index', $data);
    }
}
