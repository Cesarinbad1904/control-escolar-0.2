<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CalificacionesSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // Obtenemos todos los IDs de alumnos existentes
        $alumnos = $db->table('alumnos_inscritos')->select('id_alumno')->get()->getResultArray();
        $builder = $db->table('calificaciones');

        foreach ($alumnos as $alumno) {
            $data = [
                'id_alumno'          => $alumno['id_alumno'],

                // Primer periodo
                'asig_101'           => 5,
                'asig_102'           => 5,
                'asig_103'           => 5,
                'asig_104'           => 5,
                'inasistencias_1'    => '0',

                // Segundo periodo
                'asig_201'           => 5,
                'asig_202'           => 5,
                'asig_203'           => 5,
                'asig_204'           => 5,
                'inasistencias_2'    => '0',

                // Tercer periodo
                'asig_301'           => 5,
                'asig_302'           => 5,
                'asig_303'           => 5,
                'asig_304'           => 5,
                'inasistencias_3'    => '0',

                'fecha_ultima_vista' => null,
            ];

            $builder->insert($data);
        }
    }
}
