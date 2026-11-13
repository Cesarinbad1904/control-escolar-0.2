<?php 
namespace App\Controllers;

use App\Models\AlumnoModel;
use App\Models\TutorModel;
use App\Models\HistorialMedicoModel;
use App\Models\CalificacionModel;

class Alumno extends BaseController {


// ======================= Página inicial, muestra todos los alumnos ==========
public function index() {

$alumnoModel = new AlumnoModel();

$todosLosAlumnos = new $alumnoModel();

//var_dump($todosLosAlumnos); // Usar solo en modo de desarrollo
//dd($todosLosAlumnos); // Usar solo en modo de desarrollo

$data = [
    'alumnos' => $todosLosAlumnos->asObject()->find(),
]; 

return view ('alumno/index', $data);

}
// =============================================================================




// =========== Mostrar formulario para crear un nuevo alumno ============

public function new() {
   return view('alumno/new');
}
// =========================================================================


// =========== Método para mostrar la página de edición de un alumno existente 

public function edit($id) {

// Instanciar los tres modelos necesarios
        $alumnoModel  = new AlumnoModel();
        $tutorModel   = new TutorModel();
        $medicoModel  = new HistorialMedicoModel();

// Buscar los datos del alumno
    $alumno = $alumnoModel->find($id);


// Validar si el alumno existe antes de continuar
    if (!$alumno) {
        return redirect()->to('/alumno')->with('error', 'Alumno no encontrado');
    }


// Preparar el arreglo de datos para la vista    
    $data = [
        'alumno' => $alumno,
        'tutor'  => $tutorModel->find($alumno->id_alumno ?? null),
        'medico' => $medicoModel->find($alumno->id_alumno ?? null)
    ];

// enviar todo el arreglo a la vista
return view('/alumno/edit', $data);
   
}
// =========================================================================




// =========== Método para crear un nuevo alumno =======================

public function create() {
   // Ejecuta la validación llamando al grupo centralizado
    if (! $this->validate('registroAlumno')) {
        // Si falla, regresa con los errores personalizados en español
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    } else {

    helper('funciones');

    // 1. Instanciar los tres modelos necesarios
        $alumnoModel  = new AlumnoModel();
        $tutorModel   = new TutorModel();
        $medicoModel  = new HistorialMedicoModel();
        $calificacionModel  = new CalificacionModel();

        // 2. Iniciar la transacción de la Base de Datos
        $db = \Config\Database::connect();
        $db->transStart(); // Para producción
        //$db->transException(true)->transStart(); //Solo para desarrollo

        $curp_alumno = $this->request->getPost('curp_alumno');
        $datos_curp_alumno = datosCurp($curp_alumno);

        // Si no se marcó, getPost devuelve null, por lo tanto se asigna 'NO'
        $tieneComputadora = $this->request->getPost('computadora') ?? 'NO';
        $tieneTablet = $this->request->getPost('tablet') ?? 'NO';
        $tieneIntener_casa = $this->request->getPost('internet_casa') ?? 'NO';
        $tieneIntener_movil = $this->request->getPost('internet_movil') ?? 'NO';
        $tieneTv_paga = $this->request->getPost('tv_paga') ?? 'NO';
        $tieneTv_abierta = $this->request->getPost('tv_abierta') ?? 'NO';
        $tieneRadio = $this->request->getPost('radio') ?? 'NO';
        
        // 3. Preparar e Insertar los datos del Alumno (Tabla Padre)
        $datosAlumno = [
            'curp'    => $this->request->getPost('curp_alumno'),
            'nombre_alumno'    => $this->request->getPost('nombre_alumno'),
            'primer_apellido_alumno'    => $this->request->getPost('primer_apellido_alumno'),
            'segundo_apellido_alumno'    => $this->request->getPost('segundo_apellido_alumno'),
            'sexo_alumno'             => $datos_curp_alumno['sexo'],
            'fec_nac_alumno'            => $datos_curp_alumno['fecha_nacimiento'],
            'entidad_nac_alumno'            => $datos_curp_alumno['entidad_nac'],
            'nacionalidad_alumno'            => $this->request->getPost('nacionalidad_alumno'),
            'entidad_dom'            => $this->request->getPost('entidad_dom'),
            'municipio_dom'            => $this->request->getPost('municipio_dom'),
            'localidad_dom'            => $this->request->getPost('localidad_dom'),
            'colonia_dom'            => $this->request->getPost('colonia_dom'),
            'calle_num_dom'            => $this->request->getPost('calle_num_dom'),
            'entre_calle_1'            => $this->request->getPost('entre_calle_1'),
            'entre_calle_2'            => $this->request->getPost('entre_calle_2'),
            'cp'            => $this->request->getPost('cp'),
            'referencia_dom'            => $this->request->getPost('referencia_dom'),
            'telefono_1'            => $this->request->getPost('telefono_1'),
            'telefono_2'            => $this->request->getPost('telefono_2'),
            'telefono_emer'            => $this->request->getPost('telefono_emer'),
            'email_alumno'            => strtolower(trim($this->request->getPost('email_alumno'))),
            'rs_alumno'            => $this->request->getPost('rs_alumno'),
            'rs_user_alumno'            => $this->request->getPost('rs_user_alumno'),
            'num_personas'            => $this->request->getPost('num_personas'),
            'vive_con'            => $this->request->getPost('vive_con'),
            'sosten_econ'            => $this->request->getPost('sosten_econ'),
            'nombre_escuela_procedencia'            => $this->request->getPost('nombre_escuela_procedencia'),
            'computadora'            => $tieneComputadora,
            'tablet'            => $tieneTablet,
            'internet_casa'            => $tieneIntener_casa,
            'internet_movil'            => $tieneIntener_movil,
            'tv_paga'            => $tieneTv_paga,
            'tv_abierta'            => $tieneTv_abierta,
            'radio'            => $tieneRadio,
            'grado'            => $this->request->getPost('grado'),
            'grupo'            => $this->request->getPost('grupo'),
            'mov_i'            => $this->request->getPost('mov_i'),
            'reprobado'            => $this->request->getPost('reprobado'),
            'origen'            => $this->request->getPost('origen'),
            'anios_prescolar'   => $this->request->getPost('anios_prescolar')

            ];

       
        // Guardamos el alumno. Si tiene éxito, obtenemos su ID generado automáticamente
        $alumnoModel->insert($datosAlumno);
        $idAlumnoGenerado = $alumnoModel->getInsertID();

        //dd($idAlumnoGenerado); 


            
     // 4. Preparar e Insertar los datos del Tutor (Tabla Hija 1)
    
        $curp_tutor = $this->request->getPost('curp_tutor');
        $datos_curp_tutor = datosCurp($curp_tutor);

        $curp_tutor2 = $this->request->getPost('curp_tutor2');
        $datos_curp_tutor2 = datosCurp($curp_tutor2);

        $datosTutor = [
            'id_alumno'    => $idAlumnoGenerado, // Vinculamos con el ID recién creado
            'curp_tutor'     => $this->request->getPost('curp_tutor'),
            'nombre_tutor' => $this->request->getPost('nombre_tutor'),
            'primer_apellido_tutor' => $this->request->getPost('primer_apellido_tutor'),
            'segundo_apellido_tutor' => $this->request->getPost('segundo_apellido_tutor'),
            'sexo_tutor'     => $datos_curp_tutor['sexo'],
            'fec_nac_tutor'     => $datos_curp_tutor['fecha_nacimiento'],
            'entidad_nac_tutor'     => $datos_curp_tutor['entidad_nac'],
            'nacionalidad_tutor' => $this->request->getPost('nacionalidad_tutor'),
            'ocupacion_tutor' => $this->request->getPost('ocupacion_tutor'),
            'estudios_tutor' => $this->request->getPost('estudios_tutor'),
            'parentesco_tutor' => $this->request->getPost('parentesco_tutor'),
            'salario_tutor' => $this->request->getPost('salario_tutor'),
            'estudios_tutor' => $this->request->getPost('estudios_tutor'),
            'estado_civil_tutor' => $this->request->getPost('estado_civil_tutor'),
            'email_tutor' => strtolower(trim($this->request->getPost('email_tutor'))),
            'rs_tutor' => $this->request->getPost('rs_tutor'),
            'rs_user_tutor' => $this->request->getPost('rs_user_tutor'),
            'curp_tutor2'     => $this->request->getPost('curp_tutor2'),
            'nombre_tutor2' => $this->request->getPost('nombre_tutor2'),
            'primer_apellido_tutor2' => $this->request->getPost('primer_apellido_tutor2'),
            'segundo_apellido_tutor2' => $this->request->getPost('segundo_apellido_tutor2'),
            'sexo_tutor2'     => $datos_curp_tutor2['sexo'],
            'ocupacion_tutor2' => $this->request->getPost('ocupacion_tutor2'),
            'estudios_tutor2' => $this->request->getPost('estudios_tutor2'),
            'parentesco_tutor2' => $this->request->getPost('parentesco_tutor2'),
            'salario_tutor2' => $this->request->getPost('salario_tutor2'),
            'estado_civil_tutor2' => $this->request->getPost('estado_civil_tutor2'),
            'email_tutor2' => strtolower(trim($this->request->getPost('email_tutor2'))),
            'rs_tutor2' => $this->request->getPost('rs_tutor2'),
            'rs_user_tutor2' => $this->request->getPost('rs_user_tutor2'),
            'responsabilidad' => $this->request->getPost('responsabilidad'),
            'recoge' => $this->request->getPost('recoge')            

        ];
        
        $tutorModel->insert($datosTutor);


        // 5. Preparar e Insertar el Historial Médico (Tabla Hija 2)
        
        // Si no se marcó, getPost devuelve null, por lo tanto se asigna 'NO'
        $apoyo_1 = $this->request->getPost('apoyo_1') ?? 'NO';
        $apoyo_2 = $this->request->getPost('apoyo_2') ?? 'NO';
        $apoyo_3 = $this->request->getPost('apoyo_3') ?? 'NO';
        $apoyo_4 = $this->request->getPost('apoyo_4') ?? 'NO';
        $apoyo_5 = $this->request->getPost('apoyo_5') ?? 'NO';

        $sobrepeso = $this->request->getPost('sobrepeso') ?? 'NO';
        $corazon = $this->request->getPost('corazon') ?? 'NO';
        $bronquitis = $this->request->getPost('bronquitis') ?? 'NO';
        $hemorragias = $this->request->getPost('hemorragias') ?? 'NO';
        $epilepsia = $this->request->getPost('epilepsia') ?? 'NO';
        $fiebre_reumatica = $this->request->getPost('fiebre_reumatica') ?? 'NO';
        $cancer = $this->request->getPost('cancer') ?? 'NO';
        $diabetes = $this->request->getPost('diabetes') ?? 'NO';
        $amigdalitis = $this->request->getPost('amigdalitis') ?? 'NO';
        $anemia = $this->request->getPost('anemia') ?? 'NO';
        $hepatitis = $this->request->getPost('hepatitis') ?? 'NO';
        $neoplasias = $this->request->getPost('neoplasias') ?? 'NO';

        $dificultad_dormir = $this->request->getPost('dificultad_dormir') ?? 'NO';
        $fiebre_frecuente = $this->request->getPost('fiebre_frecuente') ?? 'NO';
        $falta_aire = $this->request->getPost('falta_aire') ?? 'NO';
        $dolor_piernas = $this->request->getPost('dolor_piernas') ?? 'NO';
        $desmayos_frecuentes = $this->request->getPost('desmayos_frecuentes') ?? 'NO';
        $transfusion = $this->request->getPost('transfusion') ?? 'NO';
        $impedimento = $this->request->getPost('impedimento') ?? 'NO';


        $datosMedico = [
            'id_alumno'      => $idAlumnoGenerado, // Vinculamos con el mismo ID del alumno
            'estatura'    => $this->request->getPost('estatura'),
            'peso'       => $this->request->getPost('peso'),
            'tipo_sangre'       => $this->request->getPost('tipo_sangre'),
            'talla_zapato'       => $this->request->getPost('talla_zapato'),
            'zapato_orto'       => $this->request->getPost('zapato_orto'),
            'lentes'       => $this->request->getPost('lentes'),
            'vacunas'       => $this->request->getPost('vacunas'),
            'apoyo_1' => $apoyo_1,
            'apoyo_2' => $apoyo_2,
            'apoyo_3' => $apoyo_3,
            'apoyo_4' => $apoyo_4,
            'apoyo_5' => $apoyo_5,
            'otro_apoyo'       => $this->request->getPost('otro_apoyo'),
            'discapacidad'       => $this->request->getPost('discapacidad'),
            'covid'       => $this->request->getPost('covid'),
            'covid_dosis'       => $this->request->getPost('covid_dosis'),
            'ultimas_enfermedades'       => $this->request->getPost('ultimas_enfermedades'),
            'enfermedades_frecuentes'       => $this->request->getPost('enfermedades_frecuentes'),
            'nombre_medico'       => $this->request->getPost('nombre_medico'),
            'tel_medico'       => $this->request->getPost('tel_medico'),
            'institucion_dh'       => $this->request->getPost('institucion_dh'),
            'recomendaciones'       => $this->request->getPost('recomendaciones'),
            'sobrepeso' => $sobrepeso,  
            'corazon' => $corazon,  
            'bronquitis' => $bronquitis,  
            'hemorragias' => $hemorragias,  
            'epilepsia' => $epilepsia,  
            'fiebre_reumatica' => $fiebre_reumatica,  
            'cancer' => $cancer,  
            'diabetes' => $diabetes,  
            'amigdalitis' => $amigdalitis,  
            'anemia' => $anemia, 
            'hepatitis' => $hepatitis,  
            'neoplasias' => $neoplasias,  

            'enfermedad_cronica'       => $this->request->getPost('enfermedad_cronica'),

            'dificultad_dormir' => $dificultad_dormir,
            'fiebre_frecuente' => $fiebre_frecuente,
            'falta_aire' => $falta_aire,
            'dolor_piernas' => $dolor_piernas,
            'desmayos_frecuentes' => $desmayos_frecuentes,
            'transfusion' => $transfusion,
            'impedimento' => $impedimento,

            'alergia_medicamento'       => $this->request->getPost('alergia_medicamento'),
            'alergia_alimento'       => $this->request->getPost('alergia_alimento'),
            'hemorragias_frecuentes'       => $this->request->getPost('hemorragias_frecuentes'),
            'antecedente_medico'       => $this->request->getPost('antecedente_medico'),
            'intervencion_quirurgica'       => $this->request->getPost('intervencion_quirurgica'),
            'familiar_diabetes'       => $this->request->getPost('familiar_diabetes'),
            'familiar_corazon'       => $this->request->getPost('familiar_corazon'),
            'familiar_hipertension'       => $this->request->getPost('familiar_hipertension'),
            'familiar_cancer'       => $this->request->getPost('familiar_cancer')            
        ];
        $medicoModel->insert($datosMedico);


        // 6. Preparar e Insertar las calificaciones (Tabla Hija 3)
        $datosCalificaciones = [
            'id_alumno'      => $idAlumnoGenerado // Vinculamos con el mismo ID del alumno
            
        ];
        $calificacionModel->insert($datosCalificaciones);

        // 7. Completar la transacción
        $db->transComplete();


        // 8. Verificar si todo salió bien
        if ($db->transStatus() === FALSE) {
            // Si algo falló en cualquier insert, CI4 hace Rollback automático (no guarda nada)
            return redirect()->back()->withInput()->with('error', 'Ocurrió un error al registrar al alumno.');
        } else {
            // Si todo fue exitoso, los datos ya están distribuidos de forma permanente
            return redirect()->to('/alumnos')->with('success', 'Alumno, tutor e historial registrados correctamente.');
        }
            
  
    }
}
// =========================================================================


// =========== Método para actualizar un alumno =======================

public function update($id) {
   // Ejecuta la validación llamando al grupo centralizado
    if (! $this->validate('registroAlumno')) {
        // Si falla, regresa con los errores personalizados en español
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    } else {

    helper('funciones');

// Instanciar los tres modelos necesarios
        $alumnoModel  = new AlumnoModel();
        $tutorModel   = new TutorModel();
        $medicoModel  = new HistorialMedicoModel();
        
// Buscar al alumno actual para obtener los IDs de sus tablas relacionadas
    $alumnoActual = $alumnoModel->find($id);
    

// Preparar e Insertar los datos del Alumno (Tabla Padre)
        $curp_alumno = $this->request->getPost('curp_alumno');
        $datos_curp_alumno = datosCurp($curp_alumno);

        $datosAlumno = [
            'curp'    => $this->request->getPost('curp_alumno'),
            'nombre_alumno'    => $this->request->getPost('nombre_alumno'),
            'primer_apellido_alumno'    => $this->request->getPost('primer_apellido_alumno'),
            'segundo_apellido_alumno'    => $this->request->getPost('segundo_apellido_alumno'),
            'sexo_alumno'             => $datos_curp_alumno['sexo'],
            'fec_nac_alumno'            => $datos_curp_alumno['fecha_nacimiento'],
            'entidad_nac_alumno'            => $datos_curp_alumno['entidad_nac'],
            'nacionalidad_alumno'            => $this->request->getPost('nacionalidad_alumno'),
            'entidad_dom'            => $this->request->getPost('entidad_dom'),
            'municipio_dom'            => $this->request->getPost('municipio_dom'),
            'localidad_dom'            => $this->request->getPost('localidad_dom'),
            'colonia_dom'            => $this->request->getPost('colonia_dom'),
            'calle_num_dom'            => $this->request->getPost('calle_num_dom'),
            'entre_calle_1'            => $this->request->getPost('entre_calle_1'),
            'entre_calle_2'            => $this->request->getPost('entre_calle_2'),
            'cp'            => $this->request->getPost('cp'),
            'referencia_dom'            => $this->request->getPost('referencia_dom'),
            'telefono_1'            => $this->request->getPost('telefono_1'),
            'telefono_2'            => $this->request->getPost('telefono_2'),
            'telefono_emer'            => $this->request->getPost('telefono_emer'),
            'email_alumno'            => strtolower(trim($this->request->getPost('email_alumno'))),
            'rs_alumno'            => $this->request->getPost('rs_alumno'),
            'rs_user_alumno'            => $this->request->getPost('rs_user_alumno'),
            'num_personas'            => $this->request->getPost('num_personas'),
            'vive_con'            => $this->request->getPost('vive_con'),
            'sosten_econ'            => $this->request->getPost('sosten_econ'),
            'nombre_escuela_procedencia'            => $this->request->getPost('nombre_escuela_procedencia'),
            'computadora'            => $this->request->getPost('computadora'),
            'tablet'            => $this->request->getPost('tablet'),
            'internet_casa'            => $this->request->getPost('internet_casa'),
            'internet_movil'            => $this->request->getPost('internet_movil'),
            'tv_paga'            => $this->request->getPost('tv_paga'),
            'tv_abierta'            => $this->request->getPost('tv_abierta'),
            'radio'            => $this->request->getPost('radio'),
            'grado'            => $this->request->getPost('grado'),
            'grupo'            => $this->request->getPost('grupo'),
            'mov_i'            => $this->request->getPost('mov_i'),
            'reprobado'            => $this->request->getPost('reprobado'),
            'origen'            => $this->request->getPost('origen'),
            'anios_prescolar'   => $this->request->getPost('anios_prescolar')

            ];
       
        
        
   // Preparar e Insertar los datos del Tutor (Tabla Hija 1)
    
        $curp_tutor = $this->request->getPost('curp_tutor');
        $datos_curp_tutor = datosCurp($curp_tutor);

        $curp_tutor2 = $this->request->getPost('curp_tutor2');
        $datos_curp_tutor2 = datosCurp($curp_tutor2);

        $datosTutor = [
            'curp_tutor'     => $this->request->getPost('curp_tutor'),
            'nombre_tutor' => $this->request->getPost('nombre_tutor'),
            'primer_apellido_tutor' => $this->request->getPost('primer_apellido_tutor'),
            'segundo_apellido_tutor' => $this->request->getPost('segundo_apellido_tutor'),
            'sexo_tutor'     => $datos_curp_tutor['sexo'],
            'fec_nac_tutor'     => $datos_curp_tutor['fecha_nacimiento'],
            'entidad_nac_tutor'     => $datos_curp_tutor['entidad_nac'],
            'nacionalidad_tutor' => $this->request->getPost('nacionalidad_tutor'),
            'ocupacion_tutor' => $this->request->getPost('ocupacion_tutor'),
            'estudios_tutor' => $this->request->getPost('estudios_tutor'),
            'parentesco_tutor' => $this->request->getPost('parentesco_tutor'),
            'salario_tutor' => $this->request->getPost('salario_tutor'),
            'estudios_tutor' => $this->request->getPost('estudios_tutor'),
            'estado_civil_tutor' => $this->request->getPost('estado_civil_tutor'),
            'email_tutor' => strtolower(trim($this->request->getPost('email_tutor'))),
            'rs_tutor' => $this->request->getPost('rs_tutor'),
            'rs_user_tutor' => $this->request->getPost('rs_user_tutor'),
            'curp_tutor2'     => $this->request->getPost('curp_tutor2'),
            'nombre_tutor2' => $this->request->getPost('nombre_tutor2'),
            'primer_apellido_tutor2' => $this->request->getPost('primer_apellido_tutor2'),
            'segundo_apellido_tutor2' => $this->request->getPost('segundo_apellido_tutor2'),
            'sexo_tutor2'     => $datos_curp_tutor2['sexo'],
            'ocupacion_tutor2' => $this->request->getPost('ocupacion_tutor2'),
            'estudios_tutor2' => $this->request->getPost('estudios_tutor2'),
            'parentesco_tutor2' => $this->request->getPost('parentesco_tutor2'),
            'salario_tutor2' => $this->request->getPost('salario_tutor2'),
            'estado_civil_tutor2' => $this->request->getPost('estado_civil_tutor2'),
            'email_tutor2' => strtolower(trim($this->request->getPost('email_tutor2'))),
            'rs_tutor2' => $this->request->getPost('rs_tutor2'),
            'rs_user_tutor2' => $this->request->getPost('rs_user_tutor2'),
            'responsabilidad' => $this->request->getPost('responsabilidad'),
            'recoge' => $this->request->getPost('recoge')            

        ];
        

        // Preparar e Insertar el Historial Médico (Tabla Hija 2)
       
        $datosMedico = [
            'estatura'    => $this->request->getPost('estatura'),
            'peso'       => $this->request->getPost('peso'),
            'tipo_sangre'       => $this->request->getPost('tipo_sangre'),
            'talla_zapato'       => $this->request->getPost('talla_zapato'),
            'zapato_orto'       => $this->request->getPost('zapato_orto'),
            'lentes'       => $this->request->getPost('lentes'),
            'vacunas'       => $this->request->getPost('vacunas'),
            'apoyo_1' => $this->request->getPost('apoyo_1'),
            'apoyo_2' => $this->request->getPost('apoyo_2'),
            'apoyo_3' => $this->request->getPost('apoyo_3'),
            'apoyo_4' => $this->request->getPost('apoyo_4'),
            'apoyo_5' => $this->request->getPost('apoyo_5'),
            'otro_apoyo'       => $this->request->getPost('otro_apoyo'),
            'discapacidad'       => $this->request->getPost('discapacidad'),
            'covid'       => $this->request->getPost('covid'),
            'covid_dosis'       => $this->request->getPost('covid_dosis'),
            'ultimas_enfermedades'       => $this->request->getPost('ultimas_enfermedades'),
            'enfermedades_frecuentes'       => $this->request->getPost('enfermedades_frecuentes'),
            'nombre_medico'       => $this->request->getPost('nombre_medico'),
            'tel_medico'       => $this->request->getPost('tel_medico'),
            'institucion_dh'       => $this->request->getPost('institucion_dh'),
            'recomendaciones'       => $this->request->getPost('recomendaciones'),
            'sobrepeso' => $this->request->getPost('sobrepeso'), 
            'corazon' => $this->request->getPost('corazon'),   
            'bronquitis' => $this->request->getPost('bronquitis'),
            'hemorragias' => $this->request->getPost('hemorragias'),  
            'epilepsia' => $this->request->getPost('epilepsia'),  
            'fiebre_reumatica' => $this->request->getPost('fiebre_reumatica'),  
            'cancer' => $this->request->getPost('cancer'), 
            'diabetes' => $this->request->getPost('diabetes'),
            'amigdalitis' => $this->request->getPost('amigdalitis'),  
            'anemia' => $this->request->getPost('anemia'), 
            'hepatitis' => $this->request->getPost('hepatitis'),
            'neoplasias' => $this->request->getPost('neoplasias'),

            'enfermedad_cronica'       => $this->request->getPost('enfermedad_cronica'),

            'dificultad_dormir' => $this->request->getPost('dificultad_dormir'),
            'fiebre_frecuente' => $this->request->getPost('fiebre_frecuente'), 
            'falta_aire' => $this->request->getPost('falta_aire'),
            'dolor_piernas' => $this->request->getPost('dolor_piernas'),
            'desmayos_frecuentes' => $this->request->getPost('desmayos_frecuentes'),
            'transfusion' => $this->request->getPost('transfusion'),
            'impedimento' => $this->request->getPost('impedimento'),

            'alergia_medicamento'       => $this->request->getPost('alergia_medicamento'),
            'alergia_alimento'       => $this->request->getPost('alergia_alimento'),
            'hemorragias_frecuentes'       => $this->request->getPost('hemorragias_frecuentes'),
            'antecedente_medico'       => $this->request->getPost('antecedente_medico'),
            'intervencion_quirurgica'       => $this->request->getPost('intervencion_quirurgica'),
            'familiar_diabetes'       => $this->request->getPost('familiar_diabetes'),
            'familiar_corazon'       => $this->request->getPost('familiar_corazon'),
            'familiar_hipertension'       => $this->request->getPost('familiar_hipertension'),
            'familiar_cancer'       => $this->request->getPost('familiar_cancer')            
        ];


//Iniciar la transacción de la Base de Datos
        $db = \Config\Database::connect();
        //$db->transStart(); // Para producción
        $db->transException(true)->transStart(); //Solo para desarrollo

  // Actualizar Tutor (usando la llave foránea guardada en el alumno)
    if (!empty($alumnoActual->id_alumno)) {
        $tutorModel->update($alumnoActual->id_alumno, $datosTutor);
    }

    // Actualizar Médico (usando la llave foránea guardada en el alumno)
    if (!empty($alumnoActual->id_alumno)) {
        $medicoModel->update($alumnoActual->id_alumno, $datosMedico);
    }

    // Actualizar Alumno
    $alumnoModel->update($id, $datosAlumno);

    // Completar la transacción
    $db->transComplete();
        


    // Verificar si todo salió bien o hubo algún fallo en SQL
    if ($db->transStatus() === false) {
        return redirect()->back()->withInput()->with('error', 'Ocurrió un error al actualizar los datos. No se guardaron cambios.');
    }

    return redirect()->to('/inscripciones')->with('mensaje', '¡Datos actualizados correctamente!');
            
  
    }
}
// =========================================================================


}