<?php

defined('BASEPATH') OR exit('No direct script access allowed');


//------------------------------------------------------------------------------Admin
$route['default_controller'] = 'Clogin';
// Login
$route['proses_login'] = 'Clogin/auten';
$route['admin'] = 'Admin_dashboard';
$route['login'] = 'Clogin';
$route['out'] = 'Clogin/logout';
// Home 
$route['Home'] = 'Admin_dashboard/home';
//Master Barang historystock-barang
$route['Pengajuan-barang'] = 'Admin_dashboard/pengajuan_barang';
$route['Barang'] = 'Admin_dashboard/barang';
$route['tambah-barang'] = 'Admin_dashboard/form_tambah_barang';
$route['edit-barang'] = 'Admin_dashboard/form_edit_barang';
$route['barang-historystock'] = 'Admin_dashboard/barang_historystock';
//Master Pengeluaran pengeluaran
$route['Pengeluaran'] = 'Admin_dashboard/pengeluaran';
$route['tambah-pengeluaran'] = 'Admin_dashboard/form_tambah_pengeluaran';
$route['edit-pengeluaran'] = 'Admin_dashboard/form_edit_pengeluaran'; 
//
$route['Neraca'] = 'Admin_dashboard/neraca';
//  Master Customer
$route['Customer'] = 'Admin_dashboard/customer';
$route['tambah-customer'] = 'Admin_dashboard/form_tambah_customer';
$route['edit-customer'] = 'Admin_dashboard/form_edit_customer';
//  Master Marketing
$route['Marketing'] = 'Admin_dashboard/marketing';
$route['tambah-marketing'] = 'Admin_dashboard/form_tambah_marketing';
$route['edit-marketing'] = 'Admin_dashboard/form_edit_marketing';
//  Master Suplayer
$route['Suplayer'] = 'Admin_dashboard/suplayer';
$route['tambah-suplayer'] = 'Admin_dashboard/form_tambah_suplayer';
$route['edit-suplayer'] = 'Admin_dashboard/form_edit_suplayer';
//  Master Petugas
$route['Petugas'] = 'Admin_dashboard/petugas';
$route['tambah-petugas'] = 'Admin_dashboard/form_tambah_petugas';
$route['edit-petugas'] = 'Admin_dashboard/form_edit_petugas';
// Master Toko
$route['Toko'] = 'Admin_dashboard/toko';
$route['tambah-toko'] = 'Admin_dashboard/form_tambah_toko';
$route['edit-toko'] = 'Admin_dashboard/form_edit_toko';
// Pindah Stock
$route['Pindah-Stock'] = 'Admin_dashboard/pindah_stock';
// Transaksi Penjualan
$route['Transaksi-Penjualan'] = 'Admin_dashboard/transaksi_penjualan';
// Transaksi Pembelian
$route['Transaksi-Pembelian'] = 'Admin_dashboard/transaksi_pembelian';
//Nota Pending
$route['Nota-Pending'] = 'Admin_dashboard/nota_pending';
// Laporan Piutang Customer
$route['Piutang-Customer'] = 'Admin_dashboard/piutang_customer';
// Laporan Piutang Suplayr
$route['Piutang-Suplayer'] = 'Admin_dashboard/piutang_suplayer';
// Laporan omset
$route['Laporan-Omset'] = 'Admin_dashboard/omset';
//Laporan income
$route['Laporan-Income'] = 'Admin_dashboard/income';
//history
$route['Histori-Barang'] = 'Admin_dashboard/histori_barang';
// Grafik
$route['Grafik'] = 'Admin_dashboard/grafik';
//------------------------------------------------------------------------------End Admin
//------------------------------------------------------------------------------Kasir
$route['kasir'] = 'Kasir_dashboard';
//------------------------------------------------------------------------------End Kasir
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

