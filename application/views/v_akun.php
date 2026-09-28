            
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
                                            Kredensial Server
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
                                            <th><center>Username</center></th>
                                            <th><center>Role</center></th>
                                            <th><center>Expired</center></th>
                                            <th><center>Nama Server</center></th>
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
                                            <td><?= date("d/m/Y", strtotime($gb->expired_at)) ?></td>
                                            <td><?php if(strlen($sqlServer->server_name) >= 20){ echo substr($sqlServer->server_name, 0, 20) . "..."; } else { echo $sqlServer->server_name; } ?></td>
                                            <td>
                                                <?php
                                                date_default_timezone_set("Asia/Jakarta");
                                                $tgl        = date("Y-m-d");
                                                $expired_at = $gb->expired_at;

                                                if ($tgl < $expired_at) {
                                                    echo '<span class="badge bg-success text-light"><i class="fas fa-eye"></i>&nbsp; Aktif</span>';
                                                } else {
                                                    echo '<span class="badge bg-danger text-light"><i class="fas fa-times"></i>&nbsp; Nonaktif</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="<?= base_url("akun/detail/" . $gb->account_id) ?>"><i data-feather="search"></i></a>
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
