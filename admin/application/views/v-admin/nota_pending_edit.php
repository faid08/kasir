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
                            <input type="text" style="font-weight: bold" class="form-control form-control-sm form-control form-control-sm-sm bg-danger" name="nota" value="<?= $penjualan->notatransaksi_penjualan_customer ?>" readonly/>
                        </div>
                        <div class="form-check-inline">
                            <?php
                            if ($penjualan->jenis_harga_penjualan === "ecer") {
                                $disab = "disabled";
                                ?>
                                <div class="custom-control custom-radio col-md-6">
                                    <input class="custom-control-input" type="radio" id="ecer" name="ecer_grosir" value="ecer" checked>
                                    <label for="ecer" class="custom-control-label">Ecer</label>
                                </div>
                                <?php
                            } else {
                                $disab = "";
                                ?>
                                <div class = "custom-control custom-radio col-md-6">
                                    <input class = "custom-control-input" type = "radio" id = "grosir" name = "ecer_grosir" value = "grosir"checked >
                                    <label for = "grosir" class = "custom-control-label">Grosir</label>
                                </div>
                                <?php
                            }
                            ?>


                        </div>
                    </div>
                    <div class="col-md-3" >
                        <div class="form-line" style="margin-bottom:8px;">
                            <input type="text" class="form-control form-control-sm" placeholder="Nama Marketing" id="marketing" name="marketing"  value="<?= $penjualan->nama_marketing ?>" />
                            <input  type="hidden"name="id_marketing"id="id_marketing" value="<?= $penjualan->idmarketing ?>"/> 
                        </div>
                        <div class="form-line" style="margin-bottom:8px;">
                            <input type="text" class="form-control form-control-sm" placeholder="Nama Customer" id="customer" name="customer" value="<?= $penjualan->nama_customer ?>" <?= $disab ?>/>
                            <input  type="hidden"name="id_customer" id="id_customer"value="<?= $penjualan->idcustomer ?>" /> 
                        </div>
                    </div>
                    <div class="col-md-3" >
                        <div class="form-line">
                            <textarea rows="3" class="form-control form-control-sm no-resize" placeholder="Alamat Customer" name="alamat" id="alamat"  <?= $disab ?>><?= $penjualan->alamat_customer ?></textarea>
                        </div>
                    </div>
                    <?php
                    if ($penjualan->via_pengiriman == NULL || $penjualan->via_pengiriman == "" || $penjualan->via_pengiriman == "-") {
                        $hidden_tombol_prngiriman = 'nonaktif';
                        $ket = 'Non aktif';
                        $checked = "";
                        $disabled = "disabled";
                        $tgl = date('d/m/Y');
                    } else {
                        $hidden_tombol_prngiriman = 'aktif';
                        $ket = ' Aktif';
                        $checked = "checked";
                        $disabled = "";
                        $via = '<option value="' . $penjualan->via_pengiriman . '">' . $penjualan->via_pengiriman . '</option>';
                        $tgl = date('d/m/Y', strtotime($penjualan->tanggal_pengiriman));
                    }
                    ?>
                    <div class="col-md-2 text-center" >
                        <div class="form-line">                      
                            <small class="text-info">Detail Data Pengiriman</small>                        
                        </div>
                        <div class="form-line">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="tombol_prngiriman" <?= $checked ?> >
                                <label for="tombol_prngiriman" class="custom-control-label" id="keterangan_aktif"><?= $ket ?></label>
                            </div>
                        </div>
                        <input  type="hidden"name="hidden_tombol_prngiriman" value="<?= $hidden_tombol_prngiriman ?>" id="hidden_tombol_prngiriman"/>
                    </div>
                    <div class="col-md-2">  
                        <div class="form-line pengiriman" style="margin-bottom:7px;" >
                            <select type="text" class="form-control form-control-sm"  name="pengiriman" id="pengiriman" <?= $disabled ?>>
                                <?= $via ?>
                                <option value="Via Toko Ali">Via Toko Ali</option>
                                <option value="Via Pos">Via Pos</option>
                                <option value="Via JNE">Via JNE</option>
                                <option value="Via Indah">Via Indah</option>
                                <option value="Via Barokah">Via Barokah</option>
                                <option value="Via Expo">Via Expo</option>
                            </select>
                        </div>
                        <div class="form-line">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" <?= $disabled ?> class="form-control form-control-sm" data-inputmask-alias="datetime" name="tanggal_pengiriman" id="tanggal_pengiriman" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="<?= $tgl ?>">
                            </div>
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
                            <th > Jenis Harga</th>
                            <th style="width: 10%;">Qty</th>                        
                            <th style="width: 25%;">Total Item</th>
                            <th >Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($detail_penjualan as $value) {
                            $no = $nomor++
                            ?>
                            <tr id="<?= $no ?>">
                                <th scope="row"><?= $no ?></th>
                                <td ><input type="text" class="form-control form-control-sm barang" name="barang[]" id="brg<?= $no ?>" value="<?= $value->nama_barang ?>"></td>
                                <td><select class="form-control form-control-sm harga" name="harga[]" id="hrg<?= $no ?>"  >
                                        <option value="<?= $value->hargajual ?>"><?= number_format($value->hargajual, 0, ',', '.') ?></option>
                                    </select></td>
                                <td ><input type="number" class="form-control form-control-sm jumlah" name="jumlah[]" id="jml<?= $no ?>" value="<?= $value->jumlah ?>" ></td>                                             
                                <td><input type="text" class="form-control form-control-sm totalitem" name="totalitem" id="totalitem<?= $no ?>" value="<?= number_format(($value->hargajual * $value->jumlah), 0, ',', '.') ?>" readonly=""></td>
                                <td ><button type="button" class="btn btn-danger  btn_remove btn-sm" id="<?= $no ?>"><i class="fa fa-times"></i> </button></td>
                        <input type="hidden" name="idb[]" id="idb<?= $no ?>" value="<?= $value->idbarang ?>" >
                        <input type="hidden"  name="stock[]" id="stc<?= $no ?>"value="<?= $value->jumlah *$value->stock ?>" >
                        <input  type="hidden" name="beli[]" id="beli<?= $no ?>" value="<?= $value->hargabeli ?>">
                        </tr>

                        <?php
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card" style="margin-bottom:6px;">
            <div class="body" style="padding:15px 25px;margin-bottom:-10px;" id="data_penjualan_footer">
                <div class="row clearfix">
                    <div class="col-md-2" >
                        <div class="form-line" style="margin-bottom:8px;">
                            <input type="text" class="form-control form-control-sm" placeholder="Ongkir" <?= $disabled ?> name="ongkir"id="ongkir" value="<?= number_format($penjualan->ongkir, 0, ',', '.') ?>"/>
                        </div>
                        <div class="form-line" style="margin-bottom:8px;">
                            <input type="text" class="form-control form-control-sm" placeholder="Bayar" name="bayar" id="bayar" value="<?= number_format($penjualan->bayar, 0, ',', '.') ?> "/>
                        </div>

                    </div>
                    <div class="col-md-4" >
                        <div class="form-line">
                            <textarea rows="1"  style="font-size:40px;font-weight: bold"class="form-control form-control-sm no-resize text-danger"  id="total_belanja" readonly="" name="total_belanja" ><?= number_format(($penjualan->totalbayar +$penjualan->ongkir), 0, ',', '.') ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-2" >
                        Kembalian :
                        <div class="form-line" style="margin-bottom:8px;">
                            <input type="text" readonly style="color: green; font-weight: bold"class="form-control form-control-sm" placeholder="Sisa Kembalian" name="sisa" value="<?= number_format(($penjualan->bayar - ($penjualan->totalbayar +$penjualan->ongkir)), 0, ',', '.') ?>" id="sisa"/>
                        </div>
                    </div>
                    <div class="col-md-4 " >
                        Aksi :
                        <div class="form-line "style="margin-bottom:7px;">
                            <button type="button" class="btn btn-danger waves-effect btn-sm"onclick="aksi_pending()">Pending Transaksi</button>
                            <button type="button" class="btn btn-info waves-effect btn-sm" onclick="aksi_simpan()">Simpan Transaksi</button>
                            <input type="hidden" name="pendingYT"id="pendingYT" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    var baris_ke;
    var i = <?php echo count($detail_penjualan); ?>;
    $(function () {
        $('#tanggal_pengiriman').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'});
        $('#ecer').click(function () {
            $('#customer').attr('disabled', 'true');
            $('#alamat').attr('disabled', 'true');
            $('.barang').focus();
        });
        $('#grosir').click(function () {
            $('#customer').removeAttr('disabled');
            $('#alamat').removeAttr('disabled');
            $('#marketing').focus();
        });
        $('#tombol_prngiriman').click(function () {
            if ($('#hidden_tombol_prngiriman').val() === "nonaktif") {
                $('#pengiriman').removeAttr('disabled');
                $('#tanggal_pengiriman').removeAttr('disabled');
                $('#ongkir').removeAttr('disabled');
                $('#keterangan_aktif').html('Aktif');
                $('#hidden_tombol_prngiriman').val('aktif');
                $('#pengiriman').focus();
            } else {
                $('#pengiriman').attr('disabled', 'true');
                $('#tanggal_pengiriman').attr('disabled', 'true');
                $('#ongkir').attr('disabled', 'true');
                $('#hidden_tombol_prngiriman').val('nonaktif');
                $('#keterangan_aktif').html('Non aktif');
                $('.barang').focus();
            }
        });
        UI_marteketing();
        UI_customer();
        $('#data_penjualan').on('input', '.barang ', UI_barang);
        $('#data_penjualan').on('input ', '.jumlah ', z_totalitem);
        $('#data_penjualan').on('change', '.harga ', z_totalitem);
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
                                        <td><select class="form-control form-control-sm harga" name="harga[]" id="hrg' + i + '" ></select></td>\n\
                                        <td><input type="number" class="form-control form-control-sm jumlah" name="jumlah[]" id="jml' + i + '"></td>\n\
                                        <td><input type="text" class="form-control form-control-sm totalitem" name="totalitem" id="totalitem' + i + '" readonly=""></td>\n\
                                        <td ><button type="button" class="btn btn-danger  btn_remove btn-sm" id="' + i + '"><i class="fa fa-times"></i> </button></td>\n\
                                        <input type="hidden" name="idb[]" id="idb' + i + '" >\n\
                                        <input type="hidden" name="stock[]" id="stc' + i + '" >\n\
                                        <input  type="hidden" name="beli[]" id="beli' + i + '" >\n\
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
    });
    function UI_marteketing() {
        var options = {
            url: "<?php echo site_url('Admin_master/automarketing'); ?>",
            getValue: "nama",
            list: {
                match: {
                    enabled: true
                },
                onKeyEnterEvent: function () {
                    var value = $("#marketing").getSelectedItemData().id;
                    $("#id_marketing").val(value).trigger("change");
                    $('#customer').focus();
                },
                onClickEvent: function () {
                    var value = $("#marketing").getSelectedItemData().id;
                    $("#id_marketing").val(value).trigger("change");
                    $('#customer').focus();
                }
            }
        };
        $("#marketing").easyAutocomplete(options);
        $('#marketing').focus();
    }
    function UI_customer() {
        var options = {
            url: "<?php echo site_url('Admin_master/autocustomer'); ?>",
            getValue: "nama",
            list: {
                match: {
                    enabled: true
                },
                onKeyEnterEvent: function () {
                    var id_c = $("#customer").getSelectedItemData().idcustomer;
                    var alamat_c = $("#customer").getSelectedItemData().alamat;
                    $("#id_customer").val(id_c).trigger("change");
                    $("#alamat").val(alamat_c).trigger("change");
                    $('#brg1').focus();
                },
                onClickEvent: function () {
                    var id_c = $("#customer").getSelectedItemData().idcustomer;
                    var alamat_c = $("#customer").getSelectedItemData().alamat;
                    $("#id_customer").val(id_c).trigger("change");
                    $("#alamat").val(alamat_c).trigger("change");
                    $('#brg1').focus();
                }
            }
        };
        $("#customer").easyAutocomplete(options);
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
                if (ui.item.stock <= 0) {
                    alert_pesan('error', '<label>stock <span style="color:red"> HABIS</span>. Silahkan tambahkan stok terlebih dahulu</label>');
                    return false;
                } else {
                    if (ui.item.stock <= 5) {
                        alert_pesan('warning', '<label>Stock Menipis ! sisa stock : <span style="color:red">  ' + ui.item.stock + '</span>, Tambah Stock di Master Barang</label>');
                    }
                    if (ui.item.sukses === true) {
                        $('#brg' + id_nya + '').val(ui.item.nama_barang);
                        if ($('#grosir').is(':checked')) {
                            $('#hrg' + id_nya + '').html('<option value="' + ui.item.hgrosir1 + '">[g1] &nbsp;&nbsp;&nbsp; ' + rp(ui.item.hgrosir1) + '</option>\n\
                                                          <option value="' + ui.item.hgrosir2 + '">[g2] &nbsp;&nbsp;&nbsp; ' + rp(ui.item.hgrosir2) + '</option>\n\
                                                          <option value="' + ui.item.hgrosir3 + '">[g3] &nbsp;&nbsp;&nbsp; ' + rp(ui.item.hgrosir3) + '</option>');

                        } else {
                            $('#hrg' + id_nya + '').html('<option value="' + ui.item.hecer1 + '">[e1] &nbsp;&nbsp;&nbsp; ' + rp(ui.item.hecer1) + '</option>\n\
                                                          <option value="' + ui.item.hecer2 + '">[e2] &nbsp;&nbsp;&nbsp; ' + rp(ui.item.hecer2) + '</option>');
                        }
                        $('#idb' + id_nya + '').val(ui.item.id_barang);
                        $('#beli' + id_nya + '').val(ui.item.hargabeli);
                        $('#stc' + id_nya + '').val(ui.item.stock);
                        $('#jml' + id_nya + '').val('1');
                        $('#jml' + id_nya + '').focus();
                        // hitung total Item
                        var h = $('#hrg' + id_nya + '').val();
                        var j = $('#jml' + id_nya + '').val();
                        var totalitem = Math.round(h * j);
                        $('#totalitem' + id_nya + '').val(rp(totalitem));
                        z_totalpembelian();
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
    function z_totalitem() {
        var row_id = $(this).attr("id");
        var id_nya = row_id.slice(3, 5);
        var h = $('#hrg' + id_nya + '').val();
        var j = $('#jml' + id_nya + '').val();
        var totalitem = Math.round(h * j);
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
        var ongkir = $('#ongkir').val();
        var ongkir_ = ongkir.replace(/\D/g, '');
        ongkir_ = isNaN(ongkir_) || $.trim(ongkir_) === "" ? 0 : parseFloat(ongkir_);
        var bayar = $('#bayar').val();
        var bayar_ = bayar.replace(/\D/g, '');
        bayar_ = isNaN(bayar_) || $.trim(bayar_) === "" ? 0 : parseFloat(bayar_);
        var jum_total = parseInt(ongkir_) + parseInt(total);
        $('#total_belanja').val(rp(jum_total));
        var sisa = parseInt(bayar_) - parseInt(jum_total);
        $('#sisa').val(rp(sisa));
    }
    function aksi_simpan() {
        $('#pendingYT').val('t');
        update_nota_pending();
    }
    function aksi_pending() {
        $('#pendingYT').val('y');
        update_nota_pending();
    }
    function update_nota_pending() {
        $.ajax({
            url: '<?php echo site_url('Admin_pending/update_nota_pending') ?>',
            type: 'POST',
            data: $('#data_transaksi_penjualan').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    nota_pending();
                    alert(data.pesan);
                    if (data.jenispenjualan === "grosir") {
                        window.open("<?php echo site_url('Admin_penjualan/cG') ?>/" + data.nota);
                    } else {
                        window.open("<?php echo site_url('Admin_penjualan/cE') ?>/" + data.nota);
                    }
                } else {
                    alert_pesan('error', data.pesan);
                    if (data.eror === "barang") {
                        $('#brg1').focus();
                    } else if (data.eror === "marketing") {
                        $('#marketing').focus();
                    } else if (data.eror === "customer") {
                        $('#customer').focus();
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