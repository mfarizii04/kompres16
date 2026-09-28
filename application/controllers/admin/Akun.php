<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_akun', 'akun');
		$this->load->model('M_server', 'server');
		$this->load->model('M_activity', 'activity');
		if (!$this->session->userdata("admin")) {
			redirect(base_url("auth/admin/login"));
		}
	}

	public function index()
	{
		// Render page
		$title["title"] = "Kredensial Server";
		$data["page"]   = "akun";

		$data["akun"]	= $this->akun->getData();

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_akun', $data);
		$this->load->view('admin/_parts/body_html');
	}

	public function add()
	{
		// Render page
		$title["title"] = "Tambah Kredensial Server";
		$data["page"] 	= "add-akun";

		// Tambah data
		if (isset($_POST["simpan"])) {
			date_default_timezone_set("Asia/Jakarta");
			$tgl         = date("Y-m-d H:i:s");
			$tgl_expired = $this->input->post("tgl_expired");
			$id_server   = $this->input->post("id_server");
			$user        = $this->input->post("user");
			$pwd         = $this->input->post("pwd");
			$role        = $this->input->post("role");

			if (empty($tgl_expired) or empty($id_server) or empty($user) or empty($pwd) or empty($role)) {
				$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
				redirect(base_url("admin/akun/add"));
			} else {

				// Validasi data
				$this->db->from("accounts");
				$this->db->where("username", $user);

				$cekData = $this->db->get();

				if ($cekData->num_rows() < 1) {

					// Get id user
					$sesAkun = $this->session->userdata("admin");
					$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

					// Cek alamat IP
					$ip_user = $this->input->ip_address();

					if ($ip_user == "::1") {
						$ip_user = "127.0.0.1";
					}

					$data = [
						"server_id"  => $id_server,
						"username"   => $user,
						"password"	 => $pwd,
						"role"		 => $role,
						"created_at" => $tgl,
						"expired_at" => $tgl_expired
					];

					// Data activity
					$dataActivity = [
						"created_at" => $tgl,
						"user_id"    => $id_user,
						"modul"		 => "Kredensial Server",
						"aktivitas"  => "[Tambah data] Admin menambahkan data kredensial server baru: [" . $nama . "]",
						"ip_user" 	 => $ip_user,
						"status"	 => "success"
					];

					$this->akun->tambahData($data);
					$this->activity->tambahData($dataActivity);

					$this->session->set_flashdata("success", "Data berhasil ditambahkan!");
					redirect(base_url("admin/akun"));
				} else {
					$this->session->set_flashdata("msg", "Nama akun tersebut sudah ada. Silahkan isi nama lain!");
					redirect(base_url("admin/akun/add"));
				}

			}

		}

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_akun_add', $data);
		$this->load->view('admin/_parts/body_html');
	}

	public function detail()
	{

		$id 	 = ["account_id" => $this->uri->segment(4)];
		$cekData = $this->akun->detailData($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Detail Kredensial Server";
			$data["page"] 	= "akun";

			// Load data
			$data["akun"] = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_akun_detail', $data);
			$this->load->view('admin/_parts/body_html');
		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/akun") .'";</script>';
		}

	}

	public function edit()
	{

		$id 	 = ["account_id" => $this->uri->segment(4)];
		$cekData = $this->akun->detailData($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Edit Kredensial Server";
			$data["page"] 	= "akun";

			// Load data
			$data["akun"] = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_akun_edit', $data);
			$this->load->view('admin/_parts/body_html');

			// Update data
			if (isset($_POST["ubah"])) {
				date_default_timezone_set("Asia/Jakarta");
				$tgl         = date("Y-m-d H:i:s");
				$tgl_expired = $this->input->post("tgl_expired");
				$id_server   = $this->input->post("id_server");
				$user        = $this->input->post("user");
				$pwd         = $this->input->post("pwd");
				$role        = $this->input->post("role");

				if (empty($tgl_expired) or empty($id_server) or empty($user) or empty($pwd) or empty($role)) {
					$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
					redirect(base_url("admin/akun/edit/" . $this->uri->segment(4)));
				} else {

					// Validasi data
					$this->db->from("accounts");
					$this->db->where("account_id !=", $this->uri->segment(4));
					$this->db->group_start();
						$this->db->where("username", $user);
					$this->db->group_end();

					$cekData = $this->db->get();

					if ($cekData->num_rows() < 1) {

						// Get old data
						$dataLama = $this->server->detailData($id)->row();

						// Get id user
						$sesAkun = $this->session->userdata("admin");
						$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

						// Cek alamat IP
						$ip_user = $this->input->ip_address();

						if ($ip_user == "::1") {
							$ip_user = "127.0.0.1";
						}
						
						$data = [
							"server_id"  => $id_server,
							"username"   => $user,
							"password"	 => $pwd,
							"role"		 => $role,
							"expired_at" => $tgl_expired
						];

						$kolomBaru = [];
						$mapping   = [
							"server_id"  => "Nama Server",
							"expired_at" => "Tgl. Kadaluwarsa Kredensial Server",
							"username"   => "Username",
							"password"   => "Password",
							"role"       => "Role Kredensial Server"
						];

						foreach ($mapping as $kolom => $label) {
							$nilaiLama = isset($dataLama->$kolom) ? trim((string)$dataLama->$kolom) : "";
							$nilaiBaru = isset($data[$kolom]) ? trim((string)$data[$kolom]) : "";

							if ($nilaiLama !== $nilaiBaru) {
								$kolomBaru[] = $label;
							}
						}

						if (!empty($kolomBaru)) {
							$list_perubahan = implode(", ", $kolomBaru);
							$aktivitas = "[Ubah data] Admin memperbarui data kredensial server [" . $nama . "] pada bagian kolom: [" . $list_perubahan . "]";
						} else {
							$aktivitas = "[Ubah data] Admin melakukan simpan ulang data kredensial server [" . $nama . "] tanpa ada perubahan data";
						}

						// Data activity
						$dataActivity = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"		 => "Kredensial Server",
							"aktivitas"  => $aktivitas,
							"ip_user" 	 => $ip_user,
							"status"	 => "success"
						];

						$this->akun->updateData($id, $data);
						$this->activity->tambahData($dataActivity);

						$this->session->set_flashdata("success", "Data berhasil diperbarui!");
						redirect(base_url("admin/akun"));
						
					} else {
						$this->session->set_flashdata("msg", "Nama akun tersebut sudah ada. Silahkan isi data lain!");
						redirect(base_url("admin/akun/edit/" . $this->uri->segment(4)));
					}

				}

			}

		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/akun") .'";</script>';
		}

	}

	public function delete()
	{

		$id 	 = ["account_id" => $this->uri->segment(4)];
		$cekData = $this->akun->detailData($id);

		if ($cekData->num_rows() > 0) {

			// Get id user
			$sesAkun = $this->session->userdata("admin");
			$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

			// Get username kredensial server
			$user = $this->akun->detailData($id)->row()->username;

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
				"modul"		 => "Kredensial Server",
				"aktivitas"  => "[Hapus data] Admin menghapus data kredensial server: [" . $user . "]",
				"ip_user" 	 => $ip_user,
				"status"	 => "success"
			];

			$this->activity->tambahData($dataActivity);
			$this->akun->hapusData($id);

			redirect(base_url("admin/akun"));
		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/akun") .'";</script>';
		}

	}

	public function import()
	{

		// Render page
		$title["title"] = "Import dari Excel Kredensial Server";
		$data["page"] 	= "import-akun";

		// Mapping data
		$mapServer = $this->server->getMapServer();

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

				$spreadsheet  = $reader->load($_FILES['berkas']['tmp_name']);
				$jumlahSukses = 0;
				$jumlahGagal  = 0;
				$barisGagal   = [];

				// VALIDASI DUPLIKAT NAMA SERVER
				$listAkun = $this->db->select("username")->get("accounts")->result();
				$mapAkun  = [];
				foreach ($listAkun as $listAcc) {
					$mapServer[strtolower(trim($listAcc->username))] = true;
				}

				// array utk menampung nama kembar / duplikat di excel
				$excelAkun = [];

				// Sebelum lanjut ke looping for excel, buat validasi terlebih dahulu mengecek apakah khusus untuk Server
				$filePath = $_FILES['berkas']['tmp_name'];

				if (empty($filePath) || !file_exists($filePath)) {
			        $this->session->set_flashdata('msg', 'File gagal diunggah ke server temporer. Silakan coba lagi.');
			        redirect('admin/akun/import');
			        exit;
			    }

			    try {
			        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
			        $sheet = $spreadsheet->getActiveSheet();
			        
			        $templateAkun = [
					    'Tgl. Kadaluwarsa Kredensial',
					    'Username',
					    'Password',
					    'Role', 
					    'Nama Server'
					];

					$headerUpload = [
					    trim($sheet->getCell('B1')->getValue()),
					    trim($sheet->getCell('C1')->getValue()),
					    trim($sheet->getCell('D1')->getValue()),
					    trim($sheet->getCell('E1')->getValue()),
					    trim($sheet->getCell('F1')->getValue()),
					];

					if ($headerUpload !== $templateAkun) {
					    $logGagal = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Kredensial Server",
							"aktivitas"  => "[Import dari Excel] Gagal mengimport data Kredensial Server dari Excel. Template spreadsheet tidak sesuai",
							"ip_user"    => $ip_user,
							"status"     => "failed"
						];

						$this->activity->tambahData($logGagal);
					    $this->session->set_flashdata("msg", "Format file excel tidak sesuai dengan template kredensial server! Harap gunakan template spreadsheet yang sudah disediakan.");
					    redirect("admin/akun/import");
					    exit;
					}

					$sheetData = $spreadsheet->getActiveSheet()->toArray();

					if (count($sheetData) <= 1 || empty(trim($sheetData[1][0]))) {

						$logGagal = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Kredensial Server",
							"aktivitas"  => "[Import dari Excel] Gagal mengimport data Kredensial Server darl Excel. Spreadsheet masih kosong",
							"ip_user"    => $ip_user,
							"status"     => "failed"
						];

						$this->activity->tambahData($logGagal);
					    $this->session->set_flashdata("msg", 'Spreadsheet Server masih kosong. Silahkan diisi terlebih dahulu!');
					    redirect('admin/akun/import');
					    return;
					}

					for($i = 1; $i < count($sheetData); $i++) {
					
						$current_row = $i + 1; // Penanda baris riil di excel

						// Lewati baris kalau Nama Server (Kolom B / index 1) kosong melompong
						if (empty(trim($sheetData[$i][0])) && empty(trim($sheetData[$i][1]))) {
					        continue; 
					    }

						// Get username Kredensial Server dari excel
						$namaAkunExcel      = $sheetData[$i][2];
						$namaAkunExcelClean = strtolower(trim($namaAkunExcel));

						// =====================================
					    // GUARDRAIL ANTI-DUPLIKASI (USERNAME)
					    // =====================================
					    // Cek apakah nama sudah ada di DB ATAU sudah tertulis di baris atasnya dalam file Excel yang sama
					    if (isset($mapAkun[$namaAkunExcelClean]) || isset($excelAkun[$namaAkunExcelClean])) {
					        $jumlahGagal++;
					        $barisGagal[] = $current_row . " (Username sudah Ada)";
					        continue;
					    }

					    // Jika lolos, tandai nama ini sudah terproses agar baris di bawahnya gak bisa pakai nama ini lagi
					    $excelAkun[$namaAkunExcelClean] = true;

						// Relasi dari kolom
						$excelServer = strtolower(trim($sheetData[$i][5]));

						// VALIDASI GUARD INTERGRITAS: Cek keselarasan nama teks ke Master DB
						if (
							!isset($mapOS[$excelServer])
						) {
							$jumlahGagal++;
							$barisGagal[] = $current_row; // Rekam baris bermasalah
							continue; // JUMP/SKIP baris ini
						}

						// Jika lolos guard, ubah teks menjadi ID aslinya
						$id_server = $mapOS[$excelServer];

						// Susun array untuk dicemplungkan ke model server
						$dataInsert = [
							'server_id'  => $id_server,
							'created_at' => $tgl,
							'expired_at' => $sheetData[$i][1],
							'username'	 => $sheetData[$i][2],
							'password'   => $sheetData[$i][3],
							'role'	  	 => $sheetData[$i][4],
						];

						// Eksekusi insert via method model server harian
						$this->server->tambahData($dataInsert);
						$jumlahSukses++;
					}

					// =====================================
					// ACTIVITY LOG
					// =====================================
					
					// Log Sukses
					if ($jumlahSukses > 0) {
						$txtSukses = "[Import dari Excel] Berhasil mengimport [" . $jumlahSukses . "] data kredensial server baru melalui file Excel Kredensial Server";
						if ($jumlahGagal > 0) {
							$txtSukses .= " dengan pengecualian [" . $jumlahGagal . "] baris data ditolak";
						}

						$logSukses = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Kredensial Server",
							"aktivitas"  => $txtSukses,
							"ip_user"    => $ip_user,
							"status"     => "success"
						];

						$this->activity->tambahData($logSukses);

					}

					// Log Gagal (Audit Trail Error)
					if ($jumlahGagal > 0) {
						$txtGagal = "[Import dari Excel] Gagal memproses [" . $jumlahGagal . "] baris data kredensial server pada Excel pada baris: [" . implode(", ", $barisGagal) . "] akibat ketidaksesuaian Relasi Master";

						$logGagal = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Kredensial Server",
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

					    $pesan = $jumlahSukses . " data di-import. Terdeteksi kegagalan pada: [" . implode(", ", $barisFormatted) . "]. Periksa kembali data relasi atau duplikasi nama Kredensial Server!";

						$this->session->set_flashdata("msg", $pesan);
					} else {
						$this->session->set_flashdata("success", "Berhasil! Semua data (" . $jumlahSukses . ") berhasil di-import tanpa error!");
					}

					redirect(base_url("admin/akun"));

			    } catch (\Exception $e) {
			        $this->session->set_flashdata('error', 'Gagal membaca file: ' . $e->getMessage());
			        redirect('admin/akun/import');
			        exit;
			    }

			} else {
				$this->session->set_flashdata("msg", "Format file tidak didukung. Harap upload berkas .xls, .xlsx atau .csv!");
				redirect(base_url("admin/akun/import"));
			}

		}

		// Render page
		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_akun_import', $data);
		$this->load->view('admin/_parts/body_html');

	}

	// Show accounts server
	public function showAkunServer()
	{
		$id 	 = ["server_id" => $this->uri->segment(4)];
		$cekData = $this->akun->detailData($id);

		if ($cekData->num_rows() > 0) {
			
			// Render page
			$id_server = $cekData->row()->server_id;
			$sqlServer = $this->db->get_where("servers", ["server_id" => $id_server])->row();
			
			$title["title"] = "Daftar Kredensial Server " . $sqlServer->server_name;
			$data["page"] 	= "server";

			// Load data
			$data["akun"] = $cekData;

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_server_akun', $data);
			$this->load->view('admin/_parts/body_html');

		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/server") .'";</script>';
		}
	}

}
