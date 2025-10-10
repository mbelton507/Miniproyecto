<?php
require_once "../includes/funciones.php";
require_once "../includes/utilidades.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="../estilos.css">


    <meta charset="UTF-8">
    <title>Problema 1</title>
</head>
<body>
    <h2>Problema #1 - Estadísticas de 5 Números</h2>

    <form method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <label>Número <?= $i ?>:</label>
            <input type="text" name="numero[]" required><br>
        <?php endfor; ?>
        <input type="submit" value="Calcular">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $valores = array_map('limpiarEntrada', $_POST['numero']);
        $numerosValidos = [];

        foreach ($valores as $v) {
            if (esNumeroValido($v)) {
                $numerosValidos[] = (float)$v;
            }
        }

        if (count($numerosValidos) === 5) {
            echo "<p>Media: " . ClaseUtilidades::calcularMedia($numerosValidos) . "</p>";
            echo "<p>Desviación estándar: " . ClaseUtilidades::calcularDesviacionEstandar($numerosValidos) . "</p>";
            echo "<p>Mínimo: " . ClaseUtilidades::numeroMinimo($numerosValidos) . "</p>";
            echo "<p>Máximo: " . ClaseUtilidades::numeroMaximo($numerosValidos) . "</p>";
        } else {
            echo "<p style='color:red;'>Todos los campos deben ser números válidos.</p>";
        }
    }

   
volverMenu();
include "../Footer.php";
?>

</body>
</html>
