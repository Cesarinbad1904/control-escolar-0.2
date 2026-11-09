<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tutores extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id_tutor' => [
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

                'curp_tutor' => [ // Solo de lectura
                    'type'       => 'CHAR',
                    'constraint' => 18,
                    'null'       => FALSE
                ], 

                'nombre_tutor' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 25,
                    'null'       => FALSE
                ],

                'primer_apellido_tutor' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 25,
                    'null'       => FALSE
                ],

                'segundo_apellido_tutor' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 25,
                    'null'       => FALSE
                ],

                'sexo_tutor' => [ // Se obtiene de la CURP
                'type'       => 'ENUM',
                'constraint' => ['HOMBRE', 'MUJER'],
                'null'       => FALSE
                ],


                'fec_nac_tutor' => [ // Se obtiene de la CURP
                    'type'    => 'DATE',
                    'null'    => FALSE
                ],

                'entidad_nac_tutor' => [ // Se obtiene de la CURP
                    'type'       => 'VARCHAR',
                    'constraint' => 30,
                    'null'       => FALSE
                ],

                'nacionalidad_tutor' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'default'    => 'MEXICANA',
                    'null'       => FALSE
                ],

                'ocupacion_tutor' => [ 
                    'type'       => 'VARCHAR',
                    'constraint' => 40,
                    'null'       => FALSE
                ],

                'estudios_tutor' => [ 
                    'type'       => 'VARCHAR',
                    'constraint' => 40,
                    'null'       => FALSE
                ],

                'parentesco_tutor' => [ 
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => FALSE
                ],

                'salario_tutor' => [ 
                    'type'       => 'VARCHAR',
                    'constraint' => 30,
                    'null'       => FALSE
                ],

                'estado_civil_tutor' => [ 
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => FALSE
                ],

                'email_tutor' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'null'       => FALSE
                ],

                   'rs_tutor' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => FALSE
                ],

                   'rs_user_tutor' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => FALSE
                ],
// ============== Datos del segundo tutor ===============================

                'curp_tutor2' => [ // Solo de lectura
                    'type'       => 'CHAR',
                    'constraint' => 18,
                    'null'       => FALSE
                ], 

                'nombre_tutor2' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 25,
                    'null'       => FALSE
                ],

                'primer_apellido_tutor2' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 25,
                    'null'       => FALSE
                ],

                'segundo_apellido_tutor2' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 25,
                    'null'       => FALSE
                ],

                'ocupacion_tutor2' => [ 
                    'type'       => 'VARCHAR',
                    'constraint' => 40,
                    'null'       => FALSE
                ],

                'estudios_tutor2' => [ 
                    'type'       => 'VARCHAR',
                    'constraint' => 40,
                    'null'       => FALSE
                ],

                'parentesco_tutor2' => [ 
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => FALSE
                ],

                'salario_tutor2' => [ 
                    'type'       => 'VARCHAR',
                    'constraint' => 30,
                    'null'       => FALSE
                ],

                'estado_civil_tutor2' => [ 
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => FALSE
                ],

                'email_tutor2' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'null'       => FALSE
                ],

                   'rs_tutor' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => FALSE
                ],

                   'rs_user_tutor' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => FALSE
                ],

                'responsabilidad' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default'    => 'SI',
                'null'       => FALSE
                ],

                'recoge' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default'    => 'SI',
                'null'       => FALSE
                ],

                'mov_f' => [ // movimiento final (B = BAJA)
                'type'       => 'CHAR',
                'constraint' => '1', 
                'null'       => TRUE // NULL
                ]

                
            ]);

        $this->forge->addKey('id_tutor', TRUE);
        $this->forge->addUniqueKey('id_alumno');
        // Sintaxis: addForeignKey('campo_local', 'tabla_padre', 'campo_padre', 'ON DELETE', 'ON UPDATE')
        $this->forge->addForeignKey('id_alumno', 'alumnos_inscritos', 'id_alumno', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tutores');
    }

    public function down()
    {
        $this->forge->dropTable('tutores');
    }
}
