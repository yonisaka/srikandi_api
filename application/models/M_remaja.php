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

        $result = $this->db->query("SELECT *, a.mdd AS tanggal_konsultasi FROM tb_konsultasi a 
        LEFT JOIN tb_remaja b ON a.pasien_id = b.pasien_id
        WHERE a.pasien_id = '$id'
        ORDER BY a.mdd DESC")->result_array();
                        
        return $result;
    }

    public function get_pasien_user($id){

        $result = $this->db->query("SELECT * FROM tb_remaja WHERE user_id = '$id'")->row_array();
                        
        return $result;
    }
}