<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Remaja extends RestController {
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('M_remaja');
        $this->load->model('M_auth');
        Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
    }

    public function add_post(){
        // user
        $nama = $this->post('pasien_nama');
        $email = $this->post('pasien_mail');
        $password = $this->post('pasien_password');
        $role = 'pasien';
        // remaja
        $jenis = $this->post('pasien_jenis');
        $alamat = $this->post('pasien_alamat');
        $umur = $this->post('pasien_umur');
        $telp = $this->post('pasien_telp');
        $hb = $this->post('pasien_hb');
        $gejala = $this->post('pasien_gejala');
        $js_gejala=json_encode($gejala);

        $data = array(
            'username' => $nama,
            'user_mail' => $email,
            'password' => md5($password),
            'role' => $role,
            'mdd' => date('Y-m-d H:i:s')
        );

        $user = $this->M_remaja->insert_user($data);

        $where = array(
            'user_mail' => $email,
            'password' => md5($password),
            );

        $getUserid = $this->M_auth->get_user($where)->row_array();
        
        $data = array(
            'user_id' => $getUserid['user_id'],
            'pasien_nama' => $nama,
            'pasien_alamat' => $alamat,
            'pasien_jenis_kelamin' => $jenis,
            'pasien_umur' => $umur,
            // 'pasien_gejala' => $js_gejala,
            // 'pasien_hb' => $hb,
            'pasien_telp' => $telp,
            'mdd' => date('Y-m-d H:i:s')
        );
        
        $remaja = $this->M_remaja->insert_remaja($data);
        
        $data = array(
            'pasien_id' => $remaja,
            'pasien_gejala' => $js_gejala,
            'pasien_homoglobin' => $hb,
            'mdd' => date('Y-m-d H:i:s'),
        );
        
        $response = $this->M_remaja->insert_konsultasi($data);

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

    // public function show_get(){
    //     $id = $this->input->get('pasien_id');
    //     $response = $this->M_remaja->list($id);
        
    //     if($response){
    //         $this->response(
    //             [
    //                 'status' => true,
    //                 'result' => $response
    //             ]
    //         );
    //     }else{
    //         $this->response(
    //             [
    //                 'status' => false,
    //                 'result' => "No Objek Found"
    //             ]
    //         );
    //     }
    // }
    
}