<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// Prueba de PdfDom 
$routes->get('pdf/generar', 'PdfController::generar'); //prueba
//$routes->post('pdf/ficha_inscripcion/(:segment)', 'PdfController::generarfi/$1'); // Generar ficha de inscripción (método get)
$routes->post('pdf/ficha_inscripcion', 'PdfController::generarfi'); // Generar ficha de inscripción (método post)
//$routes->get('pdf/historial_medico/(:segment)', 'PdfController::generarhm/$1'); // Generar historial médico (método get)
$routes->post('pdf/historial_medico', 'PdfController::generarhm'); // Generar historial médico (método post)


// End Point ruta para las localidades (recibe la clave del municipio)
$routes->get('api/localidades/(:segment)', 'LocalidadesController::getByMunicipio/$1');


$routes->get('inscripciones/registro', 'AlumnoController::index'); // Mostrar el formulario de registro
$routes->post('inscripciones/buscar_inscrito', 'AlumnoController::buscar_inscrito'); // 

$routes->get('inscripciones/new', 'AlumnoController::new'); // Mostrar el formulario de inscripción
$routes->post('inscripciones/create', 'AlumnoController::create'); // Crear un nuevo alumno

//$routes->get('inscripciones/edit/(:num)', 'AlumnoController::edit/$1'); // mostrar formulario de edición (get)
$routes->post('inscripciones/edit', 'AlumnoController::edit'); // mostrar formulario de edición (post)
$routes->post('inscripciones/update/(:num)', 'AlumnoController::update/$1'); // Actualizar alumno (post)




