<?php
function runIt(Closure $closure, string $title): void
{
    $times = [];
    if($closure() instanceof Closure) {
        $closure = $closure();
    }
    for ($i = 0; $i < 100; $i++) {
        $time1 = microtime(true);
        for($j = 0; $j < 10000; $j++) {
            $s = $closure();
        }
        $times[] = (microtime(true) - $time1) * 1000;
    }

    printf("=== %s\n", $title);
    printf("avg: %8.2f msec\n", array_sum($times) / 100);
    printf("med: %8.2f msec\n", median($times));
    printf("min: %8.2f msec\n", min($times));
    printf("max: %8.2f msec\n", max($times));
}

function median(array $times)
{
    sort($times); // 配列を昇順ソート
    $count = count($times);
    if ($count % 2 === 0) {
        // 偶数の場合、中央2つの平均
        return ($times[$count / 2 - 1] + $times[$count / 2]) / 2;
    } else {
        // 奇数の場合、中央の1つ
        return $times[floor($count / 2)];
    }
}