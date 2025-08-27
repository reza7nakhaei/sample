<?php
require_once __DIR__ . '/../config/Database.php';

class Portfolio
{
    private $conn;
    private $table_name = "portfolios";

    public $id;
    public $title;
    public $image;
    public $category_id;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // گرفتن همه نمونه کارها
    public function getAll()
    {
        $stmt = $this->conn->prepare("
        SELECT p.*, c.name AS category_name
        FROM portfolios p
        LEFT JOIN categories c ON p.category_id = c.id
        ORDER BY p.created_at DESC
    ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ایجاد نمونه کار جدید
    public function create($title, $image, $category_id)
    {
        $sql = "INSERT INTO portfolios (title, image, category_id) VALUES (:title, :image, :category_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':image' => $image,
            ':category_id' => $category_id
        ]);
    }


    // حذف نمونه کار
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // آپدیت نمونه کار
    public function update()
    {
        $query = "UPDATE " . $this->table_name . "
                  SET title = :title, image = :image, category_id = :category_id
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
}
