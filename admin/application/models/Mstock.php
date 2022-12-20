<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mstock extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function cek_ketersediaan_stock($data) {
        $condition = "idbarang =" . "'" . $data['idbarang'] . "' AND " . "idtoko =" . "'" . $data['idtoko'] . "'";
        $this->db->select('*');
        $this->db->from('tbbarang');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function update_pengurangan_stock($data) {
        $condition = "idbarang =" . "'" . $data['idbarang'] . "' AND " . "idtoko =" . "'" . $data['idtoko'] . "'";        
        $this->db->set('stock',$data['stock']);
        $this->db->where($condition);
        return $this->db->update('tbstock');
    }
    public function update_penambahan_stock($data) {
        $condition = "idbarang =" . "'" . $data['idbarang'] . "' AND " . "idtoko =" . "'" . $data['idtoko'] . "'";        
        $this->db->set('stock',$data['stock']);
        $this->db->where($condition);
        return $this->db->update('tbstock');
    }
    public function simpan_stock_baru($data) {
        return $this->db->insert('tbstock', $data);
    }
    public function stock_lama($id, $toko) {
        $query = $this->db->query("SELECT stock from `tbstock` where idbarang='$id' and idtoko='$toko'");
        return $query->row();
    }
}
