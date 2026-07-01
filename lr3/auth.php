<?php
// Проверяем, что форма была отправлена
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login_form.php');
    exit;
}

// Получаем логин и пароль
$username = $_POST['username'] ?? '';
$userpass = $_POST['userpass'] ?? '';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результат авторизации</title>
    <style>
        body { font-family: Arial; max-width: 600px; margin: 40px auto; padding: 20px; background: #f5f5f5; }
        .result { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 0 20px rgba(0,0,0,.1); }
        a { color: #00853A; }
    </style>
</head>
<body>
    <div class="result">
        <h2>Добро пожаловать, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>Авторизация выполнена методом <b>POST</b>.</p>
        <p>Логин (через htmlentities): <?php echo htmlentities($username); ?></p>

        <?php
        // Демонстрация: var_dump пришедших данных (для отладки)
        echo "<hr><h3>Отладка \$_POST:</h3><pre>";
        echo htmlspecialchars(print_r($_POST, true));
        echo "</pre>";
        ?>
        <p><a href="login_form.php">← Ввести другие данные</a> | <a href="index.php">К списку</a></p>
    </div>
</body>
</html>
