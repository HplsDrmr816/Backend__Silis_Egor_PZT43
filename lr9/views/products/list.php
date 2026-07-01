<?php ?>
<?php require __DIR__ . '/../layout/header.php'; ?>

<h1>Каталог техники</h1>

<?php foreach ($products as $p): ?>
    <div class="product">
        <h3>
            <a href="index.php?controller=product&action=view&id=<?php echo $p['id']; ?>">
                <?php echo htmlspecialchars($p['name']); ?>
            </a>
        </h3>
        <p style="color:#666; font-size:13px;"><?php echo htmlspecialchars($p['category']); ?></p>
        <p><?php echo htmlspecialchars(mb_strimwidth($p['description'], 0, 80, '...')); ?></p>
        <p class="price"><?php echo number_format($p['price'], 0, ',', ' '); ?> руб.</p>
    </div>
<?php endforeach; ?>

<?php require __DIR__ . '/../layout/footer.php'; ?>
