<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../classes/Portfolio.php';

$db = new Database();
$conn = $db->getConnection();
$portfolio = new Portfolio($conn);

// بررسی وجود آی‌دی نمونه‌کار
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // اول عکس قبلی رو حذف کن
    $stmt = $conn->prepare("SELECT image FROM portfolios WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($item && !empty($item['image'])) {
        $filePath = __DIR__ . '/../uploads/' . $item['image'];
        if (file_exists($filePath)) unlink($filePath);
    }

    // حالا رکورد رو حذف کن
    $portfolio->delete($id);
}

header('Location: dashboard.php');
exit;
?>
