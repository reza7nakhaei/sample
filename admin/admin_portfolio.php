<?php
session_start();
require_once __DIR__ . '/../backend/db.php';

// فقط اگر کاربر لاگین نکرده بود، ریدایرکت به صفحه لاگین
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// پیام‌ها
$message = '';

// اضافه کردن دسته‌بندی
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_category'])) {
    $newCategory = trim($_POST['new_category']);
    if ($newCategory !== '') {
        $stmt = mysqli_prepare($conn, "INSERT INTO project_categories (name) VALUES (?)");
        mysqli_stmt_bind_param($stmt, "s", $newCategory);
        if (mysqli_stmt_execute($stmt)) {
            $message = "دسته‌بندی اضافه شد.";
        } else {
            $message = "خطا در اضافه کردن دسته‌بندی.";
        }
    }
}

// اضافه کردن خدمت
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_service'])) {
    $newService = trim($_POST['new_service']);
    if ($newService !== '') {
        $stmt = mysqli_prepare($conn, "INSERT INTO services (title) VALUES (?)");
        mysqli_stmt_bind_param($stmt, "s", $newService);
        if (mysqli_stmt_execute($stmt)) {
            $message = "خدمت اضافه شد.";
        } else {
            $message = "خطا در اضافه کردن خدمت.";
        }
    }
}

// اضافه کردن نمونه‌کار
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_project']) && isset($_FILES['image'])) {
    $category_id = intval($_POST['category_id']);
    $file = $_FILES['image'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        $fileName = time() . '_' . basename($file['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $dbPath = 'uploads/' . $fileName;
            $stmt = mysqli_prepare($conn, "INSERT INTO projects (image_path, category_id) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, "si", $dbPath, $category_id);
            if (mysqli_stmt_execute($stmt)) {
                $message = "نمونه‌کار اضافه شد.";
            } else {
                $message = "خطا در ذخیره نمونه‌کار در دیتابیس.";
            }
        } else {
            $message = "خطا در آپلود فایل.";
        }
    } else {
        $message = "خطا در فایل آپلود.";
    }
}

// حذف مهارت
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_service_id'])) {
    $deleteId = intval($_POST['delete_service_id']);
    $stmt = mysqli_prepare($conn, "DELETE FROM services WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $deleteId);
    mysqli_stmt_execute($stmt);
}

// حذف پروژه
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_project_id'])) {
    $deleteId = intval($_POST['delete_project_id']);
    // مسیر عکس
    $res = mysqli_query($conn, "SELECT image_path FROM projects WHERE id = $deleteId");
    if ($row = mysqli_fetch_assoc($res)) {
        @unlink(__DIR__ . '/../' . $row['image_path']); // حذف فایل از پوشه
    }
    $stmt = mysqli_prepare($conn, "DELETE FROM projects WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $deleteId);
    mysqli_stmt_execute($stmt);
}

// خواندن دسته‌بندی‌ها
$categories = [];
$result = mysqli_query($conn, "SELECT * FROM project_categories ORDER BY id DESC");
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}

// خواندن خدمات
$services = [];
$result = mysqli_query($conn, "SELECT * FROM services ORDER BY id DESC");
while ($row = mysqli_fetch_assoc($result)) {
    $services[] = $row;
}

// خواندن پروژه‌ها
$projects = [];
$result = mysqli_query($conn, "
    SELECT p.id, p.image_path, c.name AS category_name
    FROM projects p
    JOIN project_categories c ON p.category_id = c.id
    ORDER BY p.id DESC
");
while ($row = mysqli_fetch_assoc($result)) {
    $projects[] = $row;
}

// خواندن سکشن‌ها
$sections = [];
$result = mysqli_query($conn, "SELECT * FROM sections ORDER BY id ASC");
while ($row = mysqli_fetch_assoc($result)) {
    $sections[] = $row;
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت سایت</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">پنل مدیریت سایت</h1>

    <?php if ($message): ?>
        <div class="mb-4 text-center text-green-600 font-semibold"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <!-- سکشن‌ها -->
    <div class="mb-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">سکشن‌ها</h2>
        <?php foreach ($sections as $sec): ?>
            <form method="POST" class="mb-4 border p-4 rounded">
                <input type="hidden" name="update_section_id" value="<?php echo $sec['id']; ?>">
                <div class="mb-2">
                    <label class="block font-semibold">تایتل:</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($sec['title']); ?>" class="border p-2 rounded w-full">
                </div>
                <div class="mb-2">
                    <label class="block font-semibold">توضیحات:</label>
                    <textarea name="description" class="border p-2 rounded w-full"><?php echo htmlspecialchars($sec['description']); ?></textarea>
                </div>
                <button type="submit" name="update_section" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">بروزرسانی</button>
            </form>
        <?php endforeach; ?>
    </div>

    <!-- خدمات -->
    <div class="mb-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">خدمات</h2>
        <form method="POST" class="flex gap-2 mb-4">
            <input type="text" name="new_service" placeholder="عنوان خدمت" class="border p-2 rounded w-full">
            <button class="bg-indigo-600 text-white px-4 py-2 rounded">اضافه کردن</button>
        </form>
        <?php if (count($services) > 0): ?>
            <ul class="list-disc mr-6">
                <?php foreach ($services as $service): ?>
                    <li class="flex justify-between items-center">
                        <?php echo htmlspecialchars($service['title']); ?>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="delete_service_id" value="<?php echo $service['id']; ?>">
                            <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded">حذف</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>سرویسی موجود نیست.</p>
        <?php endif; ?>
    </div>

    <!-- نمونه‌کارها + دسته‌بندی‌ها -->
    <div class="mb-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">نمونه‌ کارها</h2>
        <form method="POST" enctype="multipart/form-data" class="mb-6 flex flex-col gap-3">
            <div>
                <label class="block mb-1 font-semibold">تصویر نمونه‌کار</label>
                <input type="file" name="image" required class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="block mb-1 font-semibold">دسته‌بندی</label>
                <select name="category_id" required class="border p-2 rounded w-full">
                    <option value="">انتخاب دسته‌بندی</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="add_project" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">ثبت نمونه‌کار</button>
        </form>

        <?php if (count($projects) > 0): ?>
            <table class="w-full border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">عکس</th>
                        <th class="p-2 border">دسته‌بندی</th>
                        <th class="p-2 border">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $row): ?>
                        <tr>
                            <td class="p-2 border">
                                <img src="<?php echo htmlspecialchars($row['image_path']); ?>" class="w-20 h-20 object-cover">

                            </td>
                            <td class="p-2 border"><?php echo htmlspecialchars($row['category_name']); ?></td>
                            <td class="p-2 border">
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="delete_project_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded">حذف</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>نمونه‌کاری موجود نیست.</p>
        <?php endif; ?>

        <div class="mt-6">
            <h3 class="font-semibold mb-2">دسته‌بندی‌ها</h3>
            <?php if (count($categories) > 0): ?>
                <ul class="list-disc mr-6">
                    <?php foreach ($categories as $cat): ?>
                        <li><?php echo htmlspecialchars($cat['name']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>دسته‌بندی‌ای موجود نیست.</p>
            <?php endif; ?>
        </div>
    </div>

</div>
</body>
</html>
