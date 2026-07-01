<?php ?>
<?php require __DIR__ . '/../layout/header.php'; ?>

<h1>Добро пожаловать в TechnoStore</h1>
<p>MVC-приложение на чистом PHP (Лабораторная работа №9).</p>

<h2>Архитектура MVC</h2>
<ul>
    <li><b>Model</b> (<code>models/</code>) — работа с базой данных</li>
    <li><b>View</b> (<code>views/</code>) — HTML-шаблоны (представления)</li>
    <li><b>Controller</b> (<code>controllers/</code>) — связывает Model и View</li>
    <li><b>Router</b> (<code>index.php</code>) — фронт-контроллер (роутинг)</li>
</ul>

<p>Перейдите в <a href="index.php?controller=product&action=index">Каталог</a>
   или <a href="index.php?controller=news&action=index">Новости</a>.</p>

<?php require __DIR__ . '/../layout/footer.php'; ?>
