<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Tambahkan Data Barang Baru</h3>
    </div>
    <div class="card-body p-0">
        <form class="form-horizontal" id="data_simpan_barang">
            <div class="card-body">     
                <div class="form-group row">
                    <label for="barang" class="col-sm-4 col-form-label">Jenis Barang</label>
                    <div class="col-sm-8">
                                <select class="form-control" name="pilihjenisbarang" id="pilihjenisbarang">
                                    <?php
                                    foreach ($jenisbarang as $value) {
                                        ?>
                                        <option value="<?= $value->idjenisbarang ?>"><?= $value->nama_jenisbarang ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>  
                </div>  
                <div class="form-group row">
                    <label for="barang" class="col-sm-4 col-form-label">Barcode</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="barcode" name="barcode" placeholder="Barcode Barang">
                    </div>
                </div>                
                <div class="form-group row">
                    <label for="barang" class="col-sm-4 col-form-label">Nama Barang</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="barang" name="barang" placeholder="Nama Barang">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hbeli" class="col-sm-4 col-form-label">Harga Beli</label>
                    <div class="col-sm-8">                                    
                        <input type="text" class=" form-control form-control-sm" id="hbeli" name="hbeli"placeholder="Harga Beli">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hecer" class="col-sm-4 col-form-label">Harga Ecer </label>
                    <div class="col-sm-4">
                        <input type="text" class=" form-control form-control-sm" id="hecer1"name="hecer1" placeholder="Ecer 1" >
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class=" form-control form-control-sm" id="hecer2" name="hecer2" placeholder=" Ecer 2" >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="hgrosir" class="col-sm-4 col-form-label">Harga Grosir </label>
                    <div class="col-sm-4">
                        <input type="text" class=" form-control form-control-sm" id="hgrosir1" name="hgrosir1"placeholder=" Grosir 1">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class=" form-control form-control-sm" id="hgrosir2" name="hgrosir2"placeholder=" Grosir 2">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hgrosir3" class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="hgrosir3" name="hgrosir3" placeholder=" Grosir 3">
                    </div>
                </div>
               <!--  <div class="form-group row">
                    <label for="stock" class="col-sm-4 col-form-label">Stok</label>
                    <div class="col-sm-3">
                        <input type="text" class=" form-control form-control-sm" id="stock" name="stock" placeholder=" Stock" value="0" disabled="disabled">
                    </div>
                </div> -->
                <div class="form-group row">
                    <label for="produksi" class="col-sm-4 col-form-label">Tanggal Promo</label>                    
                    <div class="col-sm-5">
                        <input type="date" class=" form-control form-control-sm" id="tanggalpromo" name="tanggalpromo" placeholder="Harga Promo" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="produksi" class="col-sm-4 col-form-label">Harga Promo</label>                    
                    <div class="col-sm-5">
                        <input type="text" class=" form-control form-control-sm" id="hpromo" name="hpromo" placeholder="Harga Promo" >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="produksi" class="col-sm-4 col-form-label">Isi Per Dus</label>                    
                    <div class="col-sm-5">
                        <input type="text" class=" form-control form-control-sm" id="isibarang" name="isibarang" placeholder="Produksi" >
                    </div>
                </div>

            </div>
        </form>
        <div class="card-footer p-1">
            <button type="submit" class="btn btn-info" onclick="tambah_data_barang()">Simpan Data Barang</button>
            <button type="submit" class="btn btn-default float-right" onclick="cancel_barang()">Cancel</button>
        </div>
    </div>
</div>
<script>
    $(function (){
        $('#barcode').focus();
         $('#data_simpan_barang').on('input', '#hbeli , #hecer1 , #hecer2 , #hgrosir1 , #hgrosir2 , #hgrosir3 , #hpromo', function () {
            var n = parseInt($(this).val().replace(/[^,\d]/g, ''), 10);
            n = isNaN(n) || $.trim(n) === "" ? 0 : parseFloat(n);
            $(this).val(rp(n));
        });
    });
    function tambah_data_barang() {
        $.ajax({
            url: '<?php echo site_url('Admin_master/simpan_barang') ?>',
            type: 'POST',
            data: $('#data_simpan_barang').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert_pesan('success', data.pesan);
                    $('#search_nama_barang').val(data.nama);
                    search_barang();
                }else{
                    alert_pesan('error', data.pesan);
                    $('#barcode').focus();
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(jqXHR);
            }
        });
    }
</script>