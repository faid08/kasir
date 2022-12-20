<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Tambahkan Data Toko Baru</h3>
    </div>
    <div class="card-body p-0">
        <form class="form-horizontal " id="data_simpan_toko">
            <div class="card-body"> 
                <div class="form-group row">
                    <label for="toko" class="col-sm-4 col-form-label">Nama Toko</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="toko" name="toko"placeholder="Nama Toko">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">                                    
                        <textarea class=" form-control form-control-sm" id="alamat" name="alamat" placeholder="Alamat"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-4 col-form-label">Modal</label>
                    <div class="col-sm-8">                                    
                         <input type="text" class=" form-control form-control-sm" id="nominal_modal" name="nominal_modal" placeholder="Nominal Modal">
                    </div>
                </div>          
            </div>
        </form>
        <div class="card-footer p-1">
            <button type="submit" class="btn btn-info" onclick="tambah_data_toko()">Simpan Data Toko</button>
            <button type="submit" class="btn btn-default float-right" onclick="cancel_toko()">Cancel</button>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#toko').focus();
        $("#toko").keypress(function (e) {
            keyCode = e.keyCode ? e.keyCode : e.which;
            if (keyCode === 13) {
                $('#alamat').focus();
            }
        });

    });
    function tambah_data_toko() {
        $.ajax({
            url: '<?php echo site_url('Admin_master/simpan_toko') ?>',
            type: 'POST',
            data: $('#data_simpan_toko').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert_pesan('success', data.pesan);
                    $('#search_toko_by').val(data.nama);
                    search_toko();
                } else {
                    alert_pesan('error', data.pesan);
                    $('#toko').focus();
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(jqXHR);
            }
        });
    }
</script>