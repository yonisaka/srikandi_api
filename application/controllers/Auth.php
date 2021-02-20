<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Auth extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('M_auth');
        Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
    }

    public function login_post(){
        $email = $this->post('user_mail');
        $password = $this->post('user_password');

        // $where = array(
        //     'user_mail' => $email,
        //     'password' => md5($password),
        // );

        $result = $this->M_auth->get_user($email, md5($password))->row_array();
        // print_r($result);exit;
        if($result != null){
            $this->response( [
                'status' => true,
                'message' => 'found',
                'data' => $result
            ], 200 );
        }else{
            $this->response( [
                'status' => false,
                'message' => 'No users were found'
            ], 404 );
        }
    }
}