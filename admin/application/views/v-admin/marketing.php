<div class="container-fluid " id="div_marketing">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="row ">
                            <div class="form-check-inline">                                    
                                <input type="radio" class="form-check-input" id="filter_nama" name="filter_marketing_by" value="filter_nama" checked onclick="search_marketing()">
                                <label class="form-check-label small" for="filter_nama"style="width: 50px;">Nama</label>
                                <input type="radio" class="form-check-input" id="filter_alamat" name="filter_marketing_by" value="filter_alamat"onclick="search_marketing()">
                                <label class="form-check-label small " for="filter_alamat"style="width: 60px;">Alamat</label>
                            </div>
                            <div class=" col-md-6 input-group input-group-sm" style="width: 300px;">
                                <input type="text" name="search_marketing_by" id="search_marketing_by" class="form-control float-right" placeholder="Berdasarkan Nama Marketing">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info"onclick="search_marketing()"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-tools">                        
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" data-toggle="tab" onclick="form_tambah_marketing()"><i class="fa fa-plus-square"></i> Tambah Marketing</a>
                            </li>                           
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="list_marketing">
            <div class="card">
                <div class="card-body table-responsive p-0 ">
                    <table class="table table-hover text-nowrap">
                        <thead class="bg bg-info">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th >Nama Marketing</th>
                                <th >Alamat</th>                                
                                <th >Handphone </th>                        
                            </tr>
                        </thead>
                        <tbody id="data_list_marketing">
                        </tbody>
                        <tfoot >
                            <tr  style="text-align: right">
                                <td colspan="5"><label> <small>Total Marketing </small> ( <?= $jmarketing?> )</label></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5" id="marketing_tambah_edit">

        </div>
    </div>
</div>
<script>
   $(function () {
        $('#search_marketing_by').focus();
        search_marketing();
        $("#search_marketing_by").keypress(function (e) {
            keyCode = e.keyCode ? e.keyCode : e.which;
            if (keyCode === 13) {
                search_marketing();
            }
        });
        $('#filter_nama').click(function () {
            $('#search_marketing_by').attr('placeholder', 'Berdasarkan Nama marketing');
            $('#search_marketing_by').focus();
        });
        $('#filter_alamat').click(function () {
            $('#search_marketing_by').attr('placeholder', 'Berdasarkan Alamat marketing');
            $('#search_marketing_by').focus();
        });
    });
    function search_marketing() {
        var fn = "";
        var fa = "";
        if ($('#filter_nama').is(':checked')) {
            fn = 'Nama';
        }
        if ($('#filter_alamat').is(':checked')) {
            fa = 'Alamat';
        }
        
        $.ajax({
            url: "<?= site_url('Admin_master/search_marketing') ?>",
            type: 'POST',
            data: {search_marketing_by: $('#search_marketing_by').val(), fn: fn, fa: fa},
            dataType: 'JSON',
            success: function (data) {
                if (data.sukses === 'ya') {
                    $('#data_list_marketing').html('`' + data.list_marketing + '`');
                } else {
                    $('#data_list_marketing').html('`' + data.list_marketing + '`');
                }
                cancel_marketing();
                $('#search_marketing_by').focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR);
            }
        });
    }
    function form_tambah_marketing() {
        $.post('tambah-marketing', function (Res) {
            $('#list_marketing').removeClass('col-md-12');
            $('#list_marketing').addClass('col-md-7');
            $('#marketing_tambah_edit').html(Res);
        });
    }
    function form_edit_marketing(id) {
        $.post('edit-marketing', {id: id}, function (Res) {
            $('#list_marketing').removeClass('col-md-12');
            $('#list_marketing').addClass('col-md-7');
            $('#marketing_tambah_edit').html(Res);
        });
    }
    function cancel_marketing() {
        $('#marketing_tambah_edit').html('');
        $('#list_marketing').removeClass('col-md-7');
        $('#list_marketing').addClass('col-md-12');
    }
</script>