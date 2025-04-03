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
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            exit;
        }

        $username = $_SESSION['username'];
        $orders = $this->orderModel->getOrdersByUsername($username);

        foreach ($orders as $order) {
            $order->items = $this->orderModel->getOrderItems($order->id);
        }

        include 'app/views/orders/history.php';
    }

    public function detail($orderId)
    {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            return;
        }

        $userId = $_SESSION['user_id'];
        $order = $this->orderModel->getOrderDetail($orderId, $userId);

        if (!$order) {
            header('Location: /webbanhang/Order/history');
            return;
        }

        include 'app/views/orders/detail.php';
    }
}
