<?php
$products = [
    ['name' => 'Ноутбук',   'category' => 'электроника', 'price' => 55000],
    ['name' => 'Книга PHP', 'category' => 'книги',       'price' => 1200],
    ['name' => 'Мышь',      'category' => 'электроника', 'price' => 1500],
    ['name' => 'Наушники',  'category' => 'электроника', 'price' => 3500],
    ['name' => 'Книга JS',  'category' => 'книги',       'price' => 980],
    ['name' => 'Клавиатура','category' => 'электроника', 'price' => 2800],
    ['name' => 'Блокнот',   'category' => 'канцелярия',  'price' => 320],
    ['name' => 'Ручка',     'category' => 'канцелярия',  'price' => 80],
];

// Получаем фильтры из GET
$minPrice = $_GET['min_price'] ?? null;
$maxPrice = $_GET['max_price'] ?? null;
$category = $_GET['category'] ?? '';

// Применяем фильтрацию
$filtered = array_filter($products, function($p) use ($minPrice, $maxPrice, $category) {
    if ($minPrice !== null && $minPrice !== '' && $p['price'] < (int)$minPrice) return false;
    if ($maxPrice !== null && $maxPrice !== '' && $p['price'] > (int)$maxPrice) return false;
    if ($category !== '' && $p['category'] !== $category) return false;
    return true;
});

// Уникальные категории для списка
$categories = array_unique(array_column($products, 'category'));
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание 5 — Каталог с фильтром</title>
    <style>
        body { font-family: Arial; max-width: 800px; margin: 30px auto; padding: 20px; background: #f5f5f5; }
        .filter { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,.08); margin-bottom: 20px; }
        .filter label { font-weight: bold; font-size: 14px; }
        .filter input, .filter select { padding: 8px; border: 1px solid #ddd; border-radius: 4px; margin: 0 8px 8px 0; }
        .btn { padding: 10px 18px; background: #00853A; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #00622B; }
        table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; }
        th { background: #00853A; color: #fff; padding: 12px; text-align: left; }
        td { padding: 10px 12px; border-bottom: 1px solid #eee; }
        .presets a { display: inline-block; margin: 5px 5px 5px 0; padding: 6px 12px; background: #e6f4ec; color: #00853A; text-decoration: none; border-radius: 4px; font-size: 13px; }
        a.back { color: #00853A; }
    </style>
</head>
<body>
    <h1>Каталог товаров</h1>

    <!-- Форма фильтрации отправляется методом GET на этот же скрипт -->
    <div class="filter">
        <form method="GET" action="catalog.php">
            <label>Мин. цена: <input type="number" name="min_price" value="<?php echo htmlspecialchars($minPrice); ?>" placeholder="0"></label>
            <label>Макс. цена: <input type="number" name="max_price" value="<?php echo htmlspecialchars($maxPrice); ?>" placeholder="∞"></label>
            <label>Категория:
                <select name="category">
                    <option value="">Все категории</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat; ?>" <?php echo $category === $cat ? 'selected' : ''; ?>>
                            <?php echo ucfirst($cat); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <button type="submit" class="btn">Применить фильтр</button>
        </form>

        <div class="presets">
            <span><b>Быстрые ссылки:</b></span>
            <a href="?min_price=1000">Товары дороже 1000</a>
            <a href="?category=книги">Только книги</a>
            <a href="?category=электроника">Только электроника</a>
            <a href="?">Сбросить фильтр</a>
        </div>
    </div>

    <table>
        <tr><th>Название</th><th>Категория</th><th>Цена</th></tr>
        <?php if (empty($filtered)): ?>
            <tr><td colspan="3" style="text-align:center; padding:30px;">Ничего не найдено</td></tr>
        <?php else: ?>
            <?php foreach ($filtered as $p): ?>
                <tr>
                    <td><?php echo htmlspecialchars($p['name']); ?></td>
                    <td><?php echo htmlspecialchars($p['category']); ?></td>
                    <td><?php echo number_format($p['price'], 0, ',', ' '); ?> руб.</td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <p>Найдено товаров: <b><?php echo count($filtered); ?></b></p>
    <p><a class="back" href="index.php">← Назад к списку</a></p>
</body>
</html>
