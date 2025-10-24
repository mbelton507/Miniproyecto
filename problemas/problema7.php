<?php
// problemas/problema7.php
include_once '../includes/funciones.php';
include_once '../includes/utilidades.php'; // clase con métodos matemáticos

$resultado = "";
$cantidad = 0;
$notas = [];

// Paso 1: elegir cantidad de notas
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'set_cantidad') {
    $cantidad = (int)limpiarEntrada($_POST['cantidad'] ?? 0);
    if ($cantidad <= 0 || $cantidad > 200) {
        $resultado = "<div class='alert alert-danger'>❌ Ingrese una cantidad válida (1 - 200).</div>";
        $cantidad = 0;
    }
}

// Paso 2: enviar notas
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'submit_notas') {
    $cantidad = (int)limpiarEntrada($_POST['cantidad'] ?? 0);

    for ($i = 1; $i <= $cantidad; $i++) {
        $campo = "nota$i";
        $valor = limpiarEntrada($_POST[$campo] ?? '');

        if ($valor === '' || !is_numeric($valor)) {
            $resultado = "<div class='alert alert-danger'>❌ Por favor, ingrese solo números válidos en todas las notas.</div>";
            $notas = [];
            break;
        }

        if ((float)$valor < 0) {
            $resultado = "<div class='alert alert-danger'>❌ Las notas no pueden ser negativas.</div>";
            $notas = [];
            break;
        }

        $notas[] = (float)$valor;
    }

    if (count($notas) === $cantidad && $cantidad > 0) {
        $promedio = ClaseUtilidades::calcularMedia($notas);
        $desviacion = ClaseUtilidades::calcularDesviacionEstandar($notas);
        $minima = ClaseUtilidades::numeroMinimo($notas);
        $maxima = ClaseUtilidades::numeroMaximo($notas);

        $resultado = "
        <div class='alert alert-success mt-4'>
            <h4>📊 Resultados (sobre $cantidad notas):</h4>
            <p><strong>Promedio:</strong> " . number_format($promedio, 2) . "</p>
            <p><strong>Desviación estándar:</strong> " . number_format($desviacion, 2) . "</p>
            <p><strong>Nota mínima:</strong> " . number_format($minima, 2) . "</p>
            <p><strong>Nota máxima:</strong> " . number_format($maxima, 2) . "</p>
        </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 7 - Cálculos Estadísticos</title>
    <!-- ✅ Igual que Problema 1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-center">Problema #7 - Cálculos Estadísticos</h2>

    <!-- Paso 1: seleccionar cantidad -->
    <?php if ($cantidad === 0 && (!isset($_POST['action']) || $_POST['action'] !== 'submit_notas')): ?>
        <form method="post" class="card p-4 shadow-sm mx-auto" style="max-width: 500px;">
            <input type="hidden" name="action" value="set_cantidad">
            <div class="mb-3">
                <label for="cantidad" class="form-label">¿Cuántas notas desea ingresar?</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" max="200" value="5" required>
                <div class="form-text">Ingrese un número entre 1 y 200.</div>
            </div>
            <div class="mt-3 text-center">
                <button type="submit" class="btn btn-success">Continuar</button>
                <a href="../index.php" class="btn btn-secondary">Volver al menú</a>
            </div>
        </form>
    <?php endif; ?>

    <!-- Paso 2: formulario de notas -->
    <?php if ($cantidad > 0): ?>
        <form method="post" class="card p-4 shadow-sm mx-auto mt-4" style="max-width: 500px;">
            <input type="hidden" name="action" value="submit_notas">
            <input type="hidden" name="cantidad" value="<?= $cantidad ?>">

            <p class="text-muted mb-3 text-center">Ingrese las <?= $cantidad ?> notas:</p>

            <?php for ($i = 1; $i <= $cantidad; $i++): 
                $valorPrevio = $_POST["nota$i"] ?? '';
            ?>
                <div class="mb-3">
                    <label for="nota<?= $i ?>" class="form-label">Nota <?= $i ?>:</label>
                    <input type="number" name="nota<?= $i ?>" id="nota<?= $i ?>" class="form-control" placeholder="Ingrese nota <?= $i ?>" min="0" step="any" value="<?= htmlspecialchars($valorPrevio) ?>" required>
                </div>
            <?php endfor; ?>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-success">Calcular</button>
                <a href="problema7.php" class="btn btn-warning">Cambiar cantidad</a>
                <a href="../index.php" class="btn btn-secondary">Volver al menú</a>
            </div>
        </form>
    <?php endif; ?>

    <!-- Resultados -->
    <div class="mt-4 text-center">
        <?= $resultado ?>
    </div>
</div>

<?php include '../Footer.php'; ?>
</body>
</html>
