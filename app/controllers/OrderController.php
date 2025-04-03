<?php
require_once('app/config/database.php');
require_once('app/models/OrderModel.php');
require_once('app/helpers/SessionHelper.php');

class OrderController
{
    private $orderModel;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->orderModel = new OrderModel($db);
    }

    public function history()
    {
        SessionHelper::start();
        if (!SessionHelper::isUser()) {
            header('Location: /webbanhang/account/login');
            exit;
        }

        $userId = $_SESSION['user_id']; // Lấy ID user từ session
        $orders = $this->orderModel->getOrdersByUserId($userId);

        include 'app/views/order/history.php';
    }

    public function details($orderId)
    {
        SessionHelper::start();
        if (!SessionHelper::isUser()) {
            header('Location: /webbanhang/account/login');
            exit;
        }

        if (!isset($_SESSION['user_id'])) {
            echo "Lỗi: Không tìm thấy user_id trong session!";
            exit;
        }

        $userId = $_SESSION['user_id'];
        $order = $this->orderModel->getOrderDetails($orderId, $userId);

        if (!$order) {
            echo "Lỗi: Không tìm thấy đơn hàng hoặc bạn không có quyền xem!";
            exit;
        }

        include 'app/views/order/details.php';
    }
}
