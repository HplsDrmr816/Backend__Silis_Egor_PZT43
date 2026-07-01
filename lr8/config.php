<?php

const DB_HOST = 'localhost';   // или 'localhost'
const DB_USER = 'root';
const DB_PASS = 'SQL911119911119'; 
const DB_NAME = 'techno_store';
const DB_PORT = 3306;         // стандартный порт

function db_connect() {
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    if (!$link) {
        die('Ошибка подключения к MySQL: ' . mysqli_connect_error());
    }
    mysqli_set_charset($link, 'utf8mb4');
    return $link;
}
?>