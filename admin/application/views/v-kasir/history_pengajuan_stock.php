<div class="content-header">                    
    </div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="row ">
                            
                                 <input type="hidden"id="pilihtoko"value="<?= $this->session->userdata['logged_in']['toko']?>">
                            
                        </div>
                    </div>
                    <div class="card-tools">                        
                        <ul class="nav nav-pills ml-auto form-inline">                            
                            <li class="nav-item ">
                                <span> Interval Tanggal : &nbsp;&nbsp;&nbsp;</span>
                            </li>
                            <li class="nav-item ">
                                <div class="input-group input-group-sm p-2 " >
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="interval_tanggal">
                                </div>
                            </li>
                                                      
                            <li class="nav-item">
                                <a class="nav-link" href="#" ><i class="fa fa-copy"></i> Export Data Omset</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive p-0 ">
                    <table class="table table-hover text-nowrap">
                        <thead >
                            <tr>
                                <th style="width: 10px">#</th>
                                <th >Tanggal Transaksi</th>
                                <th >Nomer Pengajuan</th>
                                <th >Nama Pegawai</th>                                
                                <th class="bg bg-warning">Status Pengajuan</th>
                                
                            </tr>
                        </thead>
                        <tbody id="list_omset">   

                        </tbody>
                        <tfoot >                        
                            <tr >
                                <td colspan="4">
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
                                </td >
                                <td colspan="4"style="text-align: right"></td>
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
<script>
    $(function () {
        $('#search_omset').focus();
        $('#interval_tanggal').daterangepicker();
        laporan_omset();        
        $('#search_omset').keyup(function () {
            if ($(this).val().length >= 0) {
                laporan_omset();
            }
        });
        $('#baris').change(function () {
            laporan_omset();
        });
        $('#pilihtoko').change(function () {
            laporan_omset();
        });
        $('#interval_tanggal').change(function () {
            laporan_omset();
        });
    });
    function laporan_omset() {
        var tgl = $('#interval_tanggal').val();
        $.ajax({
            url: "<?= site_url('Admin_laporan/laporan_history_pengajuan') ?>",
            type: 'POST',
            data: { tgl: tgl, pilihtoko: $('#pilihtoko').val(), baris: $('#baris').val()},
            dataType: 'JSON',
            success: function (data) {
                if (data.sukses === 'ya') {
                    $('#list_omset').html('`' + data.list_omset + '`');
                    $('#jum_omset').html(data.jum_omset);
                } else {
                    $('#list_omset').html('`' + data.list_omset + '`');
                    $('#jum_omset').html(data.jum_omset);
                }
                $('#search_omset').focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    }
    function print_ecer(nota) {
        window.open("<?php echo site_url('Admin_penjualan/cE') ?>/" + nota);
    }
    function print_grosir(nota) {
        window.open("<?php echo site_url('Admin_penjualan/cG') ?>/" + nota);
    }
    function info_nota(nota) {
        $('.modal-title').html(nota);
        $.ajax({
            url: "<?= site_url('Admin_laporan/info_nota') ?>",
            type: 'POST',
            data: {nota: nota, pilihtoko: $('#pilihtoko').val()},
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
</script>
