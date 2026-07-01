<?php
$errors = [];
$success = false;
$fields = ['name' => '', 'email' => ''];

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем и очищаем данные
    $fields['name']  = trim($_POST['name'] ?? '');
    $fields['email'] = trim($_POST['email'] ?? '');
    $password        = $_POST['password'] ?? '';
    $confirm         = $_POST['confirm_password'] ?? '';

    // Валидация: все поля обязательны
    if ($fields['name'] === '')  $errors[] = "Имя обязательно для заполнения";
    if ($fields['email'] === '') $errors[] = "Email обязателен для заполнения";
    if ($password === '')        $errors[] = "Пароль обязателен для заполнения";

    // Email должен быть корректным
    if ($fields['email'] !== '' && !filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Введите корректный email";
    }

    // Пароль не менее 6 символов
    if (strlen($password) < 6) $errors[] = "Пароль должен содержать не менее 6 символов";

    // Пароли должны совпадать
    if ($password !== $confirm) $errors[] = "Пароли не совпадают";

    // Если ошибок нет — регистрация успешна
    if (empty($errors)) {
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание 3 — Регистрация</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 40px auto; padding: 20px; background: #f5f5f5; }
        .container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 20px rgba(0,0,0,.1); }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; font-size: 15px; }
        .btn { width: 100%; padding: 12px; background: #00853A; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        .btn:hover { background: #00622B; }
        .errors { background: #ffe6e6; border-left: 4px solid #dc3545; padding: 12px; margin-bottom: 20px; }
        .errors li { color: #dc3545; }
        .success { background: #e6f4ec; border-left: 4px solid #00853A; padding: 15px; margin-bottom: 20px; }
        a { color: #00853A; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Регистрация</h2>

        <?php if ($success): ?>
            <!-- Успешная регистрация -->
            <div class="success">
                <h3>Регистрация прошла успешно!</h3>
                <p><b>Имя:</b> <?php echo htmlspecialchars($fields['name']); ?></p>
                <p><b>Email:</b> <?php echo htmlspecialchars($fields['email']); ?></p>
            </div>
            <p><a href="register.php">Зарегистрировать ещё</a></p>
        <?php else: ?>
            <!-- Вывод ошибок валидации -->
            <?php if (!empty($errors)): ?>
                <div class="errors">
                    <ul>
                        <?php foreach ($errors as $err) echo "<li>" . htmlspecialchars($err) . "</li>"; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Форма отправляется методом POST на этот же скрипт -->
            <form method="POST" action="register.php">
                <div class="form-group">
                    <label for="name">Имя:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($fields['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($fields['email']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Подтверждение пароля:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn">Зарегистрироваться</button>
            </form>
        <?php endif; ?>
    </div>
    <p><a href="index.php">← Назад к списку</a></p>
</body>
</html>
