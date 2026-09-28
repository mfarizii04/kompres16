<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth/admin/M_auth', 'auth');
		if (!$this->session->userdata("admin")) {
			redirect(base_url("auth/admin/login"));
		}
	}

	public function index()
	{
		$ses  = $this->session->userdata("admin");
		$akun = ["nama" => $ses];

		$profil = $this->auth->detailAkun($akun)->row();

		// Render page
		$title["title"] = "Profile";
		$data["page"]   = "profile";
		$data["akun"]   = $profil;

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/auth/v_profile', $data);
		$this->load->view('admin/_parts/body_html');

		// Update profil
		if (isset($_POST["ubah"])) {
			$user  = $this->input->post("user");
			$pwd   = $this->input->post("pwd");
			$nama  = $this->input->post("nama");
			$email = $this->input->post("email");

			if (empty($user) or empty($pwd) or empty($nama) or empty($email)) {
				$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu !");
				redirect(base_url("auth/admin/profile"));
			} else {

				$cekUser = $this->auth->detailAkun($akun)->row();

				$data = [
					"username"  => $user,
					"password"  => $pwd,
					"nama"  	=> $nama,
					"email" 	=> $email
				];

				$idnya = ["user_id" => $cekUser->user_id];
				
				$sesBaru = ["admin" => $nama];
				$this->session->set_userdata($sesBaru);

				$this->auth->editAkun($idnya, $data);

				$this->session->set_flashdata("success", "Profile berhasil diubah !");
				redirect(base_url("auth/admin/profile"));

			}

		}

	}
}
