<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mgrafik');
        $this->load->model('Mmaster');
        $this->load->model('Mpenjualan');
         $this->load->model('Mpembelian');
        $this->load->model('Mpending');
        $this->load->model('Mlaporan');
    }

    public function index() {
         if (isset($this->session->userdata['logged_in'])) {
            if (($this->session->userdata['logged_in']['level']) == "Kasir") {
                redirect(site_url('kasir'));
            } else {
                $id = $this->Mmaster->where_kode_petugas($this->session->userdata['logged_in']['idptgs']);
                $toko = $this->Mmaster->where_kode_toko($this->session->userdata['logged_in']['toko']);
                $output = array(
                    'nama_user' => $id->nama,
                    'nama_toko' => $toko->nama
                );
                $this->load->view('admin_dashboard', $output);
            }
        } else {
            header("location:login");
        }
    }

    public function rupiah($angka) {

        $hasil_rupiah = number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }

//--------------------------------------------------------------------------home
    public function home() {
        $data = array(
            'jbarang' => $this->Mgrafik->jmlbarang(),
            'jsuplayer' => $this->Mgrafik->jmlsuplayer(),
            'jmarketing' => $this->Mgrafik->jmlmarketing(),
            'jcustomer' => $this->Mgrafik->jmlcustomer(),
            'trenbarang' => $this->Mgrafik->trenbarang(),
            'loyalcus' => $this->Mgrafik->cusloyal()
        );
        // $data = array(
        //     'jbarang' => 10,
        //     'jsuplayer' => 12,
        //     'jmarketing' =>14,
        //     'jcustomer' => 15,
        //     'trenbarang' => $this->Mgrafik->trenbarang(),
        //     'loyalcus' =>$this->Mgrafik->cusloyal()
        // );
        $this->load->view('v-admin/home', $data);
    }
    //---------------------------------------------------------- master entri pengeluaran
     public function pengeluaran() {
        $output = array(
            'jpengeluaran' => $this->Mgrafik->jmlpengeluaran(),
            'toko'=>$this->Mmaster->toko()
        );
        $this->load->view('v-admin/pengeluaran', $output);
    }

    public function neraca() {
         $output = array(
            'toko'=>$this->Mmaster->toko()
        );
        $this->load->view('v-admin/neraca', $output);
    }
    public function form_tambah_pengeluaran() {
        // $output = array(
        //     'jenisbarang'=>$this->Mmaster->pilihjenisbarang()
        // );
        $this->load->view('v-admin/pengeluaran_tambah');

    }
     public function form_edit_pengeluaran() {
        $id = $this->input->post('id');
        // $idtoko = $this->input->post('idtoko');
        $data_pengeluaran = $this->Mmaster->where_kode_pengeluaran($id);
        $output = array(
            'idpengeluaran' => $data_pengeluaran->idpengeluaran,
            'keterangan' => $data_pengeluaran->keterangan,
            'tanggal' => $data_pengeluaran->tanggal,
            'nominal_pengeluaran' => $this->rupiah($data_pengeluaran->nominal_pengeluaran)
        );
        $this->load->view('v-admin/pengeluaran_edit', $output);
    }

    // public function form_edit_pengeluarankasir() {
    //     $id = $this->input->post('id');
    //     // $idtoko = $this->input->post('idtoko');
    //     $data_pengeluaran = $this->Mmaster->where_kode_pengeluaran($id);
    //     $output = array(
    //         'idpengeluaran' => $data_pengeluaran->idpengeluaran,
    //         'keterangan' => $data_pengeluaran->keterangan,
    //         'tanggal' => $data_pengeluaran->tanggal,
    //         'nominal_pengeluaran' => $this->rupiah($data_pengeluaran->nominal_pengeluaran)
    //     );
    //     $this->load->view('v-kasir/pengeluaran_edit', $output);
    // }

//---------------------------------------------------------- master entri barang
    public function barang() {
        $output = array(
            'jbarang' => $this->Mgrafik->jmlbarang(),
            'toko'=>$this->Mmaster->toko()
        );
        $this->load->view('v-admin/barang', $output);
    }


	public function pengajuan_barang() {
        $output = array(
            'jbarang' => $this->Mgrafik->jmlbarang(),
            'toko'=>$this->Mmaster->toko()
        );
        $this->load->view('v-admin/pengajuan_barang', $output);
    }


    public function form_tambah_barang() {
        $output = array(
            'jenisbarang'=>$this->Mmaster->pilihjenisbarang()
        );
        $this->load->view('v-admin/barang_tambah', $output);

    }

    public function form_edit_barang() {
        $id = $this->input->post('id');
        $idtoko = $this->input->post('idtoko');
        $data_barang = $this->Mmaster->where_kode_barang($id,$idtoko);
        $output = array(
            'idbarang' => $data_barang->idbarang,
            'barcode' => $data_barang->barcode,
            'nama' => $data_barang->nama_barang,
            'hbeli' => $this->rupiah($data_barang->hargabeli),
            'hecer1' => $this->rupiah($data_barang->hecer1),
            'hecer2' => $this->rupiah($data_barang->hecer2),
            'hgrosir1' => $this->rupiah($data_barang->hgrosir1),
            'hgrosir2' => $this->rupiah($data_barang->hgrosir2),
            'hgrosir3' => $this->rupiah($data_barang->hgrosir3),
            'idtoko' => $data_barang->idtoko,
            'hpromo' => $this->rupiah($data_barang->hpromo),
            'tanggalpromo' => $data_barang->tanggalpromo,
            'isibarang' => $data_barang->isibarang,
            'statusbarang' => $data_barang->statusbarang
        );
        $this->load->view('v-admin/barang_edit', $output);
    }


     public function barang_historystock() {
        $id = $this->input->post('id');
        $idtoko = $this->input->post('idtoko');
        $output = array(
            'list_barangstock'=>$this->Mmaster->lihat_bstock($id,$idtoko)
        );
        $this->load->view('v-admin/barang_historystock', $output);
    }
    public function form_hapus_barang() {
       $id = $this->input->post('id');
       $this->Mmaster->hapus_data_barang($id);
            $sukses = 'ya';
            $pesan = '<label >Data barang <span  style="color:red">"' . $this->input->post('id') . '"</span> berhasil di Hapus !</label>';
        
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan
        );
        echo json_encode($output);
    }

    public function export_data_barang() {

        $toko = $this->input->post('toko');
        $nama_barang = $this->input->post('search_nama_barang');
        $filter_stock = $this->input->post('filter_stock');
        $baris = $this->input->post('baris');

               $output = array(
                        'data' => $this->Mmaster->search_barang($nama_barang, $filter_stock, $toko,$baris)
                    );
                
        $this->load->view('v-admin/barang_export', $output);
    }

//-------------------------------------------------------- master entri customer
    public function customer() {
        $output = array(
            'jcustomer' => $this->Mgrafik->jmlcustomer()
        );
        $this->load->view('v-admin/customer', $output);
    }

    public function form_tambah_customer() {
        $this->load->view('v-admin/customer_tambah');
    }

    public function form_edit_customer() {
        $id = $this->input->post('id');
        $data_customer = $this->Mmaster->where_kode_customer($id);
        $output = array(
            'id' => $id,
            'nama' => $data_customer->nama_customer,
            'alamat' => $data_customer->alamat_customer,
            'wilayah' => $data_customer->wilayah_customer,
            'hp' => $data_customer->hp_customer,
            'status' => $data_customer->status_customer,
            'idmarketing' => $data_customer->idmarketing,
            'nama_marketing' => $data_customer->nama_marketing
        );
        $this->load->view('v-admin/customer_edit', $output);
    }

//------------------------------------------------------- master entri marketing
    public function marketing() {
        $output = array(
            'jmarketing' => $this->Mgrafik->jmlmarketing()
        );
        $this->load->view('v-admin/marketing', $output);
    }

    public function form_tambah_marketing() {
        $this->load->view('v-admin/marketing_tambah');
    }

    public function form_edit_marketing() {
        $id = $this->input->post('id');
        $data_marketing = $this->Mmaster->where_kode_marketing($id);
        $output = array(
            'id' => $id,
            'nama' => $data_marketing->nama_marketing,
            'alamat' => $data_marketing->alamat_marketing,
            'hp' => $data_marketing->hp_marketing
        );
        $this->load->view('v-admin/marketing_edit', $output);
    }

//-------------------------------------------------------- master entri suplayer
    public function suplayer() {
        $output = array(
            'jsuplayer' => $this->Mgrafik->jmlsuplayer()
        );
        $this->load->view('v-admin/suplayer', $output);
    }

    public function form_tambah_suplayer() {
        $this->load->view('v-admin/suplayer_tambah');
    }

    public function form_edit_suplayer() {
        $id = $this->input->post('id');
        $data_suplayer = $this->Mmaster->where_kode_suplayer($id);
        $output = array(
            'id' => $id,
            'nama' => $data_suplayer->nama_suplayer,
            'alamat' => $data_suplayer->alamat_suplayer,
            'hp' => $data_suplayer->hp_suplayer
        );
        $this->load->view('v-admin/suplayer_edit', $output);
    }

    //-------------------------------------------------------- master entri petugas
    public function petugas() {
        $output = array(
            'jpetugas' => $this->Mgrafik->jmlpetugas()
        );
        $this->load->view('v-admin/petugas', $output);
    }

    public function form_tambah_petugas() {
        $output= array(
            'toko'=>$this->Mmaster->toko()
        );
        $this->load->view('v-admin/petugas_tambah',$output);
    }

    public function form_edit_petugas() {
        $id = $this->input->post('id');
        $data_petugas = $this->Mmaster->where_kode_petugas($id);
        $output = array(
            'id' => $id,
            'nama' => $data_petugas->nama,
            'alamat' => $data_petugas->alamat,
            'hp' => $data_petugas->hp,
            'uname' => $data_petugas->username,
            'pass' => $data_petugas->password,
            'jabatan' => $data_petugas->jabatan,
            'status' => $data_petugas->statususer
        );
        $this->load->view('v-admin/petugas_edit', $output);
    }
    //-------------------------------------------------------- master entri toko
    public function toko() {
        $output = array(
            'jtoko' => $this->Mgrafik->jmltoko()
        );
        $this->load->view('v-admin/toko', $output);
    }

    public function form_tambah_toko() {
        $output= array(
            'toko'=>$this->Mmaster->toko()
        );
        $this->load->view('v-admin/toko_tambah',$output);
    }

    public function form_edit_toko() {
        $id = $this->input->post('id');
        $data_toko = $this->Mmaster->where_kode_toko($id);
        $output = array(
            'id' => $id,
            'nama' => $data_toko->nama,
            'alamat' => $data_toko->alamat_toko,
            'nominal_modal' => $data_toko->nominal_modal
        );
        $this->load->view('v-admin/toko_edit', $output);
    }
//----------------------------------------------------------- transaksi penjualan
    public function pindah_stock() {
        $output = array(
            'toko'=>$this->Mmaster->toko()
        );
        $this->load->view('v-admin/pindah_stock', $output);
    }
//----------------------------------------------------------- transaksi penjualan
    public function transaksi_penjualan() {
        $idptgs = $this->session->userdata['logged_in']['idptgs'];
        $nota_terakhir = $this->Mpenjualan->nota_terakhir_penjualan($idptgs);
        $countnota_terakhir = count($nota_terakhir);
        if ($countnota_terakhir == 0) {
            $nomer_nota_baru = '1';
        } else {
            $array_nomer_nota = array();
            foreach ($nota_terakhir as $value) {
                $nota = $value->notatransaksi_penjualan_customer;
                $nomer_nota = explode('-', $nota);
                $array_nomer_nota[] = $nomer_nota[1];
            }
            rsort($array_nomer_nota);
            $nomer_nota_baru = $array_nomer_nota[0] + 1;
        }
        $notanya = 'KN' . $this->session->userdata['logged_in']['idptgs'] . '-' . $nomer_nota_baru;
        $output = array(
            'nofaktur' => $notanya
        );
        $this->load->view('v-admin/transaksi_penjualan', $output);
    }

//----------------------------------------------------------- transaksi pembelian
   
  public function transaksi_pembelian() {
        $idptgs = $this->session->userdata['logged_in']['idptgs'];
        $nota_terakhir = $this->Mpembelian->nota_terakhir_pembelian($idptgs);
        $countnota_terakhir = count($nota_terakhir);
        if ($countnota_terakhir == 0) {
            $nomer_nota_baru = '1';
        } else {
            $array_nomer_nota = array();
            foreach ($nota_terakhir as $value) {
                $nota = $value->notatransaksi_kulakan;
                $nomer_nota = explode('-', $nota);
                $array_nomer_nota[] = $nomer_nota[1];
            }
            rsort($array_nomer_nota); // sort nomer nota paling besar ke kecil
            $nomer_nota_baru = $array_nomer_nota[0] + 1; //mengambil nomer nota paling besar
        }
        //----------------------------------------------------------------------
        $notanya = 'KF' . $this->session->userdata['logged_in']['idptgs'] . '-' . $nomer_nota_baru;

        $output = array(
            'nofaktur' => $notanya,
            'jenisbarang'=>$this->Mmaster->pilihjenisbarang()
        );
        $this->load->view('v-admin/transaksi_pembelian',$output);
    }
//----------------------------------------------------------------- nota pending
    public function nota_pending() {
        $output = array(
            'toko'=>$this->Mmaster->toko()
        );
        $this->load->view('v-admin/nota_pending',$output);
    }

    public function form_edit_nota_pending() {
        $nota = $this->input->post('nota');
        $output = array(
            'penjualan' => $this->Mpending->nota_penjulan_customer($nota),
            'detail_penjualan' => $this->Mpending->detail_nota_penjulan_customer($nota,$this->input->post('pilihtoko')),
        );
        $this->load->view('v-admin/nota_pending_edit', $output);
    }

//----------------------------------------------------- laporan piutang customer
    public function piutang_customer() {
        $output = array(
            'toko'=>$this->Mmaster->toko()
        );
        $this->load->view('v-admin/piutang_customer',$output);
    }

    public function piutang_suplayer() {
        $output = array(
            'toko'=>$this->Mmaster->toko()
        );
        $this->load->view('v-admin/piutang_suplayer',$output);
    }

    public function form_edit_piutang_customer() {
        $id = $this->input->post('id');
        $data = $this->Mlaporan->nota_penjulan_customer($id);
        $output = array(
            'nota' => $data->notatransaksi_penjualan_customer,
            'nama' => $data->nama_customer,
            'ongkir' => $data->ongkir,
            'totalbayar' => $data->totalbayar,
            'bayar' => $data->bayar,
            'idcustomer'=>$data->idcustomer
        );
        $this->load->view('v-admin/piutang_customer_edit', $output); 
    }

    public function form_edit_piutang_suplayer() {
        $id = $this->input->post('id');
        $data = $this->Mlaporan->nota_penjulan_suplayer($id);
        $output = array(
            'nota' => $data->notatransaksi_kulakan,
            'nama' => $data->nama_suplayer,
            'totalbayar' => $data->totalbayar,
            'bayar' => $data->bayar,
            'idsuplayer'=>$data->idsuplayer
        );
        $this->load->view('v-admin/piutang_suplayer_edit', $output); 
    }

//----------------------------------------------------- laporan omset
    public function omset() {
        $output = array(
            'toko'=>$this->Mmaster->toko()
        );
        $this->load->view('v-admin/omset',$output);
    }

//----------------------------------------------------- laporan income
    public function income() {
        $output = array(
            'toko'=>$this->Mmaster->toko()
        );
        $this->load->view('v-admin/income',$output);
    }
    //----------------------------------------------------- history
public function histori_barang() {
        $output = array(
            'jbarang' => $this->Mgrafik->jmlbarang(),
            'toko'=>$this->Mmaster->toko()
        );
        $this->load->view('v-admin/histori_barang', $output);
    }
//----------------------------------------------------- Grafik
    public function grafik() {
        $data_omset_pertahun = $this->Mgrafik->grafik_pertahun_omset();
        foreach ($data_omset_pertahun as $value) {
            $bulan_omset[] = $value->bulan;
            $omset[] = $value->omset;
        }
        $data_omset_pertahun_income = $this->Mgrafik->grafik_pertahun_income();
        foreach ($data_omset_pertahun_income as $value) {
            $bulan_income[] = $value->bulan;
            $income[] = $value->income;
        }
        $output = array(
            'bulan_omset' => $bulan_omset,
            'omset' => $omset,
            'bulan_income' => $bulan_income,
            'income' => $income
        );
//         echo json_encode($income);
        $this->load->view('v-admin/grafik', $output);
    }

}
