<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumnoModel extends Model
{
    protected $table            = 'alumnos_inscritos';
    protected $primaryKey       = 'id_alumno';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
'curp', 
'nombre_alumno', 
'primer_apellido_alumno',
'segundo_apellido_alumno',
'sexo_alumno',
'fec_nac_alumno',
'entidad_nac_alumno',
'nacionalidad_alumno',
'entidad_dom',
'municipio_dom',
'localidad_dom',
'colonia_dom',
'calle_num_dom',
'entre_calle_1',
'entre_calle_2',
'cp',
'referencia_dom',
'telefono_1',
'telefono_2',
'telefono_emer',
'email_alumno',
'rs_alumno',
'rs_user_alumno',
'num_personas',
'vive_con',
'sosten_econ',
'nombre_escuela_procedencia',
'cct_anterior',
'computadora',
'tablet',
'internet_casa',
'internet_movil',
'tv_paga',
'tv_abierta',
'radio',
'grado',
'grupo',
'mov_i',
'mov_f',
'fecha_alta',
'fecha_baja',
'reprobado',
'origen',
'anios_prescolar' ];

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
        $camposAFormatear = ['curp',
         'nombre_alumno',
         'primer_apellido_alumno', 
         'segundo_apellido_alumno', 
         'nacionalidad_alumno',
         'localidad_dom', 
         'colonia_dom',
         'calle_num_dom',
         'entre_calle_1', 
         'entre_calle_2',
         'referencia_dom',
         'rs_user_alumno',
         'nombre_escuela_procedencia'         
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
