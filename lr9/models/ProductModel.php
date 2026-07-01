<?php

class ProductModel {

    // Получить все товары
    public function getAll(): array {
        $result = mysqli_query(db(), "SELECT id, name, category, description, price FROM products ORDER BY id");
        if (!$result) return [];
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    // Получить один товар по id
    public function getById(int $id): ?array {
        $id   = (int)$id;
        $link = db();
        $sql  = "SELECT id, name, category, description, price FROM products WHERE id = $id LIMIT 1";
        $result = mysqli_query($link, $sql);
        if (!$result) return null;
        $row = mysqli_fetch_assoc($result);
        return $row ?: null;
    }
}
