<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="text-center mb-4">Lịch sử đơn hàng</h1>

    <div class="row">
        <div class="col-12">
            <?php if (empty($orders)): ?>
                <div class="alert alert-info text-center">
                    <h4 class="mb-0">Bạn chưa có đơn hàng nào.</h4>
                </div>
            <?php else: ?>
                <?php foreach ($orders as $order): ?>
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Đơn hàng #<?php echo $order->id; ?></h5>
                                <span>Ngày đặt: <?php echo date('d/m/Y H:i', strtotime($order->created_at)); ?></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Người nhận:</strong> <?php echo $order->name; ?></p>
                                    <p class="mb-1"><strong>Số điện thoại:</strong> <?php echo $order->phone; ?></p>
                                    <p class="mb-1"><strong>Địa chỉ:</strong> <?php echo $order->address; ?></p>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <p class="mb-1"><strong>Ngày đặt:</strong>
                                        <?php echo date('d/m/Y H:i', strtotime($order->created_at)); ?>
                                    </p>
                                    <p class="mb-1"><strong>Tổng tiền:</strong>
                                        <span class="text-primary">
                                            <?php
                                            $total = 0;
                                            foreach ($order->items as $item) {
                                                $total += $item->quantity * $item->price;
                                            }
                                            echo number_format($total, 0, ',', '.');
                                            ?> VND</span>
                                    </p>
                                </div>
                            </div>

                            <h6 class="border-bottom pb-2 mb-3">Chi tiết đơn hàng:</h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th class="text-center">Số lượng</th>
                                            <th class="text-right">Đơn giá</th>
                                            <th class="text-right">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($order->items as $item): ?>
                                            <tr>
                                                <td><?php echo $item->product_name; ?></td>
                                                <td class="text-center"><?php echo $item->quantity; ?></td>
                                                <td class="text-right"><?php echo number_format($item->price, 0, ',', '.'); ?> VND</td>
                                                <td class="text-right"><?php echo number_format($item->quantity * $item->price, 0, ',', '.'); ?> VND</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>