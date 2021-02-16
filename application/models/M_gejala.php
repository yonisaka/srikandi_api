<?php

Class M_gejala extends CI_Model{

    public function list(){
        $result = $this->db->query("SELECT * FROM tb_gejala")->result_array();
             
        return $result;
    }
}