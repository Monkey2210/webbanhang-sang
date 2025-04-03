<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <section class="vh-100 gradient-custom">
        <!-- Giữ nguyên phần nội dung form đăng nhập -->
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card text-white" style="border-radius: 1rem; background: linear-gradient(135deg, #5de0e6, #004aad);">

                        <div class="card-body p-5 text-center">
                            <form action="/webbanhang/account/checklogin" method="post">

                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase">Đăng Nhập</h2>
                                    <p class="text-white-50 mb-5">Vui lòng nhập tên đăng nhập và mật khẩu của bạn!</p>
                                    <div class="form-outline form-white mb-4">
                                        <input type="text" name="username" class="form-control form-control-lg"
                                            placeholder="Tên đăng nhập" />
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="password" name="password" class="form-control form-control-lg"
                                            placeholder="Mật khẩu" />
                                    </div>
                                    <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="/webbanhang/account/forgotpassword">Quên mật khẩu?</a></p>

                                    </p>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Đăng nhập</button>




                                </div>
                                <div>
                                    <p class="mb-0">Bạn chưa cso tài khoản? <a href="/webbanhang/account/register " class="text-white-50 fw-bold">Đăng Ký</a>

                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>