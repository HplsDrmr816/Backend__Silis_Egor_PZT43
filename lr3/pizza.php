<?php
// Прайс размеров
$sizePrices = ['small' => 250, 'medium' => 350, 'large' => 450];
// Прайс топпингов
$toppingPrices = ['сыр' => 50, 'грибы' => 70, 'колбаса' => 80, 'оливки' => 60];

$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';
$size = $_POST['size'] ?? null;
$toppings = $_POST['toppings'] ?? [];
$comment = $_POST['comment'] ?? '';
$delivery = $_POST['delivery'] ?? null;

$total = 0;
if ($submitted && isset($sizePrices[$size])) {
    $total += $sizePrices[$size];
    foreach ($toppings as $t) {
        if (isset($toppingPrices[$t])) $total += $toppingPrices[$t];
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание 4 — Заказ пиццы</title>
    <style>
        body { font-family: Arial; max-width: 600px; margin: 30px auto; padding: 20px; background: #f5f5f5; }
        .container { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 0 20px rgba(0,0,0,.1); }
        .group { margin-bottom: 18px; }
        label { display: block; font-weight: bold; margin-bottom: 6px; }
        .btn { padding: 12px 20px; background: #00853A; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        .btn:hover { background: #00622B; }
        .order { background: #e6f4ec; border-left: 4px solid #00853A; padding: 15px; margin-top: 20px; border-radius: 4px; }
        .order table { width: 100%; } .order td { padding: 4px 0; }
        a { color: #00853A; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Заказ пиццы</h2>
        <!-- Метод POST, обработчик — этот же файл -->
        <form method="POST" action="pizza.php">
            <div class="group">
                <label>Размер пиццы:</label>
                <?php foreach ($sizePrices as $key => $price): ?>
                    <label><input type="radio" name="size" value="<?php echo $key; ?>"
                        <?php echo ($size === $key || (!$submitted && $key === 'medium')) ? 'checked' : ''; ?>>
                        <?php echo ucfirst($key); ?> — <?php echo $price; ?> руб.</label><br>
                <?php endforeach; ?>
            </div>

            <div class="group">
                <label>Топпинги:</label>
                <?php foreach ($toppingPrices as $key => $price): ?>
                    <label><input type="checkbox" name="toppings[]" value="<?php echo $key; ?>"
                        <?php echo in_array($key, $toppings) ? 'checked' : ''; ?>>
                        <?php echo ucfirst($key); ?> (+<?php echo $price; ?> руб.)</label><br>
                <?php endforeach; ?>
            </div>

            <div class="group">
                <label for="comment">Комментарий к заказу:</label>
                <textarea id="comment" name="comment" rows="3" cols="40"><?php echo htmlspecialchars($comment); ?></textarea>
            </div>

            <div class="group">
                <label for="delivery">Способ доставки:</label>
                <select id="delivery" name="delivery">
                    <option value="pickup" <?php echo $delivery === 'pickup' ? 'selected' : ''; ?>>Самовывоз</option>
                    <option value="courier" <?php echo $delivery === 'courier' ? 'selected' : ''; ?>>Курьером</option>
                </select>
            </div>

            <button type="submit" class="btn">Заказать</button>
        </form>

        <?php if ($submitted): ?>
            <!-- Вывод результата заказа -->
            <div class="order">
                <h3>Ваш заказ:</h3>
                <table>
                    <tr><td>Размер:</td><td><?php echo htmlspecialchars($size); ?> — <?php echo $sizePrices[$size] ?? 0; ?> руб.</td></tr>
                    <tr><td>Топпинги:</td><td>
                        <?php
                        if (empty($toppings)) {
                            echo "без топпингов";
                        } else {
                            echo htmlspecialchars(implode(", ", $toppings));
                        }
                        ?>
                    </td></tr>
                    <tr><td>Комментарий:</td><td><?php echo htmlspecialchars($comment ?: '—'); ?></td></tr>
                    <tr><td>Доставка:</td><td><?php echo $delivery === 'courier' ? 'Курьером' : 'Самовывоз'; ?></td></tr>
                    <tr><td><b>Итого:</b></td><td><b><?php echo $total; ?> руб.</b></td></tr>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <p><a href="index.php">← Назад к списку</a></p>
</body>
</html>
