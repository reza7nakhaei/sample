
<?php
$servername = "localhost";
$username = "root"; // یوزر دیتابیس
$password = "";     // پسورد دیتابیس
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("ارتباط برقرار نشد: " . $conn->connect_error);
}

$sql = "
CREATE DATABASE IF NOT EXISTS my_site;
USE my_site;
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";
if ($conn->multi_query($sql) === TRUE) {
    echo "دیتابیس و جدول ساخته شد ✅";
} else {
    echo "خطا: " . $conn->error;
}

$conn->close();
?>
