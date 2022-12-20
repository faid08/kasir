<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mlaporan');
        $this->load->model('Mpenjualan');
        $this->load->model('Mpembelian');
        
    }

    public function rupiah($angka) {
        $hasil_rupiah = number_format($angka, 0, '.', '.');
        return $hasil_rupiah;
    }

//----------------------------------------------------------------------- barang
    public function laporan_piutang_customer() {
        $search = $this->input->post('search_nm');
        $toko = $this->input->post('pilihtoko');
        $tgl = explode(' - ', $this->input->post('tgl'));
        $tgl_awal = explode('/', $tgl[0]);
        $tglawal = $tgl_awal[2] . '-' . $tgl_awal[0] . '-' . $tgl_awal[1];
        $tgl_akhir = explode('/', $tgl[1]);
        $tglakhir = $tgl_akhir[2] . '-' . $tgl_akhir[0] . '-' . $tgl_akhir[1];
        $list = $this->Mlaporan->laporan_hutang_customer($search, $tglawal, $tglakhir, $toko);
        if (count($list) > 0) {
            $no = 1;
            foreach ($list as $value) {
                $row = array();
                if ($value->idcustomer == 0 || $value->idcustomer == "") {
                    $nm_c = 'customer ecer (-)';
                } else {
                    $nm_c = $value->nama_customer;
                }
                $row[] = '<tr>';
                $row[] = '<td>' . $no++ . '</td>';
                $row[] = '<td>' . date('d-m-Y H:i:s ', strtotime($value->tanggal)) . '</td>';
                $row[] = '<td>' . $value->notatransaksi_penjualan_customer . '</td>';
                $row[] = '<td>' . $value->jenis_harga_penjualan . '</td>';
                $row[] = '<td>' . $value->nama_marketing . '</td>';
                $row[] = '<td>' . $nm_c . '</td>';
                $row[] = '<td>' . $this->rupiah( ($value->totalbayar + $value->ongkir)-$value->bayar ) . '</td>';
                $row[] = '<td><a href="#" onclick="form_edit_piutang_customer(`' . $value->notatransaksi_penjualan_customer . '`)"><i class="fas fa-edit"></i></button></a></td>';
                $row[] = '<td><a href="#" data-toggle="modal" data-target="#modal-lg" onclick="info_nota(`' . $value->notatransaksi_penjualan_customer . '`)"><i class="fas fa-search"></i></button></a></td>';
                $row[] = '<td><a href="#" data-toggle="modal" data-target="#modal-lghistory" onclick="historypiutang_nota(`' . $value->notatransaksi_penjualan_customer . '`)"><i class="fas fa-copy"></i></button></a></td>';
                $row[] = '</tr>';
                $data[] = $row;
                $jum_hutang[] =  ($value->totalbayar + $value->ongkir)-$value->bayar;
            }
            $sukses = 'ya';
            $jum = $this->rupiah(array_sum($jum_hutang));
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="8"><span class="text-danger" style="text-transform: uppercase"><b><u> ' . $search . ' </u></b></span> Data kosong ! pastikan interval waktu benar atau kata pencarian sesuai data yang ada  </td></tr>';
            $jum = 0;
        }
        $output = array(
            'sukses' => $sukses,
            'list_hutang_customer' => $data,
            'jum_hutang' => $jum
        );
        echo json_encode($output);
    }

    public function laporan_piutang_suplayer1() {
        $search = $this->input->post('search_nm');
        $toko = $this->input->post('pilihtoko');
        $tgl = explode(' - ', $this->input->post('tgl'));
        $tgl_awal = explode('/', $tgl[0]);
        $tglawal = $tgl_awal[2] . '-' . $tgl_awal[0] . '-' . $tgl_awal[1];
        $tgl_akhir = explode('/', $tgl[1]);
        $tglakhir = $tgl_akhir[2] . '-' . $tgl_akhir[0] . '-' . $tgl_akhir[1];
        $list = $this->Mlaporan->laporan_hutang_suplayer($search, $tglawal, $tglakhir, $toko);
        if (count($list) > 0) {
            $no = 1;
            foreach ($list as $value) {
                $row = array();
                $nm_c = $value->nama_suplayer;
                $row[] = '<tr>';
                $row[] = '<td>' . $no++ . '</td>';
                $row[] = '<td>' . date('d-m-Y H:i:s ', strtotime($value->tanggal)) . '</td>';
                $row[] = '<td>' . $value->notatransaksi_kulakan . '</td>';
                $row[] = '<td>' . $nm_c . '</td>';
                $row[] = '<td>' . $this->rupiah($value->totalbayar-$value->bayar) . '</td>';
                $row[] = '<td><a href="#" onclick="form_edit_piutang_suplayer(`' . $value->notatransaksi_kulakan. '`)"><i class="fas fa-edit"></i></button></a></td>';
                $row[] = '<td><a href="#" data-toggle="modal" data-target="#modal-lg" onclick="info_nota(`' . $value->notatransaksi_kulakan . '`)"><i class="fas fa-search"></i></button></a></td>';
                $row[] = '</tr>';
                $data[] = $row;
                $jum_hutang[] =  ($value->totalbayar)-$value->bayar;
            }
            $sukses = 'ya';
            $jum = $this->rupiah(array_sum($jum_hutang));
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="8"><span class="text-danger" style="text-transform: uppercase"><b><u> ' . $search . ' </u></b></span> Data kosong ! pastikan interval waktu benar atau kata pencarian sesuai data yang ada  </td></tr>';
            $jum = 0;
        }
        $output = array(
            'sukses' => $sukses,
            'list_hutang_customer' => $data,
            'jum_hutang' => $jum
        );
        echo json_encode($output);
    }

    public function laporan_piutang_suplayer() {
        $search = $this->input->post('search_nm');
        $toko = $this->input->post('pilihtoko');
        $tgl = explode(' - ', $this->input->post('tgl'));
        $tgl_awal = explode('/', $tgl[0]);
        $tglawal = $tgl_awal[2] . '-' . $tgl_awal[0] . '-' . $tgl_awal[1];
        $tgl_akhir = explode('/', $tgl[1]);
        $tglakhir = $tgl_akhir[2] . '-' . $tgl_akhir[0] . '-' . $tgl_akhir[1];

        $list = $this->Mlaporan->laporan_hutang_suplayer($search, $tglawal, $tglakhir, $toko);
        if (count($list) > 0) {
            $no = 1;
            foreach ($list as $value) {
                $row = array();
                if ($value->idsuplayer == 0 || $value->idsuplayer == "") {
                    $nm_c = 'suplayer ecer (-)';
                } else {
                    $nm_c = $value->nama_suplayer;
                }
                $row[] = '<tr>';
                $row[] = '<td>' . $no++ . '</td>';
                $row[] = '<td>' . date('d-m-Y H:i:s ', strtotime($value->tanggal)) . '</td>';
                $row[] = '<td>' . $value->notatransaksi_kulakan . '</td>';
                $row[] = '<td>' . $nm_c . '</td>';
                $row[] = '<td>' . $this->rupiah($value->totalbayar-$value->bayar) . '</td>';
                // $row[] = '<td><a href="#" onclick="form_edit_piutang_customer(`' . $value->notatransaksi_kulakan. '`)"><i class="fas fa-edit"></i></button></a></td>';
                // $row[] = '<td><a href="#" data-toggle="modal" data-target="#modal-lg" onclick="info_nota(`' . $value->notatransaksi_kulakan . '`)"><i class="fas fa-search"></i></button></a></td>';
                // $row[] = '<td><a href="#" data-toggle="modal" data-target="#modal-lghistory" onclick="historypiutang_nota(`' . $value->notatransaksi_kulakan . '`)"><i class="fas fa-copy"></i></button></a></td>';
                $row[] = '</tr>';
                $data[] = $row;
                $jum_hutang[] =  ($value->totalbayar)-$value->bayar;
            }
            $sukses = 'ya';
            $jum = $this->rupiah(array_sum($jum_hutang));
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="8"><span class="text-danger" style="text-transform: uppercase"><b><u> ' . $search . ' </u></b></span> Data kosong ! pastikan interval waktu benar atau kata pencarian sesuai data yang ada  </td></tr>';
            $jum = 0;
        }
        $output = array(
            'sukses' => $sukses,
            'list_hutang_customer' => $data,
            'jum_hutang' => $jum
        );
        echo json_encode($output);
    }

    public function info_nota_suplayer() {
        $nota = $this->input->post('nota');
        $penjualan = $this->Mlaporan->nota_penjulan_suplayer($nota);

        $nc = $penjualan->nama_suplayer;
        $hc = $penjualan->hp_suplayer;
        $data_penjulan = array(
            'petugas' => $penjualan->nama,
            'tanggal' => date('d-m-Y h:i:s ', strtotime($penjualan->tanggal)),
            'nama_c' => $nc,
            'hp_c' => $nc,
        );
        $detail_penjualan = $this->Mlaporan->detail_nota_penjulan_suplayer($nota, $this->input->post('pilihtoko')); 
        $no = 1;
        foreach ($detail_penjualan as $value) {
            $row = array();
            $row[] = '<tr>';
            $row[] = '<td>' . $no++ . '</td>';
            $row[] = '<td>' . $value->nama_barang . '</td>';
            $row[] = '<td>' . $value->jumlah . '</td>';
            $row[] = '<td>' . $this->rupiah($value->hargabeli) . '</td>';
            $row[] = '<td>' . $this->rupiah($value->jumlah * $value->hargabeli) . '</td>';
            $row[] = '</tr>';
            $data[] = $row;
        }
        $output = array(
            'penjualan' => $data_penjulan,
            'detail_penjualan' => $data
        );
        echo json_encode($output);
    }

    public function info_nota() {
        $nota = $this->input->post('nota');
        $penjualan = $this->Mlaporan->nota_penjulan_customer($nota);
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
        $detail_penjualan = $this->Mlaporan->detail_nota_penjulan_customer($nota, $this->input->post('pilihtoko')); 
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

     public function infohistory_nota() {
        $nota =$this->input->post('nota');
        $penjualan = $this->Mlaporan->nota_penjulan_customerhistory($nota);
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
        $detail_penjualan = $this->Mlaporan->detailhistory_nota_penjulan_customer($nota); 
        $no = 1;
        foreach ($detail_penjualan as $value) {
            $row = array();
            $row[] = '<tr>';
            $row[] = '<td>' . $no++ . '</td>';
            $row[] = '<td>' . $value->tanggal . '</td>';
            $row[] = '<td>' . $this->rupiah($value->bayar)  . '</td>';
            $row[] = '<td>' . $this->rupiah($value->totalbayar) . '</td>';
            $row[] = '<td>' .trim($this->rupiah($value->sisa_piutang) ,'-'). '</td>';
            $row[] = '</tr>';
            $data[] = $row;
        }
        $output = array(
            'penjualanhistory' => $data_penjulan,
            'detail_penjualanhistory' => $data
        );
        echo json_encode($output);
    }

    public function infohistory_nota_suplayer() {
        $nota =$this->input->post('nota');
        $penjualan = $this->Mlaporan->nota_penjulan_customerhistory_suplayer($nota);
        $nc = $penjualan->nama_suplayer;
        $data_penjulan = array(
            'petugas' => $penjualan->nama,
            'tanggal' => date('d-m-Y h:i:s ', strtotime($penjualan->tanggal)),
            'nama_c' => $nc,
            
        );
        $detail_penjualan = $this->Mlaporan->detailhistory_nota_penjulan_suplayer($nota); 
        $no = 1;
        foreach ($detail_penjualan as $value) {
            $row = array();
            $row[] = '<tr>';
            $row[] = '<td>' . $no++ . '</td>';
            $row[] = '<td>' . $value->tanggal . '</td>';
            $row[] = '<td>' . $this->rupiah($value->bayar)  . '</td>';
            $row[] = '<td>' . $this->rupiah($value->totalbayar) . '</td>';
            $row[] = '<td>' .trim($this->rupiah($value->sisa_piutang) ,'-'). '</td>';
            $row[] = '</tr>';
            $data[] = $row;
        }
        $output = array(
            'penjualanhistory' => $data_penjulan,
            'detail_penjualanhistory' => $data
        );
        echo json_encode($output);
    }

    public function update_data_piutang() {
        $bayar_sebelumnya = preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('bayar_sebelumnya')));
        $total = preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('tot')));
        $bayar = preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('bayar')));
        $sisa = ($bayar + $bayar_sebelumnya) - $total;
        if ($sisa < 0) {
            $statuslunas = "utang";
            $ket = 'belum';
            $pesan = " <label>Customer memiliki <b class='text-danger'>sisa hutang</b>. Silahkan lakukan pembayran kembali</label>";
        } else {
            $statuslunas = "lunas";
            $ket = 'lunas';
            $pesan = " Piutang customer telah lunas";
        }
        $output_transaksi = array(
            'bayar' => $bayar + $bayar_sebelumnya,
            'status_lunas' => $statuslunas,
        );
        $this->Mlaporan->update_penjualan(array('notatransaksi_penjualan_customer' => $this->input->post('nota')), $output_transaksi);

        $output_historytransaksi_penjualan = array(//start to save tbtransaksi_penjualan
                'notatransaksi_penjualan_customer' => $this->input->post('nota'), // nota baru
                'idcustomer' => $this->input->post('idcustomer'),
                'idtoko' => $this->session->userdata['logged_in']['toko'],
                'tanggal' => date('Y-m-d H:i:s a'),
                'bayar' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('bayar'))),
                'totalbayar' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('tot'))), //total yang 
                'sisa_piutang' =>$sisa
                );
        $this->Mpenjualan->simpan_historytransaksi_penjualan_customer($output_historytransaksi_penjualan);

        $output = array(
            'pesan' => $pesan,
            'ket' => $ket
        );

        echo json_encode($output);
    }

    public function update_data_piutang_suplayer() {
        $bayar_sebelumnya = preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('bayar_sebelumnya')));
        $total = preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('tot')));
        $bayar = preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('bayar')));
        $sisa = ($bayar + $bayar_sebelumnya) - $total;
        if ($sisa < 0) {
            $statuslunas = "utang";
            $ket = 'belum';
            $pesan = " <label>Suplayer memiliki <b class='text-danger'>sisa hutang</b>. Silahkan lakukan pembayran kembali</label>";
        } else {
            $statuslunas = "lunas";
            $ket = 'lunas';
            $pesan = " Piutang Suplayer telah lunas";
        }
        $output_transaksi = array(
            'bayar' => $bayar + $bayar_sebelumnya,
            'status_lunas' => $statuslunas,
        );
        $this->Mlaporan->update_penjualan_suplayer(array('notatransaksi_kulakan ' => $this->input->post('nota')), $output_transaksi);

        $output_historytransaksi_penjualan = array(//start to save tbtransaksi_penjualan
                'notatransaksi_kulakan' => $this->input->post('nota'), // nota baru
                'idsuplayer' => $this->input->post('idsuplayer'),
                'idtoko' => $this->session->userdata['logged_in']['toko'],
                'tanggal' => date('Y-m-d H:i:s a'),
                'bayar' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('bayar'))),
                'totalbayar' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('tot'))), //total yang 
                'sisa_piutang' =>$sisa
                );
        $this->Mpembelian->simpan_historytransaksi_pembelian_suplayer($output_historytransaksi_penjualan);

        $output = array(
            'pesan' => $pesan,
            'ket' => $ket
        );

        echo json_encode($output);
    }

    //------------------------------------------------------------- laporan Omset
    function laporan_omset() {
        $search = $this->input->post('search_omset');
        $toko = $this->input->post('pilihtoko');
        $tgl = explode(' - ', $this->input->post('tgl'));
        $tgl_awal = explode('/', $tgl[0]);
        $tglawal = $tgl_awal[2] . '-' . $tgl_awal[0] . '-' . $tgl_awal[1];
        $tgl_akhir = explode('/', $tgl[1]);
        $tglakhir = $tgl_akhir[2] . '-' . $tgl_akhir[0] . '-' . $tgl_akhir[1];
        $baris = $this->input->post('baris');
        $list = $this->Mlaporan->laporan_omset($search, $tglawal, $tglakhir, $toko, $baris);
        if (count($list) > 0) {
            $no = 1;
            foreach ($list as $value) {
                $row = array();
                if ($value->idcustomer == 0 || $value->idcustomer == "" || $value->jenis_harga_penjualan == "ecer") {
                    $nm_c = 'customer ecer (-)';
                    $print = "print_ecer";
                } else {
                    $nm_c = $value->nama_customer;
                    $print = "print_grosir";
                }
                $row[] = '<tr>';
                $row[] = '<td>' . $no++ . '</td>';
                $row[] = '<td>' . date('d-m-Y H:i:s ', strtotime($value->tanggal)) . '</td>';
                $row[] = '<td>' . $value->notatransaksi_penjualan_customer . '</td>';
                $row[] = '<td>' . $value->jenis_harga_penjualan . '</td>';
                $row[] = '<td>' . $value->nama . '</td>';
                $row[] = '<td>' . $value->nama_marketing . '</td>';
                $row[] = '<td>' . $nm_c . '</td>';
                $row[] = '<td>' . $this->rupiah($value->totalbayar + $value->ongkir) . '</td>';
                $row[] = '<td><a href="#" onclick="' . $print . '(`' . $value->notatransaksi_penjualan_customer . '`)"><i class="fas fa-print"></i>Print</button></a>
                </td>';
                $row[] = '<td><a href="#" data-toggle="modal" data-target="#modal-lg" onclick="info_nota(`' . $value->notatransaksi_penjualan_customer . '`)"><i class="fas fa-search"></i></button></a></td>';
                $row[] = '</tr>';
                $data[] = $row;
                $total_omset[]=$value->totalbayar + $value->ongkir;
            }
//            $jum_omset = $this->Mlaporan->sum_total_penjualan($search, $tglawal, $tglakhir, $toko);
            $sukses = 'ya';
            $jum = $this->rupiah(array_sum($total_omset));
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="10"><span class="text-danger" style="text-transform: uppercase"><b><u> ' . $search . ' </u></b></span> Data kosong ! pastikan interval waktu benar atau kata pencarian sesuai data yang ada  </td></tr>';
            $jum = 0;
        }
        $output = array(
            'sukses' => $sukses,
            'list_omset' => $data,
            'jum_omset' => $jum
        );
        echo json_encode($output);
    }

	function laporan_history_pengajuan() {
        
        $toko = $this->input->post('pilihtoko');
        $tgl = explode(' - ', $this->input->post('tgl'));
        $tgl_awal = explode('/', $tgl[0]);
        $tglawal = $tgl_awal[2] . '-' . $tgl_awal[0] . '-' . $tgl_awal[1];
        $tgl_akhir = explode('/', $tgl[1]);
        $tglakhir = $tgl_akhir[2] . '-' . $tgl_akhir[0] . '-' . $tgl_akhir[1];
        $baris = $this->input->post('baris');
        $list = $this->Mlaporan->laporan_history_pengajuan( $tglawal, $tglakhir, $toko, $baris);
        if (count($list) > 0) {
            $no = 1;
            foreach ($list as $value) {
                $row = array();
                
                $row[] = '<tr>';
                $row[] = '<td>' . $no++ . '</td>';
                $row[] = '<td>' . date('d-m-Y H:i:s ', strtotime($value->tanggal)) . '</td>';
                $row[] = '<td>' . $value->notatransaksi_kulakan  . '</td>';
                $row[] = '<td>' . $value->nama  . '</td>';
                $row[] = '<td>' . $value->status_pengajuan	 . '</td>';
                $row[] = '</tr>';
                $data[] = $row;
                
            }
//            $jum_omset = $this->Mlaporan->sum_total_penjualan($search, $tglawal, $tglakhir, $toko);
            $sukses = 'ya';
            
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="10"><span class="text-danger" style="text-transform: uppercase"><b><u>  </u></b></span> Data kosong ! pastikan interval waktu benar atau kata pencarian sesuai data yang ada  </td></tr>';
            
        }
        $output = array(
            'sukses' => $sukses,
            'list_omset' => $data,
            
        );
        echo json_encode($output);
    }

//--------------------------------------------------------------- laporan income
    function laporan_income() {
        $search = $this->input->post('search_income');
        $toko = $this->input->post('pilihtoko');
        $tgl = explode(' - ', $this->input->post('tgl'));
        $tgl_awal = explode('/', $tgl[0]);
        $tglawal = $tgl_awal[2] . '-' . $tgl_awal[0] . '-' . $tgl_awal[1];
        $tgl_akhir = explode('/', $tgl[1]);
        $tglakhir = $tgl_akhir[2] . '-' . $tgl_akhir[0] . '-' . $tgl_akhir[1];
        $baris = $this->input->post('baris');
        $list = $this->Mlaporan->laporan_income($search, $tglawal, $tglakhir, $toko, $baris);
        if (count($list) > 0) {

            $no = 1;
            foreach ($list as $value) {
                $laba = $this->Mlaporan->total_laba($value->notatransaksi_penjualan_customer);
                $row = array();
                if ($value->idcustomer == 0 || $value->idcustomer == "") {
                    $nm_c = 'customer ecer (-)';
                } else {
                    $nm_c = $value->nama_customer;
                }
                $row[] = '<tr>';
                $row[] = '<td>' . $no++ . '</td>';
                $row[] = '<td>' . date('d-m-Y H:i:s ', strtotime($value->tanggal)) . '</td>';
                $row[] = '<td>' . $value->notatransaksi_penjualan_customer . '</td>';
                $row[] = '<td>' . $value->jenis_harga_penjualan . '</td>';
                $row[] = '<td>' . $value->nama . '</td>';
                $row[] = '<td>' . $value->nama_marketing . '</td>';
                $row[] = '<td>' . $nm_c . '</td>';
                $row[] = '<td>' . $this->rupiah($laba['laba']) . '</td>';
                $row[] = '</tr>';
                $data[] = $row;
                $total_laba[] = $laba['laba'];
            }
//             $jum_income = $this->Mlaporan->sum_total_laba($search, $tglawal, $tglakhir, $toko);
            $sukses = 'ya';
            $jum = $this->rupiah(array_sum($total_laba));
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="8"><span class="text-danger" style="text-transform: uppercase"><b><u> ' . $search . ' </u></b></span> Data kosong ! pastikan interval waktu benar atau kata pencarian sesuai data yang ada  </td></tr>';
            $jum = 0;
        }
        $output = array(
            'sukses' => $sukses,
            'list_income' => $data,
            'jum_income' => $jum
        );
        echo json_encode($output);
    }

}
