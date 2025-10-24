<?php
// includes/ClaseUtilidades.php

class ClaseUtilidades {

    // Calcula la media (promedio) de un arreglo de números
    public static function calcularMedia($numeros) {
        return array_sum($numeros) / count($numeros);
    }

    // Calcula la desviación estándar de un arreglo de números
    public static function calcularDesviacionEstandar($numeros) {
        $media = self::calcularMedia($numeros);
        $suma = 0;
        foreach ($numeros as $n) {
            $suma += pow($n - $media, 2);
        }
        return sqrt($suma / count($numeros));
    }

    // Devuelve el número mínimo del arreglo
    public static function numeroMinimo($numeros) {
        return min($numeros);
    }

    // Devuelve el número máximo del arreglo 
    public static function numeroMaximo($numeros) {
        return max($numeros);
    }
}
?>
