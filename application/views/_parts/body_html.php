        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('public/') ?>js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="<?= base_url("public/") ?>js/datatables/datatables-simple-demo.js"></script>
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <!-- Tampilkan opsi -->
        <script type="text/javascript">
            
            $(document).ready(function() {

                $("#pilihOpsi").change(function() {

                    var opsi = $(this).val();
                    $.ajax({
                        url: "<?= base_url("lapor/tampilkanOpsi") ?>",
                        method: "POST",
                        data: "opsi=" + opsi,
                        success: function(data) {
                            $("#pilihOpsi2").html(data);
                        }
                    })

                });

            });

        </script>

        <!-- SweetAlert 2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.0/dist/sweetalert2.all.min.js"></script>
        <script type="text/javascript">
        	function logOut() {
        		Swal.fire({
        			title: "Konfirmasi",
        			text: "Kamu yakin ingin Log-Out ?",
        			icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Ya, log-out!',
                    cancelButtonText: 'Batal',
                    draggable: true
        		}).then((result) => {
        			if (result.isConfirmed) {
        				Swal.fire({
        					title: "Sukses",
        					text: "Log-Out berhasil!",
        					icon: "success"
        				}).then((result) => {
        					window.location = "<?= base_url("auth/logout") ?>";
        				});
        			}
        		});
        	}
        </script>

        <!-- ... -->
        <?php if($this->session->flashdata("msg")){ ?>
        <script type="text/javascript">
            Swal.fire({
                title: "Gagal",
                text: "<?= $this->session->flashdata("msg") ?>",
                icon: "error",
                draggable: true
            });
        </script>
        <?php } elseif($this->session->flashdata("success")){ ?>
        <script type="text/javascript">
            Swal.fire({
                title: "Sukses",
                text: "<?= $this->session->flashdata("success") ?>",
                icon: "success",
                draggable: true
            });
        </script>
        <?php } ?>
        
    </body>
</html>
