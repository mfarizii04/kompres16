<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login Viewer | Inventarizz.</title>
        <link href="<?= base_url('public/') ?>css/styles.css" rel="stylesheet" />
        <!-- <link rel="icon" type="image/x-icon" href="<?= base_url('public/') ?>assets/img/favicon.png" /> -->
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
        <!-- SweetAlert 2 -->
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.0/dist/sweetalert2.min.css" rel="stylesheet">
    </head>
    <body class="bg-dark">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container-xl px-4 mt-3">
                        <div class="row justify-content-center">
                            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11">
                                <!-- Social login form-->
                                <div class="card bg-gradient-light my-5">
                                    <div class="card-body p-5 text-center">
                                        <div class="h1 fw-light mb-3"><i class="fas fa-eye"></i>&nbsp; Login Viewer</div>
                                        <div class="h6 fw-bold">
                                            <a href="<?= base_url() ?>"><i class="fas fa-server"></i>&nbsp; Inventarizz.</a>
                                        </div>
                                    </div>
                                    <hr class="my-0" />
                                    <div class="card-body p-5">
                                        <!-- Login form-->
                                        <form autocomplete="none" method="post">
                                            <!-- Form Group (email address)-->
                                            <div class="mb-3">
                                                <label class="text-gray-600 small" for="emailExample"><i class="fas fa-user"></i>&nbsp; Username</label>
                                                <input class="form-control form-control-solid" type="text" name="user" placeholder="Username" aria-label="Username" aria-describedby="usernameExample" required />
                                            </div>
                                            <!-- Form Group (password)-->
                                            <div class="mb-3">
                                                <label class="text-gray-600 small" for="passwordExample"><i class="fas fa-lock"></i>&nbsp; Password</label>
                                                <input class="form-control form-control-solid" type="password" name="pwd" placeholder="Password" aria-label="Password" aria-describedby="passwordExample" required />
                                            </div>
                                            <!-- Form Group (forgot password link)-->
                                            <div class="d-flex align-items-center justify-content-between mb-0">
                                                <!-- <div class="form-check">
                                                    <input class="form-check-input" id="checkRememberPassword" type="checkbox" value="" />
                                                    <label class="form-check-label" for="checkRememberPassword">Remember password</label>
                                                </div> -->
                                                <button type="submit" name="login" class="col-lg btn btn-success"><i class="fas fa-sign-in-alt"></i>&nbsp; Login</a>
                                            </div>
                                        </form>
                                    </div>
                                    <hr class="my-0" />
                                    <div class="card-body px-5 py-4">
                                        <div class="small text-center">
                                            <i class="fas fa-code"></i>&nbsp; Hand-Crafted by <b><i>RizzDev.</i></b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="footer-admin mt-auto footer-dark">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small"><b><i class="fas fa-server"></i>&nbsp; Inventarizz.</b> &copy; <?= date("Y") ?></div>
                            <div class="col-md-6 text-md-end small">
                                Follow Me &nbsp; <i class="fab fa-instagram"></i>&nbsp;<a target="_blank" href="https://instagram.com/mhnfarizi04"><b>mhnfarizi04</b></a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('public/') ?>js/scripts.js"></script>
        <!-- SweetAlert 2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.0/dist/sweetalert2.all.min.js"></script>
        <?php if($this->session->flashdata('msg')){ ?>
        <script type="text/javascript">
            Swal.fire({
                title: "Gagal",
                text: "<?= $this->session->flashdata('msg') ?>",
                icon: "error",
                draggable: true
            });
        </script>
        <?php } elseif($this->session->flashdata('isLogin')){ ?>
        <script type="text/javascript">
            Swal.fire({
                title: "Sudah Login",
                text: "<?= $this->session->flashdata('isLogin') ?>",
                icon: "info",
                draggable: true
            }).then((result) => {
                window.location = "<?= base_url("dashboard") ?>";
            });
        </script>
        <?php } ?>
    </body>
</html>
