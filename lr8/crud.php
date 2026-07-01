<?php
require_once "config.php";

$link = db_connect();

// ===== Обработка действий =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create') {
        $name = trim($_POST['name']);
        $price = (float)$_POST['price'];
        $cat = (int)$_POST['category_id'];
        $desc = trim($_POST['description']);
        $stmt = mysqli_prepare($link, "INSERT INTO products (name, description, price, category_id) VALUES (?,?,?,?)");
        mysqli_stmt_bind_param($stmt, 'ssdi', $name, $desc, $price, $cat);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    elseif ($action === 'update') {
        $id = (int)$_POST['id'];
        $price = (float)$_POST['price'];
        $stmt = mysqli_prepare($link, "UPDATE products SET price = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'di', $price, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    elseif ($action === 'delete') {
        $id = (int)$_POST['id'];
        $stmt = mysqli_prepare($link, "DELETE FROM products WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// Все товары (Read)
$products = mysqli_query($link, "SELECT p.*, c.name AS cat_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.id");
// Все категории
$cats = mysqli_query($link, "SELECT id, name FROM categories ORDER BY name");
$catsArr = [];
while ($c = mysqli_fetch_assoc($cats)) $catsArr[] = $c;
?>
<h1>CRUD — Управление товарами</h1>
<p>Демонстрация всех SQL-команд: <b>INSERT</b> (создание), <b>SELECT</b> (чтение),
   <b>UPDATE</b> (обновление), <b>DELETE</b> (удаление).</p>
<hr>

<!-- CREATE: форма добавления -->
<h2>Добавить товар</h2>
<form method="POST" action="crud.php">
    <input type="hidden" name="action" value="create">
    <p>Название: <input type="text" name="name" required style="width:250px;"></p>
    <p>Описание: <input type="text" name="description" style="width:300px;"></p>
    <p>Цена: <input type="number" step="0.01" name="price" required> руб.</p>
    <p>Категория:
        <select name="category_id">
            <?php foreach ($catsArr as $c): ?>
                <option value="<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p><button type="submit">Добавить</button></p>
</form>

<hr>

<!-- READ: список товаров -->
<h2>Список товаров</h2>
<table border="1" cellpadding="8" style="border-collapse: collapse;">
    <tr style="background:#f0f0f0;">
        <th>ID</th><th>Название</th><th>Категория</th><th>Цена</th><th colspan="2">Действия</th>
    </tr>
    <?php while ($p = mysqli_fetch_assoc($products)): ?>
        <tr>
            <td><?php echo $p['id']; ?></td>
            <td><?php echo htmlspecialchars($p['name']); ?></td>
            <td><?php echo htmlspecialchars($p['cat_name']); ?></td>
            <td><?php echo number_format($p['price'], 0, ',', ' '); ?> руб.</td>
            <!-- UPDATE: форма изменения цены -->
            <td>
                <form method="POST" action="crud.php" style="display:inline;">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                    <input type="number" step="0.01" name="price" value="<?php echo $p['price']; ?>" style="width:80px;">
                    <button type="submit">Изменить</button>
                </form>
            </td>
            <!-- DELETE: форма удаления -->
            <td>
                <form method="POST" action="crud.php" style="display:inline;"
                      onsubmit="return confirm('Удалить товар?');">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                    <button type="submit" style="color:red;">Удалить</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php mysqli_close($link); ?>
<hr><a href="index.php">Назад</a>
