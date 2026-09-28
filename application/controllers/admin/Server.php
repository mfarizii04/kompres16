<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_server', 'server');
		$this->load->model('M_db', 'debe');
		$this->load->model('M_os', 'oes');
		$this->load->model('M_activity', 'activity');

		if (!$this->session->userdata("admin")) {
			redirect(base_url("auth/admin/login"));
		}
	}

	public function index()
	{
		// Render page
		$title["title"] = "Server";
		$data["page"]   = "server";

		$data["server"]	= $this->server->getData();

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_server', $data);
		$this->load->view('admin/_parts/body_html');
	}

	public function add()
	{
		// Render page
		$title["title"] = "Tambah Server";
		$data["page"] 	= "add-server";

		// Tambah data
		if (isset($_POST["simpan"])) {
			date_default_timezone_set("Asia/Jakarta");
			$tgl    = date("Y-m-d H:i:s");
			$id_os  = $this->input->post("id_os");
			$id_db  = $this->input->post("id_db");
			$nama   = $this->input->post("nama");
			$ip     = $this->input->post("ip");
			$lokasi = $this->input->post("lokasi");
			$email  = $this->input->post("email");
			$status = $this->input->post("status");

			if (empty($id_os) or empty($id_db) or empty($nama) or empty($ip) or empty($lokasi) or empty($email) or empty($status)) {
				$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
				redirect(base_url("admin/server/add"));
			} else {

				// Validasi data
				$this->db->from("servers");
				$this->db->group_start();
					$this->db->where("server_name", $nama);
					$this->db->where("os_id", $id_os);
					$this->db->where("db_id", $id_db);
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

					$data = [
						"os_id"       => $id_os,
						"db_id"	      => $id_db,
						"server_name" => $nama,
						"ip_address"  => $ip,
						"location"    => $lokasi,
						"email"       => $email,
						"status"      => $status,
						"created_at"  => $tgl
					];

					// Data activity
					$dataActivity = [
						"created_at" => $tgl,
						"user_id"    => $id_user,
						"modul"		 => "Server",
						"aktivitas"  => "[Tambah data] Admin menambahkan data server baru: [" . $nama . "]",
						"ip_user" 	 => $ip_user,
						"status"	 => "success"
					];

					$this->server->tambahData($data);
					$this->activity->tambahData($dataActivity);

					$this->session->set_flashdata("success", "Data berhasil ditambahkan!");
					redirect(base_url("admin/server"));
				} else {
					$this->session->set_flashdata("msg", "Nama server tersebut sudah ada. Silahkan isi nama lain!");
					redirect(base_url("admin/server/add"));
				}

			}

		}

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_server_add', $data);
		$this->load->view('admin/_parts/body_html');
	}

	public function detail()
	{

		$id 	 = ["server_id" => $this->uri->segment(4)];
		$cekData = $this->server->detailData($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Detail Server";
			$data["page"] 	= "server";

			// Load data
			$data["server"] = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_server_detail', $data);
			$this->load->view('admin/_parts/body_html');
		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/server") .'";</script>';
		}

	}

	public function edit()
	{

		$id 	 = ["server_id" => $this->uri->segment(4)];
		$cekData = $this->server->detailData($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Edit Server";
			$data["page"] 	= "server";

			// Load data
			$data["server"] = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_server_edit', $data);
			$this->load->view('admin/_parts/body_html');

			// Update data
			if (isset($_POST["ubah"])) {
				date_default_timezone_set("Asia/Jakarta");
				$tgl    = date("Y-m-d H:i:s");
				$id_os  = $this->input->post("id_os");
				$id_db  = $this->input->post("id_db");
				$nama   = $this->input->post("nama");
				$ip     = $this->input->post("ip");
				$lokasi = $this->input->post("lokasi");
				$email  = $this->input->post("email");
				$status = $this->input->post("status");

				if (empty($id_os) or empty($id_db) or empty($nama) or empty($ip) or empty($lokasi) or empty($email) or empty($status)) {
					$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
					redirect(base_url("admin/server/edit/" . $this->uri->segment(4)));
				} else {

					// Validasi data
					$this->db->from("servers");
					$this->db->where("server_id !=", $this->uri->segment(4));
					$this->db->group_start();
						$this->db->where("os_id", $id_os);
						$this->db->or_where("db_id", $id_db);
						$this->db->or_where("server_name", $nama);
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
							"os_id"       => $id_os,
							"db_id"	      => $id_db,
							"server_name" => $nama,
							"ip_address"  => $ip,
							"location"    => $lokasi,
							"email"       => $email,
							"status"      => $status
						];

						$kolomBaru = [];
						$mapping   = [
							"os_id"       => "Sistem Operasi",
							"db_id"       => "Database",
							"server_name" => "Nama Server",
							"email"       => "E-mail Server",
							"ip_address"  => "Alamat IP",
							"location"    => "Lokasi Fisik Server",
							"status"      => "Status Server"
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
							$aktivitas = "[Ubah data] Admin memperbarui data server [" . $nama . "] pada bagian kolom: [" . $list_perubahan . "]";
						} else {
							$aktivitas = "[Ubah data] Admin melakukan simpan ulang data server [" . $nama . "] tanpa ada perubahan data";
						}

						// Data activity
						$dataActivity = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"		 => "Server",
							"aktivitas"  => $aktivitas,
							"ip_user" 	 => $ip_user,
							"status"	 => "success"
						];

						$this->server->updateData($id, $data);
						$this->activity->tambahData($dataActivity);

						$this->session->set_flashdata("success", "Data berhasil diperbarui!");
						redirect(base_url("admin/server"));
						
					} else {
						$this->session->set_flashdata("msg", "Nama server tersebut sudah ada. Silahkan isi data lain!");
						redirect(base_url("admin/server/edit/" . $this->uri->segment(4)));
					}

				}

			}

		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/server") .'";</script>';
		}

	}

	public function delete()
	{

		$id 	 = ["server_id" => $this->uri->segment(4)];
		$cekData = $this->server->detailData($id);

		if ($cekData->num_rows() > 0) {

			// Get id user
			$sesAkun = $this->session->userdata("admin");
			$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

			// Get nama server
			$nama = $this->server->detailData($id)->row()->nama;

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
				"modul"		 => "Server",
				"aktivitas"  => "[Hapus data] Admin menghapus data server: [" . $nama . "]",
				"ip_user" 	 => $ip_user,
				"status"	 => "success"
			];

			$this->activity->tambahData($dataActivity);
			$this->server->hapusData($id);

			redirect(base_url("admin/server"));
		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/server") .'";</script>';
		}

	}

	public function import()
	{

		// Render page
		$title["title"] = "Import dari Excel Server";
		$data["page"] 	= "import-server";

		// Mapping data
		$mapOS = $this->oes->getMapOS();
		$mapDB = $this->debe->getMapDB();

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
				$listServer = $this->db->select("server_name")->get("servers")->result();
				$mapServer  = [];
				foreach ($listServer as $listServr) {
					$mapServer[strtolower(trim($listServr->server_name))] = true;
				}

				// array utk menampung nama kembar / duplikat di excel
				$excelServer = [];

				// Sebelum lanjut ke looping for excel, buat validasi terlebih dahulu mengecek apakah khusus untuk Server
				$filePath = $_FILES['berkas']['tmp_name'];

				if (empty($filePath) || !file_exists($filePath)) {
			        $this->session->set_flashdata('msg', 'File gagal diunggah ke server temporer. Silakan coba lagi.');
			        redirect('admin/server/import');
			        exit;
			    }

			    try {
			        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
			        $sheet = $spreadsheet->getActiveSheet();
			        
			        $templateServer = [
					    'Nama Server', 
					    'Sistem Operasi',
					    'Database', 
					    'E-mail',
					    'Alamat IP',
					    'Lokasi Fisik Server',
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
					];

					if ($headerUpload !== $templateServer) {
					    $logGagal = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Server",
							"aktivitas"  => "[Import dari Excel] Gagal mengimport data Server dari Excel. Template spreadsheet tidak sesuai",
							"ip_user"    => $ip_user,
							"status"     => "failed"
						];

						$this->activity->tambahData($logGagal);
					    $this->session->set_flashdata("msg", "Format file excel tidak sesuai dengan template server! Harap gunakan template spreadsheet yang sudah disediakan.");
					    redirect("admin/server/import");
					    exit;
					}

					$sheetData = $spreadsheet->getActiveSheet()->toArray();

					if (count($sheetData) <= 1 || empty(trim($sheetData[1][0]))) {

						$logGagal = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Server",
							"aktivitas"  => "[Import dari Excel] Gagal mengimport data Server darl Excel. Spreadsheet masih kosong",
							"ip_user"    => $ip_user,
							"status"     => "failed"
						];

						$this->activity->tambahData($logGagal);
					    $this->session->set_flashdata("msg", 'Spreadsheet Server masih kosong. Silahkan diisi terlebih dahulu!');
					    redirect('admin/server/import');
					    return;
					}

					for($i = 1; $i < count($sheetData); $i++) {
					
						$current_row = $i + 1; // Penanda baris riil di excel

						// Lewati baris kalau Nama Server (Kolom B / index 1) kosong melompong
						if (empty(trim($sheetData[$i][0])) && empty(trim($sheetData[$i][1]))) {
					        continue; 
					    }

						// Get nama Server dari excel
						$namaServerExcel      = $sheetData[$i][1];
						$namaServerExcelClean = strtolower(trim($namaServerExcel));

						// =====================================
					    // GUARDRAIL ANTI-DUPLIKASI (NAMA)
					    // =====================================
					    // Cek apakah nama sudah ada di DB ATAU sudah tertulis di baris atasnya dalam file Excel yang sama
					    if (isset($mapServer[$namaServerExcelClean]) || isset($excelServer[$namaServerExcelClean])) {
					        $jumlahGagal++;
					        $barisGagal[] = $current_row . " (Nama Server sudah Ada)";
					        continue;
					    }

					    // Jika lolos, tandai nama ini sudah terproses agar baris di bawahnya gak bisa pakai nama ini lagi
					    $excelServer[$namaServerExcelClean] = true;

						// Relasi dari kolom
						$excelOS = strtolower(trim($sheetData[$i][2]));
						$excelDB = strtolower(trim($sheetData[$i][3]));

						// VALIDASI GUARD INTERGRITAS: Cek keselarasan nama teks ke Master DB
						if (
							!isset($mapOS[$excelOS]) || 
							!isset($mapDB[$excelDB])
						) {
							$jumlahGagal++;
							$barisGagal[] = $current_row; // Rekam baris bermasalah
							continue; // JUMP/SKIP baris ini
						}

						// Jika lolos guard, ubah teks menjadi ID aslinya
						$idOS = $mapOS[$excelOS];
						$idDB = $mapDB[$excelDB];

						// Susun array untuk dicemplungkan ke model server
						$dataInsert = [
							'os_id'       => $idOS,
							'db_id'       => $idDB,
							'created_at'  => $tgl,
							'server_name' => $sheetData[$i][1],
							'email'		  => $sheetData[$i][4],
							'ip_address'  => $sheetData[$i][5],
							'location'	  => $sheetData[$i][6],
							'status'      => $sheetData[$i][7]
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
						$txtSukses = "[Import dari Excel] Berhasil mengimport [" . $jumlahSukses . "] data server baru melalui file Excel Server";
						if ($jumlahGagal > 0) {
							$txtSukses .= " dengan pengecualian [" . $jumlahGagal . "] baris data ditolak";
						}

						$logSukses = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Server",
							"aktivitas"  => $txtSukses,
							"ip_user"    => $ip_user,
							"status"     => "success"
						];
						$this->activity->tambahData($logSukses);
					}

					// Log Gagal (Audit Trail Error)
					if ($jumlahGagal > 0) {
						$txtGagal = "[Import dari Excel] Gagal memproses [" . $jumlahGagal . "] baris data server pada Excel pada baris: [" . implode(", ", $barisGagal) . "] akibat ketidaksesuaian Relasi Master";

						$logGagal = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Server",
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

					    $pesan = $jumlahSukses . " data di-import. Terdeteksi kegagalan pada: [" . implode(", ", $barisFormatted) . "]. Periksa kembali data relasi atau duplikasi nama Server!";

						$this->session->set_flashdata("msg", $pesan);
					} else {
						$this->session->set_flashdata("success", "Berhasil! Semua data (" . $jumlahSukses . ") berhasil di-import tanpa error!");
					}

					redirect(base_url("admin/server"));

			    } catch (\Exception $e) {
			        $this->session->set_flashdata('error', 'Gagal membaca file: ' . $e->getMessage());
			        redirect('admin/server/import');
			        exit;
			    }

			} else {
				$this->session->set_flashdata("msg", "Format file tidak didukung. Harap upload berkas .xls, .xlsx atau .csv!");
				redirect(base_url("admin/server/import"));
			}

		}

		// Render page
		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_server_import', $data);
		$this->load->view('admin/_parts/body_html');

	}

}
