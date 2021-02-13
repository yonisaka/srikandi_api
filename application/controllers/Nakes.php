<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Nakes extends RestController {
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('M_nakes');
        Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
    }

    public function add_post(){
        // user
        $nama = $this->post('user_nama');
        $email = $this->post('user_mail');
        $password = $this->post('user_password');
        $role = 'dokter';
        // nakes
        $nakes_jenis = $this->post('nakes_jenis');
        $nakes_alamat = $this->post('nakes_alamat');
        $nakes_telp = $this->post('nakes_telp');
        $umur = $this->post('umur');
        
        $data = array(
            'username' => $nama,
            'user_mail' => $email,
            'password' => md5($password),
            'role' => $role,
            'mdd' => date('Y-m-d H:i:s')
        );

        $user = $this->M_nakes->insert_user($data);
        
        $data = array(
            'user_id' => $user,
            'nakes_jenis' => $nakes_jenis,
            'nakes_nama' => $nama,
            'nakes_alamat' => $nakes_alamat,
            'nakes_telp' => $nakes_telp,
            'umur' => $nakes_telp,
            'mdd' => date('Y-m-d H:i:s')
        );
        
        $response = $this->M_nakes->insert_nakes($data);

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
}