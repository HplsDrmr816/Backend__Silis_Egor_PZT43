<?php
$name = $_GET['name'] ?? null;
$city = $_GET['city'] ?? null;
?>
<h1>Задание 1. GET-запрос через адресную строку</h1>

<?php if ($name !== null && $city !== null): ?>
    <!-- Параметры переданы — выводим фразу -->
    <p>Пользователь <b><?php echo htmlspecialchars($name); ?></b>
       проживает в городе <b><?php echo htmlspecialchars($city); ?></b>.</p>
<?php else: ?>
    <p>Данные не указаны.</p>
<?php endif; ?>

<h3>Примеры ссылок для проверки:</h3>
<ul>
    <li><a href="?name=Иван&city=Минск">?name=Иван&city=Минск</a></li>
    <li><a href="?name=Егор&city=Гродно">?name=Егор&city=Гродно</a></li>
    <li><a href="?">Без параметров</a></li>
</ul>

<hr><a href="index.php">Назад</a>
