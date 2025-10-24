<?php
include_once '../includes/funciones.php';

$resultado = "";

// Inicializar matriz de ventas [productos][vendedores]
$ventas = array_fill(0, 5, array_fill(0, 4, 0));

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errores = [];

    // Validar entradas
    for ($p = 1; $p <= 5; $p++) {
        for ($v = 1; $v <= 4; $v++) {
            $campo = "venta{$p}_{$v}";
            $valor = limpiarEntrada($_POST[$campo] ?? '');

            if (!is_numeric($valor) || $valor < 0) {
                $errores[] = "❌ Valor inválido en Producto $p - Vendedor $v.";
            } else {
                $ventas[$p - 1][$v - 1] = (float)$valor;
            }
        }
    }

    // Mostrar resultados si no hay errores
    if (empty($errores)) {
        $resultado .= "<div class='alert alert-success'>
            <h4 class='text-center'>📊 Resumen de Ventas Mensuales</h4>
            <table class='table table-bordered text-center align-middle'>
                <thead class='table-dark'>
                    <tr>
                        <th>Producto</th>";

        for ($v = 1; $v <= 4; $v++) {
            $resultado .= "<th>Vendedor $v</th>";
        }

        $resultado .= "<th>Total Producto</th></tr></thead><tbody>";

        // Calcular totales por producto
        $totalVendedores = array_fill(0, 4, 0);
        $granTotal = 0;

        for ($p = 0; $p < 5; $p++) {
            $resultado .= "<tr><td><strong>Producto " . ($p + 1) . "</strong></td>";
            $sumaFila = 0;

            for ($v = 0; $v < 4; $v++) {
                $valor = $ventas[$p][$v];
                $sumaFila += $valor;
                $totalVendedores[$v] += $valor;
                $resultado .= "<td>$" . number_format($valor, 2) . "</td>";
            }

            $granTotal += $sumaFila;
            $resultado .= "<td class='table-secondary'><strong>$" . number_format($sumaFila, 2) . "</strong></td></tr>";
        }

        // Totales por vendedor
        $resultado .= "<tr class='table-primary'><th>Total Vendedor</th>";
        foreach ($totalVendedores as $t) {
            $resultado .= "<th>$" . number_format($t, 2) . "</th>";
        }
        $resultado .= "<th class='table-success'>$" . number_format($granTotal, 2) . "</th></tr>";

        $resultado .= "</tbody></table></div>";
    } else {
        $resultado = "<div class='alert alert-danger'><ul>";
        foreach ($errores as $e) {
            $resultado .= "<li>$e</li>";
        }
        $resultado .= "</ul></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 10 - Ventas Bidimensionales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center">Problema #10 - Ventas por Producto y Vendedor</h2>

    <form method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 700px;">
        <p class="text-muted text-center">Ingrese el valor vendido ($) por cada producto y vendedor:</p>

        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>Producto</th>
                    <?php for ($v = 1; $v <= 4; $v++): ?>
                        <th>Vendedor <?= $v ?></th>
                    <?php endfor; ?>
                </tr>
            </thead>
            <tbody>
                <?php for ($p = 1; $p <= 5; $p++): ?>
                    <tr>
                        <td><strong>Producto <?= $p ?></strong></td>
                        <?php for ($v = 1; $v <= 4; $v++): ?>
                            <td>
                                <input type="number" name="venta<?= $p ?>_<?= $v ?>" class="form-control text-center" min="0" step="0.01" required>
                            </td>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Calcular Totales</button>
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
