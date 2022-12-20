<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">Edit Piutang Customer </h3>
    </div>
    <div class="card-body p-0">
        <form class="form-horizontal" id="data_edit_marketing">
            <div class="card-body">
                <div class="form-group row">
                    <label for="nota" class="col-sm-4 col-form-label">Nomor Nota</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="nota" name="nota" value="<?= $nota ?>" hidden>
                        <input type="text" class=" form-control form-control-sm" id="idcustomer" name="idcustomer" 
                        value="<?= $idcustomer ?>" hidden>
                    </div>
                </div>
                <div class="form-group row">
                    <small class="col-sm-12 text-danger">Detail Data Piutang Custumer</small>
                </div> 
                <div class="form-group row">
                    <label class="col-sm-5 "> Nama </label>
                    <?php
                    if (empty($nama)) {
                        $nm = 'customer ecer (-)';
                    } else {
                        $nm = $nama;
                    }
                    ?>
                    <label class="col-sm-7 "><?= $nm ?></label>
                </div> 
                <div class="form-group row">
                    <label class="col-sm-5 "style="font-family: serif"> Ongkir + Total belanja </label>
                    <label class="col-sm-7 "style="font-family: serif">=&nbsp;<?= 'Rp ' . number_format($ongkir, 0, '.', '.') ?> &nbsp;+&nbsp;<?= 'Rp ' . number_format($totalbayar, 0, '.', '.') ?> &nbsp;=&nbsp;<?= 'Rp ' . number_format(($ongkir + $totalbayar), 0, '.', '.') ?></label>
                </div> 
                <div class="form-group row">
                    <label class="col-sm-5 "style="font-family: serif">Jml. bayar sebelumnya</label>
                    <label class="col-sm-7 "style="font-family: serif">=&nbsp;<?= 'Rp ' . number_format($bayar, 0, '.', '.') ?></label>
                </div> 
                <div class="form-group row">
                    <label class="col-sm-5" style="font-family: serif">Jml. sisa hutang</label>
                    <label class="col-sm-7 text-danger"style="font-family: serif">=&nbsp;<?= 'Rp ' . number_format(($bayar - ($ongkir + $totalbayar)), 0, '.', '.') ?></label>
                </div>
                <div class="form-group row">
                    <label for="bayar" class="col-sm-5 col-form-label">Jumlah Pembayaran</label>
                    <div class="col-sm-7">
                        <input type="text" class=" form-control form-control-sm" id="bayar" name="bayar" >
                        <input type="hidden" class=" form-control form-control-sm" id="tot_hutang" name="tot_hutang" value="<?= $ongkir + $totalbayar ?>" >
                        <input type="hidden" class=" form-control form-control-sm" id="pembayaran_sebelumnya" name="pembayaran_sebelumnya" value="<?= $bayar ?>" >
                    </div>
                </div>      
            </div>
        </form>
        <div class="card-footer p-1">
            <button type="submit" class="btn btn-danger" onclick="update_data_piutang()">Edit Data Pembayaran</button>
            <!--<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>-->
            <button type="submit" class="btn btn-default float-right" onclick="cancel_form()">Cancel</button>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#bayar').focus();
        $('#data_edit_marketing').on('input', '#bayar ', function () {
            var n = parseInt($(this).val().replace(/[^,\d]/g, ''), 10);
            n = isNaN(n) || $.trim(n) === "" ? 0 : parseFloat(n);
            $(this).val(rp(n));
        });
    });
    function update_data_piutang() {
        var nota = $('#nota').val();
        $.ajax({
            url: '<?php echo site_url('Admin_laporan/update_data_piutang') ?>',
            type: 'POST',
            data: {tot: $('#tot_hutang').val(), bayar: $('#bayar').val(), bayar_sebelumnya: $('#pembayaran_sebelumnya').val(), nota: nota, idcustomer: $('#idcustomer').val()},
            dataType: "JSON",
            success: function (data) {
                if (data.ket === "lunas") {
                    alert_pesan('success', data.pesan);
                    cancel_form();
                    $('#search_piutang_customer').val('');
                    laporan_piutang_customer();
                } else {
                    alert_pesan('info', data.pesan);
                    cancel_form();
                    $('#search_piutang_customer').val(nota);
                    laporan_piutang_customer();
                }

            }
        });
    }
</script>