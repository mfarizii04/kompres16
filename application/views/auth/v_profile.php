        
        <!-- NAVBAR!! -->
        <?php $this->load->view("_parts/navbar.php"); ?>

        <div id="layoutSidenav">
            
            <!-- SIDEBAR!! -->
            <?php $this->load->view("_parts/sidebar.php"); ?>

            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="user"></i></div>
                                            Profile
                                        </h1>
                                        <div class="page-header-subtitle">Detail profil akunmu!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-n10">
                        <!-- Wizard card example with navigation-->
                        <div class="card">
                            <div class="card-header border-bottom">
                                <!-- Wizard navigation-->
                                <div class="nav nav-pills nav-justified flex-column flex-xl-row nav-wizard" id="cardTab" role="tablist">
                                    <!-- Wizard navigation item 1-->
                                    <a class="nav-item nav-link active" id="wizard1-tab" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                                        <div class="wizard-step-icon"><i class="fas fa-info-circle"></i></div>
                                        <div class="wizard-step-text">
                                            <div class="wizard-step-text-name">Profil Akun</div>
                                            <div class="wizard-step-text-details">Informasi mengenai profil dan identitas akunmu</div>
                                        </div>
                                    </a>
                                    <!-- Wizard navigation item 2-->
                                    <a class="nav-item nav-link" id="wizard2-tab" href="#wizard2" data-bs-toggle="tab" role="tab" aria-controls="wizard2" aria-selected="true">
                                        <div class="wizard-step-icon"><i class="fas fa-edit"></i></div>
                                        <div class="wizard-step-text">
                                            <div class="wizard-step-text-name">Edit Akun</div>
                                            <div class="wizard-step-text-details">Mengubah profil dan identitas akunmu</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="cardTabContent">
                                    <!-- Wizard tab pane item 1-->
                                    <div class="tab-pane py-5 py-xl-10 fade show active" id="wizard1" role="tabpanel" aria-labelledby="wizard1-tab">
                                        <div class="row justify-content-center">
                                            <div class="col-xxl-6 col-xl-8">
                                                <h3 class="text-primary"><i class="fas fa-info-circle"></i>&nbsp; Profil Akun</h3>
                                                <h5 class="card-title mb-4">Informasi mengenai profil dan identitas akunmu</h5>
                                                <table class="table table-responsive">
                                                    <tr align="center">
                                                        <td>Tgl. Bergabung</td>
                                                        <td><b><?= date("d/m/Y H:i:s", strtotime($akun->created_at)) ?></b></td>
                                                    </tr>
                                                    <tr align="center">
                                                        <td>Username</td>
                                                        <td><b><?= $akun->username ?></b></td>
                                                    </tr>
                                                    <tr align="center">
                                                        <td>Password</td>
                                                        <td><b><?= $akun->password ?></b></td>
                                                    </tr>
                                                    <tr align="center">
                                                        <td>Nama Lengkap</td>
                                                        <td><b><?= $akun->nama ?></b></td>
                                                    </tr>
                                                    <tr align="center">
                                                        <td>E-mail</td>
                                                        <td><b><?= $akun->email ?></b></td>
                                                    </tr>
                                                    <tr align="center">
                                                        <td>Role</td>
                                                        <td>
                                                            <b>
                                                            <?php
                                                            if($akun->role=="Admin"){ echo '<i class="fas fa-user-tie"></i>&nbsp; ' . $akun->role; } else { echo '<i class="fas fa-user"></i>&nbsp; ' . $akun->role;
                                                            }
                                                            ?>
                                                            </b>
                                                        </td>
                                                    </tr>
                                                    <tr align="center">
                                                        <td>Status</td>
                                                        <td><b>
                                                            <?php
                                                            if ($akun->status=="Active") {
                                                                echo '<span class="badge bg-success text-light"><i class="fas fa-eye"></i>&nbsp; Aktif</span>';
                                                            } else {
                                                                echo '<span class="badge bg-danger text-light"><i class="fas fa-times"></i>&nbsp; Nonaktif</span>';
                                                            }
                                                            ?>
                                                        </b></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Wizard tab pane item 2-->
                                    <div class="tab-pane py-5 py-xl-10 fade" id="wizard2" role="tabpanel" aria-labelledby="wizard2-tab">
                                        <div class="row justify-content-center">
                                            <div class="col-xxl-6 col-xl-8">
                                                <h3 class="text-primary"><i class="fas fa-user-edit"></i>&nbsp; Edit Akun</h3>
                                                <h5 class="card-title mb-4">Mengubah profil dan identitas akunmu</h5>
                                                <form method="post">
                                                    <div class="mb-3">
                                                        <label class="small mb-1" for="inputUser">Username</label>
                                                        <input class="form-control" id="inputUser" type="text" name="user" placeholder="Username" value="<?= $akun->username ?>" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="small mb-1" for="inputPwd">Password</label>
                                                        <input class="form-control" id="inputPwd" type="password" name="pwd" placeholder="Username" value="<?= $akun->password ?>" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="small mb-1" for="inputNama">Nama Lengkap</label>
                                                        <input class="form-control" id="inputNama" type="text" name="nama" placeholder="Nama Lengkap" value="<?= $akun->nama ?>" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="small mb-1" for="inputEmail">E-mail</label>
                                                        <input class="form-control" id="inputEmail" type="email" name="email" placeholder="E-mail" value="<?= $akun->email ?>" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" name="ubah" class="btn btn-warning"><i class="fas fa-user-edit"></i>&nbsp; Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- FOOTER!! -->
                <?php $this->load->view("_parts/footer.php"); ?>

            </div>
        </div>