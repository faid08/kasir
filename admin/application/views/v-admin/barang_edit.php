<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">Edit Data Barang</h3>
    </div>
    <div class="card-body p-0">
        <form class="form-horizontal " id="data_edit_barang">
            <div class="card-body">  
                <input type="hidden" id="kode_barang" name="kode_barang" value="<?= $idbarang ?>">
                <input type="hidden" id="idtoko" name="idtoko" value="<?= $idtoko ?>">
                <div class="form-group row">
                    <label for="barang" class="col-sm-4 col-form-label">Barcode Barang</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="barcode"name="barcode" placeholder="Nama Barang" value="<?= $barcode ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="barang" class="col-sm-4 col-form-label">Nama Barang</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="barang"name="barang" placeholder="Nama Barang" value="<?= $nama ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hbeli" class="col-sm-4 col-form-label">Harga Beli</label>
                    <div class="col-sm-8">                                    
                        <input type="text"  class=" form-control form-control-sm" id="hbeli" name="hbeli" placeholder="Harga Beli" value="<?= $hbeli ?>" oninput="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hecer" class="col-sm-4 col-form-label">Harga Ecer </label>
                    <div class="col-sm-4">
                        <input type="text" class=" form-control form-control-sm" id="hecer1" name="hecer1" placeholder="Ecer 1" value="<?= $hecer1 ?>">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class=" form-control form-control-sm" id="hecer2" name="hecer2" placeholder=" Ecer 2" value="<?= $hecer2 ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="hgrosir" class="col-sm-4 col-form-label">Harga Grosir </label>
                    <div class="col-sm-4">
                        <input type="text" class=" form-control form-control-sm" id="hgrosir1" name="hgrosir1" placeholder=" Grosir 1" value="<?= $hgrosir1 ?>">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class=" form-control form-control-sm" id="hgrosir2" name="hgrosir2"placeholder=" Grosir 2" value="<?= $hgrosir2 ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hgrosir3" class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="hgrosir3" name="hgrosir3" placeholder=" Grosir 3" value="<?= $hgrosir3 ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="produksi" class="col-sm-4 col-form-label">Harga Promo</label>                    
                    <div class="col-sm-5">
                        <input type="text" class=" form-control form-control-sm" id="hpromo" name="hpromo" placeholder="Harga Promo" value="<?= $hpromo ?>" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="produksi" class="col-sm-4 col-form-label">Tanggal Promo</label>                    
                    <div class="col-sm-5">
                        <input type="date" class=" form-control form-control-sm" id="tanggalpromo" name="tanggalpromo" placeholder="Tanggal Promo" value="<?= $tanggalpromo ?>" >
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="produksi" class="col-sm-4 col-form-label">Isi Dus</label>                    
                    <div class="col-sm-5">
                        <input type="number" class=" form-control form-control-sm" id="isibarang" name="isibarang" placeholder="isi barang" value="<?= $isibarang ?>" >
                    </div>
                </div>
            </div>
        </form>
        <div class="card-footer p-1">
            <button type="submit" class="btn btn-danger " onclick="edit_data_barang()">Edit Data Barang</button>
            <!-- <button type="submit" class="btn btn-warning swalDefaultSuccess"><i class="fa fa-trash"></i></button> -->
            <button type="submit" class="btn btn-default float-right" onclick="cancel_barang()">Cancel</button>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#data_edit_barang').on('input', '#hbeli , #hecer1 , #hecer2 , #hgrosir1 , #hgrosir2 , #hgrosir3, #hpromo ', function () {
            var n = parseInt($(this).val().replace(/[^,\d]/g, ''), 10);
            n = isNaN(n) || $.trim(n) === "" ? 0 : parseFloat(n);
            $(this).val(rp(n));
        });
    });
    function edit_data_barang() {
        $.ajax({
            url: '<?php echo site_url('Admin_master/update_barang') ?>',
            type: 'POST',
            data: $('#data_edit_barang').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert_pesan('info', data.pesan);
                    search_barang();
                }else{
                    alert_pesan('error', data.pesan);
                    $('#barang').focus();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    }
</script>