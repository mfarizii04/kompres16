<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_excel extends CI_Model {

	public function importMassal($data)
	{
		return $this->db->insert_batch($data);
	}

}