<?php
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/classes/User.php';

// اتصال به دیتابیس
$db = new Database();
$conn = $db->getConnection();

// نمونه‌سازی کلاس User
$user = new User($conn);

// ایمیل و پسورد ادمین (می‌تونی بعدا عوضش کنی)
$email = "admin@example.com";
$password = "123456";

// ایجاد ادمین
if ($user->createAdmin($email, $password)) {
    echo "Admin created successfully!";
} else {
    echo "Admin creation failed!";
}
