<?php 

function datosCurp(string $curp): array 
{
    // 1. Asegurar que la CURP esté en mayúsculas para evitar fallas en las comparaciones
    $curp = strtoupper(trim($curp));

    // 2. Extraer datos con substr
    $sexo_letra  = substr($curp, 10, 1);
    $anio_nac    = (int) substr($curp, 4, 2);
    $mes_nac     = substr($curp, 6, 2);
    $dia_nac     = substr($curp, 8, 2);
    $entidad     = substr($curp, 11, 2);

    // 3. Mapeo de sexo (Uso de Match, disponible desde PHP 8.0)
    $sexo = match ($sexo_letra) {
        'M'     => 'MUJER',
        'H'     => 'HOMBRE',
        default => 'DESCONOCIDO'
    };

    // 4. Convertir año a 4 dígitos usando el año actual dinámicamente
    $anioActualShort = (int) date('y'); 
    $anio_nac += ($anio_nac <= $anioActualShort) ? 2000 : 1900;

    $fecha_nacimiento = "$anio_nac-$mes_nac-$dia_nac";

    // 5. Mapeo de Entidades Federativas mediante un arreglo (reemplaza el switch gigante)
    $entidades = [
        'AS' => 'AGUASCALIENTES',      'BC' => 'BAJA CALIFORNIA',     'BS' => 'BAJA CALIFORNIA SUR',
        'CC' => 'CAMPECHE',            'CL' => 'COAHUILA',            'CM' => 'COLIMA',
        'CS' => 'CHIAPAS',             'CH' => 'CHIHUAHUA',           'DF' => 'DISTRITO FEDERAL',
        'DG' => 'DURANGO',             'GT' => 'GUANAJUATO',          'GR' => 'GUERRERO',
        'HG' => 'HIDALGO',             'JC' => 'JALISCO',             'MC' => 'MEXICO',
        'MN' => 'MICHOACAN',           'MS' => 'MORELOS',             'NT' => 'NAYARIT',
        'NL' => 'NUEVO LEON',          'OC' => 'OAXACA',              'PL' => 'PUEBLA',
        'QT' => 'QUERETARO',           'QR' => 'QUINTANA ROO',        'SP' => 'SAN LUIS POTOSI',
        'SL' => 'SINALOA',             'SR' => 'SONORA',              'TC' => 'TABASCO',
        'TS' => 'TAMAULIPAS',          'TL' => 'TLAXCALA',            'VZ' => 'VERACRUZ',
        'YN' => 'YUCATAN',             'ZS' => 'ZACATECAS',           'NE' => 'NACIDO EN EL EXTRANJERO'
    ];

    $entidad_nac = $entidades[$entidad] ?? 'DESCONOCIDA';

    // 6. Retornar arreglo asociativo para que sea más fácil leer los datos
    return [
        'sexo'             => $sexo,
        'fecha_nacimiento' => $fecha_nacimiento,
        'entidad_nac'      => $entidad_nac
    ];
}


// ============== Función edad  (Actualizada 2026) ==================================
function edad($dianac, $mesnac, $anionac, $diaact, $mesact, $anioact): array {

// Nota: la variable $anionac se recibe en 2 dígitos y la variable $anioact son 4 dígitos (año completo)


// =================================================================================
    // Convertimos la variable $anonac a 4 dígitos ..
 $anioActual = (int)date('y'); // Obtiene los últimos dos dígitos del año actual (ej. 26)

 // Si el año de la CURP es menor o igual al año actual, es del 2000. Si no, es de 1900.
    if ($anionac <= $anioActual) {
        $anionac += 2000;
    } else {
        $anionac += 1900;
    }
//=================================================================================

$nacimiento = $anionac."-".$mesnac."-".$dianac;
$comparacion = $anioact."-".$mesact."-".$diaact;

$nacimiento_date = new DateTime($nacimiento);
$comparacion_date = new DateTime($comparacion);


// Calculamos la diferencia entre ambas fechas
    $diferencia = $nacimiento_date->diff($comparacion_date);

// Retornar arreglo asociativo para que sea más fácil leer los datos
 return [
        'anios' => $diferencia->y,
        'meses' => $diferencia->m,
        'dias' => $diferencia->d
    ];

  }

// ========================================================================================

?>