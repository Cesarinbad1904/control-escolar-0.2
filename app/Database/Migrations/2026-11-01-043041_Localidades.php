<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Localidades extends Migration
{
    public function up()
    {
       
       $this->forge->addField(
            [
                'id_localidad' => [
                    'type' => 'SMALLINT', // Tamaño máximo de 65,535 (más que suficiente)
                    'constraint' => 5, // Requerido por la sintaxis de CI4, aunque MySQL use su tamaño nativo
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                
                'clave_municipio' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
                'null'       => FALSE, 
                ],

                'municipio' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => FALSE, 
                ],

                'localidad' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => FALSE, 
                ]
              
            ]);

        $this->forge->addKey('id_localidad', TRUE);
          
        $this->forge->createTable('localidades');
    
    }

    public function down()
    {
         $this->forge->dropTable('localidades');
    }
}
