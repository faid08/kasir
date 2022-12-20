<style type="text/css">
    .ui-autocomplete {
        z-index:1100 !important;
        position: absolute;
    }
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo site_url() ?>vendor/plugins/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="<?php echo site_url() ?>vendor/plugins/jquery-ui/jquery-ui.js"></script>
<div class="container-fluid" >
    <form id="data_transaksi_pindah_stock">
        <div class="card" style="margin-bottom:6px;">
            <div class="body" style="padding:15px 25px;margin-bottom:-10px;" >
                <div class="row clearfix">
                    <div class="col-md-1" >
                        <label class=" col-form-label"> Dari Toko</label>
                    </div>
                    <div class="col-md-2" >
                        <select class="form-control form-control-sm" name="pilihtoko1" id="pilihtoko1">
                            <?php
                            foreach ($toko as $value) {
                                ?>
                                <option value="<?= $value->idtoko ?>"><?= $value->nama ?></option>
                                <?php
                            }
                            ?>

                        </select>
                    </div>
                    <div class="col-md-1">  

                    </div>
                    <div class="col-md-1" >
                        <label class="col-form-label"> Ke Toko</label>
                    </div>
                    <div class="col-md-2 text-center" >
                        <select class="form-control form-control-sm" name="pilihtoko2" id="pilihtoko2">
                            <option value="null">- Pilih Toko -</option>
                            <?php
                            foreach ($toko as $value) {
                                ?>
                                <option value="<?= $value->idtoko ?>"><?= $value->nama ?></option>
                                <?php
                            }
                            ?>

                        </select>
                    </div>

                </div>
            </div>
        </div>
        <div class="card" style="margin-bottom:6px;">
            <div class="body" style="padding:15px 25px;height:410px;overflow:auto;">
                <table class="table table-sm table-hover" id="data_pindah_stock">
                    <thead class="small">
                        <tr class="text-center">
                            <th style="width: 5%;">NO</th>
                            <th style="width: 40%;">Nama Barang</th>
                            <th style="width: 15%;"> Stock Tersedia</th>
                            <th style="width: 15%;">Stock akan dipindahkan</th> 
                            <th >Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="1" class="text-center">
                            <th scope="row">1</th>
                            <td ><input type="text" class="form-control form-control-sm barang" name="barang[]" id="brg1" ></td>
                            <td ><input type="number" class="form-control form-control-sm jumdaristock " name="jumdaristock[]" id="jumdaristock1" readonly=""></td>  
                            <td ><input type="number" class="form-control form-control-sm jumstockpindah " name="jumstockpindah[]" id="jumstockpindah1" ></td> 
                            <td ><button type="button" class="btn btn-danger  btn_remove btn-sm" id="1"><i class="fa fa-times"></i> </button></td>
                    <input type="hidden" name="idb[]" id="idb1" >
                    </tr>                
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card" style="margin-bottom:6px;">
            <div class="body" style="padding:15px 25px;margin-bottom:-10px;" id="data_pindah_stock_footer">
                <div class="row clearfix">                    
                    <div class="col-md-4 " >
                        <div class="form-line "style="margin-bottom:7px;">                          
                            <button type="button" class="btn btn-info waves-effect btn-sm" onclick="simpan_pindah_stock()">Simpan Perpindahan Stoc Barang</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    var baris_ke;
    var i = 1;
    $(function () {
        $('#data_pindah_stock').on('input', '.barang', UI_barang_pindah);
        $('#data_pindah_stock').on('input ', '.jumstockpindah', z_totalitem);
        $('#data_pindah_stock').on('keypress', '.jumstockpindah', function (e) {
            if (e.keyCode === 13) {
                var row_id = $(this).attr("id");
                var id_nya = row_id.slice(14, 16);
                stock_tersedia = $('#jumdaristock' + id_nya + '').val();
                stockpindah = $('#jumstockpindah' + id_nya + '').val();
                var stock_tersedia1 = parseFloat(stock_tersedia);
                var stockpindah1 = parseFloat(stockpindah);
                if (stockpindah1 > stock_tersedia1) {
                    alert_pesan('error', '&nbsp; &nbsp;Stock tidak cukup');
                } else {
                    i++;
                    $('#data_pindah_stock').append('<tr class="text-center" id="' + i + '"><th>' + i + '</th>\n\
                                        <td class="text-center" ><input type="text" class="form-control form-control-sm barang" name="barang[]" id="brg' + i + '"></td>\n\
                                        <td class="text-center" ><input type="number" class="form-control form-control-sm jumdaristock " name="jumdaristock[]" id="jumdaristock' + i + '" readonly=""></td> \n\
                                        <td class="text-center" ><input type="number" class="form-control form-control-sm jumstockpindah " name="jumstockpindah[]" id="jumstockpindah' + i + '" ></td>\n\
                                        <td ><button type="button" class="btn btn-danger  btn_remove btn-sm" id="' + i + '"><i class="fa fa-times"></i> </button></td>\n\
                                        <input type="hidden" name="idb[]" id="idb' + i + '" >\n\
                                        </tr>');
                    $('#brg' + i + '').focus();
                }
            }
        });
        $('#data_pindah_stock').on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#' + button_id + '').remove();
        });

    });
    function z_totalitem() {
       var row_id = $(this).attr("id");
                var id_nya = row_id.slice(14, 16);
                stock_tersedia = $('#jumdaristock' + id_nya + '').val();
                stockpindah = $('#jumstockpindah' + id_nya + '').val();
                var stock_tersedia1 = parseFloat(stock_tersedia);
                var stockpindah1 = parseFloat(stockpindah);
                if (stockpindah1 > stock_tersedia1) {
                     $('#jumstockpindah' + id_nya + '').val(stock_tersedia1);
                     alert_pesan('error', '&nbsp; &nbsp;Stock tidak cukup');
                } else {
                }
        
    }
    function UI_barang_pindah() {
        var row_id = $(this).attr("id");
        var id_nya = row_id.slice(3, 5);
        $('#brg' + id_nya + '').autocomplete({
            minLength: 1, autoFocus: true,
            source: function (req, res) {
                $.ajax({
                    url: "<?php echo site_url('Admin_master/autobarang_pindahstock') ?>", 
                    data: {cari: $('#brg' + id_nya + '').val(), daritoko: $('#pilihtoko1').val()}, dataType: 'json', type: "POST",
                    success: function (data) {
                        res(data);
                    }
                });
            },
            select: function (event, ui) {
                if (ui.item.stock <= 0) {
                    alert_pesan('error', '<label>stock <span style="color:red"> HABIS</span>. Silahkan tambahkan stok terlebih dahulu</label>');
                    return false;
                } else {
                    if (ui.item.stock <= 5) {
                        alert_pesan('warning', '<label>Stock Menipis ! sisa stock : <span style="color:red">  ' + ui.item.stock + '</span>, Tambah Stock di Master Barang</label>');
                    }
                    if (ui.item.sukses === true) {
                        $('#brg' + id_nya + '').val(ui.item.nama_barang);
                        $('#idb' + id_nya + '').val(ui.item.id_barang);
                        $('#jumdaristock' + id_nya + '').val(ui.item.stock);
                        $('#jumstockpindah' + id_nya + '').focus();
                        return false;
                    } else {
                        return false;
                    }
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
    function simpan_pindah_stock() {
        if ($('#pilihtoko2').val() === "null") {
            alert_pesan('error', 'Silahkan pilih toko tujuan');
        } else if ($('#pilihtoko1').val() === $('#pilihtoko2').val()) {
            alert_pesan('warning', 'Toko asal dan toko tujuan tidak boleh sama');
        } else {
            $.ajax({
                url: '<?php echo site_url('Admin_stock/aksi_simpan_stock') ?>',
                type: 'POST',
                data: $('#data_transaksi_pindah_stock').serialize(),
                dataType: "JSON",
                success: function (data) {
                    if (data.status) {
                        alert(data.pesan);
                        pindah_stock();
                    } else {
                        alert_pesan('error', data.pesan);
                    }
                }
            });
        }
    }

</script>