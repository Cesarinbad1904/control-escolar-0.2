<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Calificaciones extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id_calif' => [
                    'type' => 'SMALLINT', // Tamaño máximo de 65,535 (más que suficiente)
                    'constraint' => 5, // Requerido por la sintaxis de CI4, aunque MySQL use su tamaño nativo
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],

                'id_alumno' => [
                    'type' => 'SMALLINT',
                    'constraint' => 5, 
                    'unsigned' => TRUE
                ],

// ====================== Primer periodo o trimestre ====================================

                'asig_101' => [ // Lenguajes
                    'type' => 'TINYINT',
                    'constraint' => 2, // Para mostrar 2 dígitos (10) 
                    'unsigned' => TRUE, 
                    'default'    => 5, 
                    'null' => FALSE
                ],

                'asig_102' => [ // Saberes y pensamiento científico
                    'type' => 'TINYINT',
                    'constraint' => 2, // Para mostrar 2 dígitos (10) 
                    'unsigned' => TRUE, 
                    'default'    => 5, 
                    'null' => FALSE
                ],

                'asig_103' => [ // Ética, Naturaleza y Sociedades
                    'type' => 'TINYINT',
                    'constraint' => 2, // Para mostrar 2 dígitos (10) 
                    'unsigned' => TRUE, 
                    'default'    => 5, 
                    'null' => FALSE
                ],

                'asig_104' => [ // De lo humano y comunitario
                    'type' => 'TINYINT',
                    'constraint' => 2, // Para mostrar 2 dígitos (10) 
                    'unsigned' => TRUE, 
                    'default'    => 5, 
                    'null' => FALSE
                ],


                'inasistencias_1' => [
                    'type' => 'CHAR',
                    'constraint' => 2,
                    'default'    => '0', 
                    'null' => FALSE
                ],

// ====================== Segundo periodo o trimestre ====================================

                'asig_201' => [ // Lenguajes
                    'type' => 'TINYINT',
                    'constraint' => 2, // Para mostrar 2 dígitos (10) 
                    'unsigned' => TRUE, 
                    'default'    => 5, 
                    'null' => FALSE
                ],

                'asig_202' => [ // Saberes y pensamiento científico
                    'type' => 'TINYINT',
                    'constraint' => 2, // Para mostrar 2 dígitos (10) 
                    'unsigned' => TRUE, 
                    'default'    => 5, 
                    'null' => FALSE
                ],

                'asig_203' => [ // Ética, Naturaleza y Sociedades
                    'type' => 'TINYINT',
                    'constraint' => 2, // Para mostrar 2 dígitos (10) 
                    'unsigned' => TRUE, 
                    'default'    => 5, 
                    'null' => FALSE
                ],

                'asig_204' => [ // De lo humano y comunitario
                    'type' => 'TINYINT',
                    'constraint' => 2, // Para mostrar 2 dígitos (10) 
                    'unsigned' => TRUE, 
                    'default'    => 5, 
                    'null' => FALSE
                ],

                
                'inasistencias_2' => [
                    'type' => 'CHAR',
                    'constraint' => 2,
                    'default'    => '0', 
                    'null' => FALSE
                ],

// ====================== Tercer periodo o trimestre ====================================

                'asig_301' => [ // Lenguajes
                    'type' => 'TINYINT',
                    'constraint' => 2, // Para mostrar 2 dígitos (10) 
                    'unsigned' => TRUE, 
                    'default'    => 5, 
                    'null' => FALSE
                ],

                'asig_302' => [ // Saberes y pensamiento científico
                    'type' => 'TINYINT',
                    'constraint' => 2, // Para mostrar 2 dígitos (10) 
                    'unsigned' => TRUE, 
                    'default'    => 5, 
                    'null' => FALSE
                ],

                'asig_303' => [ // Ética, Naturaleza y Sociedades
                    'type' => 'TINYINT',
                    'constraint' => 2, // Para mostrar 2 dígitos (10) 
                    'unsigned' => TRUE, 
                    'default'    => 5, 
                    'null' => FALSE
                ],

                'asig_304' => [ // De lo humano y comunitario
                    'type' => 'TINYINT',
                    'constraint' => 2, // Para mostrar 2 dígitos (10) 
                    'unsigned' => TRUE, 
                    'default'    => 5, 
                    'null' => FALSE
                ],

                
                'inasistencias_3' => [
                    'type' => 'CHAR',
                    'constraint' => 2,
                    'default'    => '0', 
                    'null' => FALSE
                ],


                'fecha_ultima_vista' => [ // NULL
                    'type'    => 'DATE',
                    'null'    => TRUE
                ], 
                
                
            ]);

        $this->forge->addKey('id_calif', TRUE);
        $this->forge->addUniqueKey('id_alumno');
        // Sintaxis: addForeignKey('campo_local', 'tabla_padre', 'campo_padre', 'ON DELETE', 'ON UPDATE')
        $this->forge->addForeignKey('id_alumno', 'alumnos_inscritos', 'id_alumno', 'CASCADE', 'CASCADE');
        $this->forge->createTable('calificaciones');
    }

    public function down()
    {
         $this->forge->dropTable('calificaciones');
    }
}
