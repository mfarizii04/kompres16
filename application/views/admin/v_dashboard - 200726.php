        
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
                                    <label>Mohon segera diperpanjang <a href="javascript:void(0)" data-namaAplikasi="<?= $reminderSSL->row()->nama ?>" data-SSLExpired="<?= $reminderSSL->row()->ssl_expired ?>" data-bs-toggle="modal" data-bs-target="#sslExtended" title="Perpanjang SSL Aplikasi" style="font-weight: bold; color: white; text-decoration: underline;">di sini</a></label>
                                </div>
                            </div>
                        </div>

                        <!-- POPUP PERPANJANG SSL APLIKASI -->
                        <div class="modal fade" id="sslExtended" tabindex="-1" role="dialog" aria-labelledby="sslExtended" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Perpanjang SSL Aplikasi <br> <strong><?= $reminderSSL->row()->nama ?></strong></h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <form method="post">
                                            
                                            <div class="form-group mb-3">
                                                <label>SSL Aplikasi</label>
                                                <input type="hidden" name="id_aplikasi" value="<?= $reminderSSL->row()->aplikasi_id ?>">
                                                <input class="form-control" id="sslExpired" type="date" name="tgl_expired" value="" min="<?= date("Y-m-d", strtotime("+1 month")) ?>" required />
                                                <?php
                                                if ($selisih < 1) {
                                                    $msg = 'sudah expired';
                                                } else {
                                                    $msg = 'tersisa ' . $gb->sisa_hari . ' hari lagi';
                                                }
                                                ?>
                                                <p class="mt-1 text-danger">(saat ini berlaku sampai <?= date("d/m/Y", strtotime($reminderSSL->row()->ssl_expired)) ?> - <?= $msg ?>)</p>
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" name="extend"><i class="fas fa-clock"></i>&nbsp; Perpanjang</button>
                                        </form>
                                        <!-- <button class="btn btn-danger" type="button" data-bs-dismiss="modal"><i class="fas fa-times"></i>&nbsp; Tutup</button> -->
                                    </div>
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
                                                <div class="text-white-75 small">Laporan Belum Dibaca</div>
                                                <div class="text-lg fw-bold"><?= number_format($countLaporan, 0, "", ".") ?></div>
                                            </div>
                                            <div class="ms-2"><i class="fas fa-exclamation-triangle fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between small">
                                        <a class="text-white stretched-link" href="<?= base_url("admin/lapor") ?>">Selengkapnya</a>
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
                                        <a class="text-white stretched-link" href="<?= base_url("admin/aplikasi") ?>">Selengkapnya</a>
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
                                                <div class="text-dark-75 small">Log Aktivitas</div>
                                                <div class="text-lg fw-bold"><?= number_format($countLog, 0, "", ".") ?></div>
                                            </div>
                                            <div class="ms-2"><i class="fas fa-calendar-alt fa-2x text-dark-200"></i></div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between small">
                                        <a class="text-dark stretched-link" href="<?= base_url("admin/log") ?>">Selengkapnya</a>
                                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Quick Table -->
                        <div class="row align-items-stretch">
                            
                            <!-- Lapor Mas Atmin -->
                            <div class="col-lg-6 d-flex mb-4">
                                <div class="card w-100 d-flex flex-column shadow-sm">
                                    <div class="card-header bg-dark py-3 d-flex align-items-center justify-content-between">
                                        <?php $jumLaporan = $laporAtmin->num_rows(); ?>
                                        <h3 class="m-0 font-weight-bold text-light">
                                            <i class="fas fa-comment"></i>&nbsp; Lapor Mas Atmin terbaru
                                        </h3>
                                        <?php if($jumLaporan > 0){ ?>
                                        <span class="badge bg-danger text-white font-weight-bold px-2 py-1" style="border-radius: 5px;"><?= $jumLaporan ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="card-body flex-grow-1 p-0" style="height: 400px; overflow-y: auto;">
                                        <div class="table-responsive">
                                            <?php if($jumLaporan > 0){ ?>
                                            <table class="table table-striped mb-0" width="100%">
                                                <thead>
                                                    <tr style="font-weight: bold" align="center">
                                                        <td>Tgl. Laporan</td>
                                                        <td>Subjek</td>
                                                        <td>Status</td>
                                                        <td>Aksi</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($laporAtmin->result() as $gbLaporan) : ?>
                                                    <tr align="center">
                                                        <td><?= date("d/m/Y H:i:s", strtotime($gbLaporan->tgl)) ?></td>
                                                        <td><a href="<?= base_url("admin/lapor/detail/" . $gbLaporan->lapor_id) ?>" title="Detail Laporan"><?php if(strlen($gbLaporan->subjek) >= 35){ echo substr($gbLaporan->subjek, 0, 35) . "..."; } else { echo $gbLaporan->subjek; } ?></a></td>
                                                        <td>
                                                            <?php if($gbLaporan->status=="Belum dibaca"){ echo '<span class="badge bg-danger">Belum direspon</span>'; } elseif($gbLaporan->status=="Sedang diproses") { echo '<span class="badge bg-info">Sedang diproses</span>'; } else { echo '<span style="background-color: #99CC33" class="badge bg">Selesai</span>'; } ?>
                                                        </td>
                                                        <td>
                                                            <!-- <a href="<? //base_url("admin/lapor/respon/" . $gbLaporan->lapor_id) ?>" class="btn btn-success" title="Respon Laporan"><i class="fas fa-comments"></i></a> -->
                                                            <a style="background-color: #99CC33" href="<?= base_url("admin/lapor/respon/" . $gbLaporan->lapor_id) ?>" class="btn btn text-light" title="Respon Laporan"><i class="fas fa-comments"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <?php } else { ?>

                                                <div align="center" class="mt-5 align-items-center justify-content-between">
                                                    <img height="350" src="https://i.pinimg.com/736x/b9/63/a0/b963a07367c037de9e8a75a93a7f3dc4.jpg">
                                                </div>

                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php if($jumLaporan > 0) { ?>
                                    <div class="card-footer bg-transparent border-top">
                                        <a href="<?= base_url("admin/lapor") ?>" class="col-lg-12 btn btn-dark"><i class="fas fa-arrow-right"></i>&nbsp; Lihat Laporan Lainnya</a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <!-- Live Audit Trail -->
                            <div class="col-lg-6 d-flex mb-4">
                                
                                <div class="card w-100 d-flex flex-column shadow-sm">
                                    <div style="background-color: #99CC33" class="card-header py-3">
                                        <h3 class="m-0 font-weight-bold text-dark">
                                            <i class="fas fa-history mr-2"></i>&nbsp; Riwayat Aktivitas Log terakhir
                                        </h3>
                                    </div>
                                    <div class="card-body flex-grow-1 p-0" style="height: 400px; overflow-y: auto;">
                                        <div class="table-responsive">
                                            <!-- FIX 2: Hapus class 'table-responsive' ganda pada tag table -->
                                            <table class="table table-hover mb-0" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr align="center">
                                                        <th>Tgl. Aktivitas</th>
                                                        <th>Aktivitas</th>
                                                        <th>IP User</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($logActivity->result() as $gbLog) : ?>
                                                    <tr align="center">
                                                        <td><?= date("d/m/Y H:i:s", strtotime($gbLog->created_at)) ?></td>
                                                        <td><a href="<?= base_url("admin/log/detail/" . $gbLog->log_id) ?>" title="Detail Aktivitas Log"><?php if(strlen($gbLog->aktivitas) >= 50){ echo substr($gbLog->aktivitas, 0, 50) . "..."; } else { echo $gbLog->aktivitas; } ?></a></td>
                                                        <td><?= $gbLog->ip_user ?></td>
                                                        <td><?php if($gbLog->status=="warning") { echo '<span class="badge bg-warning">Peringatan</span>'; } elseif($gbLog->status=="success") { echo '<span style="background-color: #99CC33" class="badge bg">Berhasil</span>'; } else { echo '<span class="badge bg-danger"> Gagal</span>'; } ?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent border-top">
                                        <a href="<?= base_url("admin/log") ?>" class="btn btn-dark col-lg-12"><i class="fas fa-arrow-right"></i>&nbsp; Lihat Activity Log Lainnya</a>
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