<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

	public function masukAkun($akun) {
		return $this->db->get_where("users", $akun);
	}

	public function tambahAkun($data) {
		return $this->db->insert("users", $data);
	}

	public function getAkun() {
		return $this->db->order_by("user_id", "DESC")->get("users");
	}

	public function detailAkun($akun) {
		return $this->db->get_where("users", $akun);
	}

	public function editAkun($idnya, $data) {
		return $this->db->where($idnya)->update("users", $data);
	}

	public function hapusAkun($idnya) {
		return $this->db->where($idnya)->delete("users");
	}

}