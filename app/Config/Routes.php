<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');


$routes->get('inscripciones/', 'Alumno::index'); // Mostrar todos los alumnos
$routes->get('inscripciones/new', 'Alumno::new'); // Mostrar el formulario de inscripción
$routes->post('inscripciones/create', 'Alumno::create'); // Crear un nuevo alumno

// End Point Ruta para las localidades (recibe la clave del municipio)
$routes->get('api/localidades/(:segment)', 'LocalidadesController::getByMunicipio/$1');