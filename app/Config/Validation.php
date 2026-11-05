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

        'nombre_alumno' => [ // Nombre del campo del formulario
            'label' => 'Nombre del alumno', // Cualquier nombre para referirse a este campo en los errores
            'rules' => [
                'required',
                'alpha_space',
                'max_length[22]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'alpha_space' => 'El campo {field} solo puede contener letras y espacios.',
                'max_length' => 'El campo {field} no puede exceder los 22 caracteres.'
            ]
        ],

        'primer_apellido_alumno' => [ 
            'label' => 'Primer apellido del alumno', 
            'rules' => [
                'required',
                'alpha_space',
                'max_length[22]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'alpha_space' => 'El campo {field} solo puede contener letras y espacios.',
                'max_length' => 'El campo {field} no puede exceder los 22 caracteres.'
            ]
        ], 


        'segundo_apellido_alumno' => [ 
            'label' => 'Segundo apellido del alumno', 
            'rules' => [
                'required',
                'alpha_space',
                'max_length[22]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'alpha_space' => 'El campo {field} solo puede contener letras y espacios.',
                'max_length' => 'El campo {field} no puede exceder los 22 caracteres.'
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
                'alpha_numeric_punct', 
                'max_length[60]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'alpha_numeric_punct' => 'El campo {field} solo puede contener letras, números, espacios y signos como #, -, . o : .',
                'max_length' => 'El campo {field} no puede exceder los 60 caracteres.'
            ]
        ], 


        'entre_calle_1' => [ 
            'label' => 'Entre calle', 
            'rules' => [
                'required',
                'alpha_space',
                'max_length[40]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'alpha_space' => 'El campo {field} solo puede contener letras y espacios.',
                'max_length' => 'El campo {field} no puede exceder los 40 caracteres.'
            ]
        ], 


        'entre_calle_2' => [ 
            'label' => 'Y calle', 
            'rules' => [
                'required',
                'alpha_space',
                'max_length[40]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'alpha_space' => 'El campo {field} solo puede contener letras y espacios.',
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
                'alpha_space',
                'max_length[50]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'alpha_space' => 'El campo {field} solo puede contener letras y espacios.',
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
                'valid_email' => 'Por favor, introduce una dirección de correo válida.',
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
                'alpha_space',
                'max_length[20]'
            ],
            'errors' => [
                'required'    => 'El campo {field} es obligatorio.',
                'alpha_space' => 'El campo {field} solo puede contener letras y espacios.',
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

        





    ];
  
    // --------------------------------------------------------------------
}
