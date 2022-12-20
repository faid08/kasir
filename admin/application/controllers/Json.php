<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mjson');
        $this->load->model('Mpetugas');
    }

 //----------------------------------------------------------------------- barang
    public function barang() {
        $nama = $this->input->get('nama_barang');
        $id = $this->input->post('id_barang');
        $list_barag = $this->Mjson->search_barang($nama, $id);
        if (count($list_barag) > 0) {
            foreach ($list_barag as  $key => $value) {
                $row = array();
                $row[] =  $value->idbarang ;
                $row[] =  $value->nama_barang ;
                $row[] =  $value->hargabeli ;
                $row[] =  $value->hecer1 ;
                $row[] =  $value->hecer2 ;
                $row[] =  $value->hgrosir1 ;
                $row[] =  $value->hgrosir2 ;
                $row[] =  $value->hgrosir3 ;
                $row[] =  $value->produksi ;
                $row[] =  $value->stock ;
                $data[] = $row;
            }
        } else {
            $data = "Null";
        }
        $output = array(
            'list_barang' => $data
        );
        echo json_encode($output);
    }

    

//--------------------------------------------------------------------- customer
    public function search_customer() {
        $search_customer_by = $this->input->post('search_customer_by');
        $filter_nama = $this->input->post('fn');
        $filter_alamat = $this->input->post('fa');
        $fillter_wilayah = $this->input->post('fw');
        $list_customer = $this->Mjson->search_customer($search_customer_by, $filter_nama, $filter_alamat, $fillter_wilayah);
        if (count($list_customer) > 0) {
            $no = 1;
            foreach ($list_customer as $value) {
                $row = array();
                $row[] = '<tr onclick=form_edit_customer("' . $value->idcustomer . '")>';
                $row[] =  $no++ ;
                $row[] =  $value->nama_customer ;
                $row[] =  $value->alamat_customer ;
                $row[] =  $value->wilayah_customer ;
                $row[] =  $value->hp_customer ;
                $row[] =  $value->status_customer ;
                $row[] =  $value->nama_marketing ;
                $row[] = '</tr>';
                $data[] = $row;
            }
            $sukses = 'ya';
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="9"><span class="text-danger" style="text-transform: uppercase"><b><u> ' . $search_customer_by . ' </u></b></span> Tidak ditemukan silahkan gunakan kata pencarian lain !</td></tr>';
        }
        $output = array(
            'sukses' => $sukses,
            'list_customer' => $data
        );
        echo json_encode($output);
    }

 
    //--------------------------------------------------------------------- marketing
    public function search_marketing() {
        $search_marketing_by = $this->input->post('search_marketing_by');
        $filter_nama = $this->input->post('fn');
        $filter_alamat = $this->input->post('fa');
        $list_marketing = $this->Mjson->search_marketing($search_marketing_by, $filter_nama, $filter_alamat);
        if (count($list_marketing) > 0) {
            $no = 1;
            foreach ($list_marketing as $value) {
                $row = array();
                $row[] = '<tr onclick=form_edit_marketing("' . $value->idmarketing . '")>';
                $row[] =  $no++ ;
                $row[] =  $value->nama_marketing ;
                $row[] =  $value->alamat_marketing ;
                $row[] =  $value->hp_marketing ;
                $row[] = '</tr>';
                $data[] = $row;
            }
            $sukses = 'ya';
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="9"><span class="text-danger" style="text-transform: uppercase"><b><u> ' . $search_marketing_by . ' </u></b></span> Tidak ditemukan silahkan gunakan kata pencarian lain !</td></tr>';
        }
        $output = array(
            'sukses' => $sukses,
            'list_marketing' => $data
        );
        echo json_encode($output);
    }
    //----------------------------------------------------------------- suplayer
    public function search_suplayer() {
        $search_suplayer_by = $this->input->post('search_suplayer_by');
        $filter_nama = $this->input->post('fn');
        $filter_alamat = $this->input->post('fa');
        $list_suplayer = $this->Mjson->search_suplayer($search_suplayer_by, $filter_nama, $filter_alamat);
        if (count($list_suplayer) > 0) {
            $no = 1;
            foreach ($list_suplayer as $value) {
                $row = array();
                $row[] = '<tr onclick=form_edit_suplayer("' . $value->idsuplayer . '")>';
                $row[] =  $no++ ;
                $row[] =  $value->nama_suplayer ;
                $row[] =  $value->alamat_suplayer ;
                $row[] =  $value->hp_suplayer ;
                $row[] = '</tr>';
                $data[] = $row;
            }
            $sukses = 'ya';
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="9"><span class="text-danger" style="text-transform: uppercase"><b><u> ' . $search_suplayer_by . ' </u></b></span> Tidak ditemukan silahkan gunakan kata pencarian lain !</td></tr>';
        }
        $output = array(
            'sukses' => $sukses,
            'list_suplayer' => $data
        );
        echo json_encode($output);
    }


    //----------------------------------------------------------------- petugas
    public function search_petugas() {
        $search_petugas_by = $this->input->post('search_petugas_by');
        $list_petugas = $this->Mjson->search_petugas($search_petugas_by);
        if (count($list_petugas) > 0) {
            $jumlah_nota = $this->Mgrafik->progres_keaktifan_all();
            $no = 1;
            foreach ($list_petugas as $value) {
                $jumlah_nota_per_user = $this->Mgrafik->progres_keaktifan_per_user($value->iduser);
                $persen = ($jumlah_nota_per_user->jum_per_user / $jumlah_nota) * 100;
                if ($persen < 20) {
                    $warna = "red";
                } else if ($persen < 30) {
                    $warna = "warning";
                } else {
                    $warna = "success";
                }
                $row = array();
                $row[] = '<tr onclick=form_edit_petugas("' . $value->iduser . '")>';
                $row[] =  $no++ ;
                $row[] =  $value->username ;
                $row[] =  $value->nama ;
                $row[] =  $value->alamat ;
                $row[] =  $value->hp ;
                $row[] =  $value->jabatan ;
                $row[] =  $value->statususer ;
                $row[] = '<td>
                    <div class="progress progress-xs">
                  <div class="progress-bar bg-' . $warna . ' progress-bar-striped" role="progressbar"
                       aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: ' . $persen . '%">
                  </div>
                </div>
                 <small>' . $jumlah_nota_per_user->jum_per_user . '/' . $jumlah_nota . ' Transaksi</small>
                        </td>';
                $row[] = '</tr>';
                $data[] = $row;
            }
            $sukses = 'ya';
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="8"><span class="text-danger" style="text-transform: uppercase"><b><u> ' . $search_petugas_by . ' </u></b></span> Tidak ditemukan silahkan gunakan kata pencarian lain !</td></tr>';
        }
        $output = array(
            'sukses' => $sukses,
            'list_petugas' => $data
        );
        echo json_encode($output);
    }


}
