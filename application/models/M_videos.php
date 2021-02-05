<?php

Class M_videos extends CI_Model{

    public function insert($data){
        if(! $this->db->insert('tb_video', $data)){
            return $this->db->error();
        }
    }
}