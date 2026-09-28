<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_akun', 'akun');
		if (!$this->session->userdata("viewer")) {
			redirect(base_url("auth/login"));
		}
	}

	public function index()
	{
		// Render page
		$title["title"] = "Akun";
		$data["page"]   = "akun";

		$data["akun"]	= $this->akun->getData();

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('v_akun', $data);
		$this->load->view('_parts/body_html');
	}

	public function detail()
	{

		$id 	 = ["account_id" => $this->uri->segment(3)];
		$cekData = $this->akun->detailData($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Detail Akun";
			$data["page"] 	= "akun";

			// Load data
			$data["akun"] = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('v_akun_detail', $data);
			$this->load->view('_parts/body_html');
		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("akun") .'";</script>';
		}

	}
	
	// Show accounts server
	public function showAkunServer()
	{
		$id 	 = ["server_id" => $this->uri->segment(3)];
		$cekData = $this->akun->detailData($id);

		if ($cekData->num_rows() > 0) {
			
			// Render page
			$id_server = $cekData->row()->server_id;
			$sqlServer = $this->db->get_where("servers", ["server_id" => $id_server])->row();
			
			$title["title"] = "List Akun Server " . $sqlServer->server_name;
			$data["page"] 	= "server";

			// Load data
			$data["akun"] = $cekData;

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('v_server_akun', $data);
			$this->load->view('_parts/body_html');

		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("server") .'";</script>';
		}
	}

}
