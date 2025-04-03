<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">



    <style>
        .product-image {
            max-width: 250px;
            height: auto;
        }
    </style>
</head>


<style>
    /* Thiết kế Navbar */
    .navbar {
        background: white;
        padding: 10px 20px;
        border-bottom: 3px solid #007bff;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);
    }

    .navbar-brand {
        font-weight: bold;
        color: rgb(255, 0, 0) !important;
        font-size: 22px;
        transition: all 0.3s ease-in-out;
    }

    .navbar-brand:hover {
        color: #0056b3 !important;
    }

    .navbar-nav .nav-item {
        margin-right: 15px;
    }

    .navbar-nav .nav-link {
        color: #007bff !important;
        font-weight: 500;
        transition: all 0.3s ease-in-out;
        padding: 8px 16px;
        border-radius: 5px;
    }

    .navbar-nav .nav-link:hover {
        background: #007bff;
        color: white !important;
    }

    /* Nút menu trên mobile */
    .navbar-toggler {
        border: none;
        outline: none;
    }

    .navbar-toggler-icon {
        background-color: rgb(0, 0, 0);
        border-radius: 5px;
        padding: 5px;
    }

    /* Thiết kế tiêu đề */
    h1 {
        font-size: 2rem;
        font-weight: bold;
        color: rgb(236, 236, 236);
        text-align: center;
        text-transform: uppercase;
        margin-bottom: 20px;
        padding: 10px 20px;
        border-bottom: 2px solid #007bff;
        display: inline-block;
        background-color: rgb(109, 170, 235);
        border-radius: 20px;
        margin-top: 5px;
    }

    /* Thiết kế danh sách sản phẩm */
    .list-group {
        font-size: 16px;
        max-width: 500px;
        margin: auto;
        text-align: center;
    }

    .list-group-item {
        background: white;
        border: 1px solid #007bff;
        border-radius: 8px;
        margin-bottom: 8px;
        transition: all 0.3s ease-in-out;
    }

    /* .list-group-item:hover {
        background: #007bff;
        color: white;
        } */

    /* Thiết kế nút */
    .btn {
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        border-radius: 5px;
        font-weight: bold;
        padding: 10px 16px;
    }

    .btn-primary {
        background: #007bff;
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background: #0056b3;
        transform: scale(1.05);
    }

    .btn-danger {
        background: #ff4b2b;
        border: none;
        color: white;
    }

    .btn-danger:hover {
        background: #c0392b;
        transform: scale(1.05);
    }

    a {
        color: #000000;
        text-decoration: none;
        background-color: transparent;
    }

    /* Làm mềm viền giữa các item, tránh mất góc tròn */
    .list-group-item:not(:first-child) {
        border-top: 5px solid transparent;
    }

    /* Tạo hiệu ứng khi hover */
    .list-group-item:hover {
        transform: scale(1.02);
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);


    }
</style>



</head>


<body>


    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="/webbanhang">
            <img src="/webbanhang/public/images/LOGO.png" alt="Logo" width="50">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Product/">Danh sách sản phẩm</a>
                </li>
                <?php if (SessionHelper::isAdmin()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/add">Thêm sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Category">Danh mục</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/order/history">Lịch sử đơn hàng</a>
                    </li>
                <?php else: ?>
                    <?php if (SessionHelper::isLoggedIn()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/webbanhang/order/history">Lịch sử đơn hàng</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <li class="nav-item">
                    <?php
                    if (SessionHelper::isLoggedIn()) {
                        echo "<a class='nav-link' href='/webbanhang/account/profile'>" . htmlspecialchars($_SESSION['username']) . "(" . SessionHelper::getRole() . ")</a>";
                    } else {
                        echo "<a class='nav-link' href='/webbanhang/account/login'>Đăng nhập</a>";
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <?php
                    if (SessionHelper::isLoggedIn()) {
                        echo "<a class='nav-link' href='/webbanhang/account/logout'>Đăng xuất</a>";
                    }
                    ?>
                </li>
            </ul>





            <!-- Giỏ hàng nằm bên phải -->
            <div class="ml-auto d-flex align-items-center">
                <a href="/webbanhang/Product/cart" class="btn btn-primary d-flex align-items-center"> 🛒
                    <span class="badge badge-light ml-2">
                        <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                    </span>
                </a>
            </div>
        </div>
    </nav>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>