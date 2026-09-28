<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

	public function countLaporan()
	{
		return $this->db->get_where("laporan", ["status" => "Belum dibaca"]);
	}

	public function countSSLExpired()
	{
		date_default_timezone_set("Asia/Jakarta");
		$tgl = date("Y-m-d H:i:s");

		return $this->db
		 	   ->from("aplikasi")
			   ->where("ssl_expired <=", $tgl)
			   ->get();
	}

	public function countLog()
	{
		return $this->db->get("activity_log");
	}

}