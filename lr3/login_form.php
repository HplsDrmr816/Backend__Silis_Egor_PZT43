<?php ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание 2 — Авторизация</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 40px auto; padding: 20px; background: #f5f5f5; }
        .form-container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 20px rgba(0,0,0,.1); }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; font-size: 15px; }
        .btn { width: 100%; padding: 12px; background: #00853A; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        .btn:hover { background: #00622B; }
        a.back { color: #00853A; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Авторизация</h2>
        <!-- Форма отправляется методом POST на auth.php -->
        <form action="auth.php" method="POST">
            <div class="form-group">
                <label for="username">Логин:</label>
                <input type="text" id="username" name="username" required placeholder="Введите логин">
            </div>
            <div class="form-group">
                <label for="userpass">Пароль:</label>
                <input type="password" id="userpass" name="userpass" required placeholder="Введите пароль">
            </div>
            <button type="submit" class="btn">Войти</button>
        </form>
    </div>
    <p><a class="back" href="index.php">← Назад к списку</a></p>
</body>
</html>
