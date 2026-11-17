<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlumnosBase extends Migration
{
    public function up()
    {
         $this->forge->addField(
            [
                'id_alumno' => [
                    'type' => 'SMALLINT', // Tamaño máximo de 65,535 (más que suficiente)
                    'constraint' => 5, // Requerido por la sintaxis de CI4, aunque MySQL use su tamaño nativo
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],

                'nombre' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50, 
                    'null'       => FALSE
                ],

                
                'curp' => [ 
                    'type'       => 'CHAR',
                    'constraint' => 18,
                    'null'       => FALSE
                ], 

                'grado' => [
                    'type' => 'CHAR',
                    'constraint' => '1', 
                    'null'       => FALSE,

                ],
               

                'grupo' => [
                    'type' => 'VARCHAR', // Por si llegara a ser un grupo como "102-A" o algo así
                    'constraint' => '5', 
                    'null'       => FALSE,

                ], 


                'origen' => [ 
                'type'       => 'ENUM',
                'constraint' => ['ME', 'SA', 'NI'], // ME= Misma Escuela SA=SAID NI= Nuevo Ingreso
                'default'    => 'ME',
                'null'       => FALSE
                ],

                
                'mov_i' => [ // movimiento inicial (inscripción o alta)
                'type'       => 'ENUM',
                'constraint' => ['I', 'A'], 
                'default'    => 'I',
                'null'       => FALSE
                ],

// (Solo se utilizará de manera individual posteriormente si hay un ingreso por alta, pero no al inicio del ciclo, por eso su valor es null)
                'fecha_alta' => [ 
                    'type'    => 'DATE',
                    'null'    => TRUE // null
                ]
                    
            ]);

        $this->forge->addKey('id_alumno', TRUE);
        $this->forge->createTable('alumnos_base');
    }

     public function down()
    {
        $this->forge->dropTable('alumnos_base');
    }
}
