<?php

class ProductController {
    private $model;

    public function __construct() {
        require_once __DIR__ . '/../models/ProductModel.php';
        $this->model = new ProductModel();
    }

    // Действие: список всех товаров
    public function index() {
        $products = $this->model->getAll();
        $this->render('products/list', ['products' => $products]);
    }

    // Действие: просмотр одного товара
    public function view($id) {
        $product = $this->model->getById((int)$id);
        if (!$product) {
            $this->render('error', ['message' => 'Товар не найден']);
            return;
        }
        $this->render('products/view', ['product' => $product]);
    }

    // Вспомогательный метод: подключение файла-шаблона (View)
    private function render($view, $data = []) {
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }
}

class NewsController {
    private $model;

    public function __construct() {
        // Исправлено: подключаем NewsModel, а не ProductModel
        require_once __DIR__ . '/../models/NewsModel.php';
        $this->model = new NewsModel();
    }

    // Действие: список всех новостей
    public function index() {
        $news = $this->model->getAll();
        $this->render('news/list', ['news' => $news]);
    }

    // Вспомогательный метод: подключение файла-шаблона (View)
    private function render($view, $data = []) {
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }
}
