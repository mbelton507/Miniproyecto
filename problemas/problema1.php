<?php
// problemas/problema1.php
include_once '../includes/funciones.php';
include_once '../includes/utilidades.php'; 

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capturamos los 5 números
    $numeros = [];
    for ($i = 1; $i <= 5; $i++) {
        $campo = "num$i";
        $valor = limpiarEntrada($_POST[$campo] ?? '');
        if (!esNumeroValido($valor) || $valor <= 0) {
            $resultado = "<div class='alert alert-danger'>❌ Todos los valores deben ser números positivos válidos.</div>";
            $numeros = [];
            break;
        }
        $numeros[] = (float)$valor;
    }

    if (count($numeros) === 5) {
        // ✅ Usamos los métodos de la clase utilitaria
        $media = ClaseUtilidades::calcularMedia($numeros);
        $desviacion = ClaseUtilidades::calcularDesviacionEstandar($numeros);
        $min = ClaseUtilidades::numeroMinimo($numeros);
        $max = ClaseUtilidades::numeroMaximo($numeros);

        $resultado = "
        <div class='alert alert-success'>
            <h4>📊 Resultados:</h4>
            <p><strong>Media:</strong> " . round($media, 2) . "</p>
            <p><strong>Desviación estándar:</strong> " . round($desviacion, 2) . "</p>
            <p><strong>Mínimo:</strong> $min</p>
            <p><strong>Máximo:</strong> $max</p>
        </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 1 - Media y Desviación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-center">Problema #1 - Cálculo de Media y Desviación Estándar</h2>

    <form method="POST" class="card p-4 shadow-sm">
        <p class="text-muted">Ingrese los 5 primeros números positivos:</p>
        <div class="row g-3">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <div class="col-md-2">
                    <input type="number" name="num<?= $i ?>" class="form-control" placeholder="N° <?= $i ?>" min="1" step="any" required>
                </div>
            <?php endfor; ?>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-success">Calcular</button>
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
