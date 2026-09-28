<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_akun extends CI_Model {

	public function getData()
	{
		return $this->db->order_by("username", "ASC")->get("accounts");
	}

	public function tambahData($data)
	{
		return $this->db->insert("accounts", $data);
	}

	public function detailData($id)
	{
		return $this->db->get_where("accounts", $id);
	}

	public function updateData($id, $data)
	{
		return $this->db->where($id)->update("accounts", $data);
	}

	public function hapusData($id)
	{
		return $this->db->where($id)->delete("accounts");
	}

	public function getFromServer($id)
	{
		$this->db->select("accounts.*, servers.server_id");
		$this->db->from("accounts");
		$this->db->join("servers", "servers.server_id = accounts.server_id", "left");
		$this->db->where(["servers.server_id" => $id]);

		return $this->db->get();
	}

	public function getMapAcc()
	{
		$list = $this->db->select("account_id, username")->get("accounts")->result();
		$map  = [];
		foreach ($list as $s) {
			$map[strtolower(trim($s->username))] = $s->account_id;
		}
		return $map;
	}

}