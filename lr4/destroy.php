<?php
// Сброс сессии (для счётчика)
session_start();
$_SESSION = [];
session_destroy();
header('Location: count.php');
exit;
