            
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
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-info" href="<?= base_url("public/templates/aplikasi.xlsx") ?>" download>
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
                                <a class="btn btn-success" href="<?= base_url("admin/aplikasi/add") ?>">
                                    <i class="me-1" data-feather="plus"></i>
                                    Tambah Baru
                                </a>

                                &nbsp;&nbsp;

                                <a class="btn btn-dark" href="<?= base_url("admin/aplikasi/import") ?>">
                                    <i class="me-1" data-feather="upload"></i>
                                    Import Data dari Excel
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th width="25%"><center>Nama Aplikasi</center></th>
                                            <th><center>Alamat IP</center></th>
                                            <th><center>Server</center></th>
                                            <th><center>Sistem Operasi</center></th>
                                            <th><center>Database</center></th>
                                            <th><center>Owner</center></th>
                                            <th><center>Aksi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($aplikasi->result() as $gb) :
                                        ?>

                                        <tr align="center">
                                            <td width="25%">
                                                <?php if(strlen($gb->nama) >= 7){ echo substr($gb->nama, 0, 7) . "..."; } else { echo $gb->nama; } ?>
                                            </td>
                                            <td><?= $gb->ip ?></td>
                                            <td><?php if(strlen($gb->server_name) >= 7){ echo substr($gb->server_name, 0, 7) . "..."; } else { echo $gb->server_name; } ?></td>
                                            <td><?php if(strlen($gb->db_name) >= 7){ echo substr($gb->db_name, 0, 7) . "..."; } else { echo $gb->db_name; } ?></td>
                                            <td><?php if(strlen($gb->os_name) >= 7){ echo substr($gb->os_name, 0, 7) . "..."; } else { echo $gb->os_name; } ?></td>
                                            <td><?php if(strlen($gb->username) >= 7){ echo substr($gb->username, 0, 7) . "..."; } else { echo $gb->username; } ?></td>
                                            <td>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="<?= base_url("admin/aplikasi/detail/" . $gb->aplikasi_id) ?>"><i data-feather="search"></i></a>
                                                &nbsp;&nbsp;
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="<?= base_url("admin/aplikasi/edit/" . $gb->aplikasi_id) ?>"><i data-feather="edit"></i></a>
                                                &nbsp;&nbsp;
                                                <button type="button" class="btn btn-datatable btn-icon btn-transparent-dark btnDel" data-id="<?= $gb->aplikasi_id ?>" data-href="<?= base_url("admin/aplikasi/delete/") ?>" onclick="return delAction(this)"><i data-feather="trash-2"></i></button>
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
