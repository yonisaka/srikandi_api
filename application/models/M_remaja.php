<?php

Class M_remaja extends CI_Model{

    public function insert_user($data){
        $this->db->insert('tb_user', $data);
            
        return $this->db->insert_id();
    }

    public function insert_remaja($data){
        if(! $this->db->insert('tb_remaja', $data)){

            return $this->db->error();
        }
    }

    public function list($id){
        if($id != null){
            $result = $this->db->query("SELECT * FROM tb_remaja WHERE pasien_id = '$id'")->row_array();
        }else{
            $result = $this->db->query("SELECT * FROM tb_remaja")->result_array();
        }
                        
        return $result;
    }
}