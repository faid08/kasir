<style type="text/css">
    .ui-autocomplete {
        z-index:1100 !important;
        position: absolute;
    }
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo site_url() ?>vendor/plugins/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="<?php echo site_url() ?>vendor/plugins/jquery-ui/jquery-ui.js"></script>
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
                            <div class=" col-md-4 input-group input-group-sm" style="width: 400px;">
                                <input type="text" name="barang" id="barang" class="form-control float-right" placeholder="Cari Nama Barang">

                            </div>                            
                        </div>
                    </div>
                    <div class="card-tools">                        
<!--                        <ul class="nav nav-pills ml-auto form-inline">                            
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
                        </ul>-->
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
                                <th >Nota</th>
                                <th >Tanggal Transaksi</th>
                                <th >Jenis Penjualan</th>
                                <th > Customer</th>
                                <th >Marketing</th>
                                <th >Petugas</th>
                                <th >Jumlah stock di jual</th>                                  
                            </tr>
                        </thead>
                        <tbody class="data_list_barang">                       

                        </tbody>
                        <tfoot >
                            <tr  >
                                <td colspan="8">Silahkan cari histori barang</td>
<!--                                <td colspan="5">
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
                                <td colspan="5"style="text-align: right"><label> <small>Jumlah Barang </small> ( <?= $jbarang ?> )</label></td>-->
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
       
    </div>
</div>
<script>
    $(function () {
        $('#interval_tanggal').daterangepicker();
        $("#barang").focus();
        $('#barang').keyup(function () {
            if ($(this).val().length >= 0) {
                UI_barang();
            }
        });
        $('#baris').change(function () {
            search_barang();
        });
        $('#pilihtoko').change(function () {
            search_barang();
        });

    });

    function UI_barang() {
        $('#barang').autocomplete({
            minLength: 1, autoFocus: true,
            source: function (req, res) {
                $.ajax({
                    url: "<?php echo site_url('Admin_master/autobarang_pindahstock') ?>",
                    data: {cari: $('#barang').val(), daritoko: $('#pilihtoko').val()},
                    dataType: 'json',
                    type: "POST",
                    success: function (data) {
                        res(data);
                    }
                });
            },
            select: function (event, ui) {
                if (ui.item.sukses === true) {
                    $.ajax({
                        url: "<?php echo site_url('Admin_master/search_histori_barang') ?>",
                        data: {id: ui.item.id_barang},
                        dataType: 'json',
                        type: "POST",
                        success: function (data) {
                            $('.data_list_barang').html('' + data.list_barang + '');
//alert(data.sukses);
                        }
                    });
                        $('#barang').val(ui.item.nama_barang);
//                        $('#idb').val(ui.item.id_barang);
//                        $('#jumdaristock').val(ui.item.stock);
//                        $('#jumstockpindah').focus();
//                    alert(ui.item.id_barang);
                    return false;
                } else {
                    return false;
                }
            },
            create: function () {
                $(this).data('ui-autocomplete')._renderItem = function (ul, item) {
                    return $("<li></li>")
                            .data("item.autocomplete", item)
                            .append("<a class='nav-link active'><strong>" + item.nama_barang + "</strong> <br/><small>Sisa stock : " + item.stock + "</small></a>")
                            .appendTo(ul);
                };
            }
        });
    }
</script>