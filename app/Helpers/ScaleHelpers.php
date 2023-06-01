<?php

namespace App\Helpers;

class ScaleHelpers {
    public static function erf($x) {

        //https://www.php.net/manual/en/function.stats-stat-percentile.php#88558
        $pi = pi();

        $a = (8 * ($pi - 3)) / (3 * $pi * (4 - $pi));
        $x2 = $x * $x;
        $ax2 = $a * $x2;

        $num = (4/$pi) + $ax2;
        $denom = 1 + $ax2;

        $inner = (-$x2) * $num/$denom;
        $erf2 = 1 - exp($inner);

        return sqrt($erf2);
    }

    public static function cdf($n) {
        if ($n < 0) {
            return (1 - self::erf($n / sqrt(2))) / 2;
        } else {
            return (1 + self::erf($n / sqrt(2))) / 2;
        }
    }
}