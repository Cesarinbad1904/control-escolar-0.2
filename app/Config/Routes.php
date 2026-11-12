<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// Prueba de PdfDom 
$routes->get('pdf/generar', 'PdfController::generar'); //prueba
$routes->get('pdf/ficha_inscripcion/(:segment)', 'PdfController::generarfi/$1'); // Generar ficha de inscripción
$routes->get('pdf/historial_medico', 'PdfController::generarhm'); // Generar historial médico


// End Point Ruta para las localidades (recibe la clave del municipio)
$routes->get('api/localidades/(:segment)', 'LocalidadesController::getByMunicipio/$1');

$routes->get('inscripciones/', 'Alumno::index'); // Mostrar todos los alumnos
$routes->get('inscripciones/new', 'Alumno::new'); // Mostrar el formulario de inscripción
$routes->post('inscripciones/create', 'Alumno::create'); // Crear un nuevo alumno

$routes->get('inscripciones/edit/(:num)', 'Alumno::edit/$1'); // mostrar formulario de edición 

$routes->post('inscripciones/update/(:num)', 'Alumno::update/$1'); // Actualizar alumno



