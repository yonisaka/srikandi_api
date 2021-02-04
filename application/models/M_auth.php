<?php

Class M_auth extends CI_Model {
    public function get_user($where){
        $query = $this->db->query('SELECT * FROM user', $where)->row_array();
        return $query;
        // return $this->db->get_where('user', $where)->row_array();
    }
}