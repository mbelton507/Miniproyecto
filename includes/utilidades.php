<?php
// includes/ClaseUtilidades.php

class ClaseUtilidades {

    public static function calcularMedia($numeros) {
        return array_sum($numeros) / count($numeros);
    }

    public static function calcularDesviacionEstandar($numeros) {
        $media = self::calcularMedia($numeros);
        $suma = 0;
        foreach ($numeros as $n) {
            $suma += pow($n - $media, 2);
        }
        return sqrt($suma / count($numeros));
    }

    public static function numeroMinimo($numeros) {
        return min($numeros);
    }

    public static function numeroMaximo($numeros) {
        return max($numeros);
    }
}
?>
