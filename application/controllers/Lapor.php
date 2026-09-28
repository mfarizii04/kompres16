<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lapor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_lapor', 'lapor');
		$this->load->model('M_activity', 'activity');

		// Cek session admin atau viewer
		if ((!$this->session->userdata("admin")) && (!$this->session->userdata("viewer"))) {
			redirect(base_url("auth/login"));
		}
	}

	public function index()
	{
		$title["title"] = "Lapor Mas Atmin";
		$data["page"]   = "lapor";
		$data["lapor"]  = $this->lapor->getData();

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('v_lapor', $data);
		$this->load->view('_parts/body_html');
	}

	public function add()
	{
		$title["title"] = "Tambah Laporan";
		$data["page"]   = "add-lapor";

		if (isset($_POST["simpan"])) {

			// Get id user berdasarkan session yang aktif
			$user_now = $this->session->userdata("viewer") ? $this->session->userdata("viewer") : $this->session->userdata("admin");
			$user_id  = $this->db->get_where("users", ["nama" => $user_now])->row()->user_id;

			date_default_timezone_set("Asia/Jakarta");
			$tgl       = date("Y-m-d H:i:s");
			$opsi      = $this->input->post("opsi");
			
			$acc_id    = $this->input->post("acc_id");
			$db_id     = $this->input->post("db_id");
			$os_id     = $this->input->post("os_id");
			$server_id = $this->input->post("server_id");

			$subjek    = $this->input->post("subjek");
			$isi       = $this->input->post("isi");
			$priority  = $this->input->post("priority");

			// VALIDASI
			if (empty($opsi)) {
				$this->session->set_flashdata("msg", "Silahkan pilih jenis masalah terlebih dahulu!");
				redirect(base_url("lapor/add"));
			}

			if (empty($acc_id) && empty($db_id) && empty($os_id) && empty($server_id)) {
				$this->session->set_flashdata("msg", "Silahkan pilih salah satu opsi laporan!");
				redirect(base_url("lapor/add"));
			}

			if (empty($subjek) || empty($isi)) {
				$this->session->set_flashdata("msg", "Subjek dan Isi laporan tidak boleh kosong!");
				redirect(base_url("lapor/add"));
			}

			if (empty($priority)) {
				$this->session->set_flashdata("msg", "Silahkan pilih tingkatan prioritas terlebih dahulu!");
				redirect(base_url("lapor/add"));
			}

			// Cek apakah data laporan yang sama sudah pernah di-input
			$this->db->from("laporan");
			$this->db->where([
				"user_id"  => $user_id,
				"subjek"   => $subjek,
				"isi"      => $isi,
				"priority" => $priority
			]);
			$cekData = $this->db->get();

			if ($cekData->num_rows() < 1) {

				// Get id user
				$sesAkun = $this->session->userdata("viewer");
				$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

				// Cek alamat IP
				$ip_user = $this->input->ip_address();

				if ($ip_user == "::1") {
					$ip_user = "127.0.0.1";
				}

				$insert_data = [
					"user_id"    => $user_id,
					"account_id" => $acc_id,
					"db_id"      => $db_id,
					"os_id"      => $os_id,
					"server_id"  => $server_id,
					"tgl"        => $tgl,
					"subjek"     => $subjek,
					"isi"        => $isi,
					"priority"   => $priority
				];

				// Data activity
				$dataActivity = [
					"created_at" => $tgl,
					"user_id"    => $id_user,
					"modul"		 => "Ticketing Helpdesk",
					"aktivitas"  => $sesAkun . " membuat laporan ticketing helpdesk [" . $subjek . "]",
					"ip_user" 	 => $ip_user,
					"status"	 => "success"
				];

				$this->activity->tambahData($dataActivity);
				$this->lapor->tambahData($insert_data);
				
				$this->session->set_flashdata("success", "Laporan ke Mas Atmin berhasil dikirim!");
				redirect(base_url("lapor"));
			} else {
				$this->session->set_flashdata("msg", "Laporan dengan subjek tersebut sudah ada!");
				redirect(base_url("lapor"));
			}
		}

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('v_lapor_add', $data);
		$this->load->view('_parts/body_html');
	}

	public function tampilkanOpsi()
	{
		$data["opsi"] = $this->input->post("opsi");
		$this->load->view('opsiLaporan', $data);
	}

	public function detail()
	{
		$id      = ["lapor_id" => $this->uri->segment(3)];
		$cekData = $this->lapor->detailData($id);

		if ($cekData->num_rows() > 0) {
			$title["title"] = "Detail Laporan";
			$data["page"]   = "lapor";
			$data["lapor"]  = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('v_lapor_detail', $data);
			$this->load->view('_parts/body_html');
		} else {
			echo '<script>alert("MAAF, LAPORAN TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("lapor") .'";</script>';
		}
	}
}