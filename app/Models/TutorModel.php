<?php

namespace App\Models;

use CodeIgniter\Model;

class TutorModel extends Model
{
    protected $table            = 'tutores';
    protected $primaryKey       = 'id_tutor';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object'; // en lugar de array
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
'id_alumno',
'curp_tutor',
'nombre_tutor',
'primer_apellido_tutor',
'segundo_apellido_tutor',
'sexo_tutor',
'fec_nac_tutor',
'entidad_nac_tutor',
'nacionalidad_tutor',
'ocupacion_tutor',
'estudios_tutor',
'parentesco_tutor',
'salario_tutor',
'estado_civil_tutor',
'email_tutor',
'rs_tutor',
'rs_user_tutor',
'curp_tutor2',
'nombre_tutor2',
'primer_apellido_tutor2',
'segundo_apellido_tutor2',
'sexo_tutor2',
'ocupacion_tutor2',
'estudios_tutor2',
'parentesco_tutor2',
'salario_tutor2',
'estado_civil_tutor2',
'email_tutor2',
'rs_tutor2',
'rs_user_tutor2',
'responsabilidad',
'recoge',
'mov_f' ];

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
   protected $beforeInsert   = ['limpiarYMayusculas'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['limpiarYMayusculas'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

     // Función que procesará los datos automáticamente
    protected function limpiarYMayusculas(array $data)
    {
        // Si no hay datos, retornar el arreglo intacto
        if (!isset($data['data'])) {
            return $data;
        }

        // Campos específicos que queremos en MAYÚSCULAS y sin espacios
        $camposAFormatear = [
            'curp_tutor',
            'nombre_tutor',
            'primer_apellido_tutor',
            'segundo_apellido_tutor',
            'nacionalidad_tutor',
            'ocupacion_tutor',
            'rs_user_tutor',
            'curp_tutor2',
            'nombre_tutor2',
            'primer_apellido_tutor2',
            'segundo_apellido_tutor2',
            'ocupacion_tutor2'         
           ];

        foreach ($camposAFormatear as $campo) {
            if (isset($data['data'][$campo])) {
                $data['data'][$campo] = strtoupper(trim($data['data'][$campo]));
            }
        }

        // Para cualquier otro campo permitido, aplicar trim general (opcional)
        foreach ($data['data'] as $key => $value) {
            if (is_string($value)) {
                $data['data'][$key] = trim($value);
            }
        }

        return $data;
    }
}
