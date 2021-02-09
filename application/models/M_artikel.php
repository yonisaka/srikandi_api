<?php

Class M_artikel extends CI_Model{

    public function list($id){
        if($id != null){
            $result = $this->db->query("SELECT * FROM tb_artikel WHERE artikel_id = '$id'")->row_array();
        }else{
            $result = $this->db->query("SELECT a.*, CONCAT(SUBSTRING(artikel_isi, 1, 40), '...') AS isi_ringkas FROM tb_artikel a")->result_array();
        }
                        
        return $result;
    }

    public function add($data){
        if(! $this->db->insert('tb_artikel', $data)){
            
            return $this->db->error();
        }
    }
}