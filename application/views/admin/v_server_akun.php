            
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
                                            <div class="page-header-icon"><i data-feather="user"></i></div>
                                            <?php
                                            $id_server = $akun->row()->server_id;
                                            $sqlServer = $this->db->get_where("servers", ["server_id" => $id_server])->row();
                                            ?>
                                            Daftar Kredensial Server (<?= $sqlServer->server_name ?>)
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-success" href="<?= base_url("admin/akun/add/" . $id_server) ?>">
                                            <i class="me-1" data-feather="plus"></i>
                                            Tambah Akun baru
                                        </a>
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
                                            <th><center>Username</center></th>
                                            <th><center>Role</center></th>
                                            <th><center>Status</center></th>
                                            <th><center>Aksi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($akun->result() as $gb) :
                                            $id_server = $gb->server_id;

                                            $sqlServer = $this->db->get_where("servers", ["server_id" => $id_server])->row();
                                        ?>

                                        <tr align="center">
                                            <td><?php if(strlen($gb->username) >= 20){ echo substr($gb->username, 0, 20) . "..."; } else { echo $gb->username; } ?></td>
                                            <td><?php if($gb->role=="Admin") { echo '<i class="fas fa-user-tie"></i>&nbsp; Admin'; } elseif($gb->role=="Dev"){ echo '<i class="fas fa-code"></i>&nbsp; Developer'; } else { echo '<i class="fas fa-eye"></i>&nbsp; Read-Only'; } ?></td>
                                            <td>
                                                <?php
                                                date_default_timezone_set("Asia/Jakarta");
                                                $tgl        = date("Y-m-d");
                                                $expired_at = $gb->expired_at;

                                                if ($tgl < $expired_at) {
                                                    echo '<span class="badge bg-success text-light">Aktif</span>';
                                                } else {
                                                    echo '<span class="badge bg-danger text-light">Nonaktif</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="<?= base_url("admin/akun/detail/" . $gb->account_id) ?>"><i data-feather="search"></i></a>
                                                &nbsp;&nbsp;
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="<?= base_url("admin/akun/edit/" . $gb->account_id) ?>"><i data-feather="edit"></i></a>
                                                &nbsp;&nbsp;
                                                <button type="button" class="btn btn-datatable btn-icon btn-transparent-dark btnDel" data-id="<?= $gb->account_id ?>" data-href="<?= base_url("admin/akun/delete/") ?>" onclick="return delAction(this)"><i data-feather="trash-2"></i></button>
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
