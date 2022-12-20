<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_stock extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mgrafik');
        $this->load->model('Mmaster');
        $this->load->model('Mpenjualan');
        $this->load->model('Mstock');
    }

    public function aksi_simpan_stock() {
         $jumbrg = count($this->input->post('barang[]'));
        if ($this->input->post('barang[0]') == "") { // perlu diperbaharui karena jika databarang 1 di hapus maka tidak bosa di simpan
            $output = array(
                'status' => FALSE,
                'eror' => 'barang',
                'pesan' => 'Tidak ada barang yang dipilih, Silahkan pilih barang'
            );
        }else{
            for ($i = 0; $i < $jumbrg; $i++) {
                if (trim($this->input->post('barang[' . $i . ']') != '')) {
                    $idb = trim($this->input->post('idb[' . $i . ']'));
                    $jumdaristock = trim($this->input->post('jumdaristock[' . $i . ']'));
                    $jumstockpindah = trim($this->input->post('jumstockpindah[' . $i . ']'));
                    $tgl_up=date('Y-m-d H:i:s');
                    $waktu_up=date('Y-m-d H:i:s');
                    $namatoko = $this->Mmaster->lihat_namatoko($this->input->post('pilihtoko2'))->row()->nama;
                    $simpantoko1 = array(
                        'idbarang' => $idb,
                        'stock' => -$jumstockpindah,
                        'tipe' =>'Keluar',
                        'ket' =>'Kulakan ke '.$namatoko,
                        'tgl_up' =>$tgl_up,
                        'waktu_up' =>$waktu_up,
                        'idtoko' => $this->input->post('pilihtoko1')
                    );
                    $simpantoko2 = array(
                        'idbarang' => $idb,
                        'stock' => $jumstockpindah,
                        'tipe' =>'Masuk',
                        'ket' =>'Kulakan Dari Gudang',
                        'tgl_up' =>$tgl_up,
                        'waktu_up' =>$waktu_up,
                        'idtoko' => $this->input->post('pilihtoko2')
                    );
                    $this->Mstock->simpan_stock_baru($simpantoko1);
                    $this->Mstock->simpan_stock_baru($simpantoko2);
                }
            }
            $output = array(
                'status' => TRUE,
                'pesan' => 'Data berhasil disimpan'
            );
        } 
        echo json_encode($output);
    }

}
