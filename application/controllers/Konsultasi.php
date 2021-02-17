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