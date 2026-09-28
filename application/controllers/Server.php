<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_server', 'server');
		if (!$this->session->userdata("viewer")) {
			redirect(base_url("auth/login"));
		}
	}

	public function index()
	{
		// Render page
		$title["title"] = "Server";
		$data["page"]   = "server";

		$data["server"]	= $this->server->getData();

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('v_server', $data);
		$this->load->view('_parts/body_html');
	}

	public function detail()
	{

		$id 	 = ["server_id" => $this->uri->segment(3)];
		$cekData = $this->server->detailData($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Detail Server";
			$data["page"] 	= "server";

			// Load data
			$data["server"] = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('v_server_detail', $data);
			$this->load->view('_parts/body_html');
		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("server") .'";</script>';
		}

	}

}
