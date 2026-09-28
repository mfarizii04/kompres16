        
        <!-- NAVBAR!! -->
        <?php require "_parts/navbar.php"; ?>

        <div id="layoutSidenav">
            
            <!-- SIDEBAR!! -->
            <?php require "_parts/sidebar.php"; ?>

            <div id="layoutSidenav_content">
                <main>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-5">
                        <!-- Custom page header alternative example-->
                        <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                            <div class="me-4 mb-3 mb-sm-0">
                                <h1 class="mb-0"><i class="fas fa-tachometer-alt"></i>&nbsp; Dashboard</h1>
                                <div class="small">
                                    <span class="fw-500 text-primary"><?= $hari ?></span>
                                    &middot; <?= $tgl . " " . $bln . " " . $thn ?>
                                </div>
                            </div>
                        </div>
                        <!-- Illustration dashboard card example-->
                        <div class="card card-waves mb-4 mt-5">
                            <div class="card-body p-5">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col">
                                        <h2 class="text-primary">🙌 Haiii, <b><?= $this->session->userdata("admin") ?></b> !</h2>
                                        <p class="text-gray-700">Selamat datang di platform inventaris yang siap bantu kamu untuk memantau dan mengatur server kantor secara real-time. Bye-bye Excel, hello efisiensi.</p>
                                        <a class="btn btn-primary p-3" href="<?= base_url("admin/server") ?>">
                                            <i class="fas fa-server"></i>&nbsp; Pantau server kantor
                                            <i class="ms-1" data-feather="arrow-right"></i>
                                        </a>
                                    </div>
                                    <div class="col d-none d-lg-block mt-xxl-n4"><img class="img-fluid px-xl-4 mt-xxl-n5" src="<?= base_url("public/") ?>assets/img/illustrations/statistics.svg" /></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <!-- Dashboard info widget 1-->
                                <a href="<?= base_url("admin/server") ?>" class="text-decoration-none">
                                    <div class="card border-start-lg border-start-primary h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <div class="small fw-bold text-primary mb-1">Server Aktif</div>
                                                    <div class="h5"><?= number_format($countServers, 0, "", ".") ?></div>
                                                </div>
                                                <div class="ms-2"><i class="fas fa-server fa-2x text-gray-200"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <!-- Dashboard info widget 2-->
                                <a href="<?= base_url("admin/os") ?>" class="text-decoration-none">
                                    <div class="card border-start-lg border-start-secondary h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <div class="small fw-bold text-secondary mb-1">Sistem Operasi</div>
                                                    <div class="h5"><?= number_format($countOS, 0, "", ".") ?></div>
                                                </div>
                                                <div class="ms-2"><i class="fas fa-computer fa-2x text-gray-200"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <!-- Dashboard info widget 3-->
                                <a href="<?= base_url("admin/database") ?>" class="text-decoration-none">
                                    <div class="card border-start-lg border-start-success h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <div class="small fw-bold text-success mb-1">Database</div>
                                                    <div class="h5"><?= number_format($countDB, 0, "", ".") ?></div>
                                                </div>
                                                <div class="ms-2"><i class="fas fa-database fa-2x text-gray-200"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <!-- Dashboard info widget 4-->
                                <a href="<?= base_url("admin/akun") ?>" class="text-decoration-none">
                                    <div class="card border-start-lg border-start-warning h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <div class="small fw-bold text-warning mb-1">Akun Server</div>
                                                    <div class="h5"><?= number_format($countServersAcc, 0, "", ".") ?></div>
                                                </div>
                                                <div class="ms-2"><i class="fas fa-user fa-2x text-gray-200"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-12 col-md-6 mb-4">
                                <!-- Dashboard info widget 4-->
                                <a href="<?= base_url("admin/users") ?>" class="text-decoration-none">
                                    <div class="card border-start-lg border-start-dark h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <div class="small fw-bold text-dark mb-1 text-end">Akun User &nbsp;&nbsp; </div>
                                                    <div class="h5 text-end"><?= number_format($countUsers, 0, "", ".") ?> &nbsp;&nbsp; </div>
                                                </div>
                                                <div class="ms-2"><i class="fas fa-users fa-2x text-gray-200"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h3><i class="fas fa-comment"></i>&nbsp; Lapor Mas Atmin terbaru</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            
                                            <div class="alert alert-danger text-center">
                                                <?php $jumLaporan = $laporAtmin->num_rows(); ?>
                                                <h5 style="font-weight: bold"><i class="fas fa-envelope-open"></i>&nbsp; Terdapat <?= number_format($jumLaporan, 0, "", ".") ?> laporan terbaru saat ini yang belum direspon</h5>
                                            </div>

                                            <table class="table table-striped table-responsive">
                                                <thead>
                                                    <tr style="font-weight: bold" align="center">
                                                        <td>Tgl. Laporan</td>
                                                        <td>Subjek</td>
                                                        <td>Status</td>
                                                        <td>Aksi</td>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    foreach ($laporAtmin->result() as $gbLaporan) :
                                                    ?>

                                                    <tr align="center">
                                                        <td><?= date("d/m/Y H:i:s", strtotime($gbLaporan->tgl)) ?></td>
                                                        <td><?php if(strlen($gbLaporan->subjek) >= 50){ echo substr($gbLaporan->subjek, 0, 50) . "..."; } else { echo $gbLaporan->subjek; } ?></td>
                                                        <td><?php if($gbLaporan->status=="Belum dibaca"){ echo '<span class="badge bg-danger"><i class="fas fa-times"></i>&nbsp; Belum direspon</span>'; } elseif($gbLaporan->status=="Sedang diproses") { echo '<span class="badge bg-info"><i class="fas fa-clock"></i>&nbsp; Sedang diproses</span>'; } else { echo '<span class="badge bg-success"><i class="fas fa-check"></i>&nbsp; Selesai</span>'; } ?></td>
                                                        <td>
                                                            <a href="<?= base_url("admin/lapor/detail/" . $gbLaporan->lapor_id) ?>" class="btn btn-primary"><i class="fas fa-search"></i></a>
                                                            &nbsp;&nbsp;
                                                            <a href="<?= base_url("admin/lapor/respon/" . $gbLaporan->lapor_id) ?>" class="btn btn-success"><i class="fas fa-comments"></i></a>
                                                        </td>
                                                    </tr>

                                                    <?php endforeach; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="<?= base_url("admin/lapor") ?>" class="col-lg-12 btn btn-dark"><i class="fas fa-arrow-right"></i>&nbsp; Detail Laporan Lainnya</a>
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