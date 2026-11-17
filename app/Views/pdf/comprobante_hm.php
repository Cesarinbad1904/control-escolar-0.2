<!DOCTYPE html>
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
<h1 style="text-align: center; font-size: 13px; margin-top: 30px;"><?= esc($escuela->nombre) ?></h1>
<h1 style="text-align: center; font-size: 12px; margin-top: -10px;">CCT: <?= esc($escuela->cct) ?> | CICLO: <?= esc($escuela->ciclo_escolar) ?></h1>
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
    
    <td style="text-align: center;">
    <b><?= esc($alumno->nombre_alumno) ?> <?= esc($alumno->primer_apellido_alumno) ?> <?= esc($alumno->segundo_apellido_alumno) ?></b>
    </td>

    <td style="text-align: center;">
     <b><?= esc($alumno->grado) ?><?= esc($alumno->grupo) ?></b>
    </td>

    <td style="text-align: left;">
    <b><?= esc($alumno->calle_num_dom) ?>, <?= esc($alumno->colonia_dom) ?>, <?= esc($alumno->localidad_dom) ?>, <?= esc($alumno->municipio_dom) ?></b>
    </td>

    <td style="text-align: center;">
    <?= esc($alumno->sexo_alumno) ?>
    </td>

    </tr>

    </table>
</div>

<!-- ====================================================================== -->
  
<table style="font-size: 9px; border: 1px solid #45556C; width: 100%; margin-bottom: 5px;"> 
    <tr>
    <td style="padding: 5px;">
    TELÉFONO 1: <br /> <b><?= esc($alumno->telefono_1) ?></b>
    </td>

    <td style="padding: 5px;">
    TELÉFONO 2: <br /><b><?= esc($alumno->telefono_2) ?></b>
    </td>


    <td style="padding: 5px;">
    TEL. EMERGENCIA: <br /><b><?= esc($alumno->telefono_emer) ?></b>
    </td>


    <td style="padding: 5px;">
    e-mail: <br /><b><?= esc($alumno->email_alumno) ?></b>
    </td>

    <td style="padding: 5px; text-align: center;">
    PESO (kg):<br /> <b><?= esc($medico->peso) ?></b>
    </td>


    <td style="padding: 5px; text-align: center;">
    ESTATURA (cm.):<br /> <b><?= esc($medico->estatura) ?></b>
    </td>


    <td style="padding: 5px; text-align: center;">
    EDAD (calculada a la fecha <b><?= esc($fecha_comparacion) ?>):<br /><b><?= esc($edad_alumno['anios']) ?> AÑOS <?= esc($edad_alumno['meses']) ?> MESES
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
    <b>¿HA PADECIDO COVID?</b>
    </td>

    <td style="text-align: center; padding: 5px; border: 1px solid #45556C; background-color: #A4F4CF; width: 25%;">
    <b>VACUNAS CONTRA COVID-19</b>
    </td>


    </tr>
    <td style="padding: 5px; border: 1px solid #45556C;"><?= esc($medico->ultimas_enfermedades) ?></td>
    <td style="padding: 5px; border: 1px solid #45556C;"><?= esc($medico->enfermedades_frecuentes) ?></td>
    <td style="padding: 5px; border: 1px solid #45556C;"><?= esc($medico->covid) ?></td>
    <td style="padding: 5px; border: 1px solid #45556C;"><?= esc($medico->covid_dosis) ?></td>
    </tr>
    </table>

<!-- ====================================================================== -->

<!-- ====================================================================== -->


    <table style="font-size: 9px; border: 1px solid #45556C; width: 100%; margin-bottom: 3px;">  
    <tr><td colspan= "3" style="background-color: #A4F4CF; text-align: center;"><b>DATOS DEL MÉDICO FAMILIAR</td></b></tr>  
    <tr>
    <td style="text-align: left; padding: 5px; border: 1px solid #45556C; width: 35%;">
    <b>NOMBRE: <?= esc($medico->nombre_medico) ?></b>
    </td>

    <td style="text-align: left; padding: 5px; border: 1px solid #45556C; width: 25%;">
    <b>TELÉFONO: <?= esc($medico->tel_medico) ?></b>
    </td>

  
    <td style="text-align: left; padding: 5px; border: 1px solid #45556C; width: 35%;">
    <b>INSTITUCIÓN DE DERECHOHABIENCIA: <?= esc($medico->institucion_dh) ?></b>
    </td>

  </table>

<!-- ====================================================================== -->



    <table style="font-size: 9px; border: 1px solid #45556C; width: 100%; margin-bottom: 3px;">  
    <tr><td colspan= "6" style="background-color: #A4F4CF; text-align: center;"><b>¿PADECE ALGUNA DE LAS SIGUIENTES ENFERMEDADES?</td></b></tr>  
    <tr>

    <td>
    SOBREPESO U OBESIDAD: <b><?= esc($medico->sobrepeso) ?></b>
    </td>

    <td>
    ENFERMEDAD DEL CORAZÓN: <b><?= esc($medico->corazon) ?></b>
    </td>


    <td>
    BRONQUITIS: <b><?= esc($medico->bronquitis) ?></b>
    </td>


    <td>
    HEMORRAGIAS: <b><?= esc($medico->hemorragias) ?></b>
    </td>

    <td>
    EPILEPSIA: <b><?= esc($medico->epilepsia) ?></b>
    </td>


    <td>
    FIEBRE REUMÁTICA: <b><?= esc($medico->fiebre_reumatica) ?></b>
    </td>
    
    </tr>

    <tr>

    <td>
    CANCER: <b><?= esc($medico->cancer) ?></b>
    </td>

    <td>
    DIABETES: <b><?= esc($medico->diabetes) ?></b>
    </td>


    <td>
    AMIGDALITIS: <b><?= esc($medico->amigdalitis) ?></b>
    </td>


    <td>
    ANEMIA: <b><?= esc($medico->anemia) ?></b>
    </td>

    <td>
    HEPATITIS: <b><?= esc($medico->hepatitis) ?></b>
    </td>


    <td>
    NEOPLASIAS (TUMORES): <b><?= esc($medico->neoplasias) ?></b>
    </td>
    
    </tr>
    </table>

<!-- ====================================================================== -->

    <table style="font-size: 9px; border: 1px solid #45556C; width: 100%; margin-bottom: 3px;">  
    <tr><td colspan= "6" style="background-color: #A4F4CF; text-align: center;"><b>HA DETECTADO EN EL(LA) NIÑO(A) QUE:</td></b></tr>  
    <tr>

    <td style="padding: 2px;">
    TIENE DIFICULTAD PARA DORMIR DURANTE LA NOCHE: <b><?= esc($medico->dificultad_dormir) ?></b>
    </td>

    <td style="padding: 2px;">
    LE DA FIEBRE CON FRECUENCIA: <b><?= esc($medico->fiebre_frecuente) ?></b>
    </td>


    <td style="padding: 2px;">
    LE FALTA AIRE DESPUÉS DE HACER EJERCICIO: <b><?= esc($medico->falta_aire) ?></b>
    </td>


    <td style="padding: 2px;">
    LE DUELEN LAS PIERNAS POR LA NOCHE: <b><?= esc($medico->dolor_piernas) ?></b>
    </td>

    <td style="padding: 2px;">
    SE DESMAYA CON FRECUENCIA: <b><?= esc($medico->desmayos_frecuentes) ?></b>
    </td>

    </tr>


    </table>

<!-- ====================================================================== -->

<table style="font-size: 9px; width: 100%;">    
    <tr>
     <td style="border: 1px solid #45556C; padding: 2px;">
    ALÉRGICO(A) A ALGÚN MEDICAMENTO (ESPECIFIQUE): &nbsp; <b> <?= esc($medico->alergia_medicamento) ?></b>
    </td>
    </tr>

    <tr>
    <td style="border: 1px solid #45556C; padding: 2px;">
     PRESENTA HEMORRAGIAS FRECUENTES (ESPECIFIQUE): &nbsp; <b> <?= esc($medico->hemorragias_frecuentes) ?></b>
    </td>
    </tr>

    <tr>
    <td style="border: 1px solid #45556C; padding: 2px;">
    ALÉRGICO(A) A ALGÚN ALIMENTO O BEBIDA (ESPECIFIQUE): &nbsp;<b> <?= esc($medico->alergia_alimento) ?></b>
    </td>
    </tr>

    <tr>
    <td style="border: 1px solid #45556C; padding: 2px;">
    ¿HA RECIBIDO ALGUNA VEZ TRANSFUSIÓN SANGUÍNEA? &nbsp;<b> <?= esc($medico->transfusion) ?></b>
    </td>
    </tr>

    <tr>
    <td style="border: 1px solid #45556C; padding: 2px;">
    ¿TIENE IMPEDIMENTO PARA REALIZAR ACTIVIDADES FÍSICAS Y/O DEPORTIVAS? &nbsp;<b> <?= esc($medico->impedimento) ?></b>
    </td>
    </tr>

    <tr>
    <td style="border: 1px solid #45556C; padding: 2px;">
    ¿CUENTA CON ALGÚN ANTECEDENTE MÉDICO QUE LE PROHIBA A SU HIJO(A) REALIZAR ACTIVIDAD FÍSICA? &nbsp;<b> <?= esc($medico->antecedente_medico) ?></b>
    </td>
    <tr>

    <tr>
    <td style="border: 1px solid #45556C; padding: 2px;">
    RECOMENDACIONES: &nbsp;<b> <?= esc($medico->recomendaciones) ?></b>
    </td>
    <tr>

    </table>
<!-- ==================================================================================================================== -->


    <table style="font-size: 9px; border: 1px solid #45556C; width: 100%;">  
    <tr><td colspan= "6" style="background-color: #A4F4CF; text-align: center;"><b>ANTECEDENTES HEREDITARIOS DEL ALUMNO</td></b></tr>  
    <tr>

    <td>
    FAMILIAR DIABÉTICO: <b><?= esc($medico->familiar_diabetes) ?></b>
    </td>

    <td>
    FAMILIAR ENFERMO DEL CORAZÓN: <b><?= esc($medico->familiar_corazon) ?></b>
    </td>


    <td>
    FAMILIAR HIPERTENSO: <b><?= esc($medico->familiar_hipertension) ?></b>
    </td>


    <td>
    FAMILIAR ENFERMO DE CANCER: <b><?= esc($medico->familiar_cancer) ?></b>
    </td>

    </tr>
    
    </table>

<!-- ====================================================================== -->

<p style="font-size: 9px;">Bajo protesta de decir la verdad, MANIFIESTO que las respuestas del cuestionario corresponden a mi hijo(a): que cursará el <?= esc($alumno->grado) ?>° grupo "<?= esc($alumno->grupo) ?>" en la escuela "<?= esc($escuela->nombre) ?>" turno: <?= esc(strtolower($escuela->turno)) ?>, CCT: <?= esc($escuela->cct) ?> del municipio de <?= esc($escuela->municipio) ?>, México. Asi mismo, al firmar este documento autorizo a la institución que pueda hacer uso de la información proporcionada cuando sea necesario y en el caso de que durante el presente ciclo escolar, mi hijo(a) presentara alguna sintomatología o enfermedad que limite su desempeño en alguna actividad a realizar en la escuela, me comprometo a informarle inmediatamente por escrito.</p>


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
    <td style="padding: 1px; border-top: 1px solid #45556C;"><?= esc($tutor->segundo_apellido_tutor) ?> <?= esc($tutor->primer_apellido_tutor) ?> <?= esc($tutor->nombre_tutor) ?><br /><b>NOMBRE Y FIRMA DEL PADRE, MADRE O TUTOR</b></td>

<td style="width: 100px;"></td>
        
    <td style="padding: 1px; border-top: 1px solid #45556C;"><?= esc($tutor->segundo_apellido_tutor) ?> <?= esc($tutor->primer_apellido_tutor) ?> <?= esc($tutor->nombre_tutor) ?><br /><b>NOMBRE Y FIRMA DEL PADRE, MADRE O TUTOR</b></td>
</tr>
</table></div>



</section>
</body>
</html>
