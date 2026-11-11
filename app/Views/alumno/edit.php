<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('contenido') ?>

<?= view('partials/_form-error'); ?>


<div class="flex min-h-screen items-center justify-center bg-base-200 p-4">
  
  <div class="card w-full max-w-2xl bg-base-100 shadow-xl border border-base-300">
    <div class="card-body">

<form class="space-y-6" action="update/<?= $alumno->id_alumno ?>" method="post" data-parsley-validate>

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


<!-- Se envían los datos de movimiento inicial y fecha de alta en su caso (ocultos) --> 
  <input type='hidden' name='grupo' value="<?php echo "A";  ?>" />
  <input type='hidden' name='mov_i' value="<?php echo "I" ?>" />
  <input type='hidden' name='fecha_alta' value="<?php  ?>" />
  <input type='hidden' name='reprobado' value="NO" />
  <input type='hidden' name='origen' value="<?php echo "ME" ?>" />


<!-- ========= Datos de nacimiento  ================== -->
   
  <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-md border p-4">
    <legend class="fieldset-legend" style="color: darkolivegreen;">DATOS DE NACIMIENTO DEL ALUMNO</legend>

   
<div class="form-control" style="margin-bottom: 10px;">
   <label class="label" for="curp_alumno">CURP DEL ALUMNO (SOLO LECTURA)</label><br />
    <input class="input input-neutral" type="text" id="curp_alumno" name="curp_alumno" readonly value="AEAA190507MMCRRTA9" />
</div>

<div role="alert" class="alert alert-success">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>Por favor, capture el nombre y apellidos del alumno en los campos correspondientes, respetando el orden y la escritura que aparecen en su acta de nacimiento.</span>
</div>
<br/>

  <div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="nombre_alumno">NOMBRE(S) DEL ALUMNO</label><br />
       <input class="input input-accent" type="text" id="nombre_alumno" name="nombre_alumno" value="<?= $alumno->nombre_alumno ?>" 
       required 
       data-parsley-required-message="Ingrese el nombre o nombres del alumno." 
            data-parsley-maxlength="25"
            data-parsley-maxlength-message="No debe ser mayor a 25 caracteres"
            data-parsley-trigger="keyup" />
</div>


    <div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="primer_apellido_alumno">PRIMER APELLIDO DEL ALUMNO:</label><br />
        <input class="input input-accent" type="text" id="primer_apellido_alumno" name="primer_apellido_alumno" value="<?= $alumno->primer_apellido_alumno ?>" 
        required 
       data-parsley-required-message="Ingrese el primer apellido del alumno." 
            data-parsley-maxlength="25"
            data-parsley-maxlength-message="No debe ser mayor a 25 caracteres"
            data-parsley-trigger="keyup" />
    </div>


    <div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="segundo_apellido_alumno">SEGUNDO APELLIDO DEL ALUMNO:</label><br />
        <input class="input input-accent" type="text" id="segundo_apellido_alumno" name="segundo_apellido_alumno" value="<?= $alumno->segundo_apellido_alumno ?>" 
       required 
       data-parsley-required-message="Ingrese el segundo apellido del alumno." 
            data-parsley-maxlength="25"
            data-parsley-maxlength-message="No debe ser mayor a 25 caracteres"
            data-parsley-trigger="keyup" />
    </div>

    

    <div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="nacionalidad_alumno">NACIONALIDAD:</label><br />
        <input class="input input-accent" type="text" id="nacionalidad_alumno" name="nacionalidad_alumno" size="10" placeholder="MEXICANA" value="<?= $alumno->nacionalidad_alumno ?>" 
        required 
        data-parsley-required-message="Este campo es requerido, el valor predeterminado es MEXICANA." 
        data-parsley-maxlength="20"
        data-parsley-maxlength-message="No debe ser mayor a 20 caracteres"
        data-parsley-trigger="keyup" />
    </div>

    </fieldset>   


<!-- ========= Domicilio del alumno  ================== -->
<fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-md border p-4">
    <legend class="fieldset-legend" style="color: darkolivegreen ;">DATOS DEL DOMICILIO DEL ALUMNO</legend>

<div class="form-control" style="margin-bottom: 10px;">
    <label for="entidad_dom">ESTADO: (SOLO LECTURA)</label><br />
      <input class="input input-neutral" type="text" id="entidad_dom" name="entidad_dom" value="MEXICO" readonly="readonly" />
</div>

        <div class="form-control" style="margin-bottom: 10px;">
      <label class="label" for="municipio_dom"><b style="color: red;">*</b> MUNICIPIO:</label><br />
          <select class="select select-secondary" id="municipio_dom" name="municipio_dom" required>
                <option value="<?= $alumno->municipio_dom ?>"><?= $alumno->municipio_dom ?></option>
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
   
    
  <div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="localidad_dom"><b style="color: red;">*</b> LOCALIDAD:</label><br />
            <select class="select select-accent" id="localidad_dom" name="localidad_dom" required>
            <option value="<?= $alumno->localidad_dom ?>"><?= $alumno->localidad_dom ?></option>
            </select>
   </div> 

   

   <div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="colonia_dom"><b style="color: red;">*</b>COLONIA:</label><br />
            <input class="input input-accent" type="text" class="form-control" id="colonia_dom" name="colonia_dom" placeholder="" value="<?= $alumno->colonia_dom ?>"
            required
            data-parsley-required-message="Por favor, ingrese el nombre de su colonia." 
            data-parsley-maxlength="50"
            data-parsley-maxlength-message="No debe ser mayor a 50 caracteres"
            data-parsley-trigger="keyup" />
            
    </div>   

     <div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="calle_num_dom"><b style="color: red;">*</b> CALLE y NÚMERO:</label><br />
        <input class=" input input-accent" type="text" id="calle_num_dom" name="calle_num_dom" value="<?= $alumno->calle_num_dom ?>"
        required
        data-parsley-required-message="Por favor, ingrese el nombre de la calle y el número" 
        data-parsley-maxlength="60"
        data-parsley-maxlength-message="No debe exceder los 60 caracteres"
        data-parsley-trigger="keyup" />
    </div>


    <div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="entre_calle_1"><b style="color: red;">*</b> ENTRE CALLE:</label><br/>
        <input class="input input-accent type="text" id="entre_calle_1" name="entre_calle_1" value="<?= $alumno->entre_calle_1 ?>"
        required
        data-parsley-maxlength="40"
        data-parsley-maxlength-message="No debe exceder los 40 caracteres"
        data-parsley-trigger="keyup" />
    </div>

    <div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="entre_calle_2"><b style="color: red;">*</b> Y CALLE:</label><br/>
        <input class="input input-accent" type="text" id="entre_calle_2" name="entre_calle_2" value="<?= $alumno->entre_calle_2 ?>"
        required
        data-parsley-maxlength="40"
        data-parsley-maxlength-message="No debe exceder los 40 caracteres"
        data-parsley-trigger="keyup" />
    </div>

     <div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="cp"><b style="color: red;">*</b> CÓDIGO POSTAL:</label><br/>
            <input class="input input-accent" type="text" style="width: 200px;" class="form-control" id="cp" name="cp" value="<?= $alumno->cp ?>" 
            required 
            pattern="/^[0-9]{5}$/"
            data-parsley-pattern-message="Formato de código postal inválido." 
            data-parsley-trigger="keyup" />     
    </div>      

    <div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="referencia_dom"><b style="color: red;">*</b> REFERENCIA DOMICILIARIA (BREVE):</label><br/>
        <input class="input input-accent" type="text" id="referencia_dom" name="referencia_dom" value="<?= $alumno->referencia_dom ?>"
        required
        data-parsley-required-message="Por favor, ingrese una referencia domiciliaria muy breve." 
        data-parsley-maxlength="50"
        data-parsley-maxlength-message="No debe exceder los 50 caracteres"
        data-parsley-trigger="keyup" />
    </div>

</fieldset>
<!-- Termina datos del domicilio del alumno -->



<!--Comienza datos de contacto del alumno -->
<fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-md border p-4">
    <legend class="fieldset-legend" style="color: darkolivegreen;">DATOS DE CONTACTO DEL ALUMNO</legend>

<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="telefono_1"><b style="color: red;">*</b> NÚM. DE TELÉFONO (10 DÍGITOS):</label><br/>
    <input class="input input-accent" type="tel" id="telefono_1" name="telefono_1" style="width: 200px;" value="<?= $alumno->telefono_1 ?>"
    required 
    pattern="/^\d{10}$/"
    data-parsley-pattern-message="Debe ser un número de 10 dígitos." 
    data-parsley-trigger="keyup" />   
</div>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="telefono_2"><b style="color: red;">*</b> NÚM. DE TELÉFONO 2 (10 DÍGITOS):</label><br/>
    <input class="input input-accent" type="tel" id="telefono_2" name="telefono_2" style="width: 200px;" value="<?= $alumno->telefono_2 ?>"
    required
     pattern="/^\d{10}$/"
    data-parsley-pattern-message="Debe ser un número de 10 dígitos." 
    data-parsley-notequalto="#telefono_1" 
    data-parsley-notequalto-message="Este número ya existe en un campo anterior." 
    data-parsley-trigger="keyup" />
</div>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="telefono_emer">NÚM. DE TELÉFONO EMERGENCIAS (10 DÍGITOS):</label><br/>
    <input class="input input-accent" type="tel" id="telefono_emer" name="telefono_emer" style="width: 200px;" value="<?= $alumno->telefono_emer ?>"
    required
    pattern="/^\d{10}$/"
    data-parsley-pattern-message="Debe ser un número de 10 dígitos." 
    data-parsley-notequalto="#telefono_2" 
    data-parsley-notequalto-message="Este número ya existe en un campo anterior." 
    data-parsley-trigger="keyup"  />
</div>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="email_alumno"><b style="color: red;">*</b> CORREO ELECTRÓNICO:</label><br/>
    <input class="input input-accent" type="text" id="email_alumno" name="email_alumno" style="text-transform: lowercase; width: 300px;" value="<?= $alumno->email_alumno ?>"
    required    
    data-parsley-type="email"
    data-parsley-maxlength-message="Dirección de correo inválida."  
    data-parsley-trigger="keyup" />
</div>



<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="rs_alumno"><b style="color: red;">*</b> RED SOCIAL:</label><br/>
        <select class="select select-accent" style="width: 200px;" class="form-control" id="rs_alumno" name="rs_alumno" required>
              <option value="<?= $alumno->rs_alumno ?>"><?= $alumno->rs_alumno ?></option>
              <option>FACEBOOK</option>
              <option>INSTAGRAM</option>
              <option>X</option>
        </select>
  </div>

  <div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="rs_user_alumno"><b style="color: red;">*</b> NOMBRE DE USUARIO DE LA RED SOCIAL:</label><br/>
        <input style="width: 300px;" class="input input-accent" type="text" id="rs_user_alumno" name="rs_user_alumno" value="<?= $alumno->rs_user_alumno ?>"
        required
        data-parsley-maxlength="20"
        data-parsley-maxlength-message="No debe exceder los 20 caracteres" 
        data-parsley-trigger="keyup" />
    </div>

  </fieldset>
<!--Termina datos de contacto del alumno -->



    <!--Comienza datos complementarios del alumno -->
<fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-md border p-4">
    <legend class="fieldset-legend" style="color: darkolivegreen;">DATOS COMPLEMENTARIOS</legend>

    <div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="num_personas">¿CUÁNTAS PERSONAS VIVEN EN SU CASA?</label><br/>
        <input style="width: 100px;" class="input input-accent" type="number" min="1" id="num_personas" 
        name="num_personas" 
        required
        data-parsley-type="number" 
        data-parsley-number-message="Debe ser un número." />
    </div>



    <div class="form-control" style="margin-bottom: 10px;">
      <label clas="label" for="vive_con"><b style="color: red;">*</b>¿CON QUIÉN VIVE?</label><br/>
          <select style="width: 150px;" class="select select-primary" id="vive_con" name="vive_con" required >
                <option disabled selected>SELECCIONAR</option>
                <option>MAMA</option>
                <option>PAPA</option>
                <option>AMBOS</option>
          </select>
    </div>


    <div class="form-control" style="margin-bottom: 10px;">
      <label class="label" for="sosten_econ"><b style="color: red;">*</b> ¿QUIÉN SOSTIENE ECONÓMICAMENTE LA CASA?</label><br/>
          <select style="width: 150px;" class="select select-secondary" id="sosten_econ" name="sosten_econ" required>
                <option disabled selected>SELECCIONAR</option>
                <option>MAMA</option>
                <option>PAPA</option>
                <option>AMBOS</option>
          </select>
    </div>



     <div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="nombre_escuela_procedencia">NOMBRE DE LA ESCUELA DE PROCEDENCIA:</label><br/>
        <input class="input input-accent" type="text" id="nombre_escuela_procedencia" name="nombre_escuela_procedencia" value=""
        required
        data-parsley-maxlength="40"
        data-parsley-maxlength-message="No debe exceder los 40 caracteres" 
        data-parsley-trigger="keyup" />
    </div>



    <div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="anios_prescolar">AÑOS CURSADOS EN PREESCOLAR: </label><br/>
            <select class="select select-info" id="anios_prescolar" name="anios_prescolar" style="width: 100px;">
                  <option value="3" selected="selected">3</option>
                  <option value="2">2</option>
                  <option value="1">1</option>
                  <option value="0">0</option>
            </select>
      </div>



<br/>
  <h2>RECURSOS TECNOLÓGICOS CON LOS QUE CUENTA EL ALUMNO:</h2>
  
  <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-primary" name="computadora" value="SI"> COMPUTADORA DE ESCRITORIO O PORTATIL
        </label>
    </div>

    <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-primary" name="tablet" value="SI"> TABLET
        </label>
    </div>

    
    <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-primary" name="internet_casa" value="SI"> INTERNET EN CASA
        </label>
    </div>

    <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-primary" name="internet_movil" value="SI"> INTERNET EN CELULAR
        </label>
    </div>

    <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-primary" name="tv_paga" value="SI"> TELEVISIÓN DE PAGA
        </label>
    </div>


    <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-primary" name="tv_abierta" value="SI"> TELEVISIÓN ABIERTA
        </label>
    </div>


    <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-primary" name="radio" value="SI"> RADIO
        </label>
    </div>

</fieldset>

<br />


<!-- Comienza datos del tutor -->

<fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-md border p-4">
    <legend class="fieldset-legend" style="color: darkolivegreen;">DATOS DEL TUTOR</legend>

<div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="curp_tutor"><b style="color: red;">*</b> CURP DEL TUTOR:</label><br/>
  <input class="input input-info" style="width: 250px;" class="form-control" type="text" id="curp_tutor" name="curp_tutor" 
   required 
   pattern="/^[A-Z]{1}[XAEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/i"
   data-parsley-pattern-message="Formato de CURP inválido." 
   data-parsley-notequalto="#curp_alumno" 
   data-parsley-notequalto-message="Esta CURP ya existe en otro campo."
   data-parsley-trigger="keyup" />
</div>

<div role="alert" class="alert alert-success">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>Por favor, capture el nombre y apellidos del tutor en los campos correspondientes, respetando el orden y la escritura que aparecen en su acta de nacimiento.</span>
</div>
<br/>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="nombre_tutor">NOMBRE(S):</label><br/>
        <input class="input input-info" type="text" id="nombre_tutor" name="nombre_tutor" value="<?= $tutor->nombre_tutor ?>" 
        required 
        data-parsley-required-message="Ingrese el nombre o nombres del tutor." 
        data-parsley-maxlength="25"
        data-parsley-maxlength-message="No debe ser mayor a 25 caracteres"
        data-parsley-trigger="keyup" />
</div>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="primer_apellido_tutor">PRIMER APELLIDO:</label><br/>
        <input class="input input-info" type="text" id="primer_apellido_tutor" name="primer_apellido_tutor" value="<?= old('primer_apellido_tutor') ?>" 
        required 
        data-parsley-required-message="Ingrese el primer apellido del tutor." 
        data-parsley-maxlength="25"
        data-parsley-maxlength-message="No debe ser mayor a 25 caracteres"
        data-parsley-trigger="keyup" />
</div>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="segundo_apellido_tutor">SEGUNDO APELLIDO:</label><br/>
        <input class="input input-info" type="text" id="segundo_apellido_tutor" name="segundo_apellido_tutor" value="<?= old('segundo_apellido_tutor') ?>" 
        required 
        data-parsley-required-message="Ingrese el segundo apellido del tutor." 
        data-parsley-maxlength="25"
        data-parsley-maxlength-message="No debe ser mayor a 25 caracteres"
        data-parsley-trigger="keyup" />
</div>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="nacionalidad_tutor">NACIONALIDAD:</label><br/>
    <input class="input input-info" type="text" id="nacionalidad_tutor" name="nacionalidad_tutor" size="10" value="MEXICANA" 
       required 
        data-parsley-required-message="Este campo es requerido, el valor predeterminado es MEXICANA." 
        data-parsley-maxlength="20"
        data-parsley-maxlength-message="No debe ser mayor a 20 caracteres"
        data-parsley-trigger="keyup" />
</div>


  <div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="ocupacion_tutor"><b style="color: red;">*</b> OCUPACIÓN:</label><br/>
    <input style="width: 400px;" class="input input-info" type="text" id="ocupacion_tutor" name="ocupacion_tutor" 
    required
    data-parsley-maxlength="30"
    data-parsley-maxlength-message="No debe exceder los 30 caracteres" 
    data-parsley-trigger="keyup" />
  </div>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="estudios_tutor"><b style="color: red;">*</b> GRADO MÁXIMO DE ESTUDIOS:</label><br/>
        <select class="select select-secondary" style="width: 300px;" id="estudios_tutor" name="estudios_tutor" required >
              <option disabled selected>SELECCIONAR</option>
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


  <div class="form-control" style="margin-bottom: 10px;">
      <label class="label" for="parentesco_tutor"><b style="color: red;">*</b> PARENTESCO:</label><br/>
          <select class="select select-secondary" style="width: 200px;" id="parentesco_tutor" name="parentesco_tutor" required>
                <option disabled selected>SELECCIONAR</option>
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


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="salario_tutor"><b style="color: red;">*</b> INGRESO MENSUAL:</label><br/>
        <select class="select select-secondary" style="width: 300px;" id="salario_tutor" name="salario_tutor" required>
            <option disabled selected>SELECCIONAR</option>
            <option>NINGUNO</option>
            <option>MENOS DE UN SALARIO MÍNIMO</option>
            <option>DE 1 A 2 SALARIOS MÍNIMOS</option>
            <option>DE 2 A 3 SALARIOS MÍNIMOS</option>
            <option>DE 3 A 5 SALARIOS MÍNIMOS</option>
            <option>MÁS DE 5 SALARIOS MÍNIMOS</option>
        </select>
</div>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="estado_civil_tutor"><b style="color: red;">*</b> ESTADO CIVIL:</label><br/>
        <select class="select select-secondary" style="width: 300px;" id="estado_civil_tutor" name="estado_civil_tutor" required >
            <option disabled selected>SELECCIONAR</option>
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


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="email_tutor"><b style="color: red;">*</b> CORREO ELECTRÓNICO:</label><br/>
        <input class="input input-info" type="text" id="email_tutor" name="email_tutor" style="text-transform: lowercase; width: 300px;"
        required    
        data-parsley-type="email"
        data-parsley-maxlength-message="Dirección de correo inválida." 
        data-parsley-trigger="keyup" />
</div>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="rs_tutor"><b style="color: red;">*</b> RED SOCIAL:</label><br/>
        <select class="select select-secondary" style="width: 250px;" id="rs_tutor" name="rs_tutor" required >
            <option disabled selected>SELECCIONAR</option>
            <option>FACEBOOK</option>
            <option>INSTAGRAM</option>
            <option>X</option>
                                        
        </select>
</div>


        
<div class="form-control" style="margin-bottom: 10px;">
     <label class="label" for="rs_user_tutor"><b style="color: red;">*</b> NOMBRE DE USUARIO DE LA RED SOCIAL:</label><br/>
         <input class="input input-info" style="width: 300px;" type="text" id="rs_user_tutor" name="rs_user_tutor" 
            required
            data-parsley-maxlength="20"
            data-parsley-maxlength-message="No debe exceder los 20 caracteres" 
            data-parsley-trigger="keyup" /> 
</div>
</fieldset>


<!-- Datos del segundo tutor -->

<fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-md border p-4">
    <legend class="fieldset-legend" style="color: darkolivegreen;">DATOS DEL SEGUNDO TUTOR</legend>

<div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="curp_tutor2"><b style="color: red;">*</b> CURP:</label><br/>
  <input class="input input-primary" style="width: 250px;" type="text" id="curp_tutor2" name="curp_tutor2" 
   required 
   pattern="/^[A-Z]{1}[XAEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/i"
   data-parsley-pattern-message="Formato de CURP inválido." 
   data-parsley-notequalto="#curp_tutor" 
   data-parsley-notequalto-message="Esta CURP ya existe en otro campo."
   data-parsley-trigger="keyup" />
</div>


<div role="alert" class="alert alert-success">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>Por favor, capture el nombre y apellidos del segundo tutor en los campos correspondientes, respetando el orden y la escritura que aparecen en su acta de nacimiento.</span>
</div>
<br/>


<div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="nombre_tutor2"><b style="color: red;">*</b> NOMBRE(S):</label><br/>
  <input class="input input-primary" style="width: 300px;" type="text" id="nombre_tutor2" name="nombre_tutor2" value="<?= old('nombre_tutor2') ?>" 
  required 
  data-parsley-required-message="Ingrese el nombre o nombres del segundo tutor." 
  data-parsley-maxlength="25"
  data-parsley-maxlength-message="No debe ser mayor a 25 caracteres"
  data-parsley-trigger="keyup" />
</div>


<div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="primer_apellido_tutor2"><b style="color: red;">*</b> PRIMER APELLIDO:</label><br/>
  <input class="input input-primary" style="width: 300px;" type="text" id="primer_apellido_tutor2" name="primer_apellido_tutor2" value="<?= old('primer_apellido_tutor2') ?>" 
  required 
  data-parsley-required-message="Ingrese el primer apellido del segundo tutor." 
  data-parsley-maxlength="25"
  data-parsley-maxlength-message="No debe ser mayor a 25 caracteres"
  data-parsley-trigger="keyup" />
</div>


<div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="segundo_apellido_tutor2"><b style="color: red;">*</b> SEGUNDO APELLIDO:</label><br/>
  <input class="input input-primary" style="width: 300px;" type="text" id="segundo_apellido_tutor2" name="segundo_apellido_tutor2" value="<?= old('segundo_apellido_tutor2') ?>" 
  required 
  data-parsley-required-message="Ingrese el segundo apellido del segundo tutor." 
  data-parsley-maxlength="25"
  data-parsley-maxlength-message="No debe ser mayor a 25 caracteres"
  data-parsley-trigger="keyup" />
</div>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="ocupacion_tutor2"><b style="color: red;">*</b> OCUPACIÓN:</label><br/>
    <input class="input input-primary" style="width: 400px;" type="text" id="ocupacion_tutor2" name="ocupacion_tutor2" 
    required
    data-parsley-maxlength="30"
    data-parsley-maxlength-message="No debe exceder los 30 caracteres" 
    data-parsley-trigger="keyup" />
  </div>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="estudios_tutor2"><b style="color: red;">*</b> GRADO MÁXIMO DE ESTUDIOS:</label><br/>
        <select class="select select-info" style="width: 300px;" id="estudios_tutor2" name="estudios_tutor2" required>
              <option disabled selected>SELECCIONAR</option>
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


 <div class="form-control" style="margin-bottom: 10px;">
      <label class="label" for="parentesco_tutor2"><b style="color: red;">*</b> PARENTESCO:</label><br/>
          <select class="select select-info" style="width: 200px;" id="parentesco_tutor2" name="parentesco_tutor2" required>
                <option disabled selected>SELECCIONAR</option>
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


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="salario_tutor2"><b style="color: red;">*</b> INGRESO MENSUAL:</label><br/>
        <select class="select select-info" style="width: 300px;" id="salario_tutor2" name="salario_tutor2" required>
            <option disabled selected>SELECCIONAR</option>
            <option>NINGUNO</option>
            <option>MENOS DE UN SALARIO MÍNIMO</option>
            <option>DE 1 A 2 SALARIOS MÍNIMOS</option>
            <option>DE 2 A 3 SALARIOS MÍNIMOS</option>
            <option>DE 3 A 5 SALARIOS MÍNIMOS</option>
            <option>MÁS DE 5 SALARIOS MÍNIMOS</option>
        </select>
</div>

<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="estado_civil_tutor2"><b style="color: red;">*</b> ESTADO CIVIL:</label><br/>
        <select class="select select-info" style="width: 300px;" id="estado_civil_tutor2" name="estado_civil_tutor2" required>
            <option disabled selected>SELECCIONAR</option>
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


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="email_tutor2"><b style="color: red;">*</b> CORREO ELECTRÓNICO:</label><br/>
        <input class="input input-primary" type="text" id="email_tutor2" name="email_tutor2" style="text-transform: lowercase; width: 300px;"
        required    
        data-parsley-type="email"
        data-parsley-maxlength-message="Dirección de correo inválida." 
        data-parsley-trigger="keyup" />
</div>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="responsabilidad"><b style="color: red;">*</b> RESPONSABILIDAD DEL MENOR:</label><br/>
        <select class="select select-info" id="responsabilidad" name="responsabilidad" style="width: 100px;" >
              <option value="SI" selected="selected">SI</option>
              <option value="SI">SI</option>
              <option value="NO">NO</option>
        </select>
</div>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="recoge"><b style="color: red;">*</b> ¿RECOGE AL MENOR?</label><br/>
        <select class="select select-info" id="recoge" name="recoge" style="width: 100px;" >
              <option value="SI" selected="selected">SI</option>
              <option value="SI">SI</option>
              <option value="NO">NO</option>
        </select>
</div>

</fieldset>


<!-- ================ Datos de salud (Historial Médico) ================== -->

<fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-md border p-4">
    <legend class="fieldset-legend" style="color: darkolivegreen;">DATOS DE SALUD DEL ALUMNO</legend>

<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="estatura"><b style="color: red;">*</b> ESTATURA EN CENTÍMETROS:</label><br/>
    <input class="input input-secondary" type="number" id="estatura" name="estatura" style="width: 100px;" value="<?= $medico->estatura ?>" 
    required
    data-parsley-range="[100, 165]"
    data-parsley-range-message="El valor debe estar entre 100 y 165."
    data-parsley-trigger="keyup" />
</div>



<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="peso"><b style="color: red;">*</b> PESO EN KILOGRAMOS:</label><br/>
    <input class="input input-secondary" type="number" id="peso" name="peso" style="width: 100px;" 
    required
    data-parsley-range="[15, 65]"
    data-parsley-range-message="El valor debe estar entre 15 y 65."
    data-parsley-trigger="keyup" />
</div>



 <div class="form-control" style="margin-bottom: 10px;">
     <label class="label" for="tipo_sangre">TIPO DE SANGRE:</label><br/>
         <select class="select select-secondary" style="width: 200px;" id="tipo_sangre" name="tipo_sangre">
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


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="talla_zapato"><b style="color: red;">*</b> TALLA DE ZAPATO EN CENTÍMETROS: </label><br/>
    <input style="width: 100px;" class="input input-secondary" type="number" min="18" max="25" step="1" 
    id="talla_zapato" name="talla_zapato" 
    required
    data-parsley-range="[18, 25]"
    data-parsley-range-message="El valor debe estar entre 18 y 25."
    data-parsley-trigger="keyup" />
</div>


    <label class="label" for="zapato_orto">¿USA ZAPATO ORTOPÉDICO?&nbsp;&nbsp;</label>
 <div class="form-check-inline">
     <label class="form-check-label">
        <input type="radio" id="zapato_orto" name="zapato_orto" class="radio radio-secondary" value="NO"  checked="checked"> NO
     </label>
 </div>


 
 <div class="form-check-inline">
     <label class="form-check-label">
        <input type="radio" id="zapato_orto" name="zapato_orto" class="radio radio-secondary" value="SI" > SI
     </label>
 </div>

 <br/>


   <label class="label" for="lentes">¿USA LENTES?&nbsp;&nbsp;</label>
<div class="form-check-inline">
        <label class="form-check-label">
          <input type="radio" id="lentes" class="radio radio-secondary" value="NO" name="lentes" checked="checked"> NO
        </label>
      </div>
      <div class="form-check-inline">
        <label class="form-check-label">
          <input type="radio" id="lentes" class="radio radio-secondary" value="SI" name="lentes"> SI
        </label>
</div>

<br />
<div class="form-control" style="margin-bottom: 10px;">
     <label class="label" for="vacunas">VACUNAS:</label><br/>
      <select class="select select-secondary" id="vacunas" name="vacunas" required>
        <option disabled selected>SELECCIONAR</option>
        <option value="COMPLETAS HASTA LOS 3 AÑOS">COMPLETAS HASTA LOS 3 AÑOS</option>
        <option value="COMPLETAS HASTA LOS 6 AÑOS">COMPLETAS HASTA LOS 6 AÑOS</option>
        <option value="COMPLETAS HASTA LOS 11 AÑOS O 5° DE PRIMARIA">COMPLETAS HASTA LOS 11 AÑOS O 5° DE PRIMARIA</option>
        <option value="VACUNAS INCOMPLETAS">VACUNAS INCOMPLETAS</option>
      </select>
</div>


<div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-success" name="apoyo_1" value="SI">DISPOSITIVOS DE AYUDA VISUAL
        </label>
</div>

<div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-success" name="apoyo_2" value="SI">AUDÍFONOS
        </label>
</div>

<div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-success" name="apoyo_3" value="SI">AYUDA PARA LA MOVILIDAD
        </label>
</div>

<div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-success" name="apoyo_4" value="SI">PRÓTESIS
        </label>
</div>

<div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-success" name="apoyo_5" value="SI">SILLA DE RUEDAS
        </label>
</div>

<br/>
<div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="otro_apoyo">OTRO APOYO:</label><br/>
  <input class="input input-secondary" type="text" id="otro_apoyo" name="otro_apoyo" placeholder="OPCIONAL" value="<?= $medico->otro_apoyo ?? '' ?>" />
</div>


<div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="otro_apoyo">DISCAPACIDAD:</label><br/>
  <input class="input input-secondary" type="text" id="discapacidad" name="discapacidad" value="NINGUNA" required />
</div>


<div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="covid">¿HA PADECIDO COVID?</label><br/>
           <select class="select select-secondary" style="width: 200px;" id="covid" name="covid" >
                <option value="NO" selected="selected">NO</option>
                <option value="SI">SI</option>                                   
           </select>
</div>


<div class="form-control" style="margin-bottom: 10px;">
     <label class="label" for="covid_dosis">¿HA RECIBIDO VACUNA CONTRA COVID-19?</label><br/>
         <select class="select select-secondary" style="width: 200px;" id="covid_dosis" name="covid_dosis">
            <option value="NINGUNA" selected="selected">NINGUNA</option>
            <option value="PRIMERA DOSIS">PRIMERA DOSIS</option>
            <option value="SEGUNDA DOSIS">SEGUNDA DOSIS</option>
            <option value="TERCERA DOSIS">TERCERA DOSIS</option>
       </select>
 </div>
<br/>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="ultimas_enfermedades">ESCRIBA LOS NOMBRES DE LAS ENFERMEDADES QUE SU HIJO(A) HA PADECIDO DURANTE<br/> LOS ÚLTIMOS 12 MESES: (Sea breve, máximo 150 caracteres)</label><br/>
       <textarea class="w-full h-48 max-w-lg p-3 border rounded-md resize-y textarea textarea-success" id="ultimas_enfermedades" name="ultimas_enfermedades"  
       required 
       data-parsley-maxlength="150"
       data-parsley-maxlength-message="No debe exceder los 150 caracteres" 
       data-parsley-trigger="keyup">NINGUNA</textarea>
</div>


<br/>
<div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="enfermedades_frecuentes">ENFERMEDADES QUE PADECE CON MAYOR FRECUENCIA: (Sea breve, máximo 150 caracteres)</label><br/>
        <textarea class="w-full h-48 max-w-lg p-3 border rounded-md resize-y textarea textarea-success" id="enfermedades_frecuentes" name="enfermedades_frecuentes" 
        required
        data-parsley-maxlength="150"
        data-parsley-maxlength-message="No debe exceder los 150 caracteres" 
        data-parsley-trigger="keyup">NINGUNA</textarea>
</div>


<div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="nombre_medico"><b style="color: red;"></b> NOMBRE DEL MEDICO FAMILIAR:</label><br/>
  <input class="input input-secondary" class="form-control" type="text" id="nombre_medico" name="nombre_medico" placeholder="OPCIONAL" data-parsley-maxlength="50"
        data-parsley-maxlength-message="No debe exceder los 50 caracteres" 
        data-parsley-trigger="keyup" />
</div>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="tel_medico"><b style="color: red;"></b> NÚM. DE TELÉFONO DEL MEDICO FAMILIAR (10 DÍGITOS):</label><br/>
    <input class="input input-secondary" style="width: 150px;" type="tel" id="tel_medico" name="tel_medico" placeholder="OPCIONAL" 
    
    pattern="/^\d{10}$/"
    data-parsley-pattern-message="Debe ser un número de 10 dígitos." 
    data-parsley-trigger="keyup" />
</div>


<div class="form-control" style="margin-bottom: 10px;">
    <label class="label" for="institucion_dh">INSTITUCIÓN DE DERECHOHABIENCIA DEL ALUMNO(A):</label><br/>
        <select class="select select-accent" style="width: 200px;" id="institucion_dh" name="institucion_dh" required >
            <option disabled selected>SELECCIONAR</option>
            <option value="ISSEMYM">ISSEMYM</option>
            <option value="ISSSTE">ISSSTE</option>
            <option value="IMSS">IMSS</option>
            <option value="SEGURO POPULAR">SEGURO POPULAR</option>
            <option value="OTRO">OTRO</option>
                                                          
        </select>
</div>


<div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="recomendaciones">RECOMENDACIONES ESPECIALES: (Sea breve, máximo 200 caracteres)</label><br/>
        <textarea class="w-full h-48 max-w-lg p-3 border rounded-md resize-y textarea textarea-success" id="recomendaciones" name="recomendaciones" rows="4" cols="40" 
        data-parsley-maxlength="200"
        data-parsley-maxlength-message="No debe exceder los 200 caracteres" 
        data-parsley-trigger="keyup">NINGUNA</textarea>
</div>


<!--Comienza la sección de padecimientos -->
<br/>
<h2>¿SU HIJO PADECE ALGUNA DE LAS SIGUIENTES ENFERMEDADES?</h2>

<label for="padecimientos"><strong>SELECCIONE EN CASO AFIRMATIVO:</strong>&nbsp;&nbsp;</label>
      <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-secondary" name="sobrepeso" value="SI"> SOBREPESO U OBESIDAD
        </label>
      </div>

      <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-secondary" name="corazon" value="SI"> ENFERMEDAD DEL CORAZÓN
        </label>
      </div>


      <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-secondary" name="bronquitis" value="SI"> BRONQUITIS
        </label>
      </div>


      <div class="form-check">
        <label class="label">
        <input type="checkbox" class="checkbox checkbox-secondary" name="hemorragias" value="SI"> HEMORRAGIAS
        </label>
      </div>


      <div class="form-check">
        <label class="label">
        <input type="checkbox" class="checkbox checkbox-secondary" name="epilepsia" value="SI"> EPILEPSIA (ATAQUES, CONVULSIONES)
        </label>
      </div>


      <div class="form-check">
        <label class="label">
        <input type="checkbox" class="checkbox checkbox-secondary" name="fiebre_reumatica" value="SI"> FIEBRE REUMÁTICA
        </label>
      </div>


      <div class="form-check">
        <label class="label">
        <input type="checkbox" class="checkbox checkbox-secondary" name="cancer" value="SI"> CANCER
        </label>
      </div>


      <div class="form-check">
        <label class="label">
        <input type="checkbox" class="checkbox checkbox-secondary" name="diabetes" value="SI"> DIABETES
        </label>
      </div>


      <div class="form-check">
        <label class="label">
        <input type="checkbox" class="checkbox checkbox-secondary" name="amigdalitis" value="SI"> AMIGDALITIS
        </label>
      </div>


      <div class="form-check">
        <label class="label">
        <input type="checkbox" class="checkbox checkbox-secondary" name="anemia" value="SI"> ANEMIA
        </label>
      </div>


      <div class="form-check">
        <label class="label">
        <input type="checkbox" class="checkbox checkbox-secondary" name="hepatitis" value="SI"> HEPATITIS
        </label>
      </div>

      <div class="form-check">
        <label class="label">
        <input type="checkbox" class="checkbox checkbox-secondary" name="neoplasias" value="SI"> NEOPLASIAS
        </label>
      </div>



<div class="form-control" style="margin-bottom: 10px;">
        <label class="label" for="enfermedad_cronica"><b style="color: red;"></b> ¿OTRAS ENFERMEDADES CRONICAS? ESPECIFIQUE: (Sea breve, máximo 200 caracteres)</label><br/>
        <textarea class="w-full h-48 max-w-lg p-3 border rounded-md resize-y textarea textarea-success" id="enfermedad_cronica" name="enfermedad_cronica" 
        data-parsley-maxlength="200"
        data-parsley-maxlength-message="No debe exceder los 200 caracteres" 
        data-parsley-trigger="keyup">NINGUNA</textarea>
</div>



<!--Comienza la sección de detecciones -->
<br/>
  <label for="vacunas"><strong>SELECCIONE EN CASO AFIRMATIVO:</strong>&nbsp;&nbsp;</label>
  <h2>HA DETECTADO QUE EL (LA) NIÑO (A):</h2>
      
      <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-secondary" name="dificultad_dormir" value="SI"> ¿TIENE DIFICULTAD PARA DORMIR BIEN DURANTE LA NOCHE?
        </label>
      </div>

      <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-secondary" name="fiebre_frecuente" value="SI"> ¿LE DA FIEBRE CON FRECUENCIA?
        </label>
      </div>

      <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-secondary" name="falta_aire" value="SI"> ¿LE FALTA AIRE DESPUÉS DE HACER EJERCICIO?
        </label>
      </div>


      <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-secondary" name="dolor_piernas" value="SI"> ¿LE DUELEN LAS PIERNAS POR LA NOCHE?
        </label>
      </div>
    

    <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-secondary" name="desmayos_frecuentes" value="SI"> ¿SE DESMAYA CON FRECUENCIA?
        </label>
      </div>

      <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-secondary" name="transfusion" value="SI"> ¿HA RECIBIDO ALGUNA VEZ TRANSFUSIÓN SANGUINEA?
        </label>
      </div>

      <div class="form-check">
        <label class="label">
          <input type="checkbox" class="checkbox checkbox-secondary" name="impedimento" value="SI"> ¿TIENE IMPEDIMENTO PARA REALIZAR ACTIVIDADES DEPORTIVAS?
        </label>
      </div>

<br />


   <div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="alergia_medicamento"><b style="color: red;">*</b> ¿ES ALÉRGICO A ALGÚN MEDICAMENTO? ESPECIFIQUE:</label><br/>
  <input class="input input-secondary w-full max-w-md" type="text" id="alergia_medicamento" name="alergia_medicamento" value="NO" 
    required
    data-parsley-maxlength="150"
    data-parsley-maxlength-message="No debe exceder los 150 caracteres" 
    data-parsley-trigger="keyup" />
    </div>


 <div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="alergia_alimento"><b style="color: red;">*</b> ¿ES ALÉRGICO A ALGÚN ALIMENTO O BEBIDA? ESPECIFIQUE:</label><br/>
  <input class="input input-secondary w-full max-w-md" type="text" id="alergia_alimento" name="alergia_alimento" value="NO" 
    required
    data-parsley-maxlength="150"
    data-parsley-maxlength-message="No debe exceder los 150 caracteres" 
    data-parsley-trigger="keyup" />
 </div>


<div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="hemorragias_frecuentes"><b style="color: red;">*</b> ¿PRESENTA HEMORRAGIAS FRECUENTES? ESPECIFIQUE:</label><br/>
  <input class="input input-secondary w-full max-w-md" type="text" id="hemorragias_frecuentes" name="hemorragias_frecuentes" value="NO" 
    required
    data-parsley-maxlength="150"
    data-parsley-maxlength-message="No debe exceder los 150 caracteres" 
    data-parsley-trigger="keyup" />
</div>


<div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="antecedente_medico"><b style="color: red;">*</b> ¿CUENTA CON ALGÚN ANTECEDENTE MÉDICO QUE LE PROHIBA<br/> A SU HIJO(A) REALIZAR ACTIVIDAD FÍSICA? ESPECIFIQUE:</label><br/>
  <input class="input input-secondary w-full max-w-md" type="text" id="antecedente_medico" name="antecedente_medico" value="NO" 
    required
    data-parsley-maxlength="150"
    data-parsley-maxlength-message="No debe exceder los 150 caracteres" 
    data-parsley-trigger="keyup" />
</div>



<div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="intervencion_quirurgica"><b style="color: red;">*</b> ¿HA SIDO INTERVENIDO QUIRÚRGICAMENTE? ESPECIFIQUE:</label><br/>
  <input class="input input-secondary w-full max-w-md" type="text" id="intervencion_quirurgica" name="intervencion_quirurgica" value="NO" 
    required
    data-parsley-maxlength="150"
    data-parsley-maxlength-message="No debe exceder los 150 caracteres" 
    data-parsley-trigger="keyup" />
</div>
    

<!--Comienza antecedentes hereditarios del alumno -->
 <br/>
 <h2>ANTECEDENTES HEREDITARIOS DEL (LA) ALUMNO(A)</h2>
   

<div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="familiar_diabetes"><b style="color: red;">*</b> ¿TIENE ALGÚN FAMILIAR DIABÉTICO? ESPECIFIQUE PARENTESCO:</label><br/>
  <input class="input input-accent w-full max-w-md" type="text" id="familiar_diabetes" name="familiar_diabetes" value="NINGUNO" 
    required
    data-parsley-maxlength="50"
    data-parsley-maxlength-message="No debe exceder los 50 caracteres" 
    data-parsley-trigger="keyup" />
</div>


<div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="familiar_corazon"><b style="color: red;">*</b> ¿TIENE ALGÚN FAMILIAR ENFERMO DEL CORAZÓN? ESPECIFIQUE PARENTESCO:</label><br/>
  <input class="input input-accent w-full max-w-md" type="text" id="familiar_corazon" name="familiar_corazon" value="NINGUNO" 
    required
    data-parsley-maxlength="50"
    data-parsley-maxlength-message="No debe exceder los 50 caracteres" 
    data-parsley-trigger="keyup" />
    </div>


<div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="familiar_hipertension"><b style="color: red;">*</b> ¿TIENE ALGÚN FAMILIAR HIPERTENSO? ESPECIFIQUE PARENTESCO:</label><br/>
  <input class="input input-accent w-full max-w-md" type="text" id="familiar_hipertension" name="familiar_hipertension" value="NINGUNO" 
    required
    data-parsley-maxlength="50"
    data-parsley-maxlength-message="No debe exceder los 50 caracteres" 
    data-parsley-trigger="keyup" />
    </div>


<div class="form-control" style="margin-bottom: 10px;">
  <label class="label" for="famliar_cancer"><b style="color: red;">*</b> ¿TIENE ALGÚN FAMILIAR ENFERMO DE CANCER? ESPECIFIQUE PARENTESCO:</label><br/>
  <input class="input input-accent w-full max-w-md" type="text" id="familiar_cancer" name="familiar_cancer" value="NINGUNO" 
   required
   data-parsley-maxlength="50"
   data-parsley-maxlength-message="No debe exceder los 50 caracteres" 
   data-parsley-trigger="keyup" />
</div>

</fieldset>

<p class="mx-auto w-1/2"><input class="btn btn-success btn-wide" type="submit" value="Actualizar" /></p>

</form>
<br />
    <a href="../" >Regresar</a>


</div>
</div>
</div>




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