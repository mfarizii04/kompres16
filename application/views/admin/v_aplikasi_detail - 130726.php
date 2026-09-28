            
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
                                            Detail Aplikasi
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-warning" href="<?= base_url("admin/aplikasi") ?>">
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
                                                <td align="center">Tgl. Entri</td>
                                                <td align="center"><b><?= date("d/m/Y H:i:s", strtotime($app->created_at)) ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Nama Aplikasi</td>
                                                <td align="center"><b><?= $app->nama ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">ID Key</td>
                                                <td align="center"><b><?= $app->id_key ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Password</td>
                                                <td align="center"><b><?= $app->password ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Alamat URL</td>
                                                <td align="center"><b><?= $app->url ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">IP Aplikasi</td>
                                                <td align="center"><b><?= $app->ip ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">SSL Berlaku sampai</td>
                                                <td align="center">
                                                    <b>
                                                        <?php
                                                        $selisih = $app->sisa_hari;

                                                        if ($selisih <= 90) {
                                                            echo '<a href="" title="Perpanjang SSL Aplikasi ' . $app->nama . '" style="color: #69707a">';
                                                        }

                                                        echo date("d/m/Y", strtotime($app->ssl_expired));

                                                        if ($selisih < 0) {
                                                            echo '<span class="text-danger"> (Sudah expired)</span>';
                                                        } else {
                                                            if ($selisih < 1) { $clr="danger font-weight-bold"; } elseif ($selisih <= 30) { $clr="danger"; } elseif ($selisih <= 90) { $clr="warning"; } else { $clr="secondary"; }
                                                            echo '<span class="text-' . $clr . '"> (Sisa ' . $app->sisa_hari . ' hari lagi)</span>';
                                                        }

                                                        echo '</a>';
                                                        ?>
                                                    </b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">Server Aplikasi</td>
                                                <td align="center"><b><?= $app->server_name ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Kredensial Server Aplikasi</td>
                                                <td align="center"><b><?= $app->username ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Sistem Operasi</td>
                                                <td align="center"><b><?= $app->os_name ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Jenis Database</td>
                                                <td align="center"><b><?= $app->db_name ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Status</td>
                                                <td align="center">
                                                    <?php
                                                    if ($app->status=="Aktif") {
                                                        echo '<span class="badge bg-success text-light"><i class="fas fa-eye"></i>&nbsp; Aktif</span>';
                                                    } else {
                                                        echo '<span class="badge bg-danger text-light"><i class="fas fa-times"></i>&nbsp; Nonaktif</span>';
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
