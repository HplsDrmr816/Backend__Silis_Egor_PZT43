<?php ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>TechnoStore — MVC</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 0 auto; padding: 20px; }
        .nav { background: #00853A; padding: 12px 20px; margin-bottom: 20px; }
        .nav a { color: #fff; text-decoration: none; margin-right: 15px; }
        .product { border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 6px; }
        .price { color: #00853A; font-weight: bold; font-size: 18px; }
        .error { color: #dc3545; text-align: center; padding: 40px; }
    </style>
</head>
<body>
<nav class="nav">
    <a href="index.php">Главная</a>
    <a href="index.php?controller=product&action=index">Каталог</a>
    <a href="index.php?controller=news&action=index">Новости</a>
</nav>
