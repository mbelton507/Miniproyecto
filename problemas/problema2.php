<?php
// problemas/problema2.php
include_once '../includes/funciones.php';

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Validación del número final
    $valor = limpiarEntrada($_POST["limite"] ?? '');
    if (!esNumeroValido($valor) || $valor <= 0) {
        $resultado = "<div class='alert alert-danger'>❌ Ingrese un número positivo válido.</div>";
    } else {
        $n = (int)$valor;
        // Usamos la fórmula de Gauss: n(n+1)/2
        $suma = $n * ($n + 1) / 2;

        $resultado = "
        <div class='alert alert-success'>
            <h4>✅ Resultado:</h4>
            <p>La suma de los números del 1 al <strong>$n</strong> es: <strong>$suma</strong></p>
        </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 2 - Suma del 1 al 1000</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-center">Problema #2 - Suma de Números del 1 al 1000</h2>

    <form method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 500px;">
        <p class="text-muted">Ingrese un número límite (por defecto 1000):</p>
        <input type="number" name="limite" class="form-control mb-3" value="1000" min="1" required>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Calcular Suma</button>
            <a href="../index.php" class="btn btn-secondary">Volver al menú</a>
        </div>
    </form>

    <div class="mt-4 text-center">
        <?= $resultado ?>
    </div>
</div>

<?php include '../Footer.php'; ?>
</body>
</html>
