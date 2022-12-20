<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!--<noscript><meta http-equiv="refresh" content="0;URL=noscript.php"></noscript>-->
        <!--<link rel="shortcut icon" href="<?= site_url(); ?>/assets/img/ikon-kecil-nj.png" type="image/x-icon" />-->
        <!--<title> Cetak Surat mahrom</title>-->
        
        <script type='text/javascript'>
            // var restorepage = document.body.innerHTML;
		  //  var printcontent = document.getElementById(isi_print).innerHTML;
		  //  javascript:document.body.innerHTML = printcontent;
		 //   javascript:window.print();
		  //  javascript:document.body.innerHTML = restorepage;
            
           
            
            
            
            </script>
        <style type="text/css">   
          @page {
                size: auto;
                margin: 0;
            }
            *{
/*                margin:0;
                padding:0;*/
                font-family: arial;
/*                font-size:8pt;
                color:#000;*/
            }
            body
            {
                /*width:100%;*/
                font-family: arial;
/*                font-size:8pt;
                margin:0;
                padding:0;*/
            }


        </style>
    </head>
    <?php
    
    $jumlahbarang=count($detail_penjualan);

    $mod= $jumlahbarang % 18;
    $hasilbagi=($jumlahbarang-$mod)/18;
    $jumlembar=($hasilbagi+1);
    ?>
    <body style="margin:0;padding:0;">
        <?php 
        if ($jumlembar<2){
            if ($jumlahbarang>=11)
            {
            $j=-1;
            for($i=1;$i<=2;$i++){
                $j++
                ?>
                        <table id="isi_print">
            <tr>
                <td valign='top' style="width:821px; height:350px; border:0px solid;padding-top:40px;">
                    <table style="width:100%;">
                       <!-- <tr>
                            <td style="width:20%;text-align:right;">
                                <img width="130" src="<?php echo site_url() ?>/vendor/img/logo_tokoali.jpg">
                            </td>
                            <td style="width:50%;text-align:center;">
                                <h4 style="margin:0;"><u>Elektronik, Alat Listrik, Wallpaper dinding, ATK</u></h4>
                                <p style="margin:0;">Toko 1. Gading Kulon Kec.Banyuanyar(depan Masjid Al-Ikhlas)</p>
                                <p style="margin:0;">Toko 2. Pasar Klenang Kidul Kec.Banyuanyar(Utara BANK BRI)</p>

                            </td>
                            <td style="width:20%;">

                            </td>
                        </tr>-->
                        <tr>
                            <td colspan="3"  style="text-align:center;border-bottom:1px solid;">
                                <p style="margin:0;padding:0;"><b>TOKO ALI</b></p>
                                <small>Admin 1 : 085 333 448 430 Admin 2 : 082 257 740 015</small>
                            </td>
                        </tr>
                    </table>
                    <table style="width:100%;margin-top:6px;">
                        <tr>
                            <td>
                                <table style="width:100%;">
                                    <tr>
                                        <td style="width:40%;padding-left:20px;">
                                            <table>
                                                <tr>
                                                    <td style="font-size:13px;">Nota</td>
                                                    <td>:</td>
                                                    <td style="font-size:13px;"><?= $penjualan->notatransaksi_penjualan_customer ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:13px;">Nama Kasir</td>
                                                    <td>:</td>
                                                    <td style="font-size:13px;"><?= $penjualan->nama ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:13px;">Tanggal</td>
                                                    <td>:</td>
                                                    <td style="font-size:13px;"><?= date('d-m-Y', strtotime($penjualan->tanggal)) ?></td>
                                                </tr>
                                            </table>
                                        </td>

                                        <td style="width:40%;">
                                            <table>
                                                <tr>
                                                    <td style="font-size:13px;">Toko/Tuan</td>
                                                    <td >:</td>
                                                    <td style="font-size:13px;"><?= $penjualan->nama_customer?></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:13px;">Alamat</td>
                                                    <td>:</td>
                                                    <td style="font-size:13px;"><?= $penjualan->alamat_customer ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:13px;">No HP</td>
                                                    <td>:</td>
                                                    <td style="font-size:13px;"><?= $penjualan->hp_customer ?></td>
                                                </tr>
                                            </table>
                                        </td>

                                        <td style="width:20%;padding-right:20px;" valign="top">
                                            <table style="width:100%;border-collapse:collapse;">
                                                <tr>
                                                    <td style="border:0.1px solid;text-align:center;">
                                                        <i style="font-size:13px;">
                                                            Sales Marketing
                                                        </i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border:0.1px solid;height:10px;text-align:center;">
                                                        <h5><?= $penjualan->nama_marketing ?></h5>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table style="width:100%;">
                        <tr>
                            <td style="padding:0px 25px;">
                                <table style="width:100%;border-collapse:collapse;">
                                    <tr>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:5%;">Cek</td>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:40%">Nama Barang</td>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:5%;">QTY</td>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:10%;">Harga</td>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:10%;">Total</td>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:5%;">SND</td>
                                    </tr>
                                    <?php
//                                    $json_detail_penjualan=  json_encode($detail_penjualan);
//                                    print_r($json_detail_penjualan);

                                
                                  
                                        foreach (array_slice($detail_penjualan, $j*18, $i*18)  as $key=>$value) {
                                        
                                      
                                        ?>
                                        <tr>
                                            
                                            <td style="font-size:12px;border:0.1px solid;text-align:center;">
                                               0
                                            </td>
                                            <td style="font-size:12px;border:0.1px solid;"><?= $value->nama_barang ?></td>
                                            <td style="font-size:12px;border:0.1px solid;text-align:center;"><?= $value->jumlah ?></td>
                                            <td style="font-size:12px;border:0.1px solid;text-align:right;"><?=  number_format($value->hargajual, 0, ',', '.') ?></td>
                                            <td style="font-size:12px;border:0.1px solid;text-align:right;"><?= number_format($value->jumlah * $value->hargajual, 0, ',', '.') ?></td>
                                            <td style="font-size:12px;border:0.1px solid;text-align:center;">
                                            <?php
                                            if ($value->hargajual==$value->hgrosir1){
                                                echo '*';
                                            }elseif ($value->hargajual==$value->hgrosir2){
                                                echo '**';
                                            }elseif ($value->hargajual==$value->hgrosir3){
                                                echo '***';
                                            }else{
                                                echo ' ';
                                            }
                                            ?>    
                                            </td>
                                        </tr>
                                        <?php
                                        }?>
                                         <tr>
                                            
                                            <td>.</td>
                                            
                                        </tr>
                                        <tr>
                                            
                                            <td>.</td>
                                            
                                        </tr>
                                        
                                        
                                        <?php
                                        
                                            
                                  
if ($i==2){
            ?>
            
            <tr>
                                        <td  colspan="3" style="">
                                            <table>
                                                <tr>
                                                    <td >
                                                                                                              

                                                    </td>
                                                    <td style="font-size:18px;text-align:center;width:90px;">
                                                      
                                                    </td>
                                                    <td style="font-size:18px;text-align:center;width:90px;">
                                                       
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td  style="font-size:12px;border:0.1px solid;text-align:center;padding:3px;text-align:right">Jumlah</td>
                                        <td  style="font-size:12px;border:0.1px solid;text-align:right"><?= "Rp " . number_format($penjualan->totalbayar, 0, ',', '.') ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                           

                                        </td>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right;padding-top:5px;">Ongkir</td>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right;padding-top:5px;">
                                            <?= "Rp " . number_format($penjualan->ongkir, 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">

                                        </td>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right;padding-top:5px;">Bayar</td>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right;padding-top:5px;">
                                            <?= "Rp " . number_format($penjualan->bayar, 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            

                                        </td>
                                        <?php                                        
                                        $bayar=$penjualan->bayar;
                                        $tagihan=$penjualan->totalbayar;
                                        $ongkir=$penjualan->ongkir;
                                        $sisa=$bayar-$ongkir-$tagihan;
                                        ?>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right"></td>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right;padding-top:5px;">
                                            
                                        </td>
                                    </tr>
            
            <?php } ?>
                                    
                                </table>
                            </td>
                        </tr>
                        
                    </table>
                </td>
            </tr>
        </table>
        <?php
        if ($i==2){
            ?>
            <table >
            <tr>
                <td valign='top' style="width:821px; height:65px; border:0px solid;padding-top:40px;">
                    <table style="width:100%;">
                        <tr>
                          
                            <td colspan="3"  style="text-align:center;border-top:1px solid;">
                                <table style="width:100%;">
                                    <tr>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;">Customer</p>
                                                    </td>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;">Gudang</p>
                                                    </td>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;"> Sopir</p>
                                                    </td>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;"> Manager</p>
                                                    </td>
                                                    </td>
                                                    
                                                    </td>
                                                </tr>
                                                <tr><td colspan="4"></br></td></tr>
                                                <tr><td colspan="4"></br></td></tr>
                                                <tr>
                                                    <td style="text-align:center;width:25%;">
                                                        
                                                        <p style="font-size:11px;">(..........................)</p>
                                                    </td>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;">(..........................)</p>
                                                    </td>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;">(..........................)</p>
                                                    </td>
                                                     <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;">(..........................)</p>
                                                    </td>
                                                </tr>
                                            </table>
                            </td>
                        </tr>
                    </table>
                    
                </td>
            </tr>
        </table>
            <?php
        }
        
        
        ?>
        
            
                <?php
                
            }
        }else{
            
        
            ?>
            <table id="isi_print">
            <tr>
                <td valign='top' style="width:821px; height:350px; border:0px solid;padding-top:40px;">
                    <table style="width:100%;">
                       <!-- <tr>
                            <td style="width:20%;text-align:right;">
                                <img width="130" src="<?php echo site_url() ?>/vendor/img/logo_tokoali.jpg">
                            </td>
                            <td style="width:50%;text-align:center;">
                                <h4 style="margin:0;"><u>Elektronik, Alat Listrik, Wallpaper dinding, ATK</u></h4>
                                <p style="margin:0;">Toko 1. Gading Kulon Kec.Banyuanyar(depan Masjid Al-Ikhlas)</p>
                                <p style="margin:0;">Toko 2. Pasar Klenang Kidul Kec.Banyuanyar(Utara BANK BRI)</p>

                            </td>
                            <td style="width:20%;">

                            </td>
                        </tr>-->
                        <tr>
                            <td colspan="3"  style="text-align:center;border-bottom:1px solid;">
                                <p style="margin:0;padding:0;"><b>TOKO ALI</b></p>
                                <small>Admin 1 : 085 333 448 430 Admin 2 : 082 257 740 015</small>
                            </td>
                        </tr>
                    </table>
                    <table style="width:100%;margin-top:6px;">
                        <tr>
                            <td>
                                <table style="width:100%;">
                                    <tr>
                                        <td style="width:40%;padding-left:20px;">
                                            <table>
                                                <tr>
                                                    <td style="font-size:13px;">Nota</td>
                                                    <td>:</td>
                                                    <td style="font-size:13px;"><?= $penjualan->notatransaksi_penjualan_customer ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:13px;">Nama Kasir</td>
                                                    <td>:</td>
                                                    <td style="font-size:13px;"><?= $penjualan->nama ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:13px;">Tanggal</td>
                                                    <td>:</td>
                                                    <td style="font-size:13px;"><?= date('d-m-Y', strtotime($penjualan->tanggal)) ?></td>
                                                </tr>
                                            </table>
                                        </td>

                                        <td style="width:40%;">
                                            <table>
                                                <tr>
                                                    <td style="font-size:13px;">Toko/Tuan</td>
                                                    <td >:</td>
                                                    <td style="font-size:13px;"><?= $penjualan->nama_customer?></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:13px;">Alamat</td>
                                                    <td>:</td>
                                                    <td style="font-size:13px;"><?= $penjualan->alamat_customer ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:13px;">No HP</td>
                                                    <td>:</td>
                                                    <td style="font-size:13px;"><?= $penjualan->hp_customer ?></td>
                                                </tr>
                                            </table>
                                        </td>

                                        <td style="width:20%;padding-right:20px;" valign="top">
                                            <table style="width:100%;border-collapse:collapse;">
                                                <tr>
                                                    <td style="border:0.1px solid;text-align:center;">
                                                        <i style="font-size:13px;">
                                                            Sales Marketing
                                                        </i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border:0.1px solid;height:10px;text-align:center;">
                                                        <h5><?= $penjualan->nama_marketing ?></h5>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table style="width:100%;">
                        <tr>
                            <td style="padding:0px 25px;">
                                <table style="width:100%;border-collapse:collapse;">
                                    <tr>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:5%;">Cek</td>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:40%">Nama Barang</td>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:5%;">QTY</td>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:10%;">Harga</td>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:10%;">Total</td>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:5%;">SND</td>
                                    </tr>
                                    <?php
//                                    $json_detail_penjualan=  json_encode($detail_penjualan);
//                                    print_r($json_detail_penjualan);


                                    foreach ($detail_penjualan as $value) {
                                        ?>
                                        <tr>
                                            <td style="font-size:12px;border:0.1px solid;text-align:center;">
                                               0
                                            </td>
                                            <td style="font-size:12px;border:0.1px solid;"><?= $value->nama_barang ?></td>
                                            <td style="font-size:12px;border:0.1px solid;text-align:center;"><?= $value->jumlah ?></td>
                                            <td style="font-size:12px;border:0.1px solid;text-align:right;"><?= "Rp " . number_format($value->hargajual, 0, ',', '.') ?></td>
                                            <td style="font-size:12px;border:0.1px solid;text-align:right;"><?= "Rp " . number_format($value->jumlah * $value->hargajual, 0, ',', '.') ?></td>
                                            <td style="font-size:12px;border:0.1px solid;text-align:center;">
                                            <?php
                                            if ($value->hargajual==$value->hgrosir1){
                                                echo '*';
                                            }elseif ($value->hargajual==$value->hgrosir2){
                                                echo '**';
                                            }elseif ($value->hargajual==$value->hgrosir3){
                                                echo '***';
                                            }else{
                                                echo ' ';
                                            }
                                            ?>    
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                    <tr>
                                        <td  colspan="3" style="">
                                            <table>
                                                <tr>
                                                    <td >
                                                                                                              

                                                    </td>
                                                    <td style="font-size:18px;text-align:center;width:90px;">
                                                      
                                                    </td>
                                                    <td style="font-size:18px;text-align:center;width:90px;">
                                                       
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td  style="font-size:12px;border:0.1px solid;text-align:center;padding:3px;text-align:right">Jumlah</td>
                                        <td  style="font-size:12px;border:0.1px solid;text-align:right"><?= "Rp " . number_format($penjualan->totalbayar, 0, ',', '.') ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                           

                                        </td>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right;padding-top:5px;">Ongkir</td>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right;padding-top:5px;">
                                            <?= "Rp " . number_format($penjualan->ongkir, 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">

                                        </td>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right;padding-top:5px;">Bayar</td>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right;padding-top:5px;">
                                            <?= "Rp " . number_format($penjualan->bayar, 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            

                                        </td>
                                        <?php                                        
                                        $bayar=$penjualan->bayar;
                                        $tagihan=$penjualan->totalbayar;
                                        $ongkir=$penjualan->ongkir;
                                        $sisa=$bayar-$ongkir-$tagihan;
                                        ?>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right"></td>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right;padding-top:5px;">
                                            
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        
                    </table>
                </td>
            </tr>
        </table>
            <table >
            <tr>
                <td valign='top' style="width:821px; height:65px; border:0px solid;padding-top:40px;">
                    <table style="width:100%;">
                        <tr>
                          
                            <td colspan="3"  style="text-align:center;border-top:1px solid;">
                                <table style="width:100%;">
                                    <tr>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;">Customer</p>
                                                    </td>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;">Gudang</p>
                                                    </td>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;"> Sopir</p>
                                                    </td>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;"> Manager</p>
                                                    </td>
                                                    </td>
                                                    
                                                    </td>
                                                </tr>
                                                <tr><td colspan="4"></br></td></tr>
                                                <tr><td colspan="4"></br></td></tr>
                                                <tr>
                                                    <td style="text-align:center;width:25%;">
                                                        
                                                        <p style="font-size:11px;">(..........................)</p>
                                                    </td>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;">(..........................)</p>
                                                    </td>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;">(..........................)</p>
                                                    </td>
                                                     <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;">(..........................)</p>
                                                    </td>
                                                </tr>
                                            </table>
                            </td>
                        </tr>
                    </table>
                    
                </td>
            </tr>
        </table>
            <?php }
        }else {
            $j=-1;
            for($i=1;$i<=$jumlembar;$i++){
                $j++
                ?>
                        <table id="isi_print">
            <tr>
                <td valign='top' style="width:821px; height:350px; border:0px solid;padding-top:40px;">
                    <table style="width:100%;">
                       <!-- <tr>
                            <td style="width:20%;text-align:right;">
                                <img width="130" src="<?php echo site_url() ?>/vendor/img/logo_tokoali.jpg">
                            </td>
                            <td style="width:50%;text-align:center;">
                                <h4 style="margin:0;"><u>Elektronik, Alat Listrik, Wallpaper dinding, ATK</u></h4>
                                <p style="margin:0;">Toko 1. Gading Kulon Kec.Banyuanyar(depan Masjid Al-Ikhlas)</p>
                                <p style="margin:0;">Toko 2. Pasar Klenang Kidul Kec.Banyuanyar(Utara BANK BRI)</p>

                            </td>
                            <td style="width:20%;">

                            </td>
                        </tr>-->
                        <tr>
                            <td colspan="3"  style="text-align:center;border-bottom:1px solid;">
                                <p style="margin:0;padding:0;"><b>TOKO ALI</b></p>
                                <small>Admin 1 : 085 333 448 430 Admin 2 : 082 257 740 015</small>
                            </td>
                        </tr>
                    </table>
                    <table style="width:100%;margin-top:6px;">
                        <tr>
                            <td>
                                <table style="width:100%;">
                                    <tr>
                                        <td style="width:40%;padding-left:20px;">
                                            <table>
                                                <tr>
                                                    <td style="font-size:13px;">Nota</td>
                                                    <td>:</td>
                                                    <td style="font-size:13px;"><?= $penjualan->notatransaksi_penjualan_customer ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:13px;">Nama Kasir</td>
                                                    <td>:</td>
                                                    <td style="font-size:13px;"><?= $penjualan->nama ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:13px;">Tanggal</td>
                                                    <td>:</td>
                                                    <td style="font-size:13px;"><?= date('d-m-Y', strtotime($penjualan->tanggal)) ?></td>
                                                </tr>
                                            </table>
                                        </td>

                                        <td style="width:40%;">
                                            <table>
                                                <tr>
                                                    <td style="font-size:13px;">Toko/Tuan</td>
                                                    <td >:</td>
                                                    <td style="font-size:13px;"><?= $penjualan->nama_customer?></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:13px;">Alamat</td>
                                                    <td>:</td>
                                                    <td style="font-size:13px;"><?= $penjualan->alamat_customer ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:13px;">No HP</td>
                                                    <td>:</td>
                                                    <td style="font-size:13px;"><?= $penjualan->hp_customer ?></td>
                                                </tr>
                                            </table>
                                        </td>

                                        <td style="width:20%;padding-right:20px;" valign="top">
                                            <table style="width:100%;border-collapse:collapse;">
                                                <tr>
                                                    <td style="border:0.1px solid;text-align:center;">
                                                        <i style="font-size:13px;">
                                                            Sales Marketing
                                                        </i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border:0.1px solid;height:10px;text-align:center;">
                                                        <h5><?= $penjualan->nama_marketing ?></h5>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table style="width:100%;">
                        <tr>
                            <td style="padding:0px 25px;">
                                <table style="width:100%;border-collapse:collapse;">
                                    <tr>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:5%;">Cek</td>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:40%">Nama Barang</td>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:5%;">QTY</td>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:10%;">Harga</td>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:10%;">Total</td>
                                        <td style="font-size:12px;border:0.1px solid;text-align:center;width:5%;">SND</td>
                                    </tr>
                                    <?php
//                                    $json_detail_penjualan=  json_encode($detail_penjualan);
//                                    print_r($json_detail_penjualan);

                                
                                  
                                        foreach (array_slice($detail_penjualan, $j*18, $i*18)  as $key=>$value) {
                                        
                                      
                                        ?>
                                        <tr>
                                            
                                            <td style="font-size:12px;border:0.1px solid;text-align:center;">
                                               0
                                            </td>
                                            <td style="font-size:12px;border:0.1px solid;"><?= $value->nama_barang ?></td>
                                            <td style="font-size:12px;border:0.1px solid;text-align:center;"><?= $value->jumlah ?></td>
                                            <td style="font-size:12px;border:0.1px solid;text-align:right;"><?=  number_format($value->hargajual, 0, ',', '.') ?></td>
                                            <td style="font-size:12px;border:0.1px solid;text-align:right;"><?= number_format($value->jumlah * $value->hargajual, 0, ',', '.') ?></td>
                                            <td style="font-size:12px;border:0.1px solid;text-align:center;">
                                            <?php
                                            if ($value->hargajual==$value->hgrosir1){
                                                echo '*';
                                            }elseif ($value->hargajual==$value->hgrosir2){
                                                echo '**';
                                            }elseif ($value->hargajual==$value->hgrosir3){
                                                echo '***';
                                            }else{
                                                echo ' ';
                                            }
                                            ?>    
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                            
                                  
if ($i==$jumlembar){
            ?>
            
            <tr>
                                        <td  colspan="3" style="">
                                            <table>
                                                <tr>
                                                    <td >
                                                                                                              

                                                    </td>
                                                    <td style="font-size:18px;text-align:center;width:90px;">
                                                      
                                                    </td>
                                                    <td style="font-size:18px;text-align:center;width:90px;">
                                                       
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td  style="font-size:12px;border:0.1px solid;text-align:center;padding:3px;text-align:right">Jumlah</td>
                                        <td  style="font-size:12px;border:0.1px solid;text-align:right"><?= "Rp " . number_format($penjualan->totalbayar, 0, ',', '.') ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                           

                                        </td>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right;padding-top:5px;">Ongkir</td>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right;padding-top:5px;">
                                            <?= "Rp " . number_format($penjualan->ongkir, 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">

                                        </td>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right;padding-top:5px;">Bayar</td>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right;padding-top:5px;">
                                            <?= "Rp " . number_format($penjualan->bayar, 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            

                                        </td>
                                        <?php                                        
                                        $bayar=$penjualan->bayar;
                                        $tagihan=$penjualan->totalbayar;
                                        $ongkir=$penjualan->ongkir;
                                        $sisa=$bayar-$ongkir-$tagihan;
                                        ?>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right"></td>
                                        <td style="font-size:12px;text-align:left;padding:3px;text-align:right;padding-top:5px;">
                                            
                                        </td>
                                    </tr>
            
            <?php } ?>
                                    
                                </table>
                            </td>
                        </tr>
                        
                    </table>
                </td>
            </tr>
        </table>
        <?php
        if ($i==$jumlembar){
            ?>
            <table >
            <tr>
                <td valign='top' style="width:821px; height:65px; border:0px solid;padding-top:40px;">
                    <table style="width:100%;">
                        <tr>
                          
                            <td colspan="3"  style="text-align:center;border-top:1px solid;">
                                <table style="width:100%;">
                                    <tr>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;">Customer</p>
                                                    </td>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;">Gudang</p>
                                                    </td>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;"> Sopir</p>
                                                    </td>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;"> Manager</p>
                                                    </td>
                                                    </td>
                                                    
                                                    </td>
                                                </tr>
                                                <tr><td colspan="4"></br></td></tr>
                                                <tr><td colspan="4"></br></td></tr>
                                                <tr>
                                                    <td style="text-align:center;width:25%;">
                                                        
                                                        <p style="font-size:11px;">(..........................)</p>
                                                    </td>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;">(..........................)</p>
                                                    </td>
                                                    <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;">(..........................)</p>
                                                    </td>
                                                     <td style="text-align:center;width:25%;">
                                                        <p style="font-size:11px;">(..........................)</p>
                                                    </td>
                                                </tr>
                                            </table>
                            </td>
                        </tr>
                    </table>
                    
                </td>
            </tr>
        </table>
            <?php
        }
        
        
        ?>
        
            
                <?php
                
            }
        }
        
        ?>

        

    </body>

</html>

