            
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
                                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                                            Sistem Operasi
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-info" href="<?= base_url("public/templates/os.xlsx") ?>" download>
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
                                <a class="btn btn-success" href="<?= base_url("admin/os/add") ?>">
                                    <i class="me-1" data-feather="plus"></i>
                                    Tambah Baru
                                </a>

                                &nbsp;&nbsp;

                                <a class="btn btn-dark" href="<?= base_url("admin/os/import") ?>">
                                    <i class="me-1" data-feather="upload"></i>
                                    Import Data dari Excel
                                </a>

                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th><center>Sistem Operasi</center></th>
                                            <th><center>Status</center></th>
                                            <th><center>Aksi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($os->result() as $gb) :
                                        ?>

                                        <tr align="center">
                                            <td><?= $gb->os_name ?></td>
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
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="<?= base_url("admin/os/detail/" . $gb->os_id) ?>"><i data-feather="search"></i></a>
                                                &nbsp;&nbsp;
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="<?= base_url("admin/os/edit/" . $gb->os_id) ?>"><i data-feather="edit"></i></a>
                                                &nbsp;&nbsp;
                                                <button type="button" class="btn btn-datatable btn-icon btn-transparent-dark btnDel" data-id="<?= $gb->os_id ?>" data-href="<?= base_url("admin/os/delete/") ?>" onclick="return delAction(this)"><i data-feather="trash-2"></i></button>
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
