<?php
header('Content-Type: text/html; charset=UTF-8');
$curp = $_POST['curp'];

// ====================== DomPdf ===========================================
// 1. Cargar el autoloader de Composer
require 'vendor/autoload.php';

// 2. Importar las clases necesarias de Dompdf
use Dompdf\Dompdf;
use Dompdf\Options;

// 3. (Opcional) Configurar opciones iniciales
$options = new Options();
$options->set('defaultFont', 'Arial'); // Tipografía por defecto
$options->set('isHtml5ParserEnabled', true); // Mejor soporte de HTML5
$options->set('isRemoteEnabled', true); // Permitir imágenes externas (URLs)

// 4. Instanciar Dompdf con las opciones
$dompdf = new Dompdf($options);
// =========================================================================


// ==== Recuperación de datos de la escuela (tabla escuela)=========
require_once "CGestionData.php"; 
$gestionData = new CGestionData(); 

$result_escuela = $gestionData->consultaDatosEscuela();
$row_esc = mysqli_fetch_array($result_escuela);

$nom_esc = $row_esc['nombre'];
$turno = $row_esc['turno'];
$cct = $row_esc['cct'];
$ciclo = $row_esc['ciclo'];
$nom_dir = $row_esc['director'];
$municipio = $row_esc['municipio'];

// =================================================================



// =========================== Recuperar datos del alumno =====================
$result_alumno = $gestionData->consultaDatosAlumnoInscritoByCurp($curp);
$rowAlu = mysqli_fetch_array($result_alumno);

$id_alumno = $rowAlu['id_alumno'];

// ===== Consultar datos del historial médico ================== 
$result_hm = $gestionData->consultaDatosHM($id_alumno);
$rowHM = mysqli_fetch_array($result_hm);


// ===== Consultar el nombre del tutor ================== 
$result_tutor = $gestionData->consultaDatosTutor($id_alumno);
$rowTut = mysqli_fetch_array($result_tutor);
@$nombre_del_tutor = $rowTut['nombre'];
// ==========================================================================



if(isset($_POST['curp'])) {

// ====== Definir edad del alumno ===================
$curp = $_POST['curp'];
include('funciones.php');
$edad = calculaEdad($curp);
$edad_anios = $edad[0];
$edad_meses = $edad[1];
// ==================================================


// ========== Definir sexo del alumno =============
if($rowAlu['sexo'] == "M") {      
 $sexo_alu = '<b>MUJER</b>';
   }
elseif($rowAlu['sexo'] == "H") {
 $sexo_alu = '<b>HOMBRE</b>';
   }
// ===============================================



$html = '<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Historial médico</title>

<style>


 @page {
    margin-top: 0.5cm;    /* Margen superior */
    margin-bottom: 1.5cm; /* Margen inferior */
    margin-left: 1.5cm;     /* Margen izquierdo */
    margin-right: 1cm;    /* Margen derecho */
  }

body {
    font-size: 12pt;
}
.titulo {
    text-align: center;
    font-size: 1.4em;
    text-align: center;
    font-weight: bold;
}

.subtit {
    font-size: 1.2em;
    text-align: center;
    font-weight: bold;
}


.turno {
float: left;
}

.cct {
float: right;
}

.borde td{
    border: 1px solid #45556C;
}
</style>

</head>


<body>
<section>
<div id="header">
<h1 style="text-align: center; font-size: 13px; margin-top: 30px;">'.$nom_esc.'</h1>
<h1 style="text-align: center; font-size: 12px; margin-top: -10px;">CCT: '.$cct.' | CICLO: '.$ciclo.'</h1>
<p style="text-align: center; font-size: 12px; color: #145a32;"><b>HISTORIAL MÉDICO DEL ALUMNO(A)</b></p>
</div>

<!-- ====================================================================== -->
<div style="font-size: 9px; border: 1px solid #45556C;">
<table style="font-size: 9px; width: 100%;">    
    <tr>
     
     <td style="text-align: center; width: 25%;">
    NOMBRE:
    </td>

    <td style="text-align: center; width: 25%;">
      GRUPO:
    </td>

    <td style="text-align: center; width: 25%;">
    DOMICILIO:
    </td>

    <td style="text-align: center; width: 25%;">
    SEXO: 
    </tr>

    <tr>
    
    <td style="text-align: left;">
    <b>'.$rowAlu['nombre'].'</b>
    </td>

    <td style="text-align: center;">
     <b>'.$rowAlu['grado'].$rowAlu['grupo'].'</b>
    </td>

    <td style="text-align: left;">
    <b>'.$rowAlu['calle'].', '.$rowAlu['colonia'].', '.$rowAlu['localidad'].', '.$rowAlu['municipio'].'</b>
    </td>

    <td style="text-align: center;">
    '.$sexo_alu.'
    </td>

    </tr>

    </table>
</div>

<!-- ====================================================================== -->
  
<table style="font-size: 9px; border: 1px solid #45556C; width: 100%; margin-bottom: 5px;"> 
    <tr>
    <td style="padding: 5px;">
    TEL 1: <br /> <b>'.$rowAlu['num_tel_1'].'</b>
    </td>

    <td style="padding: 5px;">
    TEL 2: <br /><b>'.$rowAlu['num_tel_2'].'</b>
    </td>


    <td style="padding: 5px;">
    TEL EMERGENCIA: <br /><b>'.$rowAlu['num_tel_emer'].'</b>
    </td>


    <td style="padding: 5px;">
    e-mail: <br /><b>'.$rowAlu['email'].'</b>
    </td>

    <td style="padding: 5px; text-align: center;">
    PESO (Kg):<br /> <b>'.$rowHM['peso'].'</b>
    </td>


    <td style="padding: 5px; text-align: center;">
    ESTATURA (Cm.):<br /> <b>'.$rowHM['estatura'].'</b>
    </td>


    <td style="padding: 5px; text-align: center;">
    EDAD:<br /><b>'.$edad_anios.' AÑOS '.$edad_meses.' MESES
    </b></td>
    </tr>
    </table>


<!-- ====================================================================== -->
    <table style="font-size: 9px; border: 1px solid #45556C; width: 100%; margin-bottom: 3px;">    
    <tr>
    <td style="text-align: center; padding: 5px; border: 1px solid #45556C; background-color: #A4F4CF; width: 25%;">
    <b>ENFERMEDADES QUE HA PADECIDO DURANTE LOS ÚLTIMOS 12 MESES:</b>
    </td>

    <td style="text-align: center; padding: 5px; border: 1px solid #45556C; background-color: #A4F4CF; width: 25%;">
    <b>ENFERMEDADES QUE PADECE CON MAYOR FRECUENCIA:</b>
    </td>

  
    <td style="text-align: center; padding: 5px; border: 1px solid #45556C; background-color: #A4F4CF; width: 25%;">
    <b>¿TIENE ALGUNA ALERGIA?</b>
    </td>

    <td style="text-align: center; padding: 5px; border: 1px solid #45556C; background-color: #A4F4CF; width: 25%;">
    <b>¿HA PADECIDO COVID?</b>
    </td>



    </tr>
    <td style="padding: 5px; border: 1px solid #45556C;">'.$rowHM['ultimas_enfermedades'].'</td>
    <td style="padding: 5px; border: 1px solid #45556C;">'.$rowHM['enfermedades_frecuentes'].'</td>
    <td style="padding: 5px; border: 1px solid #45556C;">'.$rowHM['alergias'].'</td>
    <td style="padding: 5px; border: 1px solid #45556C;">'.$rowHM['covid'].'</td>
    </tr>
    </table>

<!-- ====================================================================== -->

    <table style="font-size: 9px; border: 1px solid #45556C; width: 100%; margin-bottom: 3px;">  
    <tr><td colspan= "3" style="background-color: #A4F4CF; text-align: center;"><b>VACUNAS CONTRA COVID-19</td></b></tr>  
    <tr>
    <td style="text-align: center; padding: 5px; border: 1px solid #45556C; width: 33%;">
    <b>PRIMERA DOSIS:</b>
    </td>

    <td style="text-align: center; padding: 5px; border: 1px solid #45556C; width: 33%;">
    <b>SEGUNDA DOSIS:</b>
    </td>

  
    <td style="text-align: center; padding: 5px; border: 1px solid #45556C; width: 33%;">
    <b>TERCERA DOSIS:</b>
    </td>

  
    </tr>
    <td style="padding: 5px; border: 1px solid #45556C;">'.$rowHM['ultimas_enfermedades'].'</td>
    <td style="padding: 5px; border: 1px solid #45556C;">'.$rowHM['enfermedades_frecuentes'].'</td>
    <td style="padding: 5px; border: 1px solid #45556C;">'.$rowHM['alergias'].'</td>
    </tr>
    </table>

<!-- ====================================================================== -->


    <table style="font-size: 9px; border: 1px solid #45556C; width: 100%; margin-bottom: 3px;">  
    <tr><td colspan= "3" style="background-color: #A4F4CF; text-align: center;"><b>DATOS DEL MÉDICO FAMILIAR</td></b></tr>  
    <tr>
    <td style="text-align: left; padding: 5px; border: 1px solid #45556C; width: 35%;">
    <b>NOMBRE: '.$rowHM['nombre_medico'].'</b>
    </td>

    <td style="text-align: left; padding: 5px; border: 1px solid #45556C; width: 25%;">
    <b>TELÉFONO: '.$rowHM['num_tel_medico'].'</b>
    </td>

  
    <td style="text-align: left; padding: 5px; border: 1px solid #45556C; width: 35%;">
    <b>INSTITUCIÓN DE DERECHOHABIENCIA: '.$rowHM['institucion'].'</b>
    </td>

  </table>

<!-- ====================================================================== -->



    <table style="font-size: 9px; border: 1px solid #45556C; width: 100%; margin-bottom: 3px;">  
    <tr><td colspan= "6" style="background-color: #A4F4CF; text-align: center;"><b>¿PADECE ALGUNA DE LAS SIGUIENTES ENFERMEDADES?</td></b></tr>  
    <tr>

    <td>
    SOBREPESO U OBESIDAD: <b>'.$rowHM['sobrepeso'].'</b>
    </td>

    <td>
    ENFERMEDAD DEL CORAZÓN: <b>'.$rowHM['corazon'].'</b>
    </td>


    <td>
    BRONQUITIS: <b>'.$rowHM['bronquitis'].'</b>
    </td>


    <td>
    HEMORRAGIAS: <b>'.$rowHM['hemorragias'].'</b>
    </td>

    <td>
    EPILEPSIA: <b>'.$rowHM['epilepsia'].'</b>
    </td>


    <td>
    FIEBRE REUMÁTICA: <b>'.$rowHM['fiebre_reumatica'].'</b>
    </td>
    
    </tr>

    <tr>

    <td>
    CANCER: <b>'.$rowHM['cancer'].'</b>
    </td>

    <td>
    DIABETES: <b>'.$rowHM['diabetes'].'</b>
    </td>


    <td>
    AMIGDALITIS: <b>'.$rowHM['amigdalitis'].'</b>
    </td>


    <td>
    ANEMIA: <b>'.$rowHM['anemia'].'</b>
    </td>

    <td>
    HEPATITIS: <b>'.$rowHM['hepatitis'].'</b>
    </td>


    <td>
    NEOPLASIAS (TUMORES): <b>'.$rowHM['neoplasias'].'</b>
    </td>
    
    </tr>
    </table>

<!-- ====================================================================== -->

    <table style="font-size: 9px; border: 1px solid #45556C; width: 100%; margin-bottom: 3px;">  
    <tr><td colspan= "6" style="background-color: #A4F4CF; text-align: center;"><b>HA DETECTADO EN EL(LA) NIÑO(A) QUE:</td></b></tr>  
    <tr>

    <td style="padding: 2px;">
    TIENE DIFICULTAD PARA DORMIR DURANTE LA NOCHE: <b>'.$rowHM['dificultad_dormir'].'</b>
    </td>

    <td style="padding: 2px;">
    LE DA FIEBRE CON FRECUENCIA: <b>'.$rowHM['fiebre_frecuente'].'</b>
    </td>


    <td style="padding: 2px;">
    LE FALTA AIRE DESPUÉS DE HACER EJERCICIO: <b>'.$rowHM['falta_aire'].'</b>
    </td>


    <td style="padding: 2px;">
    LE DUELEN LAS PIERNAS POR LA NOCHE: <b>'.$rowHM['dolor_piernas'].'</b>
    </td>

    <td style="padding: 2px;">
    SE DESMAYA CON FRECUENCIA: <b>'.$rowHM['desmayos_frecuentes'].'</b>
    </td>

    </tr>


    </table>

<!-- ====================================================================== -->

<table style="font-size: 9px; width: 100%;">    
    <tr>
     <td style="border: 1px solid #45556C; padding: 2px;">
    ALÉRGICO(A) A ALGÚN MEDICAMENTO (ESPECIFIQUE): &nbsp; <b>'.$rowHM['alergia_medicamento'].'</b>
    </td>
    </tr>

    <tr>
    <td style="border: 1px solid #45556C; padding: 2px;">
     PRESENTA HEMORRAGIAS FRECUENTES (ESPECIFIQUE): &nbsp; <b>'.$rowHM['hemorragias_frecuentes'].'</b>
    </td>
    </tr>

    <tr>
    <td style="border: 1px solid #45556C; padding: 2px;">
    ALÉRGICO(A) A ALGÚN ALIMENTO O BEBIDA (ESPECIFIQUE): &nbsp;<b>'.$rowHM['alergia_alimento'].'</b>
    </td>
    </tr>

    <tr>
    <td style="border: 1px solid #45556C; padding: 2px;">
    ¿HA RECIBIDO ALGUNA VEZ TRANSFUSIÓN SANGUÍNEA? &nbsp;<b>'.$rowHM['transfusion'].'</b>
    </td>
    </tr>

    <tr>
    <td style="border: 1px solid #45556C; padding: 2px;">
    ¿TIENE IMPEDIMENTO PARA REALIZAR ACTIVIDADES FÍSICAS Y/O DEPORTIVAS? &nbsp;<b>'.$rowHM['impedimento'].'</b>
    </td>
    </tr>

    <tr>
    <td style="border: 1px solid #45556C; padding: 2px;">
    ¿CUENTA CON ALGÚN ANTECEDENTE MÉDICO QUE LE PROHIBA A SU HIJO(A) REALIZAR ACTIVIDAD FÍSICA? &nbsp;<b>'.$rowHM['antecedente_medico'].'</b>
    </td>
    <tr>

    </table>
<!-- ==================================================================================================================== -->


    <table style="font-size: 9px; border: 1px solid #45556C; width: 100%;">  
    <tr><td colspan= "6" style="background-color: #A4F4CF; text-align: center;"><b>ANTECEDENTES HEREDITARIOS DEL ALUMNO</td></b></tr>  
    <tr>

    <td>
    FAMILIAR DIABÉTICO: <b>'.$rowHM['familiar_diabetes'].'</b>
    </td>

    <td>
    FAMILIAR ENFERMO DEL CORAZÓN: <b>'.$rowHM['familiar_corazon'].'</b>
    </td>


    <td>
    FAMILIAR HIPERTENSO: <b>'.$rowHM['familiar_hipertension'].'</b>
    </td>


    <td>
    FAMILIAR ENFERMO DE CANCER: <b>'.$rowHM['familiar_cancer'].'</b>
    </td>

    </tr>
    
    </table>

<!-- ====================================================================== -->

<p style="font-size: 9px;">Bajo protesta de decir la verdad, MANIFIESTO que las respuestas del cuestionario corresponden a mi hijo(a): que cursará el '.$rowAlu['grado'].'° en el '.$nom_esc.' turno: '.$turno.' CCT '.$cct.' del municipio de '.$municipio.', México. Asi mismo, al firmar este documento autorizo a la institución que pueda hacer uso de la información proporcionada cuando sea necesario y en el caso de que durante el presente ciclo escolar, mi hijo(a) presentara alguna sintomatología o enfermedad que limite su desempeño en alguna actividad a realizar en la escuela, me comprometo a informarle inmediatamente por escrito.</p>


<p style="font-size: 9px;">Considerando que la institución, promueve el desarrollo integral y pertinente a las capacidades físicas e intelectuales de los alumnos; así como de sus actitudes y valores, se requiere determine si autoriza que su hijo(a) realice las actividades escolares programadas.</p>


<div style="margin-left: 100px;">
<table>
<tr style="text-align: center; font-size: 9px;">
    <td style="padding: 10px;">
    <b>SÍ AUTORIZO</b>
    </td>

    <td style="width: 50%;"></td>
        
    <td style="padding: 9px;">
    <b>NO AUTORIZO</b>
    </td>
</tr>

<tr>
<td style="padding: 10px;"></td>
</tr>


<tr style="text-align: center;  font-size: 9px;">
    <td style="padding: 1px; border-top: 1px solid #45556C;">'.$rowTut['nombre'].'<br /><b>NOMBRE Y FIRMA DEL PADRE, MADRE O TUTOR</b></td>

<td style="width: 100px;"></td>
        
    <td style="padding: 1px; border-top: 1px solid #45556C;">'.$rowTut['nombre'].'<br /><b>NOMBRE Y FIRMA DEL PADRE, MADRE O TUTOR</b></td>
</tr>
</table></div>



</section>
</body>
</html>';


// =========================================Salida a PDF ===================================================
// 6. Cargar el HTML en la librería
$dompdf->loadHtml($html);

// 7. (Opcional) Configurar el tamaño y orientación del papel
// Opciones: 'letter', 'legal', 'A4', etc. Orientación: 'portrait' (vertical) o 'landscape' (horizontal)
$dompdf->setPaper('letter', 'portrait');

// 8. Renderizar el HTML como PDF (Procesamiento)
$dompdf->render();

// 9. Enviar el PDF generado al navegador del usuario
// El parámetro "Attachment" => true fuerza la descarga automática. Usa false para previsualizar.
$dompdf->stream("documento_generado.pdf", array("Attachment" => false));
// =========================================================================================================

}
else {
    echo "<div class='alert alert-info' style='font-size: 1.4em;'>
        <p style='text-align: center;'><strong><a href='index.php'>IR A LA PÁGINA DE INICIO</a></strong></p>
    </div>";
}
?>