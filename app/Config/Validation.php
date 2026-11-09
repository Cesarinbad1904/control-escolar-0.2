<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules

    // GRUPO DE VALIDACIÓN PERSONALIZADO
    public array $registroAlumno = [

        'nombre_alumno' => [ 
            'label' => 'Nombre(s) del alumno', 
            'rules' => [
                'required',
                // Este regex acepta letras, eñes, tildes y espacios
                'regex_match[/^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]+$/u]',
                'max_length[25]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'regex_match' => 'El campo {field} solo puede contener letras y espacios.', 
                'max_length'  => 'El campo {field} no puede exceder los 25 caracteres.'
            ]
        ],


        'primer_apellido_alumno' => [ 
            'label' => 'Primer apellido del alumno', 
            'rules' => [
                'required',
                // Este regex acepta letras, eñes, tildes y espacios
                'regex_match[/^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]+$/u]',
                'max_length[25]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'regex_match' => 'El campo {field} solo puede contener letras y espacios.', 
                'max_length'  => 'El campo {field} no puede exceder los 25 caracteres.'
            ]
        ],


        'segundo_apellido_alumno' => [ 
            'label' => 'Segundo apellido del alumno', 
            'rules' => [
                'required',
                // Este regex acepta letras, eñes, tildes y espacios
                'regex_match[/^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]+$/u]',
                'max_length[25]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'regex_match' => 'El campo {field} solo puede contener letras y espacios.', 
                'max_length'  => 'El campo {field} no puede exceder los 25 caracteres.'
            ]
        ],


        'nacionalidad_alumno' => [ 
            'label' => 'Nacionalidad del alumno', 
            'rules' => [
                'required',
                'max_length[20]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 20 caracteres.'
            ]
        ], 

        'municipio_dom' => [ 
            'label' => 'Municipio', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 


        'localidad_dom' => [ 
            'label' => 'Localidad', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 


        'colonia_dom' => [ 
            'label' => 'Colonia', 
            'rules' => [
                'required',
                'max_length[50]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 50 caracteres.'
            ]
        ], 


        'calle_num_dom' => [ 
            'label' => 'Calle y número', 
            'rules' => [
                'required', 
                'max_length[60]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 60 caracteres.'
            ]
        ], 


        'entre_calle_1' => [ 
            'label' => 'Entre calle', 
            'rules' => [
                'required',
                'max_length[40]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 40 caracteres.'
            ]
        ], 


        'entre_calle_2' => [ 
            'label' => 'Y calle', 
            'rules' => [
                'required',
                'max_length[40]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 40 caracteres.'
            ]
        ], 

        'cp' => [ 
            'label' => 'Código postal', 
            'rules' => [
                'required',
                'regex_match[/^[0-9]{5}$/]' 
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'regex_match' => 'Campo {field} inválido, debe ser un número de 5 dígitos.'
            ]
        ], 


        'referencia_dom' => [ 
            'label' => 'Referencia domiciliaria', 
            'rules' => [
                'required',
                'max_length[50]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 50 caracteres.'
            ]
        ], 

        'telefono_1' => [
            'label' => 'Número de teléfono 1',
            'rules' => [
                'required',
                'numeric',          // Garantiza que solo entren números del 0 al 9
                'exact_length[10]'  // Fuerza a que sean exactamente 10 caracteres
            ],
            'errors' => [
                'required'     => 'El campo {field} es obligatorio.',
                'numeric'      => 'El campo {field} solo debe contener números.',
                'exact_length' => 'El campo {field} debe tener exactamente 10 dígitos.'
            ]
        ], 


        'telefono_2' => [
            'label' => 'Número de teléfono 2',
            'rules' => [
                'required',
                'numeric',          // Garantiza que solo entren números del 0 al 9
                'exact_length[10]'  // Fuerza a que sean exactamente 10 caracteres
            ],
            'errors' => [
                'required'     => 'El campo {field} es obligatorio.',
                'numeric'      => 'El campo {field} solo debe contener números.',
                'exact_length' => 'El campo {field} debe tener exactamente 10 dígitos.'
            ]
        ], 


        'telefono_emer' => [
            'label' => 'Número de teléfono de emergencia',
            'rules' => [
                'required',
                'numeric',          // Garantiza que solo entren números del 0 al 9
                'exact_length[10]'  // Fuerza a que sean exactamente 10 caracteres
            ],
            'errors' => [
                'required'     => 'El campo {field} es obligatorio.',
                'numeric'      => 'El campo {field} solo debe contener números.',
                'exact_length' => 'El campo {field} debe tener exactamente 10 dígitos.'
            ]
        ], 

        'email_alumno' => [
            'label' => 'Correo electrónico del alumno',
            'rules' => [
                'required',
                'valid_email', // Verifica la estructura correcta del correo (PHP filter_var)
                'max_length[50]' // Longitud máxima estándar para correos en bases de datos
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'valid_email' => 'Por favor, introduzca una dirección de correo válida.',
                'max_length'  => 'El {field} no puede exceder los 50 caracteres.'
            ]
        ], 

        'rs_alumno' => [ 
            'label' => 'Red social del alumno', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 

        'rs_user_alumno' => [ 
            'label' => 'Nombre de usuario de la red social del alumno', 
            'rules' => [
                'required',
                'max_length[20]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 20 caracteres.'
            ]
        ], 

        'num_personas' => [
            'label' => 'Número de personas que viven en casa',
            'rules' => [
                'required',
                'numeric'  // solo números
            ],
            'errors' => [
                'required'     => 'El campo {field} es obligatorio.',
                'numeric'      => 'El campo {field} solo debe contener números.'
            ]
        ], 


        'vive_con' => [ 
            'label' => '¿Con quién vive?', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 

        'sosten_econ' => [ 
            'label' => '¿Quién sostiene económicamente la casa?', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 

        'nombre_escuela_procedencia' => [ 
            'label' => 'Escuela de procedencia', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 

        // ================ Datos del primer tutor ================================================

        'curp_tutor' => [ 
            'label' => 'CURP del tutor', 
            'rules' => [
                'required',
                'regex_match[/^[A-Z]{1}[XAEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/i]' 
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'regex_match' => 'Formato de CURP inválido en {field}.'
            ]
        ], 

        'nombre_tutor' => [ 
            'label' => 'Nombre del tutor', 
            'rules' => [
                'required',
                // Este regex acepta letras, eñes, tildes y espacios
                'regex_match[/^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]+$/u]',
                'max_length[25]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'regex_match' => 'El campo {field} solo puede contener letras y espacios.', 
                'max_length'  => 'El campo {field} no puede exceder los 25 caracteres.'
            ]
        ],


        'primer_apellido_tutor' => [ 
            'label' => 'Primer apellido del tutor', 
            'rules' => [
                'required',
                // Este regex acepta letras, eñes, tildes y espacios
                'regex_match[/^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]+$/u]',
                'max_length[25]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'regex_match' => 'El campo {field} solo puede contener letras y espacios.', 
                'max_length'  => 'El campo {field} no puede exceder los 25 caracteres.'
            ]
        ],


        'segundo_apellido_tutor' => [ 
            'label' => 'Segundo apellido del tutor', 
            'rules' => [
                'required',
                // Este regex acepta letras, eñes, tildes y espacios
                'regex_match[/^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]+$/u]',
                'max_length[25]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'regex_match' => 'El campo {field} solo puede contener letras y espacios.', 
                'max_length'  => 'El campo {field} no puede exceder los 25 caracteres.'
            ]
        ],


        'nacionalidad_tutor' => [ 
            'label' => 'Nacionalidad del tutor', 
            'rules' => [
                'required',
                'max_length[20]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 20 caracteres.'
            ]
        ], 

        'ocupacion_tutor' => [ 
            'label' => 'Ocupación del tutor', 
            'rules' => [
                'required',
                'max_length[30]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 30 caracteres.'
            ]
        ], 

        'estudios_tutor' => [ 
            'label' => 'Grado máximo de estudios del tutor', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 

        'parentesco_tutor' => [ 
            'label' => 'Parentesco del tutor con el alumno', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 

        'salario_tutor' => [ 
            'label' => 'Ingreso mensual del tutor', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 

        'estado_civil_tutor' => [ 
            'label' => 'Estado civil del tutor', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 


        'email_tutor' => [
            'label' => 'Correo electrónico del tutor',
            'rules' => [
                'required',
                'valid_email', // Verifica la estructura correcta del correo (PHP filter_var)
                'max_length[50]' // Longitud máxima estándar para correos en bases de datos
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'valid_email' => 'Por favor, introduzca una dirección de correo válida.',
                'max_length'  => 'El {field} no puede exceder los 50 caracteres.'
            ]
        ], 

        'rs_tutor' => [ 
            'label' => 'Red social del tutor', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 

        'rs_tutor' => [ 
            'label' => 'Nombre de usuario de la red social del tutor', 
            'rules' => [
                'required',
                'max_length[20]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 20 caracteres.'
            ]
        ], 

        // ================= Datos del segundo tutor ============================

        'curp_tutor2' => [ 
            'label' => 'CURP del segundo tutor', 
            'rules' => [
                'required',
                'regex_match[/^[A-Z]{1}[XAEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/i]' 
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'regex_match' => 'Formato de CURP inválido en {field}.'
            ]
        ], 

        'nombre_tutor2' => [ 
            'label' => 'Nombre(s) del segundo tutor', 
            'rules' => [
                'required',
                // Este regex acepta letras, eñes, tildes y espacios
                'regex_match[/^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]+$/u]',
                'max_length[25]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'regex_match' => 'El campo {field} solo puede contener letras y espacios.', 
                'max_length'  => 'El campo {field} no puede exceder los 25 caracteres.'
            ]
        ],


        'primer_apellido_tutor2' => [ 
            'label' => 'Primer apellido del segundo tutor', 
            'rules' => [
                'required',
                // Este regex acepta letras, eñes, tildes y espacios
                'regex_match[/^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]+$/u]',
                'max_length[25]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'regex_match' => 'El campo {field} solo puede contener letras y espacios.', 
                'max_length'  => 'El campo {field} no puede exceder los 25 caracteres.'
            ]
        ],


        'segundo_apellido_tutor2' => [ 
            'label' => 'Segundo apellido del segundo tutor', 
            'rules' => [
                'required',
                // Este regex acepta letras, eñes, tildes y espacios
                'regex_match[/^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]+$/u]',
                'max_length[25]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'regex_match' => 'El campo {field} solo puede contener letras y espacios.', 
                'max_length'  => 'El campo {field} no puede exceder los 25 caracteres.'
            ]
        ],


        'ocupacion_tutor2' => [ 
            'label' => 'Ocupación del segundo tutor', 
            'rules' => [
                'required',
                'max_length[30]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 30 caracteres.'
            ]
        ], 

        'estudios_tutor2' => [ 
            'label' => 'Grado máximo de estudios del segundo tutor', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 

        'parentesco_tutor2' => [ 
            'label' => 'Parentesco del segundo tutor con el alumno', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 

         'salario_tutor2' => [ 
            'label' => 'Ingreso mensual del segundo tutor', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 

        'estado_civil_tutor2' => [ 
            'label' => 'Estado civil del segundo tutor', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 


        'email_tutor2' => [
            'label' => 'Correo electrónico del segundo tutor',
            'rules' => [
                'required',
                'valid_email', // Verifica la estructura correcta del correo (PHP filter_var)
                'max_length[50]' // Longitud máxima 
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'valid_email' => 'Por favor, introduzca una dirección de correo válida.',
                'max_length'  => 'El {field} no puede exceder los 50 caracteres.'
            ]
        ], 

    // ====== Validación para la sección del historial médico =============

            'estatura' => [
            'label' => 'Estatura',
            'rules' => [
                'required',
                'integer',                     // Garantiza que sea un número entero (sin decimales)
                'greater_than_equal_to[100]',  // Límite mínimo: 100 cm
                'less_than_equal_to[165]',     // Límite máximo: 165 cm
            ],
            'errors' => [
                'required'              => 'El campo {field} es obligatorio.',
                'integer'               => 'La {field} debe ser un número entero (en centímetros).',
                'greater_than_equal_to' => 'La {field} mínima permitida es de 100 cm.',
                'less_than_equal_to'    => 'La {field} máxima permitida es de 165 cm.'
            ]
        ],


        'peso' => [
            'label' => 'Peso',
            'rules' => [
                'required',
                'integer',                     // Garantiza que sea un número entero (sin decimales)
                'greater_than_equal_to[15]',  // Límite mínimo: 15 cm
                'less_than_equal_to[65]',     // Límite máximo: 65 cm
            ],
            'errors' => [
                'required'              => 'El campo {field} es obligatorio.',
                'integer'               => 'La {field} debe ser un número entero (en kilogramos).',
                'greater_than_equal_to' => 'La {field} mínima permitida es de 15 kg.',
                'less_than_equal_to'    => 'La {field} máxima permitida es de 65 kg.'
            ]
        ],


        'talla_zapato' => [
            'label' => 'Talla de zapato en centímetros',
            'rules' => [
                'required',
                'integer',                     // Garantiza que sea un número entero (sin decimales)
                'greater_than_equal_to[18]',  // Límite mínimo: 18 cm
                'less_than_equal_to[25]',     // Límite máximo: 25 cm
            ],
            'errors' => [
                'required'              => 'El campo {field} es obligatorio.',
                'integer'               => 'La {field} debe ser un número entero.',
                'greater_than_equal_to' => 'La {field} mínima permitida es de 18 cm.',
                'less_than_equal_to'    => 'La {field} máxima permitida es de 25 cm.'
            ]
        ],

        'vacunas' => [ 
            'label' => 'Vacunas', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 

        'otro_apoyo' => [ // Null
            'label' => 'Otro apoyo', 
            'rules' => [
                'permit_empty', // Se puede dejar vacío
                'max_length[40]'
            ],
            'errors' => [
                'max_length' => 'El campo {field} no puede exceder los 40 caracteres.'
            ]
        ], 


        'discapacidad' => [ // Null
            'label' => 'Discapacidad', 
            'rules' => [
                'permit_empty', // Se puede dejar vacío
                'max_length[60]'
            ],
            'errors' => [
                'max_length' => 'El campo {field} no puede exceder los 60 caracteres.'
            ]
        ], 


        'ultimas_enfermedades' => [ 
            'label' => 'Últimas enfermedades', 
            'rules' => [
                'required',
                'max_length[150]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 150 caracteres.'
            ]
        ], 


        'enfermedades_frecuentes' => [ 
            'label' => 'Enfermedades frecuentes', 
            'rules' => [
                'required',
                'max_length[150]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 150 caracteres.'
            ]
        ], 

        'nombre_medico' => [ // Null
            'label' => 'Nombre del médico familiar', 
            'rules' => [
                'permit_empty', // Se puede dejar vacío
                'max_length[50]'
            ],
            'errors' => [
                'max_length' => 'El campo {field} no puede exceder los 50 caracteres.'
            ]
        ], 


 
        'tel_medico' => [ // Null
            'label' => 'Teléfono del médico familiar', 
            'rules' => [
                'permit_empty', // Se puede dejar vacío
                'regex_match[/^\d{10}$/]' 
            ],
            'errors' => [
                'regex_match' => 'Campo {field} inválido, debe ser un número de 10 dígitos.'
            ]
        ], 


        'institucion_dh' => [ 
            'label' => 'Institucion de derechohabiencia', 
            'rules' => [
                'required'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.'
            ]
        ], 

        'recomendaciones' => [ 
            'label' => 'Recomendaciones especiales', 
            'rules' => [
                'required',
                'max_length[200]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 200 caracteres.'
            ]
        ], 

        'enfermedad_cronica' => [ 
            'label' => 'Enfermedad crónica', 
            'rules' => [
                'required',
                'max_length[200]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 200 caracteres.'
            ]
        ], 


        'alergia_medicamento' => [ 
            'label' => 'Alergia a medicamento', 
            'rules' => [
                'required',
                'max_length[150]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 150 caracteres.'
            ]
        ], 

        'alergia_alimento' => [ 
            'label' => 'Alergia a alimento', 
            'rules' => [
                'required',
                'max_length[150]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'max_length' => 'El campo {field} no puede exceder los 150 caracteres.'
            ]
        ]


    ];
  
    // --------------------------------------------------------------------
}
