<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth/admin/M_auth', 'auth');
		$this->load->model('M_activity', 'activity');

		if ($this->session->userdata("admin")) {
			$this->session->set_flashdata('isLogin', 'Selamat Datang di Inventarizz!');
		}
	}

	public function index()
	{
		$this->load->view('admin/auth/v_login');

		// Auth login
		if (isset($_POST["login"])) {

			date_default_timezone_set("Asia/Jakarta");
			$tgl     = date("Y-m-d H:i:s");
			$user 	 = $this->input->post("user");
			$pwd  	 = $this->input->post("pwd");

			$akun = [
				"username" => $user,
				"password" => $pwd
			];

			$cekAkun = $this->auth->masukAkun($akun);

			if ($cekAkun->num_rows() > 0) {

				$role = $cekAkun->row()->role;

				if ($role != "Admin") {
					$this->session->set_flashdata('msg', 'Login ini khusus untuk Administrator saja!');
					redirect(base_url("auth/admin/login"));
				} else {

					$ses = [
				    	"admin" => $cekAkun->row()->nama
				    ];
					$this->session->set_userdata($ses);
					
					// Get id user
					$sesAkun = $this->session->userdata("admin");
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
						"modul"		 => "Login Administrator",
						"aktivitas"  => $sesAkun . " melakukan login sebagai Administrator",
						"ip_user" 	 => $ip_user,
						"status"	 => "success"
					];
				    
					$this->activity->tambahData($dataActivity);

				    redirect(base_url('admin/veda'));
				}

			} else {
			    $this->session->set_flashdata('msg', "Username atau password tidak sesuai!");
			    redirect(base_url('auth/admin/login'));
			}

		}
	}

}