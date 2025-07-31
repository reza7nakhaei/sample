<?php
session_start();
require_once(__DIR__ . '/../backend/db.php');



$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $query = "SELECT id, username, password_hash FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        // بررسی پسورد
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: admin_dashboard.php");
            exit;
        } else {
            $error = "رمز عبور اشتباه است";
        }
    } else {
        $error = "کاربری با این نام وجود ندارد";
    }
}
?>


<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>صفحه ورود | مدیریت</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">ورود به پنل مدیریت</h2>

        <?php if ($error): ?>
            <div class="mb-4 text-red-600 text-center"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="" class="space-y-6">
            <div>
                <label for="username" class="block mb-2 font-semibold text-gray-600">نام کاربری</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    placeholder="نام کاربری خود را وارد کنید" />
            </div>

            <div>
                <label for="password" class="block mb-2 font-semibold text-gray-600">رمز عبور</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    placeholder="رمز عبور خود را وارد کنید" />
            </div>

            <button
                type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition-colors">
                ورود
            </button>
        </form>
    </div>

</body>

</html>