<?php

Class M_artikel extends CI_Model{

    public function list($id){
        if($id != null){
            $result = $this->db->query("SELECT * FROM tb_artikel WHERE artikel_id = '$id'")->row_array();
        }else{
            $result = $this->db->query("SELECT * FROM tb_artikel")->result_array();
        }
                        
        return $result;
    }

    public function add($data){
        if(! $this->db->insert('tb_artikel', $data)){
            
            return $this->db->error();
        }
    }
}