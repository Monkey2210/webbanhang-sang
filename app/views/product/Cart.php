<?php include 'app/views/shares/header.php'; ?>

<?php
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$cart = $_SESSION['cart'];
$totalPrice = 0; // Khởi tạo biến totalPrice
?>

<div class="container mt-4">
    <h1 class="fw-bold mb-4">Giỏ hàng <span class="text-muted fs-5">(<?php echo count($cart); ?> sản phẩm)</span></h1>

    <div class="row">
        <div class="col-md-8">
            <?php if (!empty($cart)): ?>
                <div class="cart-items">
                    <?php foreach ($cart as $id => $item):
                        $subtotal = $item['quantity'] * $item['price'];
                        $totalPrice += $subtotal;
                    ?>
                        <div class="card mb-3 border">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-4">
                                    <!-- Ảnh sản phẩm -->
                                    <div class="cart-item-image">
                                        <?php if (!empty($item['image'])): ?>
                                            <img src="/webbanhang/<?php echo htmlspecialchars($item['image']); ?>"
                                                alt="<?php echo htmlspecialchars($item['name']); ?>"
                                                class="rounded"
                                                style="width: 120px; height: 120px; object-fit: contain;">
                                        <?php endif; ?>
                                    </div>

                                    <!-- Thông tin sản phẩm -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="card-title mb-0"><?php echo htmlspecialchars($item['name']); ?></h5>
                                            <div class="price-section">
                                                <div class="text-primary fw-bold fs-5">
                                                    <?php echo number_format($item['price'], 0, ',', '.'); ?> VND
                                                </div>
                                                <?php if (!empty($item['old_price'])): ?>
                                                    <small class="text-muted text-decoration-line-through">
                                                        <?php echo number_format($item['old_price'], 0, ',', '.'); ?> VND
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <!-- Số lượng -->
                                            <div class="quantity-controls d-flex align-items-center">
                                                <button onclick="updateQuantity(<?php echo $id; ?>, 'decrease')"
                                                    class="btn btn-outline-secondary"
                                                    style="width: 32px; height: 32px; padding: 0;">-</button>
                                                <span class="mx-3 fw-bold" id="quantity-<?php echo $id; ?>">
                                                    <?php echo htmlspecialchars($item['quantity']); ?>
                                                </span>
                                                <button onclick="updateQuantity(<?php echo $id; ?>, 'increase')"
                                                    class="btn btn-outline-secondary"
                                                    style="width: 32px; height: 32px; padding: 0;">+</button>
                                            </div>

                                            <!-- Nút xóa -->
                                            <a href="/webbanhang/Product/removeCart?product_id=<?php echo $id; ?>"
                                                class="btn btn-link text-danger"
                                                onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                                                <i class="bi bi-trash"></i> Xóa
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center p-5">
                    <h4 class="mb-3">Giỏ hàng của bạn đang trống</h4>
                    <p class="text-muted mb-4">Hãy thêm sản phẩm vào giỏ hàng của bạn</p>
                    <a href="/webbanhang/Product" class="btn btn-primary px-4">
                        <i class="bi bi-cart-plus me-2"></i>Tiếp tục mua sắm
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Phần tổng tiền và thanh toán -->
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Tóm tắt đơn hàng</h5>
                <div class="d-flex justify-content-between">
                    <span>Tạm tính</span>
                    <span class="fw-bold total-price"><?php echo number_format($totalPrice, 0, ',', '.'); ?> VND</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span class="fs-5">Tổng cộng</span>
                    <span class="fw-bold fs-5 total-price"><?php echo number_format($totalPrice, 0, ',', '.'); ?> VND</span>
                </div>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/webbanhang/Product/checkout" class="btn btn-primary w-100 mt-3">Thanh Toán</a>
                <?php else: ?>
                    <button class="btn btn-primary w-100 mt-3" onclick="showLoginAlert()">Thanh Toán</button>
                <?php endif; ?>
                <a href="/webbanhang/Product" class="btn btn-secondary w-100 mt-2">Tiếp tục mua sắm</a>
            </div>
        </div>
    </div>
</div>

<script>
    function showLoginAlert() {
        <?php if (!isset($_SESSION['username'])): ?>
            if (confirm('Bạn cần đăng nhập tài khoản để thanh toán. Chuyển đến trang đăng nhập?')) {
                window.location.href = '/webbanhang/account/login';
            }
        <?php else: ?>
            window.location.href = '/webbanhang/Product/checkout';
        <?php endif; ?>
    }

    function updateQuantity(productId, action) {
        fetch(`/webbanhang/Product/updateCartAjax?product_id=${productId}&action=${action}`, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật số lượng
                    const quantitySpan = document.querySelector(`#quantity-${productId}`);
                    quantitySpan.textContent = data.quantity;

                    // Cập nhật tổng tiền
                    const totalPriceElements = document.querySelectorAll('.total-price');
                    totalPriceElements.forEach(element => {
                        element.textContent = data.totalPrice + ' VND';
                    });
                }
            });
    }
</script>

<?php include 'app/views/shares/footer.php'; ?>