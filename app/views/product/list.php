<?php include 'app/views/shares/header.php'; ?>

<h1 class="text-center">Danh sách sản phẩm</h1>

<?php
// Lấy số lượng sản phẩm trong giỏ hàng
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['quantity'];
    }
}
?>

<!-- Hiển thị nút "Thêm sản phẩm" chỉ khi là Admin -->
<!-- <?php if (SessionHelper::isAdmin()): ?>
    <a href="/webbanhang/Product/add" class="btn btn-success mb-2">Thêm sản phẩm mới</a>
<?php endif; ?> -->

<div class="container">
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow">
                    <div class="image-container" style="height: 250px; overflow: hidden;">
                        <?php if ($product->image): ?>
                            <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>"
                                class="card-img-top product-image"
                                alt="Product Image"
                                style="width: 100%; height: 100%; object-fit: contain; padding: 10px;">
                        <?php endif; ?>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <a href="/webbanhang/Product/show/<?php echo $product->id; ?>">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h5>
                        <p class="card-text"><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="text-danger font-weight-bold">
                            <?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?> VND
                        </p>

                        <!-- Chỉ hiển thị nút Sửa và Xóa nếu là Admin -->
                        <?php if (SessionHelper::isAdmin()): ?>
                            <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>"
                                class="btn btn-warning btn-sm fw-bold text-white rounded-pill transition-all hover-btn">
                                <i class="fas fa-edit me-1"></i> Sửa
                            </a>
                            <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>"
                                class="btn btn-danger btn-sm fw-bold rounded-pill transition-all hover-btn delete-btn"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                <i class="fas fa-trash me-1"></i> Xóa
                            </a>
                        <?php endif; ?>

                        <!-- Nút Thêm vào giỏ hàng (hiển thị cho tất cả) -->
                        <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>"
                            class="btn btn-primary btn-sm fw-bold rounded-pill transition-all hover-btn">
                            <i class="fas fa-cart-plus me-1"></i> Thêm vào giỏ
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>