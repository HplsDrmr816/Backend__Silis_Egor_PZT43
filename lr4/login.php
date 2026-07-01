<?php
session_start();

// Если уже авторизован — перенаправляем в админку
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

// Обработка отправки формы входа
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $pass  = $_POST['password'] ?? '';

    // Учётные данные администратора (в реальном проекте — проверка в БД)
    $validLogin = 'admin';
    // Хеш пароля "12345"
    $validHash = password_hash('12345', PASSWORD_DEFAULT);

    if ($login === $validLogin && password_verify($pass, $validHash)) {
        // Успешный вход — регенерируем ID сессии (защита от фиксации)
        session_regenerate_id(true);
        $_SESSION['user'] = $login;
        $_SESSION['role'] = 'admin';
        $_SESSION['logged_at'] = time();
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Неверный логин или пароль';
    }
}

// Сообщение об истечении срока сессии
$expired = isset($_GET['expired']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в админку</title>
    <style>
        body { font-family: Arial; max-width: 450px; margin: 60px auto; padding: 20px; background: #f5f5f5; }
        .container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 20px rgba(0,0,0,.1); }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; font-size: 15px; }
        .btn { width: 100%; padding: 12px; background: #00853A; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        .btn:hover { background: #00622B; }
        .error { color: #dc3545; background: #ffe6e6; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .hint { background: #e6f4ec; padding: 10px; border-radius: 4px; font-size: 13px; color: #555; margin-top: 15px; }
        a { color: #00853A; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Авторизация администратора</h2>

        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if ($expired): ?>
            <div class="error">Сессия истекла. Войдите снова.</div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="login">Логин:</label>
                <input type="text" id="login" name="login" required placeholder="admin">
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required placeholder="••••••">
            </div>
            <button type="submit" class="btn">Войти</button>
        </form>

        <div class="hint">
            <b>Тестовые данные:</b> логин <code>admin</code>, пароль <code>12345</code>
        </div>
    </div>
    <p style="text-align:center;"><a href="index.php">← Назад к списку</a></p>
</body>
</html>
