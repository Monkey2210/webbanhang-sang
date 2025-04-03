<style>
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        margin: 0;
        overflow-x: hidden;
    }

    .content-wrapper {
        flex: 1;
        min-height: auto;
        padding-bottom: 1rem;
    }

    footer {
        flex-shrink: 0;
        background-color: #f8f9fa;
        border-top: 2px solid #007bff;
        box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.05);
        width: 100%;
        position: relative;
        bottom: 0;
    }

    /* Thêm style cho footer content */
    footer .container {
        padding: 1rem 0;
    }

    footer h5 {
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    footer p,
    footer li {
        font-size: 0.8rem;
        margin-bottom: 0.3rem;
    }

    footer hr {
        margin: 0.5rem 0;
    }
</style>

<div class="content-wrapper">
    <!-- Nội dung chính của trang -->
</div>

<footer class="py-3"> <!-- Giảm padding top và bottom -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5 class="font-weight-bold">Thông tin liên hệ</h5>
                <p>Địa chỉ: 123 Đường ABC, Quận XYZ</p>
                <p>Email: example@email.com</p>
                <p>Điện thoại: (123) 456-7890</p>
            </div>
            <div class="col-md-4">
                <h5 class="font-weight-bold">Liên kết nhanh</h5>
                <ul class="list-unstyled">
                    <li><a href="/webbanhang/Product">Trang chủ</a></li>
                    <li><a href="/webbanhang/Product">Sản phẩm</a></li>
                    <li><a href="#">Liên hệ</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="font-weight-bold">Theo dõi chúng tôi</h5>
                <div class="social-links">
                    <a href="https://www.facebook.com/tan.sang.951723?locale=vi_VN" target="_blank" class="me-3"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="https://www.instagram.com/_nguyentansang_04/" target="_blank" class="me-3"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
            </div>
            <hr class="my-4">
        </div>
        <hr class="my-4">
        <div class="text-center">
            <p class="mb-0">&copy; 2025 Sang . Tất cả quyền được bảo lưu.</p>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>


</html>