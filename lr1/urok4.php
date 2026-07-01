<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head><meta charset="UTF-8"><title>Урок 4 — Предопределённые переменные</title></head>
<body>
    <h2>Предопределённые переменные PHP</h2>

    <h3>1. $_SERVER — данные о сервере и запросе</h3>
    <?php
    echo "<b>Имя сервера:</b> " . $_SERVER['SERVER_NAME'] . "<br>";
    echo "<b>Текущий файл:</b> " . $_SERVER['SCRIPT_NAME'] . "<br>";
    echo "<b>Браузер пользователя:</b> " . ($_SERVER['HTTP_USER_AGENT'] ?? 'неизвестно') . "<br>";
    echo "<b>IP-адрес клиента:</b> " . ($_SERVER['REMOTE_ADDR'] ?? 'неизвестно') . "<br>";
    echo "<b>Метод запроса:</b> " . $_SERVER['REQUEST_METHOD'] . "<br>";
    ?>

    <hr>
    <h3>2. $_ENV — переменные окружения</h3>
    <?php
    echo "<b>Операционная система:</b> " . (PHP_OS_FAMILY ?? 'неизвестно') . "<br>";
    echo "<b>Версия PHP:</b> " . PHP_VERSION . "<br>";
    ?>

    <hr>
    <h3>3. $GLOBALS — доступ ко всем глобальным переменным</h3>
    <?php
    $globalTest = "Я глобальная переменная";

    function showGlobal() {
        // Через $GLOBALS можно получить доступ к глобальной переменной внутри функции
        echo $GLOBALS['globalTest'];
    }
    showGlobal();
    echo "<br>";
    ?>

    <hr>
    <h3>4. Суперглобальные массивы (краткий обзор)</h3>
    <ul>
        <li><b>$_GET</b> — данные из адресной строки (после ?)</li>
        <li><b>$_POST</b> — данные из HTML-форм (метод POST)</li>
        <li><b>$_REQUEST</b> — объединение $_GET, $_POST и $_COOKIE</li>
        <li><b>$_SESSION</b> — данные сессии пользователя</li>
        <li><b>$_COOKIE</b> — cookies браузера</li>
        <li><b>$_FILES</b> — загруженные файлы</li>
    </ul>
    <p><a href="index.php">← Назад</a></p>
</body>
</html>
