<?php
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = 'SQL911119911119';
const DB_NAME = 'techno_store';

function db() {
    static $link = null;
    if ($link === null) {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$link) die('Ошибка подключения: ' . mysqli_connect_error());
        mysqli_set_charset($link, 'utf8mb4');
    }
    return $link;
}
