<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class DocentesSeeder extends Seeder
{
    public function run()
    {
        $fakerNombres = Factory::create('es_ES');
        $faker        = Factory::create('es_MX');
        $db           = \Config\Database::connect();
        $builder      = $db->table('docentes');

        // Limpia la tabla antes de insertar los datos de prueba
        $builder->truncate();

        $entidadesCurp = [
            'AS', 'BC', 'BS', 'CC', 'CS', 'CH', 'CL', 'CM', 'DF', 'DG',
            'GT', 'GR', 'HG', 'JC', 'MC', 'MN', 'MS', 'NT', 'NL', 'OC',
            'PL', 'QT', 'QR', 'SP', 'SL', 'SR', 'TC', 'TS', 'TL', 'VZ',
            'YN', 'ZS', 'NE'
        ];

        // Definimos 4 docentes de prueba con usuarios conocidos para facilitar tus pruebas de login
        $docentesPrueba = [
            [
                'usuario' => 'docente1a',
                'pass'    => '123456',
                'sexo'    => 'MUJER',
                'grado'   => '1',
                'grupo'   => 'A',
                'salon'   => '01',
                'activo'  => 'SI',
            ],
            [
                'usuario' => 'docente2b',
                'pass'    => '123456',
                'sexo'    => 'HOMBRE',
                'grado'   => '2',
                'grupo'   => 'B',
                'salon'   => '05',
                'activo'  => 'SI',
            ],
            [
                'usuario' => 'docente3a',
                'pass'    => '123456',
                'sexo'    => 'MUJER',
                'grado'   => '3',
                'grupo'   => 'A',
                'salon'   => '07',
                'activo'  => 'SI',
            ],
            [
                'usuario' => 'docente_inactivo',
                'pass'    => '123456',
                'sexo'    => 'HOMBRE',
                'grado'   => '4',
                'grupo'   => 'C',
                'salon'   => '11',
                'activo'  => 'NO',
            ],
        ];

        foreach ($docentesPrueba as $doc) {
            $generoFaker = ($doc['sexo'] === 'HOMBRE') ? 'male' : 'female';
            $letraSexo   = ($doc['sexo'] === 'HOMBRE') ? 'H' : 'M';
            $fechaNac    = $faker->dateTimeBetween('-55 years', '-26 years');

            $nombreCompleto = mb_strtoupper(
                $fakerNombres->firstName($generoFaker) . ' ' .
                $fakerNombres->lastName() . ' ' .
                $fakerNombres->lastName()
            );

            $curp = strtoupper($faker->regexify('[A-Z][XAEIOU][A-Z]{2}'))
                  . $fechaNac->format('ymd')
                  . $letraSexo
                  . $faker->randomElement($entidadesCurp)
                  . strtoupper($faker->regexify('[B-DF-HJ-NP-TV-Z]{3}'))
                  . strtoupper($faker->regexify('[0-9A-Z][0-9]'));

            $rfc = substr($curp, 0, 10) . strtoupper($faker->regexify('[0-9A-Z]{3}'));

            $data = [
                'nombre'              => mb_substr($nombreCompleto, 0, 50),
                'curp'                => $curp,
                'estado_civil'        => $faker->randomElement(['CASADO(A)', 'SOLTERO(A)', 'UNIÓN LIBRE']),
                'direccion'           => mb_substr($faker->streetAddress(), 0, 100),
                'localidad'           => 'TEXCOCO DE MORA',
                'municipio'           => 'TEXCOCO',
                'cp'                  => '56100',
                'tel_fijo'            => $faker->numerify('595#######'),
                'tel_cel'             => $faker->numerify('55########'),
                'email'               => $doc['usuario'] . '@escuela.edu.mx',

                // Familiares emergencia
                'nombre_fam_1'        => mb_substr(mb_strtoupper($fakerNombres->name()), 0, 50),
                'parent_fam_1'        => $faker->randomElement(['ESPOSO(A)', 'MADRE', 'PADRE', 'HERMANO(A)']),
                'tel_fam_1'           => $faker->numerify('55########'),
                'nombre_fam_2'        => mb_substr(mb_strtoupper($fakerNombres->name()), 0, 50),
                'parent_fam_2'        => $faker->randomElement(['HIJO(A)', 'TÍO(A)', 'HERMANO(A)']),
                'tel_fam_2'           => $faker->numerify('55########'),

                // Datos profesionales GEM
                'categoria'           => 'PROFESOR DE EDUCACIÓN PRIMARIA',
                'estado_categoria'    => 'BASE',
                'num_plaza_1'         => '150721E028100.0' . $faker->numerify('######'),
                'fec_ing_p1'          => $faker->dateTimeBetween('-20 years', '-3 years')->format('Y-m-d'),
                'num_plaza_2'         => '',
                'fec_ing_p2'          => null,
                'clave_issemym'       => $faker->numerify('#########'),
                'rfc'                 => $rfc,
                'preparacion_inicial' => 'LICENCIATURA EN EDUCACIÓN PRIMARIA',
                'grado_estudios'      => $faker->randomElement(['LICENCIATURA', 'MAESTRÍA']),
                'fec_gem'             => $faker->dateTimeBetween('-20 years', '-3 years')->format('Y-m-d'),
                'fec_ing_funcion'     => $faker->dateTimeBetween('-20 years', '-3 years')->format('Y-m-d'),
                'anios_servicio'      => (string) $faker->numberBetween(3, 25),
                'clave_sp'            => $faker->numerify('99#######'),
                'inic_carr_mag'       => $faker->randomElement(['NO', 'SI']),
                'fec_cm'              => null,
                'num_dic_cm'          => '',
                'nivel'               => 'PRIMARIA',
                'vertiente'           => 'DOCENTE FRENTE A GRUPO',
                'grado'               => $doc['grado'],
                'grupo'               => $doc['grupo'],
                'salon'               => $doc['salon'],

                // Acceso al sistema
                'usuario'             => $doc['usuario'],
                'password'            => password_hash($doc['pass'], PASSWORD_DEFAULT),
                'activo'              => $doc['activo'],
            ];

            $builder->insert($data);
        }
    }
}
