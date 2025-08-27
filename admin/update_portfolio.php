<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../classes/Portfolio.php';

$db = new Database();
$conn = $db->getConnection();
$portfolio = new Portfolio($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];

    // گرفتن نمونه‌کار فعلی برای آپدیت تصویر
    $items = $portfolio->getAll();
    $currentItem = null;
    foreach ($items as $p) {
        if ($p['id'] == $id) {
            $currentItem = $p;
            break;
        }
    }

    $image = $currentItem['image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES['image']['tmp_name'];
        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $uploadDir = __DIR__ . '/../uploads/';
        $uploadPath = $uploadDir . $fileName;

        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        if (move_uploaded_file($fileTmp, $uploadPath)) {
            $image = $fileName;
        }
    }

    $portfolio->id = $id;
    $portfolio->title = $title;
    $portfolio->category_id = $category_id;
    $portfolio->image = $image;
    $portfolio->update();

    header('Location: dashboard.php?updated=1');
    exit;
}
?>
