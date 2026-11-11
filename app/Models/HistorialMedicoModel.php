<?php

namespace App\Models;

use CodeIgniter\Model;

class HistorialMedicoModel extends Model
{
    protected $table            = 'historial_medico';
    protected $primaryKey       = 'id_hmedico';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object'; // en lugar de array
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
'id_alumno',
'estatura',
'peso',
'tipo_sangre',
'talla_zapato',
'zapato_orto',
'lentes',
'vacunas',
'apoyo_1',
'apoyo_2',
'apoyo_3',
'apoyo_4',
'apoyo_5',
'otro_apoyo',
'discapacidad',
'covid',
'covid_dosis',
'ultimas_enfermedades',
'enfermedades_frecuentes',
'nombre_medico',
'tel_medico',
'institucion_dh',
'recomendaciones',
'sobrepeso',
'corazon',
'bronquitis',
'hemorragias',
'epilepsia',
'fiebre_reumatica',
'cancer',
'diabetes',
'amigdalitis',
'anemia',
'hepatitis',
'neoplasias',
'enfermedad_cronica',
'dificultad_dormir',
'fiebre_frecuente',
'falta_aire',
'dolor_piernas',
'desmayos_frecuentes',
'transfusion',
'impedimento',
'alergia_medicamento',
'alergia_alimento',
'hemorragias_frecuentes',
'antecedente_medico',
'intervencion_quirurgica',
'familiar_diabetes',
'familiar_corazon',
'familiar_hipertension',
'familiar_cancer' ];

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
            'otro_apoyo',
            'discapacidad',
            'ultimas_enfermedades',
            'enfermedades_frecuentes',
            'nombre_medico',
            'recomendaciones',
            'enfermedad_cronica',
            'alergia_medicamento',
            'alergia_alimento',
            'antecedente_medico',
            'intervencion_quirurgica',
            'familiar_diabetes',
            'familiar_corazon',
            'familiar_hipertension',
            'familiar_cancer'
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
