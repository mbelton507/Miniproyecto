<?php
// problemas/problema3.php
include_once '../includes/funciones.php';

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $valor = limpiarEntrada($_POST["limite"] ?? '');

    // Validar número positivo
    if (!esNumeroValido($valor) || $valor <= 0) {
        $resultado = "<div class='alert alert-danger'>❌ Ingrese un número entero positivo válido.</div>";
    } else {
        $n = (int)$valor;
        $multiplo = 4;
        $lista = [];

        // Evitar desbordamiento si el número es muy grande
        if ($n > 100000) {
            $resultado = "<div class='alert alert-warning'>⚠️ Valor demasiado grande. Ingrese un número menor o igual a 100,000.</div>";
        } else {
            for ($i = 1; $i <= $n; $i++) {
                $lista[] = "4 × $i = " . ($multiplo * $i);
            }

            // Mostrar resultados
            $resultado = "<div class='alert alert-success'><h4>✅ Resultados:</h4>";
            $resultado .= "<p>Primeros <strong>$n</strong> múltiplos de 4:</p><ul>";
            foreach ($lista as $linea) {
                $resultado .= "<li>$linea</li>";
            }
            $resultado .= "</ul></div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 3 - Múltiplos de 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-center">Problema #3 - N primeros múltiplos de 4</h2>

    <form method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 500px;">
        <p class="text-muted">Ingrese la cantidad de múltiplos que desea generar:</p>
        <input type="number" name="limite" class="form-control mb-3" placeholder="Ejemplo: 10" min="1" required>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Generar Múltiplos</button>
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
