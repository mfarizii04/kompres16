            
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
                                            Edit Akun
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-warning" href="<?= base_url("admin/users") ?>">
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
                                    <div class="card-header"><i class="fas fa-edit"></i>&nbsp; Silahkan perbarui form akun dengan lengkap</div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputUser">Username</label>
                                                <input class="form-control" id="inputUser" type="text" name="user" placeholder="Username" value="<?= $akun->username ?>" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputPwd">Password</label>
                                                <input class="form-control" id="inputPwd" type="password" name="pwd" placeholder="Password" value="<?= $akun->password ?>" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputNama">Nama Lengkap</label>
                                                <input class="form-control" id="inputNama" type="text" name="nama" placeholder="Nama Lengkap" value="<?= $akun->nama ?>" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputEmail">E-mail</label>
                                                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="E-mail" value="<?= $akun->email ?>" required />
                                            </div>
                                            <?php if($this->uri->segment(4) != 1) { ?>
                                            <div class="mb-3">
                                                <label class="small mb-1">Role</label>
                                                <select class="form-select" name="role" aria-label="Default select example">
                                                    <option disabled>--- Silahkan pilih role ---</option>
                                                    <option <?php if($akun->role=="Admin"){ echo "selected"; } ?> value="Admin">Administrator</option>
                                                    <option <?php if($akun->role=="Viewer"){ echo "selected"; } ?> value="Viewer">Staff</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1">Status</label>
                                                <select class="form-select" name="status" aria-label="Default select example">
                                                    <option disabled>--- Silahkan pilih status akun ---</option>
                                                    <option <?php if($akun->status=="Active"){ echo "selected"; } ?> value="Active">Aktif</option>
                                                    <option <?php if($akun->status=="Nonactive"){ echo "selected"; } ?> value="Nonactive">Nonaktif</option>
                                                </select>
                                            </div>
                                            <?php } ?>
                                            <!-- Submit button-->
                                            <button class="btn btn-success" type="submit" name="ubah"><i class="fas fa-user-edit"></i>&nbsp; Perbarui Akun</button>
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
