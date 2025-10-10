<?php
require_once "../includes/funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 8</title>
</head>
 <link rel="stylesheet" href="../estilos.css">
<body>
<h2>Problema #8 - Estación del Año</h2>

<form method="post">
    <label>Ingrese una fecha:</label>
    <input type="date" name="fecha" required>
    <input type="submit" value="Calcular">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fecha = $_POST["fecha"];
    $mes = (int)date("n", strtotime($fecha)); // mes numérico (1 a 12)
    $dia = (int)date("j", strtotime($fecha)); // día del mes

    $estacion = "";

    // Verano: del 21 de diciembre al 20 de marzo
    if (($mes == 12 && $dia >= 21) || $mes == 1 || $mes == 2 || ($mes == 3 && $dia <= 20)) {
        $estacion = "Verano";
    }
    // Otoño: del 21 de marzo al 21 de junio
    elseif (($mes == 3 && $dia >= 21) || $mes == 4 || $mes == 5 || ($mes == 6 && $dia <= 21)) {
        $estacion = "Otoño";
    }
    // Invierno: del 22 de junio al 22 de septiembre
    elseif (($mes == 6 && $dia >= 22) || $mes == 7 || $mes == 8 || ($mes == 9 && $dia <= 22)) {
        $estacion = "Invierno";
    }
    // Primavera: del 23 de septiembre al 20 de diciembre
    elseif (($mes == 9 && $dia >= 23) || $mes == 10 || $mes == 11 || ($mes == 12 && $dia <= 20)) {
        $estacion = "Primavera";
    }

    echo "<h3>Resultado:</h3>";
    echo "<p>La fecha ingresada corresponde a la estación: <strong>$estacion</strong></p>";
}

volverMenu();
include "../Footer.php";
?>
</body>
</html>
