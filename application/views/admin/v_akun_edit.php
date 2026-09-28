            
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
                                            Edit Kredensial Server
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
                                    <div class="card-header"><i class="fas fa-edit"></i>&nbsp; Silahkan perbarui form profil akun server dengan lengkap</div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputNama">Nama Server</label>
                                                <select class="form-select" name="id_server" aria-label="Default select example">
                                                    <option disabled>--- Silahkan pilih server ---</option>
                                                    <?php
                                                    $sqlServer = $this->db->order_by("server_name", "ASC")->get_where("servers", ["status" => "Active"]);
                                                    foreach ($sqlServer->result() as $gbServer) :
                                                    ?>
                                                    <option <?php if($akun->server_id == $gbServer->server_id){ echo "selected"; } ?> value="<?= $gbServer->server_id ?>"><?= $gbServer->server_name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputUser">Username</label>
                                                <input class="form-control" id="inputUser" type="text" name="user" placeholder="Username akun server (Contoh: admin@server)" value="<?= $akun->username ?>" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputPwd">Password</label>
                                                <input class="form-control" id="inputPwd" type="password" name="pwd" placeholder="Password akun server (Contoh: test*123#)" value="<?= $akun->password ?>" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputExpired">Akun berakhir hingga</label>
                                                <input class="form-control" id="inputExpired" type="date" name="tgl_expired" min="<?= $akun->expired_at ?>" value="<?= $akun->expired_at ?>" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1">Role</label>
                                                <select class="form-select" name="role" aria-label="Default select example">
                                                    <option disabled>--- Silahkan pilih role akun ---</option>
                                                    <option <?php if($akun->role=="Admin"){ echo "selected"; } ?> value="Admin">Administrator</option>
                                                    <option <?php if($akun->role=="Dev"){ echo "selected"; } ?> value="Dev">Developer</option>
                                                    <option <?php if($akun->role=="Readonly"){ echo "selected"; } ?> value="Readonly">Read-only</option>
                                                </select>
                                            </div>
                                            <!-- Submit button-->
                                            <button class="btn btn-success" type="submit" name="ubah"><i class="fas fa-user-edit"></i>&nbsp; Simpan Perubahan</button>
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
