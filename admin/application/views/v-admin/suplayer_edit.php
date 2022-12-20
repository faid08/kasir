<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">Edit Data suplayer </h3>
    </div>
    <div class="card-body p-0">
        <form class="form-horizontal" id="data_edit_suplayer">
            <div class="card-body">        
                <input type="hidden" class=" form-control form-control-sm" id="id_suplayer" name="id_suplayer" value="<?= $id ?>" >
                <div class="form-group row">
                    <label for="suplayer" class="col-sm-4 col-form-label">Nama suplayer</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="suplayer" name="suplayer" placeholder="Nama suplayer" value="<?= $nama ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">                                    
                        <textarea class=" form-control form-control-sm" id="alamat"name="alamat" placeholder="Alamat"><?= $alamat ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hp" class="col-sm-4 col-form-label">Handphone</label>
                    <div class="col-sm-4">
                        <input type="number" class=" form-control form-control-sm" id="hp" name="hp"placeholder=" Handphone" value="<?= $hp ?>">
                    </div>                    
                </div>         
            </div>
        </form>
        <div class="card-footer p-1">
            <button type="submit" class="btn btn-danger" onclick="edit_data_suplayer()">Edit Data suplayer</button>
            <!--<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>-->
            <button type="submit" class="btn btn-default float-right" onclick="cancel_suplayer()">Cancel</button>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#suplayer').focus();
    });
    function edit_data_suplayer() {
        $.ajax({
            url: '<?php echo site_url('Admin_master/update_suplayer') ?>',
            type: 'POST',
            data: $('#data_edit_suplayer').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert_pesan('info', data.pesan);
                    $('#search_suplayer_by').val(data.nama);
                    search_suplayer();
                } else {
                    alert_pesan('error', data.pesan);
                    $('#suplayer').focus();
                }
            }
        });
    }
</script>