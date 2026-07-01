<?php
mb_internal_encoding('UTF-8');

$text1 = " PHP (Hypertext Preprocessor) — это скриптовый язык программирования общего назначения. ";
$text2 = "Я люблю PHP. PHP — это мощный язык. Я учу PHP.";
$userComment = "<b>Отличный сайт!</b> <script>alert('XSS');</script>";
$price = " 1 234,56 руб. ";
$slugSource = "Привет, как дела?";
$csvLine = "Иванов;Иван;ivan@mail.com;29;Минск";
$name = "Егор";

echo "<h1>Задание 3 — Работа со строками</h1>";

echo "<h2>1. Способы записи строк</h2>";
echo "<pre>";
echo 'Одинарные: Привет, $name!' . "\n";
echo "Двойные: Привет, $name!" . "\n";
echo <<<HEREDOC
Heredoc:
Привет, $name!
Это многострочный текст.
HEREDOC;
echo "\n</pre>";

echo "<h2>2. Доступ к символам</h2>";
echo "<pre>";
echo "Первый символ text1 через [0]: '" . $text1[0] . "'\n";
echo "Первый символ slugSource через mb_substr: '" . mb_substr($slugSource, 0, 1) . "'\n";
echo "</pre>";

echo "<h2>3. Операции со строками</h2>";
echo "<pre>";
$concat = "Имя: " . $name;
$concat .= " (студент)";
echo "$concat\n";
echo "\"123\" == 123: " . var_export("123" == 123, true) . "\n";
echo "\"123\" === 123: " . var_export("123" === 123, true) . "\n";
echo "</pre>";

echo "<h2>4. Длина строки</h2>";
echo "<pre>";
echo "Длина text1 в байтах (strlen): " . strlen($text1) . "\n";
echo "Длина text1 в символах (mb_strlen): " . mb_strlen($text1) . "\n";
echo "</pre>";

echo "<h2>5. Поиск подстроки</h2>";
echo "<pre>";
echo "Позиция 'PHP' в text2: " . mb_strpos($text2, "PHP") . "\n";
echo "Есть ли 'JavaScript': " . (str_contains($text2, "JavaScript") ? 'да' : 'нет') . "\n";
echo "Сколько раз 'PHP' в text2: " . substr_count(strtolower($text2), "php") . "\n";
echo "</pre>";

echo "<h2>6. Извлечение части строки</h2>";
echo "<pre>";
$start = mb_strpos($text1, "скриптовый");
$end   = mb_strpos($text1, "общего");
echo "Подстрока: '" . trim(mb_substr($text1, $start, $end - $start)) . "'\n";
echo "Последние 10 символов: '" . mb_substr($text1, -10) . "'\n";
echo "</pre>";

echo "<h2>7. Замена части строки</h2>";
echo "<pre>";
echo str_replace("PHP", "РНР", $text2) . "\n";
echo str_replace(".", "", $text1) . "\n";
echo "</pre>";

echo "<h2>8. Удаление пробелов и парсинг цены</h2>";
echo "<pre>";
echo "trim(price): '" . trim($price) . "'\n";
$clean = str_replace(["руб.", " "], "", $price);
$clean = str_replace(",", ".", $clean);
echo "Число: " . $clean . " → float: " . (float)$clean . "\n";
echo "</pre>";

echo "<h2>9. Изменение регистра</h2>";
echo "<pre>";
echo "Нижний: " . mb_strtolower($slugSource) . "\n";
echo "Верхний: " . mb_strtoupper($slugSource) . "\n";
echo "Заглавные: " . mb_convert_case($slugSource, MB_CASE_TITLE) . "\n";
echo "</pre>";

echo "<h2>10. Разбиение и объединение</h2>";
echo "<pre>";
$csvArr = explode(";", $csvLine);
echo "Фамилия: {$csvArr[0]}, Имя: {$csvArr[1]}, Email: {$csvArr[2]}\n";
echo "Обратно через '|': " . implode(" | ", $csvArr) . "\n";
$chars = mb_str_split($slugSource);
echo "Символы через запятую: " . implode(", ", $chars) . "\n";
echo "</pre>";

echo "<h2>11. Безопасный вывод</h2>";
echo "<pre>";
echo "htmlspecialchars:\n" . htmlspecialchars($userComment) . "\n\n";
echo "strip_tags:\n" . strip_tags($userComment) . "\n";
echo "</pre>";

echo "<h2>12. Форматирование</h2>";
echo "<pre>";
echo sprintf("Студент %s, возраст %d, оценка %.1f", "Иван", 22, 4.5) . "\n";
echo number_format(12345.6789, 2, ',', ' ') . "\n";
echo "</pre>";

echo "<hr><a href='index.php'>Назад</a>";
?>
