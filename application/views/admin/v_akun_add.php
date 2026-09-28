            
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
                                            <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                                            Tambah Kredensial Server
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-warning" href="<?= base_url("admin/akun") ?>">
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
                                    <div class="card-header"><i class="fas fa-edit"></i>&nbsp; Silahkan isi form profil akun server dengan valid</div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputNama">Nama Server</label>
                                                <?php
                                                $cekIDServer = $this->db->get_where("servers", ["server_id" => $this->uri->segment(4)])->num_rows();
                                                ?>
                                                <select class="form-select" name="id_server" aria-label="Default select example">
                                                    <option <?php if((!$this->uri->segment(4) || ($cekIDServer == 0))){ echo "selected"; } ?> disabled>--- Silahkan pilih server ---</option>
                                                    <?php
                                                    $sqlServer = $this->db->order_by("server_name", "ASC")->get_where("servers", ["status" => "Active"]);
                                                    foreach ($sqlServer->result() as $gbServer) :
                                                    ?>
                                                    <option <?php if($this->uri->segment(4) == $gbServer->server_id){ echo "selected"; } else { echo ""; } ?> value="<?= $gbServer->server_id ?>"><?= $gbServer->server_name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputUser">Username</label>
                                                <input class="form-control" id="inputUser" type="text" name="user" placeholder="Username akun server (Contoh: admin@server)" value="" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputPwd">Password</label>
                                                <input class="form-control" id="inputPwd" type="password" name="pwd" placeholder="Password akun server (Contoh: test*123#)" value="" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputExpired">Akun berakhir hingga</label>
                                                <?php
                                                date_default_timezone_set("Asia/Jakarta");
                                                $tgl = date("Y-m-d", strtotime("+1 day"));
                                                ?>
                                                <input class="form-control" id="inputExpired" type="date" name="tgl_expired" min="<?= $tgl ?>" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1">Role</label>
                                                <select class="form-select" name="role" aria-label="Default select example">
                                                    <option selected disabled>--- Silahkan pilih role akun ---</option>
                                                    <option value="Admin">Administrator</option>
                                                    <option value="Dev">Developer</option>
                                                    <option value="Readonly">Read-only</option>
                                                </select>
                                            </div>
                                            <!-- Submit button-->
                                            <button class="btn btn-success" type="submit" name="simpan"><i class="fas fa-user-plus"></i>&nbsp; Tambah Akun</button>
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
