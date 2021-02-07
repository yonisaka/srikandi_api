<?php

Class M_user extends CI_Model{

    public function list($id){
        if($id != null){
            $result = $this->db->query("SELECT * FROM tb_user WHERE user_id = '$id'")->row_array();
        }else{
            $result = $this->db->query("SELECT * FROM tb_user")->result_array();
        }
                        
        return $result;
    }

    public function add($data){
        if(! $this->db->insert('tb_user', $data)){
            
            return $this->db->error();
        }
    }

    public function login($where){
        
        return $this->db->get_where('users',$where);
    }
}