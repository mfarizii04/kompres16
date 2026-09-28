            
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
                                            Detail Laporan
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-warning" href="<?= base_url("lapor") ?>">
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
                                                <td width="20%" align="center">Tgl. Laporan</td>
                                                <td align="center"><b><?= date("d/m/Y H:i:s", strtotime($lapor->tgl)) ?></b></td>
                                            </tr>

                                            <tr>
                                                <td width="20%" align="center">Jenis Keluhan</td>
                                                <?php
                                                if ($lapor->server_id) {
                                                    $server_id  = $lapor->server_id;
                                                    $server     = $this->db->get_where("servers", ["server_id" => $server_id])->row();
                                                ?>
                                                <td align="center">Nama Server: <b><?= $server->server_name ?></b></td>
                                                <?php
                                                } elseif ($lapor->account_id) {
                                                    $acc_id     = $lapor->account_id;
                                                    $akunServer = $this->db->get_where("accounts", ["account_id" => $acc_id])->row();
                                                ?>
                                                <td align="center">Akun Server: <b><?= $akunServer->username ?></b></td>
                                                <?php
                                                } elseif ($lapor->db_id) {
                                                    $db_id      = $lapor->db_id;
                                                    $databasee  = $this->db->get_where("db", ["db_id" => $db_id])->row();
                                                ?>
                                                <td align="center">Database: <b><?= $databasee->db_name ?></b></td>
                                                <?php
                                                } elseif ($lapor->os_id) {
                                                    $os_id = $lapor->os_id;
                                                    $oes   = $this->db->get_where("os", ["os_id" => $os_id])->row();
                                                ?>
                                                <td align="center">Sistem Operasi: <b><?= $oes->os_name ?></b></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td width="20%" align="center">Subjek</td>
                                                <td align="center"><?= $lapor->subjek ?></td>
                                            </tr>

                                            <tr>
                                                <td width="20%" align="center">Isi Laporan</td>
                                                <td><?= $lapor->isi ?></td>
                                            </tr>

                                            <tr>
                                                <td width="20%" align="center">Tingkat Prioritas</td>
                                                <td align="center">
                                                <?php
                                                
                                                if ($lapor->priority=="Low") {
                                                    echo '<span class="badge bg-secondary">Low (Rendah)</span>';
                                                } elseif ($lapor->priority=="Medium") {
                                                    echo '<span class="badge bg-orange">Medium (Sedang)</span>';
                                                } elseif ($lapor->priority=="High") {
                                                    echo '<span class="badge bg-warning">High (Tinggi)</span>';
                                                } elseif ($lapor->priority=="Urgent") {
                                                    echo '<span class="badge bg-danger">Urgent (Darurat)</span>';
                                                }
                                                
                                                ?>
                                            </td>
                                            </tr>

                                            <?php if($lapor->respon) { ?>
                                            <tr>
                                                <td width="20%" align="center">Respon dari Mas Atmin</td>
                                                <td align="center"><?= $lapor->respon ?></td>
                                            </tr>
                                            <?php } ?>

                                            <tr>
                                                <td width="20%" align="center">Status Laporan</td>
                                                <td align="center">
                                                    <?php
                                                    if ($lapor->status=="Selesai") {
                                                        echo '<span class="badge bg-success text-light"><i class="fas fa-check"></i>&nbsp; Laporan selesai</span>';
                                                    } elseif ($lapor->status=="Sedang diproses") {
                                                        echo '<span class="badge bg-warning text-light"><i class="fas fa-clock"></i>&nbsp; Sedang diproses</span>';
                                                        echo '<span class="badge bg-success text-light"><i class="fas fa-eye"></i>&nbsp; Laporan selesai</span>';
                                                    } elseif ($lapor->status=="Sedang diproses") {
                                                        echo '<span class="badge bg-success text-light"><i class="fas fa-eye"></i>&nbsp; Sedang diproses</span>';
                                                    } else {
                                                        echo '<span class="badge bg-danger text-light"><i class="fas fa-times"></i>&nbsp; Belum ditanggapi</span>';
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
