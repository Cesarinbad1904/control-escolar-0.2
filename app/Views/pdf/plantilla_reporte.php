<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
<!--  esc() es una función global nativa de CodeIgniter 4 que significa escape 
  (escapar). Su propósito es proteger contra ataques XSS (Cross-Site Scripting) -->
    <title><?= esc($titulo) ?></title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        h1 { color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1><?= esc($titulo) ?></h1>
    <p>Fecha de emisión: <?= esc($fecha) ?></p>
    <table>
        <thead>
            <tr>
                <th>Concepto</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Servicio de consultoría</td>
                <td>$1,500.00</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
