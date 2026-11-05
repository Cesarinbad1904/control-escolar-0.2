<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HistorialMedico extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id_hmedico' => [
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

                'estatura' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 4,
                    'null'       => FALSE,
                ],

                'peso' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 4,
                    'null'       => FALSE,
                ],

                'tipo_sangre' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 4,
                    'default'    => 'NR',
                    'null'       => FALSE,
                ],

                'talla_zapato' => [ // poner números enteros (combobox)
                    'type'       => 'VARCHAR',
                    'constraint' => 4,
                    'default'    => 'NR',
                    'null'       => FALSE,
                ],

                'zapato_orto' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'lentes' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'vacunas' => [ 
                    'type'       => 'VARCHAR',
                    'constraint' => 60,
                    'null'       => FALSE,
                ],

                'apoyo_1' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'apoyo_2' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'apoyo_3' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'apoyo_4' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'apoyo_5' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'otro_apoyo' => [
                'type'       => 'VARCHAR',
                'constraint' => '40',
                'null'       => TRUE // NULL
                ],

                'discapacidad' => [
                'type'       => 'VARCHAR',
                'constraint' => '60',
                'default' => 'NINGUNA',
                'null'       => TRUE // NULL
                ],

                'covid' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'covid_dosis' => [ // Combobox para elegir: ninguna, 1a dosis, 2a dosis o 3a dosis
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'default' => 'NINGUNA',
                'null'       => FALSE
                ],

                'ultimas_enfermedades' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'null'       => FALSE
                ], 

                'enfermedades_frecuentes' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'null'       => FALSE
                ], 

                'nombre_medico' => [ // Opcional
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => TRUE // NULL
                ], 

                'tel_medico' => [ // Opcional
                'type'       => 'CHAR',
                'constraint' => '10',
                'null'       => TRUE // NULL
                ], 

                'institucion_dh' => [ // Institucion de derechohabiencia
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'null'       => FALSE
                ], 

                'recomendaciones' => [
                'type'       => 'VARCHAR',
                'constraint' => '300',
                'default' => 'NINGUNA',
                'null'       => FALSE
                ], 
// ================= Padecimientos =====================================================

                'sobrepeso' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'corazon' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'bronquitis' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'hemorragias' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'epilepsia' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'fiebre_reumatica' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'cancer' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'diabetes' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'amigdalitis' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'anemia' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'hepatitis' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'neoplasias' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'enfermedad_cronica' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'default' => 'NINGUNA',
                'null'       => FALSE
                ],
// ================ Detecciones =========================================================

                'dificultad_dormir' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'fiebre_frecuente' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'falta_aire' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'dolor_piernas' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'desmayos_frecuentes' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'transfusion' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'impedimento' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],

                'alergia_medicamento' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
                'default' => 'NINGUNA',
                'null'       => FALSE
                ],

                'alergia_alimento' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
                'default' => 'NINGUNA',
                'null'       => FALSE
                ],

                'hemorragias_frecuentes' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default' => 'NO',
                'null'       => FALSE
                ],
                
                'antecedente_medico' => [ // Algún antecedente médico que le prohiba realizar actividad física
                'type'       => 'VARCHAR',
                'constraint' => '150',
                'default' => 'NINGUNO',
                'null'       => FALSE
                ],

                'intervencion_quirurgica' => [ 
                'type'       => 'VARCHAR',
                'constraint' => '150',
                'default' => 'NINGUNA',
                'null'       => FALSE
                ],
// ============= Antecedentes hereditarios =======================================
                
                'familiar_diabetes' => [ 
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default' => 'NINGUNO',
                'null'       => FALSE
                ],

                'familiar_corazon' => [ 
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default' => 'NINGUNO',
                'null'       => FALSE
                ],

                'familiar_hipertension' => [ 
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default' => 'NINGUNO',
                'null'       => FALSE
                ],

                'familiar_cancer' => [ 
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default' => 'NINGUNO',
                'null'       => FALSE
                ]
               
            ]);

        $this->forge->addKey('id_hmedico', TRUE);
        $this->forge->addUniqueKey('id_alumno');
        // Sintaxis: addForeignKey('campo_local', 'tabla_padre', 'campo_padre', 'ON DELETE', 'ON UPDATE')
        $this->forge->addForeignKey('id_alumno', 'alumnos_inscritos', 'id_alumno', 'CASCADE', 'CASCADE');
        $this->forge->createTable('historial_medico');
    }

    public function down()
    {
        $this->forge->dropTable('historial_medico');
    }
}
