<?php include 'app/views/shares/header.php'; ?>

<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card text-white" style="border-radius: 1rem; background: linear-gradient(135deg, #5de0e6, #004aad);">
                <div class="card-body p-5 text-center">
                    <form action="/webbanhang/account/updatepassword" method="POST">
                        <label for="newpassword">Mật khẩu mới:</label>
                        <input type="password" id="newpassword" name="newpassword" required>

                        <label for="confirmpassword">Xác nhận mật khẩu:</label>
                        <input type="password" id="confirmpassword" name="confirmpassword" required>

                        <button type="submit">Đặt lại mật khẩu</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>