<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
		// Render page
		$title["title"] = "Akun";
		$data["page"]   = "users";
		$data["users"]	= $this->auth->getAkun();	

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_users', $data);
		$this->load->view('admin/_parts/body_html');
	}

	public function add()
	{
		// Render page
		$title["title"] = "Tambah Akun";
		$data["page"] 	= "add-user";

		// Tambah data
		if (isset($_POST["simpan"])) {
			date_default_timezone_set("Asia/Jakarta");
			$tgl   = date("Y/m/d H:i:s");
			$user  = $this->input->post("user");
			$pwd   = $this->input->post("pwd");
			$nama  = $this->input->post("nama");
			$email = $this->input->post("email");
			$role  = $this->input->post("role");

			if (empty($user) or empty($pwd) or empty($nama) or empty($email) or empty($role)) {
				$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
				redirect(base_url("admin/users/add"));
			} else {

				// Validasi data
				$this->db->from("users");
				$this->db->group_start();
					$this->db->where("username", $user);
					$this->db->or_where("nama", $nama);
					$this->db->or_where("email", $email);
				$this->db->group_end();

				$cekAkun = $this->db->get();

				if ($cekAkun->num_rows() < 1) {
					$data = [
						"username"   => $user,
						"password"   => $pwd,
						"nama"	     => $nama,
						"email"      => $email,
						"role"	     => $role,
						"status"     => "Active",
						"created_at" => $tgl
					];

					$this->auth->tambahAkun($data);

					$this->session->set_flashdata("success", "Akun berhasil ditambahkan!");
					redirect(base_url("admin/users"));
				} else {
					$this->session->set_flashdata("msg", "Akun tersebut sudah ada. Silahkan isi data lain!");
					redirect(base_url("admin/users/add"));
				}

			}

		}

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_users_add', $data);
		$this->load->view('admin/_parts/body_html');
	}

	public function detail()
	{

		$id 	 = ["user_id" => $this->uri->segment(4)];
		$cekData = $this->auth->detailAkun($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Detail Akun";
			$data["page"] 	= "users";

			// Load data
			$data["akun"] = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_users_detail', $data);
			$this->load->view('admin/_parts/body_html');
		} else {
			echo '<script>alert("MAAF, AKUN TERSEBUT TIDAK DITEMUKAN !");</script>';
		}

	}

	public function edit()
	{

		$id 	 = ["user_id" => $this->uri->segment(4)];
		$cekData = $this->auth->detailAkun($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Edit Akun";
			$data["page"] 	= "users";

			// Load data
			$data["akun"] = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_users_edit', $data);
			$this->load->view('admin/_parts/body_html');

			// Update data
			if (isset($_POST["ubah"])) {
				$user   = $this->input->post("user");
				$pwd    = $this->input->post("pwd");
				$nama   = $this->input->post("nama");
				$email  = $this->input->post("email");
				$role   = $this->input->post("role");
				$status = $this->input->post("status");

				if ($this->uri->segment(4) != 1) {
					if (empty($user) or empty($pwd) or empty($nama) or empty($email) or empty($role) or empty($status)) {
						$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
						redirect(base_url("admin/users/edit/" . $this->uri->segment(4)));
					}
				} else {
					if (empty($user) or empty($pwd) or empty($nama) or empty($email)) {
						$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
						redirect(base_url("admin/users/edit/" . $this->uri->segment(4)));
					}
				}

				// Validasi data
				$this->db->from("users");
				$this->db->where("user_id !=", $this->uri->segment(4));
				$this->db->group_start();
					$this->db->where("username", $user);
					$this->db->or_where("nama", $nama);
					$this->db->or_where("email", $email);
				$this->db->group_end();

				$cekAkun = $this->db->get();

				if ($cekAkun->num_rows() < 1) {
					
					if($this->uri->segment(4) != 1) {
						$data = [
							"username"   => $user,
							"password"   => $pwd,
							"nama"	     => $nama,
							"email"      => $email,
							"role"	     => $role,
							"status"     => $status
						];
					} else {
						$data = [
							"username"   => $user,
							"password"   => $pwd,
							"nama"	     => $nama,
							"email"      => $email
						];

						$this->session->set_userdata(["admin" => $nama]);

					}

					$this->auth->editAkun($id, $data);
					$this->session->set_flashdata("success", "Akun berhasil diperbarui!");
					redirect(base_url("admin/users"));
					
				} else {
					$this->session->set_flashdata("msg", "Akun tersebut sudah ada. Silahkan isi data lain!");
					redirect(base_url("admin/users/edit/" . $this->uri->segment(4)));
				}

			}

		} else {
			echo '<script>alert("MAAF, AKUN TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/users") .'";</script>';
		}

	}

	public function delete()
	{

		$id 	 = ["user_id" => $this->uri->segment(4)];
		$cekData = $this->auth->detailAkun($id);

		if ($cekData->num_rows() > 0) {
			$this->auth->hapusAkun($id);
			redirect(base_url("admin/users"));
		} else {
			echo '<script>alert("MAAF, AKUN TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/users") .'";</script>';
		}

	}

}
