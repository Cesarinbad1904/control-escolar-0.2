<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class HistorialMedicoSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('es_MX');
        $db = \Config\Database::connect();

        $alumnos = $db->table('alumnos_inscritos')->select('id_alumno')->get()->getResultArray();
        $builder = $db->table('historial_medico');

        $tiposSangre = ['O+', 'O-', 'A+', 'A-', 'B+', 'AB+', 'NR'];
        $instituciones = ['IMSS', 'ISSSTE', 'ISSEMYM', 'INSABI', 'Particular'];
        $dosisCovid = ['NINGUNA', '1a dosis', '2a dosis', '3a dosis'];
        $siNo = ['NO', 'SI'];
        $familiares = ['NINGUNO', 'Abuelo paterno', 'Abuela materna', 'Padre', 'Madre'];

        foreach ($alumnos as $alumno) {
            $data = [
                'id_alumno'               => $alumno['id_alumno'],
                'estatura'                => (string) $faker->numberBetween(110, 165),
                'peso'                    => (string) $faker->numberBetween(20, 65),
                'tipo_sangre'             => $faker->randomElement($tiposSangre),
                'talla_zapato'            => (string) $faker->numberBetween(18, 25),
                'zapato_orto'             => $faker->randomElement($siNo),
                'lentes'                  => $faker->randomElement($siNo),
                'vacunas'                 => 'Esquema básico completo',
                'apoyo_1'                 => $faker->randomElement($siNo),
                'apoyo_2'                 => $faker->randomElement($siNo),
                'apoyo_3'                 => 'NO',
                'apoyo_4'                 => 'NO',
                'apoyo_5'                 => 'NO',
                'otro_apoyo'              => null,
                'discapacidad'            => 'NINGUNA',
                'covid'                   => $faker->randomElement($siNo),
                'covid_dosis'             => $faker->randomElement($dosisCovid),
                'ultimas_enfermedades'    => $faker->randomElement(['Ninguna reciente', 'Resfriado común', 'Infección de garganta']),
                'enfermedades_frecuentes' => $faker->randomElement(['Ninguna', 'Gripe estacional', 'Alergia al polvo']),
                'nombre_medico'           => $faker->boolean(50) ? mb_substr('Dr. ' . $faker->name(), 0, 50) : null,
                'tel_medico'              => $faker->boolean(50) ? $faker->numerify('55########') : null,
                'institucion_dh'          => $faker->randomElement($instituciones),
                'recomendaciones'         => 'NINGUNA',
                'sobrepeso'               => $faker->randomElement($siNo),
                'corazon'                 => 'NO',
                'bronquitis'              => 'NO',
                'hemorragias'             => 'NO',
                'epilepsia'               => 'NO',
                'fiebre_reumatica'        => 'NO',
                'cancer'                  => 'NO',
                'diabetes'                => 'NO',
                'amigdalitis'             => $faker->randomElement($siNo),
                'anemia'                  => 'NO',
                'hepatitis'               => 'NO',
                'neoplasias'              => 'NO',
                'enfermedad_cronica'      => 'NINGUNA',
                'dificultad_dormir'       => 'NO',
                'fiebre_frecuente'        => 'NO',
                'falta_aire'              => 'NO',
                'dolor_piernas'           => 'NO',
                'desmayos_frecuentes'     => 'NO',
                'transfusion'             => 'NO',
                'impedimento'             => 'NO',
                'alergia_medicamento'     => $faker->randomElement(['NO', 'Penicilina', 'Sulfas']),
                'alergia_alimento'        => $faker->randomElement(['NO', 'Nueces', 'Mariscos']),
                'hemorragias_frecuentes'  => 'NO',
                'antecedente_medico'      => 'NO',
                'intervencion_quirurgica' => 'NO',
                'familiar_diabetes'       => $faker->randomElement($familiares),
                'familiar_corazon'        => $faker->randomElement($familiares),
                'familiar_hipertension'   => $faker->randomElement($familiares),
                'familiar_cancer'         => 'NINGUNO',
            ];

            $builder->insert($data);
        }
    }
}

?>