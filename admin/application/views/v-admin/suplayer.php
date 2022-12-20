<div class="container-fluid " id="div_suplayer">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="row ">
                            <div class="form-check-inline">                                    
                                <input type="radio" class="form-check-input" id="filter_nama" name="filter_suplayer_by" value="filter_nama" checked onclick="search_suplayer()">
                                <label class="form-check-label small" for="filter_nama"style="width: 50px;">Nama</label>
                                <input type="radio" class="form-check-input" id="filter_alamat" name="filter_suplayer_by" value="filter_alamat"onclick="search_suplayer()">
                                <label class="form-check-label small " for="filter_alamat"style="width: 60px;">Alamat</label>
                            </div>
                            <div class=" col-md-6 input-group input-group-sm" style="width: 300px;">
                                <input type="text" name="search_suplayer_by" id="search_suplayer_by" class="form-control float-right" placeholder="Berdasarkan Nama suplayer">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info"onclick="search_suplayer()"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-tools">                        
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" data-toggle="tab" onclick="form_tambah_suplayer()"><i class="fa fa-plus-square"></i> Tambah suplayer</a>
                            </li>                           
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="list_suplayer">
            <div class="card">
                <div class="card-body table-responsive p-0 ">
                    <table class="table table-hover text-nowrap">
                        <thead class="bg bg-info">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th >Nama suplayer</th>
                                <th >Alamat</th>                                
                                <th >Handphone </th>                        
                            </tr>
                        </thead>
                        <tbody id="data_list_suplayer">
                        </tbody>
                        <tfoot >
                            <tr  style="text-align: right">
                                <td colspan="5"><label> <small>Total suplayer </small> ( <?= $jsuplayer?> )</label></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5" id="suplayer_tambah_edit">

        </div>
    </div>
</div>
<script>
   $(function () {
        $('#search_suplayer_by').focus();
        search_suplayer();
        $("#search_suplayer_by").keypress(function (e) {
            keyCode = e.keyCode ? e.keyCode : e.which;
            if (keyCode === 13) {
                search_suplayer();
            }
        });
        $('#filter_nama').click(function () {
            $('#search_suplayer_by').attr('placeholder', 'Berdasarkan Nama suplayer');
            $('#search_suplayer_by').focus();
        });
        $('#filter_alamat').click(function () {
            $('#search_suplayer_by').attr('placeholder', 'Berdasarkan Alamat suplayer');
            $('#search_suplayer_by').focus();
        });
    });
    function search_suplayer() {
        var fn = "";
        var fa = "";
        if ($('#filter_nama').is(':checked')) {
            fn = 'Nama';
        }
        if ($('#filter_alamat').is(':checked')) {
            fa = 'Alamat';
        }
        
        $.ajax({
            url: "<?= site_url('Admin_master/search_suplayer') ?>",
            type: 'POST',
            data: {search_suplayer_by: $('#search_suplayer_by').val(), fn: fn, fa: fa},
            dataType: 'JSON',
            success: function (data) {
                if (data.sukses === 'ya') {
                    $('#data_list_suplayer').html('`' + data.list_suplayer + '`');
                } else {
                    $('#data_list_suplayer').html('`' + data.list_suplayer + '`');
                }
                cancel_suplayer();
                $('#search_suplayer_by').focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR);
            }
        });
    }
    function form_tambah_suplayer() {
        $.post('tambah-suplayer', function (Res) {
            $('#list_suplayer').removeClass('col-md-12');
            $('#list_suplayer').addClass('col-md-7');
            $('#suplayer_tambah_edit').html(Res);
        });
    }
    function form_edit_suplayer(id) {
        $.post('edit-suplayer', {id: id}, function (Res) {
            $('#list_suplayer').removeClass('col-md-12');
            $('#list_suplayer').addClass('col-md-7');
            $('#suplayer_tambah_edit').html(Res);
        });
    }
    function cancel_suplayer() {
        $('#suplayer_tambah_edit').html('');
        $('#list_suplayer').removeClass('col-md-7');
        $('#list_suplayer').addClass('col-md-12');
    }
</script>