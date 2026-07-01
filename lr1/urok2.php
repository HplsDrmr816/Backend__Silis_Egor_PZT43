<?php
$age = 18;
?>
<!DOCTYPE html>
<html lang="ru">
<head><meta charset="UTF-8"><title>Урок 2 — print</title></head>
<body>
    <h2>1. Вывод текста через print</h2>
    <?php
    // print выводит одну строку и всегда возвращает 1
    print "Привет, мир!<br>";

    // Вывод HTML-кода через print
    print "<h3>Подзаголовок</h3>";
    print "<p>Это абзац через print.</p>";
    ?>

    <hr>
    <h2>2. Вывод переменных</h2>
    <?php
    print "Мне $age лет.<br>";

    // print можно использовать в выражениях, т.к. он возвращает 1
    $result = (print "print вернул значение");
    echo "<br>Значение, которое вернул print: $result";
    ?>

    <hr>
    <h2>3. Сравнение echo и print</h2>
    <?php
    // echo — может принимать несколько аргументов (через запятую)
    echo "echo: ", "можно ", "вывести ", "несколько ", "аргументов.<br>";

    // print — только один аргумент
    print "print: только один аргумент.<br>";
    ?>
    <p><a href="index.php">← Назад</a></p>
</body>
</html>
