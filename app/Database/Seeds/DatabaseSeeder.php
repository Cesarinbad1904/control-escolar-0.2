<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // 1. Desactivar la revisión de llaves foráneas
        $db->disableForeignKeyChecks();

        // 2. Vaciar tablas (primero las hijas, luego la padre)
        $db->table('calificaciones')->truncate();
        $db->table('historial_medico')->truncate();
        $db->table('tutores')->truncate();
        $db->table('alumnos_inscritos')->truncate();

        // 3. Reactivar la revisión de llaves foráneas
        $db->enableForeignKeyChecks();

        // 4. Ejecutar los seeders en orden
        $this->call('AlumnosInscritosSeeder');
        $this->call('TutoresSeeder');
        $this->call('HistorialMedicoSeeder');
        $this->call('CalificacionesSeeder');
    }
}


/*

Cómo ejecutarlos

Abrir terminal en la raíz del proyecto y ejecutar el siguiente comando:

bash
php spark db:seed DatabaseSeeder

*/

?>