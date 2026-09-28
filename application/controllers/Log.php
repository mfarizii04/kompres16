<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_activity', 'activity');
		if (!$this->session->userdata("viewer")) {
			redirect(base_url("auth/login"));
		}
	}

	public function index()
	{

		// Get ID User from Session
		$sesAkun = $this->session->userdata("viewer");
		$id_akun = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

		// Render page
		$title["title"]   = "Log Aktivitas";
		$data["page"]     = "log";
		$data["activity"] = $this->activity->getDataStaff($id_akun);

		$this->load->view('_parts/doctype_html', $title);
		$this->load->view('v_log', $data);
		$this->load->view('_parts/body_html');
	}

	public function detail()
	{

		$id 	 = ["log_id" => $this->uri->segment(4)];
		$cekData = $this->activity->detailData($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Detail Log Aktivitas";
			$data["page"] 	= "log";

			// Load data
			$data["log"] = $cekData->row();

			$this->load->view('_parts/doctype_html', $title);
			$this->load->view('v_log_detail', $data);
			$this->load->view('_parts/body_html');
		} else {
			echo '<script>alert("MAAF, LAPORAN TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("log") .'";</script>';
		}

	}

}
