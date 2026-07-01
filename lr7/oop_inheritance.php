<?php

// Базовый класс
class Animal {
    protected $name;
    protected $sound;

    public function __construct($name) {
        $this->name = $name;
    }

    public function makeSound() {
        return $this->name . " издаёт звук: " . $this->sound;
    }
}

// Дочерний класс Dog наследует Animal
class Dog extends Animal {
    public function __construct($name) {
        parent::__construct($name); // вызов конструктора родителя
        $this->sound = "Гав-гав";
    }

    // Переопределение метода
    public function makeSound() {
        return "Собака " . parent::makeSound();
    }
}

// Дочерний класс Cat
class Cat extends Animal {
    public function __construct($name) {
        parent::__construct($name);
        $this->sound = "Мяу";
    }

    public function makeSound() {
        return "Кошка " . parent::makeSound();
    }
}

echo "<h1>Задание 2 — Наследование</h1>";

// Создание объектов дочерних классов
$dog = new Dog("Шарик");
$cat = new Cat("Мурка");

echo "<h2>Вызов переопределённых методов</h2>";
echo "<pre>";
echo $dog->makeSound() . "\n";
echo $cat->makeSound() . "\n";
echo "</pre>";

echo "<h2>Демонстрация инкапсуляции (protected)</h2>";
echo "<p>Свойства <code>\$name</code> и <code>\$sound</code> объявлены как <b>protected</b> —
       они доступны внутри класса и его наследников, но не снаружи напрямую.</p>";

echo "<hr><a href='index.php'>Назад</a>";
?>
