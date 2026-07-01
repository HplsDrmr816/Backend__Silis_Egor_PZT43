<?php
// Сообщения хранятся в текстовом файле guestbook.txt (чтение + запись)
mb_internal_encoding('UTF-8');

$file = "guestbook.txt";
$errors = [];
$saved  = false;

// Обработка отправки нового сообщения
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author  = trim($_POST['author'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($author === '')  $errors[] = "Укажите имя";
    if ($message === '') $errors[] = "Введите сообщение";
    if (mb_strlen($message) > 500) $errors[] = "Сообщение слишком длинное (макс. 500 символов)";

    if (empty($errors)) {
        $date = date("d.m.Y H:i:s");
        $entry = "[$date] $author:\n" . str_replace("\n", " ", $message) . "\n---\n";
        file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);
        $saved = true;
    }
}

// Чтение всех сообщений из файла
$messages = [];
if (file_exists($file) && filesize($file) > 0) {
    $content = file_get_contents($file);
    $parts = explode("---\n", $content);
    foreach (array_reverse(array_filter($parts, 'trim')) as $part) {
        $messages[] = trim($part);
    }
}
?>
<h1>Гостевая книга</h1>

<h2>Оставить сообщение</h2>

<?php if ($saved): ?>
    <p><b>Сообщение добавлено!</b></p>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <ul style="color:red;">
        <?php foreach ($errors as $e) echo "<li>" . htmlspecialchars($e) . "</li>"; ?>
    </ul>
<?php endif; ?>

<!-- Форма отправляется методом POST на этот же скрипт -->
<form method="POST" action="guestbook.php">
    <p>Имя: <input type="text" name="author" maxlength="50"></p>
    <p>Сообщение:<br><textarea name="message" rows="4" cols="50"></textarea></p>
    <p><button type="submit">Отправить</button></p>
</form>

<hr>

<h2>Сообщения (<?php echo count($messages); ?>)</h2>

<?php if (empty($messages)): ?>
    <p><i>Пока нет сообщений. Будьте первым!</i></p>
<?php else: ?>
    <?php foreach ($messages as $m): ?>
        <div style="border-left: 3px solid #ccc; padding: 8px; margin: 8px 0;">
            <?php echo nl2br(htmlspecialchars($m)); ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<hr><a href="index.php">Назад</a>
