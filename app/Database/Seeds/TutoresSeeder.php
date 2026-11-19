<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class TutoresSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('es_MX');
        $db = \Config\Database::connect();

        // Obtenemos todos los IDs de alumnos existentes
        $alumnos = $db->table('alumnos_inscritos')->select('id_alumno')->get()->getResultArray();
        $builder = $db->table('tutores');

        $sexos = ['HOMBRE', 'MUJER'];
        $estudios = ['Secundaria', 'Preparatoria', 'Licenciatura', 'Posgrado', 'Carrera Técnica'];
        $parentescos = ['Madre', 'Padre', 'Abuelo(a)', 'Tío(a)'];
        $estadosCiviles = ['Casado(a)', 'Soltero(a)', 'Unión Libre', 'Divorciado(a)'];
        $salarios = ['$4,000 - $8,000', '$8,001 - $15,000', 'Más de $15,000'];
        $siNo = ['NO', 'SI'];

        foreach ($alumnos as $alumno) {
            $sexo1 = $faker->randomElement($sexos);
            $fechaNac1 = $faker->dateTimeBetween('-50 years', '-25 years');
            $curp1 = strtoupper($faker->lexify('????')) . $fechaNac1->format('ymd') . ($sexo1 === 'HOMBRE' ? 'H' : 'M') . 'MC' . strtoupper($faker->lexify('???')) . $faker->numerify('##');

            $sexo2 = $faker->randomElement($sexos);
            $fechaNac2 = $faker->dateTimeBetween('-50 years', '-25 years');
            $curp2 = strtoupper($faker->lexify('????')) . $fechaNac2->format('ymd') . ($sexo2 === 'HOMBRE' ? 'H' : 'M') . 'MC' . strtoupper($faker->lexify('???')) . $faker->numerify('##');

            $data = [
                'id_alumno'               => $alumno['id_alumno'],
                'curp_tutor'              => $curp1,
                'nombre_tutor'            => mb_substr($faker->firstName($sexo1 === 'HOMBRE' ? 'male' : 'female'), 0, 25),
                'primer_apellido_tutor'   => mb_substr($faker->lastName(), 0, 25),
                'segundo_apellido_tutor'  => mb_substr($faker->lastName(), 0, 25),
                'sexo_tutor'              => $sexo1,
                'fec_nac_tutor'           => $fechaNac1->format('Y-m-d'),
                'entidad_nac_tutor'       => 'MEXICO',
                'nacionalidad_tutor'      => 'MEXICANA',
                'ocupacion_tutor'         => mb_substr($faker->jobTitle(), 0, 40),
                'estudios_tutor'          => $faker->randomElement($estudios),
                'parentesco_tutor'        => $faker->randomElement($parentescos),
                'salario_tutor'           => $faker->randomElement($salarios),
                'estado_civil_tutor'      => $faker->randomElement($estadosCiviles),
                'email_tutor'             => mb_substr($faker->safeEmail(), 0, 50),
                'rs_tutor'                => 'Facebook',
                'rs_user_tutor'           => mb_substr($faker->userName(), 0, 20),

                // Segundo tutor
                'curp_tutor2'             => $curp2,
                'nombre_tutor2'           => mb_substr($faker->firstName($sexo2 === 'HOMBRE' ? 'male' : 'female'), 0, 25),
                'primer_apellido_tutor2'  => mb_substr($faker->lastName(), 0, 25),
                'segundo_apellido_tutor2' => mb_substr($faker->lastName(), 0, 25),
                'sexo_tutor2'             => $sexo2,
                'ocupacion_tutor2'        => mb_substr($faker->jobTitle(), 0, 40),
                'estudios_tutor2'         => $faker->randomElement($estudios),
                'parentesco_tutor2'       => $faker->randomElement($parentescos),
                'salario_tutor2'          => $faker->randomElement($salarios),
                'estado_civil_tutor2'     => $faker->randomElement($estadosCiviles),
                'email_tutor2'            => mb_substr($faker->safeEmail(), 0, 50),
                'rs_tutor2'               => 'WhatsApp',
                'rs_user_tutor2'          => $faker->numerify('55########'),

                'responsabilidad'         => $faker->randomElement($siNo),
                'recoge'                  => $faker->randomElement($siNo),
                'mov_f'                   => null,
            ];

            $builder->insert($data);
        }
    }
}

