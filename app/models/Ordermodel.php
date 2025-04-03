<?php
class OrderModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getOrdersByUsername($username)
    {
        $query = "SELECT o.*, a.username, a.role
                 FROM orders o, account a 
                 WHERE a.username = ? 
                 ORDER BY o.created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getOrderItems($orderId)
    {
        $query = "SELECT od.*, p.name as product_name 
                 FROM order_details od 
                 JOIN product p ON od.product_id = p.id 
                 WHERE od.order_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getOrderDetail($orderId, $userId)
    {
        $query = "SELECT * FROM orders WHERE id = ? AND user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$orderId, $userId]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
