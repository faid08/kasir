<div class="content-header">                    
    </div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="row ">                         
                            <div class=" col-md-6 input-group input-group-sm" style="width: 500px;">
                              <!--   <input type="text" name="search_toko_by" id="search_toko_by" class="form-control float-right" placeholder="Berdasarkan Nama Toko">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                                </div> -->
                                 <input type="hidden"id="pilihtoko"value="<?= $this->session->userdata['logged_in']['toko']?>">
                            </div>
                        </div>

                    </div>
                   <!--  <div class="card-tools">                        
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" data-toggle="tab" onclick="form_tambah_toko()"><i class="fa fa-plus-square"></i> Tambah Toko</a>
                            </li>                           
                        </ul>
                    </div> -->
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="list_toko">
            <div class="card">
                <div class="card-body table-responsive p-0 ">
                    <table class="table table-hover text-nowrap">
                        <thead class="bg bg-info">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th >Nama Toko</th>
                                <th >Alamat</th>  
                                <th >Modal</th>
                            </tr>
                        </thead>
                        <tbody id="data_list_toko">
                          
                        </tbody>
                        <tfoot >
                            <tr  style="text-align: right">
                                <td colspan="8"><label> <small>Total Toko </small> ( <?= $jtoko?> )</label></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5" id="toko_tambah_edit">

        </div>
    </div>
</div>
<script>
     $(function () {
        $('#search_toko_by').focus();
        search_toko();
        $("#search_toko_by").keypress(function (e) {
            keyCode = e.keyCode ? e.keyCode : e.which;
            if (keyCode === 13) {
                search_toko();
            }
        });
    });
    function search_toko() {
            $.ajax({
            url: "<?= site_url('Admin_master/search_tokokasir') ?>",
            type: 'POST',
            data: {pilihtoko: $('#pilihtoko').val()},
            dataType: 'JSON',
            success: function (data) {
                if (data.sukses === 'ya') {
                    $('#data_list_toko').html('`' + data.list_toko + '`');
                } else {
                    $('#data_list_toko').html('`' + data.list_toko + '`');
                }
                cancel_toko();
                $('#search_toko_by').focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR);
            }
        });
    }
    function form_tambah_toko() {
        $.post('tambah-toko', function (Res) {
            $('#list_toko').removeClass('col-md-12');
            $('#list_toko').addClass('col-md-7');
            $('#toko_tambah_edit').html(Res);
        });
    }
    function form_edit_toko(id) {
        $.post('edit-toko', {id: id}, function (Res) {
            $('#list_toko').removeClass('col-md-12');
            $('#list_toko').addClass('col-md-7');
            $('#toko_tambah_edit').html(Res);
        });
    }
    function cancel_toko() {
        $('#toko_tambah_edit').html('');
        $('#list_toko').removeClass('col-md-7');
        $('#list_toko').addClass('col-md-12');
    }
</script>