<?php

require_once __DIR__ . '/config.php';

// Получаем параметры маршрута (по умолчанию — главная страница)
$controllerName = $_GET['controller'] ?? 'home';
$action         = $_GET['action'] ?? 'index';
$id             = $_GET['id'] ?? null;

// Главная страница — отдельный простой View без контроллера
if ($controllerName === 'home') {
    require __DIR__ . '/views/home.php';
    exit;
}

// Формируем имя файла и класса контроллера
$controllerFile = __DIR__ . '/controllers/' . ucfirst($controllerName) . 'Controller.php';
$controllerClass = ucfirst($controllerName) . 'Controller';

// Проверяем существование контроллера
if (!file_exists($controllerFile)) {
    die('Контроллер не найден: ' . htmlspecialchars($controllerName));
}

require_once $controllerFile;
$controller = new $controllerClass();

// Вызов действия (action) с передачей id, если есть
if (method_exists($controller, $action)) {
    if ($id !== null) {
        $controller->$action($id);
    } else {
        $controller->$action();
    }
} else {
    die('Действие не найдено: ' . htmlspecialchars($action));
}
