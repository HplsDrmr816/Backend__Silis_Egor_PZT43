<?php

// Объявление класса User
class User {
    // Свойства класса (публичные)
    public $name;
    public $email;
    public $age;

    // Конструктор — вызывается при создании объекта
    public function __construct($name, $email, $age) {
        $this->name  = $name;
        $this->email = $email;
        $this->age   = $age;
    }

    // Метод: возвращает информацию о пользователе
    public function getInfo() {
        return "Имя: {$this->name}, Email: {$this->email}, Возраст: {$this->age}";
    }

    // Метод: приветствие
    public function greet() {
        return "Привет, я {$this->name}!";
    }
}

echo "<h1>Задание 1 — Базовый класс</h1>";

// Создание объектов (экземпляров класса)
$user1 = new User("Анна", "anna@mail.com", 20);
$user2 = new User("Иван", "ivan@mail.com", 22);

echo "<h2>Объекты</h2>";
echo "<pre>";
echo $user1->getInfo() . "\n";
echo $user2->getInfo() . "\n";
echo "\n" . $user1->greet() . "\n";
echo $user2->greet() . "\n";
echo "</pre>";

echo "<h2>Доступ к свойствам</h2>";
echo "<pre>";
echo "Имя первого пользователя: " . $user1->name . "\n";
echo "Email второго: " . $user2->email . "\n";
echo "</pre>";

echo "<h2>Дамп объекта через var_dump</h2>";
echo "<pre>";
var_dump($user1);
echo "</pre>";

echo "<hr><a href='index.php'>Назад</a>";
?>
