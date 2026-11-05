<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pagos extends Migration
{
    public function up()
    {
       $this->forge->addField(
            [
                'id_pago' => [
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

                'monto' => [
                    'type'       => 'DECIMAL',
                    'constraint' => '5,2',
                    'unsigned' => TRUE,
                    'null'       => FALSE,
                    'default'    => 0.00
                ],

                'concepto' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE, // Ej. "Inscripción", "Colegiatura Noviembre", etc
                ],

                'tipo_pago' => [
                'type'       => 'ENUM',
                'constraint' => ['EFECTIVO', 'TRANSFERENCIA', 'DEPOSITO'],
                'default'    => 'EFECTIVO',
                'null'       => FALSE,
                ],

                'clave_rastreo' => [ // Opcional, solo para transferencias
                    'type'       => 'VARCHAR',
                    'constraint' => 30,
                    'null'       => TRUE, // null
                ],

                'fecha_pago' => [
                    'type'    => 'DATETIME',
                    'null'    => FALSE,
                    'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'), // Captura la fecha y hora actual automáticamente
                ]
                    
            ]);

        $this->forge->addKey('id_pago', TRUE);
        
        // Sintaxis: addForeignKey('campo_local', 'tabla_padre', 'campo_padre', 'ON DELETE', 'ON UPDATE')
        $this->forge->addForeignKey('id_alumno', 'alumnos_inscritos', 'id_alumno', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pagos');
    }

    public function down()
    {
        $this->forge->dropTable('pagos');
    }
}
