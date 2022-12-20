<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="row ">
                            <div class=" col-md-3 input-group input-group-sm" style="width: 300px;">
                                <select class="form-control" name="pilihtoko" id="pilihtoko">
                                    <!-- <option value="">Pilin Toko</option> -->
                                    <?php
                                    foreach ($toko as $value) {
                                        ?>
                                        <option value="<?= $value->idtoko ?>"><?= $value->nama ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>

                            </div>
                            <div class=" col-md-4 input-group input-group-sm" style="width: 300px;">
                                <input type="text" name="search_nama_barang" id="search_nama_barang" class="form-control float-right" placeholder="Cari Nama Barang">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info"  onclick="search_barang()"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <div class="form-check-inline">                                    
                                <input type="checkbox" class="form-check-input" id="filter_stock" onclick="search_barang()" >
                                <label class="form-check-label" for="filter_stock"style="width: 100px;">Stock Minim</label>
                            </div>
                        </div>

                    </div>
                    <div class="card-tools">                        
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="#"  onclick="form_tambah_barang()"><i class="fa fa-plus-square"></i> Tambah Barang</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#"  onclick="print_barang()"><i class="fa fa-plus-square"></i> export Barang</a>

                                <!-- <a class="nav-link" href="<?php echo site_url('Admin_dashboard/export_data_barang/$value->idtoko') ?>" ><i class="fa fa-copy"></i> Export Data Barang</a> -->
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="list_barang">
            <div class="card">
                <div class="card-body table-responsive p-0 ">
                    <table class="table table-hover text-nowrap">
                        <thead class="bg bg-info">
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
                                <th >Aksi</th> 
                            </tr>
                        </thead>
                        <tbody class="data_list_barang">                       
                           
                        </tbody>
                        <tfoot >
                            <tr  >
                                <td colspan="8">
                                    <div class=" col-sm-12 form-group row float-left"style="margin-bottom:0px; ">                        
                                        <div class="col-sm-3">
                                            <select class=" form-control form-control-sm" name="baris" id="baris">
                                                <option value="10">10</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                                <option value="500">500</option>
                                                <option value="all">Semua</option>
                                            </select>
                                        </div>
                                        <label for="baris" class="col-sm-3 col-form-label">Baris Data</label>
                                    </div>
                                </td>
                                <td colspan="5"style="text-align: right"><label> <small>Jumlah Barang </small> ( <?= $jbarang ?> )</label></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>


<!--  -->
<?php $kode='3242342';?>
                                <img src="<?php echo site_url('Admin_master/Barcode/'.$kode); ?>" alt="">
        <!--  -->
        <div class="col-md-4" id="barang_tambah_edit">

        </div>
        <div class="modal fade" id="ehistorystock" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width:800px">
                    <div class="modal-header">
                        <h4 class="modal-title">History Stock</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover text-nowrap">
                        <thead class="bg bg-info">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th >Nama Barang</th>
                                <th >Tanggal</th>
                                <th >Stock</th>
                                <th >Type</th>
                                <th >Ket</th>
                            </tr>
                        </thead>
                        <tbody class="data_list_historystock">                       
                           
                        </tbody>
                    </table>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12" id="barang_historybarang">
            
        </div>
    </div>
    <div id="results">
        
    </div>
</div>

<script>
    $(function () {
        $("#search_nama_barang").focus();
        search_barang();
        $('#search_nama_barang').keyup(function () {
            if ($(this).val().length >= 0) {
                search_barang();
            }
        });
        $('#baris').change(function () {
            search_barang();
        });
        $('#pilihtoko').change(function () {
            search_barang();
        });
      
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
            url: "<?= site_url('Admin_master/search_barang') ?>",
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
   
    function cancel_barang() {
        $('#barang_tambah_edit').html('');
        $('#list_barang').removeClass('col-md-7');
        $('#list_barang').addClass('col-md-12');
    }
</script>
