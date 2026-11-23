<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class AlumnosInscritosSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('es_ES');
        $db = \Config\Database::connect();
        $builder = $db->table('alumnos_inscritos');

        $sexos = ['HOMBRE', 'MUJER'];
        $viveCon = ['MAMA', 'PAPA', 'AMBOS'];
        $siNo = ['NO', 'SI'];
        $origenes = ['ME', 'SA', 'NI'];
        $grupos = ['A', 'B', 'C'];
        $redes = ['Facebook', 'Instagram', 'TikTok', 'WhatsApp'];
        
        // Catálogo oficial de entidades de tu expresión regular
        $entidadesCurp = [
            'AS', 'BC', 'BS', 'CC', 'CS', 'CH', 'CL', 'CM', 'DF', 'DG', 
            'GT', 'GR', 'HG', 'JC', 'MC', 'MN', 'MS', 'NT', 'NL', 'OC', 
            'PL', 'QT', 'QR', 'SP', 'SL', 'SR', 'TC', 'TS', 'TL', 'VZ', 
            'YN', 'ZS', 'NE'
        ];

        for ($i = 0; $i < 20; $i++) {
            $sexo = $faker->randomElement($sexos);
            $letraSexo = ($sexo === 'HOMBRE') ? 'H' : 'M';
            $fechaNac = $faker->dateTimeBetween('-15 years', '-6 years');
            
            // Construcción de CURP 100% compatible con tu expresión regular
            $curp = strtoupper($faker->regexify('[A-Z][XAEIOU][A-Z]{2}'))
                  . $fechaNac->format('ymd')
                  . $letraSexo
                  . $faker->randomElement($entidadesCurp)
                  . strtoupper($faker->regexify('[B-DF-HJ-NP-TV-Z]{3}'))
                  . strtoupper($faker->regexify('[0-9A-Z][0-9]'));

            $data = [
                'curp'                       => $curp,
                'nombre_alumno'              => mb_substr($faker->firstName($sexo === 'HOMBRE' ? 'male' : 'female'), 0, 25),
                'primer_apellido_alumno'     => mb_substr($faker->lastName(), 0, 25),
                'segundo_apellido_alumno'    => mb_substr($faker->lastName(), 0, 25),
                'sexo_alumno'                => $sexo,
                'fec_nac_alumno'             => $fechaNac->format('Y-m-d'),
                'entidad_nac_alumno'         => 'MEXICO',
                'nacionalidad_alumno'        => 'MEXICANA',
                'entidad_dom'                => 'MEXICO',
                'municipio_dom'              => mb_substr($faker->city(), 0, 100),
                'localidad_dom'              => mb_substr($faker->city(), 0, 100),
                'colonia_dom'                => mb_substr('Col. ' . $faker->streetName(), 0, 100),
                'calle_num_dom'              => mb_substr($faker->streetAddress(), 0, 100),
                'entre_calle_1'              => mb_substr($faker->streetName(), 0, 50),
                'entre_calle_2'              => mb_substr($faker->streetName(), 0, 50),
                'cp'                         => $faker->numerify('#####'),
                'referencia_dom'             => mb_substr('Casa color ' . $faker->safeColorName(), 0, 100),
                'telefono_1'                 => $faker->numerify('55########'),
                'telefono_2'                 => $faker->numerify('55########'),
                'telefono_emer'              => $faker->numerify('55########'),
                'email_alumno'               => mb_substr($faker->unique()->safeEmail(), 0, 50),
                'rs_alumno'                  => $faker->randomElement($redes),
                'rs_user_alumno'             => mb_substr('@' . $faker->userName(), 0, 20),
                'num_personas'               => (string) $faker->numberBetween(2, 8),
                'vive_con'                   => $faker->randomElement($viveCon),
                'sosten_econ'                => $faker->randomElement($viveCon),
                'nombre_escuela_procedencia' => mb_substr('Esc. Primaria ' . $faker->lastName(), 0, 50),
                'cct_anterior'               => $faker->boolean(30) ? '15EPR' . $faker->numerify('####') . 'X' : null,
                'computadora'                => $faker->randomElement($siNo),
                'tablet'                     => $faker->randomElement($siNo),
                'internet_casa'              => $faker->randomElement($siNo),
                'internet_movil'             => $faker->randomElement($siNo),
                'tv_paga'                    => $faker->randomElement($siNo),
                'tv_abierta'                 => $faker->randomElement($siNo),
                'radio'                      => $faker->randomElement($siNo),
                'grado'                      => (string) $faker->numberBetween(1, 6),
                'grupo'                      => $faker->randomElement($grupos),
                'mov_i'                      => 'I',
                'mov_f'                      => null,
                'fecha_alta'                 => null,
                'fecha_baja'                 => null,
                //'reprobado'                  => $faker->randomElement($siNo),
                'reprobado'                  => 'NO',
                'origen'                     => $faker->randomElement($origenes),
                'anios_prescolar'            => (string) $faker->numberBetween(1, 3),
            ];

            $builder->insert($data);
        }
    }
}
