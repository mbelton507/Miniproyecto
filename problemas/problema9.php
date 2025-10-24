<?php
// problemas/problema9.php
include_once '../includes/funciones.php';

$resultado = "";

// Cuando el usuario envía el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero = limpiarEntrada($_POST["numero"] ?? '');

    if (!esNumeroValido($numero) || $numero < 1 || $numero > 9) {
        $resultado = "<div class='alert alert-danger'>❌ Ingrese un número válido entre 1 y 9.</div>";
    } else {
        $numero = (int)$numero;
        $potencias = [];

        // Calcular las 15 primeras potencias
        for ($i = 1; $i <= 15; $i++) {
            $potencias[$i] = pow($numero, $i);
        }

        // Mostrar tabla de resultados
        $resultado = "
        <div class='alert alert-success'>
            <h4>⚡ Potencias del número $numero</h4>
            <table class='table table-bordered text-center'>
                <thead class='table-light'>
                    <tr>
                        <th>Exponente</th>
                        <th>Resultado</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($potencias as $expo => $valor) {
            $resultado .= "<tr><td>$numero<sup>$expo</sup></td><td>$valor</td></tr>";
        }
        $resultado .= "
                </tbody>
            </table>
        </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 9 - Potencias del Número</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center">Problema #9 - Potencias del Número</h2>

    <!-- Formulario -->
    <form method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 500px;">
        <p class="text-muted">Ingrese un número entre 1 y 9 para calcular sus 15 primeras potencias:</p>
        <input type="number" name="numero" class="form-control mb-3" placeholder="Ejemplo: 4" min="1" max="9" required>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Calcular Potencias</button>
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
