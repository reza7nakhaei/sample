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
$portfolioObj = new Portfolio($conn);

// گرفتن آی‌دی نمونه‌کار از آدرس
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: dashboard.php');
    exit;
}

// گرفتن اطلاعات نمونه‌کار
$portfolios = $portfolioObj->getAll();
$item = null;
foreach ($portfolios as $p) {
    if ($p['id'] == $id) {
        $item = $p;
        break;
    }
}

if (!$item) {
    header('Location: dashboard.php');
    exit;
}

// گرفتن دسته‌بندی‌ها
$stmt = $conn->query("SELECT * FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ویرایش نمونه‌کار</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white shadow-lg rounded-2xl p-6 w-full max-w-lg">

    <h2 class="text-xl font-bold text-gray-700 mb-4">ویرایش نمونه‌کار</h2>

    <form action="update_portfolio.php" method="POST" enctype="multipart/form-data" class="space-y-4">
        <input type="hidden" name="id" value="<?= $item['id'] ?>">

        <div>
            <label class="block text-gray-600 mb-1">عنوان</label>
            <input type="text" name="title" value="<?= htmlspecialchars($item['title']) ?>" required
                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block text-gray-600 mb-1">دسته‌بندی</label>
            <select name="category_id" required
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $item['category_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-gray-600 mb-1">تصویر فعلی</label>
            <?php if (!empty($item['image'])): ?>
                <img src="../uploads/<?= htmlspecialchars($item['image']) ?>" class="w-32 h-32 object-cover mb-2 rounded">
            <?php endif; ?>
            <input type="file" name="image" accept="image/*"
                   class="w-full border rounded-lg px-3 py-2 bg-white">
            <p class="text-sm text-gray-500">اگر تصویری جدید انتخاب کنید، تصویر قبلی جایگزین می‌شود.</p>
        </div>

        <button type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg font-semibold">
            ذخیره تغییرات
        </button>
    </form>

</div>
</body>
</html>
