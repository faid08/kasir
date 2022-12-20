<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mjson extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

//----------------------------------------------------------------------- barang
    public function search_barang($nm, $id) {
        $this->db->join('tbstock', 'tbstock.idbarang=tbbarang.idbarang');
        if (!empty($nm) ) {
            $this->db->like('nama_barang', $nm);
            $this->db->order_by('stock', 'ASC');
        } else if (!empty($id))  {
            $this->db->where('idbarang', $id);
        }
        $this->db->from('tbbarang');
        $query = $this->db->get();
        return $query->result();
    }

    public function where_kode_barang($id) {
        $this->db->join('tbstock', 'tbstock.idbarang=tbbarang.idbarang');
        $this->db->where('tbbarang.idbarang', $id);
        $this->db->from('tbbarang');
        $query = $this->db->get();
        return $query->row();
    }

    public function simpan_data_barang($data) {
        $this->db->insert('tbbarang', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    public function simpan_data_barang_stock($data) {
        return $this->db->insert('tbstock', $data);
    }

    public function update_data_barang($id, $data) {
        return $this->db->update('tbbarang', $data, $id);
    }

    public function update_data_stock_barang($id, $data) {
        return $this->db->update('tbstock', $data, $id);
    }

    public function databarang() {
        $query = $this->db->query('SELECT * FROM `tbbarang` JOIN `tbstock` ON `tbstock`.`idbarang`=`tbbarang`.`idbarang`');
        return $query->result();
    }

    function autobarang($nama) {
        $this->db->from('tbbarang');
        $this->db->join('tbstock', 'tbstock.idbarang = tbbarang.idbarang');
        $this->db->order_by('nama_barang', 'ASC');
        $this->db->like('nama_barang', $nama);
        $this->db->limit(5);
        $query = $this->db->get();
        return $query;
    }

    //----------------------------------------------------------------- customer
    public function search_customer($search_customer_by, $filter_nama, $filter_alamat, $fillter_wilayah) {
        $this->db->join('tbmarketing', 'tbmarketing.idmarketing=tbcustomer.idmarketing');
        if ($filter_nama == "Nama") {
            $this->db->like('nama_customer', $search_customer_by);
            $this->db->order_by('nama_customer', 'ASC');
        } else if ($filter_alamat == "Alamat") {
            $this->db->like('alamat_customer', $search_customer_by);
            $this->db->order_by('alamat_customer', 'ASC');
        } else if ($fillter_wilayah == "Wilayah") {
            $this->db->like('wilayah_customer', $search_customer_by);
            $this->db->order_by('wilayah_customer', 'ASC');
        }
        $this->db->limit(10);
        $this->db->from('tbcustomer');
        $query = $this->db->get();
        return $query->result();
    }

    public function where_kode_customer($id) {
        $this->db->join('tbmarketing', 'tbmarketing.idmarketing=tbcustomer.idmarketing');
        $this->db->where('idcustomer', $id);
        $this->db->from('tbcustomer');
        $query = $this->db->get();
        return $query->row();
    }

    public function update_data_customer($id, $data) {
        return $this->db->update('tbcustomer', $data, $id);
    }

    public function simpan_data_customer($data) {
        return $this->db->insert('tbcustomer', $data);
    }

    public function autocustomer() {
        $this->db->from('tbcustomer');
        $this->db->order_by('nama_customer', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    //---------------------------------------------------------------- marketing
    public function search_marketing($search_marketing_by, $filter_nama, $filter_alamat) {
        if ($filter_nama == "Nama") {
            $this->db->like('nama_marketing', $search_marketing_by);
            $this->db->order_by('nama_marketing', 'ASC');
        } else if ($filter_alamat == "Alamat") {
            $this->db->like('alamat_marketing', $search_marketing_by);
            $this->db->order_by('alamat_marketing', 'ASC');
        }
        $this->db->limit(10);
        $this->db->from('tbmarketing');
        $query = $this->db->get();
        return $query->result();
    }

    public function where_kode_marketing($id) {
        $this->db->where('idmarketing', $id);
        $this->db->from('tbmarketing');
        $query = $this->db->get();
        return $query->row();
    }

    public function update_data_marketing($id, $data) {
        return $this->db->update('tbmarketing', $data, $id);
    }

    public function simpan_data_marketing($data) {
        return $this->db->insert('tbmarketing', $data);
    }

    public function automarketing() {
        $this->db->from('tbmarketing');
        $this->db->order_by('nama_marketing', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    //----------------------------------------------------------------- suplayer
    public function search_suplayer($search_suplayer_by, $filter_nama, $filter_alamat) {
        if ($filter_nama == "Nama") {
            $this->db->like('nama_suplayer', $search_suplayer_by);
            $this->db->order_by('nama_suplayer', 'ASC');
        } else if ($filter_alamat == "Alamat") {
            $this->db->like('alamat_suplayer', $search_suplayer_by);
            $this->db->order_by('alamat_suplayer', 'ASC');
        }
        $this->db->limit(10);
        $this->db->from('tbsuplayer');
        $query = $this->db->get();
        return $query->result();
    }

    public function where_kode_suplayer($id) {
        $this->db->where('idsuplayer', $id);
        $this->db->from('tbsuplayer');
        $query = $this->db->get();
        return $query->row();
    }

    public function update_data_suplayer($id, $data) {
        return $this->db->update('tbsuplayer', $data, $id);
    }

    public function simpan_data_suplayer($data) {
        return $this->db->insert('tbsuplayer', $data);
    }

//----------------------------------------------------------------- petugas
    public function search_petugas($search_petugas_by) {
        $this->db->like('nama', $search_petugas_by);
        $this->db->order_by('iduser', 'ASC');
        $this->db->from('tbuser');
        $query = $this->db->get();
        return $query->result();
    }

    public function where_kode_petugas($id) {
        $this->db->where('iduser', $id);
        $this->db->from('tbuser');
        $query = $this->db->get();
        return $query->row();
    }

    public function update_data_petugas($id, $data) {
        return $this->db->update('tbuser', $data, $id);
    }

    public function simpan_data_petugas($data) {
        return $this->db->insert('tbuser', $data);
    }

}
