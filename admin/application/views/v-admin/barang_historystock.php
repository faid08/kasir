  <link rel="stylesheet" href="<?= site_url(); ?>assets/dataTables/jquery.dataTables.min.css">
  <link rel="stylesheet" href="<?= site_url(); ?>assets/dataTables/buttons.dataTables.min.css"/>
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
<table class="table table-bordered table-hover" id="example11">
	<thead>
		<tr>
			<th style="width: 10px">#</th>
            <th >Nama Barang</th>
            <th >Tanggal</th>
            <th >Stock</th>
            <th >Type</th>
            <th >Ket</th>
		</tr>
	</thead>
	<tbody>
		         <?php $no = 1;
             foreach ($list_barangstock as $value) {
                 	$namabarang = $this->Mmaster->lihat_barang($value->idbarang)->row()->nama_barang;
            
            ?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $namabarang ?></td>
			<td><?php echo $value->tgl_up ?></td>
			<td><?php echo trim($value->stock,'-')  ?></td>
			<td><?php echo $value->tipe ?></td>
			<td><?php echo $value->ket ?></td>
		</tr>
	<?php  }?>
	</tbody>
</table>
</div></div></div></div>
<script src="<?= site_url(); ?>/assets/dataTables/jquery.dataTables.min.js"></script>
<script src="<?= site_url(); ?>/assets/dataTables/dataTables.buttons.min.js"></script>
<script src="<?= site_url(); ?>/assets/dataTables/jszip.min.js"></script>
<script src="<?= site_url(); ?>/assets/dataTables/pdfmake.min.js"></script>
<script src="<?= site_url(); ?>/assets/dataTables/vfs_fonts.js"></script>
<script src="<?= site_url(); ?>/assets/dataTables/buttons.html5.min.js"></script>

<script>
   $(function(){
     $("#example11").DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
            'pageLength'
        ]
    });
   })
</script>