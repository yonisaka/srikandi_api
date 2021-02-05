<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Auth extends RestController {
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('M_auth');
        $this->load->model('M_videos');
        Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
    }

    public function login_post(){
        $email = $this->post('user_mail');
        $password = $this->post('user_password');
        $user_role = $this->post('user_role');

        $where = array(
            'user_mail' => $email,
            'password' => md5($password),
            'role' => $user_role
            );

        $result = $this->M_auth->get_user($where)->row_array();
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

    public function addVideo_post(){
        $judul = $this->post('video_judul');
        $mdb = $this->post('mdb');
        $mdb_name = $this->post('mdb_name');
        
        $config['upload_path']          = './assets/videos';
        $config['allowed_types']        = 'mp4|mkv|3gp';
        $config['max_size']             = 100000;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->response(
                [
                'status' => false,
                'result' => $error
                ]
            );
        }else{  
            $upload_data = array('upload_data' => $this->upload->data());
            $filename = $upload_data['upload_data']['file_name'];
            $data = array(
                'video_judul' => $judul,
                'video_filename' => $filename,
                'video_filepath' => base_url('assets/videos').$filename,
                'mdb' => $mdb,
                'mdb_name' => $mdb_name
            );
            $response = $this->M_videos->addVideo($data);
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
}