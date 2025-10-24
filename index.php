<?php
// index.php
include_once 'includes/funciones.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mini Proyecto </title>
    <link rel="stylesheet" href="estilos.css">
    <!-- Si usas Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <h1 class="text-center mb-4">Mini Proyecto </h1>
        <p class="text-center text-muted mb-5">Selecciona un problema para ejecutar</p>

        <div class="row g-4">
            <?php
            $problemas = [
                1 => "Media, desviación, min y max (5 números)",
                2 => "Suma del 1 al 1000",
                3 => "Múltiplos de 4",
                4 => "Suma pares/impares (1-200)",
                5 => "Clasificación de edades",
                6 => "Presupuesto hospitalario",
                7 => "Calculadora de notas",
                8 => "Estación del año",
                9 => "Potencias 1-15",
                10 => "Ventas (matriz 2D)"
            ];

            foreach ($problemas as $num => $desc) {
                echo "
                <div class='col-md-4'>
                    <div class='card shadow-sm h-100'>
                        <div class='card-body text-center'>
                            <h5 class='card-title'>Problema $num</h5>
                            <p class='card-text'>$desc</p>
                            <a href='problemas/problema$num.php' class='btn btn-primary'>Abrir Problema $num</a>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
        </div>
    </div>

    <?php include 'Footer.php'; ?>

</body>
</html>
