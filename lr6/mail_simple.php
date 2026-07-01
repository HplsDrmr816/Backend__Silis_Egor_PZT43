<?php
require __DIR__ . '/config.php';

$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to      = trim($_POST['to'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    $result = sendMailViaSMTP($to, $subject, $message, false);
}
?>
<h1>Задание 1 — Отправка письма</h1>

<?php if ($result && $result['success']): ?>
    <p style="color:green;"><b> Письмо отправлено на <?php echo htmlspecialchars($_POST['to']); ?></b></p>
<?php elseif ($result && !$result['success']): ?>
    <p style="color:red;"><b> Ошибка: <?php echo htmlspecialchars($result['error']); ?></b></p>
<?php endif; ?>

<form method="POST" action="mail_simple.php">
    <p>Кому: <input type="email" name="to" required style="width:300px;"></p>
    <p>Тема: <input type="text" name="subject" required style="width:300px;"></p>
    <p>Сообщение:<br><textarea name="message" rows="5" cols="50" required></textarea></p>
    <p><button type="submit">Отправить</button></p>
</form>

<p><i>Письма смотреть в Mailtrap → Inbox</i></p>
<hr><a href="index.php">Назад</a>