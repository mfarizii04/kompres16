            
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
                                            <div class="page-header-icon"><i data-feather="server"></i></div>
                                            Server
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-info" href="<?= base_url("public/templates/server.xlsx") ?>" download>
                                            <i class="me-1" data-feather="file"></i>
                                            Download Template Excel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-fluid px-4">
                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-success" href="<?= base_url("admin/server/add") ?>">
                                    <i class="me-1" data-feather="plus"></i>
                                    Tambah Baru
                                </a>

                                &nbsp;&nbsp;

                                <a class="btn btn-dark" href="<?= base_url("admin/server/import") ?>">
                                    <i class="me-1" data-feather="upload"></i>
                                    Import Data dari Excel
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th width="25%"><center>Nama Server</center></th>
                                            <th><center>Sistem Operasi</center></th>
                                            <th><center>Database</center></th>
                                            <th><center>Alamat IP</center></th>
                                            <th><center>E-mail</center></th>
                                            <th><center>Status</center></th>
                                            <th><center>Aksi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($server->result() as $gb) :
                                            $id_os = $gb->os_id;
                                            $id_db = $gb->db_id;

                                            $sqlOS = $this->db->get_where("os", ["os_id" => $id_os])->row();
                                            $sqlDB = $this->db->get_where("db", ["db_id" => $id_db])->row();
                                        ?>

                                        <tr align="center">
                                            <td width="25%">
                                                <?php if(strlen($gb->server_name) >= 15){ echo substr($gb->server_name, 0, 15) . "..."; } else { echo $gb->server_name; } ?>
                                                <br>
                                                <a href="<?= base_url("admin/akun/showAkunServer/" . $gb->server_id) ?>" class="btn btn-warning"><i class="fas fa-user"></i>&nbsp; Daftar Akun</a>
                                            </td>
                                            <td><?php if(strlen($sqlOS->os_name) >= 10){ echo substr($sqlOS->os_name, 0, 10) . "..."; } else { echo $sqlOS->os_name; } ?></td>
                                            <td><?php if(strlen($sqlDB->db_name) >= 10){ echo substr($sqlDB->db_name, 0, 10) . "..."; } else { echo $sqlDB->db_name; } ?></td>
                                            <td><?= $gb->ip_address ?></td>
                                            <td><?php if(strlen($gb->email) >= 10){ echo substr($gb->email, 0, 10) . "..."; } else { echo $gb->email; } ?></td>
                                            <td>
                                                <?php
                                                if ($gb->status=="Active") {
                                                    echo '<span class="badge bg-success text-light">Aktif</span>';
                                                } else {
                                                    echo '<span class="badge bg-danger text-light">Nonaktif</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="<?= base_url("admin/server/detail/" . $gb->server_id) ?>"><i data-feather="search"></i></a>
                                                &nbsp;&nbsp;
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="<?= base_url("admin/server/edit/" . $gb->server_id) ?>"><i data-feather="edit"></i></a>
                                                &nbsp;&nbsp;
                                                <button type="button" class="btn btn-datatable btn-icon btn-transparent-dark btnDel" data-id="<?= $gb->server_id ?>" data-href="<?= base_url("admin/server/delete/") ?>" onclick="return delAction(this)"><i data-feather="trash-2"></i></button>
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
