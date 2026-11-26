<?php

namespace App\Controllers\Docentes;

use App\Controllers\BaseController;
use App\Models\DocenteModel;

class AuthController extends BaseController
{
    public function login()
    {
        // Si ya tiene sesión activa como docente, enviarlo directo a su panel
        if (session()->get('docente_logged_in') && session()->get('rol') === 'docente') {
            return redirect()->to(base_url('docentes/panel'));
        }

        return view('docentes/login');
    }

    public function autenticar()
    {
        $rules = [
            'usuario'  => 'required|min_length[3]|max_length[50]',
            'password' => 'required|min_length[4]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Por favor ingresa tu usuario y contraseña.');
        }

        $usuario  = trim($this->request->getPost('usuario'));
        $password = $this->request->getPost('password');

        $docenteModel = new DocenteModel();
        $docente = $docenteModel->where('usuario', $usuario)->first();

        // 1. Verificar existencia del usuario y contraseña encriptada
        if (!$docente || !password_verify($password, $docente->password)) {
            return redirect()->back()->withInput()->with('error', 'Usuario o contraseña incorrectos.');
        }

        // 2. Verificar que el docente esté activo
        if ($docente->activo !== 'SI') {
            return redirect()->back()->withInput()->with('error', 'Tu cuenta está desactivada. Contacta a la Dirección Escolar.');
        }

        // 3. Verificar que tenga un grado y grupo asignados
        if (empty($docente->grado) || empty($docente->grupo)) {
            return redirect()->back()->withInput()->with('error', 'Aún no tienes un grado y grupo asignados para este ciclo.');
        }

        // 4. Regenerar ID de sesión por seguridad y guardar datos del docente
        session()->regenerate();
        session()->set([
            'id_docente'        => $docente->id_docente,
            'docente_nombre'    => $docente->nombre,
            'docente_usuario'   => $docente->usuario,
            'docente_grado'     => $docente->grado,
            'docente_grupo'     => $docente->grupo,
            'docente_salon'     => $docente->salon,
            'rol'               => 'docente',
            'docente_logged_in' => true,
        ]);

        return redirect()->to(base_url('docentes/panel'));
    }

    

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('docentes/login'))
                         ->with('success', 'Has cerrado sesión correctamente.');
    }
}
