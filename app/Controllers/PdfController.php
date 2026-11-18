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


     public function generarfi()
    {
        // Configurar opciones (opcional, útil para habilitar imágenes externas o rutas)
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        // Instanciar Dompdf
        $dompdf = new Dompdf($options);
        
        // Instanciar los tres modelos necesarios
        $alumnoModel  = new AlumnoModel();
        $tutorModel   = new TutorModel();
        $escuelaModel   = new EscuelaModel();

// recuperar datos provenientes del formulario
  $curp = $this->request->getPost('curp'); 


        // Buscar los datos del alumno por su CURP
        $alumno = $alumnoModel->where('curp', $curp)->first();

        // Buscar los datos de la escuela
        $escuela = $escuela = $escuelaModel->where('id_escuela', 1)->first();


    // --- CÓDIGO DE DEPURACIÓN TEMPORAL ---
    //echo "CURP recibida: [" . $curp . "]<br>";
    //echo "Consulta SQL ejecutada: " . $alumnoModel->getLastQuery() . "<br>";
    //dd($alumno);
    // -------------------------------------

    
        // Validar si el alumno existe
    if (!$alumno) {
        return redirect()->back()->with('error', 'No se encontró ningún alumno con esa CURP.');
    }

//echo $alumno->curp;

// ============ Preparar código QR ===============================
// ====== Preparar datos que se incluirán en el QR =========
$nombre_alumno = $alumno->nombre_alumno;
$primerapp_alumno = $alumno->primer_apellido_alumno;
$segundoapp_alumno = $alumno->segundo_apellido_alumno;
$curp_alumno = $alumno->curp;
$id_alumno = $alumno->id_alumno;

$datos_alumno = $primerapp_alumno.' '.$segundoapp_alumno.' '.$nombre_alumno.' '.$curp_alumno.' '.$id_alumno;
$curpqr = $datos_alumno;
// =================================================================

// Ruta pública donde se guardará la imagen (la carpeta debe existir)
// Nota: FCPATH (Front Controller Path) apunta a la carpeta public/
        $nombreArchivo = 'codigo_qr_ficha_inscripcion.png';
        $rutaGuardado = FCPATH . 'uploads/qr/'.$nombreArchivo;

        // Parámetros: (texto, ruta_archivo, nivel_correccion, tamaño_pixel, margen)
        \QRcode::png($curpqr, $rutaGuardado, QR_ECLEVEL_L, 4, 2);

        $imagenBase64 = 'data:image/png;base64,'.base64_encode(file_get_contents($rutaGuardado));

        // Eliminar el archivo físico inmediatamente
        if (file_exists($rutaGuardado)) {
            unlink($rutaGuardado);
        }
        
// =================================================================    

// Preparar el arreglo de datos para la vista    
    $datos = [
        'escuela' => $escuela, 
        'alumno' => $alumno,
        'tutor'  => $tutorModel->find($alumno->id_alumno),
        'qr_url'  => $imagenBase64 // 'qr_url' es la variable donde está almacenada la imagen qr (puede tener cualquier nombre) 
      ];


      $html = view('pdf/comprobante_fi', $datos);
      $dompdf->loadHtml($html);

// LIMPIAR EL BÚFER ANTES DE ENVIAR EL PDF
if (ob_get_length()) {
    ob_end_clean();
}


// Configurar tamaño y orientación del papel
        $dompdf->setPaper('letter', 'portrait');

        // 5. Renderizar el HTML a PDF
        $dompdf->render();

        // 6. Enviar el PDF al navegador ('Attachment' => false lo abre en pestaña, true lo descarga)
        $dompdf->stream('ficha_inscripcion.pdf', ['Attachment' => true]); // true, no se muestra en el navegador, solo se descarga
        exit(); // Evita que CodeIgniter agregue datos extra de depuración al archivo PDF
       

    }



public function generarhm()
    {
    
    helper('funciones');

        // Configurar opciones (opcional, útil para habilitar imágenes externas o rutas)
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        // Instanciar Dompdf
        $dompdf = new Dompdf($options);
        
        // Instanciar los modelos necesarios
        $alumnoModel  = new AlumnoModel();
        $tutorModel   = new TutorModel();
        $medicoModel  = new HistorialMedicoModel();
        $escuelaModel  = new EscuelaModel();

// recuperar datos provenientes del formulario
  $curp = $this->request->getPost('curp'); 

             
        // Buscar los datos del alumno por su CURP
        $alumno = $alumnoModel->where('curp', $curp)->first();

        // Buscar los datos de la escuela
        $escuela = $escuelaModel->where('id_escuela', 1)->first();


    // --- CÓDIGO DE DEPURACIÓN TEMPORAL ---
    //echo "CURP recibida: [" . $curp . "]<br>";
    //echo "Consulta SQL ejecutada: " . $alumnoModel->getLastQuery() . "<br>";
    //dd($alumno);
    // -------------------------------------

    
        // Validar si el alumno existe
    if (!$alumno) {
        return redirect()->back()->with('error', 'No se encontró ningún alumno con esa CURP.');
    }


// =================== Edad del alumno ============================
$curp_alumno = $alumno->curp;
$datos_curp_alumno = datosCurp($curp_alumno);
$fecha_nac_alumno = $datos_curp_alumno['fecha_nacimiento'];
//echo $fecha_nac_alumno;
$fecha_comparacion = $escuela->fecha_referencia; // Se toma de la tabla escuela

$edad_alumno = calculaEdad($fecha_nac_alumno, $fecha_comparacion);
//echo $edad_alumno['anios'];
//echo "<br />";
//echo $edad_alumno['meses'];
//echo "<br />";
//echo $edad_alumno['dias'];
       
// =================================================================    




// Preparar el arreglo de datos para la vista    
    $datos = [
        'escuela' => $escuela, 
        'alumno' => $alumno,
        'tutor'  => $tutorModel->find($alumno->id_alumno),
        'medico' => $medicoModel->find($alumno->id_alumno),
        'edad_alumno' => $edad_alumno,
        'fecha_comparacion' => $fecha_comparacion
      ];


      $html = view('pdf/comprobante_hm', $datos);
      $dompdf->loadHtml($html);

// LIMPIAR EL BÚFER ANTES DE ENVIAR EL PDF
if (ob_get_length()) {
    ob_end_clean();
}


// Configurar tamaño y orientación del papel
        $dompdf->setPaper('letter', 'portrait');

        // 5. Renderizar el HTML a PDF
        $dompdf->render();

        // 6. Enviar el PDF al navegador ('Attachment' => false lo abre en pestaña, true lo descarga)
        $dompdf->stream('historial_medico.pdf', ['Attachment' => true]); // true, no se muestra en el navegador, solo se descarga
        exit(); // Evita que CodeIgniter agregue datos extra de depuración al archivo PDF

      
    
    } // Fin de la función
 
} // Fin del controlador
