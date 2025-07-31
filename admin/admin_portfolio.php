<?php
session_start();
require_once(__DIR__ . '/../backend/db.php');

// فقط اگر کاربر لاگین نکرده بود، ریدایرکت به صفحه لاگین
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $category = $_POST['category'] ?? '';

    // اعتبارسنجی اولیه
    if (empty($category)) {
        $message = "لطفا دسته‌بندی را وارد کنید.";
    } elseif ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $message = "خطا در آپلود فایل.";
    } else {
        $targetDir = __DIR__ . '/../uploads/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . time() . '_' . $fileName;

        // فقط اجازه فرمت‌های تصویر
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            $message = "فقط فایل‌های تصویر با فرمت jpg, png, gif, webp مجاز است.";
        } elseif (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            // مسیر قابل ذخیره در دیتابیس (مثلا نسبت به پوشه اصلی سایت)
            $dbPath = 'uploads/' . basename($targetFilePath);

            $stmt = mysqli_prepare($conn, "INSERT INTO portfolio (image_path, category) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, "ss", $dbPath, $category);
            if (mysqli_stmt_execute($stmt)) {
                $message = "نمونه‌کار با موفقیت ثبت شد.";
            } else {
                $message = "خطا در ذخیره‌سازی در دیتابیس.";
            }
        } else {
            $message = "خطا در انتقال فایل.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <title>مدیریت نمونه‌کارها</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-xl mx-auto bg-white rounded p-6 shadow">
        <h1 class="text-2xl mb-4 font-bold text-gray-700">افزودن نمونه‌کار جدید</h1>

        <?php if ($message): ?>
            <div class="mb-4 text-center text-red-600"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label for="image" class="block mb-2 font-semibold">تصویر نمونه‌کار</label>
                <input type="file" id="image" name="image" required class="border p-2 w-full rounded" />
            </div>
            <div>
                <label for="category" class="block mb-2 font-semibold">دسته‌بندی</label>
                <input type="text" id="category" name="category" required class="border p-2 w-full rounded" placeholder="مثلا: طراحی لوگو" />
            </div>
            <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700">ثبت نمونه‌کار</button>
        </form>
    </div>

</body>
</html>
