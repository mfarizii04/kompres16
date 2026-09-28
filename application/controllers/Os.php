<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Os extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_os', 'oes');
		if (!$this->session->userdata("viewer")) {
			redirect(base_url("auth/login"));
		}
	}

	public function index()
	{
		// Render page
		$title["title"] = "Sistem Operasi";
		$data["page"]   = "os";

		$data["os"]	= $this->oes->getData();

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('v_os', $data);
		$this->load->view('_parts/body_html');
	}

	public function detail()
	{

		$id 	 = ["os_id" => $this->uri->segment(3)];
		$cekData = $this->oes->detailData($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Detail Data";
			$data["page"] 	= "os";

			// Load data
			$data["os"] = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('v_os_detail', $data);
			$this->load->view('_parts/body_html');
		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("os") .'";</script>';
		}

	}

}
