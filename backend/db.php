<?php
require_once(__DIR__ . '/../config.php');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

if (!$conn) {
    die("خطا در اتصال به دیتابیس : " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS " . DB_NAME);
mysqli_select_db($conn, DB_NAME);
