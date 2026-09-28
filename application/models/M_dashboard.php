<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

	public function countSA()
	{
		date_default_timezone_set("Asia/Jakarta");
		$tgl = date("Y-m-d");

		return $this->db
		 	   ->from("accounts")
			   ->where("expired_at !=", $tgl)
			   ->get();
	}

	// Laporan Mas Atmin
	public function getLaporan()
	{
		return $this->db->limit(5)->order_by("lapor_id", "DESC")->get("laporan");
	}

	public function countLaporan($id_akun)
	{
		return $this->db->get_where("laporan", ["user_id" => $id_akun]);
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

	public function countLog($id_akun)
	{
		return $this->db->get_where("activity_log", ["user_id" => $id_akun]);
	}

	// public function countServers()
	// {
	// 	return $this->db->get_where("servers", ["status" => "Active"]);
	// }

	// public function countOS()
	// {
	// 	return $this->db->get_where("os", ["status" => "Active"]);
	// }

	// public function countDB()
	// {
	// 	return $this->db->get_where("db", ["status" => "Active"]);
	// }

}