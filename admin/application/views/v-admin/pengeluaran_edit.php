<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">Edit Data pengeluaran</h3>
    </div>
    <div class="card-body p-0">
        <form class="form-horizontal " id="data_edit_pengeluaran">
            <div class="card-body">  
                <input type="hidden" id="idpengeluaran" name="idpengeluaran" value="<?= $idpengeluaran ?>">
                <div class="form-group row">
                    <label for="pengeluaran" class="col-sm-4 col-form-label">Nama pengeluaran</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="keterangan" name="keterangan" placeholder="Nama pengeluaran" value="<?= $keterangan ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hbeli" class="col-sm-4 col-form-label">Nominal Pengeluaran</label>
                    <div class="col-sm-8">                                    
                        <input type="text"  class=" form-control form-control-sm" id="nominal_pengeluaran" name="nominal_pengeluaran" placeholder="nominal pengeluaran" value="<?= $nominal_pengeluaran ?>" oninput="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hecer" class="col-sm-4 col-form-label">Tanggal </label>
                    <div class="col-sm-8">
                        <input type="date" class=" form-control form-control-sm" id="tanggal" name="tanggal" placeholder="Tanggal" value="<?= $tanggal ?>">
                    </div>
                </div>
            </div>
        </form>
        <div class="card-footer p-1">
            <button type="submit" class="btn btn-danger " onclick="edit_data_pengeluaran()">Edit Data pengeluaran</button>
            <!-- <button type="submit" class="btn btn-warning swalDefaultSuccess"><i class="fa fa-trash"></i></button> -->
            <button type="submit" class="btn btn-default float-right" onclick="cancel_pengeluaran()">Cancel</button>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#data_edit_pengeluaran').on('input', '#nominal_pengeluaran', function () {
            var n = parseInt($(this).val().replace(/[^,\d]/g, ''), 10);
            n = isNaN(n) || $.trim(n) === "" ? 0 : parseFloat(n);
            $(this).val(rp(n));
        });
    });
    function edit_data_pengeluaran() {
        $.ajax({
            url: '<?php echo site_url('Admin_master/update_pengeluaran') ?>',
            type: 'POST',
            data: $('#data_edit_pengeluaran').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert_pesan('info', data.pesan);
                    search_pengeluaran();
                }else{
                    alert_pesan('error', data.pesan);
                    $('#pengeluaran').focus();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    }
</script>