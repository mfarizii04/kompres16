            
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
                                            <div class="page-header-icon"><i data-feather="upload"></i></div>
                                            Import dari Excel Kredensial Server
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
                                    <div class="card-header"><i class="fas fa-file-alt"></i>&nbsp; Silahkan upload berkas Excel Kredensial Server</div>
                                    <div class="card-body">
                                        <form enctype="multipart/form-data" method="post">
                                            <div class="mb-3">
                                                <label class="small mb-1" for="excelAplikasi">Berkas Excel Kredensial Server</label>
                                                <input class="form-control" id="excelAplikasi" type="file" name="berkas" value="" accept=".xls, .xlsx, .csv" required />
                                            </div>
                                            <!-- Submit button-->
                                            <button class="btn btn-success" type="submit" name="upload"><i class="fas fa-upload"></i>&nbsp; Upload Berkas</button>
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

