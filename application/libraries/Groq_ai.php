<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groq_ai {

    protected $ci;
    private $api_key;
    private $endpoint = 'https://api.groq.com/openai/v1/chat/completions';

    public function __construct() {
        $this->ci =& get_instance();
        $this->ci->load->config('config');
        $this->api_key = $this->ci->config->item('groq_api_key');
    }

    /**
     * Kirim prompt ke Groq API
     *
     * @param string $prompt
     * @param string|null $model
     * @return array
     */
    public function generate($prompt, $model = null) {
        if (empty($this->api_key)) {
            return ['status' => false, 'error' => 'API Key Groq belum diatur di config.'];
        }

        $chosen_model = $model ? $model : $this->ci->config->item('groq_default_model');

        $payload = [
            'model'    => $chosen_model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Gunakan gaya bahasa santai dan mengalir seperti sedang chatting di WhatsApp. DILARANG menggunakan format Markdown sama sekali: jangan pakai tanda bintang ganda (**), jangan buat tabel garis-garis (|--|), jangan pakai heading (#), dan jangan pakai bullet list yang kaku. Tuliskan jawaban sepenuhnya dalam plain text paragraf biasa. Serta gunakan struktur kalimat dan diksi yang manusiawi, alami, mengalir dan gak dipuitisin supaya tidak robotik.',
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'temperature' => 0.7
        ];

        $ch = curl_init($this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->api_key,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        if ($curl_error) {
            return ['status' => false, 'error' => 'cURL Error: ' . $curl_error];
        }

        $result = json_decode($response, true);

        if ($http_code !== 200) {
            $err_msg = isset($result['error']['message']) ? $result['error']['message'] : 'Gagal memanggil API Groq.';
            return ['status' => false, 'error' => $err_msg];
        }

        return [
            'status' => true,
            'data' => $result['choices'][0]['message']['content']
        ];
    }
}