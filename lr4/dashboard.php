<?php
session_start();

// Проверка авторизации
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Проверка бездействия (максимум 15 минут = 900 сек)
$timeout = 900;
if (time() - ($_SESSION['logged_at'] ?? 0) > $timeout) {
    session_destroy();
    header('Location: login.php?expired=1');
    exit;
}
// Продлеваем время активности
$_SESSION['logged_at'] = time();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора</title>
    <style>
        body { font-family: Arial; max-width: 700px; margin: 40px auto; padding: 20px; background: #f5f5f5; }
        .header-bar { background: #00853A; color: #fff; padding: 20px 30px; border-radius: 8px 8px 0 0; display: flex; justify-content: space-between; align-items: center; }
        .panel { background: #fff; padding: 25px 30px; border-radius: 0 0 8px 8px; box-shadow: 0 4px 20px rgba(0,0,0,.1); }
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin: 20px 0; }
        .stat { background: #f8f9fa; padding: 15px; border-radius: 6px; text-align: center; }
        .stat .num { font-size: 28px; font-weight: bold; color: #00853A; }
        .btn-logout { background: #dc3545; color: #fff; padding: 8px 16px; text-decoration: none; border-radius: 4px; }
        a { color: #00853A; }
    </style>
</head>
<body>
    <div class="header-bar">
        <div>
            <h1>Панель администратора</h1>
            <p>Добро пожаловать, <b><?php echo htmlspecialchars($_SESSION['user']); ?></b></p>
        </div>
        <a class="btn-logout" href="logout.php">Выйти</a>
    </div>

    <div class="panel">
        <h3>Информация о сессии</h3>
        <p><b>Пользователь:</b> <?php echo htmlspecialchars($_SESSION['user']); ?></p>
        <p><b>Роль:</b> <?php echo htmlspecialchars($_SESSION['role']); ?></p>
        <p><b>ID сессии:</b> <code><?php echo session_id(); ?></code></p>
        <p><b>Время входа:</b> <?php echo date('d.m.Y H:i:s', $_SESSION['logged_at']); ?></p>

        <h3>Статистика (демонстрационные данные)</h3>
        <div class="stats">
            <div class="stat"><div class="num">42</div>Заказов</div>
            <div class="stat"><div class="num">128</div>Пользователей</div>
            <div class="stat"><div class="num">7</div>Новых отзывов</div>
        </div>

        <p><i>Сессия автоматически завершится через 15 минут бездействия.</i></p>
        <p><a href="index.php">← Назад к списку ЛР</a></p>
    </div>
</body>
</html>
