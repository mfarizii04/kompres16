            
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
                                            Detail Activity Log
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-warning" href="<?= base_url("admin/log") ?>">
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
                                                <td width="20%" align="center">Tgl. Aktivitas</td>
                                                <td align="center"><b><?= date("d/m/Y H:i:s", strtotime($log->created_at)) ?></b></td>
                                            </tr>

                                            <tr>
                                                <td width="20%" align="center">Modul</td>
                                                <td align="center"><b><?= $log->modul ?></b></td>
                                            </tr>

                                            <tr>
                                                <td width="20%" align="center">Aktivitas</td>
                                                <td align="center"><b><?= $log->aktivitas ?></b></td>
                                            </tr>

                                            <tr>
                                                <td width="20%" align="center">Nama Akun</td>
                                                <td align="center"><b><?= $log->nama ?></b></td>
                                            </tr>

                                            <tr>
                                                <td width="20%" align="center">IP Akun</td>
                                                <td align="center"><b><?= $log->ip_user ?></b></td>
                                            </tr>

                                            <tr>
                                                <td width="20%" align="center">Status</td>
                                                <td align="center">
                                                    <?php
                                                    if ($log->status=="success") {
                                                        echo '<span class="badge bg-success text-light">Berhasil</span>';
                                                    } elseif ($log->status=="warning") {
                                                        echo '<span class="badge bg-warning text-light">Peringatan</span>';
                                                    } else {
                                                        echo '<span class="badge bg-danger text-light">Gagal</span>';
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
