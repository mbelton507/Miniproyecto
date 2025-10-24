<?php
// problemas/problema6.php
include_once '../includes/funciones.php';

$resultado = "";
$grafica = "";
$presupuestoAreas = [
    "Ginecología" => 0.40,
    "Traumatología" => 0.35,
    "Pediatría" => 0.25
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $presupuesto = limpiarEntrada($_POST["presupuesto"] ?? '');

    if (!esNumeroValido($presupuesto) || $presupuesto <= 0) {
        $resultado = "<div class='alert alert-danger'>❌ Ingrese un presupuesto válido (número positivo).</div>";
    } else {
        $presupuesto = (float)$presupuesto;

        $resultado = "
        <div class='alert alert-success'>
            <h4>🏥 Distribución del presupuesto:</h4>
            <table class='table table-bordered text-center'>
                <thead class='table-light'>
                    <tr>
                        <th>Área</th>
                        <th>Porcentaje</th>
                        <th>Monto Asignado ($)</th>
                    </tr>
                </thead>
                <tbody>
        ";

        $labels = [];
        $montos = [];

        foreach ($presupuestoAreas as $area => $porcentaje) {
            $monto = $presupuesto * $porcentaje;
            $resultado .= "<tr><td>$area</td><td>" . ($porcentaje * 100) . "%</td><td>" . number_format($monto, 2) . "</td></tr>";
            $labels[] = $area;
            $montos[] = $monto;
        }

        $resultado .= "
                </tbody>
            </table>
            <p><strong>Presupuesto total:</strong> $" . number_format($presupuesto, 2) . "</p>
        </div>";

        // Datos para la gráfica
        $grafica = "
        <div class='card mt-4 p-3 shadow-sm'>
            <h5 class='text-center'>📊 Distribución Gráfica del Presupuesto</h5>
            <canvas id='graficoPresupuesto'></canvas>
        </div>

        <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
        <script>
            const ctx = document.getElementById('graficoPresupuesto');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: " . json_encode($labels) . ",
                    datasets: [{
                        label: 'Distribución del presupuesto',
                        data: " . json_encode($montos) . ",
                        backgroundColor: ['#f28e2b', '#4e79a7', '#76b7b2']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 6 - Presupuesto Hospitalario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center">Problema #6 - Presupuesto Hospitalario</h2>

    <form method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 500px;">
        <p class="text-muted">Ingrese el presupuesto anual total del hospital:</p>
        <input type="number" name="presupuesto" class="form-control mb-3" placeholder="Ejemplo: 100000" min="1" step="any" required>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Calcular Distribución</button>
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
