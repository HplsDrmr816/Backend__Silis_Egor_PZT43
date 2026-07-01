<?php
$filename = "data.txt";

// ----- Создание/перезапись файла (режим "w") -----
$handle = fopen($filename, "w");
if ($handle) {
    // flock — блокировка файла (LOCK_EX = эксклюзивная запись)
    if (flock($handle, LOCK_EX)) {
        fwrite($handle, "Первая строка файла\n");
        fwrite($handle, "Вторая строка файла\n");
        fwrite($handle, "Третья строка файла\n");
        flock($handle, LOCK_UN); // снятие блокировки
    }
    fclose($handle);
}

// ----- Дозапись в конец файла (режим "a") -----
$handle = fopen($filename, "a");
if ($handle) {
    fwrite($handle, "Добавлено позже: " . date("H:i:s") . "\n");
    fclose($handle);
}

echo "<h1>Задание 1 — Типовые действия с файлами</h1>";

echo "<h2>1. Информация о файле \"$filename\"</h2>";
echo "<ul>";
echo "<li><b>Существует:</b> " . (file_exists($filename) ? 'да' : 'нет') . "</li>";
echo "<li><b>Размер:</b> " . filesize($filename) . " байт</li>";
echo "<li><b>Изменён:</b> " . date("d.m.Y H:i:s", filemtime($filename)) . "</li>";
echo "<li><b>Был открыт:</b> " . date("d.m.Y H:i:s", fileatime($filename)) . "</li>";
echo "</ul>";

echo "<h2>2. Чтение всех строк через fgets() + feof()</h2>";
echo "<pre>";
// Построчное чтение до конца файла
$handle = fopen($filename, "r");
if ($handle) {
    while (!feof($handle)) {
        $line = fgets($handle);
        if ($line !== false) echo htmlspecialchars($line);
    }
    fclose($handle);
}
echo "</pre>";

echo "<h2>3. Чтение целиком через file_get_contents()</h2>";
echo "<pre>" . htmlspecialchars(file_get_contents($filename)) . "</pre>";

echo "<h2>4. Чтение в массив через file()</h2>";
echo "<p>Файл содержит <b>" . count(file($filename)) . "</b> строк.</p>";
echo "<pre>";
foreach (file($filename) as $i => $line) {
    echo "Строка " . ($i + 1) . ": " . htmlspecialchars($line);
}
echo "</pre>";

echo "<h2>5. file_put_contents() с блокировкой</h2>";
echo "<pre>";
$bytes = file_put_contents("log.txt", date("Y-m-d H:i:s") . " — тестовая запись\n", FILE_APPEND | LOCK_EX);
echo "Записано $bytes байт в log.txt\n";
echo "</pre>";

echo "<hr><a href='index.php'>Назад</a>";
?>
