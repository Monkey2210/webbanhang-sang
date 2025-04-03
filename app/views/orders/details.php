<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h2>Chi tiết đơn hàng</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php foreach ($orderItems as $item): ?>
                <tr>
                    <td><?= $item['product_name'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                    <td><?= number_format($item['quantity'] * $item['price'], 0, ',', '.') ?> VND</td>
                </tr>
                <?php $total += $item['quantity'] * $item['price']; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h4>Tổng đơn hàng: <?= number_format($total, 0, ',', '.') ?> VND</h4>
</div>

<?php include 'app/views/shares/footer.php'; ?>