<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('contenido') ?>

<?= view('partials/_form-error'); ?>


<form action="create" method="post">

<fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
  <legend class="fieldset-legend">Datos del alumno</legend>

<div class="form-group">
        <label for="grado"><b style="color: red;">*</b> GRADO AL QUE SE INSCRIBIRÁ:</label>
            <select class="form-control" id="grado" name="grado" style="width: 100px;" >
                  <option value="<?php  ?>" selected="selected"><?php  ?>°</option>
                  <option value="1">1°</option>
                  <option value="2">2°</option>
                  <option value="3">3°</option>
                  <option value="4">4°</option>
                  <option value="5">5°</option>
                  <option value="6">6°</option>
                                       
             </select>
</div>

<!-- Se envían los datos de movimiento inicial y fecha de alta en su caso (ocultos) --> 
  <input type='hidden' name='grupo' value="<?php echo "A";  ?>" />
  <input type='hidden' name='mov_i' value="<?php echo "I" ?>" />
  <input type='hidden' name='fecha_alta' value="<?php  ?>" />
  <input type='hidden' name='reprobado' value="NO" />
  <input type='hidden' name='origen' value="<?php echo "ME" ?>" />


<!-- ========= Datos de nacimiento  ================== -->

<div id="datos_nacimiento_alumno">
    <h2>DATOS DE NACIMIENTO DEL ALUMNO</h2>
    <br />
    <div class="form-group">
        <label for="curp_alumno">CURP DEL ALUMNO:</label>
        <input class="form-control" type="text" id="curp_alumno" name="curp_alumno" readonly value="AEAA190507MMCRRTA9" />
    </div>


    <div class="form-group">
        <label for="nombre_alumno">NOMBRE(S) DEL ALUMNO:</label>
        <input class="form-control" type="text" id="nombre_alumno" name="nombre_alumno" value="<?= old('nombre_alumno') ?>" />
    </div>


    <div class="form-group">
        <label for="primer_apellido_alumno">PRIMER APELLIDO DEL ALUMNO:</label>
        <input class="form-control" type="text" id="primer_apellido_alumno" name="primer_apellido_alumno" value="<?= old('primer_apellido_alumno') ?>" />
    </div>


    <div class="form-group">
        <label for="segundo_apellido_alumno">SEGUNDO APELLIDO DEL ALUMNO:</label>
        <input class="form-control" type="text" id="segundo_apellido_alumno" name="segundo_apellido_alumno" value="<?= old('segundo_apellido_alumno') ?>" />
    </div>

    

    <div class="form-group">
        <label for="nacionalidad_alumno">NACIONALIDAD:</label>
        <input type="text" id="nacionalidad_alumno" name="nacionalidad_alumno" size="10" placeholder="MEXICANA" value="MEXICANA" />
    </div>

</fieldset>

<!-- ========= Domicilio del alumno  ================== -->
<h2>DOMICILIO DEL ALUMNO</h2>
    <br />

<div class="form-group">
    <label for="entidad_dom">ESTADO:</label>
      <input type="text" id="entidad_dom" name="entidad_dom" value="MEXICO" readonly="readonly" />
</div>

        <div class="form-group">
      <label for="municipio_dom"><b style="color: red;">*</b> MUNICIPIO:</label>
          <select class="select select-accent" id="municipio_dom" name="municipio_dom" >
                <option disabled selected>SELECCIONAR</option>
                <option value="TEXCOCO">TEXCOCO</option>
                <option value="ATENCO">ATENCO</option>
                <option value="TEPETLAOXTOC">TEPETLAOXTOC</option>
                <option value="CHIAUTLA">CHIAUTLA</option>
                <option value="PAPALOTLA">PAPALOTLA</option>
                <option value="CHICONCUAC">CHICONCUAC</option>
                <option value="TEZOYUCA">TEZOYUCA</option>
                <option value="CHICOLOAPAN">CHICOLOAPAN</option>
                <option value="CHIMALHUACAN">CHIMALHUACAN</option>
                <option value="ECATEPEC">ECATEPEC</option>
                <option value="NEZAHUALCOYOTL">NEZAHUALCOYOTL</option>
                <option value="IXTAPALUCA">IXTAPALUCA</option>
                <option value="ACOLMAN">ACOLMAN</option>
                <option value="LA PAZ">LA PAZ</option>
                <option value="TECAMAC">TECAMAC</option>
                    
           </select>
    </div>
   
    
    <div class="form-group">
        <label for="localidad_dom"><b style="color: red;">*</b> LOCALIDAD:</label>
            <select class="select select-accent" id="localidad_dom" name="localidad_dom" disabled>
            <option disabled selected>Selecciona primero un municipio</option>
                              
            </select>
   </div> 

   

    <div class="form-group">
        <label for="colonia_dom"><b style="color: red;">*</b>COLONIA:</label>
            <input type="text" class="form-control" id="colonia_dom" name="colonia_dom" placeholder="COLONIA" 
            
            data-parsley-required-message="Por favor, ingrese el nombre de su colonia." 
            data-parsley-maxlength="50"
            data-parsley-maxlength-message="No debe ser mayor a 50 caracteres"
            data-parsley-trigger="keyup" />
            
    </div>   

     <div class="form-group">
        <label for="calle_num_dom"><b style="color: red;">*</b> CALLE y NÚMERO:</label>
        <input class="form-control" type="text" id="calle_num_dom" name="calle_num_dom" placeholder="NOMBRE DE LA CALLE Y NÚMERO" 
        
        data-parsley-required-message="Por favor, ingrese el nombre de la calle y el número" 
        data-parsley-maxlength="60"
        data-parsley-maxlength-message="No debe exceder los 60 caracteres"
        data-parsley-trigger="keyup" />
    </div>


    <div class="form-group">
        <label for="entre_calle_1"><b style="color: red;">*</b> ENTRE CALLE:</label>
        <input class="form-control" type="text" id="entre_calle_1" name="entre_calle_1" 
        
        data-parsley-maxlength="40"
        data-parsley-maxlength-message="No debe exceder los 40 caracteres"
        data-parsley-trigger="keyup" />
    </div>

    <div class="form-group">
        <label for="entre_calle_2"><b style="color: red;">*</b> Y CALLE:</label>
        <input class="form-control" type="text" id="entre_calle_2" name="entre_calle_2" 
        
        data-parsley-maxlength="40"
        data-parsley-maxlength-message="No debe exceder los 40 caracteres"
        data-parsley-trigger="keyup" />
    </div>

     <div class="form-group">
        <label for="cp"><b style="color: red;">*</b> CÓDIGO POSTAL:</label>
            <input type="text" style="width: 200px;" class="form-control" id="cp" name="cp" placeholder="CÓDIGO POSTAL"
             
         />     
    </div>      

    <div class="form-group">
        <label for="referencia_dom"><b style="color: red;">*</b> REFERENCIA DOMICILIARIA (BREVE):</label>
        <input class="form-control" type="text" id="referencia_dom" name="referencia_dom" placeholder="REFERENCIA DOMICILIARIA" 
        
        data-parsley-required-message="Por favor, ingrese una referencia domiciliaria muy breve." 
        data-parsley-maxlength="50"
        data-parsley-maxlength-message="No debe exceder los 50 caracteres"
        data-parsley-trigger="keyup" />
    </div>

<!--Comienza datos de contacto del alumno -->
<div id="datos_contacto_alumno">
    <h2>DATOS DE CONTACTO DEL ALUMNO</h2>
<br />

<div class="form-group">
    <label for="telefono_1"><b style="color: red;">*</b> NÚM. DE TELÉFONO (10 DÍGITOS):</label>
    <input class="form-control" type="tel" id="telefono_1" name="telefono_1" style="width: 200px;" 
     

    data-parsley-pattern-message="Debe ser un número de 10 dígitos." />   
</div>

<div class="form-group">
    <label for="telefono_2"><b style="color: red;">*</b> NÚM. DE TELÉFONO 2 (10 DÍGITOS):</label>
    <input class="form-control" type="tel" id="telefono_2" name="telefono_2" style="width: 200px;"
     
    
    data-parsley-pattern-message="Debe ser un número de 10 dígitos." 
    data-parsley-notequalto="#telefono_1" 
    data-parsley-notequalto-message="Este número ya existe en un campo anterior."  />
</div>

<div class="form-group">
    <label for="telefono_emer">NÚM. DE TELÉFONO EMERGENCIAS (10 DÍGITOS):</label>
    <input class="form-control" type="tel" id="telefono_emer" name="telefono_emer" style="width: 200px;"
     
    
    data-parsley-pattern-message="Debe ser un número de 10 dígitos." 
    data-parsley-notequalto="#telefono_2" 
    data-parsley-notequalto-message="Este número ya existe en un campo anterior."  />
</div>

<div class="form-group">
    <label for="email_alumno"><b style="color: red;">*</b> CORREO ELECTRÓNICO:</label>
    <input class="form-control" type="text" id="email_alumno" name="email_alumno" style="text-transform: lowercase; width: 300px;"
     
    data-parsley-type="email" />
</div>

<div class="form-group">
    <label for="rs_alumno"><b style="color: red;">*</b> RED SOCIAL:</label>
        <select style="width: 200px;" class="form-control" id="rs_alumno" name="rs_alumno" >
              <option></option>
              <option>FACEBOOK</option>
              <option>INSTAGRAM</option>
              <option>X</option>
        </select>
  </div>

    <div class="form-group">
        <label for="rs_user_alumno"><b style="color: red;">*</b> NOMBRE DE USUARIO DE LA RED SOCIAL:</label>
        <input style="width: 300px;" class="form-control" type="text" id="rs_user_alumno" name="rs_user_alumno" 
        
        data-parsley-maxlength="20"
        data-parsley-maxlength-message="No debe exceder los 20 caracteres" 
        data-parsley-trigger="keyup" />
    </div>

    <!--Comienza datos complementarios del alumno -->
    <div id="datos_complem_alumno">
    <h2>DATOS COMPLEMENTARIOS</h2>

     <div class="form-group">
        <label for="num_personas">¿CUÁNTAS PERSONAS VIVEN EN SU CASA?</label>
        <input style="width: 100px;" class="form-control" type="number" min="1" id="num_personas" 
        name="num_personas" 
        
        data-parsley-type="number" 
        data-parsley-number-message="Debe ser un número." />
    </div>



    <div class="form-group">
      <label for="vive_con"><b style="color: red;">*</b>¿CON QUIÉN VIVE?</label>
          <select style="width: 150px;" class="form-control" id="vive_con" name="vive_con" >
                <option></option>
                <option>MAMA</option>
                <option>PAPA</option>
                <option>AMBOS</option>
          </select>
    </div>


    <div class="form-group">
      <label for="sosten_econ"><b style="color: red;">*</b> ¿QUIÉN SOSTIENE ECONÓMICAMENTE LA CASA?</label>
          <select style="width: 150px;" class="form-control" id="sosten_econ" name="sosten_econ" >
                <option></option>
                <option>MAMA</option>
                <option>PAPA</option>
                <option>AMBOS</option>
          </select>
    </div>

<br />

     <div class="form-group">
        <label for="nombre_escuela_procedencia">NOMBRE DE LA ESCUELA DE PROCEDENCIA:</label>
        <input class="form-control" type="text" id="nombre_escuela_procedencia" name="nombre_escuela_procedencia" value=""
        
        data-parsley-maxlength="50"
        data-parsley-maxlength-message="No debe exceder los 50 caracteres" 
        data-parsley-trigger="keyup" />
    </div>

    <div class="form-group">
        <label for="anios_prescolar">AÑOS CURSADOS EN PREESCOLAR: </label>
            <select class="form-control" id="anios_prescolar" name="anios_prescolar" style="width: 100px;">
                  <option value="3" selected="selected">3</option>
                  <option value="2">2</option>
                  <option value="1">1</option>
                  <option value="0">0</option>
            </select>
      </div>

<!-- Comienza apoyos tecnológicos -->

<div id="apoyos_tec_alumno">
  <h2>RECURSOS TECNOLÓGICOS CON LOS QUE CUENTA EL ALUMNO</h2>
<br />

    <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="computadora" value="SI">COMPUTADORA DE ESCRITORIO O PORTATIL
        </label>
    </div>

    <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="tablet" value="SI">TABLET
        </label>
    </div>

    
    <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="internet_casa" value="SI">INTERNET EN CASA
        </label>
    </div>

    <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="internet_movil" value="SI">INTERNET EN CELULAR
        </label>
    </div>

    <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="tv_paga" value="SI">TELEVISIÓN DE PAGA
        </label>
    </div>


    <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="tv_abierta" value="SI">TELEVISIÓN ABIERTA
        </label>
    </div>


    <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="radio" value="SI">RADIO
        </label>
    </div>

</div>
<br />
<hr />

<!-- Comienza datos del tutor -->
<h2>DATOS DEL TUTOR</h2>
<br />
<div class="form-group">
  <label for="curp_tutor"><b style="color: red;">*</b> CURP DEL TUTOR:</label>
  <input style="width: 250px;" class="form-control" type="text" id="curp_tutor" name="curp_tutor" 
    />
  
</div>

<div class="form-group">
        <label for="nombre_tutor">NOMBRE(S):</label>
        <input class="form-control" type="text" id="nombre_tutor" name="nombre_tutor" value="<?= old('nombre_tutor') ?>" />
</div>


<div class="form-group">
        <label for="primer_apellido_tutor">PRIMER APELLIDO:</label>
        <input class="form-control" type="text" id="primer_apellido_tutor" name="primer_apellido_tutor" value="<?= old('primer_apellido_tutor') ?>" />
</div>

<div class="form-group">
        <label for="segundo_apellido_tutor">SEGUNDO APELLIDO:</label>
        <input class="form-control" type="text" id="segundo_apellido_tutor" name="segundo_apellido_tutor" value="<?= old('segundo_apellido_tutor') ?>" />
</div>


<div class="form-group">
    <label for="nacionalidad_tutor">NACIONALIDAD:</label>
    <input type="text" id="nacionalidad_tutor" name="nacionalidad_tutor" size="10" value="MEXICANA" />
</div>


  <div class="form-group">
    <label for="ocupacion_tutor"><b style="color: red;">*</b> OCUPACIÓN:</label>
    <input style="width: 400px;" class="form-control" type="text" id="ocupacion_tutor" name="ocupacion_tutor" 
    
    data-parsley-maxlength="30"
    data-parsley-maxlength-message="No debe exceder los 30 caracteres" 
    data-parsley-trigger="keyup" />
  </div>


<div class="form-group">
    <label for="estudios_tutor"><b style="color: red;">*</b> GRADO MÁXIMO DE ESTUDIOS:</label>
        <select style="width: 300px;" class="form-control" id="estudios_tutor" name="estudios_tutor" >
              <option></option>
              <option>NINGUNO</option>
              <option>PRIMARIA</option>
              <option>SECUNDARIA</option>
              <option>PREPARATORIA</option>
              <option>BACHILLERATO TECNICO</option>
              <option>LICENCIATURA</option>
              <option>MAESTRIA</option>
              <option>DOCTORADO</option>
        </select>
    </div>


    <div class="form-group">
      <label for="parentesco_tutor"><b style="color: red;">*</b> PARENTESCO:</label>
          <select style="width: 200px;" class="form-control" id="parentesco_tutor" name="parentesco_tutor" >
                <option></option>
                <option>MADRE</option>
                <option>PADRE</option>
                <option>ABUELO</option>
                <option>ABUELA</option>
                <option>TIO</option>
                <option>TIA</option>
                <option>HERMANO</option>
                <option>HERMANA</option>
                <option>PRIMO</option>
                <option>PRIMA</option>
                <option>MADRINA</option>
                <option>PADRINO</option>
                <option>CUÑADO</option>
                <option>CUÑADA</option>
                <option>VECINO</option>
                <option>VECINA</option>
                <option>AMIGO</option>
                <option>AMIGA</option>
          </select>
      </div>


<div class="form-group">
    <label for="salario_tutor"><b style="color: red;">*</b> INGRESO MENSUAL:</label>
        <select style="width: 300px;" class="form-control" id="salario_tutor" name="salario_tutor" >
            <option></option>
            <option>NINGUNO</option>
            <option>MENOS DE UN SALARIO MÍNIMO</option>
            <option>DE 1 A 2 SALARIOS MÍNIMOS</option>
            <option>DE 2 A 3 SALARIOS MÍNIMOS</option>
            <option>DE 3 A 5 SALARIOS MÍNIMOS</option>
            <option>MÁS DE 5 SALARIOS MÍNIMOS</option>
        </select>
</div>


<div class="form-group">
    <label for="estado_civil_tutor"><b style="color: red;">*</b> ESTADO CIVIL:</label>
        <select style="width: 300px;" class="form-control" id="estado_civil_tutor" name="estado_civil_tutor" >
            <option></option>
            <option>CASADO</option>
            <option>CASADA</option>
            <option>DIVORCIADO</option>
            <option>DIVORCIADA</option>
            <option>SOLTERO</option>
            <option>SOLTERA</option>
            <option>UNION LIBRE</option>
            <option>VIUDO</option>
            <option>VIUDA</option>
              
        </select>
</div>


<div class="form-group">
    <label for="email_tutor"><b style="color: red;">*</b> CORREO ELECTRÓNICO:</label>
        <input class="form-control" type="text" id="email_tutor" name="email_tutor" style="text-transform: lowercase; width: 300px;"
            
           data-parsley-type="email" />
</div>


<div class="form-group">
    <label for="rs_tutor"><b style="color: red;">*</b> RED SOCIAL:</label>
        <select style="width: 250px;" class="form-control" id="rs_tutor" name="rs_tutor" >
            <option></option>
            <option>FACEBOOK</option>
            <option>INSTAGRAM</option>
            <option>X</option>
                                        
        </select>
</div>
        
<div class="form-group">
            <label for="rs_user_tutor"><b style="color: red;">*</b> NOMBRE DE USUARIO DE LA RED SOCIAL:</label>
            <input style="width: 300px;" class="form-control" type="text" id="rs_user_tutor" name="rs_user_tutor" 
            
            data-parsley-maxlength="20"
            data-parsley-maxlength-message="No debe exceder los 20 caracteres" 
            data-parsley-trigger="keyup" /> 
</div>

<!-- Datos del segundo tutor -->

<h2>DATOS DEL SEGUNDO TUTOR</h2>

<div class="form-group">
  <label for="curp_tutor2"><b style="color: red;">*</b> CURP:</label>
  <input style="width: 250px;" class="form-control" type="text" id="curp_tutor2" name="curp_tutor2" 
    />
</div>


<div class="form-group">
  <label for="nombre_tutor2"><b style="color: red;">*</b> NOMBRE(S):</label>
  <input style="width: 300px;" class="form-control" type="text" id="nombre_tutor2" name="nombre_tutor2" value="<?= old('nombre_tutor2') ?>" />
</div>


<div class="form-group">
  <label for="primer_apellido_tutor2"><b style="color: red;">*</b> PRIMER APELLIDO:</label>
  <input style="width: 300px;" class="form-control" type="text" id="primer_apellido_tutor2" name="primer_apellido_tutor2" value="<?= old('primer_apellido_tutor2') ?>" />
</div>


<div class="form-group">
  <label for="segundo_apellido_tutor2"><b style="color: red;">*</b> SEGUNDO APELLIDO:</label>
  <input style="width: 300px;" class="form-control" type="text" id="segundo_apellido_tutor2" name="segundo_apellido_tutor2" value="<?= old('segundo_apellido_tutor2') ?>" />
</div>


<div class="form-group">
    <label for="ocupacion_tutor2"><b style="color: red;">*</b> OCUPACIÓN:</label>
    <input style="width: 400px;" class="form-control" type="text" id="ocupacion_tutor2" name="ocupacion_tutor2" 
    
    data-parsley-maxlength="30"
    data-parsley-maxlength-message="No debe exceder los 30 caracteres" 
    data-parsley-trigger="keyup" />
  </div>


<div class="form-group">
    <label for="estudios_tutor2"><b style="color: red;">*</b> GRADO MÁXIMO DE ESTUDIOS:</label>
        <select style="width: 300px;" class="form-control" id="estudios_tutor2" name="estudios_tutor2" >
              <option></option>
              <option>NINGUNO</option>
              <option>PRIMARIA</option>
              <option>SECUNDARIA</option>
              <option>PREPARATORIA</option>
              <option>BACHILLERATO TECNICO</option>
              <option>LICENCIATURA</option>
              <option>MAESTRIA</option>
              <option>DOCTORADO</option>
        </select>
 </div>


 <div class="form-group">
      <label for="parentesco_tutor2"><b style="color: red;">*</b> PARENTESCO:</label>
          <select style="width: 200px;" class="form-control" id="parentesco_tutor2" name="parentesco_tutor2" >
                <option></option>
                <option>MADRE</option>
                <option>PADRE</option>
                <option>ABUELO</option>
                <option>ABUELA</option>
                <option>TIO</option>
                <option>TIA</option>
                <option>HERMANO</option>
                <option>HERMANA</option>
                <option>PRIMO</option>
                <option>PRIMA</option>
                <option>MADRINA</option>
                <option>PADRINO</option>
                <option>CUÑADO</option>
                <option>CUÑADA</option>
                <option>VECINO</option>
                <option>VECINA</option>
                <option>AMIGO</option>
                <option>AMIGA</option>
          </select>
 </div>


<div class="form-group">
    <label for="salario_tutor2"><b style="color: red;">*</b> INGRESO MENSUAL:</label>
        <select style="width: 300px;" class="form-control" id="salario_tutor2" name="salario_tutor2" >
            <option></option>
            <option>NINGUNO</option>
            <option>MENOS DE UN SALARIO MÍNIMO</option>
            <option>DE 1 A 2 SALARIOS MÍNIMOS</option>
            <option>DE 2 A 3 SALARIOS MÍNIMOS</option>
            <option>DE 3 A 5 SALARIOS MÍNIMOS</option>
            <option>MÁS DE 5 SALARIOS MÍNIMOS</option>
        </select>
</div>

<div class="form-group">
    <label for="estado_civil_tutor2"><b style="color: red;">*</b> ESTADO CIVIL:</label>
        <select style="width: 300px;" class="form-control" id="estado_civil_tutor2" name="estado_civil_tutor2" >
            <option></option>
            <option>CASADO</option>
            <option>CASADA</option>
            <option>DIVORCIADO</option>
            <option>DIVORCIADA</option>
            <option>SOLTERO</option>
            <option>SOLTERA</option>
            <option>UNION LIBRE</option>
            <option>VIUDO</option>
            <option>VIUDA</option>
              
        </select>
</div>


<div class="form-group">
    <label for="email_tutor2"><b style="color: red;">*</b> CORREO ELECTRÓNICO:</label>
        <input class="form-control" type="text" id="email_tutor2" name="email_tutor2" style="text-transform: lowercase; width: 300px;"
            
           data-parsley-type="email" />
</div>

<div class="form-group">
    <label for="responsabilidad"><b style="color: red;">*</b> RESPONSABILIDAD DEL MENOR:</label>
        <select class="form-control" id="responsabilidad" name="responsabilidad" style="width: 100px;" >
              <option value="SI" selected="selected">SI</option>
              <option value="SI">SI</option>
              <option value="NO">NO</option>
        </select>
</div>

<div class="form-group">
    <label for="recoge"><b style="color: red;">*</b> ¿RECOGE AL MENOR?</label>
        <select class="form-control" id="recoge" name="recoge" style="width: 100px;" >
              <option value="SI" selected="selected">SI</option>
              <option value="SI">SI</option>
              <option value="NO">NO</option>
        </select>
</div>


<!-- ================ Datos de salud (Historial Médico) ================== -->

<h2>DATOS DE SALUD DEL ALUMNO</h2>

<div class="form-group">
    <label for="estatura"><b style="color: red;">*</b> ESTATURA EN CENTÍMETROS:</label>
    <input class="form-control" type="number" id="estatura" name="estatura" style="width: 100px;" 
  />
</div>



<div class="form-group">
    <label for="peso"><b style="color: red;">*</b> PESO EN KILOGRAMOS:</label>
    <input class="form-control" type="number" id="peso" name="peso" style="width: 100px;" 
   />
</div>


 <div class="form-group">
     <label for="tipo_sangre">TIPO DE SANGRE:</label>
         <select style="width: 200px;" class="form-control" id="tipo_sangre" name="tipo_sangre">
            <option value="NR" selected="selected">NO REPORTADO</option>
            <option value="O-">O-</option>
            <option value="O+">O+</option>
            <option value="A-">A-</option>
            <option value="A+">A+</option>
            <option value="B-">B-</option>
            <option value="B+">B+</option>
            <option value="AB-">AB-</option>
            <option value="AB+">AB+</option>
                                        
       </select>
 </div>


 <div class="form-group">
    <label for="talla_zapato"><b style="color: red;">*</b> TALLA DE ZAPATO EN CENTÍMETROS: </label>
    <input style="width: 100px;" class="form-control" type="number" min="10" max="30" step="1" 
    id="talla_zapato" name="talla_zapato"  />
</div>
<br />

    <label for="zapato_orto">¿USA ZAPATO ORTOPÉDICO?&nbsp;&nbsp;</label>
 <div class="form-check-inline">
     <label class="form-check-label">
        <input type="radio" id="zapato_orto" name="zapato_orto" class="form-check-input" value="NO"  checked="checked"> NO
     </label>
 </div>
 
 <div class="form-check-inline">
     <label class="form-check-label">
        <input type="radio" id="zapato_orto" name="zapato_orto" class="form-check-input" value="SI" > SI
     </label>
 </div>

<br />
   <label for="lentes">¿USA LENTES?&nbsp;&nbsp;</label>
<div class="form-check-inline">
        <label class="form-check-label">
          <input type="radio" id="lentes" class="form-check-input" value="NO" name="lentes" checked="checked"> NO
        </label>
      </div>
      <div class="form-check-inline">
        <label class="form-check-label">
          <input type="radio" id="lentes" class="form-check-input" value="SI" name="lentes"> SI
        </label>
</div>


<div class="form-group">
     <label for="vacunas">VACUNAS:</label>
      <select class="form-control" id="vacunas" name="vacunas" >
        <option value="" selected="selected">SELECCIONAR</option>
        <option value="COMPLETAS HASTA LOS 3 AÑOS">COMPLETAS HASTA LOS 3 AÑOS</option>
        <option value="COMPLETAS HASTA LOS 6 AÑOS">COMPLETAS HASTA LOS 6 AÑOS</option>
        <option value="COMPLETAS HASTA LOS 11 AÑOS O 5° DE PRIMARIA">COMPLETAS HASTA LOS 11 AÑOS O 5° DE PRIMARIA</option>
        <option value="VACUNAS INCOMPLETAS">VACUNAS INCOMPLETAS</option>
      </select>
</div>

<div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input apoyo" name="apoyo_1" value="SI">DISPOSITIVOS DE AYUDA VISUAL
        </label>
</div>
<div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input apoyo" name="apoyo_2" value="SI">AUDÍFONOS
        </label>
</div>
<div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input apoyo" name="apoyo_3" value="SI">AYUDA PARA LA MOVILIDAD
        </label>
</div>
<div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input apoyo" name="apoyo_4" value="SI">PRÓTESIS
        </label>
</div>
<div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input apoyo" name="apoyo_5" value="SI">SILLA DE RUEDAS
        </label>
</div>


<div class="form-group">
  <label for="otro_apoyo">OTRO APOYO:</label>
  <input class="form-control" type="text" id="otro_apoyo" name="otro_apoyo" placeholder="OPCIONAL" 
    />
</div>


<div class="form-group">
  <label for="otro_apoyo">DISCAPACIDAD:</label>
  <input class="form-control" type="text" id="discapacidad" name="discapacidad" value="NINGUNA" 
    />
</div>


<div class="form-group">
        <label for="covid">¿HA PADECIDO COVID?</label>
           <select style="width: 200px;" class="form-control" id="covid" name="covid" >
                <option value="NO" selected="selected">NO</option>
                <option value="SI">SI</option>                                   
           </select>
</div>

 <div class="form-group">
     <label for="covid_dosis">¿HA RECIBIDO VACUNA CONTRA COVID-19?</label>
         <select style="width: 200px;" class="form-control" id="covid_dosis" name="covid_dosis">
            <option value="NINGUNA" selected="selected">NINGUNA</option>
            <option value="PRIMERA DOSIS">PRIMERA DOSIS</option>
            <option value="SEGUNDA DOSIS">SEGUNDA DOSIS</option>
            <option value="TERCERA DOSIS">TERCERA DOSIS</option>
       </select>
 </div>


<div class="form-group">
    <label for="ultimas_enfermedades">ESCRIBA LOS NOMBRES DE LAS ENFERMEDADES QUE SU HIJO(A) HA PADECIDO DURANTE LOS ÚLTIMOS 12 MESES: (Sea breve, máximo 150 caracteres)</label>
       <textarea id="ultimas_enfermedades" name="ultimas_enfermedades" rows="4" cols="40" 
        data-parsley-maxlength="150"
        data-parsley-maxlength-message="No debe exceder los 150 caracteres" 
        data-parsley-trigger="keyup">NINGUNA</textarea>
</div>


<div class="form-group">
        <label for="enfermedades_frecuentes">ENFERMEDADES QUE PADECE CON MAYOR FRECUENCIA: (Sea breve, máximo 150 caracteres)</label>
        <textarea id="enfermedades_frecuentes" name="enfermedades_frecuentes" rows="4" cols="40" 
        data-parsley-maxlength="150"
        data-parsley-maxlength-message="No debe exceder los 150 caracteres" 
        data-parsley-trigger="keyup">NINGUNA</textarea>
</div>


<div class="form-group">
  <label for="nombre_medico"><b style="color: red;"></b> NOMBRE DEL MEDICO FAMILIAR:</label>
  <input class="form-control" type="text" id="nombre_medico" name="nombre_medico" placeholder="OPCIONAL" data-parsley-maxlength="50"
        data-parsley-maxlength-message="No debe exceder los 50 caracteres" 
        data-parsley-trigger="keyup" />
</div>


<div class="form-group">
    <label for="tel_medico"><b style="color: red;"></b> NÚM. DE TELÉFONO DEL MEDICO FAMILIAR (10 DÍGITOS):</label>
    <input style="width: 150px;" class="form-control" type="tel" id="tel_medico" name="tel_medico" placeholder="OPCIONAL" 
    />
</div>


<div class="form-group">
    <label for="institucion_dh">INSTITUCIÓN DE DERECHOHABIENCIA DEL ALUMNO(A):</label>
        <select style="width: 200px;" class="form-control" id="institucion_dh" name="institucion_dh"  >
            <option value="" selected="selected">SELECCIONAR</option>
            <option value="ISSEMYM">ISSEMYM</option>
            <option value="ISSSTE">ISSSTE</option>
            <option value="IMSS">IMSS</option>
            <option value="SEGURO POPULAR">SEGURO POPULAR</option>
            <option value="OTRO">OTRO</option>
                                                          
        </select>
</div>

<div class="form-group">
        <label for="recomendaciones">RECOMENDACIONES ESPECIALES: (Sea breve, máximo 200 caracteres)</label>
        <textarea id="recomendaciones" name="recomendaciones" rows="4" cols="40" 
        data-parsley-maxlength="200"
        data-parsley-maxlength-message="No debe exceder los 200 caracteres" 
        data-parsley-trigger="keyup">NINGUNA</textarea>
</div>


<!--Comienza la sección de padecimientos -->

<div id="padecimientos">
        <h2>¿SU HIJO PADECE ALGUNA DE LAS SIGUIENTES ENFERMEDADES?</h2>
    <br />

<label for="padecimientos"><strong>SELECCIONE EN CASO AFIRMATIVO:</strong>&nbsp;&nbsp;</label>
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="sobrepeso" value="SI">SOBREPESO U OBESIDAD
        </label>
      </div>

      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="corazon" value="SI">ENFERMEDAD DEL CORAZÓN
        </label>
      </div>


      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="bronquitis" value="SI">BRONQUITIS
        </label>
      </div>


      <div class="form-check">
        <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="hemorragias" value="SI">HEMORRAGIAS
        </label>
      </div>


      <div class="form-check">
        <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="epilepsia" value="SI">EPILEPSIA (ATAQUES, CONVULSIONES)
        </label>
      </div>


      <div class="form-check">
        <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="fiebre_reumatica" value="SI">FIEBRE REUMÁTICA
        </label>
      </div>


      <div class="form-check">
        <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="cancer" value="SI">CANCER
        </label>
      </div>


      <div class="form-check">
        <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="diabetes" value="SI">DIABETES
        </label>
      </div>


      <div class="form-check">
        <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="amigdalitis" value="SI">AMIGDALITIS
        </label>
      </div>


      <div class="form-check">
        <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="anemia" value="SI">ANEMIA
        </label>
      </div>


      <div class="form-check">
        <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="hepatitis" value="SI">HEPATITIS
        </label>
      </div>

      <div class="form-check">
        <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="neoplasias" value="SI">NEOPLASIAS
        </label>
      </div>

<br />


<div class="form-group">
        <label for="enfermedad_cronica"><b style="color: red;"></b> ¿OTRAS ENFERMEDADES CRONICAS? ESPECIFIQUE: (Sea breve, máximo 200 caracteres)</label>
        <textarea id="enfermedad_cronica" name="enfermedad_cronica" rows="4" cols="40" 
        data-parsley-maxlength="200"
        data-parsley-maxlength-message="No debe exceder los 200 caracteres" 
        data-parsley-trigger="keyup">NINGUNA</textarea>
</div>

</div><!--Termina la sección de padecimientos -->


<!--Comienza la sección de detecciones -->
<div id="detecciones">
        <h2>HA DETECTADO QUE EL(LA) NIÑO(A)</h2>
    <br />

    <label for="vacunas"><strong>SELECCIONE EN CASO AFIRMATIVO:</strong>&nbsp;&nbsp;</label>
      
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="dificultad_dormir" value="SI">¿TIENE DIFICULTAD PARA DORMIR BIEN DURANTE LA NOCHE?
        </label>
      </div>

      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="fiebre_frecuente" value="SI">¿LE DA FIEBRE CON FRECUENCIA?
        </label>
      </div>

      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="falta_aire" value="SI">¿LE FALTA AIRE DESPUÉS DE HACER EJERCICIO?
        </label>
      </div>


      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="dolor_piernas" value="SI">¿LE DUELEN LAS PIERNAS POR LA NOCHE?
        </label>
      </div>
    

    <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="desmayos_frecuentes" value="SI">¿SE DESMAYA CON FRECUENCIA?
        </label>
      </div>

      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="transfusion" value="SI">¿HA RECIBIDO ALGUNA VEZ TRANSFUSIÓN SANGUINEA?
        </label>
      </div>

      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="impedimento" value="SI">¿TIENE IMPEDIMENTO PARA REALIZAR ACTIVIDADES DEPORTIVAS?
        </label>
      </div>

<br />
<br />

      <div class="form-group">
  <label for="alergia_medicamento"><b style="color: red;">*</b> ¿ES ALÉRGICO A ALGÚN MEDICAMENTO? ESPECIFIQUE:</label>
  <input class="form-control" type="text" id="alergia_medicamento" name="alergia_medicamento" value="NO" 
   />
    </div>


 <div class="form-group">
  <label for="alergia_alimento"><b style="color: red;">*</b> ¿ES ALÉRGICO A ALGÚN ALIMENTO O BEBIDA? ESPECIFIQUE:</label>
  <input class="form-control" type="text" id="alergia_alimento" name="alergia_alimento" value="NO" 
 />
 </div>


<div class="form-group">
  <label for="hemorragias_frecuentes"><b style="color: red;">*</b> ¿PRESENTA HEMORRAGIAS FRECUENTES? ESPECIFIQUE:</label>
  <input class="form-control" type="text" id="hemorragias_frecuentes" name="hemorragias_frecuentes" value="NO" 
 />
</div>


<div class="form-group">
  <label for="antecedente_medico"><b style="color: red;">*</b> ¿CUENTA CON ALGÚN ANTECEDENTE MÉDICO QUE LE PROHIBA A SU HIJO(A) REALIZAR ACTIVIDAD FÍSICA? ESPECIFIQUE:</label>
  <input class="form-control" type="text" id="antecedente_medico" name="antecedente_medico" value="NO" 
 />
</div>



<div class="form-group">
  <label for="intervencion_quirurgica"><b style="color: red;">*</b> ¿HA SIDO INTERVENIDO QUIRÚRGICAMENTE? ESPECIFIQUE:</label>
  <input class="form-control" type="text" id="intervencion_quirurgica" name="intervencion_quirurgica" value="NO" 
 />
</div>
    
</div><!--Termina sección de detecciones -->


<!--Comienza antecedentes hereditarios del alumno -->
  <div id="antecedentes_hereditarios">
        <h2>ANTECEDENTES HEREDITARIOS DEL ALUMNO(A)</h2>
    <br />

    <div class="form-group">
  <label for="familiar_diabetes"><b style="color: red;">*</b> ¿TIENE ALGÚN FAMILIAR DIABÉTICO? ESPECIFIQUE PARENTESCO:</label>
  <input style="width: 300px;" class="form-control" type="text" id="familiar_diabetes" name="familiar_diabetes" value="NO" 
 />
</div>


     <div class="form-group">
  <label for="familiar_corazon"><b style="color: red;">*</b> ¿TIENE ALGÚN FAMILIAR ENFERMO DEL CORAZÓN? ESPECIFIQUE PARENTESCO:</label>
  <input style="width: 300px;" class="form-control" type="text" id="familiar_corazon" name="familiar_corazon" value="NO" 
 />
    </div>


    <div class="form-group">
  <label for="familiar_hipertension"><b style="color: red;">*</b> ¿TIENE ALGÚN FAMILIAR HIPERTENSO? ESPECIFIQUE PARENTESCO:</label>
  <input style="width: 300px;" class="form-control" type="text" id="familiar_hipertension" name="familiar_hipertension" value="NO" 
 />
    </div>


     <div class="form-group">
  <label for="famliar_cancer"><b style="color: red;">*</b> ¿TIENE ALGÚN FAMILIAR ENFERMO DE CANCER? ESPECIFIQUE PARENTESCO:</label>
  <input style="width: 300px;" class="form-control" type="text" id="familiar_cancer" name="familiar_cancer" value="NO" 
 />
    </div>

</div><!--Termina antecedentes hereditarios del alumno -->



<br />
<input type="submit" value="Enviar" />

    </form>
<br />
    <a href="../" >Regresar</a>






<script>
// Código para mostrar las localidades según el municipio seleccionado

    document.getElementById('municipio_dom').addEventListener('change', function() {
    const nombreMunicipio = this.value;
    const selectLocalidad = document.getElementById('localidad_dom');

    // Limpiar el select de localidades
    selectLocalidad.innerHTML = '<option value="">-- Selecciona una localidad --</option>';
    
    if (nombreMunicipio === '') {
        selectLocalidad.disabled = true;
        return;
    }

    // Hacer la petición al endpoint de CodeIgniter 4
    // Asegúrate de ajustar la URL base según tu proyecto (ej: http://localhost:8080/)
    fetch(`/api/localidades/${nombreMunicipio}`)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                // Habilitar el select y rellenar con las localidades devueltas
                selectLocalidad.disabled = false;
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.localidad; // O item.id si prefieres guardar el ID entero
                    option.textContent = item.localidad;
                    selectLocalidad.appendChild(option);
                });
            } else {
                selectLocalidad.disabled = true;
                selectLocalidad.innerHTML = '<option value="">No se encontraron localidades</option>';
            }
        })
        .catch(error => {
            console.error('Error al cargar las localidades:', error);
        });
});

</script>

<?= $this->endSection() ?>