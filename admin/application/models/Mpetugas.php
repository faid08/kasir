<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mpetugas extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function login($data) {

        $condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $data['password'] . "'";
        $this->db->select('*');
        $this->db->from('tbuser');
        $this->db->where($condition);
        $this->db->where('statususer','aktif');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function read_user_information($username) {
        $condition = "username =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('tbuser');
        $this->db->where($condition);        
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function detailuser($id) {

        $condition = "iduser =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('tbuser');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

}
