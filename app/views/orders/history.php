<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h2>Lịch sử đơn hàng</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Đơn</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= $order['created_at'] ?></td>
                    <td><?= number_format($order['total_price'], 0, ',', '.') ?> VND</td>
                    <td><a href="/webbanhang/order/details/<?= $order['id'] ?>" class="btn btn-primary">Xem</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'app/views/shares/footer.php'; ?>