<?php
// problemas/problema4.php
include_once '../includes/funciones.php';

$resultado = "";

// Solo procesar cuando se presione el botón
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $limite = limpiarEntrada($_POST["limite"] ?? '');

    // Validación del número
    if (!esNumeroValido($limite) || $limite <= 0) {
        $resultado = "<div class='alert alert-danger'>❌ Ingrese un número entero positivo válido.</div>";
    } 
    elseif ($limite > 200) {
        // Si el valor supera 200, solo mostrar mensaje
        $resultado = "<div class='alert alert-warning'>⚠️ El número ingresado supera el límite permitido (200). No se realizará el cálculo.</div>";
    } 
    else {
        $n = (int)$limite;
        $sumaPares = 0;
        $sumaImpares = 0;

        for ($i = 1; $i <= $n; $i++) {
            if ($i % 2 == 0) {
                $sumaPares += $i;
            } else {
                $sumaImpares += $i;
            }
        }

        $resultado = "
        <div class='alert alert-success'>
            <h4>✅ Resultados:</h4>
            <p><strong>Límite:</strong> $n</p>
            <p><strong>Suma de números pares:</strong> $sumaPares</p>
            <p><strong>Suma de números impares:</strong> $sumaImpares</p>
        </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 4 - Suma de pares e impares</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-center">Problema #4 - Suma de números pares e impares</h2>

    <form method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 500px;">
        <p class="text-muted">Ingrese el número límite (por defecto 200):</p>
        <input type="number" name="limite" class="form-control mb-3" value="200" min="1" required>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Calcular</button>
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
