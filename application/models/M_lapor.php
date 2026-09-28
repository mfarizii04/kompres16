<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_lapor extends CI_Model {

	// public function getData()
	// {
	// 	return $this->db->order_by("lapor_id", "DESC")->get("laporan");
	// }

	public function getData()
	{
		$this->db->select('*');
		$this->db->from('laporan');

		$this->db->order_by("FIELD(status, 'Belum dibaca', 'Sedang diproses', 'Selesai')", '', FALSE);
		$this->db->order_by("FIELD(priority, 'Urgent', 'High', 'Medium', 'Low')", '', FALSE);
		$this->db->order_by("FIELD(lapor_id, 'DESC')", '', FALSE);

		return $this->db->get();
	}

	public function tambahData($data)
	{
		return $this->db->insert("laporan", $data);
	}

	public function responLaporan($data, $where)
	{
		return $this->db->where($where)->update("laporan", $data);
	}

	public function detailData($id)
	{
		return $this->db->get_where("laporan", $id);
	}

	public function updateData($id, $data)
	{
		return $this->db->where($id)->update("laporan", $data);
	}

	public function hapusData($id)
	{
		return $this->db->where($id)->delete("laporan");
	}

	public function cekLaporanAtmin()
	{
		return $this->db->limit(5)->order_by("lapor_id", "DESC")->get_where("laporan", ["status" => "Belum dibaca"]);
	}

}