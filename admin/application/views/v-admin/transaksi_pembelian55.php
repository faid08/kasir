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
    <form id="data_transaksi_penjualan">
        <div class="card" style="margin-bottom:6px;">
            <div class="body" style="padding:15px 25px;margin-bottom:-10px;" >
                <div class="row clearfix">
                    <div class="col-md-2" >
                        <div class="form-line" style="margin-bottom:20px;">
                            <input type="text" style="font-weight: bold" class="form-control form-control-sm form-control form-control-sm-sm bg-info" name="nota" value="<?= $nofaktur ?>" readonly/>
                        </div>

                    </div>
                    <div class="col-md-3" >
                        <div class="form-line" style="margin-bottom:8px;">
                            <input type="text" class="form-control form-control-sm" placeholder="Nama Suplayer" id="suplayer" name="suplayer"  />
                            <input  type="hidden"name="id_suplayer"id="id_suplayer" /> 
                        </div>
                        <div class="form-line" style="margin-bottom:8px;">
                            <input type="text" class="form-control form-control-sm" placeholder="Hp Suplayer" id="hp_suplayer" name="hp_suplayer" disabled/>                            
                        </div>
                    </div>
                    <div class="col-md-3" >
                        <div class="form-line">
                            <textarea rows="3" class="form-control form-control-sm no-resize" placeholder="Alamat Suplayer" name="alamat_suplayer" id="alamat_suplayer" disabled></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="margin-bottom:6px;">
            <div class="body" style="padding:15px 25px;height:330px;overflow:auto;">
                <table class="table table-sm table-hover" id="data_penjualan">
                    <thead class="small">
                        <tr class="text-center">
                            <th>NO</th>
                            <th style="width: 35%;">Nama Barang</th>
                            <th style="width: 10%;">Poduksi</th>
                            <th style="width: 20%;">Harga Beli</th>   
                            <th style="width: 10%;">Qty</th>                        
                            <th style="width: 25%;">Total Item</th>
                            <th >Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="1">
                            <th scope="row">1</th>
                            <td><input type="text" class="form-control form-control-sm  barang" name="barang[]" id="brg1" ></td>             
                    <input type="hidden" name="idb[]" id="idb1" >
                    <td><input type="number" class="form-control form-control-sm produksi" name="produksi[]" id="produksi1" ></td>
                    <td><input type="text" class="form-control form-control-sm hbeli" name="hbeli[]" id="hbl1" ></td>
                    <td><input type="number" class="form-control form-control-sm jumlah" name="jumlah[]" id="jml1" ></td>
                    <td><input type="text" class="form-control form-control-sm totalitem " name="totalitem[]" id="totalitem1" readonly=""></td>
                    <td ><button type="button" class="btn btn-danger form-control-sm waves-effect btn_remove" id="1">X</button></td>
                    </tr>                
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card" style="margin-bottom:6px;">
            <div class="body" style="padding:15px 25px;margin-bottom:-10px;" id="data_penjualan_footer">
                <div class="row clearfix">
                    <div class="col-md-3" >
                        <div class="form-line">
                            <textarea rows="3" readonly class="form-control form-control-sm no-resize text-danger"  id="total_produksi" name="total_produksi" >Total Produksi </textarea>
                        </div>
                    </div>
                    <div class="col-md-3" >
                        <div class="form-line">
                            <textarea rows="3" readonly class="form-control form-control-sm no-resize text-danger"  id="total_belanja" name="total_belanja" >Total Belanja </textarea>
                        </div>
                    </div>

                    <div class="col-md-2" >

                        <div class="form-line" style="margin-bottom:8px;">
                            <input type="text" class="form-control form-control-sm" placeholder="Bayar" name="bayar" id="bayar"  />
                        </div>
                        <div class="form-line" style="margin-bottom:8px;">
                            <input type="text" readonly style="color: green; font-weight: bold"class="form-control form-control-sm" placeholder="Sisa Kembalian" name="sisa" id="sisa"/>
                        </div>
                    </div>
                    <div class="col-md-4 " >
                        Aksi :
                        <div class="form-line "style="margin-bottom:7px;">
                            <button type="button" class="btn btn-info waves-effect btn-sm" onclick="simpan_kulakan()">Simpan Transaksi Pembelian</button>
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
        UI_suplayer();
        $('#data_penjualan').on('input', '.barang ', UI_barang);
        $('#data_penjualan').on('input', '.produksi', z_totalproduksi);
        $('#tabel_pembelian').on('keypress', '.produksi', function (e) {
            if (e.keyCode === 13) {
                var row_id_produksi = $(this).attr("id");
                var id_produksi = row_id_produksi.slice(8, 9);
                $('#hbl' + id_produksi + '').focus();
            }
        });
        $('#data_penjualan').on('input', '.jumlah ', z_totalitem);
        $('#data_penjualan').on('input', '.hbeli ', z_totalitem);
        $('#data_penjualan').on('input', '.hbeli ', function () {
            var n = parseInt($(this).val().replace(/[^,\d]/g, ''), 10);
            n = isNaN(n) || $.trim(n) === "" ? 0 : parseFloat(n);
            $(this).val(rp(n));
        });
        $('#data_penjualan').on('keypress', '.jumlah', function (e) {
            if (e.keyCode === 13) {
                var row_id = $(this).attr("id");
                var id_nya = row_id.slice(3, 5);
                stocknya = $('#stc' + id_nya + '').val();
                jmlnya = $('#jml' + id_nya + '').val();
                var stockawal = parseFloat(stocknya);
                var permintaanstock = parseFloat(jmlnya);
                if (permintaanstock >= stockawal) {
                    alert_pesan('error', 'Stock tidak cukup');
                } else {
                    i++;
                    $('#data_penjualan').append('<tr id="' + i + '"><th>' + i + '</th>\n\
                                        <td><input type="text" class="form-control form-control-sm barang" name="barang[]" id="brg' + i + '"></td>\n\
                                        <input type="hidden" name="idb[]" id="idb' + i + '" >\n\
                                        <td><input type="text" class="form-control form-control-sm produksi" name="produksi[]" id="produksi' + i + '" ></td>\n\
                                        <td><input type="text" class="form-control form-control-sm hbeli" name="hbeli[]" id="hbl' + i + '" ></td>\n\
                                        <td><input type="text" class="form-control form-control-sm jumlah" name="jumlah[]" id="jml' + i + '" >\n\
                                        <td><input type="text" class="form-control form-control-sm totalitem" name="totalitem" id="totalitem' + i + '" readonly=""></td>\n\
                                        <td ><button type="button" class="btn btn-danger form-control-sm waves-effect btn_remove" id="' + i + '">X</button></td>\n\
                                        </tr>');
                    $('#brg' + i + '').focus();
                }
            }
        });
        $('#data_penjualan').on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#' + button_id + '').remove();
            z_totalpembelian();
        });

        $('#data_penjualan_footer').on('input', '#ongkir , #bayar  ', function () {
            var n = parseInt($(this).val().replace(/[^,\d]/g, ''), 10);
            n = isNaN(n) || $.trim(n) === "" ? 0 : parseFloat(n);
            $(this).val(rp(n));
            z_totalpembelian();
        });
        $('#suplayer').focus();
    });
    function UI_suplayer() {
        var options = {
            url: "<?php echo site_url('Admin_master/autosuplayer'); ?>",
            getValue: "nama",
            list: {
                match: {
                    enabled: true
                },
                onKeyEnterEvent: function () {
                    var value = $("#suplayer").getSelectedItemData().idsuplayer;
                    var value_h = $("#suplayer").getSelectedItemData().hp_suplayer;
                    var value_a = $("#suplayer").getSelectedItemData().alamat_suplayer;
                    $("#id_suplayer").val(value).trigger("change");
                    $("#hp_suplayer").val(value_h).trigger("change");
                    $("#alamat_suplayer").val(value_a).trigger("change");
                    $('#brg1').focus();
                },
                onClickEvent: function () {
                    var value = $("#suplayer").getSelectedItemData().idsuplayer;
                    var value_h = $("#suplayer").getSelectedItemData().hp_suplayer;
                    var value_a = $("#suplayer").getSelectedItemData().alamat_suplayer;
                    $("#id_suplayer").val(value).trigger("change");
                    $("#hp_suplayer").val(value_h).trigger("change");
                    $("#alamat_suplayer").val(value_a).trigger("change");
                    $('#brg1').focus();
                }
            }
        };
        $("#suplayer").easyAutocomplete(options);
    }
    function UI_barang() {
        var row_id = $(this).attr("id");
        var id_nya = row_id.slice(3, 5);
        $('#brg' + id_nya + '').autocomplete({
            minLength: 1, autoFocus: true,
            source: function (req, res) {
                $.ajax({
                    url: "<?php echo site_url('Admin_master/autobarang') ?>",
                    data: {cari: $('#brg' + id_nya + '').val()}, dataType: 'json', type: "POST",
                    success: function (data) {
                        res(data);
                    }
                });
            },
            select: function (event, ui) {
                if (ui.item.sukses === true) {
                    $('#brg' + id_nya + '').val(ui.item.nama_barang);
                    $('#idb' + id_nya + '').val(ui.item.id_barang);
                    $('#produksi' + id_nya + '').val('1');
                    $('#produksi' + id_nya + '').focus();
                    $('#hbl' + id_nya + '').val(rp(ui.item.hargabeli));
                    $('#jml' + id_nya + '').val('1');

                    // hitung total Item
                    var h = $('#hbl' + id_nya + '').val();
                    var h_ = h.replace(/\D/g, '');
                    var hbl = isNaN(h_) || $.trim(h_) === "" ? 0 : parseFloat(h_);
                    var j = $('#jml' + id_nya + '').val();
                    var totalitem = Math.round(hbl * j);
                    $('#totalitem' + id_nya + '').val(rp(totalitem));
                    z_totalpembelian();
                    z_totalproduksi();
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
    function z_totalitem() {
        var row_id = $(this).attr("id");
        var id_nya = row_id.slice(3, 5);
        var h = $('#hbl' + id_nya + '').val();
        var h_ = h.replace(/\D/g, '');
        var hbl = isNaN(h_) || $.trim(h_) === "" ? 0 : parseFloat(h_);
        var j = $('#jml' + id_nya + '').val();
        var totalitem = Math.round(hbl * j);
        $('#totalitem' + id_nya + '').val(rp(totalitem));
        z_totalpembelian();
    }
    function z_totalpembelian() {
        var total = 0;
        $('.totalitem').each(function () {
            var rupiah = $(this).val();
            var val = rupiah.replace(/\D/g, '');
            val = isNaN(val) || $.trim(val) === "" ? 0 : parseFloat(val);
            total += val;
        });
        var bayar = $('#bayar').val();
        var bayar_ = bayar.replace(/\D/g, '');
        bayar_ = isNaN(bayar_) || $.trim(bayar_) === "" ? 0 : parseFloat(bayar_);
        var jum_total = parseInt(total);
        $('#total_belanja').val(rp(jum_total));
        $('#total_belanja').attr('rows', '1');
        $('#total_belanja').css("font-size", "40px");
        var sisa = parseInt(bayar_) - parseInt(jum_total);
        $('#sisa').val(rp(sisa));
    }
    function z_totalproduksi() {
        var total = 0;
        $('.produksi').each(function () {
            var rupiah = $(this).val();
            var val = rupiah.replace(/\D/g, '');
            val = isNaN(val) || $.trim(val) === "" ? 0 : parseFloat(val);
            total += val;
        });
        var jum_produksi = parseInt(total);
        $('#total_produksi').val(jum_produksi);
        $('#total_produksi').attr('rows', '1');
        $('#total_produksi').css("font-size", "40px");
    }
    function simpan_kulakan() {
        $.ajax({//parsing_simpan_transaksi_penjualan
            url: '<?php echo site_url('Cadmin_pembelian/simpan_pembelian') ?>',
            type: 'POST',
            data: $('#data_transaksi_penjualan').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    alert(data.pesan);
                    transaksi_pembelian();
                } else {
                    alert_pesan('error', data.pesan);
                    if (data.eror === "barang") {
                        $('#brg1').focus();
                    } else if (data.eror === "suplayer") {
                        $('#suplayer').focus();
                    } else if (data.eror === "bayar") {
                        $('#bayar').focus();
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(errorThrown);
            }
        });
    }

</script>