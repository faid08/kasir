<div class="content-header">                    
    </div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-info card-outline">
                    <div class="card-title">
                        <div class="row ">
                            <input type="hidden"id="pilihtoko"value="<?= $this->session->userdata['logged_in']['toko']?>">
                            <div class="form-check-inline">                                    
                                <input type="radio" class="form-check-input" id="filter_nota" name="filter_nota_pending_by" value="filter_nota" checked>
                                <label class="form-check-label small" for="filter_nota"style="width: 40px;">Nota</label>
                                <input type="radio" class="form-check-input" id="filter_nama" name="filter_nota_pending_by" value="filter_nama">
                                <label class="form-check-label small " for="filter_nama"style="width: 40px;">Nama</label>
                            </div>
                            <div class=" col-md-6 input-group input-group-sm" style="width: 350px;">
                                <input type="text" name="search_nota_pending_by" id="search_nota_pending_by" class="form-control float-right" placeholder="Berdasarkan Nota Pending">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info" onclick="search_nota_pending()"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" >
            <div class="card">
                <div class="card-body table-responsive p-0 ">
                    <table class="table table-hover text-nowrap">
                        <thead class="bg bg-info">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th >Tanggal Transaksi</th>
                                <th >nota</th>
                                <th >Nama Customer</th>
                                <th >Jenis </th>
                                <th >Tanggal Pengiriman</th>
                                <th >Aksi</th>
                                <th >Info</th>  
                            </tr>
                        </thead>
                        <tbody id="list_data_nota_pending">

                            <tr>
                                <td colspan="9">
                                    &CircleTimes; Silahkan tampilkan Transaksi penjualan Pending berdasarkan <b>Nota pending</b> atau <b>Nama customer</b> dengan klik <button type="submit" class="btn btn-info btn-xs"><i class="fas fa-search"></i></button><br> 
                                    &CircleTimes; Pencarian <b>Nama customer</b> hanya untuk transaksi penjulan <b>Grosir</b>. Untuk transaksi penjulan Ecer gunakan nomer notanya.
                                </td>
                            </tr>

                        </tbody>
                        <tfoot >
                            <tr  style="text-align: right">
                                <td colspan="8"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nota </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <p id="petugas">-</p>
                                <p id="tgl_transaksi">-</p>
                            </div>
                            <div class="col-md-4">
                                <p id="customer">-</p>
                                <p id="marketing">-</p>                                
                            </div>
                            <div class="col-md-4">
                                <p id="hp_customer">-</p> 
                                <p id="hp_marketing">-</p>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                    <th>Harga Jual</th>                                    
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="detail_data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#search_nota_pending_by').focus();
        $("#search_nota_pending_by").keypress(function (e) {
            keyCode = e.keyCode ? e.keyCode : e.which;
            if (keyCode === 13) {
                search_nota_pending();
            }
        });
        $('#filter_nota').click(function () {
            $('#search_nota_pending_by').attr('placeholder', 'Berdasarkan Nota Pending');
            $('#search_nota_pending_by').focus();
        });
        $('#filter_nama').click(function () {
            $('#search_nota_pending_by').attr('placeholder', 'Berdasarkan Nama Customer');
            $('#search_nota_pending_by').focus();
        });

    });
    function search_nota_pending() {
        var fnota = "";
        var fnama = "";
        if ($('#filter_nota').is(':checked')) {
            fnota = 'nota';
        }
        if ($('#filter_nama').is(':checked')) {
            fnama = 'nama';
        }
        $.ajax({
            url: "<?= site_url('Admin_pending/data_pending') ?>",
            type: 'POST',
            data: {search_nota_pending_by: $('#search_nota_pending_by').val(), fnota: fnota, fnama: fnama, pilihtoko:$('#pilihtoko').val()},
            dataType: 'JSON',
            success: function (data) {
                if (data.sukses === 'ya') {
                    $('#list_data_nota_pending').html('`' + data.list_data + '`');
                } else {
                    $('#list_data_nota_pending').html('`' + data.list_data + '`');
                }
                $('#search_nota_pending_by').focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    }
    function info_nota_pending(nota) {
        $('.modal-title').html(nota);
        $.ajax({
            url: "<?= site_url('Admin_pending/info_nota_pending') ?>",
            type: 'POST',
            data: {nota: nota,pilihtoko:$('#pilihtoko').val()},
            dataType: 'JSON',
            success: function (data) {
                $('#petugas').html('Petugas&nbsp;:&nbsp; ' + data.penjualan.petugas);
                $('#tgl_transaksi').html('Tanggal&nbsp;:&nbsp;' + data.penjualan.tanggal);
                $('#customer').html('Nama customer&nbsp;&nbsp;:&nbsp;' + data.penjualan.nama_c);
                $('#hp_customer').html('HP customer&nbsp;&nbsp;:&nbsp; ' + data.penjualan.hp_c);
                $('#marketing').html('Nama marketing&nbsp;:&nbsp;' + data.penjualan.nama_m);
                $('#hp_marketing').html('HP marketing&nbsp;:&nbsp;' + data.penjualan.hp_m);
                $('#detail_data').html('`' + data.detail_penjualan + '`');

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    }
    function form_edit_nota_pending(nota) {
        $.post('<?= site_url('Kasir_dashboard/form_edit_nota_pending') ?>', {nota: nota,pilihtoko:$('#pilihtoko').val()}, function (Res) {
            $('.content_konten').html(Res);
        });
    }
</script>