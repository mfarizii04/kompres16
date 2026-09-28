        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url("public/") ?>js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="<?= base_url("public/") ?>js/datatables/datatables-simple-demo.js"></script>
        <!-- SweetAlert 2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.0/dist/sweetalert2.all.min.js"></script>

        <!-- Popup Alert SSL Application -->
        <script type="text/javascript">

            // Swal.fire({
            //   title: "Warning!",
            //   text: "Masa berlaku lisensi SSL Aplikasi ORACLE-HELPDESK001 tinggal 90 hari lagi. Mohon untuk segera diperpanjang!",
            //   icon: "warning",
            //   draggable: true
            // });

        </script>

        <!-- Confirm Log-Out -->
        <script type="text/javascript">

            function delAction(el) {

                const idData   = el.getAttribute("data-id");
                const hrefData = el.getAttribute("data-href");
                const url      = hrefData + idData;

                Swal.fire({
                    title: "Konfirmasi",
                    text: "Apakah kamu yakin ingin menghapus data ini?",
                    icon: "question",
                    draggable: true,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data berhasil dihapus!",
                            icon: "success",
                            draggable: true
                        }).then((result) => {
                            window.location = url;
                        });
                    }
                });
            }

            // Log-Out
            function logOut() {

                Swal.fire({
                    title: "Konfirmasi",
                    text: "Apakah ingin Log-Out ?",
                    icon: "question",
                    draggable: true,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Ya, log-out!',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Log-Out berhasil!",
                            icon: "success",
                            draggable: true
                        }).then((result) => {
                            window.location = "<?= base_url("auth/admin/logout") ?>";
                        });
                    }
                });

            }

        </script>

        <?php if($this->session->flashdata("msg")){ ?>
        <!-- Flashdata -->
        <script type="text/javascript">
            Swal.fire({
                title: "Gagal!",
                text: "<?= $this->session->flashdata("msg") ?>",
                icon: "error",
                draggable: true
            });
        </script>
        <?php } elseif($this->session->flashdata("success")){ ?>
        <script type="text/javascript">
            Swal.fire({
                title: "Sukses!",
                text: "<?= $this->session->flashdata("success") ?>",
                icon: "success",
                draggable: true
            });
        </script>
        <?php } ?>

        <!-- Relations -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
        <script type="text/javascript">
            
            $(document).ready(function() {

                $("#id_server").on('change', function() {
                    var serverID = $(this).val();

                    $.ajax({
                        url: "<?= base_url('admin/aplikasi/getAllRelations') ?>",
                        method: "POST",
                        data: "id_server=" + serverID,
                        success: function(response) {
                            $("#appForm").html(response);
                        }
                    });

                });

            });

        </script>

    </body>
</html>
