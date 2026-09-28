            
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
                                            Lapor Mas Atmin
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-success" href="<?= base_url("lapor/add") ?>">
                                            <i class="me-1" data-feather="message-circle"></i>
                                            Lapor Mas Atmin
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
                                            <th><center>Tgl. Laporan</center></th>
                                            <th><center>Subjek</center></th>
                                            <th><center>Prioritas</center></th>
                                            <th><center>Status</center></th>
                                            <th><center>Aksi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($lapor->result() as $gb) :
                                        ?>

                                        <tr align="center">
                                            <td><?= date("d/m/Y H:i:s", strtotime($gb->tgl)) ?></td>
                                            <td><?php if(strlen($gb->subjek) >= 35){ echo substr($gb->subjek, 0, 35) . "..."; } else { echo $gb->subjek; } ?></td>
                                            <td>
                                                <?php
                                                
                                                if ($gb->priority=="Low") {
                                                    echo '<span class="badge bg-secondary">Low (Rendah)</span>';
                                                } elseif ($gb->priority=="Medium") {
                                                    echo '<span class="badge bg-orange">Medium (Sedang)</span>';
                                                } elseif ($gb->priority=="High") {
                                                    echo '<span class="badge bg-warning">High (Tinggi)</span>';
                                                } elseif ($gb->priority=="Urgent") {
                                                    echo '<span class="badge bg-danger">Urgent (Darurat)</span>';
                                                }
                                                
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($gb->status=="Selesai") {
                                                    echo '<span class="badge bg-success text-light"><i class="fas fa-check"></i>&nbsp; Selesai</span>';
                                                } elseif ($gb->status=="Sedang diproses") {
                                                    echo '<span class="badge bg-warning text-light"><i class="fas fa-times"></i>&nbsp; Sedang diproses</span>';
                                                }
                                                 else {
                                                    echo '<span class="badge bg-danger text-light"><i class="fas fa-times"></i>&nbsp; Belum ditanggapi</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="<?= base_url("lapor/detail/" . $gb->lapor_id) ?>"><i data-feather="search"></i></a>
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
