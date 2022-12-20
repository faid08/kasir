<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cadmin_pembelian extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mpenjualan');
        $this->load->model('Mpembelian');
        $this->load->model('Mmaster');
    }

    public function simpan_pembelian() {
        $jumbrg = count($this->input->post('barang[]'));
        if ($this->input->post('suplayer') == "") {
            $data = array(
                'status' => FALSE,
                'eror' => 'suplayer',
                'pesan' => 'Silahkan pilih Suplayer'
            );
        } elseif ($this->input->post('barang[0]') == "") { // perlu diperbaharui karena jika databarang 1 di hapus maka tidak bosa di simpan
            $data = array(
                'status' => FALSE,
                'eror' => 'barang',
                'pesan' => 'Tidak ada barang yang dipilih, Silahkan pilih barang'
            );
        }elseif ($this->input->post('bayar') == "") { 
            $data = array(
                'status' => FALSE,
                'eror' => 'bayar',
                'pesan' => 'silahkan isi pembayaran'
            );
        } elseif ($jumbrg > 0) {
            $totalbayar = str_replace(chr(194) . chr(160), ' ', $this->input->post('total_belanja'));
            $bayar = str_replace(chr(194) . chr(160), ' ', $this->input->post('bayar'));
            $sisa = preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('sisa')));
            if ($sisa < 0) {
                $statuslunas = "utang";
                 $ubayar=preg_replace('/[Rp. ]/', '', $bayar);
                $this->Mmaster->update_modaltotalbayarpembelianbaru($this->session->userdata['logged_in']['toko'], $ubayar);
            } else {
                $statuslunas = "lunas";
                $ubayar=preg_replace('/[Rp. ]/', '', $totalbayar);
                $this->Mmaster->update_modaltotalbayarpembelianbaru($this->session->userdata['logged_in']['toko'], $ubayar);
            }
            $data_transaksi_pembelian = array(//start to save tbtransaksi_penjualan
                'notatransaksi_kulakan' => $this->input->post('nota'), // nota baru
                'tanggal' => date('Y-m-d h:i:s a'),
                'totalbayar' => preg_replace('/[Rp. ]/', '', $totalbayar),
                'bayar' => preg_replace('/[Rp. ]/', '', $bayar),
                'sisa' => $sisa,
                'status_lunas' => $statuslunas,
                'status_pending' => 't',
                'idsuplayer' => $this->input->post('id_suplayer'),
                'iduser' => $this->session->userdata['logged_in']['idptgs'],
                'idtoko' => $this->session->userdata['logged_in']['toko']
            );
            $this->Mpembelian->simpan_data_transaksi_pembelian($data_transaksi_pembelian); 
            // simpan transaksi kulakan            

            for ($i = 0; $i < $jumbrg; $i++) {
                if (trim($this->input->post('barang[' . $i . ']') != '')) {
                    $idb = trim($this->input->post('idb[' . $i . ']'));
                    $jumlah = trim($this->input->post('jumlah[' . $i . ']'));
                    $beli = preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('hbeli[' . $i . ']')));
                    $data_detail_transaksi_pembelian[] = array(
                        'notatransaksi_kulakan' => $this->input->post('nota'),
                        'idbarang' => $idb,
                        'jumlah' => $jumlah,
                        'hargabeli' => $beli,
                    );
                    $data_detail_stock[] = array(
                            'idbarang' => $idb,
                            'stock' =>$jumlah,
                            'tipe' =>'Masuk',
                            'ket' =>'No Transaksi Pembelian '.$this->input->post('nota'),
                            'tgl_up' => date('Y-m-d H:i:s'),
                            'waktu_up' => date('Y-m-d H:i:s'),
                            'idtoko' => $this->session->userdata['logged_in']['toko']
                        );
                }
            }
            $this->Mpembelian->simpan_data_detail_transaksi_pembelian($data_detail_transaksi_pembelian); // simpan detail transaksi kulakan
            $this->Mpembelian->simpan_data_detail_stock($data_detail_stock);
            $data = array(
                'status' => TRUE,
                'nota' => $this->input->post('nofaktur'),
                'jenispenjualan' => $statuslunas,
                'pesan' => 'Transaksi Kulakan berhasil di SIMPAN'
            );
        }
        echo json_encode($data);
    }

    public function search_suplayer() {
        $cari = $this->input->post('cari');
        $q = $this->Mdata->search_suplayer($cari);
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $k) {
                $data[] = [
                    'sukses' => true,
                    'nama' => $k['idsuplayer'] . ' | ' . $k['nama_suplayer'],
                    'idsuplayer' => $k['idsuplayer'],
                    'hp' => $k['hp_suplayer'],
                    'alamat' => $k['alamat_suplayer']
                ];
            }
        } else {
            $data[] = [
                'sukses' => false,
                'nama' => "Suplayer tidak ditemukan",
                'alamat' => "-",
            ];
        }
        echo json_encode($data);
    }

}
