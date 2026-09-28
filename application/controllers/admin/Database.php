<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Database extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_db', 'debeee');
		$this->load->model('M_activity', 'activity');
		if (!$this->session->userdata("admin")) {
			redirect(base_url("auth/admin/login"));
		}
	}

	public function index()
	{
		// Render page
		$title["title"] = "Database";
		$data["page"]   = "db";

		$data["db"]	= $this->debeee->getData();

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_db', $data);
		$this->load->view('admin/_parts/body_html');
	}

	public function add()
	{
		// Render page
		$title["title"] = "Tambah Database";
		$data["page"] 	= "add-db";

		// Tambah data
		if (isset($_POST["simpan"])) {
			date_default_timezone_set("Asia/Jakarta");
			$tgl    = date("Y-m-d H:i:s");
			$nama   = $this->input->post("nama");
			$status = $this->input->post("status");

			if (empty($nama) or empty($status)) {
				$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
				redirect(base_url("admin/database/add"));
			} else {

				// Validasi data
				$this->db->from("db");
				$this->db->group_start();
					$this->db->where("db_name", $nama);
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
						"db_name" 	 => $nama,
						"status"  	 => $status,
						"created_at" => $tgl
					];

					// Data activity
					$dataActivity = [
						"created_at" => $tgl,
						"user_id"    => $id_user,
						"modul"		 => "Database",
						"aktivitas"  => "[Tambah data] Admin menambahkan database baru: [" . $nama . "]",
						"ip_user" 	 => $ip_user,
						"status"	 => "success"
					];

					$this->debeee->tambahData($data);
					$this->activity->tambahData($dataActivity);

					$this->session->set_flashdata("success", "Data berhasil ditambahkan!");
					redirect(base_url("admin/database"));
				} else {
					$this->session->set_flashdata("msg", "Data tersebut sudah ada. Silahkan isi data lain!");
					redirect(base_url("admin/database/add"));
				}

			}

		}

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_db_add', $data);
		$this->load->view('admin/_parts/body_html');
	}

	public function detail()
	{

		$id 	 = ["db_id" => $this->uri->segment(4)];
		$cekData = $this->debeee->detailData($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Detail Data";
			$data["page"] 	= "db";

			// Load data
			$data["db"] = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_db_detail', $data);
			$this->load->view('admin/_parts/body_html');
		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !");</script>';
		}

	}

	public function edit()
	{

		$id 	 = ["db_id" => $this->uri->segment(4)];
		$cekData = $this->debeee->detailData($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Edit Database";
			$data["page"] 	= "db";

			// Load data
			$data["db"] = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_db_edit', $data);
			$this->load->view('admin/_parts/body_html');

			// Update data
			if (isset($_POST["ubah"])) {
				$nama   = $this->input->post("nama");
				$status = $this->input->post("status");

				if (empty($nama) or empty($status)) {
					$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
					redirect(base_url("admin/database/edit/" . $this->uri->segment(4)));
				} else {

					// Validasi data
					$this->db->from("db");
					$this->db->where("db_id !=", $this->uri->segment(4));
					$this->db->group_start();
						$this->db->where("db_name", $nama);
					$this->db->group_end();

					$cekData = $this->db->get();

					if ($cekData->num_rows() < 1) {

						// Get old data
						$dataLama = $this->debeee->detailData($id)->row();

						// Get id user
						$sesAkun = $this->session->userdata("admin");
						$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

						// Cek alamat IP
						$ip_user = $this->input->ip_address();

						if ($ip_user == "::1") {
							$ip_user = "127.0.0.1";
						}
						
						$kolomBaru = [];
						$mapping   = [
							"db_name" => "Nama Database",
							"status"  => "Status Aplikasi"
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
							$aktivitas = "[Ubah data] Admin memperbarui database [" . $nama . "] pada bagian kolom: [" . $list_perubahan . "]";
						} else {
							$aktivitas = "[Ubah data] Admin memperbarui database [" . $nama . "] tanpa ada perubahan data";
						}

						$data = [
							"db_name" => $nama,
							"status"  => $status
						];

						// Data activity
						$dataActivity = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"		 => "Database",
							"aktivitas"  => $aktivitas,
							"ip_user" 	 => $ip_user,
							"status"	 => "success"
						];

						$this->debeee->updateData($id, $data);
						$this->activity->tambahData($dataActivity);

						$this->session->set_flashdata("success", "Data berhasil diperbarui!");
						redirect(base_url("admin/database"));
						
					} else {
						$this->session->set_flashdata("msg", "Database tersebut sudah ada. Silahkan isi data lain!");
						redirect(base_url("admin/database/edit/" . $this->uri->segment(4)));
					}

				}

			}

		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/database") .'";</script>';
		}

	}

	public function delete()
	{

		$id 	 = ["db_id" => $this->uri->segment(4)];
		$cekData = $this->debeee->detailData($id);

		if ($cekData->num_rows() > 0) {

			// Get id user
			$sesAkun = $this->session->userdata("admin");
			$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

			// Get nama database
			$nama = $this->debeee->detailData($id)->row()->nama;

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
				"aktivitas"  => "[Hapus data] Admin menghapus database " . $nama,
				"ip_user" 	 => $ip_user,
				"status"	 => "success"
			];

			$this->activity->tambahData($dataActivity);
			$this->debeee->hapusData($id);
			redirect(base_url("admin/database"));
		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/database") .'";</script>';
		}

	}

	public function import()
	{

		// Render page
		$title["title"] = "Import dari Excel Database";
		$data["page"] 	= "import-db";

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
				$listDB = $this->db->select("db_name")->get("db")->result();
				$mapDB  = [];
				foreach ($listDB as $listDB) {
					$mapDB[strtolower(trim($listDB->db_name))] = true;
				}

				// array utk menampung nama kembar / duplikat di excel
				$excelAkun = [];

				// Sebelum lanjut ke looping for excel, buat validasi terlebih dahulu mengecek apakah khusus untuk Aplikasi
				$filePath = $_FILES['berkas']['tmp_name'];

				if (empty($filePath) || !file_exists($filePath)) {
			        $this->session->set_flashdata('msg', 'File gagal diunggah ke server temporer. Silakan coba lagi.');
			        redirect('admin/database/import');
			        exit;
			    }

			    try {
			        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
			        $sheet 		 = $spreadsheet->getActiveSheet();
			        
			        $templateDB = [
					    'Nama Database',
					    'Status'
					];

					$headerUpload = [
					    trim($sheet->getCell('B1')->getValue()),
					    trim($sheet->getCell('C1')->getValue()),
					];

					if ($headerUpload !== $templateDB) {
					    $logGagal = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Database",
							"aktivitas"  => "[Import dari Excel] Gagal mengimport database darl Excel. Template spreadsheet tidak sesuai",
							"ip_user"    => $ip_user,
							"status"     => "failed"
						];

						$this->activity->tambahData($logGagal);
					    $this->session->set_flashdata("msg", "Format file excel tidak sesuai dengan template database! Harap gunakan template spreadsheet yang sudah disediakan.");
					    redirect("admin/database/import");
					    exit;
					}

					$sheetData = $spreadsheet->getActiveSheet()->toArray();

					if (count($sheetData) <= 1 || empty(trim($sheetData[1][0]))) {
					    $this->session->set_flashdata("msg", 'Spreadsheet Database masih kosong. Silahkan diisi terlebih dahulu!');
					    redirect('admin/database/import');
					    return;
					}

					for($i = 1; $i < count($sheetData); $i++) {
					
						$current_row = $i + 1; // Penanda baris riil di excel

						// Lewati baris kalau Nama Aplikasi (Kolom B / index 1) kosong melompong
						if(empty($sheetData[$i][1])) {
							continue;
						}

						// Get nama aplikasi dari excel
						$namaDBExcel      = $sheetData[$i][1];
						$namaDBExcelClean = strtolower(trim($namaDBExcel));

						// =====================================
					    // GUARDRAIL ANTI-DUPLIKASI (NAMA)
					    // =====================================
					    // Cek apakah nama sudah ada di DB ATAU sudah tertulis di baris atasnya dalam file Excel yang sama
					    if (isset($mapDB[$namaDBExcelClean]) || isset($excelAkun[$namaDBExcelClean])) {
					        $jumlahGagal++;
					        $barisGagal[] = $current_row . " (Nama Database sudah Ada)";
					        continue;
					    }

					    // Jika lolos, tandai nama ini sudah terproses agar baris di bawahnya gak bisa pakai nama ini lagi
					    $excelAkun[$namaDBExcelClean] = true;

						// Susun array untuk dicemplungkan ke model aplikasi
						$dataInsert = [
							'db_name' => $sheetData[$i][1],
							'status'  => $sheetData[$i][2]
						];

						// Eksekusi insert via method model aplikasi lo harian
						$this->debeee->tambahData($dataInsert);
						$jumlahSukses++;
					}

					// =====================================
					// ACTIVITY LOG
					// =====================================
					
					// Log Sukses
					if ($jumlahSukses > 0) {
						$txtSukses = "[Import dari Excel] Berhasil mengimport [" . $jumlahSukses . "] data [Database] baru melalui file Excel Akun";
						if ($jumlahGagal > 0) {
							$txtSukses .= " dengan pengecualian [" . $jumlahGagal . "] baris data ditolak";
						}

						$logSukses = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Database",
							"aktivitas"  => $txtSukses,
							"ip_user"    => $ip_user,
							"status"     => "success"
						];
						$this->activity->tambahData($logSukses);
					}

					// Log Gagal (Audit Trail Error)
					if ($jumlahGagal > 0) {
						$txtGagal = "[Import dari Excel] Gagal memproses [" . $jumlahGagal . "] baris data [Database] pada Excel pada baris: [" . implode(", ", $barisGagal) . "] akibat ketidaksesuaian Relasi Master";

						$logGagal = [
							"created_at" => $tgl,
							"user_id"    => $id_user,
							"modul"      => "Database",
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

					    $pesan = $jumlahSukses . " data di-import. Terdeteksi kegagalan pada: [" . implode(", ", $barisFormatted) . "]. Periksa kembali data relasi atau duplikasi nama database!";

						$this->session->set_flashdata("msg", $pesan);
					} else {
						$this->session->set_flashdata("success", "Berhasil! Semua data (" . $jumlahSukses . ") berhasil di-import tanpa error!");
					}

					redirect(base_url("admin/database"));

			    } catch (\Exception $e) {
			        $this->session->set_flashdata('error', 'Gagal membaca file: ' . $e->getMessage());
			        redirect('admin/database/import');
			        exit;
			    }

			} else {
				$this->session->set_flashdata("msg", "Format file tidak didukung. Harap upload berkas .xls, .xlsx atau .csv!");
				redirect(base_url("admin/database/import"));
			}

		}

		// Render page
		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_db_import', $data);
		$this->load->view('admin/_parts/body_html');

	}

}
