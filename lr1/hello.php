<?php
define("DEV_NAME", "Силис Егор Олегович");
const DEV_GROUP = "ПЗТ-43";
const DEV_VARIANT = 18;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Привет всем!!!</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 40px auto; padding: 20px; background: #f5f5f5; }
        h1 { color: #00853A; }
        .dev { background: #fff; padding: 15px; border-left: 4px solid #00853A; border-radius: 4px; }
        a { color: #00853A; }
    </style>
</head>
<body>
    <?php
    // Основной текст страницы
    echo "<h1>Привет всем!!!</h1>";
    echo "<p>Это первая страница, созданная на PHP.</p>";

    // Информация о разработчике
    echo "<div class='dev'>";
    echo "<h3>Разработчик скрипта:</h3>";
    echo "<p><b>ФИО:</b> " . DEV_NAME . "</p>";
    echo "<p><b>Группа:</b> " . DEV_GROUP . "</p>";
    echo "<p><b>Вариант:</b> " . DEV_VARIANT . "</p>";
    echo "</div>";
    ?>
    <p><a href="index.php">← Назад к списку</a></p>
</body>
</html>
