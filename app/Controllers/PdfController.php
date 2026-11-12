<?php
namespace App\Controllers;

use App\Models\AlumnoModel;
use App\Models\TutorModel;
use App\Models\HistorialMedicoModel;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController extends BaseController
{

public function generar()
    {
        // 1. Configurar opciones (opcional, útil para habilitar imágenes externas o rutas)
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        // 2. Instanciar Dompdf
        $dompdf = new Dompdf($options);

        // 3. Cargar una vista de CodeIgniter como HTML
        $datos = [
            'titulo' => 'Reporte Mensual',
            'fecha'  => date('d/m/Y')
        ];
        $html = view('pdf/plantilla_reporte', $datos);
        $dompdf->loadHtml($html);

        // 4. Configurar tamaño y orientación del papel
        $dompdf->setPaper('A4', 'portrait');

        // 5. Renderizar el HTML a PDF
        $dompdf->render();

        // 6. Enviar el PDF al navegador ('Attachment' => false lo abre en pestaña, true lo descarga)
        $dompdf->stream('reporte.pdf', ['Attachment' => false]);
        exit(); // Evita que CodeIgniter agregue datos extra de depuración al archivo PDF
    }


     public function generarfi($curp)
    {
        // 1. Configurar opciones (opcional, útil para habilitar imágenes externas o rutas)
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        // 2. Instanciar Dompdf
        $dompdf = new Dompdf($options);
        
        // Instanciar los tres modelos necesarios
        $alumnoModel  = new AlumnoModel();
        $tutorModel   = new TutorModel();

         $curp = strtoupper(trim($curp));
        

        // Buscar los datos del alumno
        $alumno = $alumnoModel->where('curp', $curp)->first();

        // --- CÓDIGO DE DEPURACIÓN TEMPORAL ---
    echo "CURP recibida: [" . $curp . "]<br>";
    echo "Consulta SQL ejecutada: " . $alumnoModel->getLastQuery() . "<br>";
    dd($alumno);
    // -------------------------------------

/*        
        // Validar si el alumno existe
    if (!$alumno) {
        return redirect()->back()->with('error', 'No se encontró ningún alumno con esa CURP.');
    }


// Preparar el arreglo de datos para la vista    
    $datos = [
        'alumno' => $alumno,
        'tutor'  => $tutorModel->find($alumno->id_alumno)
      ];

      $html = view('pdf/plantilla_reporte', $datos);
      $dompdf->loadHtml($html);


// Configurar tamaño y orientación del papel
        $dompdf->setPaper('letter', 'portrait');

        // 5. Renderizar el HTML a PDF
        $dompdf->render();

        // 6. Enviar el PDF al navegador ('Attachment' => false lo abre en pestaña, true lo descarga)
        $dompdf->stream('ficha_inscripcion.pdf', ['Attachment' => false]);
        exit(); // Evita que CodeIgniter agregue datos extra de depuración al archivo PDF
        */

    }
        
    
}
