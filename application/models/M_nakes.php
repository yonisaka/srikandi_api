<?php

Class M_nakes extends CI_Model{

    public function insert_user($data){
        $this->db->insert('tb_user', $data);
            
        return $this->db->insert_id();
    }
    
    public function insert_nakes($data){
        if(! $this->db->insert('tb_nakes', $data)){

            return $this->db->error();
        }
    }
}