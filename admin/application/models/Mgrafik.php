<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mgrafik extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function jmlbarang() {
        return $this->db->count_all_results('tbbarang');
    }
    public function jmlpengeluaran() {
        return $this->db->count_all_results('tbpengeluaran');
    }
    public function jmlpengeluarankasir($idtoko) {
        $query=$this->db->query("SELECT * FROM tbpengeluaran where idtoko='$idtoko'");
        return $query->num_rows();

    }

    public function jmlcustomer() {
//        $this->db->whereNotIn('idcustomer','555');
        return $this->db->count_all_results('tbcustomer');
    }

    public function jmlsuplayer() {
        return $this->db->count_all_results('tbsuplayer');
    }

    public function jmlmarketing() {
        return $this->db->count_all_results('tbmarketing');
    }

    public function jmlpetugas() {
        return $this->db->count_all_results('tbuser');
    }
    public function jmltoko() {
        return $this->db->count_all_results('tbtoko');
    }
    public function jmltokokasir($idtoko) {
        $query=$this->db->query("SELECT * FROM tbtoko where idtoko='$idtoko'");
        return $query->num_rows();

    }

    public function trenbarang() {
        $query = $this->db->query('SELECT tbbarang.nama_barang,sum(tbstock.stock) as jml from tbdetailtransaksi_penjualan_customer,tbbarang,tbstock where tbbarang.idbarang=tbdetailtransaksi_penjualan_customer.idbarang and tbstock.idbarang=tbbarang.idbarang GROUP BY tbdetailtransaksi_penjualan_customer.idbarang ORDER BY jml desc LIMIT 10');
        // $query = $this->db->select("tbbarang.idbarang,tbbarang.idjenisbrg,tbbarang.isibarang ,tbbarang.barcode,tbbarang.nama_barang, tbharga.hargabeli, tbharga.hecer1, tbharga.hecer2, tbharga.hgrosir1, tbharga.hgrosir2, tbharga.hgrosir3, tbbarang.hpromo, tbbarang.tanggalpromo, tbbarang.statuspromo, tbbarang.statusbarang, tbstock.idbarang,tbstock.idtoko,tbharga.idbarang,tbharga.idtoko,sum(tbstock.stock) as jml");
        return $query->result();
    }
    public function jmlhistorystock() {
        return $this->db->count_all_results('tbstock');
    }

    public function cusloyal() {
        $query = $this->db->query('SELECT nama_customer,COUNT(tbtransaksi_penjualan_customer.idcustomer) as jml from tbtransaksi_penjualan_customer,tbcustomer WHERE tbcustomer.nama_customer<>"person" and tbcustomer.idcustomer=tbtransaksi_penjualan_customer.idcustomer GROUP BY tbtransaksi_penjualan_customer.idcustomer  ORDER BY jml desc LIMIT 5');
        return $query->result();
    }

    public function progres_keaktifan_all() {
        return $this->db->count_all_results('tbtransaksi_penjualan_customer');
    }

    public function progres_keaktifan_per_user($id) {
        $this->db->select('count(iduser) as jum_per_user FROM `tbtransaksi_penjualan_customer` WHERE iduser="' . $id . '"');
        $query = $this->db->get();
        return $query->row();
    }
    public function grafik_pertahun_omset() {
        $this->db->select("CONCAT((MONTH(tanggal)),'-',(YEAR(tanggal))) as bulan");
        $this->db->select("sum(totalbayar) AS omset");
        $this->db->group_by("YEAR(tanggal),MONTH(tanggal)");
        $this->db->from('tbtransaksi_penjualan_customer');
        $this->db->where('status_pending', "t");
        $query = $this->db->get();
        return $query->result();
    }
       public function grafik_pertahun_income() {
         $this->db->join('tbdetailtransaksi_penjualan_customer', 'tbdetailtransaksi_penjualan_customer.notatransaksi_penjualan_customer=tbtransaksi_penjualan_customer.notatransaksi_penjualan_customer', 'left');
        $this->db->select("CONCAT((MONTH(tanggal)),'-',(YEAR(tanggal))) as bulan");
        $this->db->select("sum(laba) AS income");
        $this->db->group_by("YEAR(tanggal),MONTH(tanggal)");
        $this->db->from('tbtransaksi_penjualan_customer');
        $this->db->where('status_pending', "t");
        $query = $this->db->get();
        return $query->result();
    }

}
