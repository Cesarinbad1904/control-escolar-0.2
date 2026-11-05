<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
</head>
<body>
     <table border="1">
        <tr>
            <td>Nombre</td>
            <td>Grupo</td>
        </tr>
     <?php foreach($alumnos as $key => $p) : ?>
        <tr>
            <td>
                <?= $p->nombre_alumno ?>
            </td>

            <td>
                <?= $p->grado ?> <?= $p->grupo ?> 
            </td>

            
        </tr>
       <?php endforeach ?>
     </table>
</body>
</html>