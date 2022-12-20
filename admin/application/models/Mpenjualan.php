<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mpenjualan extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function nota_terakhir_penjualan($idptgs) {
        $query = $this->db->query('SELECT * FROM `tbtransaksi_penjualan_customer` WHERE iduser="' . $idptgs . '"');
        return $query->result();
    }

	public function nota_terakhir_pengajuan() {
        $query = $this->db->query('SELECT * FROM `tbtransaksi_pengajuan_stcck` ');
        return $query->result();
    }

    public function simpan_transaksi_penjualan_customer($param) {
        return $this->db->insert('tbtransaksi_penjualan_customer', $param);
    }

	public function simpan_transaksi_pengajuan($param) {
        return $this->db->insert('tbtransaksi_pengajuan_stcck', $param);
    }
    public function simpan_historytransaksi_penjualan_customer($param) {
        return $this->db->insert('tbhistory_transaksipenjualan_customer', $param);
    }
   
	public function simpan_detail_transaksi_pengajuan($param) {
        return $this->db->insert_batch(' tbdetailtransaksi_pengajuan_stock', $param);
    }

    public function simpan_detail_transaksi_penjualan_customer($param) {
        return $this->db->insert_batch('tbdetailtransaksi_penjualan_customer', $param);
    }
    public function simpan_data_detail_stock($data_detail_stock) {
        return $this->db->insert_batch('tbstock', $data_detail_stock);
    }

    public function update_stock_barang_ketika_simpan_transaksi($param,$idtoko) {
        $this->db->where('idtoko',$idtoko);
        return $this->db->update_batch('tbstock', $param, 'idbarang');
    }

    public function stock($id) {
        $query = $this->db->query("SELECT stock from `tbstock` where idbarang='$id'");
        return $query->row();
    }

    public function cek_nota_penjulan_customer($id) {
        $this->db->where('notatransaksi_penjualan_customer', $id);
        $this->db->from('tbtransaksi_penjualan_customer');
        $query = $this->db->get();
        return $query->row();
    }

    public function nota_penjulan_customer($id, $jenis_transaksi) {
        if ($jenis_transaksi == "grosir") {
            $this->db->join('tbuser', 'tbuser.iduser=tbtransaksi_penjualan_customer.iduser');
            $this->db->join('tbcustomer', 'tbcustomer.idcustomer=tbtransaksi_penjualan_customer.idcustomer');
            $this->db->join('tbmarketing', 'tbmarketing.idmarketing=tbtransaksi_penjualan_customer.idmarketing');
        }

        $this->db->where('notatransaksi_penjualan_customer', $id);
        $this->db->from('tbtransaksi_penjualan_customer');
        $query = $this->db->get();
        return $query->row();
    }

    public function detail_nota_penjulan_customer($id,$toko) {
        $this->db->join('tbbarang', 'tbbarang.idbarang=tbdetailtransaksi_penjualan_customer.idbarang');
        $this->db->join('tbharga', 'tbharga.idbarang=tbbarang.idbarang');
        $this->db->where('notatransaksi_penjualan_customer', $id);
        $this->db->where('tbharga.idtoko', $toko);
        $this->db->order_by('iddetailtransaksi_penjualan_customer', 'asc'); 
        $this->db->from('tbdetailtransaksi_penjualan_customer');
        $query = $this->db->get();
        return $query->result();
    }

    //----------------end

    public function nota_terakhir($idptgs) {
        $query = $this->db->query('SELECT * FROM `tbtransaksi_penjualan` WHERE iduser="' . $idptgs . '"');
        return $query->result();
    }

    public function simpan_transaksi_penjualan($data_transaksi_penjualan) {
        return $this->db->insert('tbtransaksi_penjualan', $data_transaksi_penjualan);
    }

    public function simpan_detail_transaksi_penjualan($data_detail_penjualan) {
        return $this->db->insert('tbdetailtransaksi_penjualan', $data_detail_penjualan);
    }

    public function nota_penjulan($id) {
        $this->db->join('tbuser', 'tbuser.iduser=tbtransaksi_penjualan.iduser');
        $this->db->where('notatransaksi_penjualan', $id);
        $this->db->from('tbtransaksi_penjualan');
        $query = $this->db->get();
        return $query->row();
    }

    public function detail_nota_penjulan($id) {
        $this->db->join('tbbarang', 'tbbarang.idbarang=tbdetailtransaksi_penjualan.idbarang');
        $this->db->where('notatransaksi_penjualan', $id);
        $this->db->from('tbdetailtransaksi_penjualan');
        $query = $this->db->get();
        return $query->result();
    }

    public function update_penjualan($id, $data) {
        return $this->db->update('tbtransaksi_penjualan_customer', $data, $id);
    }

    public function delete_detail_penjualan($id) {
        $this->db->where('notatransaksi_penjualan_customer', $id);
        return $this->db->delete('tbdetailtransaksi_penjualan_customer');
    }

}
