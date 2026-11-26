<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class DocenteAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Verifica si está logueado y si su rol corresponde a 'docente'
        if (!$session->get('docente_logged_in') || $session->get('rol') !== 'docente') {
            return redirect()->to(base_url('docentes/login'))
                             ->with('error', 'Debes iniciar sesión como docente para acceder a este módulo.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se requiere acción posterior
    }
}
