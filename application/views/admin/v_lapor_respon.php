            
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
                                            Respon Laporan Mas Atmin
                                        </h1>
                                    </div>
                                    <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-warning" href="<?= base_url("admin/lapor") ?>">
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
                                    <div class="card-header"><i class="fas fa-comment"></i>&nbsp; Silahkan respon form laporan dengan valid</div>
                                    <div class="card-body">
                                        <form method="post">

                                            <?php
                                            // Get ID user
                                            $id_user = $lapor->user_id;
                                            $user    = $this->db->get_where("users", ["user_id" => $id_user])->row()->nama;

                                            // Jenis Problem
                                            if ($lapor->account_id) {
                                                $id_account = $lapor->account_id;
                                                $problem    = "Akun";
                                                $nama       = $this->db->get_where("accounts", ["account_id" => $id_account])->row()->username;
                                            } elseif ($lapor->db_id) {
                                                $id_db   = $lapor->db_id;
                                                $problem = "Database";
                                                $nama    = $this->db->get_where("db", ["db_id" => $id_db])->row()->db_name;
                                            } elseif ($lapor->os_id) {
                                                $id_os   = $lapor->os_id;
                                                $problem = "Sistem Operasi";
                                                $nama    = $this->db->get_where("os", ["os_id" => $id_os])->row()->os_name;
                                            } elseif ($lapor->server_id) {
                                                $id_server = $lapor->server_id;
                                                $problem   = "Server";
                                                $nama      = $this->db->get_where("servers", ["server_id" => $id_server])->row()->server_name;
                                            }

                                            ?>

                                            <div class="mb-3">
                                                <label class="small mb-1" for="jenisProblem">Jenis Problem</label>
                                                <input class="form-control" nama="jenis" id="jenisProblem" type="text" value="<?= $problem . ": " . $nama ?>" disabled />
                                            </div>

                                            <div class="mb-3">
                                                <label class="small mb-1" for="laporanDari">Laporan dari</label>
                                                <input class="form-control" nama="pelapor" id="laporanDari" type="text" value="<?= $user ?>" disabled />
                                            </div>

                                            <div class="mb-3">
                                                <label class="small mb-1" for="subjek">Subjek</label>
                                                <input class="form-control" nama="subjek" id="subjek" type="text" value="<?= $lapor->subjek ?>" disabled />
                                            </div>

                                            <div class="mb-3">
                                                <label class="small mb-1" for="isi">Isi Laporan</label>
                                                <textarea class="form-control" nama="isi" id="isi" cols="35" rows="7" disabled /><?= $lapor->isi ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputRespon">Respon</label>
                                                <div class="mt-1 mb-2">
                                                    <button type="button" id="responAI" class="btn btn-outline-primary">Respon Laporan dengan AI</button>
                                                    <span id="ai-loading" class="spinner-border spinner-border-sm text-primary ms-2 d-none" role="status"></span>
                                                    <small id="ai-status" class="text-muted ms-1 d-none fst-italic">Sedang memproses respons laporan...</small>
                                                </div>
                                                <textarea style="padding: 12 15px; box-sizing: border-box;" class="form-control" id="inputRespon" name="respon" cols="35" rows="7" placeholder="Respon laporan (Contoh: Baik, terimakasih atas laporannya. Mas Atmin akan lakukan perbaikan secepatnya yaa)" required /><?php if($lapor->respon){ echo $lapor->respon; } ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputStatus">Status Respon</label>
                                                <select class="form-control" id="inputStatus" name="status" required />
                                                    <option <?php if($lapor->status=="Belum dibaca"){ echo "selected"; } ?> disabled>--- Silahkan pilih ---</option>
                                                    <option <?php if($lapor->status=="Selesai"){ echo "selected"; } ?> value="Selesai">Selesai</option>
                                                    <option <?php if($lapor->status=="Sedang diproses"){ echo "selected"; } ?> value="Sedang diproses">Sedang diproses</option>
                                                </select>
                                            </div>

                                            <!-- Submit button-->
                                            <button class="btn btn-success" type="submit" name="simpan"><i class="fas fa-paper-plane"></i>&nbsp; Respon Laporan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- Respons laporan -->
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const btnAi          = document.getElementById('responAI');
                        const loader         = document.getElementById('ai-loading');
                        const statusText     = document.getElementById('ai-status');
                        const textareaRespon = document.getElementById('inputRespon');

                        btnAi.addEventListener('click', async function () {
                            const problem = document.getElementById('jenisProblem')?.value || '';
                            const subjek = document.getElementById('subjek')?.value || '';
                            const isi = document.getElementById('isi')?.value || '';

                            if (!isi.trim()) {
                                alert('Isi laporan kosong, tidak ada data untuk dianalisis.');
                                return;
                            }

                            const promptText = `Kamu adalah Mas Atmin, teknisi IT Support infrastruktur server yang ramah dan solutif. ` +
                                `Terdapat tiket kendala dengan Jenis Problem: "${problem}", Subjek: "${subjek}", dan Isi Laporan: "${isi}". ` +
                                `Tuliskan draf tanggapan helpdesk yang sopan, sebutkan langkah awal perbaikan teknis yang akan dilakukan tim secara ringkas, padat, dan jelas menggunakan diksi dan struktur kalimat yang manusiawi, alami dan mengalir supaya gak puitis (dreamy dan tidak robotik) (maksimal 2-3 kalimat).`;

                            // Siapkan form data untuk Controller Ai.php
                            const formData = new FormData();
                            formData.append('prompt', promptText);

                            // UI Feedback: Loading state
                            btnAi.disabled = true;
                            loader.classList.remove('d-none');
                            statusText.classList.remove('d-none');

                            try {
                                const response = await fetch('<?= base_url("admin/ai/generateAjax"); ?>', {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                });

                                const data = await response.json();

                                if (response.ok && data.status) {
                                    // Masukkan hasil AI langsung ke textarea Respon
                                    textareaRespon.value = data.reply.trim();
                                    textareaRespon.focus();
                                } else {
                                    alert('Gagal mendapatkan balasan AI: ' + (data.message || 'Error pada server Groq'));
                                }
                            } catch (error) {
                                alert('Terjadi kesalahan jaringan/server: ' + error.message);
                            } finally {
                                // Kembalikan status tombol
                                btnAi.disabled = false;
                                loader.classList.add('d-none');
                                statusText.classList.add('d-none');
                            }
                        });
                    });
                </script>

                <!-- FOOTER!! -->
                <?php require "_parts/footer.php"; ?>

            </div>
        </div>
