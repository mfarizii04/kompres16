            
        <!-- NAVBAR!! -->
        <?php require "_parts/navbar.php"; ?>

        <div id="layoutSidenav">
            
            <!-- SIDEBAR!! -->
            <?php require "_parts/sidebar.php"; ?>

            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-fluid px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="message-circle"></i></div>
                                            Activity Log
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-fluid px-4">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th><center>Tgl. Aktivitas</center></th>
                                            <th><center>Modul</center></th>
                                            <th><center>Aktivitas</center></th>
                                            <th><center>Alamat IP</center></th>
                                            <th><center>Status</center></th>
                                            <th><center>Aksi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($activity->result() as $gb) :
                                        ?>

                                        <tr align="center">
                                            <td><?= date("d/m/Y H:i:s", strtotime($gb->created_at)) ?></td>
                                            <td><?= $gb->modul ?></td>
                                            <td>
                                                <?php if(strlen($gb->aktivitas) >= 50){ echo substr($gb->aktivitas, 0, 50) . "..."; } else { echo $gb->aktivitas; } ?>  
                                            </td>
                                            <td><?= $gb->ip_user ?></td>
                                            <td>
                                                <?php if($gb->status=="success"){ ?>
                                                    <span class="badge bg-success">Berhasil</span>
                                                <?php } elseif($gb->status=="warning") { ?>
                                                    <span class="badge bg-success">Peringatan</span>
                                                <?php } else { ?>
                                                    <span class="badge bg-danger">Gagal</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary me-2" href="<?= base_url("admin/log/detail/" . $gb->log_id) ?>"><i class="fas fa-search"></i></a>
                                            </td>
                                        </tr>

                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- FOOTER!! -->
                <?php require "_parts/footer.php"; ?>

            </div>
        </div>
