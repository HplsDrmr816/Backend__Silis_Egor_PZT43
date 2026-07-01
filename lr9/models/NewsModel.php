<?php

class NewsModel {

    // Получить все новости (свежие — первые)
    public function getAll(): array {
        $result = mysqli_query(db(), "SELECT id, title, content, created_at FROM news ORDER BY created_at DESC");
        if (!$result) return [];
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    // Получить одну новость по id
    public function getById(int $id): ?array {
        $id   = (int)$id;
        $link = db();
        $sql  = "SELECT id, title, content, created_at FROM news WHERE id = $id LIMIT 1";
        $result = mysqli_query($link, $sql);
        if (!$result) return null;
        $row = mysqli_fetch_assoc($result);
        return $row ?: null;
    }
}
