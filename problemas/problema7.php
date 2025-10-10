<?php
require_once "../includes/funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <title>Problema 7</title>
</head>
  <link rel="stylesheet" href="../estilos.css">
<body>
<h2>Problema #7 - Calculadora de Datos Estadísticos</h2>

<form method="post">
    <label>Cantidad de notas a ingresar:</label>
    <input type="number" name="cantidad" min="1" required>
    <input type="submit" value="Continuar">
</form>

<?php
// Si el usuario ya indicó cuántas notas ingresará
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cantidad"]) && !isset($_POST["notas"])) {
    $cantidad = (int)$_POST["cantidad"];
    echo "<form method='post'>";
    echo "<input type='hidden' name='cantidad' value='{$cantidad}'>";
    echo "<h3>Ingrese las {$cantidad} notas:</h3>";

    for ($i = 1; $i <= $cantidad; $i++) {
        echo "<label>Nota #$i:</label> ";
        echo "<input type='number' name='notas[]' step='0.01' min='0' max='100' required><br><br>";
    }

    echo "<input type='submit' value='Calcular'>";
    echo "</form>";
}

// Si el usuario ya ingresó las notas
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["notas"])) {
    $notas = array_map('floatval', $_POST["notas"]);
    $cantidad = count($notas);

    // Cálculos estadísticos usando foreach
    $suma = 0;
    foreach ($notas as $n) {
        $suma += $n;
    }
    $promedio = $suma / $cantidad;

    $sumaDesv = 0;
    foreach ($notas as $n) {
        $sumaDesv += pow($n - $promedio, 2);
    }
    $desviacion = sqrt($sumaDesv / $cantidad);

    $minima = min($notas);
    $maxima = max($notas);

    echo "<h3>Resultados Estadísticos</h3>";
    echo "<p>Promedio: <strong>" . number_format($promedio, 2) . "</strong></p>";
    echo "<p>Desviación Estándar: <strong>" . number_format($desviacion, 2) . "</strong></p>";
    echo "<p>Nota Mínima: <strong>" . number_format($minima, 2) . "</strong></p>";
    echo "<p>Nota Máxima: <strong>" . number_format($maxima, 2) . "</strong></p>";
}

volverMenu();
include "../Footer.php";
?>
</body>
</html>
