<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_penjualan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mgrafik');
        $this->load->model('Mmaster');
        $this->load->model('Mpenjualan');
    }

     public function coba() {
        if ($this->input->post('tanggal_pengiriman') == "" || empty($this->input->post('tanggal_pengiriman'))) {
            $tanggal_pengiriman = '0000-00-00';
        } else {
            $tgl_p = explode('/', $this->input->post('tanggal_pengiriman'));
            $tanggal_pengiriman = $tgl_p[2] . '-' . $tgl_p[1] . '-' . $tgl_p[0];
        }
        $output = array(
            'status' => TRUE,
            'nota' => $this->input->post('nota'),
            'jenispenjualan' => $this->input->post('ecer_grosir'),
            'pesan' => $tanggal_pengiriman
        );

        echo json_encode($output);
    }

	public function aksi_simpan_pengajuan() {
            $totalbelanja = str_replace(chr(194) . chr(160), ' ', $this->input->post('total_belanja'));
            if ($this->input->post('ongkir') == "" || empty($this->input->post('ongkir'))) {
                $ongkir = 0;
            } else {
                $ongkir = str_replace(chr(194) . chr(160), ' ', $this->input->post('ongkir'));
            }
            if ($this->input->post('bayar') == "" || empty($this->input->post('bayar'))) {
                $bayar = 0;
            } else {
                $bayar = str_replace(chr(194) . chr(160), ' ', $this->input->post('bayar'));
            }
            $sisa = preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('sisa')));
        
                $statuslunas = "lunas";
                // $totalbayaru=preg_replace('/[Rp. ]/', '', $totalbelanja) - preg_replace('/[Rp. ]/', '', $ongkir);

                // $this->Mmaster->update_modaltotalbayarpenjualan($this->session->userdata['logged_in']['toko'], $totalbayaru);
				$nota_terakhir = $this->Mpenjualan->nota_terakhir_pengajuan();
				$countnota_terakhir = count($nota_terakhir);
				if ($countnota_terakhir == 0) {
					$nomer_nota_baru = '1';
				} else {
					
					$nomer_nota_baru = $countnota_terakhir + 1;
				}
				$notanya = $nomer_nota_baru;
            $output_transaksi_pengajuan = array(//start to save tbtransaksi_penjualan
                'notatransaksi_kulakan' => $notanya, // nota baru
                'tanggal' => date('Y-m-d H:i:s a'),
                'iduser' => $this->session->userdata['logged_in']['idptgs'],
                'idtoko' => $this->session->userdata['logged_in']['toko'],
                'status_pengajuan' => 'baru'
            );
            $this->Mpenjualan->simpan_transaksi_pengajuan($output_transaksi_pengajuan);

            $jumbrg = count($this->input->post('barang[]'));
//          start to save tbdetail_penjualan
            for ($i = 0; $i < $jumbrg; $i++) {
                if (trim($this->input->post('barang[' . $i . ']') != '')) {
                    $idb = trim($this->input->post('idb[' . $i . ']'));
                    $harga = trim($this->input->post('harga[' . $i . ']'));
                    $jumlah = trim($this->input->post('jumlah[' . $i . ']'));
                    $beli = trim($this->input->post('beli[' . $i . ']'));
                    $Jumlah_Beli = $jumlah * $beli;
                    $total_produksi = 0;
                    $output_detail_transaksi_pengajuan[] = array(
                        'notatransaksi_kulakan' => $this->input->post('nota'),
                        'idbarang' => $idb,
                        'jumlah' => $jumlah,
                        'hargabeli' => $beli,                        
                    );
                    
                }
            } 
                $this->Mpenjualan->simpan_detail_transaksi_pengajuan($output_detail_transaksi_pengajuan);
                $output = array(
                    'status' => TRUE,
                    'nota' => $this->input->post('nota'),
                    'jenispenjualan' => '',
                    'pesan' => 'pengajuan barang berhasil di Kirim'
                );
        
        echo json_encode($output);
    }
    public function aksi_simpan_penjualan() {
        $jumbrg = count($this->input->post('barang[]'));
        if ($this->input->post('id_marketing') == "" || empty($this->input->post('id_marketing')) || empty($this->input->post('marketing'))){
            $output = array(
                'status' => FALSE,
                'eror' => 'marketing',
                'pesan' => 'Silahkan pilih marketing'
            );
        } elseif ($this->input->post('id_customer') == "" && $this->input->post('ecer_grosir') == 'grosir') {
            $output = array(
                'status' => FALSE,
                'eror' => 'customer',
                'pesan' => 'Silahkan pilih customer'
            );
        } elseif ($this->input->post('barang[0]') == "") { // perlu diperbaharui karena jika databarang 1 di hapus maka tidak bosa di simpan
            $output = array(
                'status' => FALSE,
                'eror' => 'barang',
                'pesan' => 'Tidak ada barang yang dipilih, Silahkan pilih barang'
            );
        } elseif ($jumbrg > 0) {
            $totalbelanja = str_replace(chr(194) . chr(160), ' ', $this->input->post('total_belanja'));
            if ($this->input->post('ongkir') == "" || empty($this->input->post('ongkir'))) {
                $ongkir = 0;
            } else {
                $ongkir = str_replace(chr(194) . chr(160), ' ', $this->input->post('ongkir'));
            }
            if ($this->input->post('bayar') == "" || empty($this->input->post('bayar'))) {
                $bayar = 0;
            } else {
                $bayar = str_replace(chr(194) . chr(160), ' ', $this->input->post('bayar'));
            }
            $sisa = preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('sisa')));
            if ($sisa < 0 || $bayar == 0) {
                $statuslunas = "utang";
                $this->Mmaster->update_modaltotalbayarpenjualan($this->session->userdata['logged_in']['toko'], $bayar);
                $output_historytransaksi_penjualan = array(//start to save tbtransaksi_penjualan
                'notatransaksi_penjualan_customer' => $this->input->post('nota'), // nota baru
                'idcustomer' => $this->input->post('id_customer'),
                'idtoko' => $this->session->userdata['logged_in']['toko'],
                'tanggal' => date('Y-m-d H:i:s a'),
                'bayar' => preg_replace('/[Rp. ]/', '', $bayar),
                'totalbayar' => preg_replace('/[Rp. ]/', '', $totalbelanja) - preg_replace('/[Rp. ]/', '', $ongkir), //total yang 
                'sisa_piutang' => preg_replace('/[Rp. ]/', '', $totalbelanja) - preg_replace('/[Rp. ]/', '', $bayar)
                );
                $this->Mpenjualan->simpan_historytransaksi_penjualan_customer($output_historytransaksi_penjualan);
            } else {
                $statuslunas = "lunas";
                $totalbayaru=preg_replace('/[Rp. ]/', '', $totalbelanja) - preg_replace('/[Rp. ]/', '', $ongkir);

                $this->Mmaster->update_modaltotalbayarpenjualan($this->session->userdata['logged_in']['toko'], $totalbayaru);
            }
            if ($this->input->post('pengiriman') == "") {
                $viapengiriman = '-';
            } else {
                $viapengiriman = $this->input->post('pengiriman');
            }
            if ($this->input->post('tanggal_pengiriman') == "" || empty($this->input->post('tanggal_pengiriman'))) {
                $tanggal_pengiriman = '0000-00-00';
            } else {
                $tgl_p = explode('/', $this->input->post('tanggal_pengiriman'));
                $tanggal_pengiriman = $tgl_p[2] . '-' . $tgl_p[1] . '-' . $tgl_p[0];
            }
            $output_transaksi_penjualan = array(//start to save tbtransaksi_penjualan
                'notatransaksi_penjualan_customer' => $this->input->post('nota'), // nota baru
                'jenis_harga_penjualan' => $this->input->post('ecer_grosir'),
                'tanggal' => date('Y-m-d H:i:s a'),
                'ongkir' => preg_replace('/[Rp. ]/', '', $ongkir),
                'totalbayar' => preg_replace('/[Rp. ]/', '', $totalbelanja) - preg_replace('/[Rp. ]/', '', $ongkir), //total yang harus dibayar tanpa ongkir
                'bayar' => preg_replace('/[Rp. ]/', '', $bayar),
                'status_lunas' => $statuslunas,
                'status_pending' => $this->input->post('pendingYT'),
                'tanggal_pengiriman' => $tanggal_pengiriman,
                'via_pengiriman' => $viapengiriman,
                'idcustomer' => $this->input->post('id_customer'),
                'iduser' => $this->session->userdata['logged_in']['idptgs'],
                'idtoko' => $this->session->userdata['logged_in']['toko'],
                'idmarketing' => $this->input->post('id_marketing')
            );
            $this->Mpenjualan->simpan_transaksi_penjualan_customer($output_transaksi_penjualan);

            
//          start to save tbdetail_penjualan
            for ($i = 0; $i < $jumbrg; $i++) {
                if (trim($this->input->post('barang[' . $i . ']') != '')) {
                    $idb = trim($this->input->post('idb[' . $i . ']'));
                    $harga = trim($this->input->post('harga[' . $i . ']'));
                    $jumlah = trim($this->input->post('jumlah[' . $i . ']'));
                    $beli = trim($this->input->post('beli[' . $i . ']'));
                    $Jumlah_Beli = $jumlah * $beli;
                    $total_produksi = 0;
                    $output_detail_transaksi_penjualan[] = array(
                        'notatransaksi_penjualan_customer' => $this->input->post('nota'),
                        'idbarang' => $idb,
                        'jumlah' => $jumlah,
                        'hargabeli' => $beli,
                        'hargajual' => $harga,
                        'laba' => ($jumlah * $harga) - ($total_produksi + $Jumlah_Beli)
                    );
                    $data_detail_stock[] = array(
                            'idbarang' => $idb,
                            'stock' =>-$jumlah,
                            'tipe' =>'Keluar',
                            'ket' =>'No Transaksi Penjualan '.$this->input->post('nota'),
                            'tgl_up' => date('Y-m-d H:i:s'),
                            'waktu_up' => date('Y-m-d H:i:s'),
                            'idtoko' => $this->session->userdata['logged_in']['toko']
                        );
                }
            } 
            if ($this->input->post('pendingYT') == 't') {
                $this->Mpenjualan->simpan_detail_transaksi_penjualan_customer($output_detail_transaksi_penjualan);
                $this->Mpenjualan->simpan_data_detail_stock($data_detail_stock);
                $output = array(
                    'status' => TRUE,
                    'nota' => $this->input->post('nota'),
                    'jenispenjualan' => $this->input->post('ecer_grosir'),
                    'pesan' => 'Transaksi penjualan berhasil di SIMPAN'
                );
            } else {
                $this->Mpenjualan->simpan_detail_transaksi_penjualan_customer($output_detail_transaksi_penjualan);
                $output = array(
                    'status' => TRUE,
                    'nota' => $this->input->post('nota'),
                    'jenispenjualan' => $this->input->post('ecer_grosir'),
                    'pesan' => 'Transaksi penjualan berhasil di PENDING'
                );
            }
        }
        echo json_encode($output);
    }
     public function cG($nota) {
        $cek_data = $this->Mpenjualan->cek_nota_penjulan_customer($nota);
        $ecer_grosir = $cek_data->jenis_harga_penjualan;
        $toko = $cek_data->idtoko;
        $data = array(
            'penjualan' => $this->Mpenjualan->nota_penjulan_customer($nota, $ecer_grosir),
            'detail_penjualan' => $this->Mpenjualan->detail_nota_penjulan_customer($nota,$toko)
        );
        $this->load->view('v-admin/cetak_grosir', $data);
    }

    public function cE($nota) {
        $cek_data = $this->Mpenjualan->cek_nota_penjulan_customer($nota);
        $ecer_grosir = $cek_data->jenis_harga_penjualan;
        $toko = $cek_data->idtoko;
        $data = array(
            'penjualan' => $this->Mpenjualan->nota_penjulan_customer($nota, $ecer_grosir),
            'detail_penjualan' => $this->Mpenjualan->detail_nota_penjulan_customer($nota,$toko)
        );
        $this->load->view('v-admin/cetak_ecer', $data);
    }

}
