<?php

Class M_remaja extends CI_Model{

    public function insert_user($data){
        $this->db->insert('tb_user', $data);
            
        return $this->db->insert_id();
    }

    public function insert_remaja($data){
        $this->db->insert('tb_remaja', $data);

        return $this->db->insert_id();
    }

    public function insert_konsultasi($data){
        if(! $this->db->insert('tb_konsultasi', $data)){

            return $this->db->error();
        }
    }

    public function list($id){
        if($id != null){
            $result = $this->db->query("SELECT * FROM tb_remaja WHERE pasien_id = '$id'")->row_array();
        }else{
            $result = $this->db->query("SELECT * FROM tb_remaja a INNER JOIN tb_konsultasi b ON a.pasien_id = b.pasien_id")->result_array();
        }
                        
        return $result;
    }
}