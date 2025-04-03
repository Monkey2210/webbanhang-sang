<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Thông tin cá nhân</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4">Tên đăng nhập:</div>
                        <div class="col-sm-8"><?php echo htmlspecialchars($_SESSION['username']); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">Vai trò:</div>
                        <div class="col-sm-8"><?php echo SessionHelper::getRole(); ?></div>
                    </div>
                    <!-- Có thể thêm các thông tin khác ở đây -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>