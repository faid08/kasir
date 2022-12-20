<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_master extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mmaster');
        $this->load->model('Mgrafik');
        $this->load->model('Mpetugas');
		$this->load->model('Mpembelian');
    }
    public function Barcode($kodenya){
       $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        //generate barcode
        // Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
        // $imageResource =  Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
		// $imagepng($imageResource, $path);
    }

    public function rupiah($angka) {
        $hasil_rupiah = number_format($angka, 0, '.', '.');
        return $hasil_rupiah;
    }
    //----------------------------------------------------------------------- search_pengeluaran
    public function search_pengeluaran() {
        $toko = $this->input->post('toko');
        $nama_pengeluaran = $this->input->post('search_nama_pengeluaran');
        $baris = $this->input->post('baris');
        $list_pengeluaran = $this->Mmaster->search_pengeluaran($nama_pengeluaran, $toko,$baris);
        if (count($list_pengeluaran) > 0) {
            $no = 1;
            foreach ($list_pengeluaran as $value) {
                $row = array();
                $row[] = '<tr>';
                $row[] = '<td>' . $no++ . '</td>';
                $row[] = '<td>' . $value->keterangan . '</td>';
                $row[] = '<td>' . $this->rupiah($value->nominal_pengeluaran) . '</td>';
                $row[] = '<td>' . $value->tanggal . '</td>'; 
                 // if (($this->session->userdata['logged_in']['level']) == "Admin" || ($this->session->userdata['logged_in']['level']) == "Supervisor") {
                //     $row[] = '<td><a href="#" onclick="form_edit_pengeluaran('.$value->idpengeluaran.','.$value->idpengeluaran.')"><button type="button" class="btn btn-info" ><i class="fas fa-edit"></i>Edit</button></a>
                // </td>';
                // }
                
                $row[] = '</tr>';
                $data[] = $row;
            }
            $sukses = 'ya';
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="12"><span class="text-danger" style="text-transform: uppercase"><b><u> ' . $nama_pengeluaran . ' </u></b></span> Tidak ditemukan silahkan gunakan kata pencarian lain atau tambahkan di barang baru</td></tr>';
        }
        $output = array(
            'sukses' => $sukses,
            'list_pengeluaran' => $data,
            'nama' => $this->input->post('pengeluaran')
        );
        echo json_encode($output);
    }

    public function search_neraca() {
        $toko = $this->input->post('toko');
        $list_neraca = $this->Mmaster->search_neraca($toko);
        if (count($list_neraca) > 0) {
            $no = 1;
            foreach ($list_neraca as $value) {
                $row = array();
                $row[] = '<tr>';
                $row[] = '<td>Nama Toko</td>';
                $row[] = '<td>: ' . $value->nama . '</td>';
                $row[] = '</tr>';
                
                $row[] = '<tr>';
                $row[] = '<td>Total Penjualan</td>';
                $row[] = '<td>: ' . $this->rupiah($value->total_penjualan) . '</td>';
                $row[] = '</tr>';
                $row[] = '<tr>';
                $row[] = '<td>Total Pembelian</td>';
                $row[] = '<td>: ' . $this->rupiah($value->total_kulakan) . '</td>';
                $row[] = '</tr>';
                $row[] = '<tr>';
                $row[] = '<td>Total Pengeluaran </td>';
                $row[] = '<td>: ' . $this->rupiah($value->Total_Pengeluaran ) . '</td>';
                $row[] = '</tr>';
                $row[] = '<tr>';
                $row[] = '<td>Total Hutang Cutomer </td>';
                $row[] = '<td>: ' . $this->rupiah($value->Total_Hutang_Cutomer) . '</td>';
                $row[] = '</tr>';
                $row[] = '<tr>';
                $row[] = '<td>Total Hutang Suplayer </td>';
                $row[] = '<td>: ' . $this->rupiah($value->Total_Hutang_Suplayer) . '</td>';
                $row[] = '</tr>';
                $row[] = '<tr>';
                $row[] = '<td>Sisa Modal</td>';
                $row[] = '<td>: ' . $this->rupiah($value->MODAL) . '</td>';
                $row[] = '</tr>';
                $data[] = $row;
            }
            $sukses = 'ya';
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="12"><span class="text-danger" style="text-transform: uppercase"><b><u> ' . $toko . ' </u></b></span> Tidak ditemukan silahkan gunakan kata pencarian lain atau tambahkan di barang baru</td></tr>';
        }
        $output = array(
            'sukses' => $sukses,
            'list_neraca' => $data
        );
        echo json_encode($output);
    }

    public function simpan_pengeluaran() {
        if ($this->input->post('keterangan') == "") {
            $sukses = 'tidak';
            $pesan = 'ket pengeluaran tidak boleh kosong';
        }else {
            
            $data_pengeluaran = array(
                'keterangan' => $this->input->post('keterangan'),
                'nominal_pengeluaran' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('nominal_pengeluaran'))),
                'tanggal' => $this->input->post('tanggal'),
                'idtoko' => $this->session->userdata['logged_in']['toko']
            ); 

                
            $insert_get_lastid = $this->Mmaster->simpan_data_pengeluaran($data_pengeluaran);

            $this->Mmaster->update_modaltotalbayarpembelianbaru($this->session->userdata['logged_in']['toko'],preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('nominal_pengeluaran'))));

            $sukses = 'ya';
            $pesan = '<label >Data barang <span  style="color:green">"' . $this->input->post('keterangan') . '"</span> berhasil di tambahkan !</label>';
        }
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan,
            'nama' => $this->input->post('keterangan')
        );
        echo json_encode($output);
    }

//----------------------------------------------------------------------- barang
    public function search_barang() {
        $toko = $this->input->post('toko');
        $nama_barang = $this->input->post('search_nama_barang');
        $filter_stock = $this->input->post('filter_stock');
        $baris = $this->input->post('baris');
        $list_barag = $this->Mmaster->search_barang($nama_barang, $filter_stock, $toko,$baris);
        if (count($list_barag) > 0) {
            $no = 1;
            foreach ($list_barag as $value) {
                $row = array();
                $row[] = '<tr>';
                $row[] = '<td>' . $no++ . '</td>';
                $row[] = '<td>' . $value->barcode . '</td>';
                $row[] = '<td>' . $value->nama_barang . '</td>';
                $row[] = '<td>' . $value->isibarang . '</td>'; 

                if (($this->session->userdata['logged_in']['level']) == "Admin" || ($this->session->userdata['logged_in']['level']) == "Supervisor") {
                    $row[] = '<td>' . $this->rupiah($value->hargabeli) . '</td>';
                }
                $row[] = '<td>' . $this->rupiah($value->hecer1) . '</td>';
                $row[] = '<td>' . $this->rupiah($value->hecer2) . '</td>';
                $row[] = '<td>' . $this->rupiah($value->hgrosir1) . '</td>';
                $row[] = '<td>' . $this->rupiah($value->hgrosir2) . '</td>';
                $row[] = '<td>' . $this->rupiah($value->hgrosir3) . '</td>';
                $row[] = '<td>' . $value->tanggalpromo  . ' Rp.' . $this->rupiah($value->hpromo) . '</td>';
                $row[] = '<td>' . $value->stock . '</td>'; 
                 if (($this->session->userdata['logged_in']['level']) == "Admin" || ($this->session->userdata['logged_in']['level']) == "Supervisor") {
                    $row[] = '<td><a href="#" onclick="form_edit_barang('.$value->idbarang.','.$value->idtoko.')"><button type="button" class="btn btn-info" ><i class="fas fa-edit"></i>Edit</button></a>
                <a href="#" onclick="form_historystock_barang('.$value->idbarang.','.$value->idtoko.')"><button type="button" class="btn btn-info" ><i class="fas fa-edit"></i>History Stock</button></a>
                </td>';
                }
                
                $row[] = '</tr>';
                $data[] = $row;
            }
            $sukses = 'ya';
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="12"><span class="text-danger" style="text-transform: uppercase"><b><u> ' . $nama_barang . ' </u></b></span> Tidak ditemukan silahkan gunakan kata pencarian lain atau tambahkan di barang baru</td></tr>';
        }
        $output = array(
            'sukses' => $sukses,
            'list_barang' => $data,
            'nama' => $this->input->post('barang')
        );
        echo json_encode($output);
    }

	public function list_pengajuanbarang() {
		
		$no_pengajuan_barang = $this->input->post('no_pengajuan_barang');
        $list_barag = $this->Mmaster->list_pengajuanbarang($no_pengajuan_barang);
        if (count($list_barag) > 0) {
            $no = 1;
			$index_row=1;
            foreach ($list_barag as $value) {
                $row = array();
                $row[] = '<tr >';
				
                $row[] = '<td >' . $value->nama_barang . '</td>';

				$row[] = '<td >Sisa Stock: ' . $value->stock_gudang . '<br>Stock Pengajuan: ' . $value->jumlah . '</td>';
				if($value->stock_gudang <=0){
					$row[] = '<td > <input type="number" class="form-control form-control-sm jumlah" name="jumlah[]" id="jml'.$index_row.'" value="0" readonly></td>';                
				}else{
					$row[] = '<td > <input type="number" class="form-control form-control-sm jumlah" name="jumlah[]" id="jml'.$index_row.'" value="' . $value->jumlah . '"><br>
					<button type="button" class="btn btn-primary  btn_remove btn-sm" id="1" onclick="edit_pengajuan_stock('.$value->iddetailtransaksi_kulakan.','.$index_row.','.$value->stock_gudang.')"><i class="fa fa-edit"></i>Edit </button></td>';                
				}
				$index_row++;
                
                $row[] = '</tr>';
                $data[] = $row;
            }

			

            $sukses = 'ya';
        } else {
            $sukses = 'tidak';
            $data = '<tr><td ><span class="text-danger" style="text-transform: uppercase"><b></b></span> Tidak ditemukan silahkan gunakan kata pencarian lain atau tambahkan di barang baru</td></tr>';
        }
        $output = array(
            'sukses' => $sukses,
            'list_barang_pengajuan' => $data,
            'nama' => ''
        );
        echo json_encode($output);
    }

    public function search_pengajuanbarang() {

        $list_barag = $this->Mmaster->search_pengajuanbarang();
        if (count($list_barag) > 0) {
            $no = 1;
            foreach ($list_barag as $value) {
                $row = array();
                $row[] = '<tr >';
                $row[] = '<td >' . $value->nama_toko . '</td>';
                $row[] = '<td >' . $value->nama_pengaju . '</td>';
				$row[] = '<td >' . $value->no_pengajuan . '</td>';
				
				$row[] = '<td><a href="#" onclick="lihat_barang('.$value->no_pengajuan.')" ><button type="button" class="btn btn-succes" ><i class="fas fa-edit"></i>Lihat Barang</button></a>
				<a href="#" onclick="acc('.$value->no_pengajuan.','.$value->idtoko.','.$value->iduser.')"><button type="button" class="btn btn-primary" ><i class="fas fa-edit"></i>ACC</button></a>
                <a href="#" onclick="tolak('.$value->no_pengajuan.','.$value->idtoko.','.$value->iduser.')"><button type="button" class="btn btn-danger" ><i class="fas fa-edit"></i>Tolak</button></a>
                </td>';
                
                $row[] = '</tr>';
                $data[] = $row;
            }

			

            $sukses = 'ya';
        } else {
            $sukses = 'tidak';
            $data = '<tr><td ><span class="text-danger" style="text-transform: uppercase"><b></b></span> Tidak Ada pengajuan stock barang</td></tr>';
        }
        $output = array(
            'sukses' => $sukses,
            'list_barang' => $data,
            'nama' => ''
        );
        echo json_encode($output);
    }
	public function tolak_acc() {
		$no_pengajuan_barang=$this->input->post('no');
		
		$this->Mmaster->update_pengajuan_barang_tolak(array('notatransaksi_kulakan' => $no_pengajuan_barang));
		// update_pengajuan_barang
		$data = array(
			'sukses' => 'ya',
			'nota' => $no_pengajuan_barang,
			'jenispenjualan' => 'lunas',
			'pesan' => 'Pengajuan Barang Di Tolak'
		);
}
	public function simpan_acc() {
		    $no_pengajuan_barang=$this->input->post('no');
			$idtoko=$this->input->post('idtk');
			$data_toko=$this->Mmaster->where_kode_toko($idtoko);
			$iduser=$this->input->post('idser');
			$pengajuan =$this->Mmaster->where_kode_pengajuan($no_pengajuan_barang);
			$totalbayar = $pengajuan->totalbayar;
			$statuslunas = "lunas";
			$ubayar=$totalbayar;
			$this->Mmaster->update_modaltotalbayarpembelianbaru($idtoko, $ubayar);

			$idptgs = $iduser;
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
			$notanya = 'KF' . $iduser . '-' . $nomer_nota_baru+1;

			
				$data_transaksi_pembelian = array(//start to save tbtransaksi_penjualan
				'notatransaksi_kulakan' => $notanya, // nota baru
				'tanggal' => date('Y-m-d h:i:s a'),
				'totalbayar' => $totalbayar,
				'bayar' =>  $totalbayar,
				'sisa' => '0',
				'status_lunas' => $statuslunas,
				'status_pending' => 't',
				'idsuplayer' => '41',
				'iduser' => $iduser,
				'idtoko' => $idtoko
			);
			$this->Mpembelian->simpan_data_transaksi_pembelian($data_transaksi_pembelian); 
			// simpan transaksi kulakan          
			$list_barag = $this->Mmaster->list_pengajuanbarang($no_pengajuan_barang);
			if (count($list_barag) > 0) {
				$no = 1;
				foreach ($list_barag as $value) {
					$idb = $value->idbarang;
					$jumlah = $value->jumlah;
					$beli = $value->hargabeli;
					$data_detail_transaksi_pembelian[] = array(
						'notatransaksi_kulakan' => $notanya,
						'idbarang' => $idb,
						'jumlah' => $jumlah,
						'hargabeli' => $beli,
					);
					$data_detail_stock_gudang[] = array(
							'idbarang' => $idb,
							'stock' =>$jumlah*-1,
							'tipe' =>'Keluar',
							'ket' =>'No Transaksi Pembelian Suplay ke toko '.$data_toko->nama.' :'.$notanya,
							'tgl_up' => date('Y-m-d H:i:s'),
							'waktu_up' => date('Y-m-d H:i:s'),
							'idtoko' => $this->session->userdata['logged_in']['toko']
						);
					$data_detail_stock_toko[] = array(
							'idbarang' => $idb,
							'stock' =>$jumlah,
							'tipe' =>'Masuk',
							'ket' =>'No Transaksi Pembelian '.$notanya,
							'tgl_up' => date('Y-m-d H:i:s'),
							'waktu_up' => date('Y-m-d H:i:s'),
							'idtoko' => $idtoko
						);
				}
			}  
			
			$this->Mmaster->update_pengajuan_barang(array('notatransaksi_kulakan' => $no_pengajuan_barang));
			// update_pengajuan_barang
			$this->Mpembelian->simpan_data_detail_transaksi_pembelian($data_detail_transaksi_pembelian); // simpan detail transaksi kulakan
			$this->Mpembelian->simpan_data_detail_stock($data_detail_stock_gudang);
			$this->Mpembelian->simpan_data_detail_stock($data_detail_stock_toko);
			
			$data = array(
				'sukses' => 'ya',
				'nota' => $notanya,
				'jenispenjualan' => $statuslunas,
				'pesan' => 'Pengajuan Barang Di ACC'
			);
	}

	public function simpan_tolak() {
		
		$data_pengajuan[] = array(
			'status_pengajuan' => 'tolak'
		);
		
		$data = array(
			'sukses' => 'ya',
			'nota' => '',
			'jenispenjualan' => '',
			'pesan' => 'Pengajuan Barang Di Tolak'
		);
}

    public function simpan_barang() {
        if ($this->input->post('barcode') == "") {
            $sukses = 'tidak';
            $pesan = 'Barcode tidak boleh kosong';
        }else if ($this->input->post('barang') == "") {
            $sukses = 'tidak';
            $pesan = 'Nama barang tidak boleh kosong';
        }else {
            
            $data_barang = array(
                'barcode' => $this->input->post('barcode'),
                'nama_barang' => $this->input->post('barang'),
                'isibarang' => $this->input->post('isibarang'),
                'hpromo' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('hpromo'))),
                'tanggalpromo' => $this->input->post('tanggalpromo')
            ); 

                
            $insert_get_lastid = $this->Mmaster->simpan_data_barang($data_barang);

            $toko=$this->Mmaster->toko();
            foreach ($toko as $value) {
            $data_harga = array(
                'idbarang' => $insert_get_lastid,
                'hargabeli' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('hbeli'))),
                'hecer1' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('hecer1'))),
                'hecer2' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('hecer2'))),
                'hgrosir1' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('hgrosir1'))),
                'hgrosir2' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('hgrosir2'))),
                'hgrosir3' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('hgrosir3'))),
                'idtoko' => $value->idtoko
            ); 
           
            $data_stock = array(
                    'idbarang' => $insert_get_lastid,
                    'stock' =>'0',
                    'tipe' =>'Masuk',
                    'ket' =>'Stock Awal',
                    'tgl_up' =>date('Y-m-d H:i:s'),
                    'waktu_up' =>date('Y-m-d H:i:s'),
                    'idtoko' => $value->idtoko
                );
            $this->Mmaster->simpan_data_barang_harga($data_harga);
            $this->Mmaster->simpan_data_barang_stock($data_stock);
            }
            $sukses = 'ya';
            $pesan = '<label >Data barang <span  style="color:green">"' . $this->input->post('barang') . '"</span> berhasil di tambahkan !</label>';
        }
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan,
            'nama' => $this->input->post('barang')
        );
        echo json_encode($output);
    }
    public function simpan_barangpembelianmodal() {
        if ($this->input->post('tbarang') == "") {
            $sukses = 'tidak';
            $pesan = 'Nama barang ';
        }else {
            $data_barang = array(
                'nama_barang' => $this->input->post('tbarang'),
                'isibarang' => $this->input->post('tisibarang'),
                'hpromo' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('thpromo'))),
                'tanggalpromo' => $this->input->post('ttanggalpromo')
            ); 

                
            $insert_get_lastid = $this->Mmaster->simpan_data_barang($data_barang);

            $toko=$this->Mmaster->toko();
            foreach ($toko as $value) {
            $data_harga = array(
                'idbarang' => $insert_get_lastid,
                'hargabeli' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('thbeli'))),
                'hecer1' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('thecer1'))),
                'hecer2' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('thecer2'))),
                'hgrosir1' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('thgrosir1'))),
                'hgrosir2' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('thgrosir2'))),
                'hgrosir3' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('thgrosir3'))),
                'idtoko' => $value->idtoko
            ); 
            
            
            $data_stock = array(
                    'idbarang' => $insert_get_lastid,
                    'stock' =>'0',
                    'tipe' =>'Masuk',
                    'ket' =>'Stock Awal',
                    'tgl_up' =>date('Y-m-d H:i:s'),
                    'waktu_up' =>date('Y-m-d H:i:s'),
                    'idtoko' => $value->idtoko
                );
            $this->Mmaster->simpan_data_barang_harga($data_harga);
            $this->Mmaster->simpan_data_barang_stock($data_stock);
            }
            $sukses = 'ya';
            $pesan = '<label >Data barang <span  style="color:green">"' . $this->input->post('tbarang') . '"</span> berhasil di tambahkan !</label>';
        }
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan,
            'nama' => $this->input->post('tbarang')
        );
        echo json_encode($output);
    }

    public function update_barang() {
        if ($this->input->post('barang') == "") {
            $sukses = 'tidak';
            $pesan = 'Nama barang tidak boleh kosong';
        } else {
            $id = $this->input->post('kode_barang');
            $idtoko=  $this->input->post('idtoko');
            $data_barang = array(
                'barcode' => $this->input->post('barcode'),
                'nama_barang' => $this->input->post('barang'),
                'tanggalpromo' => $this->input->post('tanggalpromo'),
                'hpromo' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('hpromo'))),
                'isibarang' => $this->input->post('isibarang')
            );
            $data_harga = array(
                'hargabeli' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('hbeli'))),
                'hecer1' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('hecer1'))),
                'hecer2' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('hecer2'))),
                'hgrosir1' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('hgrosir1'))),
                'hgrosir2' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('hgrosir2'))),
                'hgrosir3' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('hgrosir3')))
            );
            $this->Mmaster->update_data_barang(array('idbarang' => $id), $data_barang);
            $this->Mmaster->update_data_harga(array('idbarang' => $id,'idtoko' => $idtoko), $data_harga);
            // $data_stock = array(
            //     'stock' => $this->input->post('stock'),
            // );
            // $this->Mmaster->update_data_stock_barang(array('idstock' => $id_stock), $data_stock);
            $sukses = 'ya';
            $pesan = '<label >Data barang <span  style="color:red">"' . $this->input->post('barang') . '"</span> berhasil di perbaharui !</label>';
        }
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan
        );
        echo json_encode($output);
    }


    public function autobarang() {
        $cari = $this->input->post('cari');
        $idtoko=$this->session->userdata['logged_in']['toko'];
        $q = $this->Mmaster->autobarang($cari,$idtoko);
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $k) {
                 $tanggalsekarang=date('Y-m-d');
                if ($tanggalsekarang>=$k['tanggalpromo']) {
                    $hid="hidden";
                }else{
                    $hid="";
                }
                $data[] = [
                    'sukses' => true,
                    'nama_barang' => $k['nama_barang'],
                    'id_barang' => $k['idbarang'],
                    'stock' => $k['stock'],
                    'hiddenhargapromo' => $hid,
                    'hpromo' => $k['hpromo'],
                    'hargabeli' => $k['hargabeli'],
                    'hgrosir1' => $k['hgrosir1'],
                    'hgrosir2' => $k['hgrosir2'],
                    'hgrosir3' => $k['hgrosir3'],
                    'hecer1' => $k['hecer1'],
                    'hecer2' => $k['hecer2']
                ];
            }
        } else {
            $data[] = [
                'sukses' => false,
                'nama_barang' => '<span style="color:red">' . $cari . '</span> tidak ditemukan',
                'stock' => '-'
            ];
        }

        echo json_encode($data);
    }

    public function autobarang_pindahstock() {
        $cari = $this->input->post('cari');
        $daritoko = $this->input->post('daritoko');
        $q = $this->Mmaster->autobarang_pindahstock($cari, $daritoko); 
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $k) {
                $bmasterstock1 = $this->Mmaster->tampilstock($k['idbarang'],$daritoko);
                    if ($bmasterstock1->row()->totalstock < 1) { 
                        $historistok=0;
                    }else{
                         $historistok=$bmasterstock1->row()->totalstock;
                    }
                $data[] = [
                    'sukses' => true,
                    'nama_barang' => $k['nama_barang'],
                    'id_barang' => $k['idbarang'],
                    'stock' => $historistok,
                ];
            }
        } else {
            $data[] = [
                'sukses' => false,
                'nama_barang' => '<span style="color:red">' . $cari . '</span> tidak ditemukan',
                'stock' => '-'
            ];
        }

        echo json_encode($data);
    }

//--------------------------------------------------------------------- customer
    public function search_customer() {
        $search_customer_by = $this->input->post('search_customer_by');
        $filter_nama = $this->input->post('fn');
        $filter_alamat = $this->input->post('fa');
        $fillter_wilayah = $this->input->post('fw');
        $baris = $this->input->post('baris');
        $list_customer = $this->Mmaster->search_customer($search_customer_by, $filter_nama, $filter_alamat, $fillter_wilayah,$baris);
        if (count($list_customer) > 0) {
            $no = 1;
            foreach ($list_customer as $value) {
                $row = array();
                $row[] = '<tr onclick=form_edit_customer("' . $value->idcustomer . '")>';
                $row[] = '<td>' . $no++ . '</td>';
                $row[] = '<td>' . $value->nama_customer . '</td>';
                $row[] = '<td>' . $value->alamat_customer . '</td>';
                $row[] = '<td>' . $value->wilayah_customer . '</td>';
                $row[] = '<td>' . $value->hp_customer . '</td>';
                $row[] = '<td>' . $value->status_customer . '</td>';
                $row[] = '<td>' . $value->nama_marketing . '</td>';
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

    function simpan_customer() {
        if ($this->input->post('id_marketing') == "") {
            $sukses = 'tidak';
            $pesan = 'Nama marketing tidak boleh kosong';
            $error = 'marketing';
        } elseif ($this->input->post('customer') == "") {
            $sukses = 'tidak';
            $pesan = 'Nama customer tidak boleh kosong';
            $error = 'customer';
        } else {
            $data_customer = array(
                'nama_customer' => $this->input->post('customer'),
                'alamat_customer' => $this->input->post('alamat'),
                'wilayah_customer' => $this->input->post('wilayah'),
                'hp_customer' => $this->input->post('hp'),
                'status_customer' => $this->input->post('status'),
                'idmarketing' => $this->input->post('id_marketing'),
                'idtoko' => $this->session->userdata['logged_in']['toko']
            );
            $this->Mmaster->simpan_data_customer($data_customer);
            $sukses = 'ya';
            $pesan = '<label >Data customer <span  style="color:green">"' . $this->input->post('customer') . '"</span> berhasil di tambahkan !</label>';
            $error = FALSE;
        }
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan,
            'nama' => $this->input->post('customer'),
            'error' => $error
        );
        echo json_encode($output);
    }

     public function update_pengeluaran() {
        if ($this->input->post('idpengeluaran') == "") {
            $sukses = 'tidak';
            $pesan = 'pengeluaran tidak boleh kosong';
        } else {
            $idpengeluaran = $this->input->post('idpengeluaran');
            $data_pengeluaran = array(
                'keterangan' => $this->input->post('keterangan'),
                'tanggal' => $this->input->post('tanggal'),
                'nominal_pengeluaran' => preg_replace('/[Rp. ]/', '', str_replace(chr(194) . chr(160), ' ', $this->input->post('nominal_pengeluaran')))
            );
            $this->Mmaster->update_data_pengeluaran(array('idpengeluaran' => $idpengeluaran), $data_pengeluaran);
            $sukses = 'ya';
            $pesan = '<label >Data customer <span  style="color:red">"' . $this->input->post('keterangan') . '"</span> berhasil di perbaharui !</label>';
        }
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan,
            'nama' => $this->input->post('keterangan')
        );
        echo json_encode($output);
    }

	public function update_stock_pengajuan() {
        if ($this->input->post('stock_gudang') < $this->input->post('jumlah_acc')) {
            $sukses = 'tidak';
            $pesan = 'Mohon Maaf Stock Tidak Mencukupi';
        } else {
            $id = $this->input->post('id_customer');
            $data_pengajuan = array(
                'jumlah' => $this->input->post('jumlah_acc')                
            );
            $this->Mmaster->update_data_stock_pengajuan(array('tbdetailtransaksi_pengajuan_stock.iddetailtransaksi_kulakan' => $this->input->post('iddetailtransaksi_kulakan')), $data_pengajuan);
            $sukses = 'ya';
            $pesan = 'Data Pengajuan Stock Barang berhasil di perbaharui !';
        }
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan,
            'nama' => $this->input->post('jumlah')
        );
        echo json_encode($output);
    }

    public function update_customer() {
        if ($this->input->post('customer') == "") {
            $sukses = 'tidak';
            $pesan = 'Nama customer tidak boleh kosong';
        } else {
            $id = $this->input->post('id_customer');
            $data_customer = array(
                'nama_customer' => $this->input->post('customer'),
                'alamat_customer' => $this->input->post('alamat'),
                'wilayah_customer' => $this->input->post('wilayah'),
                'hp_customer' => $this->input->post('hp'),
                'status_customer' => $this->input->post('status'),
                'idmarketing' => $this->input->post('id_marketing')
            );
            $this->Mmaster->update_data_customer(array('idcustomer' => $id), $data_customer);
            $sukses = 'ya';
            $pesan = '<label >Data customer <span  style="color:red">"' . $this->input->post('customer') . '"</span> berhasil di perbaharui !</label>';
        }
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan,
            'nama' => $this->input->post('customer')
        );
        echo json_encode($output);
    }

    public function autocustomer() {
        $q = $this->Mmaster->autocustomer();
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $k) {
                $data[] = [
                    'nama' => $k['nama_customer'],
                    'idcustomer' => $k['idcustomer'],
                    'alamat' => $k['alamat_customer']
                ];
            }
        } else {
            $data[] = [
                'nama' => "Tidak ada",
                'alamat' => "",
                'hp' => ""
            ];
        }
        echo json_encode($data);
    }

    //--------------------------------------------------------------------- marketing
    public function search_marketing() {
        $search_marketing_by = $this->input->post('search_marketing_by');
        $filter_nama = $this->input->post('fn');
        $filter_alamat = $this->input->post('fa');
        $list_marketing = $this->Mmaster->search_marketing($search_marketing_by, $filter_nama, $filter_alamat);
        if (count($list_marketing) > 0) {
            $no = 1;
            foreach ($list_marketing as $value) {
                $row = array();
                $row[] = '<tr onclick=form_edit_marketing("' . $value->idmarketing . '")>';
                $row[] = '<td>' . $no++ . '</td>';
                $row[] = '<td>' . $value->nama_marketing . '</td>';
                $row[] = '<td>' . $value->alamat_marketing . '</td>';
                $row[] = '<td>' . $value->hp_marketing . '</td>';
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

    function simpan_marketing() {
        if ($this->input->post('marketing') == "") {
            $sukses = 'tidak';
            $pesan = 'Nama marketing tidak boleh kosong';
        } else {
            $data_marketing = array(
                'nama_marketing' => $this->input->post('marketing'),
                'alamat_marketing' => $this->input->post('alamat'),
                'hp_marketing' => $this->input->post('hp')
            );
            $this->Mmaster->simpan_data_marketing($data_marketing);
            $sukses = 'ya';
            $pesan = '<label >Data marketing <span  style="color:green">"' . $this->input->post('marketing') . '"</span> berhasil di tambahkan !</label>';
        }
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan,
            'nama' => $this->input->post('marketing')
        );
        echo json_encode($output);
    }

    public function update_marketing() {
        if ($this->input->post('marketing') == "") {
            $sukses = 'tidak';
            $pesan = 'Nama marketing tidak boleh kosong';
        } else {
            $id = $this->input->post('id_marketing');
            $data_marketing = array(
                'nama_marketing' => $this->input->post('marketing'),
                'alamat_marketing' => $this->input->post('alamat'),
                'hp_marketing' => $this->input->post('hp')
            );
            $this->Mmaster->update_data_marketing(array('idmarketing' => $id), $data_marketing);
            $sukses = 'ya';
            $pesan = '<label >Data marketing <span  style="color:red">"' . $this->input->post('marketing') . '"</span> berhasil di perbaharui !</label>';
        }
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan,
            'nama' => $this->input->post('marketing')
        );
        echo json_encode($output);
    }

    public function automarketing() {
        $q = $this->Mmaster->automarketing();
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $k) {
                $data[] = array(
                    'nama' => $k['nama_marketing'],
                    'id' => $k['idmarketing']
                );
            }
        } else {
            $data [] = array(
                'nama' => "Tidak ada",
                'id' => "",
            );
        }
        echo json_encode($data);
    }

    //----------------------------------------------------------------- suplayer
    public function search_suplayer() {
        $search_suplayer_by = $this->input->post('search_suplayer_by');
        $filter_nama = $this->input->post('fn');
        $filter_alamat = $this->input->post('fa');
        $list_suplayer = $this->Mmaster->search_suplayer($search_suplayer_by, $filter_nama, $filter_alamat);
        if (count($list_suplayer) > 0) {
            $no = 1;
            foreach ($list_suplayer as $value) {
                $row = array();
                $row[] = '<tr onclick=form_edit_suplayer("' . $value->idsuplayer . '")>';
                $row[] = '<td>' . $no++ . '</td>';
                $row[] = '<td>' . $value->nama_suplayer . '</td>';
                $row[] = '<td>' . $value->alamat_suplayer . '</td>';
                $row[] = '<td>' . $value->hp_suplayer . '</td>';
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

    function simpan_suplayer() {
        if ($this->input->post('suplayer') == "") {
            $sukses = 'tidak';
            $pesan = 'Nama suplayer tidak boleh kosong';
        } else {
            $data_suplayer = array(
                'nama_suplayer' => $this->input->post('suplayer'),
                'alamat_suplayer' => $this->input->post('alamat'),
                'hp_suplayer' => $this->input->post('hp')
            );
            $this->Mmaster->simpan_data_suplayer($data_suplayer);
            $sukses = 'ya';
            $pesan = '<label >Data suplayer <span  style="color:green">"' . $this->input->post('suplayer') . '"</span> berhasil di tambahkan !</label>';
        }
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan,
            'nama' => $this->input->post('suplayer')
        );
        echo json_encode($output);
    }

    public function update_suplayer() {
        if ($this->input->post('suplayer') == "") {
            $sukses = 'tidak';
            $pesan = 'Nama suplayer tidak boleh kosong';
        } else {
            $id = $this->input->post('id_suplayer');
            $data_suplayer = array(
                'nama_suplayer' => $this->input->post('suplayer'),
                'alamat_suplayer' => $this->input->post('alamat'),
                'hp_suplayer' => $this->input->post('hp')
            );
            $this->Mmaster->update_data_suplayer(array('idsuplayer' => $id), $data_suplayer);
            $sukses = 'ya';
            $pesan = '<label >Data suplayer <span  style="color:red">"' . $this->input->post('suplayer') . '"</span> berhasil di perbaharui !</label>';
        }
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan,
            'nama' => $this->input->post('suplayer')
        );
        echo json_encode($output);
    }

    public function autosuplayer() {
        $q = $this->Mmaster->autosuplayer();
        if ($q->num_rows() > 0) {
            foreach ($q->result_array() as $k) {
                $data[] = [
                    'nama' => $k['nama_suplayer'],
                    'idsuplayer' => $k['idsuplayer'],
                    'hp_suplayer' => $k['hp_suplayer'],
                    'alamat_suplayer' => $k['alamat_suplayer']
                ];
            }
        } else {
            $data[] = [
                'nama' => "Tidak ada",
                'idsuplayer' => "",
                'hp_suplayer' => "",
                'alamat_suplayer' => ""
            ];
        }
        echo json_encode($data);
    }

    //----------------------------------------------------------------- petugas
    public function search_petugas() {
        $search_petugas_by = $this->input->post('search_petugas_by');
        $list_petugas = $this->Mmaster->search_petugas($search_petugas_by);
        if (count($list_petugas) > 0) {
            $jumlah_nota = $this->Mgrafik->progres_keaktifan_all();
            $no = 1;
            foreach ($list_petugas as $value) {
                $jumlah_nota_per_user = $this->Mgrafik->progres_keaktifan_per_user($value->iduser);
                $nama_toko = $this->Mmaster->search_idtoko($value->idtoko);
                if ($jumlah_nota_per_user->jum_per_user == 0) {
                    $persen = $jumlah_nota;
                }else{
                    $persen = ($jumlah_nota_per_user->jum_per_user / $jumlah_nota) * 100;
                }
                
                if ($persen < 20) {
                    $warna = "red";
                } else if ($persen < 30) {
                    $warna = "warning";
                } else {
                    $warna = "success";
                }
                $row = array();
                $row[] = '<tr onclick=form_edit_petugas("' . $value->iduser . '")>';
                $row[] = '<td>' . $no++ . '</td>';

                $row[] = '<td>' . $nama_toko->nama . '</td>';
                $row[] = '<td>' . $value->nama . '</td>';
                $row[] = '<td>' . $value->alamat . '</td>';
                $row[] = '<td>' . $value->hp . '</td>';
                $row[] = '<td>' . $value->jabatan . '</td>';
                $row[] = '<td>' . $value->statususer . '</td>';
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

    function simpan_petugas() {
        $username = $this->input->post('uname');
        $pass = $this->input->post('password');
        $result = $this->Mpetugas->read_user_information($username);
        if ($this->input->post('petugas') == "") {
            $sukses = 'tidak';
            $pesan = 'Nama lengkap petugas tidak boleh kosong';
        } elseif ($username == "" || $pass = "") {
            $sukses = 'tidak';
            $pesan = 'Maaf username atau password petugas tidak boleh kosong';
        } elseif ($result != false) {
            $sukses = 'tidak';
            $pesan = 'Maaf username telah terdaftar, silahkan gunakan kata lain';
        } else {
            $data_petugas = array(
                'nama' => $this->input->post('petugas'),
                'alamat' => $this->input->post('alamat'),
                'hp' => $this->input->post('hp'),
                'username' => $username,
                'password' => $this->input->post('password'),
                'statususer' => 'aktif',
                'jabatan' => $this->input->post('akses'),
                'idtoko' => $this->input->post('pilihtoko')
            );
            $this->Mmaster->simpan_data_petugas($data_petugas);
            $sukses = 'ya';
            $pesan = '<label >Data petugas <span  style="color:green">"' . $this->input->post('petugas') . '"</span> berhasil di tambahkan !</label>';
        }
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan,
            'nama' => $this->input->post('petugas')
        );
        echo json_encode($output);
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
                'statususer' => $this->input->post('status'),
                'username' => $u,
                'password' => $p,
                'jabatan' => $this->input->post('akses')
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
    //----------------------------------------------------------------- toko
    public function search_toko() {
        $search_toko_by = $this->input->post('search_toko_by');
        $list_toko = $this->Mmaster->search_toko($search_toko_by);
        if (count($list_toko) > 0) {
            $no = 1;
            foreach ($list_toko as $value) {
                $row = array();
                $row[] = '<tr onclick=form_edit_toko("' . $value->idtoko . '")>';
                $row[] = '<td>' . $no++ . '</td>';
                $row[] = '<td>' . $value->nama . '</td>';
                $row[] = '<td>' . $value->alamat_toko . '</td>';
                $row[] = '<td>' . $value->nominal_modal . '</td>';
                $data[] = $row;
            }
            $sukses = 'ya';
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="8"><span class="text-danger" style="text-transform: uppercase"><b><u> ' . $search_toko_by . ' </u></b></span> Tidak ditemukan silahkan gunakan kata pencarian lain !</td></tr>';
        }
        $output = array(
            'sukses' => $sukses,
            'list_toko' => $data
        );
        echo json_encode($output);
    }

    public function search_tokokasir() {
        $pilihtoko = $this->input->post('pilihtoko');
        $list_toko = $this->Mmaster->search_tokokasir($pilihtoko);
        if (count($list_toko) > 0) {
            $no = 1;
            foreach ($list_toko as $value) {
                $row = array();
                $row[] = '<tr>';
                $row[] = '<td>' . $no++ . '</td>';
                $row[] = '<td>' . $value->nama . '</td>';
                $row[] = '<td>' . $value->alamat_toko . '</td>';
                $row[] = '<td>' . $value->nominal_modal . '</td>';
                $data[] = $row;
            }
            $sukses = 'ya';
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="8"><span class="text-danger" style="text-transform: uppercase"><b><u>  </u></b></span> Tidak ditemukan silahkan gunakan kata pencarian lain !</td></tr>';
        }
        $output = array(
            'sukses' => $sukses,
            'list_toko' => $data
        );
        echo json_encode($output);
    }

    function simpan_toko() {
        if ($this->input->post('toko') == "") {
            $sukses = 'tidak';
            $pesan = 'Nama toko tidak boleh kosong';
        } else {
            $data_toko = array(
                'nama' => $this->input->post('toko'),
                'alamat_toko' => $this->input->post('alamat')
            );
            $this->Mmaster->simpan_data_toko($data_toko);
            $idtoko = $this->Mmaster->getidtoko()->result_array();
            $data_modal = array(
                'idtoko' => $idtoko[0]['idtoko'],
                'nominal_modal' => $this->input->post('nominal_modal')
            );
            $this->Mmaster->simpan_data_modal($data_modal);
            $sukses = 'ya';
            $pesan = '<label >Data toko <span  style="color:green">"' . $this->input->post('toko') . '"</span> berhasil di tambahkan !</label>';
        }
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan,
            'nama' => $this->input->post('toko')
        );
        echo json_encode($output);
    }

    public function update_toko() {
        if ($this->input->post('toko') == "") {
            $sukses = 'tidak';
            $pesan = 'Nama lengkap toko tidak boleh kosong';
        }  else {
            $id = $this->input->post('id_toko');
            $data_toko = array(
                'nama' => $this->input->post('toko'),
                'alamat_toko' => $this->input->post('alamat')
            );
            $data_modal = array(
                'nominal_modal' => $this->input->post('nominal_modal')
            );
            $this->Mmaster->update_data_toko(array('idtoko' => $id), $data_toko);
            $this->Mmaster->update_data_modal(array('idtoko' => $id), $data_modal);
            $sukses = 'ya';
            $pesan = '<label >Data toko <span  style="color:red">"' . $this->input->post('toko') . '"</span> berhasil di perbaharui !</label>';
        }
        $output = array(
            'sukses' => $sukses,
            'pesan' => $pesan,
            'nama' => $this->input->post('toko')
        );
        echo json_encode($output);
    }
    
    public function search_histori_barang() {
        $id_barang= $this->input->post('id');
//        $filter_stock = $this->input->post('filter_stock');
//        $baris = $this->input->post('baris');
        $list_data = $this->Mmaster->search_histori_barang($id_barang);
        if (count($list_data) > 0) {
            $no = 1;
            foreach ($list_data as $value) {
                 if ($value->idcustomer == 0 || $value->idcustomer == "") {
                    $nm_c = 'customer ecer (-)';
                } else {
                    $nm_c = $value->nama_customer;
                }
                $row = array();
                $row[] = '<tr>';
                $row[] = '<td>' . $no++ . '</td>';
                $row[] = '<td>' . $value->notatransaksi_penjualan_customer . '</td>';
                $row[] = '<td>' . $value->tanggal . '</td>';
                $row[] = '<td>' . $value->jenis_harga_penjualan . '</td>';
                $row[] = '<td>' . $nm_c . '</td>';
                $row[] = '<td>' . $value->nama_marketing . '</td>';
                $row[] = '<td>' . $value->nama . '</td>';
                $row[] = '<td>' . $value->jumlah . '</td>';
                $row[] = '</tr>';
                $data[] = $row;
            }
            $sukses = 'ya';
        } else {
            $sukses = 'tidak';
            $data = '<tr><td colspan="8">Data tidak ditemukan </td></tr>';
        }
        $output = array(
            'sukses' => $sukses,
            'list_barang' => $data,
        );
        echo json_encode($output);
    }

}
