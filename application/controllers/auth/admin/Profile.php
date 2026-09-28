<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth/admin/M_auth', 'auth');
		$this->load->model('M_activity', 'activity');
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
			date_default_timezone_set("Asia/Jakarta");
			$tgl   = date("Y-m-d H:i:s");
			$user  = $this->input->post("user");
			$pwd   = $this->input->post("pwd");
			$nama  = $this->input->post("nama");
			$email = $this->input->post("email");

			if (empty($user) or empty($pwd) or empty($nama) or empty($email)) {
				$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu !");
				redirect(base_url("auth/admin/profile"));
			} else {

				// Get id user
				$cekUser = $this->auth->detailAkun($akun)->row();
				$idnya   = ["user_id" => $cekUser->user_id];

				// Validasi data
				$this->db->from("users");
				$this->db->where("user_id !=", $cekUser->user_id);
				$this->db->where("username", $user);

				$cekData = $this->db->get();

				if ($cekData->num_rows() < 1) {

					// Get old data
					$dataLama = $this->auth->detailAkun($idnya)->row();

					// Get id user
					$sesAkun = $this->session->userdata("admin");
					$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

					// Cek alamat IP
					$ip_user = $this->input->ip_address();

					if ($ip_user == "::1") {
						$ip_user = "127.0.0.1";
					}
					
					// Data user
					$data = [
						"username"  => $user,
						"password"  => $pwd,
						"nama"  	=> $nama,
						"email" 	=> $email
					];

					// Password aplikasi
					if (!empty($password)) {
						$data['password'] = $password;
					}

					$kolomBaru = [];
					$mapping   = [
						"username" => "Username",
						"password" => "Password",
						"nama"     => "Nama Lengkap",
						"email"    => "E-mail"
					];

					foreach ($mapping as $kolom => $label) {
						$nilaiLama = isset($dataLama->$kolom) ? trim((string)$dataLama->$kolom) : "";
						$nilaiBaru = isset($data[$kolom]) ? trim((string)$data[$kolom]) : "";

						if ($nilaiLama !== $nilaiBaru) {
							$kolomBaru[] = $label;
						}
					}

					// Cek password
					if (!empty($password)) {
						$kolomBaru[] = "Password";
					}

					if (!empty($kolomBaru)) {
						$list_perubahan = implode(", ", $kolomBaru);
						$aktivitas = "[Ubah profil] " . $this->session->userdata("admin") . " memperbarui profil " . $list_perubahan;
					} else {
						$aktivitas = "[Ubah profil] " . $this->session->userdata("admin") . " memperbarui profil tanpa ada perubahan data";
					}

					// Data activity
					$dataActivity = [
						"created_at" => $tgl,
						"user_id"    => $id_user,
						"modul"		 => "Profil Akun",
						"aktivitas"  => $aktivitas,
						"ip_user" 	 => $ip_user,
						"status"	 => "success"
					];

					$this->activity->tambahData($dataActivity);

					$sesBaru = ["admin" => $nama];
					$this->session->set_userdata($sesBaru);

					$this->auth->editAkun($idnya, $data);

					$this->session->set_flashdata("success", "Profile berhasil diubah !");
					redirect(base_url("auth/admin/profile"));
					
				} else {
					$this->session->set_flashdata("msg", "Username tersebut sudah ada. Silahkan isi username lain!");
					redirect(base_url("auth/admin/profile"));
				}

			}

		}

	}

}