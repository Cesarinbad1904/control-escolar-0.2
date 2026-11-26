<?php

namespace App\Models;

use CodeIgniter\Model;

class DocenteModel extends Model
{
    protected $table            = 'docentes';
    protected $primaryKey       = 'id_docente';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'nombre',
        'curp',
        'estado_civil',
        'direccion',
        'localidad',
        'municipio',
        'cp',
        'tel_fijo',
        'tel_cel',
        'email',
        'nombre_fam_1',
        'parent_fam_1',
        'tel_fam_1',
        'nombre_fam_2',
        'parent_fam_2',
        'tel_fam_2',
        'categoria',
        'estado_categoria',
        'num_plaza_1',
        'fec_ing_p1',
        'num_plaza_2',
        'fec_ing_p2',
        'clave_issemym',
        'rfc',
        'preparacion_inicial',
        'grado_estudios',
        'fec_gem',
        'fec_ing_funcion',
        'anios_servicio',
        'clave_sp',
        'inic_carr_mag',
        'fec_cm',
        'num_dic_cm',
        'nivel',
        'vertiente',
        'grado',
        'grupo',
        'salon',
        'usuario',
        'password',
        'activo',
    ];

    // Callbacks para encriptar la contraseña automáticamente
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password']) && !empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        } else {
            // Si viene vacío en una actualización, lo quitamos para no sobrescribir la contraseña actual
            unset($data['data']['password']);
        }

        return $data;
    }
}
