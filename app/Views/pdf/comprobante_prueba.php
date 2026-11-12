<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
<!--  esc() es una función global nativa de CodeIgniter 4 que significa escape 
  (escapar). Su propósito es proteger contra ataques XSS (Cross-Site Scripting) -->
    <title>Prueba PDF</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        h1 { color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1><?= esc($escuela->nombre) ?></h1>
    <h1><?= esc($alumno->nombre_alumno) ?></h1>
    <h1><?= esc($tutor->nombre_tutor) ?></h1>
    
    
</body>
</html>
