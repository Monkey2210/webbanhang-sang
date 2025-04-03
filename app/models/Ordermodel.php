<?php
class OrderModel
{
    private $conn;
    private $table_orders = "orders";
    private $table_order_items = "order_items";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy danh sách đơn hàng của user
    public function getOrdersByUserId($userId)
    {
        $query = "SELECT * FROM " . $this->table_orders . " WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Lấy chi tiết sản phẩm trong đơn hàng
    public function getOrderItems($orderId)
    {
        $query = "SELECT oi.*, p.name AS product_name FROM " . $this->table_order_items . " oi
                  JOIN products p ON oi.product_id = p.id
                  WHERE oi.order_id = :order_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOrderDetails($orderId, $userId)
    {
        $query = "SELECT * FROM orders WHERE id = :orderId AND user_id = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
