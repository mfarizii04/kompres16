
        <!-- NAVBAR -->
        <?php require "_parts/navbar_home.php"; ?>

        <!-- KONTEN -->
        <div id="layoutSidenav_content" class="mt-5">
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="home"></i></div>
                                            Selamat Datang di <b>&nbsp;Inventarizz.</b>
                                        </h1>
                                        <div class="page-header-subtitle">Sistem Aplikasi Web Manajemen Inventaris</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4">
                        <!-- <h4 class="mb-0 mt-5"><i class="fas fa-sign-in-alt"></i>&nbsp; Login Akun</h4>
                        <hr class="mt-2 mb-4" /> -->
                        <!-- ADMIN -->
                        <h3><i class="fas fa-sign-in-alt"></i>&nbsp; Pilih peranmu untuk lanjut masuk sistem</h3>
                        <a class="card card-icon lift lift-sm mb-4" href="<?= base_url("auth/admin/login") ?>">
                            <div class="row g-0">
                                <div class="col-auto card-icon-aside bg-primary"><i class="text-white-50" data-feather="user"></i></div>
                                <div class="col">
                                    <div class="card-body py-4">
                                        <h5 class="card-title text-primary mb-2">Administrator</h5>
                                        <p class="card-text mb-1">Berperan sebagai pengatur utama untuk maintenance dan pemantauan server kantor.</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- VIEWERS / MONITOR -->
                        <a class="card card-icon lift lift-sm mb-4" href="<?= base_url("auth/login") ?>">
                            <div class="row g-0">
                                <div class="col-auto card-icon-aside bg-success"><i class="text-white-50" data-feather="eye"></i></div>
                                <div class="col">
                                    <div class="card-body py-4">
                                        <h5 class="card-title text-secondary mb-2">Viewer</h5>
                                        <p class="card-text mb-1">Membantu Administrator dalam meng-update informasi dan memantau perkembangan server.</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </main>
            </div>
        </div>
            
        <!-- FOOTER -->
        <?php require "_parts/footer.php"; ?>

        </div>