<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_activity extends CI_Model {

	public function getData()
	{
		return $this->db->order_by("log_id", "DESC")->get("activity_log");
	}

	public function getDataStaff($id_akun)
	{
		return $this->db->order_by("log_id", "DESC")->get_where("activity_log", ["user_id" => $id_akun]);
	}

	public function tambahData($data)
	{
		return $this->db->insert("activity_log", $data);
	}

	public function detailData($id)
	{
		$this->db->select("activity_log.*, users.nama");
		$this->db->from("activity_log");
		$this->db->join("users", "users.user_id = activity_log.user_id", "left");
		$this->db->where($id);
		return $this->db->get();
	}

	public function logActivity()
	{
		return $this->db->limit(5)->order_by("log_id", "DESC")->get("activity_log");
	}

}