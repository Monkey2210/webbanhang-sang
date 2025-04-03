<?php
session_start();
require_once 'app/models/ProductModel.php';
require_once 'app/helpers/SessionHelper.php';

$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Kiểm tra phần đầu tiên của URL để xác định controller
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'ProductController';

// Kiểm tra phần thứ hai của URL để xác định action
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';

// Kiểm tra xem controller và action có tồn tại không
if (!file_exists('app/controllers/' . $controllerName . '.php')) {
    // Xử lý không tìm thấy controller
    die('Controller not found');
}



require_once 'app/controllers/' . $controllerName . '.php';

$controller = new $controllerName();

if (!method_exists($controller, $action)) {
    // Xử lý không tìm thấy action
    die('Action not found');
}

// Gọi action với các tham số còn lại (nếu có)
call_user_func_array([$controller, $action], array_slice($url, 2));


if (
    isset($_GET['controller']) && isset($_GET['action']) &&
    $_GET['controller'] === 'Product' && $_GET['action'] === 'updateCart'
) {

    include 'app/controllers/ProductController.php';
    $controller = new ProductController();
    $controller->updateCart();
}


// Thêm route verify
if (
    isset($_GET['controller']) && isset($_GET['action']) &&
    $_GET['controller'] === 'Account' && $_GET['action'] === 'verify'
) {
    require_once 'app/controllers/AccountController.php';
    $controller = new AccountController();
    $controller->verify();
}


//lịch sử đơn hàng 

if ($controller == "order" && $action == "history") {
    $orderController = new OrderController();
    $orderController->history();
} elseif ($controller == "order" && $action == "details" && isset($params[0])) {
    $orderController = new OrderController();
    $orderController->details($params[0]);
}

// Danh mục sản phẩm 
if ($controller == "category") {
    $categoryController = new CategoryController();

    if ($action == "index") {
        $categoryController->index();
    } elseif ($action == "add") {
        $categoryController->add();
    } elseif ($action == "edit" && isset($params[0])) {
        $categoryController->edit($params[0]);
    } elseif ($action == "delete" && isset($params[0])) {
        $categoryController->delete($params[0]);
    }
}
