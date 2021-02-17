<?php

Class M_konsultasi extends CI_Model{

    public function list($id){
        if($id != null){
            $result = $this->db->query("SELECT a.*, b.*, c.user_mail FROM tb_konsultasi a 
            INNER JOIN tb_remaja b ON a.pasien_id = b.pasien_id 
            INNER JOIN tb_user c ON b.user_id = c.user_id
            WHERE konsultasi_id = '$id'")->row_array();
        }else{
            $result = $this->db->query("SELECT * FROM tb_konsultasi a INNER JOIN tb_remaja b ON a.pasien_id = b.pasien_id")->result_array();
        }
                        
        return $result;
    }
}