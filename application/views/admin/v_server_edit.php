            
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
                                            <div class="page-header-icon"><i data-feather="edit"></i></div>
                                            Edit Server
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-warning" href="<?= base_url("admin/server") ?>">
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
                                    <div class="card-header"><i class="fas fa-edit"></i>&nbsp; Silahkan perbarui form data dengan lengkap</div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputNama">Nama Server</label>
                                                <input class="form-control" id="inputNama" type="text" name="nama" placeholder="Nama Server (Contoh: Server PT. ESEMKA)" value="<?= $server->server_name ?>" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1">Sistem Operasi</label>
                                                <select class="form-select" name="id_os" aria-label="Default select example">
                                                    <option disabled>--- Silahkan pilih sistem operasi ---</option>
                                                    <?php
                                                    $sqlOS = $this->db->order_by("os_name", "ASC")->get_where("os", ["status" => "Active"]);
                                                    foreach ($sqlOS->result() as $gbOS) :
                                                    ?>
                                                    <option <?php if($gbOS->os_id == $server->os_id){ echo "selected"; } ?> value="<?= $gbOS->os_id ?>"><?= $gbOS->os_name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1">Jenis Database</label>
                                                <select class="form-select" name="id_db" aria-label="Default select example">
                                                    <option selected disabled>--- Silahkan pilih jenis database ---</option>
                                                    <?php
                                                    $sqlDB = $this->db->order_by("db_name", "ASC")->get_where("db", ["status" => "Active"]);
                                                    foreach ($sqlDB->result() as $gbDB) :
                                                    ?>
                                                    <option <?php if($gbDB->db_id == $server->db_id){ echo "selected"; } ?> value="<?= $gbDB->db_id ?>"><?= $gbDB->db_name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputIP">Alamat IP</label>
                                                <input class="form-control" id="inputIP" type="text" name="ip" placeholder="Alamat IP (Contoh: 127.0.0.1)" value="<?= $server->ip_address ?>" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputLokasi">Lokasi Server</label>
                                                <input class="form-control" id="inputLokasi" type="text" name="lokasi" placeholder="Lokasi fisik server (Contoh: Gedung J905 Server Pusat)" value="<?= $server->location ?>" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputEmail">E-mail</label>
                                                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="E-mail server (Contoh: server@email.com)" value="<?= $server->email ?>" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1">Status</label>
                                                <select class="form-select" name="status" aria-label="Default select example">
                                                    <option disabled>--- Silahkan pilih status akun ---</option>
                                                    <option <?php if($server->status=="Active"){ echo "selected"; } ?> value="Active">Aktif</option>
                                                    <option <?php if($server->status=="Nonactive"){ echo "selected"; } ?> value="Nonactive">Nonaktif</option>
                                                </select>
                                            </div>
                                            <!-- Submit button-->
                                            <button class="btn btn-success" type="submit" name="ubah"><i class="fas fa-edit"></i>&nbsp; Simpan Perubahan</button>
                                        </form>
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
