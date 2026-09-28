        
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

                        <div class="row">

                            <!-- APLIKASI -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <!-- Dashboard info widget 1-->
                                <a href="<?= base_url("admin/aplikasi") ?>" class="text-decoration-none">
                                    <div class="card border-start-lg border-start-primary h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <div class="small fw-bold text-primary mb-1">Aplikasi</div>
                                                    <div class="h5"><?= number_format($countApplications, 0, "", ".") ?></div>
                                                </div>
                                                <div class="ms-2"><i class="fas fa-desktop fa-2x text-gray-200"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- SERVER AKTIF -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <!-- Dashboard info widget 1-->
                                <a href="<?= base_url("admin/server") ?>" class="text-decoration-none">
                                    <div class="card border-start-lg border-start-danger h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <div class="small fw-bold text-danger mb-1">Server Aktif</div>
                                                    <div class="h5"><?= number_format($countServers, 0, "", ".") ?></div>
                                                </div>
                                                <div class="ms-2"><i class="fas fa-server fa-2x text-gray-200"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- SISTEM OPERASI -->
                            <div class="col-xl-4 col-md-6 mb-4">
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

                            <!-- DATABASE -->
                            <div class="col-xl-4 col-md-6 mb-4">
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

                            <!-- AKUN SERVER -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <!-- Dashboard info widget 4-->
                                <a href="<?= base_url("admin/akun") ?>" class="text-decoration-none">
                                    <div class="card border-start-lg border-start-warning h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <div class="small fw-bold text-warning mb-1">Manajemen Akses User</div>
                                                    <div class="h5"><?= number_format($countServersAcc, 0, "", ".") ?></div>
                                                </div>
                                                <div class="ms-2"><i class="fas fa-user fa-2x text-gray-200"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- AKUN USER -->
                            <div class="col-xl-4 col-md-6 mb-4">
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

                        <!-- Live Audit Trail -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h3 class="m-0 font-weight-bold text-dark">
                                    <i class="fas fa-history mr-2"></i> Log Aktivitas & Jejak Audit Terbaru
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive table-hover" width="100%" cellspacing="0">
                                        <thead>
                                            <tr align="center">
                                                <th width="20%">Tgl. Aktivitas</th>
                                                <th width="45%">Deskripsi Aktivitas</th>
                                                <th width="20%">Status</th>
                                                <th width="15%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Row 1 -->
                                            <tr align="center">
                                                <td>
                                                    08/06/2026 09:15:22
                                                </td>
                                                <td>
                                                    [User Access Management] admin_root mengubah kredensial root pada Server Utama
                                                </td>
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <span class="badge" style="background-color: #e74a3b; color: white; padding: 0.5em 0.75em; font-size: 0.8rem; font-weight: 700; border-radius: 4px;">
                                                        <i class="fas fa-lock mr-1"></i> Terkunci (Log)
                                                    </span>
                                                </td>
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <button class="btn btn-primary btn-sm px-3" style="background-color: #0061f2; border: none;"><i class="fas fa-search"></i></button>
                                                </td>
                                            </tr>
                                            <tr align="center">
                                                <td>
                                                    08/06/2026 08:30:11
                                                </td>
                                                <td>
                                                    [Infrastructure Control] SYSTEM memicu alert: Lisensi OS Windows Server Wilayah Bektim sisa 30 Hari
                                                </td>
                                                <td>
                                                    <span class="badge" style="background-color: #e74a3b; color: white; padding: 0.5em 0.75em; font-size: 0.8rem; font-weight: 700; border-radius: 4px;">
                                                        <i class="fas fa-exclamation-triangle mr-1"></i> Perlu Tindakan
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm px-3" style="background-color: #0061f2; border: none;"><i class="fas fa-search"></i></button>
                                                </td>
                                            </tr>
                                            <tr align="center">
                                                <td>
                                                    07/06/2026 23:45:04
                                                </td>
                                                <td>
                                                    [Database Analytics] oracle_sys memperbarui parameter konfigurasi pool data pada SRV-CORE-ORACLE
                                                </td>
                                                <td>
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check-circle mr-1"></i> Sukses Dicatat
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm px-3" style="background-color: #0061f2; border: none;"><i class="fas fa-search"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Lapor Mas Atmin -->
                        <div class="row">
                            <div class="col-lg-12">
                                
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h3 class="mt-3"><i class="fas fa-comment"></i>&nbsp; Lapor Mas Atmin terbaru</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            
                                            <div class="alert alert-danger text-center">
                                                <?php
                                                $jumLaporan = $laporAtmin->num_rows();
                                                ?>
                                                <h5 style="font-weight: bold"><i class="fas fa-envelope-open"></i>&nbsp; <?php if($jumLaporan > 1){ ?>Terdapat <?= number_format($jumLaporan, 0, "", ".") ?> laporan terbaru saat ini yang belum direspon <?php } else { echo "Belum ada laporan"; } ?></h5>
                                            </div>

                                            <?php if($jumLaporan > 0) { ?>
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
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php if($jumLaporan > 0) { ?>
                                    <div class="card-footer">
                                        <a href="<?= base_url("admin/lapor") ?>" class="col-lg-12 btn btn-dark"><i class="fas fa-arrow-right"></i>&nbsp; Detail Laporan Lainnya</a>
                                    </div>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>

                    </div>
                </main>

                <!-- FOOTER!! -->
                <?php require "_parts/footer.php"; ?>

            </div>
        </div>