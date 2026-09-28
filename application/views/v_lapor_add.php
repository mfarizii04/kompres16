            
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
                                            <div class="page-header-icon"><i data-feather="message-circle"></i></div>
                                            Buat Laporan Baru Mas Atmin
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
                                    <div class="card-header"><i class="fas fa-comment"></i>&nbsp; Silahkan isi form laporan dengan valid</div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="row">
                                                <div class="col-lg-6 mb-3">
                                                    <label class="small mb-1" for="pilihOpsi">Jenis Problem</label>
                                                    <select class="form-select" name="opsi" id="pilihOpsi" required>
                                                        <option selected disabled>--- Silahkan pilih opsi ---</option>
                                                        <option value="Server">Server</option>
                                                        <option value="Akun Server">Akun Server</option>
                                                        <option value="Sistem Operasi">Sistem Operasi</option>
                                                        <option value="Database">Database</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <span id="pilihOpsi2"></span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputNama">Subjek</label>
                                                <input class="form-control" id="inputNama" type="text" name="subjek" placeholder="Subjek laporan (Contoh: Jenis Problem_Nama Produk Problem_Keluhan / Server)" value="" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputPesan">Pesan Laporan</label>
                                                <textarea class="form-control" id="inputPesan" name="isi" cols="35" rows="7" placeholder="Pesan laporan (Contoh: Server tolong diperbaiki)" value="" required /></textarea>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label class="small mb-1" for="opsiPriority">Tingkat Prioritas</label>
                                                <select name="priority" id="opsiPriority" class="form-control">
                                                    <option selected disabled>--- Silahkan pilih tingkat prioritas ---</option>
                                                    <option value="Low">Low (Rendah)</option>
                                                    <option value="Medium">Medium (Sedang)</option>
                                                    <option value="High">High (Tinggi)</option>
                                                    <option value="Urgent">Urgent (Darurat)</option>
                                                </select>
                                            </div>
                                            <!-- Submit button-->
                                            <button class="btn btn-success" type="submit" name="simpan"><i class="fas fa-comment"></i>&nbsp; Lapor</button>
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
