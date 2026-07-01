<?php  ?>
<?php require __DIR__ . '/../layout/header.php'; ?>

<h1>Новости</h1>

<?php foreach ($news as $n): ?>
    <div class="product">
        <h3><?php echo htmlspecialchars($n['title']); ?></h3>
        <p style="color:#666; font-size:13px;">
            <?php echo date("d.m.Y", strtotime($n['created_at'])); ?>
        </p>
        <p><?php echo htmlspecialchars($n['content']); ?></p>
    </div>
<?php endforeach; ?>

<?php require __DIR__ . '/../layout/footer.php'; ?>
