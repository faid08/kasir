<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_grafik extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mgrafik');
        $this->load->model('Mmaster');
        $this->load->model('Mpenjualan');
        $this->load->model('Mpending');
        $this->load->model('Mlaporan');
    }

    

//--------------------------------------------------------------------------home
    public function grafik_omset() {
//        SELECT CONCAT(YEAR(tanggal),'-',MONTH(tanggal)) AS tahun_bulan, sum(totalbayar) AS omset FROM tbtransaksi_penjualan_customer WHERE `tanggal` BETWEEN '2020-01-01 00:00:00.000000' AND '2020-03-31 00:00:00.000000' GROUP BY YEAR(tanggal),MONTH(tanggal)
        
       $data_omset_pertahun=  $this->Mgrafik->grafik_pertahun_omset();
       foreach ($data_omset_pertahun as $value) {
           $bula[]=$value->bulan;
      $omset[]=number_format($value->omset, 0, '.', '.');
           
       }
       $output=array(
           'bulan'=>$bula,
           'omset'=>$omset
       );
       echo json_encode($output);
    }

}
