<?php include 'app/views/shares/header.php'; ?>

<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card text-white" style="border-radius: 1rem; background: linear-gradient(135deg, #5de0e6, #004aad);">
                <div class="card-body p-5 text-center">
                    <form action="/webbanhang/account/resetpassword" method="post">
                        <div class="mb-md-5 mt-md-4 pb-5">
                            <h2 class="fw-bold mb-2 text-uppercase">Thay đổi Mật Khẩu </h2>
                            <p class="text-white-50 mb-5">Nhập tên Đăng nhập của bạn để thay đổi mật khẩu </p>

                            <?php if (isset($errors)) { ?>
                                <ul>
                                    <?php foreach ($errors as $err) { ?>
                                        <li class='text-danger'><?= $err ?></li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>

                            <div class="form-outline form-white mb-4">
                                <input type="text" name="username" class="form-control form-control-lg" required />
                                <label class="form-label">Nhập Tên Đăng Nhập </label>
                            </div>

                            <button class="btn btn-outline-light btn-lg px-5" type="submit">Xác Nhận</button>
                        </div>

                        <div>
                            <p class="mb-0"><a href="/webbanhang/account/login" class="text-white-50 fw-bold">Thoát</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>