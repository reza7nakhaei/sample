<?php

require_once(__DIR__ . '/../backend/db.php');

$username = "admin";
$password = "soheil1378";


$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO users (username, password_hash) VALUES (?, ?) ";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPassword);
mysqli_stmt_execute($stmt);


echo "کاربر با رمز عبور هش‌شده ایجاد شد.";
