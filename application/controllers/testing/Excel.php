<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Excel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->load->model('testing/M_excel', 'exc');
    }

    public function index()
    {
        $this->load->view('testing/v_excel');
    }

    public function proses() {
        $file_mimes = ['application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

        if(isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
            $extension = pathinfo($_FILES['upload_file']['name'], PATHINFO_EXTENSION);

            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            
            // $data_import = [];
            
            // // Loop mulai dari baris ke-2 (indeks 1) untuk melewati header
            // for($i = 1; $i < count($sheetData); $i++) {
            //     // Pastikan kolom tidak kosong (opsional)
            //     if(!empty($sheetData[$i][1])) {
            //         $data_import[] = [
            //             'nama'    => $sheetData[$i][1], // Kolom A
            //             'email'   => $sheetData[$i][2], // Kolom B
            //             'telepon' => $sheetData[$i][3], // Kolom C
            //         ];
            //     }
            // }

            $data_import = [];

            $existing_emails = $this->db->select('email')->get('excel')->result_array();
            $existing_emails = array_column($existing_emails, 'email');

            for($i = 1; $i < count($sheetData); $i++) {
                $email_excel = $sheetData[$i][2];

                if(!in_array($email_excel, $existing_emails)) {
                    $data_import[] = [
                        'nama'    => $sheetData[$i][1],
                        'email'   => $email_excel,
                        'telepon' => $sheetData[$i][3],
                    ];
                    
                    $existing_emails[] = $email_excel;
                }
            }

            if(!empty($data_import)) {
                // $this->db->insert_batch('pengguna', $data_import);
                // $this->db->insert_batch('excel', $data_import);

                $this->db->db_debug = FALSE;
                $this->db->insert_batch('excel', $data_import);
                $this->db->db_debug = TRUE;

                echo "Berhasil mengimport " . count($data_import) . " data.";
            } else {
                echo "Tidak ada data yang diimport.";
            }
        } else {
            echo "Format file tidak didukung.";
        }
    }
}