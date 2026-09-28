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

		if (!$this->session->userdata("admin")) {
			redirect(base_url("auth/admin/login"));
		}

	}

	public function index()
	{

		// Load data
		$title["title"] = "Aplikasi";
		$data["page"]   = "app";

		$data["aplikasi"] = $this->aplikasi->getData();

		// Render page
		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_aplikasi', $data);
		$this->load->view('admin/_parts/body_html');

	}

	public function add()
	{

		// Render page
		$title["title"] = "Tambah Aplikasi";
		$data["page"] 	= "add-app";

		// Load data
		$data["server"] = $this->server->getData();
		$data["acc"] 	= $this->acc->getData();
		$data["db"] 	= $this->debe->getData();
		$data["os"] 	= $this->os->getData();

		// Tambah data
		if (isset($_POST["simpan"])) {
			date_default_timezone_set("Asia/Jakarta");
			$tgl       = date("Y-m-d H:i:s");
			$id_server = $this->input->post("id_server");
			$id_akun   = $this->input->post("id_akun");
			$id_os     = $this->input->post("id_os");
			$id_db     = $this->input->post("id_db");
			$id_key    = $this->input->post("id_key");
			$nama      = $this->input->post("nama");
			$password  = $this->input->post("pwd");
			$ip        = $this->input->post("ip");
			$url   	   = $this->input->post("url");
			$status    = $this->input->post("status");

			if (empty($id_server) or empty($id_akun) or empty($id_os) or empty($id_db) or empty($id_key) or empty($nama) or empty($password) or empty($ip) or empty($url) or empty($status)) {
				$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
				redirect(base_url("admin/aplikasi/add"));
			} else {

				// Validasi data
				$this->db->from("aplikasi");
				$this->db->group_start();
					$this->db->where("nama", $nama);
					$this->db->where("server_id", $id_server);
					$this->db->where("account_id", $id_akun);
					$this->db->where("os_id", $id_os);
					$this->db->where("db_id", $id_server);
				$this->db->group_end();

				$cekData = $this->db->get();

				if ($cekData->num_rows() < 1) {
					$data = [
						"created_at"  => $tgl,
						"server_id"	  => $id_server,
						"account_id"  => $id_akun,
						"os_id"       => $id_os,
						"db_id"		  => $id_db,
						"nama"		  => $nama,
						"id_key"	  => $id_key,
						"password"	  => $password,
						"ip"		  => $ip,
						"url"		  => $url,
						"status"	  => $status
					];

					$this->aplikasi->tambahData($data);

					$this->session->set_flashdata("success", "Data berhasil ditambahkan!");
					redirect(base_url("admin/aplikasi"));
				} else {
					$this->session->set_flashdata("msg", "Nama Aplikasi tersebut sudah ada. Silahkan isi nama aplikasi lain!");
					redirect(base_url("admin/aplikasi/add"));
				}

			}

		}

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_aplikasi_add', $data);
		$this->load->view('admin/_parts/body_html');

	}

	public function detail()
	{

		$id 	 = $this->uri->segment(4);
		$cekData = $this->aplikasi->detailData($id);

		if ($cekData->num_rows() > 0) {
			// Render page
			$title["title"] = "Detail Aplikasi";
			$data["page"] 	= "app";

			// Load data
			$data["app"] = $cekData->row();

			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_aplikasi_detail', $data);
			$this->load->view('admin/_parts/body_html');
		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/aplikasi") .'";</script>';
		}

	}

	public function edit()
	{

		$id 	 = $this->uri->segment(4);
		$cekData = $this->aplikasi->detailData($id);

		if ($cekData->num_rows() > 0) {

			// Load data
			$title["title"] = "Edit Aplikasi";
			$data["page"] 	= "aplikasi";
			$data["app"] 	= $cekData->row();
			$data["server"] = $this->server->getData();
			$data["acc"] 	= $this->acc->getData();
			$data["db"] 	= $this->debe->getData();
			$data["os"] 	= $this->os->getData();

			// Render page
			$this->load->view('admin/_parts/doctype_html', $title);
			$this->load->view('admin/v_aplikasi_edit', $data);
			$this->load->view('admin/_parts/body_html');

			// Update data
			if (isset($_POST["ubah"])) {
				$id_server = $this->input->post("id_server");
				$id_akun   = $this->input->post("id_akun");
				$id_os     = $this->input->post("id_os");
				$id_db     = $this->input->post("id_db");
				$id_key    = $this->input->post("id_key");
				$nama      = $this->input->post("nama");
				$password  = $this->input->post("pwd");
				$ip        = $this->input->post("ip");
				$url   	   = $this->input->post("url");
				$status    = $this->input->post("status");
				
				if (empty($id_server) or empty($id_akun) or empty($id_os) or empty($id_db) or empty($id_key) or empty($nama) or empty($password) or empty($ip) or empty($url) or empty($status)) {
					$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
					redirect(base_url("admin/aplikasi/edit/" . $this->uri->segment(4)));
				} else {

					// Validasi data
					$this->db->from("aplikasi");
					$this->db->where("aplikasi_id !=", $this->uri->segment(4));
					$this->db->group_start();
						$this->db->where("server_id", $id_server);
						$this->db->or_where("account_id", $id_akun);
						$this->db->or_where("os_id", $id_os);
						$this->db->or_where("db_id", $id_db);
						$this->db->or_where("nama", $nama);
					$this->db->group_end();

					$cekData = $this->db->get();

					if ($cekData->num_rows() < 1) {
						
						$data = [
							"server_id"	  => $id_server,
							"account_id"  => $id_akun,
							"os_id"       => $id_os,
							"db_id"		  => $id_db,
							"nama"		  => $nama,
							"id_key"	  => $id_key,
							"password"	  => $password,
							"ip"		  => $ip,
							"url"		  => $url,
							"status"	  => $status
						];

						$this->aplikasi->updateData($id, $data);
						$this->session->set_flashdata("success", "Data berhasil diperbarui!");
						redirect(base_url("admin/aplikasi"));
						
					} else {
						$this->session->set_flashdata("msg", "Nama Aplikasi tersebut sudah ada. Silahkan isi data lain!");
						redirect(base_url("admin/aplikasi/edit/" . $this->uri->segment(4)));
					}

				}

			}

		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/aplikasi") .'";</script>';
		}

	}

	public function delete()
	{

		$id 	 = $this->uri->segment(4);
		$cekData = $this->aplikasi->detailData($id);

		if ($cekData->num_rows() > 0) {
			$this->aplikasi->hapusData($id);
			redirect(base_url("admin/aplikasi"));
		} else {
			echo '<script>alert("MAAF, DATA TERSEBUT TIDAK DITEMUKAN !"); window.location = "'. base_url("admin/aplikasi") .'";</script>';
		}

	}

	public function import()
	{

		// Render page
		$title["title"] = "Import Data dari Excel Aplikasi";
		$data["page"] 	= "add-app";

		// Load data
		$data["server"] = $this->server->getData();
		$data["acc"] 	= $this->acc->getData();
		$data["db"] 	= $this->debe->getData();
		$data["os"] 	= $this->os->getData();

		// Tambah data
		if (isset($_POST["simpan"])) {
			date_default_timezone_set("Asia/Jakarta");
			$tgl       = date("Y-m-d H:i:s");
			$id_server = $this->input->post("id_server");
			$id_akun   = $this->input->post("id_akun");
			$id_os     = $this->input->post("id_os");
			$id_db     = $this->input->post("id_db");
			$id_key    = $this->input->post("id_key");
			$nama      = $this->input->post("nama");
			$password  = $this->input->post("pwd");
			$ip        = $this->input->post("ip");
			$url   	   = $this->input->post("url");
			$status    = $this->input->post("status");

			if (empty($id_server) or empty($id_akun) or empty($id_os) or empty($id_db) or empty($id_key) or empty($nama) or empty($password) or empty($ip) or empty($url) or empty($status)) {
				$this->session->set_flashdata("msg", "Silahkan isi form terlebih dahulu!");
				redirect(base_url("admin/aplikasi/add"));
			} else {

				// Validasi data
				$this->db->from("aplikasi");
				$this->db->group_start();
					$this->db->where("nama", $nama);
					$this->db->where("server_id", $id_server);
					$this->db->where("account_id", $id_akun);
					$this->db->where("os_id", $id_os);
					$this->db->where("db_id", $id_server);
				$this->db->group_end();

				$cekData = $this->db->get();

				if ($cekData->num_rows() < 1) {
					$data = [
						"created_at"  => $tgl,
						"server_id"	  => $id_server,
						"account_id"  => $id_akun,
						"os_id"       => $id_os,
						"db_id"		  => $id_db,
						"nama"		  => $nama,
						"id_key"	  => $id_key,
						"password"	  => $password,
						"ip"		  => $ip,
						"url"		  => $url,
						"status"	  => $status
					];

					$this->aplikasi->tambahData($data);

					$this->session->set_flashdata("success", "Data berhasil ditambahkan!");
					redirect(base_url("admin/aplikasi"));
				} else {
					$this->session->set_flashdata("msg", "Nama Aplikasi tersebut sudah ada. Silahkan isi nama aplikasi lain!");
					redirect(base_url("admin/aplikasi/add"));
				}

			}

		}

		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_aplikasi_add', $data);
		$this->load->view('admin/_parts/body_html');

	}

	public function getAllRelations()
	{

		// Get data
		$id_server = $this->input->post("id_server");

		// Load data
		$data["acc"] = $this->acc->getFromServer($id_server);
		$data["db"]	 = $this->debe->getFromServer($id_server);
		$data["os"]	 = $this->os->getFromServer($id_server);

		// Render page
		$this->load->view("admin/formAplikasi", $data);
	}

}
