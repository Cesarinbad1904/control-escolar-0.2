<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Escuela extends Migration
{
     public function up()
    {
       $this->forge->addField(
            [
                'id_escuela' => [
                    'type' => 'SMALLINT', // Tamaño máximo de 65,535 (más que suficiente)
                    'constraint' => 5, // Requerido por la sintaxis de CI4, aunque MySQL use su tamaño nativo
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],

                'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'NOMBRE DE LA ESCUELA',
                'null'       => FALSE, 
                ],


                'cct' => [ 
                    'type'       => 'VARCHAR',
                    'constraint' => 12,
                    'default'    => '15EPR0000A',
                    'null'       => FALSE
                ],


                'turno' => [ 
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'default'    => 'MATUTINO',
                    'null'       => FALSE
                ],


                'nombre_director' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'NOMBRE DEL DIRECTOR',
                'null'       => FALSE
                ],


                'calle_num' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'CALLE Y NÚMERO',
                'null'       => FALSE
                ],


                'colonia' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'COLONIA',
                'null'       => FALSE
                ],


                'municipio' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'MUNICIPIO',
                'null'       => FALSE
                ],


                'telefono' => [
                    'type'       => 'CHAR',
                    'constraint' => 10,
                    'default'    => '5555555555',
                    'null'       => FALSE
                ],


                'email' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 50,
                    'default'    => 'miescuela@servidor.com',
                    'null'       => FALSE
                ],


                'ciclo_escolar' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => '0000-0000',
                'null'       => FALSE, 
                ]
                                    
            ]);

       $this->forge->addKey('id_escuela', TRUE);
       
       $this->forge->createTable('escuela');
    }

     public function down()
    {
        $this->forge->dropTable('escuela');
    }
}
