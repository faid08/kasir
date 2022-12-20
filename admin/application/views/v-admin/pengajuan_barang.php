<div class="container-fluid">
    
    <div class="row">
        <div class="col-md-12" id="list_barang">
            <div class="card">
			<input type="hidden" class=" form-control form-control-sm" id="idtoko" name="idtoko" placeholder="">
                                            <input type="hidden" class=" form-control form-control-sm" id="no_pengajuan_barang" name="no_pengajuan_barang" placeholder="">
											<input type="hidden" class=" form-control form-control-sm" id="iduser" name="iduser" placeholder="">

                <div class="card-body table-responsive p-0 ">
                    <table class="table table-hover text-nowrap">
							<thead class="bg bg-info">
								<tr>
									<th>Nama Toko</th>
									<th >Nama Kepala Toko</th>
									<th >No Pengajuan</th>
									
									<th >Aksi</th> 
								</tr>
							</thead>
                        <tbody class="data_list_barang">                       
                           
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
	</div>
</div>

	<div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Lihat Barang</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Nomer Pengajuan</label>
                                        <div class="col-sm-8">
                                        </div>
                                    </div>  
									<table class="table table-hover text-nowrap">
											<thead class="bg bg-info">
												<tr>
													<th>Nama Barang</th>
													<th >Pengajuan <br> Stock</th>													
													<th >Acc <br> Stock</th>													
												</tr>
											</thead>
										<tbody class="data_list_barang_pengajuan">                       
										
										</tbody>
										
									</table>

                                </div>
                                <div class="modal-footer">
                                    
                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>




<script>
    $(function () {
       
            search_barang();
       
    });
    function form_hapus_barang(id) {
        if (confirm("Apakah anda ingin menghapus data ini ?")) {
            $.ajax({
                url: '<?php echo site_url('Admin_dashboard/form_hapus_barang') ?>',
                type: 'POST',
                data: {id: id},
                dataType: "JSON",
                success: function (data) {
                    if (data.sukses === 'ya') {
                        alert_pesan('info', data.pesan);
                        search_barang();
                    }else{
                        alert_pesan('error', data.pesan);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(textStatus);
                }
            });
        } else {
            // alert("Error : Refresh the page again");
        }
    }
    function form_tambah_barang() {
        $.post('<?= site_url('Admin_dashboard/form_tambah_barang')?>', function (Res) {
            $('#list_barang').removeClass('col-md-12');
            $('#list_barang').addClass('col-md-8');
            $('#barang_tambah_edit').html(Res);
            //$('#barang_historybarang').html('');
        });
    }
    function form_edit_barang(id,idtoko) {
        $.post('edit-barang', {id: id,idtoko: idtoko}, function (Res) {
            $('#list_barang').removeClass('col-md-12');
            $('#list_barang').addClass('col-md-8');
            $('#barang_tambah_edit').html(Res);
            $('#barang_historybarang').html('');
            // $('#list_barang').removeClass('col-md-7');
            // $('#list_barang').addClass('col-md-12');
        });
    }
    function form_historystock_barang(id,idtoko) {
        $.post('barang-historystock', {id: id,idtoko: idtoko}, function (Res) {
            // $('#list_barang').removeClass('col-md-12');
            // $('#list_barang').addClass('col-md-12');
            $('#barang_historybarang').html(Res);
        });
    }

    function search_barang() {
        var filter_stock = "";
        if ($('#filter_stock').is(':checked')) {
            filter_stock = 'true';
        }
        $.ajax({
            url: "<?= site_url('Admin_master/search_pengajuanbarang') ?>",
            type: 'POST',
            data: {search_nama_barang: $('#search_nama_barang').val(), filter_stock: filter_stock, toko: $('#pilihtoko').val(), baris: $('#baris').val()},
            dataType: 'JSON',
            success: function (data) {
                if (data.sukses === 'ya') {
                    $('.data_list_barang').html('`' + data.list_barang + '`');
                } else {
                    $('.data_list_barang').html('`' + data.list_barang + '`');
                }
                cancel_barang();
                $('#search_nama_barang').focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    }

    function print_barang() {
        var filter_stock = "";
        var search_barang=$('#search_nama_barang').val();
        var filter_stock=$('#filter_stock').val();
        var toko=$('#pilihtoko').val();
        var baris=$('#baris').val();
        if ($('#filter_stock').is(':checked')) {
            filter_stock = 'true';
        }
        $.ajax({
            url: "<?= base_url('Admin_dashboard/export_data_barang') ?>",
            type: 'POST',
            data: {search_nama_barang: $('#search_nama_barang').val(), filter_stock: filter_stock, toko: $('#pilihtoko').val(), baris: $('#baris').val()},
            dataType: 'HTML',
             success: function (results) {
                $("#barang_historybarang").html(results);
                
             }
        });
    }

	function edit_pengajuan_stock(iddetailtransaksi_kulakan,index_row,stock_gudang)
	{
	 
     
	  
	  $.ajax({
            url: "<?= site_url('Admin_master/update_stock_pengajuan') ?>",
            type: 'POST',
            data: {iddetailtransaksi_kulakan: iddetailtransaksi_kulakan, jumlah_acc:$('#jml' + index_row + '').val(),stock_gudang:stock_gudang },
            dataType: 'JSON',
            success: function (data) {
                if (data.sukses === 'ya') {
					alert(data.pesan);
                
                } else {
                    alert(data.pesan);
                
                }
                
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Pengajuan Barang Di ACC");
				// search_barang();
            }
        });	  
      
	}

	function acc(no_pengajuan,idtoko,iduser)
	{
	 
      $('[name="no_pengajuan_barang"]').val(no_pengajuan);
	  $('[name="idtoko"]').val(idtoko);
	  $('[name="iduser"]').val(iduser);
	  
	  $.ajax({
            url: "<?= site_url('Admin_master/simpan_acc') ?>",
            type: 'POST',
            data: {no: no_pengajuan,idtk: idtoko,idser: iduser},
            dataType: 'JSON',
            success: function (data) {
                if (data.sukses === 'ya') {
					alert_pesan('info', data.pesan);
					
                } else {
                    alert_pesan('info', data.pesan);
                
                }
                
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Pengajuan Barang Di ACC");
				search_barang();
            }
        });	  
      
	}
	function tolak(no_pengajuan,idtoko,iduser)
	{
	 
      $('[name="no_pengajuan_barang"]').val(no_pengajuan);
	  $('[name="idtoko"]').val(idtoko);
	  $('[name="iduser"]').val(iduser);
	  
	  $.ajax({
            url: "<?= site_url('Admin_master/tolak_acc') ?>",
            type: 'POST',
            data: {no: no_pengajuan,idtk: idtoko,idser: iduser},
            dataType: 'JSON',
            success: function (data) {
                if (data.sukses === 'ya') {
					alert(data.pesan);
                
                } else {
                    alert(data.pesan);
                
                }
                
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Pengajuan Barang Di Tolak");
				search_barang();
            }
        });	  
      
	}
	function lihat_barang(no_pengajuan)
	{
	 
      $('[name="no_pengajuan_barang"]').val(no_pengajuan);
	  $.ajax({
            url: "<?= site_url('Admin_master/list_pengajuanbarang') ?>",
            type: 'POST',
            data: {no_pengajuan_barang: $('#no_pengajuan_barang').val()},
            dataType: 'JSON',
            success: function (data) {
                if (data.sukses === 'ya') {
                    $('.data_list_barang_pengajuan').html('`' + data.list_barang_pengajuan + '`');
                } else {
                    $('.data_list_barang_pengajuan').html('`' + data.list_barang_pengajuan + '`');
                }
                cancel_barang();
                $('#search_nama_barang').focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });	  
      $('#myModal').modal('show'); 
	}
   
    function cancel_barang() {
        $('#barang_tambah_edit').html('');
        $('#list_barang').removeClass('col-md-7');
        $('#list_barang').addClass('col-md-12');
    }
</script>
