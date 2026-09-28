<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_os extends CI_Model {

	public function getData()
	{
		return $this->db->order_by("os_name", "ASC")->get("os");
	}

	public function tambahData($data)
	{
		return $this->db->insert("os", $data);
	}

	public function detailData($id)
	{
		return $this->db->get_where("os", $id);
	}

	public function updateData($id, $data)
	{
		return $this->db->where($id)->update("os", $data);
	}

	public function hapusData($id)
	{
		return $this->db->where($id)->delete("os");
	}

	public function getFromServer($id)
	{
		$this->db->select("os.*, servers.os_id");
		$this->db->from("os");
		$this->db->join("servers", "servers.os_id = os.os_id", "left");
		$this->db->where(["servers.server_id" => $id]);

		return $this->db->get();
	}

	public function getMapOS()
	{
		$list = $this->db->select("os_id, os_name")->get("os")->result();
		$map  = [];
		foreach ($list as $s) {
			$map[strtolower(trim($s->os_name))] = $s->os_id;
		}
		return $map;
	}

}