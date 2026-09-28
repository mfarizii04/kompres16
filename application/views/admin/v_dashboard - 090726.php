        
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
                                    <span class="fw-500 text-primary"><?= $waktu["hari"] ?></span>
                                    &middot; <?= $waktu["tgl"] . " " . $waktu["bln"] . " " . $waktu["thn"] ?>
                                </div>
                            </div>
                        </div>

                        <!-- LISENSI SSL APLIKASI -->
                        <div class="row mb-1">
                            <div class="col-lg-12">
                                <div class="alert bg-danger" style="color: white">
                                    <h5 class="mt-1" style="color: white"><i class="fas fa-exclamation-triangle"></i>&nbsp; Lisensi SSL Aplikasi <strong>ORACLE-HELPDESK001</strong> tersisa 90 hari lagi</h5>
                                    <label>Mohon segera diperpanjang <a href="#" style="font-weight: bold; color: white; text-decoration: underline;">di sini</a></label>
                                    <hr>
                                    <div class="mt-3">
                                        <a href="#" class="text-light">
                                            <i class="fas fa-arrow-right"></i>
                                            <strong>Lainnya</strong>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <!-- LAPORAN BELUM DIBACA -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <!-- Dashboard info widget 1-->
                                <a href="<?= base_url("admin/lapor") ?>" class="text-decoration-none">
                                    <div class="card border-start-lg border-start-danger h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <div class="small fw-bold text-danger mb-1">Laporan Belum Dibaca</div>
                                                    <div class="h5"><?= number_format($countLaporan, 0, "", ".") ?></div>
                                                </div>
                                                <div class="ms-2"><i class="fas fa-exclamation-triangle fa-2x text-gray-200"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- SSL EXPIRED -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <!-- Dashboard info widget 2-->
                                <a href="<?= base_url("admin/aplikasi") ?>" class="text-decoration-none">
                                    <div class="card border-start-lg border-start-secondary h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <div class="small fw-bold text-secondary mb-1">SSL Aplikasi Expired</div>
                                                    <div class="h5"><?= number_format($countSSL, 0, "", ".") ?></div>
                                                </div>
                                                <div class="ms-2"><i class="fas fa-calendar-alt fa-2x text-gray-200"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- LOG ACTIVITY -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <!-- Dashboard info widget 3-->
                                <a href="<?= base_url("admin/log") ?>" class="text-decoration-none">
                                    <div class="card border-start-lg border-start-success h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <div class="small fw-bold text-success mb-1">Log Aktivitas Hari Ini</div>
                                                    <div class="h5"><?= number_format($countLog, 0, "", ".") ?></div>
                                                </div>
                                                <div class="ms-2"><i class="fas fa-history fa-2x text-gray-200"></i></div>
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
                                    <i class="fas fa-history mr-2"></i>&nbsp; Log Aktivitas Terakhir
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive table-hover" width="100%" cellspacing="0">
                                        <thead>
                                            <tr align="center">
                                                <th width="20%">Tgl. Aktivitas</th>
                                                <!-- <th>Modul</th> -->
                                                <th width="45%">Aktivitas</th>
                                                <th width="20%">Alamat IP</th>
                                                <th width="20%">Status</th>
                                                <th width="15%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            foreach ($logActivity->result() as $gbLog) :
                                            ?>

                                            <tr align="center">
                                                <td><?= date("d/m/Y H:i:s", strtotime($gbLog->created_at)) ?></td>
                                                <!-- <td><?php //if(strlen($gbLog->modul) > 8){ echo substr($gbLog->modul, 0, 8); } else { echo $gbLog->modul; } ?></td> -->
                                                <td><?php if(strlen($gbLog->aktivitas) >= 50){ echo substr($gbLog->aktivitas, 0, 50) . "..."; } else { echo $gbLog->aktivitas; } ?></td>
                                                <td><?= $gbLog->ip_user ?></td>
                                                <td><?php if($gbLog->status=="warning") { echo '<span class="badge bg-warning">Peringatan</span>'; } elseif($gbLog->status=="success") { echo '<span class="badge bg-success">Berhasil</span>'; } else { echo '<span class="badge bg-danger"> Gagal</span>'; } ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url("admin/log/detail/" . $gbLog->log_id) ?>" class="btn btn-primary"><i class="fas fa-search"></i></a>
                                                </td>
                                            </tr>

                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url("admin/log") ?>" class="btn btn-dark col-lg-12"><i class="fas fa-arrow-right"></i>&nbsp; Lihat Activity Log Lainnya</a>
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
                                                        <td><?php if($gbLaporan->status=="Belum dibaca"){ echo '<span class="badge bg-danger">Belum direspon</span>'; } elseif($gbLaporan->status=="Sedang diproses") { echo '<span class="badge bg-info">Sedang diproses</span>'; } else { echo '<span class="badge bg-success">Selesai</span>'; } ?></td>
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