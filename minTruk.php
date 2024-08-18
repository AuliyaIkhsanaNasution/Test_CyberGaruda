<?php
function min_trucks($truck_capacities, $Y)
{
    $num_trucks = count($truck_capacities);
    $dp = array_fill(0, $Y + 1, PHP_INT_MAX);
    $dp[0] = 0;

    $used_trucks = array_fill(0, $Y + 1, array_fill(0, $num_trucks, 0));

    for ($i = 1; $i <= $Y; $i++) {
        for ($j = 0; $j < $num_trucks; $j++) {
            if ($truck_capacities[$j] <= $i && $dp[$i - $truck_capacities[$j]] != PHP_INT_MAX) {
                if ($dp[$i - $truck_capacities[$j]] + 1 < $dp[$i]) {
                    $dp[$i] = $dp[$i - $truck_capacities[$j]] + 1;
                    $used_trucks[$i] = $used_trucks[$i - $truck_capacities[$j]];
                    $used_trucks[$i][$j]++;
                }
            }
        }
    }

    return [
        'min_trucks' => $dp[$Y],
        'truck_counts' => $used_trucks[$Y]
    ];
}

// Contoh penggunaan
$truck_capacities = [5, 11, 23]; // Kapasitas truk
$Y = 100; // Jumlah ton yang harus diangkut

$result = min_trucks($truck_capacities, $Y);

echo "Jumlah truk minimum yang diperlukan: " . $result['min_trucks'] . "\n";
echo "Jumlah masing-masing truk:<br>";
foreach ($truck_capacities as $index => $capacity) {
    echo "Truk " . ($index + 1) . " (" . $capacity . " ton): " . $result['truck_counts'][$index] . " truk <br>";
}
