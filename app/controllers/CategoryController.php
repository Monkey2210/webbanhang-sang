<?php
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($db);
    }

    // Hiển thị danh sách danh mục
    public function index()
    {
        $categories = $this->categoryModel->getCategory();
        include 'app/views/category/list.php';
    }

    // Thêm danh mục mới
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            if (!empty($name)) {
                $this->categoryModel->addCategory($name);
            }
            header('Location: /webbanhang/category');
        } else {
            include 'app/views/category/add.php';
        }
    }

    // Sửa danh mục
    public function edit($id = null)
    {
        if ($id === null) {
            header('Location: /webbanhang/category');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            if (!empty($name)) {
                $this->categoryModel->updateCategory($id, $name);
            }
            header('Location: /webbanhang/category');
        } else {
            $category = $this->categoryModel->getCategoryById($id);
            if (!$category) {
                header('Location: /webbanhang/category');
                return;
            }
            include 'app/views/category/edit.php';
        }
    }

    // Xóa danh mục
    public function delete($id)
    {
        $this->categoryModel->deleteCategory($id);
        header('Location: /webbanhang/category');
    }
}
