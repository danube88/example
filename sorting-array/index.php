<?php
    /**
    * Класс для измерения времени выполнения скрипта или операций
    */
    class Timer
    {
        /**
         * @var float время начала выполнения скрипта
         */
        private static $start = .0;

        /**
         * Начало выполнения
         */
        static function start()
        {
            self::$start = microtime(true);
        }

        /**
         * Разница между текущей меткой времени и меткой self::$start
         * @return float
         */
        static function finish()
        {
            return microtime(true) - self::$start;
        }
    }
    /**
     * Класс сортировки массива
     */
    class SortArray
    {

        function __construct()
        {
            // code...
        }

        public function select(array $a, $size)
        {
            for( $i = 0; $i < $size; $i++) {
                $k = $i;
                $x = $a[$i];
                for( $j = $i + 1; $j < $size; $j++)
                    if (  $a[$j] < $x ) {
                        $k = $j;
                        $x = $a[$j];
                    }
                $a[$k] = $a[$i];
                $a[$i] = $x;
            }

            return $a;
        }

        public function bubble(array $a, $size)
        {
            $r = $size - 1;
	        while ($r > 0) {
                for ($i = 0; $i < $r; $i++) {
                    if ($a[$i] > $a[$i + 1]) {
                        /*$x = $a[$i];
                        $a[$i] = $a[$i + 1];
                        $a[$i + 1] = $x;*/
                        $this->array_swap($a, $i, $i + 1);
                    }
                }
                $r--;
            }

            return $a;
        }

        public function shaker(array $a, $size)
        {
            $k = $size - 1;
            $lb = 1;
            $ub = $size - 1;

            do {
                // проход снизу вверх
                for( $j = $ub; $j > 0; $j-- ) {
                    if ( $a[$j - 1] > $a[$j] ) {
                        /*$x = $a[$j - 1];
                        $a[$j - 1] = $a[$j];
                        $a[$j] = $x;*/

                        $this->array_swap($a, $j, $j - 1);

                        $k = $j;
                    }
                }

                $lb = $k + 1;

                // проход сверху вниз
                for ($j = 1; $j <= $ub; $j++) {
                    if ( $a[$j-1] > $a[$j] ) {
                        /*$x = $a[$j - 1];
                        $a[$j - 1] = $a[$j];
                        $a[$j] = $x;*/

                        $this->array_swap($a, $j, $j - 1);

                        $k = $j;
                    }
                }

                $ub = $k - 1;
            } while ( $lb < $ub );

            return $a;
        }

        public function insert(array $a, $size)
        {
            for ( $i = 0; $i < $size; $i++) {
                $x = $a[$i];
                for ( $j = $i - 1; $j >= 0 && $a[$j] > $x; $j--)
                $a[$j + 1] = $a[$j];
                $a[$j + 1] = $x;
            }
            return $a;
        }

        public function insertGuarded(array $a, $size)
        {
            $backup = $a[0];
            $a[0] = min($a);

            for ( $i = 1; $i < $size; $i++) {
                $x = $a[$i];

                for ( $j = $i - 1; $a[$j] > $x; $j--)
	               $a[$j + 1] = $a[$j];

                $a[$j + 1] = $x;
            }

            for ( $j = 1; $j < $size && $a[$j] < $backup; $j++)
                $a[$j - 1] = $a[$j];

            $a[$j - 1] = $backup;

            return $a;
        }

        public function shell(array $a, $size)
        {
            for($k = $size / 2; $k > 0; $k /= 2)
            {
                $k = (int) $k;
                for($i = $k; $i < $size; $i++)
                {
                    $t = $a[$i];
                    for($j = $i; $j >= $k; $j -= $k)
                    {
                        if($t < $a[$j - $k])
                        {
                            $a[$j] = $a[$j - $k];
                        }
                        else
                        {
                            break;
                        }
                    }
                    $a[$j] = $t;
                }
            }

            return $a;
        }

        public function comb(array $a, $size)
        {
            for ($i = 0; $i < $size; $i++) {
                for ($j = 0; $j < $i + 1; $j++) {
                    $x = ($size - 1) - ($i - $j);
                    if ($a[$j] > $a[$x]) {
                        $buff = $a[$j];
                        $this->array_swap($a,$j,$x);
                        unset($buff);
                    }
                }
            }

            return $a;
        }

        public function cocktail(array $a, $size)
        {
        	$left = 0;
	        $right = $size - 1;
            do {
                for ($i = $left; $i < $right; $i++) {
                    if ($a[$i] > $a[$i + 1]) {
                        list($a[$i], $a[$i + 1]) = array($a[$i + 1], $a[$i]);
                    }
                }
                $right -= 1;
                for ($i = $right; $i > $left; $i--) {
                    if ($a[$i] < $a[$i - 1]) {
                        list($a[$i], $a[$i - 1]) = array($a[$i - 1], $a[$i]);
                    }
                }
                $left += 1;
            } while ($left <= $right);

            return $a;
        }

        public function gnome(array $a, $size)
        {
            $i = 1;
            while ($i < $size) {
                if ($a[$i - 1] <= $a[$i]) {
                    $i++;
                } else {
                    $this->array_swap($a,$i,$i-1);
                    $i--;
                }
            }

            return $a;
        }

        public function min(array $a, $size)
        {
            $i = 0;
            while ($i < $size) {
                $min = min($a);
                $keyMin = array_search($min, $a);
                $buf[] = $a[$keyMin];
                unset($a[$keyMin]);
                $i++;
            }

            return $buf;
        }

        public function max(array $a, $size)
        {
            $i = $size - 1;
            while ($i >= 0) {
                $max = max($a);
                $keyMax = array_search($max, $a);
                $buf[$i] = $a[$keyMax];
                unset($a[$keyMax]);
                $i--;
            }

            return $buf;
        }

        private function array_swap(&$arr, $i, $j)
        {
            $tmp = $arr[$i];
            $arr[$i] = $arr[$j];
            $arr[$j] = $tmp;
        }

    }

    $arr = [5,15,6,8,12,4,11,3,2,13,7,14,9,10,1];

    echo "Исходный массив";
    echo "<pre>";
    print_r($arr);
    echo "</pre><br/>";

    $sort = new SortArray;
    $size = count($arr);

    echo "Сортировка выбором";
    echo "<pre>";
    Timer::start();
    print_r($sort->select($arr, $size));
    $select = Timer::finish();
    echo "</pre><br/>";

    echo "Сортировка пузырьком";
    echo "<pre>";
    Timer::start();
    print_r($sort->bubble($arr, $size));
    $bubble = Timer::finish();
    echo "</pre><br/>";

    echo "Сортировка шейкер";
    echo "<pre>";
    Timer::start();
    print_r($sort->shaker($arr, $size));
    $shaker = Timer::finish();
    echo "</pre><br/>";

    echo "Сортировка вставками";
    echo "<pre>";
    Timer::start();
    print_r($sort->insert($arr, $size));
    $insert = Timer::finish();
    echo "</pre><br/>";

    echo "Сортировка вставками со сторожевым элементом";
    echo "<pre>";
    Timer::start();
    print_r($sort->insertGuarded($arr, $size));
    $insertGuarded = Timer::finish();
    echo "</pre><br/>";

    echo "Сортировка Шелла";
    echo "<pre>";
    Timer::start();
    print_r($sort->shell($arr, $size));
    $shell = Timer::finish();
    echo "</pre><br/>";

    echo "Сортировка расчёской";
    echo "<pre>";
    Timer::start();
    print_r($sort->comb($arr, $size));
    $comb = Timer::finish();
    echo "</pre><br/>";

    echo "Сортировка перемешиванием";
    echo "<pre>";
    Timer::start();
    print_r($sort->cocktail($arr, $size));
    $cocktail = Timer::finish();
    echo "</pre><br/>";

    echo "Сортировка гномья";
    echo "<pre>";
    Timer::start();
    print_r($sort->gnome($arr, $size));
    $gnome = Timer::finish();
    echo "</pre><br/>";

    echo "Сортировка min";
    echo "<pre>";
    Timer::start();
    print_r($sort->min($arr, $size));
    $min = Timer::finish();
    echo "</pre><br/>";

    echo "Сортировка max";
    echo "<pre>";
    Timer::start();
    print_r($sort->max($arr, $size));
    $max = Timer::finish();
    echo "</pre><br/>";

    echo '<table border="1" width="700">';
        echo '<tr>';
            echo '<td>';
            echo "Время выполнения 'Сортировка выбором': ";
            echo '</td>';
            echo '<td>';
            echo number_format($select, 10, ',', ' ') . " сек.";
            echo '</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>';
            echo "Время выполнения 'Сортировка пузырьком': ";
            echo '</td>';
            echo '<td>';
            echo number_format($bubble, 10, ',', ' ') . " сек.";
            echo '</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>';
            echo "Время выполнения 'Сортировка Шейкер': ";
            echo '</td>';
            echo '<td>';
            echo number_format($shaker, 10, ',', ' ') . " сек.";
            echo '</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>';
            echo "Время выполнения 'Сортировка вставками': ";
            echo '</td>';
            echo '<td>';
            echo number_format($insert, 10, ',', ' ') . " сек.";
            echo '</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>';
            echo "Время выполнения 'Сортировка вставками со сторожевым элементом': ";
            echo '</td>';
            echo '<td>';
            echo number_format($insertGuarded, 10, ',', ' ') . " сек.";
            echo '</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>';
            echo "Время выполнения 'Сортировка Шелла': ";
            echo '</td>';
            echo '<td>';
            echo number_format($shell, 10, ',', ' ') . " сек.";
            echo '</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>';
            echo "Время выполнения 'Сортировка расчёской': ";
            echo '</td>';
            echo '<td>';
            echo number_format($comb, 10, ',', ' ') . " сек.";
            echo '</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>';
            echo "Время выполнения 'Сортировка перемешиванием': ";
            echo '</td>';
            echo '<td>';
            echo number_format($cocktail, 10, ',', ' ') . " сек.";
            echo '</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>';
            echo "Время выполнения 'Сортировка гномья': ";
            echo '</td>';
            echo '<td>';
            echo number_format($gnome, 10, ',', ' ') . " сек.";
            echo '</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>';
            echo "Время выполнения 'Сортировка min': ";
            echo '</td>';
            echo '<td>';
            echo number_format($min, 10, ',', ' ') . " сек.";
            echo '</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>';
            echo "Время выполнения 'Сортировка max': ";
            echo '</td>';
            echo '<td>';
            echo number_format($max, 10, ',', ' ') . " сек.";
            echo '</td>';
        echo '</tr>';
    echo '</table>';
