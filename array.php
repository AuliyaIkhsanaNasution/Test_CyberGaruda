<?php

function maxProduct($arr)
{
    $max1 = $max2 = PHP_INT_MIN;
    $min1 = $min2 = PHP_INT_MAX;

    foreach ($arr as $num) {
        // Cari dua nilai terbesar
        if ($num > $max1) {
            $max2 = $max1;
            $max1 = $num;
        } elseif ($num > $max2) {
            $max2 = $num;
        }

        // Cari dua nilai terkecil
        if ($num < $min1) {
            $min2 = $min1;
            $min1 = $num;
        } elseif ($num < $min2) {
            $min2 = $num;
        }
    }

    // Bandingkan produk dari dua nilai terbesar dan dua nilai terkecil
    return max($max1 * $max2, $min1 * $min2);
}

// Contoh penggunaan 1
$arr1 = array(1, 20, 3, 10, 5);
$result1 = maxProduct($arr1);
echo "Input: [1, 20, 3, 10, 5] Output: " . $result1 . "\n";

// Contoh penggunaan 2
$arr2 = array(-10, -20, 3, 5);
$result2 = maxProduct($arr2);
echo "Input: [-10, -20, 3, 5] Output: " . $result2 . "\n";
