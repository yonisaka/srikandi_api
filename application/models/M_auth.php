<?php

Class M_auth extends CI_Model {
    public function get_user($email, $password){
        // $query = $this->db->get_where('tb_user', $where);
        $query = $this->db->query("SELECT a.*, role_id FROM tb_user a
        LEFT JOIN (
            SELECT pasien_id AS role_id, user_id FROM tb_remaja
            UNION ALL
            SELECT nakes_id AS role_id, user_id FROM tb_nakes
        )b ON a.user_id = b.user_id
        WHERE a.user_mail = '$email' AND a.password = '$password'");
        return $query;
    }
}