<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Konsultasi extends RestController {
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('M_konsultasi');
        Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
    }

    public function add_post(){
        // user
        $pasien_id = $this->post('pasien_id');
        
        $hb = $this->post('pasien_hb');
        $gejala = $this->post('pasien_gejala');
        $js_gejala=json_encode($gejala);

        $data = array(
            'pasien_id' => $pasien_id,
            'pasien_gejala' => $js_gejala,
            'pasien_homoglobin' => $hb,
            'mdd' => date('Y-m-d H:i:s'),
        );
        
        $response = $this->M_konsultasi->insert_konsultasi($data);

        if($response == null){
            $this->response(
                [
                    'status' => true,
                    'result' => "Success"
                ], 200
            );
        }else{
            $this->response(
                [
                    'status' => false,
                    'result' => $response
                ], 200
            );
        }
    }

    public function show_get(){
        $id = $this->input->get('konsultasi_id');
        $response = $this->M_konsultasi->list($id);
        
        if($response){
            $this->response(
                [
                    'status' => true,
                    'result' => $response
                ]
            );
        }else{
            $this->response(
                [
                    'status' => false,
                    'result' => "No Objek Found"
                ]
            );
        }
    }
    
}