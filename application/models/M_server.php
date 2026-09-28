<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_server extends CI_Model {

	public function getData()
	{
		return $this->db->order_by("server_name", "ASC")->get("servers");
	}

	public function tambahData($data)
	{
		return $this->db->insert("servers", $data);
	}

	public function detailData($id)
	{
		return $this->db->get_where("servers", $id);
	}

	public function updateData($id, $data)
	{
		return $this->db->where($id)->update("servers", $data);
	}

	public function hapusData($id)
	{
		return $this->db->where($id)->delete("servers");
	}

	public function getMapServer()
	{
		$list = $this->db->select("server_id, server_name")->get("servers")->result();
		$map  = [];
		foreach ($list as $s) {
			$map[strtolower(trim($s->server_name))] = $s->server_id;
		}
		return $map;
	}

}