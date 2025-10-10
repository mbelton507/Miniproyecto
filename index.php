<?php
// index.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mini Proyecto PHP - Menú</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #2c3e50; }
        ul { list-style: none; padding: 0; }
        li { margin: 8px 0; }
        a { text-decoration: none; color: #2980b9; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Mini Proyecto PHP - Estructuras de Control y Clases</h1>
    <h2>Seleccione un problema:</h2>
    <ul>
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <li><a href="problemas/problema<?= $i ?>.php">Problema #<?= $i ?></a></li>

        <?php endfor; ?>
    </ul>
</body>
</html>
