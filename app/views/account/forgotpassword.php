<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card text-white" style="border-radius: 1rem; background: linear-gradient(135deg, #5de0e6, #004aad);">
                    <div class="card-body p-5 text-center">
                        <form action="/webbanhang/account/resetpassword" method="post">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Quên Mật Khẩu</h2>
                                <p class="text-white-50 mb-5">Nhập tên đăng nhập để khôi phục mật khẩu</p>

                                <?php if (isset($errors)) { ?>
                                    <ul>
                                        <?php foreach ($errors as $err) { ?>
                                            <li class='text-danger'><?= $err ?></li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>

                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="username" class="form-control form-control-lg"
                                        placeholder="Tên đăng nhập" required />
                                </div>

                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Xác Nhận</button>
                            </div>

                            <div>
                                <p class="mb-0"><a href="/webbanhang/account/login" class="text-white-50 fw-bold">Quay lại đăng nhập</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>