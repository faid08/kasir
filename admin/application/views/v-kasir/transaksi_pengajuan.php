<form id="data_transaksi_penjualan">
    <div class="content-header">                    
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header bg-dark p-1">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Informasi Nota
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="nota" class="col-sm-3 col-form-label">Nota</label>
                                <div class="col-sm-9">                                    
                                    <input type="text" class="form-control form-control-sm text-bold" name="nota" value="<?= $nofaktur ?>" readonly>
                                </div>
                            </div>                                        
                            <div class="input-group mb-0">
                                <div class="input-group-prepend input-group-sm col-sm-3 ">                                                
                                </div>
                                <div class="form-check-inline">
                                    <div class="custom-control custom-radio col-md-6">
                                        &nbsp;&nbsp;<input class="custom-control-input " type="radio" id="ecer" name="ecer_grosir" value="ecer" checked>
                                        <label for="ecer" class="custom-control-label">Ecer</label>
                                    </div>
                                    <div class="custom-control custom-radio col-md-6">
                                        <input class="custom-control-input" type="radio" id="grosir" name="ecer_grosir" value="grosir">
                                        <label for="grosir" class="custom-control-label">Grosir</label>
                                    </div>
                                </div>
                            </div>                                        
                        </div>
                    </div>
                    <div class="card card-dark card-outline">
                        <div class="card-body">
                            <div class="form-group row">
                                 <!--<span class="col-sm-4 col-form-label">Marketing</span>-->
                                <label for="marketing" class="col-sm-2 col-form-label"><i class="fas fa-user"></i></label>
                                <!--<span class="input-group-text form-control-sm"></i></span>-->
                                <div class="col-sm-10">                                    
                                    <input type="text" class="form-control form-control-sm" placeholder="Marketing" id="marketing" name="marketing"  />
                                    <input  type="hidden"name="id_marketing"id="id_marketing" /> 
                                </div>
                            </div>                                                                                  
                            <div class="form-group row">
                                <label for="customer" class="col-sm-2 col-form-label"><i class="fas fa-users"></i></label>
                                <div class="col-sm-10">                                    
                                    <input type="text" class="form-control form-control-sm" placeholder="Customer" id="customer" name="customer" disabled/>
                                    <input  type="hidden"name="id_customer" id="id_customer" /> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customer" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">                                    
                                    <textarea rows="2" class="form-control form-control-sm no-resize" placeholder="Alamat Customer" name="alamat" id="alamat" disabled></textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="customer" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">                                    
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="tombol_prngiriman"  >
                                        <label for="tombol_prngiriman" class="custom-control-label" id="keterangan_aktif">Pengiriman <span class="text-danger">Non aktif</span></label>
                                        <input  type="hidden"name="hidden_tombol_prngiriman" value="nonaktif" id="hidden_tombol_prngiriman"/>
                                    </div>
                                </div>
                            </div>                                          
                        </div>
                    </div>
                    <div class="card card-dark card-outline">
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <select type="text" class="form-control form-control-sm"  name="pengiriman" id="pengiriman" disabled>
                                    <option value="Via Toko Ali">Via Toko Ali</option>
                                    <option value="Via Pos">Via Pos</option>
                                    <option value="Via JNE">Via JNE</option>
                                    <option value="Via Indah">Via Indah</option>
                                    <option value="Via Barokah">Via Barokah</option>
                                    <option value="Via Expo">Via Expo</option>
                                </select>
                            </div>
                            <div class="input-group mb-1">
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
                <div class="col-lg-9">
                    <div class="card card-dark card-outline" style="margin-bottom:6px;">
                        <div class="body" style="padding:15px 25px;height:432px;overflow:auto;">
                            <table class="table table-sm table-hover" id="data_penjualan">
                                <thead >
                                    <tr class="text-center">
                                        <th>NO</th>
                                        <th >Nama Barang</th>
                                        <th >Qty</th>                        
                                        <th >Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="1">
                                        <th scope="row">1</th>
                                        <td ><input type="text" class="form-control form-control-sm barang" name="barang[]" id="brg1" ></td>
                                        <input type="hidden" class="form-control form-control-sm harga" name="harga[]" id="hrg1" ></input>
                                        <td ><input type="number" class="form-control form-control-sm jumlah" name="jumlah[]" id="jml1" ></td>                                             
                                        <input type="hidden" class="form-control form-control-sm totalitem" name="totalitem" id="totalitem1" readonly="">
                                        <td ><button type="button" class="btn btn-danger  btn_remove btn-sm" id="1"><i class="fa fa-times"></i> </button></td>
                                <input type="hidden" name="idb[]" id="idb1" >
                                <input type="hidden"  name="stock[]" id="stc1" >
                                <input  type="hidden" name="beli[]" id="beli1" >
                                <input  type="hidden" name="produksi[]" id="produksi1" >
                                </tr>                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card" style="margin-bottom:6px;">
                        <div class="body" style="padding:15px 25px;margin-bottom:-10px;" id="data_penjualan_footer">
                            <div class="row clearfix">
                                	    <!-- <textarea rows="1" readonly style="font-size:40px;font-weight: bold"class="form-control form-control-sm no-resize text-danger"  id="total_belanja" name="total_belanja" > </textarea> -->
										<input type="hidden" class="form-control form-control-sm" placeholder="" disabled name="total_belanja"id="total_belanja" />
                                        <input type="hidden" class="form-control form-control-sm" placeholder="Ongkir" disabled name="ongkir"id="ongkir" />
                                        <input type="hidden" class="form-control form-control-sm" placeholder="(shift) Bayar" name="bayar" id="bayar"  />
										<input type="hidden" readonly style="color: green; font-weight: bold"class="form-control form-control-sm" placeholder="Sisa Kembalian" name="sisa" id="sisa"/>
                                

                                <div class="col-md-4 " >
                                    Aksi:
                                    <div class="form-line "style="margin-bottom:7px;">
                                        <!-- <button type="button" class="btn btn-danger waves-effect btn-sm"onclick="aksi_pending()">Pending Transaksi</button> -->
                                        <button type="button" class="btn btn-info waves-effect btn-sm" onclick="aksi_simpan()">Kirim Pengajuan Stock</button>
                                        <input type="hidden" name="pendingYT"id="pendingYT" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    var baris_ke;
    var i = 1;
    $(function () {
        $('#data_transaksi_penjualan').on('keydown', function (e) {
            if (e.keyCode === 16) {
                $('#bayar').focus();
            }
        });
        $('#marketing').focus();
//        alert('cs');
        $('#tanggal_pengiriman').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'});
        $('#ecer').click(function () {
            $('#customer').attr('disabled', 'true');
            $('#alamat').attr('disabled', 'true');
            $('#marketing').focus();
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
                $('#keterangan_aktif').html('Pengiriman <span class="text-blue">Aktif</span>');
                $('#hidden_tombol_prngiriman').val('aktif');
                $('#pengiriman').focus();
            } else {
                $('#pengiriman').attr('disabled', 'true');
                $('#tanggal_pengiriman').attr('disabled', 'true');
                $('#ongkir').attr('disabled', 'true');
                $('#hidden_tombol_prngiriman').val('nonaktif');
                $('#keterangan_aktif').html('Pengiriman <span class="text-danger">Non aktif</span>');
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
                    i++;
                    $('#data_penjualan').append('<tr id="' + i + '"><th>' + i + '</th>\n\
                                       <td><input type="text" class="form-control form-control-sm barang" name="barang[]" id="brg' + i + '"></td>\n\
                                       <input type="hidden" class="form-control form-control-sm harga" name="harga[]" id="hrg' + i + '" >\n\
                                       <td><input type="number" class="form-control form-control-sm jumlah" name="jumlah[]" id="jml' + i + '"></td>\n\
                                       <input type="hidden" class="form-control form-control-sm totalitem" name="totalitem" id="totalitem' + i + '" readonly="">\n\
                                       <td ><button type="button" class="btn btn-danger  btn_remove btn-sm" id="' + i + '"><i class="fa fa-times"></i> </button></td>\n\
                                       <input type="hidden" name="idb[]" id="idb' + i + '" >\n\
                                       <input type="hidden" name="stock[]" id="stc' + i + '" >\n\
                                       <input  type="hidden" name="beli[]" id="beli' + i + '" >\n\
                                       <input  type="hidden" name="produksi[]" id="produksi' + i + '" >\n\
                                       </tr>');
                    $('#brg' + i + '').focus();
                
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
                    if ($('#ecer').is(':checked')) {
                        $('#brg1').focus();
                    } else {
                        $('#customer').focus();
                    }
                },
                onClickEvent: function () {
                    var value = $("#marketing").getSelectedItemData().id;
                    $("#id_marketing").val(value).trigger("change");
                    if ($('#ecer').is(':checked')) {
                        $('#brg1').focus();
                    } else {
                        $('#customer').focus();
                    }
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
                
                    
                    if (ui.item.sukses === true) {
                        $('#brg' + id_nya + '').val(ui.item.nama_barang);
						$('#hrg' + id_nya + '').val(ui.item.hargabeli);
                        // if ($('#grosir').is(':checked')) {
                        //     $('#hrg' + id_nya + '').html('<option value="' + ui.item.hgrosir1 + '">[g1] &nbsp;&nbsp;&nbsp; ' + rp(ui.item.hgrosir1) + '</option>\n\
                        //                                  <option value="' + ui.item.hgrosir2 + '">[g2] &nbsp;&nbsp;&nbsp; ' + rp(ui.item.hgrosir2) + '</option>\n\
                        //                                  <option value="' + ui.item.hgrosir3 + '">[g3] &nbsp;&nbsp;&nbsp; ' + rp(ui.item.hgrosir3) + '</option>\n\
                        //                                   <option value="' + ui.item.hpromo + '" ' + ui.item.hiddenhargapromo + '>[hp] &nbsp;&nbsp;&nbsp; ' + rp(ui.item.hpromo) + '</option>');

                        // } else {
                        //     $('#hrg' + id_nya + '').html('<option value="' + ui.item.hecer1 + '">[e1] &nbsp;&nbsp;&nbsp; ' + rp(ui.item.hecer1) + '</option>\n\
                        //                                  <option value="' + ui.item.hecer2 + '">[e2] &nbsp;&nbsp;&nbsp; ' + rp(ui.item.hecer2) + '</option>');
                        // }
                        $('#idb' + id_nya + '').val(ui.item.id_barang);
                        $('#beli' + id_nya + '').val(ui.item.hargabeli);
                        $('#stc' + id_nya + '').val(ui.item.stock);
                        $('#produksi' + id_nya + '').val(ui.item.produksi);
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
        // var row_id = $(this).attr("id");
        // var id_nya = row_id.slice(3, 5);
        // var h = $('#hrg' + id_nya + '').val();
        // var j = $('#jml' + id_nya + '').val();
        // var totalitem = Math.round(h * j);
        // $('#totalitem' + id_nya + '').val(rp(totalitem));
        // z_totalpembelian();


        var row_id = $(this).attr("id");
        var id_nya = row_id.slice(3, 5);

        stocknya = $('#stc' + id_nya + '').val();
        jmlnya = $('#jml' + id_nya + '').val();
        var stockawal = parseFloat(stocknya);
        var permintaanstock = parseFloat(jmlnya);
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
        simpan_penjualan();
    }
    function aksi_pending() {
        $('#pendingYT').val('y');
        simpan_penjualan();
    }
    function simpan_penjualan() {
        $.ajax({//parsing_simpan_transaksi_penjualan 
            url: '<?php echo site_url('Admin_penjualan/aksi_simpan_pengajuan') ?>',
            type: 'POST',
            data: $('#data_transaksi_penjualan').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    kasir_transaksi_penjualan();
                    alert(data.pesan);
                    
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
