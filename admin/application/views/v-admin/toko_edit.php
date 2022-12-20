<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Edit Data Petugas </h3>
    </div>
    <div class="card-body p-0">
        <form class="form-horizontal" id="data_edit_toko">
            <div class="card-body">           
                <input type="hidden" name="id_toko" value="<?= $id ?>">
                <div class="form-group row">
                    <label for="toko" class="col-sm-4 col-form-label">Nama Toko</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="toko" name="toko"placeholder="Nama Toko" value="<?= $nama ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">                                    
                        <textarea class=" form-control form-control-sm" id="alamat" name="alamat" placeholder="Alamat"><?= $alamat ?></textarea>
                    </div>
                </div>     
                 <div class="form-group row">
                    <label for="alamat" class="col-sm-4 col-form-label"> Modal Toko</label>
                    <div class="col-sm-8">                                    
                        <input type="text" class=" form-control form-control-sm" id="nominal_modal" name="nominal_modal"placeholder="nominal modal" value="<?= $nominal_modal ?>">
                    </div>
                </div>      
            </div>
        </form>
        <div class="card-footer p-1">
            <button type="submit" class="btn btn-danger" onclick="edit_data_toko()">Edit Data Toko</button>
                <button type="submit" class="btn btn-default float-right" onclick="cancel_toko()">Cancel</button>
            </div>
    </div>
</div>
<script>
    $(function () {
        $('#toko').focus();
    });
    function edit_data_toko() {
        $.ajax({
            url: '<?php echo site_url('Admin_master/update_toko') ?>',
            type: 'POST',
            data: $('#data_edit_toko').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert_pesan('info', data.pesan);
                    $('#search_toko_by').val(data.nama);
                    search_toko();
                } else {
                    alert_pesan('error', data.pesan);
                    $('#toko').focus();
                }
            }
        });
    }
</script>