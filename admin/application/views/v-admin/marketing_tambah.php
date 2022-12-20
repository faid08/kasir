<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Tambahkan Data Marketing Baru</h3>
    </div>
    <div class="card-body p-0">
        <form class="form-horizontal" id="data_simpan_marketing">
            <div class="card-body">                            
                <div class="form-group row">
                    <label for="marketing" class="col-sm-4 col-form-label">Nama Marketing</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="marketing" name="marketing"placeholder="Nama Marketing">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">                                    
                        <textarea class=" form-control form-control-sm" id="alamat" placeholder="Alamat" name="alamat"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hp" class="col-sm-4 col-form-label">Handphone</label>
                    <div class="col-sm-4">
                        <input type="number" class=" form-control form-control-sm" id="hp" name="hp" placeholder=" Handphone">
                    </div>
                </div>                               
            </div>            
        </form>
        <div class="card-footer p-1">
            <button type="submit" class="btn btn-info" onclick="tambah_data_marketing()">Simpan Data Marketing</button>
                <button type="submit" class="btn btn-default float-right" onclick="cancel_marketing()">Cancel</button>
            </div>
    </div>
</div>
<script>
   function tambah_data_marketing() {
        $.ajax({
            url: '<?php echo site_url('Admin_master/simpan_marketing') ?>',
            type: 'POST',
            data: $('#data_simpan_marketing').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert_pesan('success', data.pesan);
                    $('#search_marketing_by').val(data.nama);
                    search_marketing();
                } else {
                    alert_pesan('error', data.pesan);
                    $('#marketing').focus();
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(jqXHR);
            }
        });
    }
</script>