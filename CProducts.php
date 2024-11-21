<?php
class CProducts
{
    private $conn;

    public function __construct($host, $user, $password, $database)
    {
        $this->conn = new mysqli($host, $user, $password, $database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Метод для скрытия товара
    public function hideProduct($productId)
    {
        $stmt = $this->conn->prepare("UPDATE Products SET IS_HIDDEN = 1 WHERE ID = ?");
        $stmt->bind_param("i", $productId);

        return $stmt->execute();
    }

    // Метод для получения товаров (не скрытых)
    public function getProducts($limit = 10)
    {
        $stmt = $this->conn->prepare("SELECT * FROM Products WHERE IS_HIDDEN = 0 ORDER BY DATE_CREATE DESC LIMIT ?");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Метод для обновления количества товара
    public function updateQuantity($productId, $quantity)
    {
        $stmt = $this->conn->prepare("UPDATE Products SET PRODUCT_QUANTITY = ? WHERE ID = ?");
        $stmt->bind_param("ii", $quantity, $productId);

        return $stmt->execute();
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}
