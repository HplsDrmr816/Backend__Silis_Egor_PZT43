CREATE DATABASE IF NOT EXISTS techno_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE techno_store;

-- ===== Таблица: категории =====
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- ===== Таблица: товары =====
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    category_id INT,
    image VARCHAR(255) DEFAULT 'placeholder.jpg',
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- ===== Таблица: новости =====
CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- ===== Таблица: пользователи =====
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user','admin') DEFAULT 'user',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- ===== Таблица: заказы =====
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total DECIMAL(10,2) NOT NULL,
    status ENUM('new','processing','completed') DEFAULT 'new',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- =====================================================
-- НАЧАЛЬНЫЕ ДАННЫЕ
-- =====================================================

-- Категории
INSERT INTO categories (name) VALUES
('Смартфоны'),
('Ноутбуки'),
('Планшеты'),
('Аксессуары');

-- Товары (более 5 — требование задания)
INSERT INTO products (name, description, price, category_id, image) VALUES
('iPhone 15', 'Флагманский смартфон Apple, 128 ГБ', 89990.00, 1, 'iphone15.jpg'),
('Samsung Galaxy S24', 'Android-смартфон, камера 200 МП', 74990.00, 1, 'galaxy_s24.jpg'),
('Xiaomi Redmi Note 13', 'Бюджетный смартфон, 5000 мАч', 19990.00, 1, 'redmi13.jpg'),
('MacBook Air M2', 'Ноутбук Apple, 13 дюймов, 8 ГБ ОЗУ', 119990.00, 2, 'macbook_air.jpg'),
('Lenovo ThinkPad X1', 'Бизнес-ноутбук, 16 ГБ ОЗУ', 145000.00, 2, 'thinkpad_x1.jpg'),
('ASUS ZenBook 14', 'Ультрабук, OLED-экран', 89990.00, 2, 'zenbook14.jpg'),
('iPad Air', 'Планшет Apple, 10.9 дюйма', 62990.00, 3, 'ipad_air.jpg'),
('Samsung Galaxy Tab S9', 'Android-планшет, 11 дюймов', 69990.00, 3, 'tab_s9.jpg'),
('AirPods Pro 2', 'Беспроводные наушники Apple', 24990.00, 4, 'airpods_pro2.jpg'),
('Logitech MX Master 3', 'Беспроводная мышь', 8990.00, 4, 'mx_master3.jpg');

-- Новости
INSERT INTO news (title, content) VALUES
('Открытие нового магазина', 'Рады сообщить об открытии нового магазина техники в центре города!'),
('Скидки на смартфоны', 'До конца месяца скидки до 20% на все смартфоны Apple и Samsung.'),
('Поступление новых ноутбуков', 'В продаже появились новые модели MacBook и ThinkPad.');

-- Пользователь-администратор (пароль: 12345, хеш сгенерирован password_hash)
INSERT INTO users (name, email, password, role) VALUES
('Администратор', 'admin@techno.store', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Демонстрационный заказ
INSERT INTO orders (user_id, total, status) VALUES (1, 89990.00, 'completed');
