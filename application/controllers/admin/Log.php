<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_activity', 'activity');
		if (!$this->session->userdata("admin")) {
			redirect(base_url("auth/admin/login"));
		}
	}

	public function index()
	{
		// Render page
		$title["title"] = "Log Aktivitas";
		$data["page"]   = "log";

		$data["activity"] = $this->activity->getData();

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_log', $data);
		$this->load->view('admin/_parts/body_html');
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

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_log_detail', $data);
			$this->load->view('admin/_parts/body_html');
		} else {
			echo '<script>alert("MAAF, LAPORAN TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/log") .'";</script>';
		}

	}

}
