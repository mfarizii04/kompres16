<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth/M_auth', 'auth');
		$this->load->model('M_activity', 'activity');
	}

	public function index()
	{

		date_default_timezone_set("Asia/Jakarta");
		$tgl = date("Y-m-d H:i:s");

		// Get id user
		$sesAkun = $this->session->userdata("viewer");
		$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

		// Cek alamat IP
		$ip_user = $this->input->ip_address();

		if ($ip_user == "::1") {
			$ip_user = "127.0.0.1";
		}

		// Data activity
		$dataActivity = [
			"created_at" => $tgl,
			"user_id"    => $id_user,
			"modul"		 => "Log-Out Staff",
			"aktivitas"  => $sesAkun . " melakukan Log-Out sebagai Staff",
			"ip_user" 	 => $ip_user,
			"status"	 => "success"
		];
	    
		$this->activity->tambahData($dataActivity);
		$this->session->unset_userdata("viewer");
		redirect(base_url("auth/login"));

	}

}