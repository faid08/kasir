<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mlaporan extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

//----------------------------------------------------- laporan piutang customer
    function laporan_hutang_customer($search, $tglawal, $tglakhir, $toko) {
        $this->db->join('tbcustomer', 'tbcustomer.idcustomer=tbtransaksi_penjualan_customer.idcustomer', 'left');
        $this->db->join('tbmarketing', 'tbmarketing.idmarketing=tbtransaksi_penjualan_customer.idmarketing', 'left');
        if (!isset($search) || !empty($search)) {
            $this->db->group_start();
            $this->db->like('nama_customer', $search, 'both');
            $this->db->or_like('notatransaksi_penjualan_customer', $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by('tanggal', 'DESC');
        $this->db->where('tanggal >=', $tglawal . ' 00:00:00');
        $this->db->where('tanggal <=', $tglakhir . ' 23:59:59');
        $this->db->where('`status_lunas`', 'utang');
        $this->db->where('`status_pending`', 't');
        $this->db->where('`tbtransaksi_penjualan_customer.idtoko`', $toko);
        $this->db->from('tbtransaksi_penjualan_customer');
        $query = $this->db->get();
        return $query->result();
    }
    function laporan_hutang_suplayer($search, $tglawal, $tglakhir, $toko) {
        $this->db->join('tbsuplayer', 'tbsuplayer.idsuplayer=tbtransaksi_kulakan.idsuplayer', 'left');
        if (!isset($search) || !empty($search)) {
            $this->db->group_start();
            $this->db->like('nama_suplayer', $search, 'both');
            $this->db->or_like('notatransaksi_kulakan', $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by('tanggal', 'DESC');
        $this->db->where('tanggal >=', $tglawal . ' 00:00:00');
        $this->db->where('tanggal <=', $tglakhir . ' 23:59:59');
        $this->db->where('`status_lunas`', 'utang');
        $this->db->where('`status_pending`', 't');
        $this->db->where('`tbtransaksi_kulakan.idtoko`', $toko);
        $this->db->from('tbtransaksi_kulakan');
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

    public function nota_penjulan_suplayer($id) {
        $this->db->join('tbuser', 'tbuser.iduser=tbtransaksi_kulakan.iduser', 'left');
        $this->db->join('tbsuplayer', 'tbsuplayer.idsuplayer =tbtransaksi_kulakan.idsuplayer', 'left');
        $this->db->where('notatransaksi_kulakan', $id);
        $this->db->from('tbtransaksi_kulakan');
        $query = $this->db->get();
        return $query->row();
    }
    public function nota_penjulan_customerhistory($id) {
        $this->db->join('tbuser', 'tbuser.iduser=tbtransaksi_penjualan_customer.iduser', 'left');
        $this->db->join('tbcustomer', 'tbcustomer.idcustomer=tbtransaksi_penjualan_customer.idcustomer', 'left');
        $this->db->join('tbmarketing', 'tbmarketing.idmarketing=tbtransaksi_penjualan_customer.idmarketing', 'left');
        $this->db->where('notatransaksi_penjualan_customer', $id);
        $this->db->from('tbtransaksi_penjualan_customer');
        $query = $this->db->get();
        return $query->row();
    }

    public function nota_penjulan_customerhistory_suplayer($id) {
        $this->db->join('tbuser', 'tbuser.iduser=tbtransaksi_kulakan.iduser', 'left');
        $this->db->join('tbsuplayer', 'tbsuplayer.idsuplayer=tbtransaksi_kulakan.idsuplayer', 'left');
        $this->db->where('notatransaksi_kulakan', $id);
        $this->db->from('tbtransaksi_kulakan');
        $query = $this->db->get();
        return $query->row();
    }

    
    public function detail_nota_penjulan_customer($id, $toko) {
        $this->db->join('tbbarang', 'tbbarang.idbarang=tbdetailtransaksi_penjualan_customer.idbarang');
        $this->db->join('tbstock', 'tbstock.idbarang=tbbarang.idbarang');
        $this->db->where('notatransaksi_penjualan_customer', $id);
        $this->db->where('`tbstock.idtoko`', $toko);
        $this->db->order_by('iddetailtransaksi_penjualan_customer', 'asc');
         $this->db->group_by('tbbarang.idbarang');
        $this->db->from('tbdetailtransaksi_penjualan_customer');
        $query = $this->db->get();
        return $query->result();
    }

    public function detail_nota_penjulan_suplayer($id, $toko) {
        $this->db->join('tbbarang', 'tbbarang.idbarang=tbdetailtransaksi_kulakan.idbarang');
        $this->db->join('tbstock', 'tbstock.idbarang=tbbarang.idbarang');
        $this->db->where('notatransaksi_kulakan', $id);
        $this->db->where('tbstock.idtoko', $toko);
        $this->db->order_by('iddetailtransaksi_kulakan', 'asc');
         $this->db->group_by('tbbarang.idbarang');
        $this->db->from('tbdetailtransaksi_kulakan');
        $query = $this->db->get();
        return $query->result();
    }

    public function detailhistory_nota_penjulan_customer($id) {
        // $this->db->join('tbhistory_transaksipenjualan_customer', 'tbhistory_transaksipenjualan_customer.notatransaksi_penjualan_customer=tbtransaksi_penjualan_customer.notatransaksi_penjualan_customer');
        // $this->db->where('notatransaksi_penjualan_customer', $id);
        // $this->db->from('tbhistory_transaksipenjualan_customer');
        // $query = $this->db->get();
        // return $query->result();
        $query = $this->db->query("SELECT * FROM `tbhistory_transaksipenjualan_customer` where`notatransaksi_penjualan_customer`='$id'");
        return $query->result();
    }

    public function detailhistory_nota_penjulan_suplayer($id) {
        // $this->db->join('tbhistory_transaksipenjualan_customer', 'tbhistory_transaksipenjualan_customer.notatransaksi_penjualan_customer=tbtransaksi_penjualan_customer.notatransaksi_penjualan_customer');
        // $this->db->where('notatransaksi_penjualan_customer', $id);
        // $this->db->from('tbhistory_transaksipenjualan_customer');
        // $query = $this->db->get();
        // return $query->result();
        $query = $this->db->query("SELECT * FROM `tbhistory_transaksipenjualan_customer` where`notatransaksi_penjualan_customer`='$id'");
        return $query->result();
    }
    
    public function update_penjualan($id, $data) {
        return $this->db->update('tbtransaksi_penjualan_customer', $data, $id);
    }
    public function update_penjualan_suplayer($id, $data) {
        return $this->db->update('tbtransaksi_kulakan', $data, $id);
    }
    //------------------------------------------------------------ laporan moset
    public function laporan_omset($search, $tglawal, $tglakhir, $toko, $baris) {
        $this->db->join('tbuser', 'tbuser.iduser=tbtransaksi_penjualan_customer.iduser', 'left');
        $this->db->join('tbcustomer', 'tbcustomer.idcustomer=tbtransaksi_penjualan_customer.idcustomer', 'left');
        $this->db->join('tbmarketing', 'tbmarketing.idmarketing=tbtransaksi_penjualan_customer.idmarketing', 'left');
        if (!isset($search) || !empty($search)) {
            $this->db->group_start();
            $this->db->like('nama_marketing', $search, 'both');
            $this->db->or_like('nama_customer', $search, 'both');
            $this->db->or_like('nama', $search, 'both');
            $this->db->or_like('jenis_harga_penjualan', $search, 'both');
            $this->db->or_like('notatransaksi_penjualan_customer', $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by('tanggal', 'DESC');
        $this->db->where('tanggal >=', $tglawal . ' 00:00:00');
        $this->db->where('tanggal <=', $tglakhir . ' 23:59:59');
        $this->db->where('`status_pending`', 't');
        if ($baris != 'all') {
            $this->db->limit($baris);
        }
        $this->db->where('`tbtransaksi_penjualan_customer.idtoko`', $toko);
        $this->db->from('tbtransaksi_penjualan_customer');
        $query = $this->db->get();
        return $query->result();
    }

	public function laporan_history_pengajuan( $tglawal, $tglakhir, $toko, $baris) {
        $this->db->join('tbuser', 'tbuser.iduser=tbtransaksi_pengajuan_stcck.iduser', 'left');    
        $this->db->order_by('tanggal', 'DESC');
        $this->db->where('tanggal >=', $tglawal . ' 00:00:00');
        $this->db->where('tanggal <=', $tglakhir . ' 23:59:59');
        if ($baris != 'all') {
            $this->db->limit($baris);
        }
        $this->db->where('tbtransaksi_pengajuan_stcck.idtoko', $toko);
        $this->db->from('tbtransaksi_pengajuan_stcck');
        $query = $this->db->get();
        return $query->result();
    }

//    public function sum_total_penjualan($search, $tglawal, $tglakhir, $toko) {
//        $this->db->join('tbmarketing', 'tbmarketing.idmarketing=tbtransaksi_penjualan_customer.idmarketing', 'left');
//        if (!isset($search) || !empty($search)) {
//            $this->db->group_start();
//            $this->db->like('nama_marketing', $search, 'both');
//            $this->db->or_like('nama_customer', $search, 'both');
//            $this->db->or_like('nama', $search, 'both');
//            $this->db->or_like('jenis_harga_penjualan', $search, 'both');
//            $this->db->or_like('notatransaksi_penjualan_customer', $search, 'both');
//            $this->db->group_end();
//        }
//        $this->db->where('tanggal >=', $tglawal . ' 00:00:00');
//        $this->db->where('tanggal <=', $tglakhir . ' 23:59:59');
//        $this->db->where('`tbtransaksi_penjualan_customer.idtoko`', $toko);
//        $this->db->where('`status_pending`', 't');
//        $this->db->select_sum('totalbayar');
//        $this->db->select_sum('ongkir');
//        $query = $this->db->get('tbtransaksi_penjualan_customer');
//        return $query->row();
//    }

//------------------------------------------------------------ laporan income
    public function laporan_income($search, $tglawal, $tglakhir, $toko, $baris) {
        $this->db->join('tbuser', 'tbuser.iduser=tbtransaksi_penjualan_customer.iduser', 'left');
        $this->db->join('tbcustomer', 'tbcustomer.idcustomer=tbtransaksi_penjualan_customer.idcustomer', 'left');
        $this->db->join('tbmarketing', 'tbmarketing.idmarketing=tbtransaksi_penjualan_customer.idmarketing', 'left');
        if (!isset($search) || !empty($search)) {
            $this->db->group_start();
            $this->db->like('nama_marketing', $search, 'both');
            $this->db->or_like('nama_customer', $search, 'both');
            $this->db->or_like('nama', $search, 'both');
            $this->db->or_like('jenis_harga_penjualan', $search, 'both');
            $this->db->or_like('notatransaksi_penjualan_customer', $search, 'both');
            $this->db->group_end();
        }
        $this->db->order_by('tanggal', 'DESC');
        $this->db->where('tanggal >=', $tglawal . ' 00:00:00');
        $this->db->where('tanggal <=', $tglakhir . ' 23:59:59');
        $this->db->where('`status_pending`', 't');
        if ($baris != 'all') {
            $this->db->limit($baris);
        }
        $this->db->where('`tbtransaksi_penjualan_customer.idtoko`', $toko);
        $this->db->from('tbtransaksi_penjualan_customer');
        $query = $this->db->get();
        return $query->result();
    }

    public function total_laba($nota) {
        $this->db->select_sum('laba');
        $this->db->where('notatransaksi_penjualan_customer', $nota);
        return $this->db->get('tbdetailtransaksi_penjualan_customer')->row_array();
    }

//    public function sum_total_laba($search, $tglawal, $tglakhir, $toko) {
//        $this->db->join('tbtransaksi_penjualan_customer', 'tbtransaksi_penjualan_customer.notatransaksi_penjualan_customer=tbdetailtransaksi_penjualan_customer.notatransaksi_penjualan_customer', 'left');
//        $this->db->join('tbcustomer', 'tbcustomer.idcustomer=tbtransaksi_penjualan_customer.idcustomer', 'left');
//        $this->db->join('tbmarketing', 'tbmarketing.idmarketing=tbtransaksi_penjualan_customer.idmarketing', 'left');
//        if (!isset($search) || !empty($search)) {
//            $this->db->group_start();
//            $this->db->like('nama_marketing', $search, 'both');
//            $this->db->or_like('tbtransaksi_penjualan_customer.notatransaksi_penjualan_customer', $search, 'both');
//            $this->db->group_end();
//        }
//        $this->db->where('tanggal >=', $tglawal . ' 00:00:00');
//        $this->db->where('tanggal <=', $tglakhir . ' 23:59:59');
//        $this->db->where('`tbtransaksi_penjualan_customer.idtoko`', $toko);
//        $this->db->where('`status_pending`', 't');
//        $this->db->select_sum('laba');
//        $query = $this->db->get('tbdetailtransaksi_penjualan_customer');
//        return $query->row();
//    }
}
