<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Tambahkan Data Pengeluaran Baru</h3>
    </div>
    <div class="card-body p-0">
        <form class="form-horizontal" id="data_simpan_pengeluaran">
            <div class="card-body">     
                             
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-4 col-form-label">Nama Pengeluaran</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="keterangan" name="keterangan" placeholder="Nama Pengeluaran">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Nominal" class="col-sm-4 col-form-label">Nominal</label>
                    <div class="col-sm-8">                                    
                        <input type="text" class=" form-control form-control-sm" id="nominal_pengeluaran" name="nominal_pengeluaran" placeholder="nominal_pengeluaran">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Tanggal" class="col-sm-4 col-form-label">Tanggal</label>
                    <div class="col-sm-8">
                        <input type="date" class=" form-control form-control-sm" id="tanggal"name="tanggal" placeholder="tanggal" >
                    </div>
                </div>

            </div>
        </form>
        <div class="card-footer p-1">
            <button type="submit" class="btn btn-info" onclick="tambah_data_pengeluaran()">Simpan Data Barang</button>
            <button type="submit" class="btn btn-default float-right" onclick="cancel_pengeluaran()">Cancel</button>
        </div>
    </div>
</div>
<script>
    $(function (){
        $('#keterangan').focus();
         $('#data_simpan_pengeluaran').on('input', '#nominal_pengeluaran', function () {
            var n = parseInt($(this).val().replace(/[^,\d]/g, ''), 10);
            n = isNaN(n) || $.trim(n) === "" ? 0 : parseFloat(n);
            $(this).val(rp(n));
        });
    });
    function tambah_data_pengeluaran() {
        $.ajax({
            url: '<?php echo site_url('Admin_master/simpan_pengeluaran') ?>',
            type: 'POST',
            data: $('#data_simpan_pengeluaran').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert_pesan('success', data.pesan);
                    $('#search_nama_pengeluaran').val(data.nama);
                    search_pengeluaran();
                }else{
                    alert_pesan('error', data.pesan);
                    $('#keterangan').focus();
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(jqXHR);
            }
        });
    }
</script>