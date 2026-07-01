<?php
define("SITE_NAME", "Мой учебный сайт");
define("MAX_USERS", 50);

// Создание константы через const (на уровне области видимости)
const SITE_VERSION = "2.0";
const PI = 3.14159;
?>
<!DOCTYPE html>
<html lang="ru">
<head><meta charset="UTF-8"><title>Урок 5 — Константы</title></head>
<body>
    <h2>1. Обычные константы</h2>
    <?php
    // Константы выводятся без знака $
    echo "Название сайта: " . SITE_NAME . "<br>";
    echo "Версия сайта: " . SITE_VERSION . "<br>";
    echo "Максимум пользователей: " . MAX_USERS . "<br>";
    echo "Число Пи: " . PI . "<br>";
    ?>

    <hr>
    <h2>2. Проверка существования константы (defined)</h2>
    <?php
    if (defined("SITE_NAME")) {
        echo "Константа SITE_NAME определена: " . SITE_NAME . "<br>";
    }
    if (!defined("NOT_EXISTS")) {
        echo "Константа NOT_EXISTS НЕ определена.<br>";
    }
    ?>

    <hr>
    <h2>3. Предопределённые (магические) константы</h2>
    <?php
    // Магические константы зависят от места в коде
    echo "<b>__LINE__</b> — текущая строка: " . __LINE__ . "<br>";
    echo "<b>__FILE__</b> — путь к файлу: " . __FILE__ . "<br>";
    echo "<b>__DIR__</b> — директория файла: " . __DIR__ . "<br>";

    // __FUNCTION__ внутри функции
    function magicTest() {
        echo "<b>__FUNCTION__</b> — имя функции: " . __FUNCTION__ . "<br>";
    }
    magicTest();
    ?>

    <hr>
    <h2>4. Встроенные константы PHP</h2>
    <?php
    echo "<b>PHP_VERSION</b>: " . PHP_VERSION . "<br>";
    echo "<b>PHP_OS</b>: " . PHP_OS . "<br>";
    echo "<b>PHP_EOL</b> (символ новой строки): " . PHP_EOL . "<br>";
    echo "<b>E_ALL</b> (уровень ошибок): " . E_ALL . "<br>";
    ?>
    <p><a href="index.php">← Назад</a></p>
</body>
</html>
