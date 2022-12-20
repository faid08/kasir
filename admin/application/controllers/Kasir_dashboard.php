<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir_dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mgrafik');
        $this->load->model('Mmaster');
        $this->load->model('Mpenjualan');
        $this->load->model('Mpending');
        $this->load->model('Mlaporan');
        $this->load->model('Mpetugas');
    }

    public function index() {
        if (($this->session->userdata['logged_in']['level']) == "Admin" || ($this->session->userdata['logged_in']['level']) == "Supervisor") {
            redirect(site_url('admin'));
        } else {
            $id = $this->Mmaster->where_kode_petugas($this->session->userdata['logged_in']['idptgs']);
            $toko = $this->Mmaster->where_kode_toko($this->session->userdata['logged_in']['toko']);
            $output = array(
                'nama_user' => $id->nama,
                'nama_toko' => $toko->nama
            );
            $this->load->view('kasir_dashboard', $output);
        }
    }

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
        $this->load->view('v-kasir/transaksi_penjualan', $output);
    }
	public function transaksi_pengajuan() {
        $idptgs = $this->session->userdata['logged_in']['idptgs'];
        $nota_terakhir = $this->Mpenjualan->nota_terakhir_pengajuan();
        $countnota_terakhir = count($nota_terakhir);
        if ($countnota_terakhir == 0) {
            $nomer_nota_baru = '1';
        } else {
            
            $nomer_nota_baru = $countnota_terakhir + 1;
        }
        $notanya = $nomer_nota_baru;
        $output = array(
            'nofaktur' => $notanya
        );
        $this->load->view('v-kasir/transaksi_pengajuan', $output);
    }

	public function histori_transaksi_pengajuan() {
        $output = array(
            'toko'=>$this->Mmaster->toko()
        );
        $this->load->view('v-kasir/history_pengajuan_stock', $output);
    }
	
    public function barang() {
        $output = array(
            'jbarang' => $this->Mgrafik->jmlbarang()
        );
        $this->load->view('v-kasir/barang', $output);
    }

    public function nota_pending() {
        $this->load->view('v-kasir/nota_pending');
    }

    public function form_edit_nota_pending() {
        $nota = $this->input->post('nota');
        $output = array(
            'penjualan' => $this->Mpending->nota_penjulan_customer($nota),
            'detail_penjualan' => $this->Mpending->detail_nota_penjulan_customer($nota,$this->input->post('pilihtoko')),
        );
        $this->load->view('v-kasir/nota_pending_edit', $output);
    }

    public function omset() {
        $output = array(
            'toko'=>$this->Mmaster->toko()
        );
        $this->load->view('v-kasir/omset',$output);
    }

    public function profil() {
        $id = $this->session->userdata['logged_in']['idptgs'];
        $data_petugas = $this->Mmaster->where_kode_petugas($id);
        $toko = $this->Mmaster->where_kode_toko($this->session->userdata['logged_in']['toko']);
        $output = array(
            'id' => $id,
            'nama' => $data_petugas->nama,
            'alamat' => $data_petugas->alamat,
            'hp' => $data_petugas->hp,
            'uname' => $data_petugas->username,
            'pass' => $data_petugas->password,
            'jabatan' => $data_petugas->jabatan,
            'status' => $data_petugas->statususer,
            'nama_toko' => $toko->nama,
            'level' => $this->session->userdata['logged_in']['level']
        );
        $this->load->view('v-kasir/profil', $output);
    }

    public function update_petugas() {
        $username = $this->input->post('uname');
        $pass = $this->input->post('pass');
        if ($username == "") {
            $u = $this->input->post('uname_lama');
        } else {
            $u = $this->input->post('uname');
        }
        if ($pass == "") {
            $p = $this->input->post('pass_lama');
        } else {
            $p = $this->input->post('pass');
        }

        $result = $this->Mpetugas->read_user_information($username);
        if ($this->input->post('petugas') == "") {
            $sukses = 'tidak';
            $pesan = 'Nama lengkap petugas tidak boleh kosong';
        } elseif ($result != false) {
            $sukses = 'tidak';
            $pesan = 'Maaf username telah terdaftar, silahkan gunakan kata lain';
        } else {
            $id = $this->input->post('id_petugas');
            $data_petugas = array(
                'nama' => $this->input->post('petugas'),
                'alamat' => $this->input->post('alamat'),
                'hp' => $this->input->post('hp'),
                'username' => $u,
                'password' => $p
            );
            $this->Mmaster->update_data_petugas(array('iduser' => $id), $data_petugas);
            $sukses = 'ya';
            $pesan = '<label >Data petugas <span  style="color:red">"' . $this->input->post('petugas') . '"</span> berhasil di perbaharui !</label>';
        }
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan,
            'nama' => $this->input->post('petugas')
        );
        echo json_encode($output);
    }

    public function customer() {
        $output = array(
            'jcustomer' => $this->Mgrafik->jmlcustomer()
        );
        $this->load->view('v-kasir/customer', $output);
    }
    public function pengeluarankasir() {
        $idtoko = $this->session->userdata['logged_in']['toko'];
        $output = array(
            'jpengeluaran' => $this->Mgrafik->jmlpengeluarankasir($idtoko)
        );

        $this->load->view('v-kasir/pengeluaran', $output);
    }


    public function tokokasir() {
        $idtoko = $this->session->userdata['logged_in']['toko'];
         $output = array(
            'jtoko' => $this->Mgrafik->jmltokokasir($idtoko)
        );
        $this->load->view('v-kasir/toko', $output);
    }

     public function form_tambah_pengeluarankasir() {
        // $output = array(
        //     'jenisbarang'=>$this->Mmaster->pilihjenisbarang()
        // );
        $this->load->view('v-kasir/pengeluaran_tambah');

    }
    public function form_edit_pengeluarankasir() {
        $id = $this->input->post('id');
        // $idtoko = $this->input->post('idtoko');
        $data_pengeluaran = $this->Mmaster->where_kode_pengeluaran($id);
        $output = array(
            'idpengeluaran' => $data_pengeluaran->idpengeluaran,
            'keterangan' => $data_pengeluaran->keterangan,
            'tanggal' => $data_pengeluaran->tanggal,
            'nominal_pengeluaran' =>$data_pengeluaran->nominal_pengeluaran
        );
        $this->load->view('v-kasir/pengeluaran_edit', $output);
    }
    // public function jsonpengeluarankasir() {
    //     $idtoko = $this->session->userdata['logged_in']['toko'];
    //     $output = array('data' => array());
    //     $list_pengeluaran = $this->Mmaster->lihat_pengeluaran($idtoko);
    //     if (count($list_pengeluaran) > 0) {
    //         $no = 1;
    //         foreach ($list_pengeluaran as $value) {
    //             $k=$value->keterangan;
    //             $nominal=$value->nominal_pengeluaran;
    //             $tgl=$value->tanggal;
    //             $opsi=$value->tanggal;
    //             $output['data'][] = array(
    //                     $no,
    //                     $k,
    //                     $nominal,
    //                     $tgl
    //                 );
    //             $no++;
    //         }
    //     }
    //     echo json_encode($output);
    // }

    public function form_tambah_customer() {
        $this->load->view('v-kasir/customer_tambah');
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
        $this->load->view('v-kasir/customer_edit', $output);
    }

}
