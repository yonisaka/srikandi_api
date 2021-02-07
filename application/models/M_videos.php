<?php

Class M_videos extends CI_Model{

    public function list($id){
        if($id != null){
            $result = $this->db->query("SELECT * FROM tb_video WHERE video_id = '$id'")->row_array();
        }else{
            $result = $this->db->query("SELECT * FROM tb_video")->result_array();
        }
                        
        return $result;
    }

    public function add($data){

        if(! $this->db->insert('tb_video', $data)){
            return $this->db->error();
        }
    }
}