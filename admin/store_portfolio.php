<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../classes/Portfolio.php';

$db = new Database();
$conn = $db->getConnection();
$portfolio = new Portfolio($conn);

// بررسی اینکه فرم ارسال شده
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $category_id = $_POST['category_id'] ?? '';

    // آپلود عکس
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES['image']['tmp_name'];
        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $uploadDir = __DIR__ . '/../uploads/';
        $uploadPath = $uploadDir . $fileName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (move_uploaded_file($fileTmp, $uploadPath)) {
            // ذخیره توی دیتابیس
            $portfolio->create($title, $fileName, $category_id);
            header('Location: dashboard.php?success=1');
            exit;
        } else {
            echo "خطا در آپلود فایل";
        }
    } else {
        echo "فایل انتخاب نشده یا خطا در آپلود";
    }
}
?>