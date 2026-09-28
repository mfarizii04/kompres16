            
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
                                            Detail Server
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-warning" href="<?= base_url("server") ?>">
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

                                        <?php
                                        $id_os = $server->os_id;
                                        $id_db = $server->db_id;

                                        $sqlOS = $this->db->get_where("os", ["os_id" => $id_os])->row();
                                        $sqlDB = $this->db->get_where("db", ["db_id" => $id_db])->row();

                                        ?>

                                        <table class="table table-responsive">
                                            <tr>
                                                <td align="center">Tgl. Entri</td>
                                                <td align="center"><b><?= date("d/m/Y H:i:s", strtotime($server->created_at)) ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Nama Server</td>
                                                <td align="center"><b><?= $server->server_name ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Sistem Operasi</td>
                                                <td align="center"><b><?= $sqlOS->os_name ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Jenis Database</td>
                                                <td align="center"><b><?= $sqlDB->db_name ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Alamat IP</td>
                                                <td align="center"><b><?= $server->ip_address ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Lokasi</td>
                                                <td align="center"><b><?= $server->location ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">E-mail Server</td>
                                                <td align="center"><b><?= $server->email ?></b></td>
                                            </tr>
                                            <tr>
                                                <td align="center">Status</td>
                                                <td align="center">
                                                    <?php
                                                    if ($server->status=="Active") {
                                                        echo '<span class="badge bg-success text-light"><i class="fas fa-eye"></i>&nbsp; Aktif</span>';
                                                    } else {
                                                        echo '<span class="badge bg-danger text-light"><i class="fas fa-times"></i>&nbsp; Nonaktif</span>';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">Daftar Akun Server</td>
                                                <td>
                                                    <?php
                                                    $id_server = $server->server_id;
                                                    $akun      = $this->db->get_where("accounts", ["server_id" => $id_server]);
                                                    
                                                    foreach ($akun->result() as $gbAkun) :
                                                        echo '<ul>'.
                                                            '<li><a target="_blank" href="' . base_url("akun/detail/" . $gbAkun->account_id) . '">' . $gbAkun->username . ' (' . $gbAkun->role . ')</a></li>'.
                                                        '</ul>';
                                                    endforeach;
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
