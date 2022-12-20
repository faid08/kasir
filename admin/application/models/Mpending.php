<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mpending extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function search_data_pending($fnama, $fnota, $search_nota_pending_by,$toko) {
        $this->db->join('tbcustomer', 'tbcustomer.idcustomer=tbtransaksi_penjualan_customer.idcustomer', 'left');
        if ($fnama == "nama") {
            $this->db->like('nama_customer', $search_nota_pending_by);
            $this->db->order_by('nama_customer', 'ASC');
        } else if ($fnota == "nota") {
            $this->db->like('notatransaksi_penjualan_customer', $search_nota_pending_by);
            $this->db->order_by('`tbtransaksi_penjualan_customer`.`tanggal`', 'DESC');
        }
        $this->db->where('`status_pending`', 'y');
        $this->db->where('`tbtransaksi_penjualan_customer.idtoko`', $toko);
        $this->db->from('tbtransaksi_penjualan_customer');
        $query = $this->db->get();
        return $query->result();
    }

    public function nota_penjulan_customer($id) {
        $this->db->join('tbuser', 'tbuser.iduser=tbtransaksi_penjualan_customer.iduser', 'left');
        $this->db->join('tbcustomer', 'tbcustomer.idcustomer=tbtransaksi_penjualan_customer.idcustomer', 'left');
        $this->db->join('tbmarketing', 'tbmarketing.idmarketing=tbtransaksi_penjualan_customer.idmarketing', 'left');
        $this->db->where('notatransaksi_penjualan_customer', $id);
        $this->db->from('tbtransaksi_penjualan_customer');
        $query = $this->db->get();
        return $query->row();
    }

    public function detail_nota_penjulan_customer($id,$toko) {     

        $this->db->join('tbbarang', 'tbbarang.idbarang=tbdetailtransaksi_penjualan_customer.idbarang');
        $this->db->join('tbstock', 'tbstock.idbarang=tbbarang.idbarang');
        $this->db->join('tbharga', 'tbharga.idbarang=tbbarang.idbarang');
        $this->db->where('notatransaksi_penjualan_customer', $id);
        $this->db->where('`tbstock.idtoko`', $toko);
         $this->db->where('tbharga.idtoko', $toko);
        $this->db->group_by('tbstock.idbarang');
        $this->db->order_by('iddetailtransaksi_penjualan_customer', 'asc');
        $this->db->from('tbdetailtransaksi_penjualan_customer');
        $query = $this->db->get();
        return $query->result();
    }

    public function update_penjualan($id, $data) {
        return $this->db->update('tbtransaksi_penjualan_customer', $data, $id);
    }

    public function stock($id) {
        $query = $this->db->query("SELECT stock from `tbstock` where idbarang='$id'");
        return $query->row();
    }
    public function delete_detail_penjualan($id) {
        $this->db->where('notatransaksi_penjualan_customer', $id);
        return $this->db->delete('tbdetailtransaksi_penjualan_customer');
    }
    public function simpan_detail_transaksi_penjualan_customer($param) {
        return $this->db->insert_batch('tbdetailtransaksi_penjualan_customer', $param);
    }
    public function update_stock_barang_ketika_simpan_transaksi($param) {
        return $this->db->update_batch('tbstock', $param, 'idbarang');
    }

}
