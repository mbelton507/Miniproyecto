<?php
require_once "../includes/funciones.php";
require_once "../includes/utilidades.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Problema 10 - Ventas por Vendedor y Producto</title>
    <link rel="stylesheet" href="../estilos.css">
    <style>
        table {
            border-collapse: collapse;
            margin-top: 20px;
            width: 80%;
        }
        th, td {
            border: 1px solid #555;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #2980b9;
            color: white;
        }
        tfoot td {
            font-weight: bold;
            background-color: #ecf0f1;
        }
    </style>
</head>
<body>
    <h2>Problema #10 - Resumen de ventas por vendedor y producto</h2>

    <?php
    // Inicializamos la matriz de ventas (5 productos x 4 vendedores)
    $ventas = array_fill(0, 5, array_fill(0, 4, 0));

    // Simulamos datos de ejemplo (en la práctica podrían venir de un formulario o archivo)
    // Cada registro: [vendedor, producto, monto]
    $registros = [
        [1, 1, 1200], [1, 3, 800], [2, 2, 500],
        [2, 3, 1500], [3, 1, 900], [3, 5, 400],
        [4, 2, 700], [4, 4, 1000], [1, 5, 300],
        [2, 5, 1200], [3, 4, 750], [4, 3, 950]
    ];

    // Procesamos los registros y llenamos la matriz
    foreach ($registros as $r) {
        $vendedor = $r[0] - 1; // índice 0–3
        $producto = $r[1] - 1; // índice 0–4
        $monto = $r[2];
        $ventas[$producto][$vendedor] += $monto;
    }

    // Calculamos totales por producto (filas) y por vendedor (columnas)
    $totalesVendedores = array_fill(0, 4, 0);
    $totalesProductos = array_fill(0, 5, 0);
    $totalGeneral = 0;

    echo "<table>";
    echo "<tr><th>Producto</th>";
    for ($v = 1; $v <= 4; $v++) echo "<th>Vendedor $v</th>";
    echo "<th>Total Producto</th></tr>";

    for ($p = 0; $p < 5; $p++) {
        echo "<tr><td>Producto " . ($p + 1) . "</td>";
        $sumaProducto = 0;
        for ($v = 0; $v < 4; $v++) {
            $valor = $ventas[$p][$v];
            echo "<td>$" . number_format($valor, 2) . "</td>";
            $sumaProducto += $valor;
            $totalesVendedores[$v] += $valor;
        }
        $totalesProductos[$p] = $sumaProducto;
        echo "<td><strong>$" . number_format($sumaProducto, 2) . "</strong></td></tr>";
    }

    // Fila de totales
    echo "<tfoot><tr><td><strong>Total Vendedor</strong></td>";
    foreach ($totalesVendedores as $t) {
        echo "<td><strong>$" . number_format($t, 2) . "</strong></td>";
        $totalGeneral += $t;
    }
    echo "<td><strong>$" . number_format($totalGeneral, 2) . "</strong></td></tr></tfoot>";
    echo "</table>";

    volverMenu();
    include "../Footer.php";
    ?>
</body>
</html>
