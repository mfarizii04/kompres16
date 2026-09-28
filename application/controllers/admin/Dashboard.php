<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->model('admin/M_dashboard', 'dash');
		$this->load->model('M_aplikasi', 'aplikasi');
		$this->load->model('M_activity', 'activity');
		$this->load->model('M_lapor', 'lapor');

		if (!$this->session->userdata("admin")) {
			redirect(base_url("auth/admin/login"));
		}

	}

	public function index()
	{
		
		// Load helper kalender
		$this->load->helper('kalender');
		$data["waktu"] = getWaktuLokal();

		// Load data
		$data["page"] 		  = "dashboard";
		$data["countLaporan"] = $this->dash->countLaporan()->num_rows();
		$data["countSSL"]     = $this->dash->countSSLExpired()->num_rows();
		$data["countLog"]     = $this->dash->countLog()->num_rows();
		$data["reminderSSL"]  = $this->aplikasi->reminderSSLExpired();
		$data["logActivity"]  = $this->activity->logActivity();
		$data["laporAtmin"]	  = $this->lapor->cekLaporanAtmin();

		// Render page
		$title["title"] = "Dashboard";
		$this->load->view('admin/_parts/doctype_html', $title);
		$this->load->view('admin/v_dashboard', $data);
		$this->load->view('admin/_parts/body_html');

		// Perpanjang SSL Aplikasi
		if (isset($_POST["extend"])) {

			date_default_timezone_set("Asia/Jakarta");
			$tgl 	     = date("Y-m-d H:i:s");
			$id          = $this->input->post("id_aplikasi");
			$tgl_expired = date("Y-m-d", strtotime($this->input->post("tgl_expired")));

			if (empty($tgl_expired)) {
				$this->session->set_flashdata("msg", "Silahkan pilih tanggal kadaluwarsa SSL aplikasi terlebih dahulu!");
				redirect(base_url("admin/dashboard"));
			} else {

				// Get id user
				$sesAkun = $this->session->userdata("admin");
				$id_user = $this->db->get_where("users", ["nama" => $sesAkun])->row()->user_id;

				// Cek alamat IP
				$ip_user = $this->input->ip_address();

				if ($ip_user == "::1") {
					$ip_user = "127.0.0.1";
				}

				// Data aplikasi
				$data = [
					"ssl_expired" => $tgl_expired
				];

				// Data activity
				$namaAplikasi = $this->db->get_where("aplikasi", ["aplikasi_id" => $id])->row()->nama;
				$dataActivity = [
					"created_at" => $tgl,
					"user_id"    => $id_user,
					"modul"		 => "Aplikasi",
					"aktivitas"  => "[Ubah data] Admin memperpanjang kadaluwarsa SSL aplikasi baru: [" . $namaAplikasi . "]",
					"ip_user" 	 => $ip_user,
					"status"	 => "success"
				];

				$this->activity->tambahData($dataActivity);
				$this->aplikasi->updateData($id, $data);
				
				$this->session->set_flashdata("success", "SSL Aplikasi berhasil diperpanjang!");
				redirect(base_url("admin/dashboard"));
			}

		}

	}

}
