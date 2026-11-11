<?php

namespace App\Models;

use CodeIgniter\Model;

class CalificacionModel extends Model
{
    protected $table            = 'calificaciones';
    protected $primaryKey       = 'id_calif';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object'; // en lugar de array
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
'id_alumno',
'asig_101',
'asig_102',
'asig_103',
'asig_104',
'inasistencias_1',
'asig_201',
'asig_202',
'asig_203',
'asig_204',
'inasistencias_2',
'asig_301',
'asig_302',
'asig_303',
'asig_304',
'inasistencias_3',
'fecha_ultima_vista' ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
