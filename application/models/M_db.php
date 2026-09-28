<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_db extends CI_Model {

	public function getData()
	{
		return $this->db->order_by("db_name", "ASC")->get("db");
	}

	public function tambahData($data)
	{
		return $this->db->insert("db", $data);
	}

	public function detailData($id)
	{
		return $this->db->get_where("db", $id);
	}

	public function updateData($id, $data)
	{
		return $this->db->where($id)->update("db", $data);
	}

	public function hapusData($id)
	{
		return $this->db->where($id)->delete("db");
	}

	public function getFromServer($id)
	{
		$this->db->select("db.*, servers.db_id");
		$this->db->from("db");
		$this->db->join("servers", "servers.db_id = db.db_id", "left");
		$this->db->where(["servers.server_id" => $id]);

		return $this->db->get();
	}

	public function getMapDB()
	{
		$list = $this->db->select("db_id, db_name")->get("db")->result();
		$map  = [];
		foreach ($list as $s) {
			$map[strtolower(trim($s->db_name))] = $s->db_id;
		}
		return $map;
	}

}