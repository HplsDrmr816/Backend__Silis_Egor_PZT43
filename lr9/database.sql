-- ЛР9 — База данных TechnoStore
-- Создать БД и таблицы, заполнить тестовыми данными

CREATE DATABASE IF NOT EXISTS techno_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE techno_store;

-- Таблица товаров
CREATE TABLE IF NOT EXISTS products (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(200) NOT NULL,
    category    VARCHAR(100) NOT NULL,
    description TEXT,
    price       DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Таблица новостей
CREATE TABLE IF NOT EXISTS news (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    title      VARCHAR(255) NOT NULL,
    content    TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Тестовые товары
INSERT INTO products (name, category, description, price) VALUES
('iPhone 15 Pro',     'Смартфоны',  'Флагманский смартфон Apple с чипом A17 Pro и камерой 48 МП.',  99990.00),
('Samsung Galaxy S24','Смартфоны',  'Топовый Android-смартфон с функциями искусственного интеллекта.', 79990.00),
('MacBook Air M3',    'Ноутбуки',   'Ультратонкий ноутбук Apple на чипе M3 с автономностью 18 часов.', 129990.00),
('ASUS ZenBook 14',   'Ноутбуки',   'Компактный ноутбук с OLED-дисплеем и процессором Intel Core Ultra.', 74990.00),
('Sony WH-1000XM5',  'Наушники',   'Беспроводные наушники с лучшим в классе шумоподавлением.',        29990.00);

-- Тестовые новости
INSERT INTO news (title, content, created_at) VALUES
('Открытие магазина TechnoStore',
 'Мы рады сообщить об открытии нашего интернет-магазина электроники. Широкий ассортимент, честные цены!',
 '2026-01-15 10:00:00'),
('Новые поступления: смартфоны 2026',
 'В наш каталог добавлены новейшие смартфоны 2026 года от Apple, Samsung и других производителей.',
 '2026-03-20 12:30:00'),
('Скидки до 20% на ноутбуки',
 'Только в апреле — специальные цены на все ноутбуки в каталоге. Успейте купить по выгодной цене!',
 '2026-04-01 09:00:00');
