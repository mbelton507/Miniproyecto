<?php
// problemas/problema8.php
include_once '../includes/funciones.php';

$resultado = "";

// Cuando el usuario envía la fecha
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fechaIngresada = limpiarEntrada($_POST["fecha"] ?? '');

    if (empty($fechaIngresada)) {
        $resultado = "<div class='alert alert-danger'>❌ Por favor ingrese una fecha válida.</div>";
    } else {
        $fecha = new DateTime($fechaIngresada);
        $mes = (int)$fecha->format('m');
        $dia = (int)$fecha->format('d');

        // Determinar estación del año según la tabla correcta
        $estacion = "";
        $imagen = "";

        if (($mes == 12 && $dia >= 21) || $mes == 1 || $mes == 2 || ($mes == 3 && $dia <= 20)) {
            $estacion = "☀️ Verano";
            $imagen = "../imagenes/verano.png";
        } elseif (($mes == 3 && $dia >= 21) || $mes == 4 || $mes == 5 || ($mes == 6 && $dia <= 21)) {
            $estacion = "🍂 Otoño";
            $imagen = "../imagenes/otoño.png"; 
        } elseif (($mes == 6 && $dia >= 22) || $mes == 7 || $mes == 8 || ($mes == 9 && $dia <= 22)) {
            $estacion = "❄️ Invierno";
            $imagen = "../imagenes/invierno.png";
        } else {
            $estacion = "🌸 Primavera";
            $imagen = "../imagenes/primavera.png";
        }

        // Mostrar resultado con tabla + imagen
        $resultado = "
        <div class='alert alert-success'>
            <h4>📆 Resultado</h4>
            <table class='table table-bordered text-center'>
                <thead class='table-light'>
                    <tr>
                        <th>Fecha Ingresada</th>
                        <th>Estación del Año</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>" . htmlspecialchars($fecha->format('d/m/Y')) . "</td>
                        <td><strong>$estacion</strong></td>
                    </tr>
                </tbody>
            </table>
            <div class='text-center'>
                <img src='$imagen' alt='$estacion' class='img-fluid rounded shadow' style='max-width: 400px;'>
            </div>
        </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 8 - Estación del Año</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center">Problema #8 - Estación del Año</h2>

    <form method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 500px;">
        <p class="text-muted">Seleccione una fecha para saber a qué estación del año pertenece:</p>
        <input type="date" name="fecha" class="form-control mb-3" required>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Ver Estación</button>
            <a href="../index.php" class="btn btn-secondary">Volver al menú</a>
        </div>
    </form>

    <div class="mt-4">
        <?= $resultado ?>
    </div>
</div>

<?php include '../Footer.php'; ?>
</body>
</html>
