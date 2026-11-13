<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Ficha de inscripción ciclo <?= esc($escuela->ciclo_escolar) ?></title>

<style>

@page {
    margin-top: 1.5cm;    /* Margen superior */
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

<img style="position: absolute; top: -30px;" src="'.$qr_base64.'" widht="120" height="120" />

<p style="position: absolute; top: -30px; right: 50px; font-size: 0.8em;">ID DEL ALUMNO: <b><?= esc($alumno->id_alumno) ?></b></p>

<div id="header">
<h1 style="text-align: center; font-size: 13px; margin-top: 30px;"><?= esc($escuela->nombre) ?></h1>
<h1 style="text-align: center; font-size: 12px; margin-top: -10px;">CCT: <?= esc($escuela->cct) ?> | CICLO: <?= esc($escuela->ciclo_escolar) ?></h1>
<p style="text-align: center; font-size: 12px; color: #145a32;"><b>FICHA DE INSCRIPCIÓN</b></p>
</div>

<!-- ====================================================================== -->
<div style="font-size: 9px; border: 1px solid #1C1917;">
<table style="font-size: 9px; width: 100%;">   
<tr><td colspan="7" style="background-color: #FFDF20; text-align: center; font-size: 9pt; padding: 3px; border: 1px solid #71717B;"><b>DATOS DEL ALUMNO</b></td></tr> 
    
    <tr>
    <td style="text-align: center; width: 32%;">
    NOMBRE:
    </td>

    <td style="text-align: center; width: 20%;">
      CURP:
    </td>

    <td style="text-align: center; width: 8%;">
      GRUPO:
    </td>

    <td style="text-align: center; width: 10%;">
    FECHA DE NACIMIENTO:
    </td>

    <td style="text-align: center; width: 10%;">
    SEXO: 
    </td>

    <td style="text-align: center; width: 10%;">
    ENTIDAD: 
    </td>


    <td style="text-align: center; width: 10%;">
    NACIONALIDAD: 
    </td>
    </tr>


    <tr>
    <td style="text-align: center;">
    <b><?= esc($alumno->primer_apellido_alumno) ?> <?= esc($alumno->segundo_apellido_alumno) ?> <?= esc($alumno->nombre_alumno ) ?></b>
    </td>

    <td style="text-align: center;">
    <b><?= esc($alumno->curp) ?></b>
    </td>

    <td style="text-align: center;">
     <b><?= esc($alumno->grado) ?><?= esc($alumno->grupo) ?> </b>
    </td>

    <td style="text-align: center;">
    <b><?= esc($alumno->fec_nac_alumno) ?></b>
    </td>

    <td style="text-align: center;">
    <b><?= esc($alumno->sexo_alumno) ?></b>
    </td>

    <td style="text-align: center;">
    <b><?= esc($alumno->entidad_nac_alumno) ?></b>
    </td>


    <td style="text-align: center;">
    <b><?= esc($alumno->nacionalidad_alumno) ?></b>
    </td>
    </tr>
    </table>

<br/>
<hr/>

<table style="font-size: 9px; width: 100%;">  
<tr>
    <td style="text-align: center; width: 25%;">
    CALLE Y NÚMERO:
    </td>

    <td style="text-align: center; width: 25%;">
    COLONIA:
    </td>

    <td style="text-align: center; width: 20%;">
    LOCALIDAD:
    </td>

    <td style="text-align: center; width: 20%;">
    MUNICIPIO: 
    </td>

    <td style="text-align: center; width: 10%;">
    CÓDIGO POSTAL: 
    </td>

    </tr>


    <tr>
    <td style="text-align: center;">
    <b><?= esc($alumno->calle_num_dom) ?></b>
    </td>

    <td style="text-align: center;">
    <b><?= esc($alumno->colonia_dom) ?></b>
    </td>

    <td style="text-align: center;">
    <b><?= esc($alumno->localidad_dom) ?></b>
    </td>

    <td style="text-align: center;">
    <b><?= esc($alumno->municipio_dom) ?></b>
    </td>

    <td style="text-align: center;">
    <b><?= esc($alumno->cp) ?></b>
    </td>

    </tr>
    </table>
</div>

<br />



<div style="font-size: 9px; border: 1px solid #1C1917;">
<table style="font-size: 9px; width: 100%;">    
    
    <tr>
    <td style="text-align: left; width: 100%;">
    REFERENCIA DOMICILIARIA:&nbsp; <b><?= esc($alumno->referencia_dom) ?></b>
    </td>
    </tr>
</table>

<table style="font-size: 9px; width: 100%;">    
    <tr>

    <td style="text-align: center; width: 15%;">
     TEL 1:
    </td>

    <td style="text-align: center; width: 15%;">
    TEL 2:
    </td>

    <td style="text-align: center; width: 15%;">
    TEL EMERGENCIA: 
    </td>

    <td style="text-align: center; width: 15%;">
    e-mail: 
    </td>


    <td style="text-align: center; width: 15%;">
    RED SOCIAL: 
    </td>
   

    <td style="text-align: center; width: 15%;">
    USUARIO RS: 
    </td>
    </tr>


    <tr>
  
    <td style="text-align: center;">
    <b><?= esc($alumno->telefono_1 ) ?></b>
    </td>

    <td style="text-align: center;">
    <b><?= esc($alumno->telefono_2 ) ?></b>
    </td>

    <td style="text-align: center;">
    <b><?= esc($alumno->telefono_emer ) ?></b>
    </td>

    <td style="text-align: center;">
    <b><?= esc($alumno->email_alumno ) ?></b>
    </td>


    <td style="text-align: center;">
    <b><?= esc($alumno->rs_alumno ) ?></b>
    </td>


    <td style="text-align: center;">
    <b><?= esc($alumno->rs_user_alumno ) ?></b>
    </td>
    </tr>

    </table>
</div>


<br />


<div style="font-size: 9px; border: 1px solid #1C1917;">
<table style="font-size: 9px; width: 100%;">   
<tr><td colspan="7" style="background-color: #FFDF20; text-align: center; font-size: 9pt; padding: 3px; border: 1px solid #71717B;"><b>DATOS DEL PRIMER TUTOR</b></td></tr> 
    
    <tr>
    <td style="text-align: center; width: 25%;">
    NOMBRE:
    </td>

    <td style="text-align: center; width: 15%;">
      CURP:
    </td>

  

    <td style="text-align: center; width: 10%;">
    SEXO: 
    </td>

    <td style="text-align: center; width: 10%;">
    PARENTESCO: 
    </td>


    <td style="text-align: center; width: 10%;">
    E. CIVIL: 
    </td>

    <td style="text-align: center; width: 20%;">
    OCUPACIÓN: 
    </td>
    </tr>



 
    <tr>
    <td style="text-align: center;">
    <b><?= esc($tutor->primer_apellido_tutor ) ?> <?= esc($tutor->segundo_apellido_tutor ) ?> <?= esc($tutor->nombre_tutor ) ?></b>
    </td>

    <td style="text-align: center;">
    <b><?= esc($tutor->curp_tutor ) ?></b>
    </td>

  
    <td style="text-align: center;">
    <b><?= esc($tutor->sexo_tutor ) ?></b>
    </td>


    <td style="text-align: center;">
    <b><?= esc($tutor->parentesco_tutor ) ?></b>
    </td>


    <td style="text-align: center;">
    <b><?= esc($tutor->estado_civil_tutor ) ?></b>
    </td>


    <td style="text-align: center;">
    <b><?= esc($tutor->ocupacion_tutor ) ?></b>
    </td>

    </tr>
    </table>
<br />
<hr />

<table style="font-size: 9px; width: 100%;"> 
    <tr>
    <td style="text-align: center;">
    ESTUDIOS:
    </td>

    <td style="text-align: center;">
    INGRESOS:
    </td>


    <td style="text-align: center;">
    e-mail: 
    </td>

    <td style="text-align: center;">
    RED SOCIAL: 
    </td>


    <td style="text-align: center;">
    USUARIO RS: 
    </td>
    </tr>


    <tr>
    <td style="text-align: center;">
    <b><?= esc($tutor->estudios_tutor ) ?></b>
    </td>

    <td style="text-align: center;">
    <b><?= esc($tutor->salario_tutor ) ?></b>
    </td>

    
    <td style="text-align: center;">
    <b><?= esc($tutor->email_tutor ) ?></b>
    </td>


    <td style="text-align: center;">
    <b><?= esc($tutor->rs_tutor ) ?></b>
    </td>


    <td style="text-align: center;">
    <b><?= esc($tutor->rs_user_tutor ) ?></b>
    </td>

    </tr>
    </table>
</div>

<br />

<div style="font-size: 9px; border: 1px solid #1C1917;">
<table style="font-size: 9px; width: 100%;">   
<tr><td colspan="7" style="background-color: #FFDF20; text-align: center; font-size: 9pt; padding: 3px; border: 1px solid #71717B;"><b>DATOS DEL SEGUNDO TUTOR</b></td></tr> 
    
    <tr>
    <td style="text-align: center; width: 25%;">
    NOMBRE:
    </td>

    <td style="text-align: center; width: 15%;">
      CURP:
    </td>

    <td style="text-align: center; width: 10%;">
    SEXO: 
    </td>
    

    <td style="text-align: center; width: 10%;">
    PARENTESCO: 
    </td>


    <td style="text-align: center; width: 10%;">
    E. CIVIL: 
    </td>

    <td style="text-align: center; width: 20%;">
    OCUPACIÓN: 
    </td>
    </tr>


    <tr>
    <td style="text-align: center;">
    <b><?= esc($tutor->primer_apellido_tutor2 ) ?> <?= esc($tutor->segundo_apellido_tutor2 ) ?> <?= esc($tutor->nombre_tutor2 ) ?></b>
    </td>


    <td style="text-align: center;">
    <b><?= esc($tutor->curp_tutor2 ) ?></b>
    </td>


    <td style="text-align: center;">
    <b><?= esc($tutor->sexo_tutor2 ) ?></b>
    </td>


   
    <td style="text-align: center;">
    <b><?= esc($tutor->parentesco_tutor2 ) ?></b>
    </td>


    <td style="text-align: center;">
    <b><?= esc($tutor->estado_civil_tutor2 ) ?></b>
    </td>


    <td style="text-align: center;">
    <b><?= esc($tutor->ocupacion_tutor2 ) ?></b>
    </td>

    </tr>
    </table>
<br />
<hr />

<table style="font-size: 9px; width: 100%;"> 
    <tr>
    <td style="text-align: center;">
    ESTUDIOS:
    </td>

    <td style="text-align: center;">
    INGRESOS:
    </td>


    <td style="text-align: center;">
    e-mail: 
    </td>

    <td style="text-align: center;">
    RED SOCIAL: 
    </td>


    <td style="text-align: center;">
    USUARIO RS: 
    </td>

    </tr>


    <tr>
    <td style="text-align: center;">
    <b><?= esc($tutor->estudios_tutor2 ) ?></b>
    </td>

    <td style="text-align: center;">
    <b><?= esc($tutor->salario_tutor2 ) ?></b>
    </td>


    <td style="text-align: center;">
    <b><?= esc($tutor->email_tutor2 ) ?></b>
    </td>

    <td style="text-align: center;">
    <b><?= esc($tutor->rs_tutor2 ) ?></b>
    </td>


    <td style="text-align: center;">
    <b><?= esc($tutor->rs_user_tutor2 ) ?></b>
    </td>


    </tr>
</table>
</div>

<!-- ============================================================== -->
<br />
<br />
<br />
<br />

<div style="margin-left: 100px;">
<table>
<tr style="text-align: center; font-size: 9px;">
    <td style="padding: 10px;">
    <b>TUTOR:</b>
    </td>

    <td style="width: 50%;"></td>
        
    <td style="padding: 9px;">
    <b>RESPONSABLE DE LA INSCRIPCIÓN:</b>
    </td>
</tr>

<tr>
<td style="padding: 10px;"></td>
</tr>


<tr style="text-align: center;  font-size: 9px;">
    <td style="padding: 1px; border-top: 1px solid #45556C;">
      <?= esc($tutor->primer_apellido_tutor ) ?> <?= esc($tutor->segundo_apellido_tutor ) ?> <?= esc($tutor->nombre_tutor ) ?><br />
      <b>NOMBRE Y FIRMA DEL PADRE, MADRE O TUTOR</b></td>

<td style="width: 100px;"></td>
        
    <td style="padding: 1px; border-top: 1px solid #45556C;"><?= esc($escuela->nombre_director ) ?></td>
</tr>
</table></div>

<br />
<br />
<p style="text-align: center; font-size: 10px;">FECHA DE REGISTRO: <?= esc($alumno->fecha_registro ) ?></p>

</section>
</body>
</html>
