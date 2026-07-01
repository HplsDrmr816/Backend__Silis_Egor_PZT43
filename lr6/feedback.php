<?php
require __DIR__ . '/config.php';

$result = null;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '')    $errors[] = "Укажите имя";
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Некорректный email";
    if ($message === '') $errors[] = "Введите сообщение";

    if (empty($errors)) {
        $body = "<html><head><meta charset='UTF-8'></head><body>";
        $body .= "<h2>Новое сообщение с формы обратной связи</h2>";
        $body .= "<p><b>Имя:</b> " . htmlspecialchars($name) . "</p>";
        $body .= "<p><b>Email:</b> " . htmlspecialchars($email) . "</p>";
        $body .= "<p><b>Сообщение:</b><br>" . nl2br(htmlspecialchars($message)) . "</p>";
        $body .= "</body></html>";

        // ИСПРАВЛЕНО: admin@localhost → admin@example.com
        $result = sendMailViaSMTP('admin@example.com', "Обратная связь от $name", $body, true);
    }
}
?>
<h1>Задание 2 — Форма обратной связи</h1>

<?php if ($result && $result['success']): ?>
    <p style="color:green;"><b>✅ Спасибо! Сообщение отправлено.</b></p>
<?php elseif ($result && !$result['success']): ?>
    <p style="color:red;"><b>❌ Ошибка: <?php echo htmlspecialchars($result['error']); ?></b></p>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <ul style="color:red;">
        <?php foreach ($errors as $e) echo "<li>" . htmlspecialchars($e) . "</li>"; ?>
    </ul>
<?php endif; ?>

<form method="POST" action="feedback.php">
    <p>Ваше имя: <input type="text" name="name" required style="width:300px;"></p>
    <p>Email: <input type="email" name="email" required style="width:300px;"></p>
    <p>Сообщение:<br><textarea name="message" rows="5" cols="50" required></textarea></p>
    <p><button type="submit">Отправить</button></p>
</form>

<p><i>Письма смотреть в Mailtrap → Inbox</i></p>
<hr><a href="index.php">Назад</a>