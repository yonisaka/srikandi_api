<?php

Class M_videos extends CI_Model{

    public function addVideo($data){
        if(! $this->db->insert('tb_video', $data)){
            
            return $this->db->error();
        }
    }
}