<?php
// includes/funciones.php

function limpiarEntrada($valor) {
    return htmlspecialchars(trim($valor));
}

function esNumeroValido($valor) {
    return preg_match('/^[0-9]+(\.[0-9]+)?$/', $valor);
}

function volverMenu() {
    echo "<br><a href='../index.php'>Volver al menú principal</a>";
}

?>
