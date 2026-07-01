<?php
mb_internal_encoding('UTF-8');

$students = [
    ['name' => 'Анна',   'age' => 20, 'grade' => 4.5, 'city' => 'Минск'],
    ['name' => 'Иван',   'age' => 22, 'grade' => 3.8, 'city' => 'Гродно'],
    ['name' => 'Мария',  'age' => 19, 'grade' => 4.9, 'city' => 'Брест'],
    ['name' => 'Петр',   'age' => 21, 'grade' => 4.1, 'city' => 'Гродно'],
    ['name' => 'Елена',  'age' => 20, 'grade' => 4.7, 'city' => 'Минск'],
    ['name' => 'Алексей','age' => 23, 'grade' => 3.5, 'city' => 'Витебск']
];
$colors = ['red', 'green', 'blue', 'yellow', 'black', 'white'];
$capitals = [
    'Россия' => 'Москва',
    'Беларусь' => 'Минск',
    'Польша' => 'Варшава',
    'Германия' => 'Берлин'
];

echo "<h1>Задание 2 — Работа с массивами</h1>";

echo "<h2>1. Инициализация и доступ</h2>";
echo "<pre>";
echo "Имя 3-го студента: " . $students[2]['name'] . "\n";
echo "Возраст 1-го: " . $students[0]['age'] . "\n";
echo "Оценка последнего: " . $students[count($students)-1]['grade'] . "\n";

// Добавить в конец, удалить первый
$colors[] = 'purple';
$removed = array_shift($colors);
echo "\nУдалён первый цвет: $removed\n";
echo "colors теперь: " . implode(", ", $colors) . "\n";

// Ассоциативный массив
$capitals['Франция'] = 'Париж';
echo "Столица Франции: " . $capitals['Франция'] . "\n";
echo "</pre>";

echo "<h2>2. Перебор foreach</h2>";
echo "<pre>";
echo "Имена студентов: ";
foreach ($students as $s) { echo $s['name'] . " "; }
echo "\n\nСтолицы:\n";
foreach ($capitals as $country => $capital) {
    echo "Столица $country — $capital\n";
}
echo "</pre>";

echo "<h2>3. Сортировка</h2>";
echo "<pre>";
$sortedColors = $colors;
sort($sortedColors);
echo "colors по алфавиту: " . implode(", ", $sortedColors) . "\n";

// Сортировка студентов по возрасту (по убыванию) с сохранением ключей
$byAge = $students;
usort($byAge, fn($a, $b) => $b['age'] <=> $a['age']);
echo "\nСтуденты по возрасту (убывание):\n";
foreach ($byAge as $s) { echo "  {$s['name']} — {$s['age']}\n"; }

ksort($capitals);
echo "\ncapitals по ключам:\n";
foreach ($capitals as $k => $v) { echo "  $k => $v\n"; }
echo "</pre>";

echo "<h2>4. Поиск и проверка</h2>";
echo "<pre>";
if (!in_array('orange', $colors)) { $colors[] = 'orange'; echo "'orange' добавлен\n"; }
echo "Есть ли ключ 'grade' у 1-го студента: " . (array_key_exists('grade', $students[0]) ? 'да' : 'нет') . "\n";
echo "Индекс 'yellow': " . array_search('yellow', $colors) . "\n";
echo "</pre>";

echo "<h2>5. Работа с частью массива</h2>";
echo "<pre>";
$slice = array_slice($colors, 0, 3);
echo "Первые 3 цвета: " . implode(", ", $slice) . "\n";

$spliced = $students;
$removedEl = array_splice($spliced, 1, 1);
echo "Удалён 2-й студент: " . $removedEl[0]['name'] . "\n";

$merged = array_merge($colors, ['pink', 'brown']);
echo "merge с [pink, brown]: " . implode(", ", $merged) . "\n";
echo "</pre>";

echo "<h2>6. Преобразование массивов</h2>";
echo "<pre>";
$ages = array_column($students, 'age');
echo "Возраста: " . implode(", ", $ages) . "\n";

$colorLens = array_combine($colors, array_map('strlen', $colors));
echo "Цвет => длина: " . json_encode($colorLens) . "\n";

echo "Ключи capitals: " . implode(", ", array_keys($capitals)) . "\n";
echo "Значения capitals: " . implode(", ", array_values($capitals)) . "\n";
echo "</pre>";

echo "<h2>7. Функции высшего порядка</h2>";
echo "<pre>";
$adults = array_filter($students, fn($s) => $s['age'] >= 21);
echo "Студенты >= 21 года: ";
foreach ($adults as $s) { echo $s['name'] . " "; }
echo "\n";

$named = array_map(fn($s) => "{$s['name']} ({$s['age']} лет)", $students);
echo "Полные имена: " . implode("; ", $named) . "\n";

$avg = array_reduce($students, fn($carry, $s) => $carry + $s['grade'], 0) / count($students);
echo "Средний балл: " . round($avg, 2) . "\n";
echo "</pre>";

echo "<h2>8. Случайные элементы</h2>";
echo "<pre>";
$randomKeys = array_rand($colors, 2);
echo "2 случайных цвета: " . $colors[$randomKeys[0]] . ", " . $colors[$randomKeys[1]] . "\n";
shuffle($colors);
echo "Перемешанный массив: " . implode(", ", $colors) . "\n";
echo "</pre>";

echo "<hr><a href='index.php'>Назад</a>";
?>
