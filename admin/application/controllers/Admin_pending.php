<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_pending extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mpending');
        $this->load->model('Mmaster');
        $this->load->model('Mpenjualan');
    }

    public function cek_session() {
        if (isset($this->session->userdata['logged_in'])) {
            
        } else {
            header("location:login");
        }
    }

    public function rupiah($angka) {

        $hasil_rupiah = number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }

    public function data_pending() {
        $search_nota_pending_by = $this->input->post('search_nota_pending_by');
        $fnama = $this->input->post('fnama');
        $fnota = $this->input->post('fnota');
        $toko = $this->input->post('pilihtoko');
        $list_data = $this->Mpending->search_data_pending($fnama, $fnota, $search_nota_pending_by,$toko);
        if (count($list_data) > 0) {
            $no = 1;
            foreach ($list_data as $value) {
                $row = array();
                $row[] = '<tr>';
                $row[] = '<td>' . $no++ . '</td>';
                $row[] = '<td>' . date('d-m-Y h:i:s ', strtotime($value->tanggal)) . '</td>';
                $row[] = '<td>' . $value->notatransaksi_penjualan_customer . '</td>';
                if ($value->jenis_harga_penjualan === "ecer") {
                    $nm_c = 'customer ecer (-)';
                } else {
                    $nm_c = $value->nama_customer;
                }
                $row[] = '<td >' . $nm_c . '</td>';
                $row[] = '<td>' . $value->jenis_harga_penjualan . '</td>';
                $row[] = '<td>' . $value->tanggal_pengiriman . '</td>';
                $row[] = '<td><a href="#" onclick="form_edit_nota_pending(`' . $value->notatransaksi_penjualan_customer . '`)"><i class="fas fa-edit"></i></button></a></td>';
                $row[] = '<td><a href="#" data-toggle="modal" data-target="#modal-lg" onclick="info_nota_pending(`' . $value->notatransaksi_penjualan_customer . '`)"><i class="fas fa-search"></i></button></a></td>';
                $row[] = '</tr>';
                $data[] = $row;
            }
            $sukses = 'ya';
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="8"><span class="text-danger" style="text-transform: uppercase"><b><u> ' . $search_nota_pending_by . ' </u></b></span> Tidak ditemukan ! Pastikan nomer nota atau nama customer merupakan bagian <b>penjualan pending</b> </td></tr>';
        }
        $output = array(
            'sukses' => $sukses,
            'list_data' => $data,
            'nama' => $search_nota_pending_by
        );
        echo json_encode($output);
    }

    public function info_nota_pending() {
        $nota = $this->input->post('nota');
        $penjualan = $this->Mpending->nota_penjulan_customer($nota);
        if ($penjualan->jenis_harga_penjualan === "ecer") {
            $nc = "-";
            $hc = '-';
            $nm = "-";
            $hm = "-";
        } else {
            $nc = $penjualan->nama_customer;
            $hc = $penjualan->hp_customer;
            $nm = $penjualan->nama_marketing;
            $hm = $penjualan->hp_marketing;
        }
        $data_penjulan = array(
            'petugas' => $penjualan->nama,
            'tanggal' => date('d-m-Y h:i:s ', strtotime($penjualan->tanggal)),
            'jenis' => $penjualan->jenis_harga_penjualan,
            'nama_c' => $nc,
            'hp_c' => $nc,
            'nama_m' => $nm,
            'hp_m' => $hm
        );
        $detail_penjualan = $this->Mpending->detail_nota_penjulan_customer($nota,$this->input->post('pilihtoko'));
        $no = 1;
        foreach ($detail_penjualan as $value) {
            $row = array();
            $row[] = '<tr>';
            $row[] = '<td>' . $no++ . '</td>';
            $row[] = '<td>' . $value->nama_barang . '</td>';
            $row[] = '<td>' . $value->jumlah . '</td>';
            $row[] = '<td>' . $this->rupiah($value->hargajual) . '</td>';
            $row[] = '<td>' . $this->rupiah($value->jumlah * $value->hargajual) . '</td>';
            $row[] = '</tr>';
            $data[] = $row;
        }
        $output = array(
            'penjualan' => $data_penjulan,
            'detail_penjualan' => $data
        );
        echo json_encode($output);
    }

    public function update_nota_pending() {
        $jumbrg = count($this->input->post('barang[]'));
        if ($this->input->post('id_marketing') == "" || empty($this->input->post('id_marketing')) || empty($this->input->post('marketing'))) {
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
            } else {
                $statuslunas = "lunas";
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
//                'iduser' => $this->session->userdata['logged_in']['idptgs'],
//                'idtoko' => $this->session->userdata['logged_in']['toko'],
                'idmarketing' => $this->input->post('id_marketing')
            );
            $this->Mpending->update_penjualan(array('notatransaksi_penjualan_customer' => $this->input->post('nota')), $output_transaksi_penjualan);
//          start to save tbdetail_penjualan
            for ($i = 0; $i < $jumbrg; $i++) {
                if (trim($this->input->post('barang[' . $i . ']') != '')) {
                    $idb = trim($this->input->post('idb[' . $i . ']'));
                    $harga = trim($this->input->post('harga[' . $i . ']'));
                    $jumlah = trim($this->input->post('jumlah[' . $i . ']'));
                    $beli = trim($this->input->post('beli[' . $i . ']'));
                    $produksi = 0;
                    $Jumlah_Beli = $jumlah * $beli;
                    $total_produksi = $jumlah * $produksi;
                    $output_detail_transaksi_penjualan[] = array(
                        'notatransaksi_penjualan_customer' => $this->input->post('nota'),
                        'idbarang' => $idb,
                        'jumlah' => $jumlah,
                        'hargabeli' => $beli,
                        'hargajual' => $harga,
                        'laba' => ($jumlah * $harga) - ($total_produksi + $Jumlah_Beli)
                    );
                    // $stockawal = $this->Mpending->stock($idb);
                    // $stockbaru[] = array(
                    //     'idbarang' => $idb,
                    //     'stock' => ($stockawal->stock) - $jumlah
                    // );
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
            $this->Mpending->delete_detail_penjualan($this->input->post('nota'));
            if ($this->input->post('pendingYT') == 't') {
                $this->Mpending->simpan_detail_transaksi_penjualan_customer($output_detail_transaksi_penjualan);
                // $this->Mpending->update_stock_barang_ketika_simpan_transaksi($stockbaru);
                $this->Mpenjualan->simpan_data_detail_stock($data_detail_stock);
                $output = array(
                    'status' => TRUE,
                    'nota' => $this->input->post('nota'),
                    'jenispenjualan' => $this->input->post('ecer_grosir'),
                    'pesan' => 'Transaksi penjualan berhasil di Update dengan status SIMPAN'
                );
            } else {
                $this->Mpending->simpan_detail_transaksi_penjualan_customer($output_detail_transaksi_penjualan);
                $output = array(
                    'status' => TRUE,
                    'nota' => $this->input->post('nota'),
                    'jenispenjualan' => $this->input->post('ecer_grosir'),
                    'pesan' => 'Transaksi penjualan berhasil di Update dengan status PENDING'
                );
            }
        }
        echo json_encode($output);
    }

}
