<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Aplikasi extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->model('M_aplikasi', 'aplikasi');
		$this->load->model('M_server', 'server');
		$this->load->model('M_akun', 'acc');
		$this->load->model('M_db', 'debe');
		$this->load->model('M_os', 'os');

		// Activity log
		$this->load->model('M_activity', 'activity');

		if (!$this->session->userdata("admin")) {
			redirect(base_url("auth/admin/login"));
		}

	}

	public function index()
	{

		// Load data
		$title["title"]   = "Aplikasi";
		$data["page"]     = "app";
		$data["aplikasi"] = $this->aplikasi->getData();

		// Render page
		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_aplikasi', $data);
		$this->load->view('admin/_parts/body_html');

		// Perpanjang SSL Aplikasi
		if (isset($_POST["extend"])) {

			date_default_timezone_set("Asia/Jakarta");
			$tgl 	     = date("Y-m-d H:i:s");
			$id          = $this->input->post("id_aplikasi");
			$tgl_expired = date("Y-m-d", strtotime($this->input->post("tgl_expired")));

			if (empty($tgl_expired)) {
				$this->session->set_flashdata("msg", "Silahkan pilih tanggal kadaluwarsa SSL aplikasi terlebih dahulu!");
				redirect(base_url("admin/dashboard"));
			} else {

				// Get id user
				$sesAkun = $this->session->userdata("admin");
				$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

				// Cek alamat IP
				$ip_user = $this->input->ip_address();

				if ($ip_user == "::1") {
					$ip_user = "127.0.0.1";
				}

				// Data aplikasi
				$data = [
					"ssl_expired" => $tgl_expired
				];

				// Data activity
				$namaAplikasi = $this->db->get_where("aplikasi", ["aplikasi_id" => $id])->row()->nama;
				$dataActivity = [
					"created_at" => $tgl,
					"user_id"    => $id_user,
					"modul"		 => "Aplikasi",
					"aktivitas"  => "[Ubah data] Admin memperpanjang kadaluwarsa SSL aplikasi baru: [" . $namaAplikasi . "]",
					"ip_user" 	 => $ip_user,
					"status"	 => "success"
				];

				$this->activity->tambahData($dataActivity);
				$this->aplikasi->updateData($id, $data);
				
				$this->session->set_flashdata("success", "SSL Aplikasi berhasil diperpanjang!");
				redirect(base_url("admin/dashboard"));
			}

		}

	}

	public function add()
	{

		// Render page
		$title["title"] = "Tambah Aplikasi";
		$data["page"] 	= "add-app";

		// Load data
		$data["server"] = $this->server->getData();
		$data["acc"] 	= $this->acc->getData();
		$data["db"] 	= $this->debe->getData();
		$data["os"] 	= $this->os->getData();

		// Tambah data
		if (isset($_POST["simpan"])) {
			date_default_timezone_set("Asia/Jakarta");
			$tgl         = date("Y-m-d H:i:s");
			$tgl_expired = date("Y-m-d", strtotime($this->input->post("tgl_expired")));
			$id_server 	 = $this->input->post("id_server");
			$id_akun   	 = $this->input->post("id_akun");
			$id_os     	 = $this->input->post("id_os");
			$id_db     	 = $this->input->post("id_db");
			$id_key    	 = $this->input->post("id_key");
			$nama      	 = $this->input->post("nama");
			$password  	 = $this->input->post("pwd");
			$ip        	 = $this->input->post("ip");
			$url   	   	 = $this->input->post("url");
			$status    	 = $this->input->post("status");

			if (empty($id_server) or empty($id_akun) or empty($id_os) or empty($id_db) or empty($id_key) or empty($tgl_expired) or empty($nama) or empty($password) or empty($ip) or empty($url) or empty($status)) {
				$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
				redirect(base_url("admin/aplikasi/add"));
			} else {

				// Validasi data
				$this->db->from("aplikasi");
				$this->db->group_start();
					$this->db->where("nama", $nama);
					$this->db->where("server_id", $id_server);
					$this->db->where("account_id", $id_akun);
					$this->db->where("os_id", $id_os);
					$this->db->where("db_id", $id_server);
				$this->db->group_end();

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

					// Data aplikasi
					$data = [
						"created_at"  => $tgl,
						"ssl_expired" => $tgl_expired,
						"server_id"	  => $id_server,
						"account_id"  => $id_akun,
						"os_id"       => $id_os,
						"db_id"		  => $id_db,
						"nama"		  => $nama,
						"id_key"	  => $id_key,
						"password"	  => $password,
						"ip"		  => $ip,
						"url"		  => $url,
						"status"	  => $status
					];

					// Data activity
					$dataActivity = [
						"created_at" => $tgl,
						"user_id"    => $id_user,
						"modul"		 => "Aplikasi",
						"aktivitas"  => "[Tambah data] Admin menambahkan data aplikasi baru: [" . $nama . "]",
						"ip_user" 	 => $ip_user,
						"status"	 => "success"
					];

					$this->aplikasi->tambahData($data);
					$this->activity->tambahData($dataActivity);

					$this->session->set_flashdata("success", "Data berhasil ditambahkan!");
					redirect(base_url("admin/aplikasi"));
				} else {
					$this->session->set_flashdata("msg", "Nama Aplikasi tersebut sudah ada. Silahkan isi nama aplikasi lain!");
					redirect(base_url("admin/aplikasi/add"));
				}

			}

		}

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_aplikasi_add', $data);
		$this->load->view('admin/_parts/body_html');

	}

	public function detail()
	{

		$id 	 = $this->uri->segment(4);
		$cekData = $this->aplikasi->detailData($id);

		if ($cekData->num_rows() > 0) {
			
			// Load data
			$data["app"] = $cekData->row();

			// Render page
			$title["title"] = "Detail Aplikasi";
			$data["page"] 	= "app";
			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_aplikasi_detail', $data);
			$this->load->view('admin/_parts/body_html');

			// Perpanjang SSL Aplikasi
			if (isset($_POST["extend"])) {

				date_default_timezone_set("Asia/Jakarta");
				$tgl 	     = date("Y-m-d H:i:s");
				$id          = $this->input->post("id_aplikasi");
				$tgl_expired = date("Y-m-d", strtotime($this->input->post("tgl_expired")));

				if (empty($tgl_expired)) {
					$this->session->set_flashdata("msg", "Silahkan pilih tanggal kadaluwarsa SSL aplikasi terlebih dahulu!");
					redirect(base_url("admin/dashboard"));
				} else {

					// Get id user
					$sesAkun = $this->session->userdata("admin");
					$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

					// Cek alamat IP
					$ip_user = $this->input->ip_address();

					if ($ip_user == "::1") {
						$ip_user = "127.0.0.1";
					}

					// Data aplikasi
					$data = [
						"ssl_expired" => $tgl_expired
					];

					// Data activity
					$namaAplikasi = $this->db->get_where("aplikasi", ["aplikasi_id" => $id])->row()->nama;
					$dataActivity = [
						"created_at" => $tgl,
						"user_id"    => $id_user,
						"modul"		 => "Aplikasi",
						"aktivitas"  => "[Ubah data] Admin memperpanjang kadaluwarsa SSL aplikasi baru: [" . $namaAplikasi . "]",
						"ip_user" 	 => $ip_user,
						"status"	 => "success"
					];

					$this->activity->tambahData($dataActivity);
					$this->aplikasi->updateData($id, $data);
					
					$this->session->set_flashdata("success", "SSL Aplikasi berhasil diperpanjang!");
					redirect(base_url("admin/dashboard"));
				}

			}

		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/aplikasi") .'";</script>';
		}

	}

	public function edit()
	{

		$id 	 = $this->uri->segment(4);
		$cekData = $this->aplikasi->detailData($id);

		if ($cekData->num_rows() > 0) {

			// Load data
			$title["title"] = "Edit Aplikasi";
			$data["page"] 	= "aplikasi";
			$data["app"] 	= $cekData->row();
			$data["server"] = $this->server->getData();
			$data["acc"] 	= $this->acc->getData();
			$data["db"] 	= $this->debe->getData();
			$data["os"] 	= $this->os->getData();

			// Render page
			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_aplikasi_edit', $data);
			$this->load->view('admin/_parts/body_html');

			// Update data
			if (isset($_POST["ubah"])) {
				date_default_timezone_set("Asia/Jakarta");
				$id_server   = $this->input->post("id_server");
				$id_akun     = $this->input->post("id_akun");
				$id_os       = $this->input->post("id_os");
				$id_db       = $this->input->post("id_db");
				$id_key      = $this->input->post("id_key");
				$tgl         = date("Y-m-d H:i:s");
				$tgl_expired = date("Y-m-d", strtotime($this->input->post("tgl_expired")));
				$nama      	 = $this->input->post("nama");
				$password  	 = $this->input->post("pwd");
				$ip        	 = $this->input->post("ip");
				$url   	   	 = $this->input->post("url");
				$status    	 = $this->input->post("status");
				
				if (empty($id_server) or empty($id_akun) or empty($id_os) or empty($id_db) or empty($id_key) or empty($tgl_expired) or empty($nama) or empty($ip) or empty($url) or empty($status)) {
					$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
					redirect(base_url("admin/aplikasi/edit/" . $this->uri->segment(4)));
				} else {

					// Validasi data
					$this->db->from("aplikasi");
					$this->db->where("aplikasi_id !=", $this->uri->segment(4));
					$this->db->where("nama", $nama);

					$cekData = $this->db->get();

					if ($cekData->num_rows() < 1) {

						// Get old data
						$dataLama = $this->aplikasi->detailData($id)->row();

						// Get id user
						$sesAkun = $this->session->userdata("admin");
						$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

						// Cek alamat IP
						$ip_user = $this->input->ip_address();

						if ($ip_user == "::1") {
							$ip_user = "127.0.0.1";
						}
						
						// Data aplikasi
						$data = [
							"server_id"	  => $id_server,
							"account_id"  => $id_akun,
							"os_id"       => $id_os,
							"db_id"		  => $id_db,
							"ssl_expired" => $tgl_expired,
							"nama"		  => $nama,
							"id_key"	  => $id_key,
							"ip"		  => $ip,
							"url"		  => $url,
							"status"	  => $status
						];

						// Password aplikasi
						if (!empty($password)) {
							$data['password'] = $password;
						}

						$kolomBaru = [];
						$mapping   = [
							"server_id"   => "Server",
							"account_id"  => "Akun Akses Server",
							"os_id"       => "Sistem Operasi",
							"db_id"       => "Database",
							"ssl_expired" => "Masa Aktif SSL",
							"nama"        => "Nama Aplikasi",
							"id_key"      => "License Key",
							"ip"          => "Alamat IP",
							"url"         => "URL Aplikasi",
							"status"      => "Status Aplikasi"
						];

						foreach ($mapping as $kolom => $label) {
							$nilaiLama = isset($dataLama->$kolom) ? trim((string)$dataLama->$kolom) : "";
							$nilaiBaru = isset($data[$kolom]) ? trim((string)$data[$kolom]) : "";

							if ($kolom === "ssl_expired" && !empty($nilaiLama)) {
								$nilaiLama = date("Y-m-d", strtotime($nilaiLama));
							}

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
							$aktivitas = "[Ubah data] Admin memperbarui data aplikasi [" . $nama . "] pada bagian kolom: [" . $list_perubahan . "]";
						} else {
							$aktivitas = "[Ubah data] Admin melakukan simpan ulang data aplikasi [" . $nama . "] tanpa ada perubahan data";
						}

						// Data activity
						$dataActivity = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"		 => "Aplikasi",
							"aktivitas"  => $aktivitas,
							"ip_user" 	 => $ip_user,
							"status"	 => "success"
						];

						$this->aplikasi->updateData($id, $data);
						$this->activity->tambahData($dataActivity);

						$this->session->set_flashdata("success", "Data berhasil diperbarui!");
						redirect(base_url("admin/aplikasi"));
						
					} else {
						$this->session->set_flashdata("msg", "Nama Aplikasi tersebut sudah ada. Silahkan isi data lain!");
						redirect(base_url("admin/aplikasi/edit/" . $this->uri->segment(4)));
					}

				}

			}

		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/aplikasi") .'";</script>';
		}

	}

	public function delete()
	{

		$id 	 = $this->uri->segment(4);
		$cekData = $this->aplikasi->detailData($id);

		if ($cekData->num_rows() > 0) {

			// Get id user
			$sesAkun = $this->session->userdata("admin");
			$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

			// Get nama aplikasi
			$nama = $this->aplikasi->detailData($id)->row()->nama;

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
				"modul"		 => "Aplikasi",
				"aktivitas"  => "[Hapus data] Admin menghapus data aplikasi: [" . $nama . "]",
				"ip_user" 	 => $ip_user,
				"status"	 => "success"
			];

			$this->activity->tambahData($dataActivity);
			$this->aplikasi->hapusData($id);
			redirect(base_url("admin/aplikasi"));

		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/aplikasi") .'";</script>';
		}

	}

	public function import()
	{

		// Render page
		$title["title"] = "Import dari Excel Aplikasi";
		$data["page"] 	= "import-app";

		// Mapping data
		$mapServer = $this->server->getMapServer();
		$mapOS     = $this->os->getMapOS();
		$mapDB     = $this->debe->getMapDB();
		$mapAcc    = $this->acc->getMapAcc();

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

				// VALIDASI DUPLIKAT NAMA APLIKASI
				$listAplikasi = $this->db->select("nama")->get("aplikasi")->result();
				$mapAplikasi  = [];
				foreach ($listAplikasi as $listApp) {
					$mapAplikasi[strtolower(trim($listApp->nama))] = true;
				}

				// array utk menampung nama kembar / duplikat di excel
				$excelAplikasi = [];

				// Sebelum lanjut ke looping for excel, buat validasi terlebih dahulu mengecek apakah khusus untuk Aplikasi
				$filePath = $_FILES['berkas']['tmp_name'];

				if (empty($filePath) || !file_exists($filePath)) {
			        $this->session->set_flashdata('msg', 'File gagal diunggah ke server temporer. Silakan coba lagi.');
			        redirect('admin/aplikasi/import');
			        exit;
			    }

			    try {
			        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
			        $sheet = $spreadsheet->getActiveSheet();
			        
			        $templateAplikasi = [
					    'Nama Aplikasi', 
					    'ID Key',
					    'Password Aplikasi', 
					    'Alamat URL',
					    'SSL Expired',
					    'Alamat IP',
					    'Server Aplikasi',
					    'Akun Server',
					    'Sistem Operasi',
					    'Database',
					    'Status'
					];

					$headerUpload = [
					    trim($sheet->getCell('B1')->getValue()),
					    trim($sheet->getCell('C1')->getValue()),
					    trim($sheet->getCell('D1')->getValue()),
					    trim($sheet->getCell('E1')->getValue()),
					    trim($sheet->getCell('F1')->getValue()),
					    trim($sheet->getCell('G1')->getValue()),
					    trim($sheet->getCell('H1')->getValue()),
					    trim($sheet->getCell('I1')->getValue()),
					    trim($sheet->getCell('J1')->getValue()),
					    trim($sheet->getCell('K1')->getValue()),
					    trim($sheet->getCell('L1')->getValue()),
					];

					if ($headerUpload !== $templateAplikasi) {
					    $logGagal = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Aplikasi",
							"aktivitas"  => "[Import dari Excel] Gagal mengimport data Aplikasi darl Excel. Template spreadsheet tidak sesuai",
							"ip_user"    => $ip_user,
							"status"     => "failed"
						];

						$this->activity->tambahData($logGagal);
					    $this->session->set_flashdata("msg", "Format file excel tidak sesuai dengan template aplikasi! Harap gunakan template spreadsheet yang sudah disediakan.");
					    redirect("admin/aplikasi/import");
					    exit;
					}

					$sheetData = $spreadsheet->getActiveSheet()->toArray();

					if (count($sheetData) <= 1 || empty(trim($sheetData[1][0]))) {
					    $this->session->set_flashdata("msg", 'Spreadsheet Aplikasi masih kosong. Silahkan diisi terlebih dahulu!');
					    redirect('admin/aplikasi/import');
					    return;
					}

					for($i = 1; $i < count($sheetData); $i++) {
					
						$current_row = $i + 1; // Penanda baris riil di excel

						// Lewati baris kalau Nama Aplikasi (Kolom B / index 1) kosong melompong
						if (empty(trim($sheetData[$i][0])) && empty(trim($sheetData[$i][1]))) {
					        continue; 
					    }

						// Get nama aplikasi dari excel
						$namaAppExcel      = $sheetData[$i][1];
						$namaAppExcelClean = strtolower(trim($namaAppExcel));

						// =====================================
					    // GUARDRAIL ANTI-DUPLIKASI (NAMA)
					    // =====================================
					    // Cek apakah nama sudah ada di DB ATAU sudah tertulis di baris atasnya dalam file Excel yang sama
					    if (isset($mapAplikasi[$namaAppExcelClean]) || isset($excelAplikasi[$namaAppExcelClean])) {
					        $jumlahGagal++;
					        $barisGagal[] = $current_row . " (Nama sudah Ada)";
					        continue;
					    }

					    // Jika lolos, tandai nama ini sudah terproses agar baris di bawahnya gak bisa pakai nama ini lagi
					    $excelAplikasi[$namaAppExcelClean] = true;

						// Relasi dari kolom
						$excelServer = strtolower(trim($sheetData[$i][7]));
						$excelAcc    = strtolower(trim($sheetData[$i][8]));
						$excelOS     = strtolower(trim($sheetData[$i][9]));
						$excelDB     = strtolower(trim($sheetData[$i][10]));

						// VALIDASI GUARD INTERGRITAS: Cek keselarasan nama teks ke Master DB
						if (
							!isset($mapServer[$excelServer]) || 
							!isset($mapAcc[$excelAcc]) || 
							!isset($mapOS[$excelOS]) || 
							!isset($mapDB[$excelDB])
						) {
							$jumlahGagal++;
							$barisGagal[] = $current_row; // Rekam baris bermasalah
							continue; // JUMP/SKIP baris ini
						}

						// Jika lolos guard, ubah teks menjadi ID aslinya
						$idServer = $mapServer[$excelServer];
						$idAcc    = $mapAcc[$excelAcc];
						$idOS     = $mapOS[$excelOS];
						$idDB     = $mapDB[$excelDB];

						// Susun array untuk dicemplungkan ke model aplikasi
						$dataInsert = [
							'server_id'   => $idServer,
							'account_id'  => $idAcc,
							'os_id'       => $idOS,
							'db_id'       => $idDB,
							'created_at'  => $tgl,
							'ssl_expired' => date("Y-m-d H:i:s", strtotime($sheetData[$i][5])),
							'id_key'      => $sheetData[$i][2],
							'nama'        => $sheetData[$i][1],
							'password'	  => $sheetData[$i][3],
							'url'         => $sheetData[$i][4],
							'ip'          => $sheetData[$i][6],
							'status'      => $sheetData[$i][11]
						];

						// Eksekusi insert via method model aplikasi lo harian
						$this->aplikasi->tambahData($dataInsert);
						$jumlahSukses++;
					}

					// =====================================
					// ACTIVITY LOG
					// =====================================
					
					// Log Sukses
					if ($jumlahSukses > 0) {
						$txtSukses = "[Import dari Excel] Berhasil mengimport [" . $jumlahSukses . "] data [Aplikasi] baru melalui file Excel Aplikasi";
						if ($jumlahGagal > 0) {
							$txtSukses .= " dengan pengecualian [" . $jumlahGagal . "] baris data ditolak";
						}

						$logSukses = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Aplikasi",
							"aktivitas"  => $txtSukses,
							"ip_user"    => $ip_user,
							"status"     => "success"
						];
						$this->activity->tambahData($logSukses);
					}

					// Log Gagal (Audit Trail Error)
					if ($jumlahGagal > 0) {
						$txtGagal = "[Import dari Excel] Gagal memproses [" . $jumlahGagal . "] baris data [Aplikasi] pada Excel pada baris: [" . implode(", ", $barisGagal) . "] akibat ketidaksesuaian Relasi Master";

						$logGagal = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Aplikasi",
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

					redirect(base_url("admin/aplikasi"));

			    } catch (\Exception $e) {
			        $this->session->set_flashdata('error', 'Gagal membaca file: ' . $e->getMessage());
			        redirect('admin/aplikasi/import');
			        exit;
			    }

			} else {
				$this->session->set_flashdata("msg", "Format file tidak didukung. Harap upload berkas .xls, .xlsx atau .csv!");
				redirect(base_url("admin/aplikasi/import"));
			}

		}

		// Render page
		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_aplikasi_import', $data);
		$this->load->view('admin/_parts/body_html');

	}

	public function getAllRelations()
	{

		// Get data
		$id_server = $this->input->post("id_server");

		// Load data
		$data["acc"] = $this->acc->getFromServer($id_server);
		$data["db"]	 = $this->debe->getFromServer($id_server);
		$data["os"]	 = $this->os->getFromServer($id_server);

		// Render page
		$this->load->view("admin/formAplikasi", $data);
	}

}