<?php
    $name = 'Alexander';
    $age = 32;

    echo "Name: $name <br/>";
    echo "Age: $age <br/>";
    unset($age);

    define("COM","Hello, world!");
    echo defined('COM');

    echo "<br/>".COM;

    $number = "442158755745";
    $num = 7;
    $count = 0;
    $sum = 0;

    for ($i=0; $i <= strlen($number) ; $i++) {
        $sum += $number[$i];
        if ($num == $number[$i]) {
            $count++;
        }
    }
    echo "<br/><br/>Number: ".$number;
    echo "<br/>Summa: ".$sum;
    echo "<br/>Count number $num: ".$count;
?>
