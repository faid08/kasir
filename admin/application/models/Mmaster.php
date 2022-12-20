<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mmaster extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function toko() {
        $this->db->from('tbtoko');
        $query = $this->db->get();
        return $query->result();
    }
    public function pilihjenisbarang() {
        $this->db->from('tbjenisbarang');
        $query = $this->db->get();
        return $query->result();
    }

    public function search_idtoko($param) {
        $this->db->where('idtoko', $param);
        $query = $this->db->get('tbtoko');
        return $query->row();
    }
    function lihat_bstock($id,$idtoko)
    {
        $query = $this->db->query("SELECT * FROM `tbstock` where`idbarang`='$id' and `idtoko`='$idtoko' ORDER BY idstock DESC");
        return $query->result();
        // $array = array('idbarang' => $id, 'idtoko' => $idtoko);
        // return $this->db->select('SUM(stock) as totalstock')
        //                 ->where('idbarang', $id)
        //                 ->where('idtoko', $idtoko)
        //                 ->get('tbstock');
    }
    function lihat_pengeluaran($idtoko)
    {
        $query = $this->db->query("SELECT * FROM `tbpengeluaran` where `idtoko`='$idtoko' ORDER BY idpengeluaran DESC");
        return $query->result();
        // $array = array('idbarang' => $id, 'idtoko' => $idtoko);
        // return $this->db->select('SUM(stock) as totalstock')
        //                 ->where('idbarang', $id)
        //                 ->where('idtoko', $idtoko)
        //                 ->get('tbstock');
    }
    function tampilstock($id,$idtoko)
    {
        // $query = $this->db->query("SELECT * FROM `tbstock` where`idbarang`='$id' and `idtoko`='$idtoko'");
        // return $query->result();
        // $array = array('idbarang' => $id, 'idtoko' => $idtoko);
        return $this->db->select('SUM(stock) as totalstock')
                        ->where('idbarang', $id)
                        ->where('idtoko', $idtoko)
                        ->get('tbstock');
    }
    function lihat_barang($id)
    {
        return $this->db
            ->select('nama_barang')
            ->where('idbarang', $id)
            ->limit(1)
            ->get('tbbarang');
    }
    function lihat_namatoko($id)
    {
        return $this->db
            ->select('nama')
            ->where('idtoko', $id)
            ->limit(1)
            ->get('tbtoko');
    }


//----------------------------------------------------------------------- barang
public function search_pengajuanbarang() {
	$query = $this->db->query("SELECT tbtoko.idtoko,tbtoko.nama as nama_toko,tbuser.iduser,tbuser.nama as nama_pengaju, tbtransaksi_pengajuan_stcck.notatransaksi_kulakan as no_pengajuan,tbtransaksi_pengajuan_stcck.totalbayar as total_nominal_barang FROM tbdetailtransaksi_pengajuan_stock,tbtransaksi_pengajuan_stcck,tbtoko,tbuser,tbbarang WHERE tbtransaksi_pengajuan_stcck.notatransaksi_kulakan=tbdetailtransaksi_pengajuan_stock.notatransaksi_kulakan AND tbtoko.idtoko=tbtransaksi_pengajuan_stcck.idtoko AND tbuser.iduser=tbtransaksi_pengajuan_stcck.iduser AND tbbarang.idbarang=tbdetailtransaksi_pengajuan_stock.idbarang AND tbtransaksi_pengajuan_stcck.status_pengajuan='baru' GROUP BY tbtoko.idtoko,tbtransaksi_pengajuan_stcck.notatransaksi_kulakan");
    return $query->result();
}

public function list_pengajuanbarang($no_pengajuan) {
	$query = $this->db->query("SELECT tbdetailtransaksi_pengajuan_stock.iddetailtransaksi_kulakan ,tbbarang.idbarang as idb,tbbarang.idbarang,(select sum(tbstock.stock) from tbstock where tbstock.idbarang=idb and tbstock.idtoko ='1') as stock_gudang,tbbarang.nama_barang,tbdetailtransaksi_pengajuan_stock.hargabeli,
		tbdetailtransaksi_pengajuan_stock.jumlah FROM tbdetailtransaksi_pengajuan_stock,tbtransaksi_pengajuan_stcck,tbtoko,tbuser,tbbarang WHERE tbtransaksi_pengajuan_stcck.notatransaksi_kulakan=tbdetailtransaksi_pengajuan_stock.notatransaksi_kulakan AND tbtoko.idtoko=tbtransaksi_pengajuan_stcck.idtoko AND tbtransaksi_pengajuan_stcck.notatransaksi_kulakan='$no_pengajuan' AND tbuser.iduser=tbtransaksi_pengajuan_stcck.iduser AND tbbarang.idbarang=tbdetailtransaksi_pengajuan_stock.idbarang   AND tbtransaksi_pengajuan_stcck.status_pengajuan='baru'");
    return $query->result();
}

public function search_barang($nama_barang, $filter_stock, $toko, $baris) {
        $this->db->select("tbbarang.idbarang,tbbarang.idjenisbrg,tbbarang.isibarang ,tbbarang.barcode,tbbarang.nama_barang, tbharga.hargabeli, tbharga.hecer1, tbharga.hecer2, tbharga.hgrosir1, tbharga.hgrosir2, tbharga.hgrosir3, tbbarang.hpromo, tbbarang.tanggalpromo, tbbarang.statuspromo, tbbarang.statusbarang, tbstock.idbarang,tbstock.idtoko,tbharga.idbarang,tbharga.idtoko,sum(tbstock.stock) as stock");
        $this->db->join('tbstock', 'tbstock.idbarang=tbbarang.idbarang');
        $this->db->join('tbharga', 'tbharga.idbarang=tbbarang.idbarang');
        if (isset($nama_barang) && $filter_stock == "true") {
            $this->db->like('nama_barang', $nama_barang);
            $this->db->order_by('stock', 'ASC');
        } else if ($nama_barang == " " && $filter_stock == "true") {
            $this->db->order_by('stock', 'ASC');
        } else {
            $this->db->like('nama_barang', $nama_barang);
        }
        if ($baris != 'all') {
            $this->db->limit($baris);
        }
        $this->db->where('tbstock.idtoko', $toko);
        $this->db->where('tbharga.idtoko', $toko);
        $this->db->group_by('tbstock.idbarang');
        $this->db->from('tbbarang');

        $query = $this->db->get();
        return $query->result();
    }
    public function search_pengeluaran($nama_pengeluaran, $toko, $baris) {
        if (isset($nama_pengeluaran)) {
            $this->db->like('keterangan', $nama_pengeluaran);
        }
        if ($baris != 'all') {
            $this->db->limit($baris);
        }
        $this->db->where('tbpengeluaran.idtoko', $toko);
        $this->db->from('tbpengeluaran');

        $query = $this->db->get();
        return $query->result();
    }
     public function where_kode_pengeluaran($id) {
        $this->db->where('tbpengeluaran.idpengeluaran', $id);
        $this->db->from('tbpengeluaran');
        $query = $this->db->get();
        return $query->row();
    }

	public function where_kode_pengajuan($id) {
        $this->db->where('tbtransaksi_pengajuan_stcck.notatransaksi_kulakan', $id);
        $this->db->from('tbtransaksi_pengajuan_stcck');
        $query = $this->db->get();
        return $query->row();
    }

    public function where_kode_barang($id,$idtoko) {
        // $this->db->join('tbstock', 'tbstock.idbarang=tbbarang.idbarang');
        $this->db->join('tbharga', 'tbharga.idbarang=tbbarang.idbarang');
        $this->db->where('tbbarang.idbarang', $id);
        $this->db->where('tbharga.idtoko', $idtoko);
        $this->db->from('tbbarang');
        $query = $this->db->get();
        return $query->row();
    }

    public function simpan_data_barang($data) {
        $this->db->insert('tbbarang', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    public function simpan_data_pengeluaran($data) {
        $this->db->insert('tbpengeluaran', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    public function simpan_data_barang_stock($data) {
        return $this->db->insert('tbstock', $data);
    }
    public function simpan_data_barang_harga($data) {
        return $this->db->insert('tbharga', $data);
    }
    public function update_pengajuan_barang($id,) {
        return $this->db->update('tbtransaksi_pengajuan_stcck', array('status_pengajuan' => 'acc'), $id);
    }
	public function update_pengajuan_barang_tolak($id,) {
        return $this->db->update('tbtransaksi_pengajuan_stcck', array('status_pengajuan' => 'tolak'), $id);
    }
	
    public function update_data_barang($id, $data) {
        return $this->db->update('tbbarang', $data, $id);
    }
     public function update_data_pengeluaran($id, $data) {
        return $this->db->update('tbpengeluaran', $data, $id);
    }
    public function update_data_harga($id, $data) {
        return $this->db->update('tbharga', $data, $id);
    }
    function hapus_data_barang($id)
    {
        $tables = array('tbbarang', 'tbstock');
        $this->db->where('idbarang', $id);
        $last_id = $this->db->delete($tables);
       
        return $last_id;
    }

    public function update_data_stock_barang($id, $data) {
        return $this->db->update('tbstock', $data, $id);
    }

    public function databarang() {
        $query = $this->db->query('SELECT * FROM `tbbarang` JOIN `tbstock` ON `tbstock`.`idbarang`=`tbbarang`.`idbarang`');
        return $query->result();
    }
    public function databarangcetak($idtoko) {
        $this->db->select("tbbarang.idbarang,tbbarang.idjenisbrg,tbbarang.isibarang ,tbbarang.barcode,tbbarang.nama_barang, tbharga.hargabeli, tbharga.hecer1, tbharga.hecer2, tbharga.hgrosir1, tbharga.hgrosir2, tbharga.hgrosir3, tbbarang.hpromo, tbbarang.tanggalpromo, tbbarang.statuspromo, tbbarang.statusbarang, tbstock.idbarang,tbstock.idtoko,tbharga.idbarang,tbharga.idtoko,sum(tbstock.stock) as stock");
        $this->db->join('tbstock', 'tbstock.idbarang=tbbarang.idbarang');
        $this->db->join('tbharga', 'tbharga.idbarang=tbbarang.idbarang');
        $this->db->where('tbstock.idtoko', $idtoko);
        $this->db->where('tbharga.idtoko', $idtoko);
        $this->db->group_by('tbstock.idbarang');
        $this->db->order_by('nama_barang', 'ASC');
        $this->db->from('tbbarang');

        $query = $this->db->get();
        return $query->result();
    }

    function autobarang($nama, $daritoko) {
        $this->db->select("tbbarang.idbarang,tbbarang.idjenisbrg,tbbarang.isibarang ,tbbarang.barcode,tbbarang.nama_barang, tbharga.hargabeli, tbharga.hecer1, tbharga.hecer2, tbharga.hgrosir1, tbharga.hgrosir2, tbharga.hgrosir3, tbbarang.hpromo, tbbarang.tanggalpromo, tbbarang.statuspromo, tbbarang.statusbarang, tbstock.idbarang,tbstock.idtoko,tbharga.idbarang,tbharga.idtoko,sum(tbstock.stock) as stock");
        $this->db->join('tbstock', 'tbstock.idbarang=tbbarang.idbarang');
        $this->db->join('tbharga', 'tbharga.idbarang=tbbarang.idbarang');
        // $this->db->like('nama_barang', $nama);
        // $this->db->or_like('barcode',$nama);
        // $this->db->or_like(array('barcode' => $nama, 'nama_barang' => $nama));
        $this->db->group_start();
        $this->db->or_like('barcode', $nama);
        $this->db->or_like('nama_barang', $nama);
        $this->db->group_end();

        $this->db->where('tbstock.idtoko', $daritoko);
        $this->db->where('tbharga.idtoko', $daritoko);
        $this->db->group_by('tbstock.idbarang');
        $this->db->order_by('nama_barang', 'ASC');
        $this->db->limit(5);
        $this->db->from('tbbarang');

        $query = $this->db->get();
        return $query;


        // $this->db->from('tbbarang');
        // $this->db->join('tbstock', 'tbstock.idbarang = tbbarang.idbarang');
        // $this->db->where('tbstock.idtoko', $daritoko);
        // $this->db->order_by('nama_barang', 'ASC');
        // $this->db->like('nama_barang', $nama);
        // $this->db->limit(5);
        // $query = $this->db->get();
        // return $query;
    }

    function autobarang_pindahstock($nama, $daritoko) {
        $this->db->select("tbbarang.idbarang,tbbarang.idjenisbrg,tbbarang.isibarang ,tbbarang.barcode,tbbarang.nama_barang,  tbbarang.hpromo, tbbarang.tanggalpromo, tbbarang.statuspromo, tbbarang.statusbarang, tbstock.idtoko,tbstock.idbarang,sum(tbstock.stock) as stock");
        $this->db->join('tbstock', 'tbstock.idbarang=tbbarang.idbarang');
        // $this->db->like('nama_barang', $nama);
         $this->db->group_start();
        $this->db->or_like('barcode', $nama);
        $this->db->or_like('nama_barang', $nama);
        $this->db->group_end();
        $this->db->where('tbstock.idtoko', $daritoko);
        $this->db->group_by('tbstock.idbarang');
        $this->db->from('tbbarang');
        
        $this->db->limit(5);
        $query = $this->db->get();
        return $query;
    }

    //----------------------------------------------------------------- customer
    public function search_customer($search_customer_by, $filter_nama, $filter_alamat, $fillter_wilayah, $baris) {
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
        if ($baris != 'all') {
            $this->db->limit($baris);
        }
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
	public function update_data_stock_pengajuan($id, $data) {
        return $this->db->update('tbdetailtransaksi_pengajuan_stock', $data, $id);
    }

    public function simpan_data_customer($data) {
        return $this->db->insert('tbcustomer', $data);
    }

    public function autocustomer() {
        $this->db->from('tbcustomer');
        $this->db->where('status_customer', 'aktif');
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

    public function autosuplayer() {
        $this->db->from('tbsuplayer');
        $this->db->order_by('nama_suplayer', 'ASC');
        $query = $this->db->get();
        return $query;
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

    public function where_kode_toko($id) {
         $this->db->join('tbmodal','tbmodal.idtoko=tbtoko.idtoko');
        $this->db->where('tbtoko.idtoko', $id);
        $this->db->from('tbtoko');
        $query = $this->db->get();
        return $query->row();
    }

    //----------------------------------------------------------------- toko
    public function search_toko($search_toko_by) {
        $this->db->join('tbmodal','tbmodal.idtoko=tbtoko.idtoko');
        $this->db->like('tbtoko.nama', $search_toko_by);
        $this->db->order_by('tbtoko.idtoko', 'ASC');
        $this->db->from('tbtoko');
        $query = $this->db->get();
        return $query->result();
    }

    public function search_tokokasir($search_toko_by) {
        $this->db->join('tbmodal','tbmodal.idtoko=tbtoko.idtoko');
        $this->db->where('tbtoko.idtoko', $search_toko_by);
        $this->db->order_by('tbtoko.idtoko', 'ASC');
        $this->db->from('tbtoko');
        $query = $this->db->get();
        return $query->result();
    }

    public function search_neraca($toko_by) {
        $query = $this->db->query("SELECT tbtoko.idtoko AS id,tbtoko.nama,tbmodal.nominal_modal as MODAL,(SELECT SUM(tbtransaksi_penjualan_customer.totalbayar) FROM tbtransaksi_penjualan_customer WHERE tbtransaksi_penjualan_customer.idtoko=id) as total_penjualan,(SELECT SUM(tbtransaksi_kulakan.totalbayar) FROM tbtransaksi_kulakan WHERE tbtransaksi_kulakan.idtoko=id) as total_kulakan,(SELECT Sum(tbpengeluaran.nominal_pengeluaran)FROM tbpengeluaran WHERE tbpengeluaran.idtoko=id) as Total_Pengeluaran,(SELECT SUM(tbtransaksi_penjualan_customer.totalbayar-tbtransaksi_penjualan_customer.bayar) FROM tbtransaksi_penjualan_customer WHERE tbtransaksi_penjualan_customer.idtoko=id AND tbtransaksi_penjualan_customer.status_lunas='utang') AS Total_Hutang_Cutomer,(SELECT SUM(tbtransaksi_kulakan.totalbayar-tbtransaksi_kulakan.bayar) FROM tbtransaksi_kulakan WHERE tbtransaksi_kulakan.idtoko=id AND tbtransaksi_kulakan.status_lunas='utang') AS Total_Hutang_Suplayer FROM tbmodal,tbtoko WHERE tbtoko.idtoko=tbmodal.idmodal and tbtoko.idtoko='$toko_by'");
        return $query->result();
    }

    public function update_data_toko($id, $data) {
        return $this->db->update('tbtoko', $data, $id);
    }
    public function update_data_modal($id, $data) {
        return $this->db->update('tbmodal', $data, $id);
    }
    public function update_modaltotalbayarpenjualan($id, $databayar) {
        return $this->db->query("UPDATE tbmodal set nominal_modal=nominal_modal+'$databayar' where idtoko='$id'");

    }
     public function update_modaltotalbayarpembelianbaru($id, $databayarbaru) {
        return $this->db->query("UPDATE tbmodal set nominal_modal=nominal_modal-'$databayarbaru' where idtoko='$id'");
    }

    public function simpan_data_toko($data) {
        return $this->db->insert('tbtoko', $data);
    }
    public function getidtoko() {
        return $this->db->select('idtoko')
                        ->order_by('idtoko', 'DESC')
                        ->limit(1)
                        ->get('tbtoko');
    }
    public function simpan_data_modal($data) {
        return $this->db->insert('tbmodal', $data);
        // $this->db->insert_id(); 
    }

    public function search_histori_barang($param) {

         $this->db->join('tbtransaksi_penjualan_customer', 'tbtransaksi_penjualan_customer.notatransaksi_penjualan_customer=tbdetailtransaksi_penjualan_customer.notatransaksi_penjualan_customer', 'left');
                $this->db->join('tbuser', 'tbuser.iduser=tbtransaksi_penjualan_customer.iduser', 'left');
        $this->db->join('tbcustomer', 'tbcustomer.idcustomer=tbtransaksi_penjualan_customer.idcustomer', 'left');
        $this->db->join('tbmarketing', 'tbmarketing.idmarketing=tbtransaksi_penjualan_customer.idmarketing', 'left');
         $this->db->order_by('tanggal', 'DESC');
//        $this->db->where('tanggal >=', $tglawal . ' 00:00:00');
//        $this->db->where('tanggal <=', $tglakhir . ' 23:59:59');
//        $this->db->where('`status_pending`', 't');
//        if ($baris != 'all') {
//            $this->db->limit($baris);
//        }
        $this->db->where('tbdetailtransaksi_penjualan_customer.idbarang', $param);
        $this->db->from('tbdetailtransaksi_penjualan_customer');
        $query = $this->db->get();
        return $query->result();
    }

}
