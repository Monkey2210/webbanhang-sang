<?php include 'app/views/shares/header.php'; ?>
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card text-white" style="border-radius: 1rem; background: linear-gradient(135deg, #5de0e6, #004aad);">

                    <div class="card-body p-5 text-center">
                        <form action="/webbanhang/account/checklogin" method="post">

                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-5">Please enter your login and password!</p>
                                <div class="form-outline form-white mb-4">

                                    <input type="text" name="username" class="form-control form-control-lg" />

                                    <label class="form-label" for="typeEmailX">UserName</label>
                                </div>
                                <div class="form-outline form-white mb-4">

                                    <input type="password" name="password" class="form-control form-control-lg" />

                                    <label class="form-label" for="typePasswordX">Password</label>
                                </div>
                                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="/webbanhang/account/forgotpassword">Forgot password?</a></p>

                                </p>

                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                    <a href="/webbanhang/account/login-facebook" class="btn btn-primary me-2">
                                        <i class="fab fa-facebook-f">Facebook </i>
                                    </a>
                                    <a href="/webbanhang/account/login-google" class="btn btn-danger">
                                        <i class="fab fa-google">Google</i>
                                    </a>
                                </div>


                            </div>
                            <div>
                                <p class="mb-0">Don't have an account? <a href="/webbanhang/account/register " class="text-white-50 fw-bold">Sign Up</a>

                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'app/views/shares/footer.php'; ?>