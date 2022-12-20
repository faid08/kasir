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
                                <input type="text" name="search_nama_pengeluaran" id="search_nama_pengeluaran" class="form-control float-right" placeholder="Cari Nama Pengeluaran">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info"  onclick="search_pengeluaran()"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-tools">                        
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="#"  onclick="form_tambah_pengeluaran()"><i class="fa fa-plus-square"></i> Tambah pengeluaran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('Admin_dashboard/export_data_bpengeluaran') ?>" ><i class="fa fa-copy"></i> Export Data pengeluaran</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

<!--     <div class="row">
        <div class="col-md-12" id="list_pengeluaran">
            <div class="card">
                <div class="card-body table-responsive p-0 ">
                    <table class="table table-hover text-nowrap">
                        <thead class="bg bg-info">
                            <tr>
                                <th style="width: 10px">#</th>
                                 <th >Ket</th>
                                <th >Nominal</th>
                                <th >Tanggal</th>
                                <th >Aksi</th> 
                            </tr>
                        </thead>
                        <tbody id="data_list_pengeluaran">
                          
                        </tbody>
                        <tfoot >
                            <tr  style="text-align: right">
                                <td colspan="8"><label> <small>Total Toko </small> ( <?= $jpengeluaran?> )</label></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5" id="toko_tambah_edit">

        </div>
    </div> -->
    <div class="row">
        <div class="col-md-12" id="list_pengeluaran">
            <div class="card">
                <div class="card-body table-responsive p-0 ">
                    <table class="table table-hover text-nowrap">
                        <thead class="bg bg-info">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th >Ket</th>
                                <th >Nominal</th>
                                <th >Tanggal</th>
                                <!-- <th >Aksi</th>  -->
                            </tr>
                        </thead>
                        <tbody class="data_list_pengeluaran">                       
                           
                        </tbody>
                        <tfoot >
                            <tr  >
                                <td colspan="2">
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
                                <td colspan="4" style="text-align: right"><label> <small>Jumlah Pengeluaran </small> ( <?= $jpengeluaran ?> )</label></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5" id="pengeluaran_tambah_edit">

        </div>

    </div>
</div>
<script>
    $(function () {
        $("#search_nama_pengeluaran").focus();
        search_pengeluaran();
        $('#search_nama_pengeluaran').keyup(function () {
            if ($(this).val().length >= 0) {
                search_pengeluaran();
            }
        });
        $('#baris').change(function () {
            search_pengeluaran();
        });
        $('#pilihtoko').change(function () {
            search_pengeluaran();
        });
      
    });
    function form_hapus_pengeluaran(id) {
        if (confirm("Apakah anda ingin menghapus data ini ?")) {
            $.ajax({
                url: '<?php echo site_url('Admin_dashboard/form_hapus_pengeluaran') ?>',
                type: 'POST',
                data: {id: id},
                dataType: "JSON",
                success: function (data) {
                    if (data.sukses === 'ya') {
                        alert_pesan('info', data.pesan);
                        search_pengeluaran();
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
    function form_tambah_pengeluaran() {
        $.post('tambah-pengeluaran', function (Res) {
            $('#list_pengeluaran').removeClass('col-md-12');
            $('#list_pengeluaran').addClass('col-md-7');
            $('#pengeluaran_tambah_edit').html(Res);
        });
    }
    function form_edit_pengeluaran(id,idtoko) {
        $.post('edit-pengeluaran', {id: id,idtoko: idtoko}, function (Res) {
            $('#list_pengeluaran').removeClass('col-md-12');
            $('#list_pengeluaran').addClass('col-md-7');
            $('#pengeluaran_tambah_edit').html(Res);
        });
    }
  
    function search_pengeluaran() {
        $.ajax({
            url: "<?= site_url('Admin_master/search_pengeluaran') ?>",
            type: 'POST',
            data: {search_nama_pengeluaran: $('#search_nama_pengeluaran').val(), toko: $('#pilihtoko').val(), baris: $('#baris').val()},
            dataType: 'JSON',
            success: function (data) {
                if (data.sukses === 'ya') {
                    $('.data_list_pengeluaran').html('`' + data.list_pengeluaran + '`');
                } else {
                    $('.data_list_pengeluaran').html('`' + data.list_pengeluaran + '`');
                }
                cancel_pengeluaran();
                $('#search_nama_pengeluaran').focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    }
    function cancel_pengeluaran() {
        $('#pengeluaran_tambah_edit').html('');
        $('#list_pengeluaran').removeClass('col-md-7');
        $('#list_pengeluaran').addClass('col-md-12');
    }
</script>