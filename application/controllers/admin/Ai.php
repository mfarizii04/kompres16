<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('groq_ai');
		$this->load->helper(['form', 'url']);
	}

    public function index()
    {
        redirect(base_url());
    }

	public function generateAjax()
    {

        // Bersihkan buffer agar tidak ada notice/warning PHP yang mencemari output JSON
        if (ob_get_length()) {
            ob_clean();
        }

        // Pastikan request menggunakan metode POST
        if ($this->input->method() !== 'post') {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(405)
                ->set_output(json_encode([
                    'status'  => false,
                    'message' => 'Metode request tidak diizinkan.'
                ]));
        }

        $prompt = trim($this->input->post('prompt', true));

        if (empty($prompt)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status'  => false,
                    'message' => 'Prompt tidak boleh kosong!'
                ]));
        }

        // Tangani kemungkinan library groq_ai belum terload
        if (!isset($this->groq_ai)) {
            $this->load->library('groq_ai');
        }

        try {
            // Eksekusi pemanggilan Groq API
            $result = $this->groq_ai->generate($prompt);

            if (!empty($result['status'])) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode([
                        'status' => true,
                        'reply'  => $result['data']
                    ]));
            } else {
                $errorMsg = isset($result['error']) ? $result['error'] : 'Terjadi kegagalan pada penyedia AI.';
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(500)
                    ->set_output(json_encode([
                        'status'  => false,
                        'message' => $errorMsg
                    ]));
            }
        } catch (Exception $e) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status'  => false,
                    'message' => 'Exception server: ' . $e->getMessage()
                ]));
        }
    }

}