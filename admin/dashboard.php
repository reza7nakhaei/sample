<?php

session_start();

// بررسی ورود
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}





require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../classes/Portfolio.php';

$db = new Database();
$conn = $db->getConnection();

// گرفتن دسته‌بندی‌ها برای فرم
$stmt = $conn->query("SELECT * FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// گرفتن نمونه‌کارها برای نمایش
$portfolioObj = new Portfolio($conn);
$portfolios = $portfolioObj->getAll();
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>داشبورد مدیریت</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-6">
    <div class="container mx-auto space-y-8">

        <!-- ردیف بالا: فرم افزودن نمونه‌کار -->
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <h2 class="text-xl font-bold text-gray-700 mb-4">افزودن نمونه‌کار جدید</h2>

            <form action="store_portfolio.php" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">

                <!-- عنوان -->
                <div>
                    <label class="block text-gray-600 mb-1">عنوان</label>
                    <input type="text" name="title" required
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                </div>

                <!-- دسته بندی -->
                <div>
                    <label class="block text-gray-600 mb-1">دسته‌بندی</label>
                    <select name="category_id" required
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="">انتخاب کنید</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- تصویر -->
                <div>
                    <label class="block text-gray-600 mb-1">تصویر</label>
                    <input type="file" name="image" accept="image/*" required
                        class="w-full border rounded-lg px-3 py-2 bg-white">
                </div>

                <!-- دکمه -->
                <div>
                    <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-semibold">
                        ذخیره
                    </button>
                </div>
            </form>
        </div>

        <!-- ردیف پایین: لیست نمونه‌کارها -->
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <h2 class="text-xl font-bold text-gray-700 mb-4">نمونه‌کارهای ثبت‌شده</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border px-4 py-2">#</th>
                            <th class="border px-4 py-2">تصویر</th>
                            <th class="border px-4 py-2">عنوان</th>
                            <th class="border px-4 py-2">دسته‌بندی</th>
                            <th class="border px-4 py-2">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($portfolios as $index => $item): ?>
                            <tr class="text-center">
                                <td class="border px-4 py-2"><?= $index + 1 ?></td>
                                <td class="border px-4 py-2">
                                    <?php if (!empty($item['image'])): ?>
                                        <img src="../uploads/<?= htmlspecialchars($item['image']) ?>"
                                            alt="<?= htmlspecialchars($item['title']) ?>"
                                            class="w-16 h-16 object-cover mx-auto rounded">
                                    <?php endif; ?>
                                </td>
                                <td class="border px-4 py-2"><?= htmlspecialchars($item['title']) ?></td>
                                <td class="border px-4 py-2"><?= htmlspecialchars($item['category_name']) ?></td>
                                <td class="border px-4 py-2 space-x-2">
                                    <a href="edit_portfolio.php?id=<?= $item['id'] ?>"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">ویرایش</a>
                                    <a href="delete_portfolio.php?id=<?= $item['id'] ?>"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
                                        onclick="return confirm('مطمئنی میخوای حذف کنی؟')">حذف</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>

</html>