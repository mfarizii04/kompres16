<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aplikasi extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->model('M_aplikasi', 'aplikasi');
		$this->load->model('M_server', 'server');
		$this->load->model('M_akun', 'acc');
		$this->load->model('M_db', 'debe');
		$this->load->model('M_os', 'os');

		if (!$this->session->userdata("viewer")) {
			redirect(base_url("auth/login"));
		}

	}

	public function index()
	{

		// Load data
		$title["title"]   = "Aplikasi";
		$data["page"]     = "aplikasi";
		$data["aplikasi"] = $this->aplikasi->getData();

		// Render page
		$this->load->view('_parts/doctype_html', $title);
		$this->load->view('v_aplikasi', $data);
		$this->load->view('_parts/body_html');

	}

	public function detail()
	{

		$id 	 = $this->uri->segment(3);
		$cekData = $this->aplikasi->detailData($id);

		if ($cekData->num_rows() > 0) {
			
			// Load data
			$data["app"] = $cekData->row();

			// Render page
			$title["title"] = "Detail Aplikasi";
			$data["page"] 	= "aplikasi";
			$this->load->view('_parts/doctype_html', $title);
			$this->load->view('v_aplikasi_detail', $data);
			$this->load->view('_parts/body_html');

		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("aplikasi") .'";</script>';
		}

	}

}