<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlumnosInscritos extends Migration
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

                'curp' => [ // Solo de lectura
                    'type'       => 'CHAR',
                    'constraint' => 18,
                    'null'       => FALSE
                ], 

                'nombre_alumno' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 22,
                    'null'       => FALSE
                ],

                'primer_apellido_alumno' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 22,
                    'null'       => FALSE
                ],

                'segundo_apellido_alumno' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 22,
                    'null'       => FALSE
                ],

                'sexo_alumno' => [ // Se obtiene de la CURP
                'type'       => 'ENUM',
                'constraint' => ['HOMBRE', 'MUJER'],
                'null'       => FALSE
                ],


                'fec_nac_alumno' => [ // Se obtiene de la CURP
                    'type'    => 'DATE',
                    'null'    => FALSE
                ], 


                'entidad_nac_alumno' => [ // Se obtiene de la CURP
                    'type'       => 'VARCHAR',
                    'constraint' => 30,
                    'null'       => FALSE
                ],


                'nacionalidad_alumno' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'default'    => 'MEXICANA',
                    'null'       => FALSE
                ],

// ========= Datos domicilio =======
                
                'entidad_dom' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 30,
                    'default'    => 'MEXICO',
                    'null'       => FALSE
                ],

                'municipio_dom' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => FALSE
                ],

                'localidad_dom' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => FALSE
                ],

                'colonia_dom' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => FALSE
                ],

                'calle_num_dom' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => FALSE
                ],

                'entre_calle_1' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'null'       => FALSE
                ],

                'entre_calle_2' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'null'       => FALSE
                ],

                'cp' => [
                    'type'       => 'CHAR',
                    'constraint' => 5,
                    'null'       => FALSE
                ],

                'referencia_dom' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => FALSE
                ],

 // =============== Datos de contacto =========

                'telefono_1' => [
                    'type'       => 'CHAR',
                    'constraint' => 10,
                    'null'       => FALSE
                ],

                'telefono_2' => [
                    'type'       => 'CHAR',
                    'constraint' => 10,
                    'null'       => FALSE
                ],

                'telefono_emer' => [
                    'type'       => 'CHAR',
                    'constraint' => 10,
                    'null'       => FALSE
                ],

                   'email_alumno' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'null'       => FALSE
                ],

                   'rs_alumno' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => FALSE
                ],

                   'rs_user_alumno' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => FALSE
                ],
 
// =========== Datos complementarios ===============

                'num_personas' => [
                    'type' => 'CHAR',
                    'constraint' => 2, 
                    'null' => FALSE
                ],

                'vive_con' => [
                'type'       => 'ENUM',
                'constraint' => ['MAMA', 'PAPA', 'AMBOS'],
                'null'       => FALSE
                ],

                'sosten_econ' => [
                'type'       => 'ENUM',
                'constraint' => ['MAMA', 'PAPA', 'AMBOS'],
                'null'       => FALSE
                ],

                'nombre_escuela_procedencia' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50, 
                    'null' => FALSE
                ],

                'cct_anterior' => [ // Solo para alumnos de ALTA (NULL)
                    'type' => 'VARCHAR',
                    'constraint' => 10, 
                    'null' => TRUE
                ],
// =============== Cuenta con los siguientes apoyos tecnológicos =========
                
                'computadora' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'null'       => FALSE
                ],

                'tablet' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'null'       => FALSE
                ],

                'internet_casa' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'null'       => FALSE
                ],

                'internet_movil' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'null'       => FALSE
                ],

                'tv_paga' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'null'       => FALSE
                ],


                'tv_abierta' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'null'       => FALSE
                ],

                'radio' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'null'       => FALSE
                ],

// ============== Datos académicos =========================
 
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

                'mov_i' => [ // movimiento inicial (inscripción o alta)
                'type'       => 'ENUM',
                'constraint' => ['I', 'A'], 
                'default'    => 'I',
                'null'       => FALSE
                ],

                'mov_f' => [ // movimiento final (B = BAJA)
                'type'       => 'CHAR',
                'constraint' => '1', 
                'null'       => TRUE // NULL
                ],

                'fecha_alta' => [ // NULL
                    'type'    => 'DATE',
                    'null'    => TRUE
                ], 

                'fecha_baja' => [ // (NULL) 
                    'type'    => 'DATE',
                    'null'    => TRUE
                ], 

                'reprobado' => [ // No mostrar en formulario
                'type'       => 'ENUM',
                'constraint' => ['SI', 'NO'], 
                'default'    => 'NO',
                'null'       => FALSE
                ],

                'origen' => [ // No se muestra en formulario
                'type'       => 'ENUM',
                'constraint' => ['ME', 'SA', 'NI'], // ME= Misma Escuela SA=SAID NI= Nuevo Ingreso
                'default'    => 'ME',
                'null'       => FALSE
                ],
                
                'anios_prescolar' => [
                    'type' => 'CHAR',
                    'constraint' => '1', 
                    'null'       => FALSE

                ],

                'fecha_registro' => [
                    'type'    => 'DATETIME',
                    'null'    => FALSE,
                    'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'), // Captura la fecha y hora actual automáticamente
                ]
               
            ]);

        $this->forge->addKey('id_alumno', TRUE);
        $this->forge->addUniqueKey('curp'); // único para evitar duplicados
        $this->forge->createTable('alumnos_inscritos');
    }

    public function down()
    {
         $this->forge->dropTable('alumnos_inscritos');
    }
}
