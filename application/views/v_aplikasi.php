            
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
                                            <div class="page-header-icon"><i class="fas fa-desktop"></i></div>
                                            Aplikasi
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
                                            <th width="25%"><center>Nama Aplikasi</center></th>
                                            <th><center>Alamat IP</center></th>
                                            <th><center>Server</center></th>
                                            <th><center>SSL Expired</center></th>
                                            <th><center>Status</center></th>
                                            <th><center>Aksi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($aplikasi->result() as $gb) :
                                        ?>

                                        <tr align="center">
                                            <td width="25%">
                                                <?php if(strlen($gb->nama) >= 25){ echo substr($gb->nama, 0, 25) . "..."; } else { echo $gb->nama; } ?>
                                            </td>
                                            <td><?= $gb->ip ?></td>
                                            <td><?php if(strlen($gb->server_name) >= 7){ echo substr($gb->server_name, 0, 7) . "..."; } else { echo $gb->server_name; } ?></td>
                                            <td>
                                                <?php
                                                $selisih = $gb->sisa_hari;

                                                if ($selisih <= 90) {
                                                    echo '<a href="" title="Perpanjang SSL Aplikasi ' . $gb->nama . '" style="color: #69707a">';
                                                }

                                                echo date("d/m/Y", strtotime($gb->ssl_expired));

                                                if ($selisih < 0) {
                                                    echo '<span class="text-danger"> (Sudah expired)</span>';
                                                } else {
                                                    if ($selisih < 1) { $clr="danger font-weight-bold"; } elseif ($selisih <= 30) { $clr="danger"; } elseif ($selisih <= 90) { $clr="warning"; } else { $clr="secondary"; }
                                                    echo '<span class="text-' . $clr . '"> (Sisa ' . $gb->sisa_hari . ' hari lagi)</span>';
                                                }

                                                echo '</a>';

                                                ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?php if($gb->status=="Aktif"){ echo "success"; } else { echo "danger"; } ?>"><?= $gb->status ?></span>
                                            </td>
                                            <td>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="<?= base_url("aplikasi/detail/" . $gb->aplikasi_id) ?>" title="Detail Data"><i data-feather="search"></i></a>
                                            </td>
                                        </tr>

                                        <!-- POPUP PERPANJANG SSL APLIKASI -->
                                        <div class="modal fade" id="sslExtended" tabindex="-1" role="dialog" aria-labelledby="sslExtended" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Perpanjang SSL Aplikasi <br> <strong><?= $gb->nama ?></strong></h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        
                                                        <form method="post">
                                                            
                                                            <div class="form-group mb-3">
                                                                <label>SSL Aplikasi</label>
                                                                <input type="hidden" name="id_aplikasi" value="<?= $gb->aplikasi_id ?>">
                                                                <input class="form-control" id="sslExpired" type="date" name="tgl_expired" value="" min="<?= date("Y-m-d", strtotime("+1 month")) ?>" required />
                                                                <p class="mt-1 text-danger">(saat ini berlaku sampai <?= date("d/m/Y", strtotime($gb->ssl_expired)) ?> - tersisa <?= $gb->sisa_hari ?> hari lagi)</p>
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
