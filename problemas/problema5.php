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
<h2>Problema #5 - Clasificar edades</h2>
<form method="post">
    <?php for ($i = 1; $i <= 5; $i++): ?>
        <label>Edad <?= $i ?>:</label>
        <input type="number" name="edades[]" min="0" required><br>
    <?php endfor; ?>
    <input type="submit" value="Clasificar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $edades = $_POST['edades'];
    $categorias = ['Niño' => 0, 'Adolescente' => 0, 'Adulto' => 0, 'Adulto Mayor' => 0];

    foreach ($edades as $edad) {
        $edad = (int)$edad;
        if ($edad <= 12) $categorias['Niño']++;
        elseif ($edad <= 17) $categorias['Adolescente']++;
        elseif ($edad <= 64) $categorias['Adulto']++;
        else $categorias['Adulto Mayor']++;
    }

    echo "<h3>Clasificación:</h3>";
    foreach ($categorias as $cat => $cant) {
        echo "$cat: $cant<br>";
    }
}

volverMenu();
include "../Footer.php";
?>
</body>
</html>
