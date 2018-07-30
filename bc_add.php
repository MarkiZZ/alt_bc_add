<?php

/**
 * О валидации речи не шло, следовательно предполагаем, что приходят корректные данные - целые числа со знаком.
 * @param string $a
 * @param string $b
 * @return string
 */
function alt_bc_add(string $a, string $b) : string
{
    if ($a == '0') {
        return $b;
    } else if ($b == '0') {
        return $a;
    }

    $signA = 1;
    if ($a[0] == '-') {
        $signA = -1;
        $a = ltrim($a, '-');
    } else if ($a[0] == '+') {
        $a = ltrim($a, '+');
    }

    $signB = 1;
    if ($b[0] == '-') {
        $signB = -1;
        $b = ltrim($b, '-');
    } else if ($b[0] == '+') {
        $b = ltrim($b, '+');
    }

    if ($signA == $signB) {
        if (strlen($b) < strlen($a)) {
            $b = str_pad($b, strlen($a), '0', STR_PAD_LEFT);
        } else if (strlen($a) < strlen($b)) {
            $a = str_pad($a, strlen($b), '0', STR_PAD_LEFT);
        }

        $shift = 0;
        for ($i = strlen($a) - 1; $i >= 0; $i--) {
            $current = $a[$i] + $b[$i] + $shift;

            $a[$i] = $current % 10;
            $shift = $current >= 10 ? 1 : 0;
        }
        if ($shift) {
            $a = '1' . $a;
        }

        if ($signA < 0) {
            $a = '-' . $a;
        }
    } else {
        if ($a == $b) {
            return '0';
        }

        // разность между модулем большего числа и модулем меньшего, знак результата по числу с большим модулем
        $sign = 1;
        if (strlen($a) > strlen($b)) {
            $min = $a;
            $sub = $b;
            $sign = $signA;
        } else if (strlen($b) > strlen($a)) {
            $min = $b;
            $sub = $a;
            $sign = $signB;
        } else {
            if ($a[0] > $b[0]) {
                $min = $a;
                $sub = $b;
                $sign = $signA;
            } else {
                $min = $b;
                $sub = $a;
                $sign = $signB;
            }
        }

        $shift = 0;
        $sub = str_pad($sub, strlen($min), '0', STR_PAD_LEFT);
        for ($i = strlen($min) - 1; $i >= 0; $i--) {
            if (($min[$i] - $shift) < $sub[$i]) {
                $min[$i] = ($min[$i] - $shift + 10) - $sub[$i];
                $shift = 1;
            } else {
                $min[$i] = $min[$i] - $shift - $sub[$i];
                $shift = 0;
            }
        }
        $a = ltrim($min, '0');

        if ($sign < 0) {
            $a = '-' . $a;
        }
    }

    return $a;
}