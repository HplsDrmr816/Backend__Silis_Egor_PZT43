<?php

// Базовый абстрактный класс для товаров
abstract class Product {
    protected $name;
    protected $price;
    protected $category;

    public function __construct($name, $price, $category) {
        $this->name     = $name;
        $this->price    = $price;
        $this->category = $category;
    }

    // Абстрактный метод — должен быть реализован в дочерних классах
    abstract public function getDisplayInfo();

    // Геттеры (инкапсуляция: чтение protected-свойств)
    public function getName()     { return $this->name; }
    public function getPrice()    { return $this->price; }
    public function getCategory() { return $this->category; }

    // Метод применения скидки
    public function applyDiscount($percent) {
        $this->price = $this->price - ($this->price * $percent / 100);
        return $this->price;
    }
}

// Класс для техники (смартфоны, ноутбуки и т.д.)
class TechProduct extends Product {
    private $brand;
    private $warranty; // гарантия в месяцах

    public function __construct($name, $price, $category, $brand, $warranty) {
        parent::__construct($name, $price, $category);
        $this->brand    = $brand;
        $this->warranty = $warranty;
    }

    // Реализация абстрактного метода
    public function getDisplayInfo() {
        return sprintf(
            "%s %s — %s | Цена: %d руб. | Гарантия: %d мес.",
            $this->brand, $this->name, $this->category, $this->price, $this->warranty
        );
    }

    public function getBrand() { return $this->brand; }
}

echo "<h1>Задание 3 — Класс Product (каталог техники)</h1>";

// Создание объектов товаров
$phone  = new TechProduct("iPhone 15", 89990, "смартфоны", "Apple", 12);
$laptop = new TechProduct("ThinkPad X1", 145000, "ноутбуки", "Lenovo", 24);
$tv     = new TechProduct("OLED C3", 110000, "телевизоры", "LG", 36);

$products = [$phone, $laptop, $tv];

echo "<h2>Каталог техники</h2>";
echo "<pre>";
foreach ($products as $p) {
    echo $p->getDisplayInfo() . "\n";
}
echo "</pre>";

echo "<h2>Применение скидки 10%</h2>";
echo "<pre>";
echo "Старая цена {$phone->getName()}: " . $phone->getPrice() . " руб.\n";
$newPrice = $phone->applyDiscount(10);
echo "Новая цена со скидкой 10%: $newPrice руб.\n";
echo "</pre>";

echo "<h2>Доступ к свойствам через геттеры</h2>";
echo "<pre>";
echo "Название: " . $phone->getName() . "\n";
echo "Категория: " . $phone->getCategory() . "\n";
echo "Бренд: " . $phone->getBrand() . "\n";
echo "</pre>";

echo "<hr><a href='index.php'>Назад</a>";
?>
