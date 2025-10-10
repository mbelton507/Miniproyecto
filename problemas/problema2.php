<?php
require_once "../includes/funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
     <link rel="stylesheet" href="../estilos.css">
    <meta charset="UTF-8">
    <title>Problema 2</title>
</head>
<body>
<h2>Problema #2 - Suma del 1 al 1000</h2>

<?php
$suma = 0;
for ($i = 1; $i <= 1000; $i++) {
    $suma += $i;
}
echo "<p>La suma de 1 a 1000 es: $suma</p>";

volverMenu();
include "../Footer.php";
?>
</body>
</html>
