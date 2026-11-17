<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropEscuela extends Migration
{
    public function up()
    {
        // Elimina la tabla (el segundo parámetro 'true' añade "IF EXISTS")
        $this->forge->dropTable('escuela', true);
    }

    public function down()
    {
        // Opcional: aquí puedes volver a definir la estructura de la tabla 
        // por si alguna vez necesitas revertir esta eliminación.
    }
}
