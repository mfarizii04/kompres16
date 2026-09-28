<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth/admin/M_auth', 'auth');

		// Activity log
		$this->load->model('M_activity', 'activity');

		if (!$this->session->userdata("admin")) {
			redirect(base_url("auth/admin/login"));
		}
	}

	public function index()
	{
		// Render page
		$title["title"] = "Akun";
		$data["page"]   = "users";
		$data["users"]	= $this->auth->getAkun();	

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_users', $data);
		$this->load->view('admin/_parts/body_html');
	}

	public function add()
	{
		// Render page
		$title["title"] = "Tambah Akun";
		$data["page"] 	= "add-user";

		// Tambah data
		if (isset($_POST["simpan"])) {
			date_default_timezone_set("Asia/Jakarta");
			$tgl   = date("Y-m-d H:i:s");
			$user  = $this->input->post("user");
			$pwd   = $this->input->post("pwd");
			$nama  = $this->input->post("nama");
			$email = $this->input->post("email");
			$role  = $this->input->post("role");

			if (empty($user) or empty($pwd) or empty($nama) or empty($email) or empty($role)) {
				$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
				redirect(base_url("admin/users/add"));
			} else {

				// Validasi data
				$this->db->from("users");
				$this->db->group_start();
					$this->db->where("username", $user);
					$this->db->or_where("nama", $nama);
					$this->db->or_where("email", $email);
				$this->db->group_end();

				$cekAkun = $this->db->get();

				if ($cekAkun->num_rows() < 1) {

					// Get id user
					$sesAkun = $this->session->userdata("admin");
					$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

					// Cek alamat IP
					$ip_user = $this->input->ip_address();

					if ($ip_user == "::1") {
						$ip_user = "127.0.0.1";
					}

					$data = [
						"username"   => $user,
						"password"   => $pwd,
						"nama"	     => $nama,
						"email"      => $email,
						"role"	     => $role,
						"status"     => "Active",
						"created_at" => $tgl
					];

					// Data activity
					$dataActivity = [
						"created_at" => $tgl,
						"user_id"    => $id_user,
						"modul"		 => "Akun",
						"aktivitas"  => "[Tambah data] Admin menambahkan akun baru: [" . $nama . "]",
						"ip_user" 	 => $ip_user,
						"status"	 => "success"
					];

					$this->auth->tambahAkun($data);
					$this->activity->tambahData($dataActivity);

					$this->session->set_flashdata("success", "Akun berhasil ditambahkan!");
					redirect(base_url("admin/users"));
				} else {
					$this->session->set_flashdata("msg", "Akun tersebut sudah ada. Silahkan isi data lain!");
					redirect(base_url("admin/users/add"));
				}

			}

		}

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_users_add', $data);
		$this->load->view('admin/_parts/body_html');
	}

	public function detail()
	{

		$id 	 = ["user_id" => $this->uri->segment(4)];
		$cekData = $this->auth->detailAkun($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Detail Akun";
			$data["page"] 	= "users";

			// Load data
			$data["akun"] = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_users_detail', $data);
			$this->load->view('admin/_parts/body_html');
		} else {
			echo '<script>alert("MAAF, AKUN TERSEBUT TIDAK DITEMUKAN !");</script>';
		}

	}

	public function edit()
	{

		$id 	 = ["user_id" => $this->uri->segment(4)];
		$cekData = $this->auth->detailAkun($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Edit Akun";
			$data["page"] 	= "users";

			// Load data
			$data["akun"] = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_users_edit', $data);
			$this->load->view('admin/_parts/body_html');

			// Update data
			if (isset($_POST["ubah"])) {
				date_default_timezone_set("Asia/Jakarta");
				$tgl    = date("Y-m-d H:i:s");
				$user   = $this->input->post("user");
				$pwd    = $this->input->post("pwd");
				$nama   = $this->input->post("nama");
				$email  = $this->input->post("email");
				$role   = $this->input->post("role");
				$status = $this->input->post("status");

				if ($this->uri->segment(4) != 1) {
					if (empty($user) or empty($pwd) or empty($nama) or empty($email) or empty($role) or empty($status)) {
						$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
						redirect(base_url("admin/users/edit/" . $this->uri->segment(4)));
					}
				} else {
					if (empty($user) or empty($pwd) or empty($nama) or empty($email)) {
						$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
						redirect(base_url("admin/users/edit/" . $this->uri->segment(4)));
					}
				}

				// Validasi data
				$this->db->from("users");
				$this->db->where("user_id !=", $this->uri->segment(4));
				$this->db->group_start();
					$this->db->where("username", $user);
					$this->db->or_where("nama", $nama);
					$this->db->or_where("email", $email);
				$this->db->group_end();

				$cekAkun = $this->db->get();

				if ($cekAkun->num_rows() < 1) {

					// Get old data
					$dataLama = $this->auth->detailAkun($id)->row();

					// Get id user
					$sesAkun = $this->session->userdata("admin");
					$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

					// Cek alamat IP
					$ip_user = $this->input->ip_address();

					if ($ip_user == "::1") {
						$ip_user = "127.0.0.1";
					}
					
					if($this->uri->segment(4) != 1) {
						$data = [
							"username"   => $user,
							"password"   => $pwd,
							"nama"	     => $nama,
							"email"      => $email,
							"role"	     => $role,
							"status"     => $status
						];
					} else {
						$data = [
							"username"   => $user,
							"password"   => $pwd,
							"nama"	     => $nama,
							"email"      => $email
						];

						$this->session->set_userdata(["admin" => $nama]);

					}

					// Password akun
					if (!empty($password)) {
						$data['password'] = $password;
					}

					$kolomBaru = [];
					$mapping   = [
						"username" => "Username",
						"password" => "Password",
						"nama"     => "Nama Aplikasi",
						"email"    => "E-mail",
						"role"     => "Hak Akses",
						"status"   => "Status Aplikasi"
					];

					foreach ($mapping as $kolom => $label) {
						$nilaiLama = isset($dataLama->$kolom) ? trim((string)$dataLama->$kolom) : "";
						$nilaiBaru = isset($data[$kolom]) ? trim((string)$data[$kolom]) : "";

						if ($nilaiLama !== $nilaiBaru) {
							$kolomBaru[] = $label;
						}
					}

					// Cek password
					if (!empty($password)) {
						$kolomBaru[] = "Password";
					}

					if (!empty($kolomBaru)) {
						$list_perubahan = implode(", ", $kolomBaru);
						$aktivitas = "[Ubah data] Admin memperbarui akun [" . $nama . "] pada bagian kolom: [" . $list_perubahan . "]";
					} else {
						$aktivitas = "[Ubah data] Admin memperbarui akun [" . $nama . "] tanpa ada perubahan data";
					}

					// Data activity
					$dataActivity = [
						"created_at" => $tgl,
						"user_id"    => $id_user,
						"modul"		 => "Akun",
						"aktivitas"  => $aktivitas,
						"ip_user" 	 => $ip_user,
						"status"	 => "success"
					];

					$this->auth->editAkun($id, $data);
					$this->activity->tambahData($dataActivity);

					$this->session->set_flashdata("success", "Akun berhasil diperbarui!");
					redirect(base_url("admin/users"));
					
				} else {
					$this->session->set_flashdata("msg", "Akun tersebut sudah ada. Silahkan isi data lain!");
					redirect(base_url("admin/users/edit/" . $this->uri->segment(4)));
				}

			}

		} else {
			echo '<script>alert("MAAF, AKUN TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/users") .'";</script>';
		}

	}

	public function delete()
	{

		$id 	 = ["user_id" => $this->uri->segment(4)];
		$cekData = $this->auth->detailAkun($id);

		if ($cekData->num_rows() > 0) {

			// Get id user
			$sesAkun = $this->session->userdata("admin");
			$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

			// Get nama akun
			$nama = $this->auth->detailData($id)->row()->nama;

			// Cek alamat IP
			$ip_user = $this->input->ip_address();

			if ($ip_user == "::1") {
				$ip_user = "127.0.0.1";
			}

			// Data activity
			date_default_timezone_set("Asia/Jakarta");

			$dataActivity = [
				"created_at" => date("Y-m-d H:i:s"),
				"user_id"    => $id_user,
				"modul"		 => "Akun",
				"aktivitas"  => "[Hapus data] Admin menghapus akun " . $nama,
				"ip_user" 	 => $ip_user,
				"status"	 => "success"
			];

			$this->activity->tambahData($dataActivity);
			$this->auth->hapusAkun($id);
			redirect(base_url("admin/users"));
		} else {
			echo '<script>alert("MAAF, AKUN TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/users") .'";</script>';
		}

	}

	public function import()
	{

		// Render page
		$title["title"] = "Import dari Excel Akun";
		$data["page"] 	= "import-users";

		// Import data dari Excel
		if (isset($_POST["upload"])) {
			date_default_timezone_set("Asia/Jakarta");
			$tgl = date("Y-m-d H:i:s");

			// Get id user untuk log audit
			$sesAkun = $this->session->userdata("admin");
			$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

			// Cek alamat IP user
			$ip_user = $this->input->ip_address();
			if ($ip_user == "::1") {
				$ip_user = "127.0.0.1";
			}

			$file_mimes = ['application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

			if(isset($_FILES['berkas']['name']) && in_array($_FILES['berkas']['type'], $file_mimes)) {
				$extension = pathinfo($_FILES['berkas']['name'], PATHINFO_EXTENSION);

				if('csv' == $extension) {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				} else {
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				}

				$spreadsheet = $reader->load($_FILES['berkas']['tmp_name']);
				$jumlahSukses = 0;
				$jumlahGagal  = 0;
				$barisGagal   = [];

				// VALIDASI DUPLIKAT USERNAME AKUN
				$listAkun = $this->db->select("username")->get("users")->result();
				$mapAkun  = [];
				foreach ($listAkun as $listAkun) {
					$mapAkun[strtolower(trim($listAkun->username))] = true;
				}

				// array utk menampung nama kembar / duplikat di excel
				$excelAkun = [];

				// Sebelum lanjut ke looping for excel, buat validasi terlebih dahulu mengecek apakah khusus untuk Aplikasi
				$filePath = $_FILES['berkas']['tmp_name'];

				if (empty($filePath) || !file_exists($filePath)) {
			        $this->session->set_flashdata('msg', 'File gagal diunggah ke server temporer. Silakan coba lagi.');
			        redirect('admin/users/import');
			        exit;
			    }

			    try {
			        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
			        $sheet = $spreadsheet->getActiveSheet();
			        
			        $templateAkun = [
					    'Username', 
					    'Password',
					    'Nama Lengkap', 
					    'E-mail',
					    'Role',
					    'Status'
					];

					$headerUpload = [
					    trim($sheet->getCell('B1')->getValue()),
					    trim($sheet->getCell('C1')->getValue()),
					    trim($sheet->getCell('D1')->getValue()),
					    trim($sheet->getCell('E1')->getValue()),
					    trim($sheet->getCell('F1')->getValue()),
					    trim($sheet->getCell('G1')->getValue()),
					];

					if ($headerUpload !== $templateAkun) {
					    $logGagal = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Akun",
							"aktivitas"  => "[Import dari Excel] Gagal mengimport data Akun darl Excel. Template spreadsheet tidak sesuai",
							"ip_user"    => $ip_user,
							"status"     => "failed"
						];

						$this->activity->tambahData($logGagal);
					    $this->session->set_flashdata("msg", "Format file excel tidak sesuai dengan template aplikasi! Harap gunakan template spreadsheet yang sudah disediakan.");
					    redirect("admin/users/import");
					    exit;
					}

					$sheetData = $spreadsheet->getActiveSheet()->toArray();

					if (count($sheetData) <= 1 || empty(trim($sheetData[1][0]))) {
					    $this->session->set_flashdata("msg", 'Spreadsheet Akun masih kosong. Silahkan diisi terlebih dahulu!');
					    redirect('admin/users/import');
					    return;
					}

					for($i = 1; $i < count($sheetData); $i++) {
					
						$current_row = $i + 1; // Penanda baris riil di excel

						// Lewati baris kalau Nama Aplikasi (Kolom B / index 1) kosong melompong
						if(empty($sheetData[$i][1])) {
							continue;
						}

						// Get nama aplikasi dari excel
						$namaAkunExcel      = $sheetData[$i][1];
						$namaAkunExcelClean = strtolower(trim($namaAkunExcel));

						// =====================================
					    // GUARDRAIL ANTI-DUPLIKASI (NAMA)
					    // =====================================
					    // Cek apakah nama sudah ada di DB ATAU sudah tertulis di baris atasnya dalam file Excel yang sama
					    if (isset($mapAkun[$namaAkunExcelClean]) || isset($excelAkun[$namaAkunExcelClean])) {
					        $jumlahGagal++;
					        $barisGagal[] = $current_row . " (Username sudah Ada)";
					        continue;
					    }

					    // Jika lolos, tandai nama ini sudah terproses agar baris di bawahnya gak bisa pakai nama ini lagi
					    $excelAkun[$namaAkunExcelClean] = true;

						// Susun array untuk dicemplungkan ke model aplikasi
						$dataInsert = [
							'username' => $sheetData[$i][1],
							'password' => $sheetData[$i][2],
							'nama'     => $sheetData[$i][3],
							'email'    => $sheetData[$i][4],
							'role'     => $sheetData[$i][5],
							'status'   => $sheetData[$i][6]
						];

						// Eksekusi insert via method model aplikasi lo harian
						$this->auth->tambahData($dataInsert);
						$jumlahSukses++;
					}

					// =====================================
					// ACTIVITY LOG
					// =====================================
					
					// Log Sukses
					if ($jumlahSukses > 0) {
						$txtSukses = "[Import dari Excel] Berhasil mengimport [" . $jumlahSukses . "] data [Akun] baru melalui file Excel Akun";
						if ($jumlahGagal > 0) {
							$txtSukses .= " dengan pengecualian [" . $jumlahGagal . "] baris data ditolak";
						}

						$logSukses = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Akun",
							"aktivitas"  => $txtSukses,
							"ip_user"    => $ip_user,
							"status"     => "success"
						];
						$this->activity->tambahData($logSukses);
					}

					// Log Gagal (Audit Trail Error)
					if ($jumlahGagal > 0) {
						$txtGagal = "[Import dari Excel] Gagal memproses [" . $jumlahGagal . "] baris data [Akun] pada Excel pada baris: [" . implode(", ", $barisGagal) . "] akibat ketidaksesuaian Relasi Master";

						$logGagal = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Akun",
							"aktivitas"  => $txtGagal,
							"ip_user"    => $ip_user,
							"status"     => "failed"
						];
						$this->activity->tambahData($logGagal);
					}

					// Redirect balik pake flashdata report UI
					if ($jumlahGagal > 0) {
						$barisFormatted = array_map(function($val) {
					        return "Baris " . $val;
					    }, $barisGagal);

					    $pesan = $jumlahSukses . " data di-import. Terdeteksi kegagalan pada: [" . implode(", ", $barisFormatted) . "]. Periksa kembali data relasi atau duplikasi nama aplikasi!";

						$this->session->set_flashdata("msg", $pesan);
					} else {
						$this->session->set_flashdata("success", "Berhasil! Semua data (" . $jumlahSukses . ") berhasil di-import tanpa error!");
					}

					redirect(base_url("admin/users"));

			    } catch (\Exception $e) {
			        $this->session->set_flashdata('error', 'Gagal membaca file: ' . $e->getMessage());
			        redirect('admin/users/import');
			        exit;
			    }

			} else {
				$this->session->set_flashdata("msg", "Format file tidak didukung. Harap upload berkas .xls, .xlsx atau .csv!");
				redirect(base_url("admin/users/import"));
			}

		}

		// Render page
		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_users_import', $data);
		$this->load->view('admin/_parts/body_html');

	}

}
