<?php include 'app/views/shares/header.php'; ?>
<h1>Thanh toán</h1>
<form method="POST" action="/webbanhang/Product/processCheckout">
    <div class="form-group">
        <label for="name">Họ tên:</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="phone">Số điện thoại:</label>
        <input type="text" id="phone" name="phone" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="address">Địa chỉ:</label>
        <textarea id="address" name="address" class="form-control"
            required></textarea>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary w-100">Thanh toán</button>
        <a href="/webbanhang/Product/cart" class="btn btn-secondary w-100 mt-2">Quay lại giỏ hàng</a>
    </div>
</form>
<?php include 'app/views/shares/footer.php'; ?>