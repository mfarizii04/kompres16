<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lapor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_lapor', 'lapor');
		$this->load->model('M_activity', 'activity');
		if (!$this->session->userdata("admin")) {
			redirect(base_url("auth/admin/login"));
		}
	}

	public function index()
	{
		// Render page
		$title["title"] = "Lapor Mas Atmin";
		$data["page"]   = "lapor";

		$data["lapor"]	= $this->lapor->getData();

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_lapor', $data);
		$this->load->view('admin/_parts/body_html');
	}

	public function respon()
	{

		$id 	  = ["lapor_id" => $this->uri->segment(4)];
		$cekData  = $this->lapor->detailData($id);
			$ceki = isset($cekData->row()->status) ? $cekData->row()->status : "";

		if ($ceki=="Selesai") {
			redirect(base_url("admin/lapor"));
		}

		if ($cekData->num_rows() > 0) {
			
			// Render page
			$title["title"] = "Respon Laporan";
			$data["page"] 	= "lapor";
			$data["lapor"]  = $cekData->row();

			// Tambah data
			if (isset($_POST["simpan"])) {

				date_default_timezone_set("Asia/Jakarta");
				$tgl    = date("Y-m-d H:i:s");
				$subjek = $this->input->post("subjek");
				$respon = $this->input->post("respon");
				$status = $this->input->post("status");

				if (empty($respon) or empty($status)) {

					$this->session->set_flashdata("msg", "Silahkan pilih jenis masalah terlebih dahulu!");
					redirect(base_url("admin/lapor/respon"));

				}

				// Get id user
				$sesAkun = $this->session->userdata("admin");
				$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

				// Cek alamat IP
				$ip_user = $this->input->ip_address();

				if ($ip_user == "::1") {
					$ip_user = "127.0.0.1";
				}

				$data = [
					"respon" => $respon,
					"status" => $status
				];

				$where = [
					"lapor_id" => $this->uri->segment(4)
				];

				// Data activity
				$dataActivity = [
					"created_at" => $tgl,
					"user_id"    => $id_user,
					"modul"		 => "Ticketing Helpdesk",
					"aktivitas"  => "Admin merespons laporan ticketing helpdesk [" . $subjek . "]",
					"ip_user" 	 => $ip_user,
					"status"	 => "success"
				];

				$this->activity->tambahData($dataActivity);
				$this->lapor->responLaporan($data, $where);

				$this->session->set_flashdata("success", "Respon laporan Mas Atmin berhasil!");
				redirect(base_url("admin/lapor"));

			}

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_lapor_respon', $data);
			$this->load->view('admin/_parts/body_html');

		} else {
			echo '<script>alert("MAAF, LAPORAN TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/lapor") .'";</script>';
		}

	}

	public function detail()
	{

		$id 	 = ["lapor_id" => $this->uri->segment(4)];
		$cekData = $this->lapor->detailData($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Detail Laporan";
			$data["page"] 	= "lapor";

			// Load data
			$data["lapor"] = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_lapor_detail', $data);
			$this->load->view('admin/_parts/body_html');
		} else {
			echo '<script>alert("MAAF, LAPORAN TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/lapor") .'";</script>';
		}

	}

}
