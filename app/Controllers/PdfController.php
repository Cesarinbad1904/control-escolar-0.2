<?php
namespace App\Controllers;

// Incluir phpqrcode
require_once APPPATH . 'ThirdParty/phpqrcode/qrlib.php'; 

use App\Models\AlumnoModel;
use App\Models\TutorModel;
use App\Models\HistorialMedicoModel;
use App\Models\EscuelaModel;


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



// Al recibir $curp = null como parámetro opcional, el método revisa primero si viene por la URL (GET) 
// y, si no, la toma del formulario (POST):
   public function generarfi($curp = null)
{
    // 1. Obtener CURP desde GET (parámetro de URL) o desde POST (formulario)
    $curp = $curp ?? $this->request->getPost('curp');
    $curp = strtoupper(trim((string) $curp));

    if (empty($curp)) {
        return redirect()->back()->with('error', 'No se proporcionó una CURP válida.');
    }

    // 2. Instanciar modelos y buscar registros
    $alumnoModel  = new AlumnoModel();
    $tutorModel   = new TutorModel();
    $escuelaModel = new EscuelaModel();

    $alumno = $alumnoModel->where('curp', $curp)->first();

    if (!$alumno) {
        return redirect()->back()->with('error', 'No se encontró ningún alumno con esa CURP.');
    }

    $escuela = $escuelaModel->where('id_escuela', 1)->first();
    // ⚠️ Corrección importante: buscar por 'id_alumno' (llave foránea), no por find() que busca 'id_tutor'
    $tutor   = $tutorModel->where('id_alumno', $alumno->id_alumno)->first();

    // 3. Preparar código QR con nombre único temporal (evita choques si se generan 2 PDFs a la vez)
    $datosAlumno = "{$alumno->primer_apellido_alumno} {$alumno->segundo_apellido_alumno} {$alumno->nombre_alumno} {$alumno->curp} {$alumno->id_alumno}";
    $nombreArchivo = 'qr_fi_' . $alumno->id_alumno . '_' . uniqid() . '.png';
    $rutaGuardado  = FCPATH . 'uploads/qr/' . $nombreArchivo;

    \QRcode::png($datosAlumno, $rutaGuardado, QR_ECLEVEL_L, 4, 2);

    $imagenBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($rutaGuardado));

    if (file_exists($rutaGuardado)) {
        unlink($rutaGuardado);
    }

    // 4. Configurar Dompdf y renderizar
    $options = new Options();
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);

    $datos = [
        'escuela' => $escuela,
        'alumno'  => $alumno,
        'tutor'   => $tutor,
        'qr_url'  => $imagenBase64,
    ];

    $html = view('pdf/comprobante_fi', $datos);
    $dompdf->loadHtml($html);

    if (ob_get_length()) {
        ob_end_clean();
    }

    $dompdf->setPaper('letter', 'portrait');
    $dompdf->render();

    // Descarga con la CURP en el nombre del archivo para identificarlo fácilmente
    $dompdf->stream("ficha_inscripcion_{$alumno->curp}.pdf", ['Attachment' => true]);
    exit();
}




public function generarhm($curp = null)
{
    helper('funciones');

    // 1. Obtener CURP desde GET (parámetro de URL) o desde POST (formulario)
    $curp = $curp ?? $this->request->getPost('curp');
    $curp = strtoupper(trim((string) $curp));

    if (empty($curp)) {
        return redirect()->back()->with('error', 'No se proporcionó una CURP válida.');
    }

    // 2. Instanciar los modelos necesarios
    $alumnoModel  = new AlumnoModel();
    $tutorModel   = new TutorModel();
    $medicoModel  = new HistorialMedicoModel();
    $escuelaModel = new EscuelaModel();

    // Buscar los datos del alumno por su CURP
    $alumno = $alumnoModel->where('curp', $curp)->first();

    if (!$alumno) {
        return redirect()->back()->with('error', 'No se encontró ningún alumno con esa CURP.');
    }

    // Buscar los datos de la escuela, tutor e historial médico por id_alumno
    $escuela = $escuelaModel->where('id_escuela', 1)->first();
    $tutor   = $tutorModel->where('id_alumno', $alumno->id_alumno)->first();
    $medico  = $medicoModel->where('id_alumno', $alumno->id_alumno)->first();

    // 3. Calcular edad del alumno
    $datos_curp_alumno = datosCurp($alumno->curp);
    $fecha_nac_alumno  = $datos_curp_alumno['fecha_nacimiento'];
    $fecha_comparacion = $escuela->fecha_referencia;
    $edad_alumno       = calculaEdad($fecha_nac_alumno, $fecha_comparacion);

    // 4. Configurar Dompdf y renderizar
    $options = new Options();
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);

    $datos = [
        'escuela'           => $escuela,
        'alumno'            => $alumno,
        'tutor'             => $tutor,
        'medico'            => $medico,
        'edad_alumno'       => $edad_alumno,
        'fecha_comparacion' => $fecha_comparacion,
    ];

    $html = view('pdf/comprobante_hm', $datos);
    $dompdf->loadHtml($html);

    if (ob_get_length()) {
        ob_end_clean();
    }

    $dompdf->setPaper('letter', 'portrait');
    $dompdf->render();

    // Descarga incluyendo la CURP en el nombre del archivo
    $dompdf->stream("historial_medico_{$alumno->curp}.pdf", ['Attachment' => true]);
    exit();
}

 
} // Fin del controlador
