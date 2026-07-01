<?php
require __DIR__ . '/config.php';

use PHPMailer\PHPMailer\PHPMailer;  
use PHPMailer\PHPMailer\Exception;   

$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        
        $mail->Username = 'e46ecf15ebd0dd';
        $mail->Password = '27cdf7e048048a';
        
        $mail->SMTPSecure = false;
        $mail->SMTPAutoTLS = false;
        
        $mail->setFrom('noreply@example.com', 'Тестовый сервер');
        $mail->addAddress('user1@example.com', 'Получатель 1');
        $mail->addAddress('user2@example.com', 'Получатель 2');
        
        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
            $mail->addAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
        }

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Тестовое письмо через PHPMailer';
        $mail->Body = '<h2>Привет!</h2><p>Это HTML-письмо через <b>PHPMailer</b>.</p>';
        $mail->AltBody = 'Привет! Это текстовая версия.';

        $mail->send();
        $result = ['success' => true, 'error' => null];
    } catch (Exception $e) {
        $result = ['success' => false, 'error' => $mail->ErrorInfo];
    }
}
?>
<h1>Задание 3 — PHPMailer</h1>

<?php if ($result && $result['success']): ?>
    <p style="color:green;"><b> Письмо успешно отправлено!</b></p>
<?php elseif ($result && !$result['success']): ?>
    <p style="color:red;"><b> Ошибка: <?php echo htmlspecialchars($result['error']); ?></b></p>
<?php endif; ?>

<form method="POST" action="phpmailer_send.php" enctype="multipart/form-data">
    <p>Вложение: <input type="file" name="attachment"></p>
    <p><button type="submit">Отправить</button></p>
</form>

<p><i>Письма смотреть в Mailtrap → Inbox</i></p>
<hr><a href="index.php">Назад</a>