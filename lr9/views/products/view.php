<?php ?>
<?php require __DIR__ . '/../layout/header.php'; ?>

<h1><?php echo htmlspecialchars($product['name']); ?></h1>
<p style="color:#666;">Категория: <?php echo htmlspecialchars($product['category']); ?></p>
<p class="price"><?php echo number_format($product['price'], 0, ',', ' '); ?> руб.</p>
<p><?php echo htmlspecialchars($product['description']); ?></p>

<p><a href="index.php?controller=product&action=index">← Назад к каталогу</a></p>

<?php require __DIR__ . '/../layout/footer.php'; ?>
