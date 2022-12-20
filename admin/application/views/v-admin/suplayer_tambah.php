<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Tambahkan Data Suplayer Baru</h3>
    </div>
    <div class="card-body p-0">
        <form class="form-horizontal" id="data_simpan_suplayer">
            <div class="card-body">                            
                <div class="form-group row">
                    <label for="suplayer" class="col-sm-4 col-form-label">Nama suplayer</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="suplayer" name="suplayer"placeholder="Nama suplayer">
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
            <button type="submit" class="btn btn-info" onclick="tambah_data_suplayer()">Simpan Data suplayer</button>
                <button type="submit" class="btn btn-default float-right" onclick="cancel_suplayer()">Cancel</button>
            </div>
    </div>
</div>
<script>
   function tambah_data_suplayer() {
        $.ajax({
            url: '<?php echo site_url('Admin_master/simpan_suplayer') ?>',
            type: 'POST',
            data: $('#data_simpan_suplayer').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert_pesan('success', data.pesan);
                    $('#search_suplayer_by').val(data.nama);
                    search_suplayer();
                } else {
                    alert_pesan('error', data.pesan);
                    $('#suplayer').focus();
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(jqXHR);
            }
        });
    }
</script>