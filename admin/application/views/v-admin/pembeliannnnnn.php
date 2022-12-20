<link rel="stylesheet" type="text/css" href="<?php echo site_url() ?>vendor/jquery-ui/jquery-ui.css">
<script src="<?php echo site_url() ?>vendor/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo site_url() ?>vendor/jquery-ui/jquery-ui.js"></script>
<form id="data_pembelian">
    <div class="container-fluid">
        <div class="card" style="margin-bottom:6px;">
            <div class="body" style="padding:15px 25px;" id="tabelsuplayer">
                <div class="row clearfix">
                    <div class="col-md-3" style="margin-bottom:7px;">
                        <div class="form-line" style="margin-bottom:20px;">
                            <input style="background-color: #cccccc"readonly=""type="text" class="form-control form-control-sm" value="<?= $nofaktur ?>" name="nofaktur"id="nofaktur"/>
                            <input  type="hidden"name="idsuplayer"id="idsuplayer"id="idsuplayer" />
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom:7px;">
                        <div class="form-line" style="margin-bottom:8px;">
                            <input type="text" class="form-control" placeholder="Nama Suplayer" name="nama_suplayer" id="nama_suplayer" />
                        </div>
                        <div class="form-line" style="margin-bottom:8px;">
                            <input type="text" class="form-control"readonly="" placeholder="No. HP suplayer" name="hp_suplayer" id="hp_suplayer"/>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-bottom:7px;">
                        <div class="form-line">
                            <textarea rows="3" class="form-control no-resize" readonly="" placeholder="Alamat Suplayer" name="alamat_suplayer" id="alamat_suplayer"></textarea>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="card" style="margin-bottom:6px;">
            <div class="body" style="padding:15px 25px;height:309px;overflow:auto;">
                <table class="table table-bordered" id="tabel_pembelian">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Barang</th>                        
                            <th style="width: 10%;">Produksi</th>
                            <th>Harga Beli</th>
                            <th style="width: 10%;">Qty</th>
                            <th>Total per Item</th>
                            <th style="width: 10%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="1">
                            <th scope="row">1</th>
                            <td><input type="text" class="form-control barang" name="barang[]" id="brg1" ></td>                        
                            <td><input type="number" class="form-control produksi" name="produksi[]" id="produksi1" ></td>
                            <td><input type="text" class="form-control hbeli" name="hbeli[]" id="hbl1" ></td>
                            <td><input type="number" class="form-control jumlah" name="jumlah[]" id="jml1" ></td>
                            <td><input type="text" class="form-control totalitem " name="totalitem[]" id="totalitem1" readonly=""></td>
                            <td ><button type="button" class="btn btn-danger waves-effect btn_remove" id="1">X</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card" style="margin-bottom:6px;">
            <div class="body" style="padding:15px 25px;" id="tabel_tot">
                <div class="row clearfix">
                    <div class="col-md-3" style="margin-bottom:7px;">
                        <button type="button" class="btn btn-info waves-effect" onclick="simpan_pembelian()"id="tombol_simpan_pembelian">Simpan Kulakan</button>
                        <div class='row'>
                            <br/>
                            <div class='col-sm-6'>F8 = Aksi Simpan</div> 
                            <div class='col-sm-6'>F9 = Fokus Bayar</div>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom:7px;text-align:right;">
                        <label style="font-size:15px;"><b>TOTAL PRODUKSI</b></label>
                        <div  style="margin-bottom:10px;">
                            <div class="form-line">
                                <input style="background-color: #cccccc; text-align:right;font-size:35px; color: red; height: 65px"  type="text" class="form-control"name="tot_produksi" id="tot_produksi" readonly  />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom:7px;text-align:right;">
                        <label style="font-size:15px;"><b>TOTAL PEMBAYARAN</b></label>
                        <div  style="margin-bottom:10px;">
                            <div class="form-line">
                                <input style="background-color: #cccccc; text-align:right;font-size:35px; color: red; height: 65px"  type="text" class="form-control"name="tot_pembayaran" id="tot_pembayaran" readonly  />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom:7px;">
                        <table>
                            <tr>
                                <td colspan="3"><br/></td>
                            </tr>
                            <tr>
                                <td>&nbsp;BAYAR&nbsp;</td>
                                <td>:</td>
                                <td style="padding-left:5px;padding-bottom:3px;">
                                    <div class="form-line">
                                        <input type="text" class="form-control bayar" name="bayar" id="bayar" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;KEMBALIAN&nbsp;</td>
                                <td>:</td>
                                <td style="padding-left:5px;">
                                    <div class="form-line">
                                        <input type="text" class="form-control kembalian"style="background-color: #cccccc;" name="kembalian" id="kembalian"/>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    var i = 1;
    $(document).on('keydown', 'body', function (e) {
        var charCode = (e.which) ? e.which : event.keyCode;
        if (charCode === 120) {
            $('#bayar').focus();
        }
        ;
        if (charCode === 119) {
            $('#tombol_simpan_pembelian').focus();
            simpan_pembelian();
        }
        ;
    });
    $(document).ready(function () {
        $('#nama_suplayer').focus();
        $('#tabelsuplayer').on('input', '#nama_suplayer', autocusuplayer);
        $('#tabel_pembelian').on('input', '.barang', autobarang);
        $('#tabel_pembelian').on('input', '.produksi', totalproduksi);
        $('#tabel_pembelian').on('keypress', '.produksi', function (e) {
            if (e.keyCode === 13) {
                var row_id_produksi = $(this).attr("id");
                var id_produksi = row_id_produksi.slice(8, 9);
                $('#hbl' + id_produksi + '').focus();
//                
            }
        });
        $('#tabel_pembelian').on('keypress', '.hbeli', function (e) {
            if (e.keyCode === 13) {
                var row_id_hbeli = $(this).attr("id");
                var id_hbeli = row_id_hbeli.slice(3, 5);
                $('#jml' + id_hbeli + '').focus();
//                alert(id_hbeli);
            }
        });
        $('#tabel_pembelian').on('keypress', '.jumlah', function (e) {
            if (e.keyCode === 13) {
                i++;
                $('#tabel_pembelian').append('<tr id="' + i + '"><th>' + i + '.</th>\n\
                                        <td><input type="text" class="form-control barang" name="barang[]" id="brg' + i + '"></td>\n\
                                        <td><input type="text" class="form-control produksi" name="produksi[]" id="produksi' + i + '" ></td>\n\
                                        <td><input type="text" class="form-control hbeli" name="hbeli[]" id="hbl' + i + '" ></td>\n\
                                        <td><input type="text" class="form-control jumlah" name="jumlah[]" id="jml' + i + '" >\n\
                                        <td><input type="text" class="form-control totalitem" name="totalitem" id="totalitem' + i + '" readonly=""></td>\n\
                                        <td ><button type="button" class="btn btn-danger waves-effect btn_remove" id="' + i + '">X</button></td>\n\
                                        </tr>');
                $('#brg' + i + '').focus();
            }
        });
        $('#tabel_pembelian').on('input', '.hbeli', function () {
            var n = parseInt($(this).val().replace(/\D/g, ''), 10);
            $(this).val(rp(n));
            ;
        });
        $('#tabel_pembelian').on('input ', '.jumlah , .hbeli ', zigma);
        $('#tabel_pembelian').on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#' + button_id + '').remove();
            sumzigma();
        });
        $("#bayar").on('input', function () {
            var n = parseInt($(this).val().replace(/\D/g, ''), 10);
            $(this).val(rp(n));
            var totalnya = parseInt($('#tot_pembayaran').val().replace(/\D/g, ''), 10);
            var sisadisplay = Math.round(n - totalnya);
            $('#kembalian').val(rp(sisadisplay));
        });
    });
    function autocusuplayer() {
        $('#nama_suplayer').autocomplete({
            minLength: 1, autoFocus: true,
            source: function (req, res) {
                $.ajax({
                    url: "<?php echo site_url('Ctransaksi_pembelian/search_suplayer') ?>",
                    data: {cari: $('#nama_suplayer').val()}, dataType: 'json', type: "POST",
                    success: function (data) {
                        res(data);
                    }
                });
            },
            select: function (event, ui) {
                if (ui.item.sukses === true) {
                    $('#nama_suplayer').val(ui.item.nama);
                    $('#idsuplayer').val(ui.item.idsuplayer);
                    $('#hp_suplayer').val(ui.item.hp);
                    $('#alamat_suplayer').val(ui.item.alamat);
                    $('#hp_suplayer').css('background', '#cccccc');
                    $('#alamat_suplayer').css('background', '#cccccc');
                    $('#brg1').focus();
                    return false;
                } else {
                    return false;
                }
            },
            create: function () {
                $(this).data('ui-autocomplete')._renderItem = function (ul, item) {
                    return $("<li></li>")
                            .data("item.autocomplete", item)
                            .append("<a><strong>" + item.nama + "</strong> <br/> " + item.alamat + "</a>")
                            .appendTo(ul);
                };
            }
        });
    }
    function autobarang() {
        var row_id = $(this).attr("id");
        var id_nya = row_id.slice(3, 5);
        $('#brg' + id_nya + '').autocomplete({
            minLength: 1, autoFocus: true,
            source: function (req, res) {
                $.ajax({
                    url: "<?php echo site_url('Ctransaksi_penjualan/search_barang') ?>",
                    data: {cari: $('#brg' + id_nya + '').val()}, dataType: 'json', type: "POST",
                    success: function (data) {
                        res(data);
                    }
                });
            },
            select: function (event, ui) {
                if (ui.item.sukses === true) {
                    $('#brg' + id_nya + '').val(ui.item.nama_barang);
                    $('#produksi' + id_nya + '').val(ui.item.produksi);
                    $('#hbl' + id_nya + '').val(rp(ui.item.hargabeli));
                    $('#produksi' + id_nya + '').focus();
                    return false;
                } else {
                    return false;
                }
            },
            create: function () {
                $(this).data('ui-autocomplete')._renderItem = function (ul, item) {
                    return $("<li></li>")
                            .data("item.autocomplete", item)
                            .append("<a><strong>" + item.nama_barang + "</strong> <br/>Sisa Stock : " + item.stock + "</a>")
                            .appendTo(ul);
                };
            }


        });
    }
    function zigma() {
        var row_id = $(this).attr("id");
        var id_nya = row_id.slice(3, 5);
        var h = $('#hbl' + id_nya + '').val().replace(/\D/g, '');
        var j = $('#jml' + id_nya + '').val();
        var bilangan = Math.round(h * j);
        $('#totalitem' + id_nya + '').val(rp(bilangan));
        sumzigma();
    }
    function sumzigma() {
        var total = 0;
        $('.totalitem').each(function () {
            var rupiah = $(this).val();
            var val = rupiah.replace(/\D/g, '');
            val = isNaN(val) || $.trim(val) === "" ? 0 : parseFloat(val);
            total += val;
        });
        var totaldisplay = Math.round(total);
        $('#tot_pembayaran').val(rp(totaldisplay));
    }
    function totalproduksi() {
        var total = 0;
        $('.produksi').each(function () {
            var val = $(this).val();
            val = isNaN(val) || $.trim(val) === "" ? 0 : parseFloat(val);
            total += val;
        });
        var totaldisplay = total;
        $('#tot_produksi').val(totaldisplay);
    }
    function rp(angkanya) {
        var rupiah = new Intl.NumberFormat('id-id', {style: 'currency', currency: 'IDR', minimumFractionDigits: 0}).format(angkanya);
        return rupiah;
    }
    function simpan_pembelian() {
        $.ajax({//parsing_simpan_transaksi_penjualan
            url: '<?php echo site_url('Ctransaksi_pembelian/simpan_pembelian') ?>',
            type: 'POST',
            data: $('#data_pembelian').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    alert(data.pesan);
                    pembelian();
                } else {
                    alert(data.pesan);
                    if (data.eror === "barang") {
                        $('#brg1').focus();
                    } else if (data.eror === "suplayer") {
                        $('#nama_suplayer').focus();
                    } else if (data.eror === "bayar") {
                        $('#bayar').focus();
                    }
                }
            }
        });
    }
</script>
