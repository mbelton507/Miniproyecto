<?php
require_once "../includes/funciones.php";
require_once "../includes/utilidades.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 2 - Suma de Pares e Impares</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    <h2>Problema #2 - Suma de números pares e impares del 1 al 200</h2>

    <?php
    // Inicializamos variables
    $sumaPares = 0;
    $sumaImpares = 0;

    // Recorremos los números del 1 al 200
    for ($i = 1; $i <= 200; $i++) {
        if ($i % 2 == 0) {
            $sumaPares += $i;
        } else {
            $sumaImpares += $i;
        }
    }

    // Mostramos resultados
    echo "<p>La suma de los números <strong>pares</strong> entre 1 y 200 es: <strong>$sumaPares</strong></p>";
    echo "<p>La suma de los números <strong>impares</strong> entre 1 y 200 es: <strong>$sumaImpares</strong></p>";

    volverMenu();
    include "../Footer.php";
    ?>
</body>
</html>
