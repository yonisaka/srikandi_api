<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class User extends RestController {
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('M_user');
        Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
    }

    public function show_get(){
        $id = $this->input->get('user_id');
        $response = $this->M_user->list($id);
        
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

    public function add_post(){

        $nama = $this->post('user_nama');
        $email = $this->post('user_mail');
        $password = $this->post('user_password');
        $role = 2;
        $mdb = $this->post('mdb');
        $mdb_name = $this->post('mdb_name');

        $data = array(
            'username' => $nama,
            'user_mail' => $email,
            'password' => md5($password),
            'role' => $role,
            'mdb' => $mdb,
            'mdb_name' => $mdb_name
        );

        $response = $this->M_user->add($data);
        
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