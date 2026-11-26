<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// Prueba de PdfDom 
$routes->get('pdf/generar', 'PdfController::generar'); //prueba

$routes->get('pdf/ficha_inscripcion/(:segment)', '\App\Controllers\PdfController::generarfi/$1'); // Ruta GET (para enlaces desde tablas o botones)
$routes->post('pdf/ficha_inscripcion', 'PdfController::generarfi'); // Generar ficha de inscripción (método post)
$routes->get('pdf/historial_medico/(:segment)', '\App\Controllers\PdfController::generarhm/$1'); // Generar historial médico (método get)
$routes->post('pdf/historial_medico', 'PdfController::generarhm'); // Generar historial médico (método post)


// End Point ruta para las localidades (recibe la clave del municipio)
$routes->get('api/localidades/(:segment)', 'LocalidadesController::getByMunicipio/$1');


// Grupo de rutas para inscripciones 
$routes->group('inscripciones', ['namespace'=>'\App\Controllers\inscripciones'], function ($routes) {

    $routes->get('registro', 'RegistroController::index'); // Mostrar el formulario para búsqueda de CURP
    $routes->post('buscar_inscrito', 'RegistroController::buscar_inscrito'); 
    $routes->post('edit', 'RegistroController::edit'); // mostrar formulario de edición (post)
    $routes->get('edit/(:num)', 'RegistroController::edit/$1'); // Ruta GET: recibe el ID en la URL (ej. /edit/15 o /inscripciones/edit/15)

    $routes->post('update/(:num)', 'RegistroController::update/$1'); // Actualizar alumno (post)
    $routes->get('new', 'RegistroController::new'); // Mostrar el formulario de inscripción
    $routes->post('create', 'RegistroController::create'); // Crear un nuevo alumno 

});


// Grupo exclusivo para Dirección Escolar
$routes->group('direccion', [
    'namespace' => 'App\Controllers\Direccion'
    //'filter'    => 'authRole:direccion' // Filtro que valida sesión y rol
], static function ($routes) {
   
$routes->get('panel', 'DashboardController::index'); // Dashboard

// Módulo de Alumnos Inscritos
    $routes->get('alumnos', 'AlumnosController::index');
    $routes->get('alumnos/por-grupo', 'AlumnosController::porGrupo');
    $routes->get('alumnos/ver/(:num)', 'AlumnosController::ver/$1');
    $routes->post('alumnos/movimiento', 'AlumnosController::registrarMovimiento');
    $routes->post('alumnos/grado-grupo', 'AlumnosController::actualizarGradoGrupo');
    $routes->post('alumnos/eliminar', 'AlumnosController::eliminar');
    $routes->get('alumnos/constancia-ins/(:num)', 'AlumnosController::constIns/$1');

    // Estadística por edades (Formato estadístico)
    $routes->get('alumnos/estadistica-edades', 'AlumnosController::estadisticaEdades');

    


    // Módulo de Tutores
    $routes->get('tutores', 'TutoresController::index');


    // Módulo de Alumnos Base (Autorización de Inscripción / Alta)
    $routes->get('alumnos-base/nuevo', 'AlumnosBaseController::nuevo');
    $routes->post('alumnos-base/guardar', 'AlumnosBaseController::guardar');
    $routes->get('alumnos-base', 'AlumnosBaseController::index');
    $routes->post('alumnos-base/grado-grupo', 'AlumnosBaseController::actualizarGradoGrupo');
    $routes->get('alumnos-base/por-grupo', 'AlumnosBaseController::porGrupo'); // Consulta por grupo en Padrón Autorizado (alumnos_base)
    $routes->get('alumnos-base/estadistica', 'AlumnosBaseController::estadistica'); // Estadística por grado y grupo en Padrón Autorizado (alumnos_base)
    // Eliminar alumno autorizado del padrón base (solo si no está inscrito)
    $routes->post('alumnos-base/eliminar', 'AlumnosBaseController::eliminar');



    // Generador de Listas Personalizadas
    $routes->get('listas/generador', 'ListasController::generador');
   
});




// Grupo exclusivo para Docentes
$routes->group('docentes', [
    'namespace' => 'App\Controllers\Docentes',
    'filter'    => 'authRole:docente'
], static function ($routes) {
    $routes->get('mis-grupos', 'GruposController::index');
    $routes->post('calificaciones/subir', 'CalificacionesController::subir');
    $routes->get('asistencia/(:num)', 'AsistenciaController::pasarLista/$1');
});