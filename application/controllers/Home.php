<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		// Load helper kalender
		$this->load->helper('kalender');
		$data["title"] = "Beranda";
		$data["waktu"] = getWaktuLokal();

		$this->load->view('_parts/doctype_html', $data);
		$this->load->view('v_home', $data);
		$this->load->view('_parts/body_html', $data);
	}

}