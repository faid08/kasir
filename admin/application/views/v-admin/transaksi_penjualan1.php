<div class="container-fluid">
    <div class="card" style="margin-bottom:6px;">
        <div class="body" style="padding:15px 25px;margin-bottom:-10px;">
            <div class="row clearfix">
                <div class="col-md-2" >
                    <div class="form-line" style="margin-bottom:20px;">
                        <input type="text" class="form-control form-control-sm form-control form-control-sm-sm bg-info" name="nota" value="<?= $nofaktur ?>" readonly/>
                    </div>
                    <div class="form-check-inline">                                    
                        <input type="radio" class="form-check-input" id="ecer" name="ecer_grosir" value="ecer" checked>
                        <label class="form-check-label" for="ecer"style="width: 50px;">Ecer</label>
                        <input type="radio" class="form-check-input" id="grosir" name="ecer_grosir" value="grosir">
                        <label class="form-check-label" for="grosir"style="width: 50px;">Grosir</label>
                    </div>
                </div>
                <div class="col-md-3" >
                    <div class="form-line" style="margin-bottom:8px;">
                        <input type="text" class="form-control form-control-sm" placeholder="Nama Marketing" id="marketing" name="marketing" disabled />
                        <input  type="hidden"name="id_marketing"id="id_marketing" /> 
                    </div>
                    <div class="form-line" style="margin-bottom:8px;">
                        <input type="text" class="form-control form-control-sm" placeholder="Nama Customer" id="customer" name="customer" disabled/>
                        <input  type="hidden"name="id_customer" id="id_customer" /> 
                    </div>
                </div>
                <div class="col-md-3" >
                    <div class="form-line">
                        <textarea rows="3" class="form-control form-control-sm no-resize" placeholder="Alamat Customer" name="alamat" id="alamat" disabled></textarea>
                    </div>
                </div>
                <div class="col-md-2 text-center" >
                    <div class="form-line">                      
                        <small class="text-info">Detail Data Pengiriman</small>                        
                    </div>
                    <div class="form-line">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="tombol_prngiriman"  >
                            <label for="tombol_prngiriman" class="custom-control-label" id="keterangan_aktif">Non aktif</label>
                        </div>
                    </div>
                    <input  type="hidden"name="hidden_tombol_prngiriman" value="nonaktif" id="hidden_tombol_prngiriman"/>
                </div>
                <div class="col-md-2">  
                    <div class="form-line pengiriman" style="margin-bottom:7px;" >
                        <select type="text" class="form-control form-control-sm"  name="pengiriman" id="pengiriman" disabled>
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
                            <input type="text" disabled class="form-control form-control-sm" data-inputmask-alias="datetime" name="tanggal_pengiriman" id="tanggal_pengiriman" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="<?php echo date('d/m/Y'); ?>">
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
                        <th >Harga Grosir</th>
                        <th style="width: 10%;">Qty</th>                        
                        <th style="width: 25%;">Total Item</th>
                        <th >Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    <!--<input type="hidden" name="idb[]" id="idb1" >-->
                    <tr id="1">
                        <th scope="row">1</th>
                        <td ><input type="text" class="form-control form-control-sm barang" name="barang[]" id="brg1" ></td>
                        <td><select class="form-control form-control-sm harga" name="harga[]" id="hrg1" ></select></td>
                        <td ><input type="text" class="form-control form-control-sm jumlah" name="jumlah[]" id="jml1" ></td>                                             
                        <td><input type="text" class="form-control form-control-sm totalitem" name="totalitem" id="totalitem1" readonly=""></td>
                        <td ><button type="button" class="btn btn-danger waves-effect btn_remove btn-sm" id="1"><i class="fa fa-times"></i> </button></td>
                <input type="hidden" name="idb[]" id="idb1" >
                <input type="hidden"  name="stock[]" id="stc1" >
                <input  type="hidden" name="beli[]" id="beli1" >
                <input  type="hidden" name="produksi[]" id="produksi1" >
                </tr>
                <tr id="2">
                    <th scope="row">2</th>
                    <td ><input type="text" class="form-control form-control-sm barang" name="barang[]" id="brg2" ></td>
                    <td><select class="form-control form-control-sm harga" name="harga[]" id="hrg2" ></select></td>
                    <td ><input type="text" class="form-control form-control-sm jumlah" name="jumlah[]" id="jml2" ></td>                                             
                    <td><input type="text" class="form-control form-control-sm totalitem" name="totalitem" id="totalitem2" readonly=""></td>
                    <td ><button type="button" class="btn btn-danger waves-effect btn_remove btn-sm" id="2"><i class="fa fa-times"></i> </button></td>
                <input type="hidden" name="idb[]" id="idb2" >
                <input type="hidden"  name="stock[]" id="stc2" >
                <input  type="hidden" name="beli[]" id="beli2" >
                <input  type="hidden" name="produksi[]" id="produksi2" >
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card" style="margin-bottom:6px;">
        <div class="body" style="padding:15px 25px;margin-bottom:-10px;">
            <div class="row clearfix">
                <div class="col-md-2" >
                    <div class="form-line" style="margin-bottom:8px;">
                        <input type="text" class="form-control form-control-sm" placeholder="Ongkir" disabled id="ongkir" />
                    </div>
                    <div class="form-line" style="margin-bottom:8px;">
                        <input type="text" class="form-control form-control-sm" placeholder="Bayar"  />
                    </div>

                </div>
                <div class="col-md-2" >
                    <div class="form-line" style="margin-bottom:8px;">
                        <input type="text" class="form-control form-control-sm" placeholder="Sisa Kembalian" />
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="form-line">
                        <textarea rows="1"  style="font-size:40px;"class="form-control form-control-sm no-resize text-danger"  id="total_belanja" name="total_belanja"></textarea>
                    </div>
                </div>
                <div class="col-md-4 text-center" >
                    <div class="form-line "style="margin-bottom:7px;">
                        <button type="button" class="btn btn-danger waves-effect btn-sm"onclick="aksi_pending()">Pending Transaksi</button>
                        <button type="button" class="btn btn-info waves-effect btn-sm" onclick="aksi_simpan()">Simpan Transaksi</button>
                    </div>
                    <div class="form-line small">
                        <label >F2 = On/Off Ecer Grosir &nbsp;&nbsp;F4 = On/Off Pengiriman</label>                            
                        <label >F7 = Fokus Ongkir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F9 = Fokus Bayar</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var baris_ke;
    $(function () {
        $('#tanggal_pengiriman').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'});
        $('#ecer').click(function () {
            $('#marketing').attr('disabled', 'true');
            $('#customer').attr('disabled', 'true');
            $('#alamat').attr('disabled', 'true');
            $('.barang').focus();
        });
        $('#grosir').click(function () {
            $('#marketing').removeAttr('disabled');
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
        $('#data_penjualan').on('input', '.barang', function () {
            var row_id = $(this).attr("id");
            baris_ke = row_id.slice(3, 5);
        });
        UI_barang();
        $('#data_penjualan').on('input ', '.jumlah ', z_totalitem);
        $('#data_penjualan').on('change', '.harga ', z_totalitem);
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
                }
            }
        };
        $("#marketing").easyAutocomplete(options);
        
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
                }
            }
        };
        $("#customer").easyAutocomplete(options);
    }
    function UI_barang() {
        var options = {
            url: "<?php echo site_url('Admin_master/autobarang'); ?>",
            getValue: "nama_barang",
            list: {
                match: {
                    enabled: true
                },
                onKeyEnterEvent: function () {
                    var id_barang = $("#brg" + baris_ke + "").getSelectedItemData().id_barang;
                    var stock = $("#brg" + baris_ke + "").getSelectedItemData().stock;
                    var hbeli = $("#brg" + baris_ke + "").getSelectedItemData().hargabeli;
                    var produksi = $("#brg" + baris_ke + "").getSelectedItemData().produksi;
                    $("#idb" + baris_ke + "").val(id_barang).trigger("change");
                    $("#stc" + baris_ke + "").val(stock).trigger("change");
                    $("#beli" + baris_ke + "").val(hbeli).trigger("change");
                    $("#produksi" + baris_ke + "").val(produksi).trigger("change");
                    var hg1 = $("#brg" + baris_ke + "").getSelectedItemData().hgrosir1;
                    var hg2 = $("#brg" + baris_ke + "").getSelectedItemData().hgrosir2;
                    var hg3 = $("#brg" + baris_ke + "").getSelectedItemData().hgrosir3;
                    var he1 = $("#brg" + baris_ke + "").getSelectedItemData().hecer1;
                    var he2 = $("#brg" + baris_ke + "").getSelectedItemData().hecer2;
                    if ($('#grosir').is(':checked')) {
                        $("#hrg" + baris_ke + "").html("<option value='" + hg1 + "'> [g1]&nbsp;&nbsp;&nbsp;" + rp(hg1) + "</option>\n\
                                                        <option value='" + hg2 + "'> [g2]&nbsp;&nbsp;&nbsp;" + rp(hg2) + "</option>\n\
                                                        <option value='" + hg3 + "'> [g3]&nbsp;&nbsp;&nbsp;" + rp(hg3) + "</option>").trigger("change");
                    } else {
                        $("#hrg" + baris_ke + "").html("<option value='" + he1 + "'> [e1]&nbsp;&nbsp;&nbsp;" + rp(he1) + "</option>\n\
                                                        <option value='" + he2 + "'> [e2]&nbsp;&nbsp;&nbsp;" + rp(he2) + "</option>").trigger("change");
                    }
                    $("#jml" + baris_ke + "").val('1');
                    $("#jml" + baris_ke + "").focus();
                    var hargajual = $("#hrg" + baris_ke + "").val();
                    var qty = $("#jml" + baris_ke + "").val();
                    $("#totalitem" + baris_ke + "").val(rp(hargajual * qty));
                    z_totalpembelian();
                }
            }
        };
        $(".barang").easyAutocomplete(options);
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
        $('#total_belanja').val(rp(total));
    }

</script>