<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');
require_once('app/helpers/SessionHelper.php');

class ProductController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    //Kiểm tra quyền admin
    private function isAdmin()
    {
        return SessionHelper::isAdmin();
    }

    //hiển thị danh sách sản phẩm (mở cho tất cả)
    public function index()
    {
        $products = $this->productModel->getProducts();
        include 'app/views/product/list.php';
    }

    //xem chi tiết sản phẩm (mở cho tất cả)
    public function show($id)
    {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            include 'app/views/product/show.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    //thêm sản phẩm (chỉ Admin)
    public function add()
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        $categories = (new CategoryModel($this->db))->getCategory();
        include_once 'app/views/product/add.php';
    }

    //Lưu sản phẩm mới (chỉ Admin)
    public function save()
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            $errors = [];

            // Xử lý upload ảnh
            $image = (isset($_FILES['image']) && $_FILES['image']['error'] == 0) ? $this->uploadImage($_FILES['image']) : "";
            $result = $this->productModel->addProduct(
                $name,
                $description,
                $price,
                $category_id,
                $image
            );
            if (is_array($result)) {
                $errors = $result;
                $categories = (new CategoryModel($this->db))->getCategory();
                include 'app/views/product/add.php';
            } else {
                header('Location: /webbanhang/Product');
            }

            $image = "";
            if (!empty($_FILES['image']['name'])) {
                try {
                    $image = $this->uploadImage($_FILES['image']);
                } catch (Exception $e) {
                    $errors['image'] = $e->getMessage();
                }
            }

            // Thêm sản phẩm vào database
            if (empty($errors)) {
                $result = $this->productModel->addProduct($name, $description, $price, $category_id, $image);
                if ($result) {
                    header('Location: /webbanhang/Product');
                    exit();
                } else {
                    echo "Đã xảy ra lỗi khi thêm sản phẩm.";
                }
            } else {
                $categories = (new CategoryModel($this->db))->getCategory();
                include 'app/views/product/add.php';
            }
        }
    }

    //Sửa sản phẩm (chỉ Admin)
    public function edit($id)
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }

        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategory();
        if ($product) {
            include 'app/views/product/edit.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    //Cập nhật sản phẩm (chỉ Admin)
    public function update()
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này !";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $errors = [];

            // Xử lý ảnh mới nếu có
            $image = (isset($_FILES['image']) && $_FILES['image']['error'] == 0) ? $this->uploadImage($_FILES['image']) : $_POST['existing_image'];
            $edit = $this->productModel->updateProduct(
                $id,
                $name,
                $description,
                $price,
                $category_id,
                $image
            );
            if ($edit) {
                header('Location: /webbanhang/Product');
            } else {
                echo "Đã xảy ra lỗi khi lưu sản phẩm.";
            }


            if (!empty($_FILES['image']['name'])) {
                try {
                    $image = $this->uploadImage($_FILES['image']);
                } catch (Exception $e) {
                    $errors['image'] = $e->getMessage();
                }
            } else {
                $image = $_POST['existing_image']; // Giữ lại ảnh cũ
            }

            // Cập nhật sản phẩm
            if (empty($errors)) {
                $edit = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image);
                if ($edit) {
                    header('Location: /webbanhang/Product');
                    exit();
                } else {
                    echo "Đã xảy ra lỗi khi cập nhật sản phẩm.";
                }
            } else {
                $categories = (new CategoryModel($this->db))->getCategory();
                include 'app/views/product/edit.php';
            }
        }
    }

    //Xóa sản phẩm (chỉ Admin)
    public function delete($id)
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        if ($this->productModel->deleteProduct($id)) {
            header('Location: /webbanhang/Product');
        } else {
            echo "Đã xảy ra lỗi khi xóa sản phẩm.";
        }
    }

    private function uploadImage($file)
    {
        $target_dir = "uploads/";

        // Kiểm tra và tạo thư mục nếu chưa tồn tại
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = time() . "_" . basename($file["name"]);
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra định dạng ảnh
        $allowed_extensions = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowed_extensions)) {
            throw new Exception("Chỉ chấp nhận các file ảnh (JPG, JPEG, PNG, GIF).");
        }

        // Kiểm tra kích thước file (tối đa 10MB)
        if ($file["size"] > 10 * 1024 * 1024) {
            throw new Exception("Kích thước ảnh quá lớn (tối đa 10MB).");
        }

        // Kiểm tra file có phải ảnh hợp lệ không
        if (!getimagesize($file["tmp_name"])) {
            throw new Exception("File không phải là hình ảnh hợp lệ.");
        }

        // Lưu file vào thư mục
        if (!move_uploaded_file($file["tmp_name"], $target_file)) {
            throw new Exception("Lỗi khi tải lên hình ảnh.");
        }

        return $target_file;
    }

    public function addToCart($id)
    {
        session_start();

        $product = $this->productModel->getProductById($id);
        if (!$product) {
            echo "Không tìm thấy sản phẩm.";
            return;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }
        header('Location: /webbanhang/Product/cart');
    }

    public function cart()
    {
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        include 'app/views/product/cart.php';
    }

    public function checkout()
    {
        include 'app/views/product/checkout.php';
    }
    public function processCheckout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            // Kiểm tra giỏ hàng
            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                echo "Giỏ hàng trống.";
                return;
            }
            // Bắt đầu giao dịch
        }

        $this->db->beginTransaction();
        try {
            // Lưu thông tin đơn hàng vào bảng orders
            $query = "INSERT INTO orders (name, phone, address) VALUES (:name,:phone, :address)";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->execute();
            $order_id = $this->db->lastInsertId();

            // Lưu chi tiết đơn hàng vào bảng order_details
            $cart = $_SESSION['cart'];
            foreach ($cart as $product_id => $item) {
                $query = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";

                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':order_id', $order_id);
                $stmt->bindParam(':product_id', $product_id);
                $stmt->bindParam(':quantity', $item['quantity']);
                $stmt->bindParam(':price', $item['price']);
                $stmt->execute();
            }

            // Xóa giỏ hàng sau khi đặt hàng thành công
            unset($_SESSION['cart']);

            // Commit giao dịch
            $this->db->commit();

            // Chuyển hướng đến trang xác nhận đơn hàng
            header('Location: /webbanhang/Product/orderConfirmation');
        } catch (Exception $e) {
            // Rollback giao dịch nếu có lỗi
            $this->db->rollBack();
            echo "Đã xảy ra lỗi khi xử lý đơn hàng: " . $e->getMessage();
        }
    }



    public function orderConfirmation()
    {
        include 'app/views/product/orderConfirmation.php';
    }


    public function updateCart()
    {
        session_start();

        // Kiểm tra giỏ hàng
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Lấy dữ liệu từ request
        $product_id = $_GET['product_id'] ?? null;
        $action = $_GET['action'] ?? null;

        if (!$product_id || !isset($_SESSION['cart'][$product_id])) {
            header("Location: /webbanhang/Product/cart");
            exit();
        }

        // Tăng/giảm số lượng sản phẩm
        if ($action === 'increase') {
            $_SESSION['cart'][$product_id]['quantity']++;
        } elseif ($action === 'decrease') {
            $_SESSION['cart'][$product_id]['quantity']--;
            if ($_SESSION['cart'][$product_id]['quantity'] <= 0) {
                unset($_SESSION['cart'][$product_id]); // Xóa sản phẩm nếu số lượng về 0
            }
        }

        // Chuyển hướng trở lại giỏ hàng
        header("Location: /webbanhang/Product/cart");
        exit();
    }
}
