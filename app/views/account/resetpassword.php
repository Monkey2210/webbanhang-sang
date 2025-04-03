<?php include 'app/views/shares/header.php'; ?>

<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card text-white" style="border-radius: 1rem; background: linear-gradient(135deg, #5de0e6, #004aad);">
                <div class="card-body p-5 text-center">
                    <form action="/webbanhang/account/resetpassword" method="post">
                        <h2 class="fw-bold mb-2 text-uppercase">Reset Password</h2>
                        <p class="text-white-50 mb-5">Enter your new password.</p>

                        <input type="hidden" name="token" value="<?= $_GET['token'] ?>" />

                        <div class="form-outline form-white mb-4">
                            <input type="password" name="newpassword" class="form-control form-control-lg" required />
                            <label class="form-label">New Password</label>
                        </div>

                        <button class="btn btn-outline-light btn-lg px-5" type="submit">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>