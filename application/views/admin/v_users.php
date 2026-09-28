            
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
                                            Akun
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-info" href="<?= base_url("public/templates/akun.xlsx") ?>" download>
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
                                <a class="btn btn-success" href="<?= base_url("admin/users/add") ?>">
                                    <i class="me-1" data-feather="user-plus"></i>
                                    Tambah baru
                                </a>

                                &nbsp;&nbsp;

                                <a class="btn btn-dark" href="<?= base_url("admin/users/import") ?>">
                                    <i class="me-1" data-feather="upload"></i>
                                    Import Data dari Excel
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th><center>Username</center></th>
                                            <th><center>Nama Lengkap</center></th>
                                            <th><center>E-mail</center></th>
                                            <th><center>Role</center></th>
                                            <th><center>Status</center></th>
                                            <th><center>Aksi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($users->result() as $gb) :
                                        ?>

                                        <tr align="center">
                                            <td><?php if(strlen($gb->username) >= 30){ echo substr($gb->username, 0, 30) . "..."; } else { echo $gb->username; } ?></td>
                                            <td><?php if(strlen($gb->nama) >= 30){ echo substr($gb->nama, 0, 30) . "..."; } else { echo $gb->nama; } ?></td>
                                            <td><?php if(strlen($gb->email) >= 30){ echo substr($gb->email, 0, 30) . "..."; } else { echo $gb->email; } ?></td>
                                            <td><?php if($gb->role=="Admin"){ echo '<i class="fas fa-user-tie"></i>&nbsp; ' . $gb->role; } else { echo '<i class="fas fa-user"></i>&nbsp; Staff'; } ?></td>
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
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="<?= base_url("admin/users/detail/" . $gb->user_id) ?>"><i data-feather="search"></i></a>
                                                &nbsp;&nbsp;
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="<?= base_url("admin/users/edit/" . $gb->user_id) ?>"><i data-feather="edit"></i></a>
                                                <?php if($gb->user_id != 1){ ?>
                                                &nbsp;&nbsp;
                                                <button type="button" class="btn btn-datatable btn-icon btn-transparent-dark btnDel" data-id="<?= $gb->user_id ?>" data-href="<?= base_url("admin/users/delete/") ?>" onclick="return delAction(this)"><i data-feather="trash-2"></i></button>
                                                <?php } ?>
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
