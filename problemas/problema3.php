<?php
require_once "../includes/funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
     <link rel="stylesheet" href="../estilos.css">
    <meta charset="UTF-8">
    <title>Problema 3</title>
</head>
<body>
<h2>Problema #3 - N primeros múltiplos de 4</h2>
<form method="post">
    <label>Ingrese N:</label>
    <input type="number" name="n" required>
    <input type="submit" value="Mostrar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $n = (int) $_POST['n'];
    echo "<p>Múltiplos de 4:</p>";
    for ($i = 1; $i <= $n; $i++) {
        echo "4 × $i = " . (4 * $i) . "<br>";
    }
}

volverMenu();
include "../Footer.php";
?>
</body>
</html>
