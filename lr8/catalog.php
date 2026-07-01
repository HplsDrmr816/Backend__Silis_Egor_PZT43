<?php
require_once "config.php";

$link = db_connect();

// ===== ПАРАМЕТРЫ ИЗ GET =====
// Поиск
$search = trim($_GET['search'] ?? '');
// Сортировка
$sort = $_GET['sort'] ?? 'name_asc';
$sortMap = [
    'name_asc'  => 'name ASC',
    'name_desc' => 'name DESC',
    'price_asc' => 'price ASC',
    'price_desc'=> 'price DESC',
];
$order = $sortMap[$sort] ?? 'name ASC';

// Фильтр по категории
$categoryId = (int)($_GET['category'] ?? 0);

// Пагинация
$perPage = 4; // товаров на странице
$page = max(1, (int)($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;

// ===== ПОСТРОЕНИЕ ЗАПРОСА =====
// Базовое условие WHERE
$where = [];
$types = '';
$params = [];

if ($search !== '') {
    $where[] = "name LIKE ?";
    $types .= 's';
    $params[] = "%$search%";
}
if ($categoryId > 0) {
    $where[] = "category_id = ?";
    $types .= 'i';
    $params[] = $categoryId;
}
$whereSql = count($where) > 0 ? "WHERE " . implode(" AND ", $where) : "";

// Подсчёт общего числа товаров (для пагинации)
$countSql = "SELECT COUNT(*) as total FROM products $whereSql";
$stmtCount = mysqli_prepare($link, $countSql);
if ($types !== '') {
    mysqli_stmt_bind_param($stmtCount, $types, ...$params);
}
mysqli_stmt_execute($stmtCount);
$total = mysqli_fetch_assoc(mysqli_stmt_get_result($stmtCount))['total'];
$totalPages = max(1, ceil($total / $perPage));
mysqli_stmt_close($stmtCount);

// Основной запрос с LIMIT для пагинации
$sql = "SELECT p.id, p.name, p.description, p.price, p.image, c.name AS category_name
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        $whereSql
        ORDER BY $order
        LIMIT $perPage OFFSET $offset";

$stmt = mysqli_prepare($link, $sql);
if ($types !== '') {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Категории для фильтра
$cats = mysqli_query($link, "SELECT id, name FROM categories ORDER BY name");
?>
<h1>Каталог техники</h1>

<!-- Форма поиска и фильтрации -->
<form method="GET" action="catalog.php">
    <p>
        Поиск: <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Название товара">

        Категория:
        <select name="category">
            <option value="0">Все</option>
            <?php while ($c = mysqli_fetch_assoc($cats)): ?>
                <option value="<?php echo $c['id']; ?>" <?php echo $categoryId == $c['id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($c['name']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        Сортировка:
        <select name="sort">
            <option value="name_asc"  <?php echo $sort === 'name_asc' ? 'selected' : ''; ?>>По названию (А-Я)</option>
            <option value="name_desc" <?php echo $sort === 'name_desc' ? 'selected' : ''; ?>>По названию (Я-А)</option>
            <option value="price_asc" <?php echo $sort === 'price_asc' ? 'selected' : ''; ?>>Сначала дешёвые</option>
            <option value="price_desc"<?php echo $sort === 'price_desc' ? 'selected' : ''; ?>>Сначала дорогие</option>
        </select>

        <button type="submit">Применить</button>
    </p>
</form>

<p>Найдено товаров: <b><?php echo $total; ?></b></p>
<hr>

<!-- Вывод каталога -->
<div style="display:grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div style="border: 1px solid #ddd; padding: 15px; border-radius: 8px;">
            <!-- Заглушка под фото товара (заменить на img/products/файл.jpg) -->
            <div style="width:100%; height:120px; background:#e9ecef; display:flex; align-items:center; justify-content:center; border-radius:4px; margin-bottom:10px;">
                [фото: <?php echo htmlspecialchars($row['image']); ?>]
            </div>
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p style="color:#666; font-size:13px;"><?php echo htmlspecialchars($row['category_name']); ?></p>
            <p><?php echo htmlspecialchars(mb_strimwidth($row['description'], 0, 60, '...')); ?></p>
            <p><b style="color:#00853A; font-size:18px;">
                <?php echo number_format($row['price'], 0, ',', ' '); ?> руб.
            </b></p>
        </div>
    <?php endwhile; ?>
</div>

<?php if (mysqli_num_rows($result) === 0): ?>
    <p>Товары не найдены.</p>
<?php endif; ?>

<!-- Пагинация -->
<?php if ($totalPages > 1): ?>
    <hr>
    <p>Страницы:
    <?php
    // Сохраняем параметры фильтра в ссылках пагинации
    $queryParams = array_filter([
        'search' => $search,
        'category' => $categoryId > 0 ? $categoryId : null,
        'sort' => $sort,
    ]);
    for ($p = 1; $p <= $totalPages; $p++) {
        $queryParams['page'] = $p;
        $style = $p == $page ? "font-weight:bold; font-size:18px;" : "";
        echo " <a href='?" . http_build_query($queryParams) . "' style='$style'>$p</a>";
    }
    ?>
    </p>
<?php endif; ?>

<?php
mysqli_stmt_close($stmt);
mysqli_close($link);
?>
<hr><a href="index.php">Назад</a>
