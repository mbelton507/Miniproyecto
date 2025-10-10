<?php
require_once "../includes/funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
     <link rel="stylesheet" href="../estilos.css">
    <meta charset="UTF-8">
    <title>Problema 5</title>
</head>
<body>
<h2>Problema #6 - Presupuesto Hospital</h2>
<form method="post">
    <label>Presupuesto anual ($):</label>
    <input type="number" name="presupuesto" step="0.01" required>
    <input type="submit" value="Calcular">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $p = (float)$_POST['presupuesto'];
    $gine = $p * 0.40;
    $trauma = $p * 0.35;
    $pedia = $p * 0.25;

    echo "<p>Ginecología: $" . number_format($gine, 2) . "</p>";
    echo "<p>Traumatología: $" . number_format($trauma, 2) . "</p>";
    echo "<p>Pediatría: $" . number_format($pedia, 2) . "</p>";
}

volverMenu();
include "../Footer.php";
?>
</body>
</html>
