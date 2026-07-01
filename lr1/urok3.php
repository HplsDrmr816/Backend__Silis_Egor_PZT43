<?php

// Строковый тип (string)
$strVar = "Гродно";
// Целое число (integer)
$intVar = 42;
// Дробное число (float)
$floatVar = 3.14;
// Логический тип (boolean)
$boolVar = true;
// Пустое значение (null)
$nullVar = null;
// Массив (array)
$arrVar = ["яблоко", "банан"];
?>
<!DOCTYPE html>
<html lang="ru">
<head><meta charset="UTF-8"><title>Урок 3 — Переменные</title></head>
<body>
    <h2>1. Переменные разных типов</h2>
    <?php
    // Вывод значений
    echo "<b>Строка:</b> $strVar<br>";
    echo "<b>Целое число:</b> $intVar<br>";
    echo "<b>Дробное число:</b> $floatVar<br>";
    echo "<b>Логический тип:</b> " . ($boolVar ? 'true' : 'false') . "<br>";
    echo "<b>Null:</b> " . var_export($nullVar, true) . "<br>";
    echo "<b>Массив:</b> " . implode(", ", $arrVar) . "<br>";
    ?>

    <hr>
    <h2>2. Определение типа через gettype()</h2>
    <?php
    echo "Тип \$strVar: " . gettype($strVar) . "<br>";
    echo "Тип \$intVar: " . gettype($intVar) . "<br>";
    echo "Тип \$floatVar: " . gettype($floatVar) . "<br>";
    echo "Тип \$boolVar: " . gettype($boolVar) . "<br>";
    echo "Тип \$nullVar: " . gettype($nullVar) . "<br>";
    ?>

    <hr>
    <h2>3. Подробный дамп через var_dump()</h2>
    <?php
    echo "<pre>";
    var_dump($intVar);
    var_dump($strVar);
    echo "</pre>";
    ?>

    <hr>
    <h2>4. Приведение типов</h2>
    <?php
    // Явное приведение строки к целому числу
    $priceStr = "1499 рублей";
    $priceInt = (int)$priceStr;
    echo "Исходная строка: $priceStr → после (int): $priceInt<br>";

    // Неявное приведение (строка + 0)
    $num = "100 рублей" + 0;
    echo "\"100 рублей\" + 0 = $num<br>";
    ?>
    <p><a href="index.php">← Назад</a></p>
</body>
</html>
