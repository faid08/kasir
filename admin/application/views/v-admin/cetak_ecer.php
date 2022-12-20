
<!DOCTYPE html>
<html>
    <script type='text/javascript'>javascript:window.print()</script>
    <head>
        <!--<title>POS (Point Of Sales) Version 1.0.0</title>-->
        <style>
            @page {
                size: auto;
                margin: 0;
            }
            *{
                margin:0;
                padding:0;
                font-family: arial;
                font-size:8pt;
                color:#000;
            }
            body
            {
                width:100%;
                font-family: arial;
                font-size:8pt;
                margin:0;
                padding:0;
            }

            p
            {
                margin:0;
                padding:0;
                margin-left: 0px;
            }

            #wrapper
            {
                width:44mm;
                margin:0 0mm;
            }

            #main {
                float:left;
                width:0mm;
                background:#ffffff;
                padding:0mm;
            }

            #sidebar {
                float:right;
                width:0mm;
                background:#ffffff;
                padding:0mm;
            } 

            .page
            {
                height:200mm;
                width:44mm;
                page-break-after:always;
            }

            table
            {
                /** border-left: 1px solid #fff;
                border-top: 1px solid #fff; **/
                font-family: arial; 
                border-spacing:0;
                border-collapse: collapse; 

            }

            table td 
            {
                /**border-right: 1px solid #fff;
                border-bottom: 1px solid #fff;**/
                padding: 2mm;

            }

            table.heading
            {
                height:0mm;
                margin-bottom: 1px;
            }

            h1.heading
            {
                font-size:8pt;
                color:#000;
                font-weight:normal;
                font-style: italic;


            }

            h2.heading
            {
                font-size:8pt;
                color:#000;
                font-weight:normal;
            }

            hr
            {
                color:#ccc;
                background:#ccc;
            }

            #invoice_body
            {
                height: auto;
            }

            #invoice_body , #invoice_total
            {   
                width:100%;
            }
            #invoice_body table , #invoice_total table
            {
                width:100%;
                /** border-left: 1px solid #ccc;
                border-top: 1px solid #ccc; **/

                border-spacing:0;
                border-collapse: collapse; 

                margin-top:0mm;
            }

            #invoice_body table td , #invoice_total table td
            {
                text-align:center;
                font-size:10pt;
                /** border-right: 1px solid black;
                border-bottom: 1px solid black;**/
                padding:0 0;
                font-weight: normal;
            }

            #invoice_head table td
            {
                text-align:left;
                font-size:10pt;
                /** border-right: 1px solid black;
                border-bottom: 1px solid black;**/
                padding:0 0;
                font-weight: normal;
            }

            #invoice_body table td.mono  , #invoice_total table td.mono
            {
                text-align:right;
                padding-right:0mm;
                font-size:6pt;
                border: 1px solid white;
                font-weight: normal;
            }

            #footer
            {   
                width:44mm;
                margin:0 2mm;
                padding-bottom:1mm;
            }
            #footer table
            {
                width:100%;
                /** border-left: 1px solid #ccc;
                border-top: 1px solid #ccc; **/

                background:#eee;

                border-spacing:0;
                border-collapse: collapse; 
            }
            #footer table td
            {
                width:25%;
                text-align:center;
                font-size:10pt;
                /** border-right: 1px solid #ccc;
                border-bottom: 1px solid #ccc;**/
            }
        </style>
    </head>
    <body>
        <div id="wrapper">

            <div id="invoice_head">
                <table style="width:100%; border-spacing:0;">
                    <tr>
                    <td style="font-size: 8pt; "><!-- <img src="<?php // echo $_SESSION['gambar'];   ?>" height="40" width="160" />--> <center><b>Toko Ali</b></td>
                        <td style="text-align:right;"> <p style="text-align:right; font-size: 14px;  border-bottom: black; border-top: black; border-right: black; border-left: black; "></p></td>
                        </tr>
                        <tr style="margin-top: 1px;">
                            <td><p style="text-align:left; font-size: 8pt; margin-top: 1px; "></p></td>
                            <td style="text-align:right;"><p style="font-size: 8pt; "><!--<img style="margin-top: 5px;" alt="<?php //$data['no_invoice'];  ?>" src="<?php //echo "barcode.php?size=15&text=DLV$_GET[id]";   ?>" /> </td>-->
                        </tr>
                        <tr>
                            <td style="border-bottom: 2px solid black;" colspan="2"></td>
                        </tr>

                </table>
            </div>

            <table class="heading" style="width:100%;">
                <!--<tr>
                <td> <center><p style="text-align:center; font-size: 14px; ">Aplikasi Point Of Sales</p></center></td>
                </tr>-->
            </table>
            <table>
                <tr>
                    <td><td><p style="text-align:left; font-size: 8pt; ">Nota : <?= $penjualan->notatransaksi_penjualan_customer ?> </p></td></td>
                    <td><td><p style="text-align:left; font-size: 8pt; ">Tanggal : <?= date('d-m-Y', strtotime($penjualan->tanggal)) ?></p></td></td>
                </tr>
            </table>

            <div id="content">

                <div id="invoice_body">
                    <table border="0">
                        <tr>
                            <td colspan="4">----------------------------------</td>
                        </tr>
                        <?php
                        foreach ($detail_penjualan as $value) {
                            ?>
                            <tr>
                                <td style="width:40%; text-align: left;" class="mono"><?= $value->nama_barang ?></td>
                                <td style="width:25%;" class="mono"><?= "Rp " . number_format($value->hargajual, 0, ',', '.') ?></td>
                                <td style="width:10%; text-align: center;" class="mono"><?= $value->jumlah ?></td>
                                <td style="width:25%;" class="mono"><?= "Rp " . number_format($value->jumlah * $value->hargajual, 0, ',', '.') ?></td>

                            </tr>
                            <tr>
                                <td colspan="4">----------------------------------</td>
                            </tr>
                            
                            <?php
                        }
                        ?>
                    </table>
                </div>

                <div id="invoice_total">

                    <table border="1">
                        <tr>
                        

                        <td colspan="3" style="width:10%; font-size: 8pt;" class="mono"><b><center>Total</b></center></td>  
                        <td colspan="2" style="width:15%; font-size: 8pt;" class="mono"><b><?= "Rp " . number_format($penjualan->totalbayar, 0, ',', '.') ?></b></td>
                        </tr>
                    </table>
                </div>

                <div id="invoice_total">
                    <table border="1">
                        <tr>
                            <td style="text-align: left; border: 1px solid white;"><b></b></td>
                            <td style="width:20%; border: 1px solid white;" class="mono"><b><center></b></center></td>  
                            <td style="width:15%; border: 1px solid white;" class="mono"><b></b></td>
                        </tr>

                        <tr>

                            <td style="width:10%; font-size: 8pt; border-left: 1px solid white; border-right: 1px solid white; border-bottom: 1px solid white; border-top: 1px solid white;" class="mono"><b><center></b></center></td>  
                            <td style="width:15%; border: 1px solid white;" class="mono"><b></b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left; border: 1px solid white;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                        </tr>
                    </table>

                    <table>



                        </body>
                        </html>