<?php
header("Pragma: public");
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Master Barang (export " . date('d-m-Y') . ").xls");

?>

<table border='1' width="100%">
    <thead>
        <tr >
            <th style="background-color: gray">Kode Barang</th>
           <!--  <th style="background-color: gray">Barcode</th>
            <th style="background-color: gray">Nama Barang</th>
            <th style="background-color: blue">Harga Beli</th>
            <th style="background-color: blue">Produksi</th>
            <th style="background-color: gray">Harga Ecer 1</th>
            <th style="background-color: gray">Harga Ecer 2</th>
            <th style="background-color: #FFEB3B">Harga Grosir 1</th>
            <th style="background-color: #FFEB3B">Harga Grosir 2</th>
            <th style="background-color: #FFEB3B">Harga Grosir 3</th> -->
               <th style="width: 10px">#</th>
                <th>Barcode</th>
                <th >Nama Barang</th>
                <th >Isi Dus</th>
                <th >Beli</th>
                <th >Ecer 1</th>
                <th >Ecer 2</th>
                <th >Grosir 1</th>
                <th >Grosir 2</th>
                <th >Grosir 3</th>
                <th >Promo</th> 
                <th >Stock</th>    
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data as $data) {
            ?>
            <tr>
                <td ><?php echo $data->idbarang ?></td>
                <td ><?php echo '`' . $data->barcode ?></td>
                <td ><?php echo $data->nama_barang ?></td>
                <td style="background-color: blue"><?php echo $data->hargabeli ?></td>
                <td style="background-color: blue"><?php echo $data->produksi ?></td>
                <td ><?php echo $data->hecer1 ?></td>
                <td ><?php echo $data->hecer2 ?></td>
                <td style="background-color: #FFEB3B"><?php echo $data->hgrosir1 ?></td>
                <td style="background-color: #FFEB3B"><?php echo $data->hgrosir2 ?></td>
                <td style="background-color: #FFEB3B"><?php echo $data->hgrosir3 ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>