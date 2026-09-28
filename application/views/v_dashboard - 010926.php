        
        <!-- NAVBAR!! -->
        <?php require "_parts/navbar.php"; ?>

        <div id="layoutSidenav">
            
            <!-- SIDEBAR!! -->
            <?php require "_parts/sidebar.php"; ?>

            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon text-light"><i class="fas fa-tachometer-alt"></i></div>
                                            &nbsp;Dashboard
                                        </h1>
                                        <!-- <div class="page-header-subtitle">Selamat Datang di <strong>Inventarizz.</strong> | Manajemen Aset, Monitoring Live Audit dan Ticketing Helpdesk Infrastruktur IT</div> -->
                                        <div class="page-header-subtitle text-light">Manajemen Aset, Monitoring Live Audit dan Ticketing Helpdesk Infrastruktur IT</div>
                                    </div>
                                    <div class="col-12 col-xl-auto mt-4">
                                        <span style="background-color: #F5F5DC" class="badge text-dark">
                                            <h6 class="py-1 mt-2" style="font-weight: bold">
                                                <label>
                                                <i class="fas fa-calendar-alt"></i>
                                                &nbsp;<?= $waktu["hari"] ?>
                                                &middot; <?= $waktu["tgl"] . " " . $waktu["bln"] . " " . $waktu["thn"] ?>
                                                </label>
                                            </h6>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-n10">

                        <?php
                        if ($reminderSSL->num_rows() > 0) {
                            $sisaHari = $reminderSSL->row()->sisa_hari;
                            if ($sisaHari < 1) {
                                $bg="danger";
                                $label="SSL Aplikasi Kadaluwarsa!";
                            } elseif ($sisaHari <= 30) {
                                $bg="danger";
                                $label="Peringatan!";
                            } else {
                                $bg="secondary";
                                $label="Reminder!";
                            }
                        ?>

                        <!-- REMINDER LISENSI SSL APLIKASI -->
                        <div class="row mb-1">
                            <div class="col-lg-12">
                                <div class="alert bg-<?= $bg ?>" style="color: white">
                                    <h1 class="mt-1" style="color: white"><i class="fas fa-exclamation-triangle"></i>&nbsp; <strong><?= $label ?></strong></h1>
                                    <p>Lisensi SSL Aplikasi <strong><?= $reminderSSL->row()->nama ?></strong> akan berakhir <?= $reminderSSL->row()->sisa_hari ?> hari lagi</p>
                                </div>
                            </div>
                        </div>

                        <?php } ?>

                        <div class="row">

                            <!-- LAPORAN BELUM DIBACA -->
                            <div class="col-lg-6 col-xl-4 mb-4">
                                <div class="card bg-dark text-white h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="me-3">
                                                <div class="text-white-75 small">Laporan Saya</div>
                                                <div class="text-lg fw-bold"><?= number_format($countLaporan, 0, "", ".") ?></div>
                                            </div>
                                            <div class="ms-2"><i class="fas fa-comments fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between small">
                                        <a class="text-white stretched-link" href="<?= base_url("lapor") ?>">Selengkapnya</a>
                                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <!-- SSL EXPIRED -->
                            <div class="col-lg-6 col-xl-4 mb-4">
                                <div style="background-color: #E22329" class="card text-white h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="me-3">
                                                <div class="text-white-75 small">SSL Aplikasi Expired</div>
                                                <div class="text-lg fw-bold"><?= number_format($countSSL, 0, "", ".") ?></div>
                                            </div>
                                            <div class="ms-2"><i class="fas fa-calendar-alt fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between small">
                                        <a class="text-white stretched-link" href="<?= base_url("aplikasi") ?>">Selengkapnya</a>
                                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <!-- LOG ACTIVITY -->
                            <div class="col-lg-6 col-xl-4 mb-4">
                                <div style="background-color: #99CC33" class="card text-dark h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="me-3">
                                                <div class="text-dark-75 small">Log Aktivitas Saya</div>
                                                <div class="text-lg fw-bold"><?= number_format($countLog, 0, "", ".") ?></div>
                                            </div>
                                            <div class="ms-2"><i class="fas fa-calendar-alt fa-2x text-dark-200"></i></div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between small">
                                        <a class="text-dark stretched-link" href="<?= base_url("log") ?>">Selengkapnya</a>
                                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Riwayat Terakhir Laporan Mas Atmin -->
                        <div class="row">
                            <div class="col-lg-12">
                                
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <h3 class="mt-1 text-light"><i class="fas fa-comment"></i>&nbsp; Riwayat terakhir laporan kamu ke Mas Atmin</h3>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $jumLaporan = $laporan->num_rows();
                                        
                                        if ($jumLaporan > 0)
                                        {
                                        ?>
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr align="center">
                                                    <th><center>Tgl. Laporan</center></th>
                                                    <th><center>Subjek</center></th>
                                                    <th><center>Status</center></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                foreach ($laporan->result() as $gb) :
                                                ?>

                                                <tr align="center">
                                                    <td><?= date("d/m/Y H:i:s", strtotime($gb->tgl)) ?></td>
                                                    <td><a href="<?= base_url("lapor/detail/" . $gb->lapor_id) ?>" title="Detail Laporan <?= $gb->subjek ?>"><?php if(strlen($gb->subjek) >= 50){ echo substr($gb->subjek, 0, 50) . "..."; } else { echo $gb->subjek; } ?></a></td>
                                                    <td>
                                                        <?php
                                                        if ($gb->status=="Selesai") {
                                                            echo '<span style="background-color: #99CC33" class="badge bg text-dark"><i class="fas fa-check"></i>&nbsp; Selesai</span>';
                                                        } elseif ($gb->status=="Sedang diproses") {
                                                            echo '<span class="badge bg-warning text-light"><i class="fas fa-times"></i>&nbsp; Sedang diproses</span>';
                                                        }
                                                         else {
                                                            echo '<span style="background-color: #E22329" class="badge bg-danger text-light"><i class="fas fa-times"></i>&nbsp; Belum ditanggapi</span>';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <?php endforeach; ?>

                                            </tbody>
                                        </table>
                                        <?php } else { ?>

                                            <div class="alert alert-danger">
                                                <h3 class="text-center"><i class="fas fa-exclamation-triangle"></i>&nbsp; Belum ada laporan</h3>
                                            </div>

                                        <?php } ?>
                                    </div>
                                    <?php if($jumLaporan > 1) { ?>
                                    <div class="card-footer">
                                        <a href="<?= base_url("lapor") ?>" class="col-lg-12 btn btn-dark"><i class="fas fa-arrow-right"></i>&nbsp; Detail Laporan Lainnya</a>
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