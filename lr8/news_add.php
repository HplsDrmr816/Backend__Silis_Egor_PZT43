<?php
require_once "config.php";

$link = db_connect();
$success = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title   = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if ($title === '')   $errors[] = "Введите заголовок";
    if ($content === '') $errors[] = "Введите текст новости";

    if (empty($errors)) {
        // Подготовленный запрос (защита от SQL-инъекций)
        $stmt = mysqli_prepare($link, "INSERT INTO news (title, content) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, 'ss', $title, $content);
        if (mysqli_stmt_execute($stmt)) {
            $success = true;
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<h1>Добавить новость</h1>

<?php if ($success): ?>
    <p><b>Новость успешно добавлена!</b>
       <a href="news.php">Посмотреть все новости</a></p>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <ul style="color:red;">
        <?php foreach ($errors as $e) echo "<li>" . htmlspecialchars($e) . "</li>"; ?>
    </ul>
<?php endif; ?>

<form method="POST" action="news_add.php">
    <p>Заголовок: <input type="text" name="title" style="width:400px;"></p>
    <p>Текст:<br><textarea name="content" rows="6" cols="60"></textarea></p>
    <p><button type="submit">Добавить</button></p>
</form>

<?php mysqli_close($link); ?>
<hr><a href="index.php">Назад</a>
