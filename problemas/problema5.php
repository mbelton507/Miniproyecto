<?php
// problemas/problema7.php
include_once '../includes/funciones.php';

$resultado = "";
$grafica = "";

// Cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cantidad = 5; // Se pide para 5 personas
    $edades = [];

    // Leer las edades del formulario
    for ($i = 1; $i <= $cantidad; $i++) {
        $edad = limpiarEntrada($_POST["edad_$i"] ?? '');
        if (!esNumeroValido($edad) || $edad < 0) {
            $resultado = "<div class='alert alert-danger'>⚠️ Ingrese edades válidas (números positivos).</div>";
            break;
        }
        $edades[] = (int)$edad;
    }

    if (count($edades) === $cantidad) {
        // Clasificación de categorías
        $categorias = [
            "Niño (0-12)" => 0,
            "Adolescente (13-17)" => 0,
            "Adulto (18-64)" => 0,
            "Adulto Mayor (65+)" => 0
        ];

        foreach ($edades as $edad) {
            if ($edad <= 12) $categorias["Niño (0-12)"]++;
            elseif ($edad <= 17) $categorias["Adolescente (13-17)"]++;
            elseif ($edad <= 64) $categorias["Adulto (18-64)"]++;
            else $categorias["Adulto Mayor (65+)"]++;
        }

        // Estadísticas de repetición de edades
        $repetidas = array_count_values($edades);
        arsort($repetidas);

        $resultado = "
        <div class='alert alert-success'>
            <h4>📋 Clasificación por Categorías</h4>
            <table class='table table-bordered text-center'>
                <thead class='table-light'>
                    <tr>
                        <th>Categoría</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($categorias as $nombre => $cantidadCat) {
            $resultado .= "<tr><td>$nombre</td><td>$cantidadCat</td></tr>";
        }
        $resultado .= "
                </tbody>
            </table>
            <h5 class='mt-3'>📊 Repeticiones de Edades</h5>
            <ul>";
        foreach ($repetidas as $edad => $reps) {
            $resultado .= "<li>Edad $edad años: $reps persona(s)</li>";
        }
        $resultado .= "</ul>
        </div>";

        // Gráfica con Chart.js
        $grafica = "
        <div class='card mt-4 p-3 shadow-sm'>
            <h5 class='text-center'>📈 Distribución por Categorías</h5>
            <canvas id='graficoEdades'></canvas>
        </div>

        <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
        <script>
            const ctx = document.getElementById('graficoEdades');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: " . json_encode(array_keys($categorias)) . ",
                    datasets: [{
                        label: 'Cantidad de Personas',
                        data: " . json_encode(array_values($categorias)) . ",
                        backgroundColor: ['#4e79a7', '#f28e2b', '#76b7b2', '#e15759']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        title: { display: true, text: 'Distribución de Personas por Categoría' }
                    },
                    scales: { y: { beginAtZero: true, stepSize: 1 } }
                }
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 7 - Clasificación de Edades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center">Problema #7 - Clasificación de Edades</h2>

    <!-- Formulario para ingresar las 5 edades -->
    <form method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 600px;">
        <p class="text-muted">Ingrese la edad de 5 personas para clasificarlas por categoría:</p>
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <div class="mb-2">
                <label for="edad_<?= $i ?>">Edad <?= $i ?>:</label>
                <input type="number" name="edad_<?= $i ?>" id="edad_<?= $i ?>" class="form-control" min="0" required>
            </div>
        <?php endfor; ?>
        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-success">Calcular</button>
            <a href="../index.php" class="btn btn-secondary">Volver al menú</a>
        </div>
    </form>

    <div class="mt-4">
        <?= $resultado ?>
        <?= $grafica ?>
    </div>
</div>

<?php include '../Footer.php'; ?>
</body>
</html>
