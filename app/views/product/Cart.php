<?php include 'app/views/shares/header.php'; ?>

<h1 class="fw-bold">Giỏ hàng <span class="text-muted fs-5">(<?php echo count($cart); ?> sản phẩm)</span></h1>



<div class="row">
    <!-- Danh sách sản phẩm -->
    <div class="col-md-8">
        <?php
        $totalPrice = 0;
        if (!empty($cart)): ?>
            <ul class="list-group">
                <?php foreach ($cart as $id => $item):
                    $subtotal = $item['quantity'] * $item['price'];
                    $totalPrice += $subtotal;
                ?>
                    <li class="list-group-item p-3 shadow-sm rounded">
                        <div class="d-flex align-items-center">
                            <!-- Ảnh sản phẩm -->
                            <?php if (!empty($item['image'])): ?>
                                <img src="/webbanhang/<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>"
                                    alt="Product Image"
                                    class="rounded me-3"
                                    style="max-width: 100px;">
                            <?php endif; ?>

                            <!-- Thông tin sản phẩm -->
                            <div class="flex-grow-1">
                                <h5 class="fw-bold"><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                                <p class="mb-1">
                                    <span class="text-dark fw-bold">
                                        <?php echo number_format($item['price'], 0, ',', '.'); ?> VND
                                    </span>

                                    <?php if (!empty($item['old_price'])): ?>
                                        <span class="text-muted text-decoration-line-through ms-2">
                                            <?php echo number_format($item['old_price'], 0, ',', '.'); ?> VND
                                        </span>
                                    <?php endif; ?>
                                </p>

                                <!-- Nút số lượng -->
                                <div class="d-flex align-items-center mx-4">
                                    <a href="/webbanhang/Product/updateCart?product_id=<?php echo $id; ?>&action=decrease" class="btn btn-outline-dark px-1">➖</a>
                                    <span class="mx-2"><?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?></span>
                                    <a href="/webbanhang/Product/updateCart?product_id=<?php echo $id; ?>&action=increase" class="btn btn-outline-dark px-1">➕</a>

                                    <!-- Xóa sản phẩm -->
                                    <div class="text-end w-100">
                                        <a href="/webbanhang/Product/removeCart?product_id=<?php echo $id; ?>"
                                            class="btn btn-outline-danger "
                                            onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?');">
                                            <i class="bi bi-trash fs-5"></i>
                                        </a>

                                    </div>




                                </div>

                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-center">Giỏ hàng của bạn đang trống.</p>
        <?php endif; ?>
    </div>

    <!-- Tổng tiền & Thanh toán -->
    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <h5 class="fw-bold">Tóm tắt đơn hàng</h5>
            <div class="d-flex justify-content-between">
                <span>Tạm tính</span>
                <span class="fw-bold"><?php echo number_format($totalPrice, 0, ',', '.'); ?> VND</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <span class="fs-5">Tổng cộng</span>
                <span class="fw-bold fs-5"><?php echo number_format($totalPrice, 0, ',', '.'); ?> VND</span>
            </div>
            <a href="/webbanhang/Product/checkout" class="btn btn-primary w-100 mt-3">Thanh Toán</a>
            <a href="/webbanhang/Product" class="btn btn-secondary w-100 mt-2">Tiếp tục mua sắm</a>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>