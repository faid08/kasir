<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mpembelian extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function nota_terakhir_pembelian($idptgs) {
        $query = $this->db->query('SELECT * FROM `tbtransaksi_kulakan` WHERE iduser="' . $idptgs . '"');
        return $query->result();
    }
    public function simpan_historytransaksi_pembelian_suplayer($param) {
        return $this->db->insert('tbhistory_transaksipenjualan_suplayer', $param);
    }

    public function simpan_data_transaksi_pembelian($data_transaksi_pembelian) {
        return $this->db->insert('tbtransaksi_kulakan', $data_transaksi_pembelian);
    }
    public function simpan_data_detail_transaksi_pembelian($data_detail_transaksi_pembelian) {
        return $this->db->insert_batch('tbdetailtransaksi_kulakan', $data_detail_transaksi_pembelian);
    }
    public function simpan_data_detail_stock($data_detail_stock) {
        return $this->db->insert_batch('tbstock', $data_detail_stock);
    }
    public function update_stock_barang_ketika_simpan_transaksi($param) {
        return $this->db->update_batch('tbstock' , $param , 'idbarang' );
    }
    public function stock($id) {
        $query = $this->db->query("SELECT stock from `tbstock` where idbarang='$id'");
        return $query->row();
    }
    public function barang($id) {
        $query = $this->db->query("SELECT hargabeli from `tbbarang` where idbarang='$id'");
        return $query->row();
    }
    public function update_hargabeli_barang_ketika_simpan_transaksi($harga_beli_baru) {
        return $this->db->update_batch('tbbarang' , $harga_beli_baru , 'idbarang' );
    }
}
