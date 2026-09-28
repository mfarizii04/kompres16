<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_dashboard', 'dash');
		$this->load->model('M_aplikasi', 'aplikasi');
		$this->load->model('M_activity', 'activity');
		$this->load->model('M_lapor', 'lapor');
		if (!$this->session->userdata("viewer")) {
			redirect(base_url("auth/login"));
		}
	}

	public function index()
	{
		
		// Load helper kalender
		$this->load->helper('kalender');
		$data["waktu"] = getWaktuLokal();

		// Get ID User from Session
		$sesAkun = $this->session->userdata("viewer");
		$id_akun = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

		// Render page
		$title["title"]       = "Dashboard";
		$data["page"] 		  = "dashboard";
		$data["laporan"]	  = $this->dash->getLaporan();
		$data["countLaporan"] = $this->dash->countLaporan($id_akun)->num_rows();
		$data["countSSL"]     = $this->dash->countSSLExpired()->num_rows();
		$data["countLog"]     = $this->dash->countLog($id_akun)->num_rows();
		$data["reminderSSL"]  = $this->aplikasi->reminderSSLExpired();
		$data["logActivity"]  = $this->activity->logActivity();
		$data["laporAtmin"]	  = $this->lapor->cekLaporanAtmin();

		$this->load->view('_parts/doctype_html', $title);
		$this->load->view('v_dashboard', $data);
		$this->load->view('_parts/body_html');
	}
}

// $data["countServers"] 	 = $this->dash->countServers()->num_rows();
// $data["countOS"] 	  	 = $this->dash->countOS()->num_rows();
// $data["countDB"]	  	 = $this->dash->countDB()->num_rows();
// $data["countServersAcc"] = $this->dash->countSA()->num_rows();