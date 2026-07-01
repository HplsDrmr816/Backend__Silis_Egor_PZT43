<?php

require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMailViaSMTP($to, $subject, $body, $isHTML = true, $attachments = []) {
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        
        // ===== ВСТАВЬ СВОИ ДАННЫЕ ИЗ MAILTRAP СЮДА =====
        $mail->Username = 'e46ecf15ebd0dd';
        $mail->Password = '27cdf7e048048a';
        // ============================================
        
        $mail->SMTPSecure = false;
        $mail->SMTPAutoTLS = false;
        
        $mail->setFrom('noreply@example.com', 'Тестовый сервер');
        $mail->addAddress($to);
        
        $mail->Subject = $subject;
        $mail->isHTML($isHTML);
        $mail->CharSet = 'UTF-8';
        $mail->Body = $body;
        
        if (!$isHTML) {
            $mail->AltBody = $body;
        }
        
        foreach ($attachments as $file) {
            if (isset($file['tmp_name']) && file_exists($file['tmp_name'])) {
                $mail->addAttachment($file['tmp_name'], $file['name']);
            }
        }
        
        $mail->send();
        return ['success' => true, 'error' => null];
    } catch (Exception $e) {
        return ['success' => false, 'error' => $mail->ErrorInfo];
    }
}