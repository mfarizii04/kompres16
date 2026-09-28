<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_aplikasi extends CI_Model {

	public function getData()
	{
		$this->db->select("aplikasi.*, DATEDIFF(ssl_expired, NOW()) AS sisa_hari, servers.server_id, servers.server_name, accounts.account_id, accounts.username, os.os_id, os.os_name, db.db_id, db.db_name");
		$this->db->from("aplikasi");
		$this->db->join("servers", "servers.server_id = aplikasi.server_id", "left");
		$this->db->join("accounts", "accounts.account_id = aplikasi.account_id", "left");
		$this->db->join("os", "os.os_id = aplikasi.os_id", "left");
		$this->db->join("db", "db.db_id = aplikasi.db_id", "left");

		return $this->db->get();
	}

	public function tambahData($data)
	{
		return $this->db->insert("aplikasi", $data);
	}

	public function detailData($id)
	{
		$this->db->select("aplikasi.*, DATEDIFF(ssl_expired, NOW()) AS sisa_hari, servers.server_id, servers.server_name, accounts.account_id, accounts.username, os.os_id, os.os_name, db.db_id, db.db_name");
		$this->db->from("aplikasi");
		$this->db->join("servers", "servers.server_id = aplikasi.server_id", "left");
		$this->db->join("accounts", "accounts.account_id = aplikasi.account_id", "left");
		$this->db->join("os", "os.os_id = aplikasi.os_id", "left");
		$this->db->join("db", "db.db_id = aplikasi.db_id", "left");
		$this->db->where(["aplikasi.aplikasi_id" => $id]);

		return $this->db->get();

	}

	public function updateData($id, $data)
	{
		return $this->db->where(["aplikasi_id" => $id])->update("aplikasi", $data);
	}

	public function hapusData($id)
	{
		return $this->db->where(["aplikasi_id" => $id])->delete("aplikasi");
	}

	public function cekSSLExpired()
	{
		date_default_timezone_set("Asia/Jakarta");
		$tgl = date("Y-m-d 00:00:00");
		return $this->db->get_where("aplikasi", ["ssl_expired" => $tgl]);
	}

	public function reminderSSLExpired()
	{
		$this->db->select('*, DATEDIFF(ssl_expired, NOW()) AS sisa_hari');
		$this->db->from('aplikasi');
		$this->db->where('DATEDIFF(ssl_expired, NOW()) <= ', 90);
		$this->db->order_by('sisa_hari', 'ASC');
		return $this->db->get();
	}

}