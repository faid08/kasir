<div class="container-fluid " id="div_petugas">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="row ">                         
                            <div class=" col-md-6 input-group input-group-sm" style="width: 500px;">
                                <input type="text" name="search_petugas_by" id="search_petugas_by" class="form-control float-right" placeholder="Berdasarkan Nama Petugas">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-tools">                        
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" data-toggle="tab" onclick="form_tambah_petugas()"><i class="fa fa-plus-square"></i> Tambah Petugas</a>
                            </li>                           
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="list_petugas">
            <div class="card">
                <div class="card-body table-responsive p-0 ">
                    <table class="table table-hover text-nowrap">
                        <thead class="bg bg-info">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th >Petugas Toko</th>
                                <th >Nama Lengkap</th>
                                <th >Alamat</th>                                
                                <th >Handphone </th>
                                <th >Jabatan </th>
                                <th >Status</th>     
                                <td>Progres Keaktifan</td>
                            </tr>
                        </thead>
                        <tbody id="data_list_petugas">
                          
                        </tbody>
                        <tfoot >
                            <tr  style="text-align: right">
                                <td colspan="8"><label> <small>Total Petugas </small> ( <?= $jpetugas?> )</label></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5" id="petugas_tambah_edit">

        </div>
    </div>
</div>
<script>
     $(function () {
        $('#search_petugas_by').focus();
        search_petugas();
        $("#search_petugas_by").keypress(function (e) {
            keyCode = e.keyCode ? e.keyCode : e.which;
            if (keyCode === 13) {
                search_petugas();
            }
        });
    });
    function search_petugas() {
            $.ajax({
            url: "<?= site_url('Admin_master/search_petugas') ?>",
            type: 'POST',
            data: {search_petugas_by: $('#search_petugas_by').val()},
            dataType: 'JSON',
            success: function (data) {
                if (data.sukses === 'ya') {
                    $('#data_list_petugas').html('`' + data.list_petugas + '`');
                } else {
                    $('#data_list_petugas').html('`' + data.list_petugas + '`');
                }
                cancel_petugas();
                $('#search_petugas_by').focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR);
            }
        });
    }
    function form_tambah_petugas() {
        $.post('tambah-petugas', function (Res) {
            $('#list_petugas').removeClass('col-md-12');
            $('#list_petugas').addClass('col-md-7');
            $('#petugas_tambah_edit').html(Res);
        });
    }
    function form_edit_petugas(id) {
        $.post('edit-petugas', {id: id}, function (Res) {
            $('#list_petugas').removeClass('col-md-12');
            $('#list_petugas').addClass('col-md-7');
            $('#petugas_tambah_edit').html(Res);
        });
    }
    function cancel_petugas() {
        $('#petugas_tambah_edit').html('');
        $('#list_petugas').removeClass('col-md-7');
        $('#list_petugas').addClass('col-md-12');
    }
</script>