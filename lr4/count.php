<?php
session_start();

// Инициализация счётчика в сессии
if (!isset($_SESSION['page_views'])) {
    $_SESSION['page_views'] = 0;
}
$_SESSION['page_views']++;

// Cookie "последний визит" хранится 30 дней
if (!isset($_COOKIE['last_visit'])) {
    setcookie('last_visit', date('Y-m-d H:i:s'), time() + 86400 * 30, '/');
}
$lastVisit = $_COOKIE['last_visit'] ?? 'первый раз';
?>
<h1>Счётчик посещений</h1>

<p>Вы открыли эту страницу <b><?php echo $_SESSION['page_views']; ?></b> раз(а) за текущую сессию.</p>

<h3>Информация о состоянии:</h3>
<ul>
    <li><b>Предыдущий визит:</b> <?php echo htmlspecialchars($lastVisit); ?></li>
    <li><b>Имя сессии:</b> <?php echo session_name(); ?></li>
    <li><b>ID сессии:</b> <?php echo session_id(); ?></li>
</ul>

<p>
    <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>">Обновить страницу</a> |
    <a href="destroy.php">Сбросить сессию</a>
</p>

<hr><a href="index.php">Назад</a>
