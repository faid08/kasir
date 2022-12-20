<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">Edit Data Marketing </h3>
    </div>
    <div class="card-body p-0">
        <form class="form-horizontal" id="data_edit_marketing">
            <div class="card-body">        
                <input type="hidden" class=" form-control form-control-sm" id="id_marketing" name="id_marketing" value="<?= $id ?>" >
                <div class="form-group row">
                    <label for="marketing" class="col-sm-4 col-form-label">Nama Marketing</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="marketing" name="marketing" placeholder="Nama Marketing" value="<?= $nama ?>">
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
            <button type="submit" class="btn btn-danger" onclick="edit_data_marketing()">Edit Data Marketing</button>
            <!--<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>-->
            <button type="submit" class="btn btn-default float-right" onclick="cancel_marketing()">Cancel</button>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#marketing').focus();
    });
    function edit_data_marketing() {
        $.ajax({
            url: '<?php echo site_url('Admin_master/update_marketing') ?>',
            type: 'POST',
            data: $('#data_edit_marketing').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert_pesan('info', data.pesan);
                    $('#search_marketing_by').val(data.nama);
                    search_marketing();
                } else {
                    alert_pesan('error', data.pesan);
                    $('#marketing').focus();
                }
            }
        });
    }
</script>