<?php

class User
{
    private PDO $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    // ساخت ادمین جدید با پسورد هش شده
    public function createAdmin(string $email, string $password): bool
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hash);
        return $stmt->execute();
    }

    // ورود کاربر
    public function login(string $email, string $password): bool|array
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user; // آرایه شامل اطلاعات کاربر
        }
        return false; // ایمیل یا پسورد اشتباه
    }

    // بررسی ورود (چک کردن سشن)
    public static function checkLogin(): bool
    {
        return isset($_SESSION['admin']);
    }

    // خروج کاربر
    public static function logout(): void
    {
        session_unset();
        session_destroy();
    }
}
