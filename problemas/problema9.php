<?php
require_once "../includes/funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 9</title>
</head>
<link rel="stylesheet" href="../estilos.css">
<body>
<h2>Problema #9 - Potencias del número ingresado</h2>

<form method="post">
    <label>Ingrese un número entre 1 y 9:</label>
    <input type="number" name="numero" min="1" max="9" required>
    <input type="submit" value="Calcular">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero = (int)$_POST["numero"];

    if ($numero < 1 || $numero > 9) {
        echo "<p style='color:red;'>El número debe estar entre 1 y 9.</p>";
    } else {
        echo "<h3>Las 15 primeras potencias del número $numero son:</h3>";
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr><th>Exponente</th><th>Resultado</th></tr>";

        // Usamos un ciclo para recorrer y mostrar las potencias
        for ($i = 1; $i <= 15; $i++) {
            $potencia = pow($numero, $i);
            echo "<tr><td>$numero<sup>$i</sup></td><td>$potencia</td></tr>";
        }

        echo "</table>";
    }
}

volverMenu();
include "../Footer.php";
?>
</body>
</html>
