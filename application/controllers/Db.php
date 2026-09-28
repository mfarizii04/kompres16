<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_db', 'debeee');
		if (!$this->session->userdata("viewer")) {
			redirect(base_url("auth/login"));
		}
	}

	public function index()
	{
		// Render page
		$title["title"] = "Database";
		$data["page"]   = "db";

		$data["db"]	= $this->debeee->getData();

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('v_db', $data);
		$this->load->view('_parts/body_html');
	}

	public function detail()
	{

		$id 	 = ["db_id" => $this->uri->segment(3)];
		$cekData = $this->debeee->detailData($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Detail Data";
			$data["page"] 	= "db";

			// Load data
			$data["db"] = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('v_db_detail', $data);
			$this->load->view('_parts/body_html');
		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !");</script>';
		}

	}

}
