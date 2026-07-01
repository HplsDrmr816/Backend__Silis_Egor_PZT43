<?php
require_once "config.php";

// Подключение к БД
$link = db_connect();

// SQL-запрос: выбрать все новости, отсортированные по убыванию даты
$sql = "SELECT id, title, content, created_at FROM news ORDER BY created_at DESC";
$result = mysqli_query($link, $sql);
?>
<h1>Новости</h1>
<p>Отображение новостей из таблицы <code>news</code> базы данных.</p>
<hr>

<?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div style="border-left: 4px solid #00853A; padding: 10px; margin: 10px 0;">
            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
            <p style="color:#666; font-size:13px;">
                <?php echo date("d.m.Y H:i", strtotime($row['created_at'])); ?>
            </p>
            <p><?php echo htmlspecialchars($row['content']); ?></p>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>Новостей пока нет.</p>
<?php endif; ?>

<?php
// Освобождение памяти и закрытие соединения
mysqli_free_result($result);
mysqli_close($link);
?>

<hr><a href="index.php">Назад</a>
