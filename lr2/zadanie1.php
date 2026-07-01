<?php
mb_internal_encoding('UTF-8');

// ===== ИСХОДНЫЕ ДАННЫЕ =====
$integerVar = 42;
$floatVar   = 3.14159;
$stringVar  = "100 рублей";
$boolVar    = true;
$nullVar    = null;
$name       = "Иван Петров";
$age        = 22;
$city       = "Гродно";
$price      = 1499.99;
$discountPercent = 15;
$counter    = 5;
$fruits     = ["яблоко", "банан", "апельсин"];
$user       = ["login" => "john", "role" => "admin", "active" => true];
define("TAX_RATE", 0.2);
const COMPANY = "ООО «Ромашка»";
$dateString  = "2025-04-10";

echo "<h1>Задание 1 — Синтаксис PHP</h1>";

echo "<h2>1. Переменные, константы и типы данных</h2>";
echo "<pre>";
echo "integerVar = $integerVar (" . gettype($integerVar) . ")\n";
echo "floatVar   = $floatVar (" . gettype($floatVar) . ")\n";
echo "stringVar  = $stringVar (" . gettype($stringVar) . ")\n";
echo "boolVar    = " . ($boolVar ? 'true' : 'false') . " (" . gettype($boolVar) . ")\n";
echo "nullVar    = " . var_export($nullVar, true) . " (" . gettype($nullVar) . ")\n";

// isset() — существует ли переменная
echo "\nisset(\$undefinedVar): " . (isset($undefinedVar) ? 'да' : 'нет') . "\n";

// unset() — удаление переменной
unset($floatVar);
echo "После unset(\$floatVar): " . (isset($floatVar) ? 'существует' : 'удалена') . "\n";

// Константы
echo "\nTAX_RATE = " . TAX_RATE . "\n";
echo "COMPANY  = " . COMPANY . "\n";
echo "defined('TAX_RATE'): " . (defined('TAX_RATE') ? 'да' : 'нет') . "\n";
echo "__LINE__ = " . __LINE__ . ", __FILE__ = " . basename(__FILE__) . "\n";

// Приведение типов
echo "\n(stringVar)(int) = " . ((int)$stringVar) . " — тип " . gettype((int)$stringVar) . "\n";
echo "\"10 лет\" + 5 = " . ("10 лет" + 5) . " (неявное приведение)\n";
echo "0 == false: " . var_export(0 == false, true) . " | 0 === false: " . var_export(0 === false, true) . "\n";
echo "</pre>";

echo "<h2>2. Операции и приоритет</h2>";
echo "<pre>";
echo "42 + 3.14159 = " . ($integerVar + $floatVar) . "\n";
echo "42 % 7 = " . ($integerVar % 7) . "\n";
echo "42 ^ 3 = " . ($integerVar ** 3) . "\n";

// Инкремент: постфиксный (возвращает старое) и префиксный (возвращает новое)
$c = $counter;
echo "\nПостфиксный: " . $c++ . " → теперь " . $c . "\n";
echo "Префиксный:  " . ++$c . " → теперь " . $c . "\n";

// Строковые операции — конкатенация (.) и составное присваивание (.=)
$info = "Имя: $name, возраст: $age, город: $city";
$info .= " (студент)";
echo "\n$info\n";

// Сравнения и <=> (spaceship)
echo "\n42 == '100 рублей': " . var_export($integerVar == $stringVar, true) . "\n";
echo "22 <=> 25 = " . ($age <=> 25) . " (отрицательный — меньше)\n";
echo "age>18 И city=='Гродно': " . var_export($age > 18 && $city == "Гродно", true) . "\n";

// Приоритет операций
echo "\n2 + 3 * 4 - 1 = " . (2 + 3 * 4 - 1) . " (умножение раньше)\n";
echo "(2 + 3) * (4 - 1) = " . ((2 + 3) * (4 - 1)) . "\n";
echo "</pre>";

echo "<h2>3. Операторы управления</h2>";
echo "<pre>";
// if-elseif-else — категория возраста
function ageCategory($a) {
    if ($a < 18) return "ребёнок";
    elseif ($a <= 35) return "молодой";
    elseif ($a <= 60) return "взрослый";
    else return "пенсионер";
}
echo "Категория для $age: " . ageCategory($age) . "\n";

// match (PHP 8+)
$cat = match(true) {
    $age < 18 => "ребёнок",
    $age <= 35 => "молодой",
    $age <= 60 => "взрослый",
    default => "пенсионер"
};
echo "Через match: $cat\n";

// Тернарный оператор
$access = $boolVar ? "разрешён" : "запрещён";
echo "Доступ: $access\n";

// Циклы
echo "\nwhile 1..10: ";
$i = 1; while ($i <= 10) { echo $i . " "; $i++; }
echo "\nfor (чётные 0..20): ";
for ($j = 0; $j <= 20; $j += 2) { echo $j . " "; }
echo "\nforeach fruits: ";
foreach ($fruits as $k => $v) { echo "[$k]=$v "; }
echo "\nfor с continue/break (пропуск 5, стоп на 8): ";
for ($n = 1; $n <= 10; $n++) {
    if ($n == 5) continue;
    if ($n == 8) break;
    echo $n . " ";
}
echo "</pre>";

echo "<h2>4. Пользовательские функции</h2>";
// Обычная функция
function greet($n) { return "Привет, $n!"; }
echo greet($name) . "<br>";

// Параметр по умолчанию
function calculateDiscount($p, $percent = 10) { return $p - ($p * $percent / 100); }
echo "Цена $price со скидкой 10%: " . calculateDiscount($price) . "<br>";
echo "Цена $price со скидкой {$discountPercent}%: " . calculateDiscount($price, $discountPercent) . "<br>";

// Вариативная функция
function sumAll(...$nums) { return array_sum($nums); }
echo "sumAll(1,2,3,4,5) = " . sumAll(1,2,3,4,5) . "<br>";

// Стрелочная функция с array_map — квадраты чисел
$nums = [1,2,3,4,5];
$squares = array_map(fn($x) => $x ** 2, $nums);
echo "Квадраты: " . implode(", ", $squares) . "<br>";

// array_filter + стрелочная — только чётные
$evens = array_filter($nums, fn($x) => $x % 2 === 0);
echo "Чётные: " . implode(", ", $evens) . "<br>";

// Досрочный return при делении на ноль
function divide($a, $b) { if ($b == 0) return null; return $a / $b; }
echo "divide(10, 2) = " . divide(10, 2) . " | divide(10, 0) = " . var_export(divide(10, 0), true) . "<br>";

echo "<h2>5. Математические функции</h2>";
echo "<pre>";
echo "abs(-15) = " . abs(-15) . "\n";
echo "ceil(4.7) = " . ceil(4.7) . ", floor(4.7) = " . floor(4.7) . "\n";
echo "round(3.14159, 2) = " . round(3.14159, 2) . "\n";
echo "rand(1,100) = " . rand(1, 100) . "\n";
echo "max/min из [34,67,12,89,6] = " . max(34,67,12,89,6) . " / " . min(34,67,12,89,6) . "\n";
echo "</pre>";

echo "<h2>6. Дата и время</h2>";
echo "<pre>";
echo "Текущий timestamp: " . time() . "\n";
echo "Сейчас: " . date("d.m.Y H:i:s") . "\n";
echo "mktime(2026-01-01): " . mktime(0,0,0,1,1,2026) . "\n";
echo "Следующий понедельник: " . date("Y-m-d", strtotime("next monday")) . "\n";
$dt = new DateTime($dateString);
$dt->modify("+2 недели");
echo "$dateString + 2 недели = " . $dt->format("Y-m-d") . "\n";
$diff = (new DateTime("2026-02-11"))->diff(new DateTime());
echo "Дней до 2026-02-11: " . $diff->days . "\n";
echo "</pre>";

echo "<h2>7. Подключение файлов (require_once)</h2>";
require_once "config.php";
echo "<pre>";
echo "DB_HOST = " . DB_HOST . "\n";
echo "DB_USER = " . DB_USER . "\n";
echo "DB_PASS = " . DB_PASS . "\n";
echo "DB_NAME = " . DB_NAME . "\n";
echo "</pre>";

echo "<hr><a href='index.php'>Назад</a>";
?>
