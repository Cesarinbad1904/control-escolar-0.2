<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class LocalidadesController extends ResourceController
{
    public function getByMunicipio($nombreMunicipio)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('localidades');

        // Buscamos las localidades que pertenezcan a la clave recibida
        $localidades = $builder->where('municipio', $nombreMunicipio)
                               ->orderBy('localidad', 'ASC')
                               ->get()
                               ->getResultArray();

        // Respondemos en formato JSON automáticamente
        return $this->respond($localidades);
    }
}

?>