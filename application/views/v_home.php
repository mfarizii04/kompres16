
        <!-- NAVBAR -->
        <?php require "_parts/navbar_home.php"; ?>

        <!-- KONTEN -->
        <div id="layoutSidenav_content" class="mt-5">
            <div id="layoutSidenav_content">
                <main>
                    <header class="card card-waves">
                            <div class="card-body px-5 pt-5 pb-0">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-lg-8">
                                        <h1 class="text-dark">Selamat Datang di <strong class="text-dark">Inventarizz-AI.</strong></h1>
                                        <p style="font-weight: bold;" class="lead mb-4 text-dark">Manajemen Aset Infrastruktur Server, Monitoring Live Audit, dan Ticketing Helpdesk</p>
                                    </div>
                                    <div class="col-lg-4"><img class="img-fluid" src="<?= base_url('public/') ?>assets/img/illustrations/statistics.svg" /></div>
                                </div>
                            </div>
                        </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4">
                        <div class="row justify-content-center">

                            <div class="col-lg-12 mt-5">
                                <div class="text-center">
                                    <p class="text-dark text-uppercase" style="font-weight: bold; letter-spacing: 1px;">
                                        <i class="fas fa-sign-in-alt"></i>&nbsp; Silakan Pilih Hak Akses Login
                                    </p>
                                </div>
                            </div>
                            
                            <!-- ADMIN -->
                            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11 mt-4">
                                <a class="card card-icon lift lift-sm mb-4" href="<?= base_url("auth/admin/login") ?>">
                                    <div class="card text-center h-100">
                                        <div class="card-body px-5 pt-5 d-flex flex-column">
                                            <div>
                                                <div style="font-weight: bold" class="h3 text-secondary">Administrator</div>
                                                <p class="text-dark mb-4">Manajemen Aset, Live Audit Trail dan Monitoring Infrastruktur IT</p>
                                            </div>
                                            <div class="icons-org-create align-items-center mx-auto mt-auto">
                                                <font size="+6"><i class="fas fa-user-tie text-secondary"></i></font>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- VIEWERS / MONITOR -->
                            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11 mt-4">
                                <a class="card card-icon lift lift-sm mb-4" href="<?= base_url("auth/login") ?>">
                                    <div class="card text-center h-100">
                                        <div class="card-body px-5 pt-5 d-flex flex-column">
                                            <div>
                                                <div style="font-weight: bold" class="h3 text-warning">Staff</div>
                                                <p class="text-dark mb-4">Pengaduan Kendala (<strong>Ticketing</strong>) dan Monitoring Status Infrastruktur</p>
                                            </div>
                                            <div class="icons-org-create align-items-center mx-auto mt-auto">
                                                <font size="+6"><i class="fas fa-users text-warning"></i></font>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
            
        <!-- FOOTER -->
        <?php require "_parts/footer.php"; ?>

        </div>