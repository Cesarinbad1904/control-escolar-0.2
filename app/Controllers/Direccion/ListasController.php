<?php

namespace App\Controllers\Direccion;

use App\Controllers\BaseController;

class ListasController extends BaseController
{
    public function generador()
    {
        $grado = $this->request->getGet('grado');
        $grupo = $this->request->getGet('grupo');

        $alumnos = [];
        $busquedaRealizada = (!empty($grado) && !empty($grupo));

        if ($busquedaRealizada) {
            $db = \Config\Database::connect();
            $builder = $db->table('alumnos_inscritos a');

            $builder->select([
                'a.id_alumno',
                'a.curp',
                'a.nombre_alumno',
                'a.primer_apellido_alumno',
                'a.segundo_apellido_alumno',
                'a.sexo_alumno',
                'a.fec_nac_alumno',
                'a.telefono_1',
                'a.telefono_emer',
                'a.email_alumno',
                'a.calle_num_dom',
                'a.colonia_dom',
                'a.municipio_dom',
                'a.cp',
                't.nombre_tutor',
                't.primer_apellido_tutor',
                't.segundo_apellido_tutor',
                't.parentesco_tutor',
                'h.tipo_sangre',
                'h.alergia_medicamento',
                'h.alergia_alimento'
            ]);

            $builder->join('tutores t', 't.id_alumno = a.id_alumno', 'left');
            $builder->join('historial_medico h', 'h.id_alumno = a.id_alumno', 'left');

            $builder->where('a.grado', $grado);
            $builder->where('a.grupo', $grupo);
            // Excluir bajas si mov_f tiene 'B'
            $builder->groupStart()
                ->where('a.mov_f IS NULL')
                ->orWhere('a.mov_f !=', 'B')
            ->groupEnd();

            $builder->orderBy('a.primer_apellido_alumno', 'ASC');
            $builder->orderBy('a.segundo_apellido_alumno', 'ASC');
            $builder->orderBy('a.nombre_alumno', 'ASC');

            $alumnos = $builder->get()->getResultArray();
        }

        $data = [
            'titulo'            => 'Generador de Listas Personalizadas',
            'grado'             => $grado,
            'grupo'             => $grupo,
            'alumnos'           => $alumnos,
            'busquedaRealizada' => $busquedaRealizada,
        ];

        return view('direccion/listas/generador', $data);
    }
}
