<?php

namespace App\Controllers\Direccion;

use App\Controllers\BaseController;
use App\Models\AlumnoBaseModel;

class AlumnosBaseController extends BaseController
{
    public function nuevo()
    {
        $data = [
            'titulo' => 'Autorizar Nuevo Alumno',
        ];

        return view('direccion/alumnos_base/nuevo', $data);
    }


    public function guardar()
    {
        // Ejecuta la validación llamando al grupo centralizado
        if (! $this->validate('nuevoAlumno')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Validación condicional para fecha_alta cuando es Alta ('A')
        $movimiento = $this->request->getPost('mov_i');
        $fechaAlta  = $this->request->getPost('fecha_alta');

        if ($movimiento === 'A' && empty($fechaAlta)) {
            return redirect()->back()->withInput()->with('errors', [
                'fecha_alta' => 'Debes especificar la fecha de alta para este movimiento.'
            ]);
        }

        // 3. Concatenar nombre completo en mayúsculas y limitar a 50 caracteres
        $paterno = mb_strtoupper(trim($this->request->getPost('primer_apellido')));
        $materno = mb_strtoupper(trim($this->request->getPost('segundo_apellido')));
        $nombres = mb_strtoupper(trim($this->request->getPost('nombres')));
        
        $nombreCompleto = preg_replace('/\s+/', ' ', trim("$paterno $materno $nombres"));
        $nombreCompleto = mb_substr($nombreCompleto, 0, 50);

        $grupo = mb_strtoupper(trim($this->request->getPost('grupo') ?? ''));
        $grado = (string) ($this->request->getPost('grado') - 1); // Se resta una porque se guarda el año anterior cursado

        $alumnoBaseModel = new AlumnoBaseModel();

        $datosInsertar = [
            'nombre'     => $nombreCompleto,
            'curp'       => mb_strtoupper(trim($this->request->getPost('curp'))),
            'grado'      => $grado,
            'grupo'      => $grupo,
            'origen'     => $this->request->getPost('origen'),
            'mov_i'      => $movimiento,
            'fecha_alta' => ($movimiento === 'A') ? $fechaAlta : null,
        ];

        $alumnoBaseModel->insert($datosInsertar);

        return redirect()->to(base_url('direccion/alumnos-base/nuevo'))
                         ->with('success', "Alumno ($nombreCompleto) autorizado correctamente. El tutor ya puede iniciar su registro.");
    }

   
}
