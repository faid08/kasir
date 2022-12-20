<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="row ">
                            <div class=" col-md-3 input-group input-group-sm" style="width: 300px;">
                                <select class="form-control" name="pilihtoko" id="pilihtoko">
                                    <?php
                                    foreach ($toko as $value) {
                                        ?>
                                        <option value="<?= $value->idtoko ?>"><?= $value->nama ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class=" input-group input-group-sm col-lg-6" >
                                <input type="text" name="search_piutang_customer" id="search_piutang_customer" class="form-control float-right" placeholder="Nota atau Nama customer">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-danger"  onclick="laporan_piutang_customer()"><i class="fas fa-search"></i></button>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="card-tools">                        
                        <ul class="nav nav-pills ml-auto form-inline">                            
                            <li class="nav-item ">
                                <span> Interval Tanggal : &nbsp;&nbsp;&nbsp;</span>
                            </li>
                            <li class="nav-item">
                                <div class="input-group input-group-sm p-2" >
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="interval_tanggal">
                                </div>
                            </li>                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="row_tabel_hutang" >
            <div class="card">
                <div class="card-body table-responsive p-0 ">
                    <table class="table table-hover text-nowrap">
                        <thead class="bg bg-danger">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th >Tanggal Transaksi</th>
                                <th >Nota</th>
                                <th >Jenis Penjualan</th>
                                <th >Nama Penjab</th>
                                <th >Nama Customer</th>
                                <th >Jumlah Hutang</th>                                
                                <th >Bayar</th>
                                <th >Info</th>  
                                <th >History</th> 
                            </tr>
                        </thead>
                        <tbody id="list_hutang">                           

                        </tbody>
                        <tfoot >
                            <tr  style="text-align: right">
                                <td colspan="9">Jumlah Piutang &nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;&nbsp;<label id="jum_hutang" class="text-red" style="font-size: 25px;">(-)</label></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5" id="row_piutang_customer_edit">

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

<div class="modal fade" id="modal-lghistory">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-titlehistory">History Piutang </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <p id="petugashistory">-</p>
                                <p id="tgl_transaksihistory">-</p>
                            </div>
                            <div class="col-md-4">
                                <p id="customerhistory">-</p>
                                <p id="marketinghistory">-</p>                                
                            </div>
                            <div class="col-md-4">
                                <p id="hp_customerhistory">-</p> 
                                <p id="hp_marketinghistory">-</p>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal/th>
                                    <th>Bayar</th>
                                    <th>Total Bayar</th>                                    
                                    <th>Sisa</th>
                                </tr>
                            </thead>
                            <tbody id="detail_datahistory">

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
<script>
    $(function () {
        $('#search_piutang_customer').focus();
         $('#interval_tanggal').daterangepicker();
         laporan_piutang_customer();
         $("#search_piutang_customer").keypress(function (e) {
            keyCode = e.keyCode ? e.keyCode : e.which;
            if (keyCode === 13) {
                laporan_piutang_customer();
            }
        });
        $('#pilihtoko').change(function () {
            laporan_piutang_customer();
        });
        $('#interval_tanggal').change(function () {
            laporan_piutang_customer();
        });
    });    
    function laporan_piutang_customer() {
     var tgl = $('#interval_tanggal').val();
        $.ajax({
            url: "<?= site_url('Admin_laporan/laporan_piutang_customer') ?>",
            type: 'POST',
            data: {search_nm: $('#search_piutang_customer').val(),tgl:tgl, pilihtoko:$('#pilihtoko').val()},
            dataType: 'JSON',
            success: function (data) {
                if (data.sukses === 'ya') {
                    $('#list_hutang').html('`' + data.list_hutang_customer + '`');
                    $('#jum_hutang').html(data.jum_hutang);
                } else {
                    $('#list_hutang').html('`' + data.list_hutang_customer + '`');
                    $('#jum_hutang').html(data.jum_hutang);
                }
                $('#search_piutang_customer').focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    }
    function info_nota(nota) {
        $('.modal-title').html(nota);
        $.ajax({
            url: "<?= site_url('Admin_laporan/info_nota') ?>",
            type: 'POST',
            data: {nota: nota,pilihtoko:$('#pilihtoko').val()},
            dataType: 'JSON',
            success: function (data) {
                $('#petugas').html('Petugas&nbsp;:&nbsp; '+data.penjualan.petugas);
                $('#tgl_transaksi').html('Tanggal&nbsp;:&nbsp;'+data.penjualan.tanggal);
                $('#customer').html('Nama customer&nbsp;&nbsp;:&nbsp;'+data.penjualan.nama_c);
                $('#hp_customer').html('HP customer&nbsp;&nbsp;:&nbsp; '+data.penjualan.hp_c);
                $('#marketing').html('Nama marketing&nbsp;:&nbsp;'+data.penjualan.nama_m);
                $('#hp_marketing').html('HP marketing&nbsp;:&nbsp;'+data.penjualan.hp_m);
                $('#detail_data').html('`' + data.detail_penjualan + '`');

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    }

    function historypiutang_nota(nota) {
        $('.modal-titlehistory').html(nota);
        $.ajax({
            url: "<?= site_url('Admin_laporan/infohistory_nota') ?>",
            type: 'POST',
            data: {nota: nota},
            dataType: 'JSON',
            success: function (data) {
                $('#petugashistory').html('Petugas&nbsp;:&nbsp; '+data.penjualanhistory.petugas);
                $('#tgl_transaksihistory').html('Tanggal&nbsp;:&nbsp;'+data.penjualanhistory.tanggal);
                $('#customerhistory').html('Nama customer&nbsp;&nbsp;:&nbsp;'+data.penjualanhistory.nama_c);
                $('#hp_customerhistory').html('HP customer&nbsp;&nbsp;:&nbsp; '+data.penjualanhistory.hp_c);
                $('#marketinghistory').html('Nama marketing&nbsp;:&nbsp;'+data.penjualanhistory.nama_m);
                $('#hp_marketinghistory').html('HP marketing&nbsp;:&nbsp;'+data.penjualanhistory.hp_m);
                $('#detail_datahistory').html('`' + data.detail_penjualanhistory + '`');

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    }
    function form_edit_piutang_customer(id) {
        $.post('<?= site_url('Admin_dashboard/form_edit_piutang_customer')?>', {id: id,pilihtoko:$('#pilihtoko').val()}, function (Res) {
            $('#row_tabel_hutang').removeClass('col-md-12');
            $('#row_tabel_hutang').addClass('col-md-7');
            $('#row_piutang_customer_edit').html(Res);
        });
    }
    function cancel_form() {
        $('#row_piutang_customer_edit').html('');
        $('#row_tabel_hutang').removeClass('col-md-7');
        $('#row_tabel_hutang').addClass('col-md-12');
    }
</script>