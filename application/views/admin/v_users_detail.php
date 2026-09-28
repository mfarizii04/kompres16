            
        <!-- NAVBAR!! -->
        <?php require "_parts/navbar.php"; ?>

        <div id="layoutSidenav">
            
            <!-- SIDEBAR!! -->
            <?php require "_parts/sidebar.php"; ?>

            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="search"></i></div>
                                            Detail Akun
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-warning" href="<?= base_url("admin/users") ?>">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Kembali
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-4">
                        <div class="row">
                            <div class="col-xl-12">
                                <!-- Account details card-->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <table class="table table-responsive">
                                            <tr>
                                                <td align="center">Tgl. Bergabung</td>
                                                <td align="center"><b><?= date("d/m/Y H:i:s", strtotime($akun->created_at)) ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Username</td>
                                                <td align="center"><b><?= $akun->username ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Password</td>
                                                <td align="center"><b><?= $akun->password ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Nama Lengkap</td>
                                                <td align="center"><b><?= $akun->nama ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">E-mail</td>
                                                <td align="center"><b><?= $akun->email ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Role</td>
                                                <td align="center"><b><?php if($akun->role=="Admin"){ echo '<i class="fas fa-user-tie"></i>&nbsp; ' . $akun->role; } else { echo '<i class="fas fa-user"></i> Staff'; } ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Status</td>
                                                <td align="center">
                                                    <?php
                                                    if ($akun->status=="Active") {
                                                        echo '<span class="badge bg-success text-light">Aktif</span>';
                                                    } else {
                                                        echo '<span class="badge bg-danger text-light">Nonaktif</span>';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- FOOTER!! -->
                <?php require "_parts/footer.php"; ?>

            </div>
        </div>
