<?php
require_once __DIR__ . '/backend/db.php';

// جدول sections (سکشن اول: عنوان و توضیحات)
mysqli_execute_query(
    $conn,
    "CREATE TABLE IF NOT EXISTS sections (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL UNIQUE,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL
    )"
);

// جدول services (سکشن دوم: فقط عنوان خدمات)
mysqli_execute_query(
    $conn,
    "CREATE TABLE IF NOT EXISTS services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL
    )"
);

// جدول project_categories
mysqli_execute_query(
    $conn,
    "CREATE TABLE IF NOT EXISTS project_categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL UNIQUE
    )"
);

// جدول projects
mysqli_execute_query(
    $conn,
    "CREATE TABLE IF NOT EXISTS projects (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category_id INT NOT NULL,
        image_path VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (category_id) REFERENCES project_categories(id)
    )"
);

// جدول social_links
mysqli_execute_query(
    $conn,
    "CREATE TABLE IF NOT EXISTS social_links (
        id INT AUTO_INCREMENT PRIMARY KEY,
        platform VARCHAR(50) NOT NULL,
        url VARCHAR(255) NOT NULL
    )"
);

echo "تمام جداول با موفقیت ایجاد شدند.";
