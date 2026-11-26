<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Docentes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_docente' => [
                'type'           => 'SMALLINT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'curp' => [
                'type'       => 'CHAR',
                'constraint' => 18,
                'default'    => '',
                'null'       => false,
            ],
            'estado_civil' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'default'    => '',
                'null'       => false,
            ],
            'direccion' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => '',
                'null'       => false,
            ],
            'localidad' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => '',
                'null'       => false,
            ],
            'municipio' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => '',
                'null'       => false,
            ],
            'cp' => [
                'type'       => 'CHAR',
                'constraint' => 5,
                'default'    => '',
                'null'       => false,
            ],
            'tel_fijo' => [
                'type'       => 'CHAR',
                'constraint' => 10,
                'default'    => '',
                'null'       => false,
            ],
            'tel_cel' => [
                'type'       => 'CHAR',
                'constraint' => 10,
                'default'    => '',
                'null'       => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => '',
                'null'       => false,
            ],

            // ======= Datos de familiares en caso de emergencia ===========
            'nombre_fam_1' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => '',
                'null'       => false,
            ],
            'parent_fam_1' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => '',
                'null'       => false,
            ],
            'tel_fam_1' => [
                'type'       => 'CHAR',
                'constraint' => 10,
                'default'    => '',
                'null'       => false,
            ],
            'nombre_fam_2' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => '',
                'null'       => false,
            ],
            'parent_fam_2' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => '',
                'null'       => false,
            ],
            'tel_fam_2' => [
                'type'       => 'CHAR',
                'constraint' => 10,
                'default'    => '',
                'null'       => false,
            ],

            // ======== Datos profesionales ====================================
            'categoria' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => '',
                'null'       => false,
            ],
            'estado_categoria' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => '',
                'null'       => false,
            ],
            'num_plaza_1' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'default'    => '',
                'null'       => false,
            ],
            'fec_ing_p1' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'num_plaza_2' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'default'    => '',
                'null'       => false,
            ],
            'fec_ing_p2' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'clave_issemym' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'default'    => '',
                'null'       => false,
            ],
            'rfc' => [
                'type'       => 'CHAR',
                'constraint' => 13,
                'default'    => '',
                'null'       => false,
            ],
            'preparacion_inicial' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => '',
                'null'       => false,
            ],
            'grado_estudios' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => '',
                'null'       => false,
            ],
            'fec_gem' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'fec_ing_funcion' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'anios_servicio' => [
                'type'       => 'CHAR',
                'constraint' => 2,
                'default'    => '',
                'null'       => false,
            ],
            'clave_sp' => [
                'type'       => 'CHAR',
                'constraint' => 50,
                'default'    => '',
                'null'       => false,
            ],
            'inic_carr_mag' => [
                'type'       => 'ENUM',
                'constraint' => ['NO', 'SI'],
                'default'    => 'NO',
                'null'       => false,
            ],
            'fec_cm' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'num_dic_cm' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => '',
                'null'       => false,
            ],
            'nivel' => [
                'type'       => 'CHAR',
                'constraint' => 50,
                'default'    => '',
                'null'       => false,
            ],
            'vertiente' => [
                'type'       => 'CHAR',
                'constraint' => 50,
                'default'    => '',
                'null'       => false,
            ],
            'grado' => [
                'type'       => 'CHAR',
                'constraint' => 1,
                'default'    => '',
                'null'       => false,
            ],
            'grupo' => [
                'type'       => 'VARCHAR',
                'constraint' => 5, // Ampliado a 5 igual que en alumnos_inscritos por consistencia
                'default'    => '',
                'null'       => false,
            ],
            'salon' => [
                'type'       => 'CHAR',
                'constraint' => 2,
                'default'    => '',
                'null'       => false,
            ],

            // ======== Datos de acceso al sistema ==============================
            'usuario' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255, // Necesario para almacenar hashes seguros (bcrypt / argon2id)
                'null'       => false,
            ],
            'activo' => [
                'type'       => 'ENUM',
                'constraint' => ['SI', 'NO'],
                'default'    => 'SI',
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('id_docente', true);
        $this->forge->addUniqueKey('usuario');
        $this->forge->createTable('docentes');
    }

    public function down()
    {
        $this->forge->dropTable('docentes');
    }
}
