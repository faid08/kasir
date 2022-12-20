<?php
// header("Pragma: public");
// header('Content-Type: application/vnd.ms-excel');
// header("Content-Disposition: attachment; filename=Master Barang (export " . date('d-m-Y') . ").xls");

?>


  <link rel="stylesheet" href="<?= site_url(); ?>assets/dataTables/jquery.dataTables.min.css">
  <link rel="stylesheet" href="<?= site_url(); ?>assets/dataTables/buttons.dataTables.min.css"/>
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

  <div class="panel panel-primary">
    <div class="panel-heading">
       Cetak Barang
    </div>
    <div class="panel-body">
      <table class="table table-striped" id="tbl-student">
        <thead>
          <tr>
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
        if (count($data) > 0) {
            $no = 1;
            foreach ($data as $value) {
                ?>

            <tr>
                <td ><?php echo $no++ ?></td>
                <td ><?php echo $value->barcode ?></td>
                <td ><?php echo $value->nama_barang ?></td>
                <td ><?php echo $value->isibarang ?></td>
                <td style="background-color: blue"><?php echo $value->hargabeli ?></td>
                <td ><?php echo $value->hecer1 ?></td>
                <td ><?php echo $value->hecer2 ?></td>
                <td style="background-color: #FFEB3B"><?php echo $value->hgrosir1 ?></td>
                <td style="background-color: #FFEB3B"><?php echo $value->hgrosir2 ?></td>
                <td style="background-color: #FFEB3B"><?php echo $value->hgrosir3 ?></td>
                <td style="background-color: #FFEB3B"><?php echo $value->tanggalpromo ?></td>
                <td style="background-color: #FFEB3B"><?php echo $value->stock ?></td>
            </tr>
            <?php
            }
        } else {
            $data = '<tr><td colspan="12"><span class="text-danger" style="text-transform: uppercase"><b><u> ' . $nama_barang . ' </u></b></span> Tidak ditemukan silahkan gunakan kata pencarian lain atau tambahkan di barang baru</td></tr>';
        }
        
        ?>
    </tbody>
      </table>
    </div>
  </div>
</div>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
<script src="<?= site_url(); ?>/assets/dataTables/jquery.dataTables.min.js"></script>
<script src="<?= site_url(); ?>/assets/dataTables/dataTables.buttons.min.js"></script>
<script src="<?= site_url(); ?>/assets/dataTables/jszip.min.js"></script>
<script src="<?= site_url(); ?>/assets/dataTables/pdfmake.min.js"></script>
<script src="<?= site_url(); ?>/assets/dataTables/vfs_fonts.js"></script>
<script src="<?= site_url(); ?>/assets/dataTables/buttons.html5.min.js"></script>

<script>
   $(function(){
    
     $("#tbl-student").DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                title: 'Data export'
            },
            {
                extend: 'excelHtml5',
                title: 'Master Barang'
            },
            {
                extend: 'csvHtml5',
                title: 'Data export'
            },
            {
                extend: 'pdfHtml5',
                title: 'Data export'
            },
            {
                extend: 'pageLength',
                title: 'Data export'
            }
        ]
    });
   })
</script>

</body>
</html>
