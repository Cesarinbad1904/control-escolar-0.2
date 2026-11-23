<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class AlumnosBaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('es_ES');
        $db = \Config\Database::connect();
        $builder = $db->table('alumnos_base');

        // Limpia la tabla y reinicia el auto_increment antes de insertar
        $builder->truncate();

        $grupos = ['A', 'B', 'C'];
        $origenes = ['ME', 'SA', 'NI'];

        // Catálogo oficial de entidades de tu expresión regular
        $entidadesCurp = [
            'AS', 'BC', 'BS', 'CC', 'CS', 'CH', 'CL', 'CM', 'DF', 'DG', 
            'GT', 'GR', 'HG', 'JC', 'MC', 'MN', 'MS', 'NT', 'NL', 'OC', 
            'PL', 'QT', 'QR', 'SP', 'SL', 'SR', 'TC', 'TS', 'TL', 'VZ', 
            'YN', 'ZS', 'NE'
        ];

        for ($i = 0; $i < 20; $i++) {
            $sexo = $faker->randomElement(['H', 'M']);
            $fechaNac = $faker->dateTimeBetween('-15 years', '-6 years');

            // Construcción de CURP 100% compatible con tu expresión regular
            $curp = strtoupper($faker->regexify('[A-Z][XAEIOU][A-Z]{2}'))
                  . $fechaNac->format('ymd')
                  . $sexo
                  . $faker->randomElement($entidadesCurp)
                  . strtoupper($faker->regexify('[B-DF-HJ-NP-TV-Z]{3}'))
                  . strtoupper($faker->regexify('[0-9A-Z][0-9]'));

            // Generación de nombre completo dentro del límite de 50 caracteres
            $generoFaker = ($sexo === 'H') ? 'male' : 'female';
            $nombreCompleto = $faker->firstName($generoFaker) . ' ' . $faker->lastName() . ' ' . $faker->lastName();

            $data = [
                'nombre'     => mb_substr($nombreCompleto, 0, 50),
                'curp'       => $curp,
                'grado'      => (string) $faker->numberBetween(1, 5),
                'grupo'      => $faker->randomElement($grupos),
                'origen'     => $faker->randomElement($origenes),
                'mov_i'      => 'I',
                'fecha_alta' => null,
            ];

            $builder->insert($data);
        }
    }
}
