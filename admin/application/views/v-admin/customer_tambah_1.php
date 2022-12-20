<style type="text/css">

    ul.ui-autocomplete {
        z-index: 1100;

    }

</style>
<script scr="vendor/jquery-2.1.1.js"></script>
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Tambahkan Data Customer Baru</h3>
    </div>
    <div class="card-body p-0">
        <form class="form-horizontal " id="data_simpan_customer">
            <div class="card-body">
<!--                <div class="form-group row">
                    <label  for="select2" class="col-sm-4 col-form-label" >Multiple</label>
                    <div class="col-sm-8">
                        <select class="form-control form-control-sm select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                            <option>Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div>
                </div>-->
                <div class="form-group row">
                    <label for="marketing" class="col-sm-4 col-form-label">Marketing</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="marketing" name="marketing" placeholder=" Penjab marketing" >
                        <!--<ul id="ui-autocomplete" class="ui-autocomplete"></ul>-->
                    </div>
                </div>
                <input type="hidden" class=" form-control form-control-sm" id="id_marketing" name="id_marketing">
                <div class="form-group row">
                    <small class="col-sm-4 text-danger"></small>
                    <small class="col-sm-8 text-danger">Detail Data Custumer</small>
                </div>    
                <div class="form-group row">
                    <label for="customer" class="col-sm-4 col-form-label">Nama Customer</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="customer" name="customer" placeholder="Nama Customer">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">                                    
                        <textarea class=" form-control form-control-sm" id="alamat" name="alamat"placeholder="Alamat"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="wilayah" class="col-sm-4 col-form-label">Wilayah </label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="wilayah" name="wilayah"placeholder="Wlayah" >
                    </div>                    
                </div>

                <div class="form-group row">
                    <label for="hp" class="col-sm-4 col-form-label">Handphone</label>
                    <div class="col-sm-4">
                        <input type="tel" class=" form-control form-control-sm" id="hp" name="hp" placeholder=" Handphone">
                    </div>

                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-4 col-form-label">Status</label>
                    <div class="col-sm-8">
                        <select type="text" class=" form-control form-control-sm" id="status" name="status">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif"> Non aktif</option>
                        </select>
                    </div>
                </div>                             
            </div>
        </form>
        <div class="card-footer p-1">
            <button type="submit" class="btn btn-info" onclick="tambah_data_customer()">Simpan Data Customer</button>
            <button type="submit" class="btn btn-default float-right" onclick="cancel_customer()">Cancel</button>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.select2').select2();
        $('#data_simpan_customer').on('input', '#marketing', automarketing);
    });
    function automarketing() {
        $('#marketing').autocomplete({
            minLength: 1, autoFocus: true,
            source: function (req, res) {
                $.ajax({
                    url: "<?php echo site_url('Admin_master/automarketing') ?>",
                    data: {marketing: $('#marketing').val()}, dataType: 'json', type: "POST",
                    success: function (data) {
                        res(data);
                    }
                });
            },
            select: function (event, ui) {
                if (ui.item.sukses === true) {
                    $('#marketing').val(ui.item.nama);
                    $('#id_marketing').val(ui.item.idmarketing);
                    return false;
                } else {
                    return false;
                }
            },
            create: function () {
                $(this).data('ui-autocomplete')._renderItem = function (ul, item) {
                    return $("<li></li>")
                            .data("item.autocomplete", item)
                            .append("<a>" + item.nama + "</a>")
                            .appendTo(ul);
                };
            }
        });
    }
    function tambah_data_customer() {
        $.ajax({
            url: '<?php echo site_url('Admin_master/simpan_customer') ?>',
            type: 'POST',
            data: $('#data_simpan_customer').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert_pesan('success', data.pesan);
                    $('#search_customer_by').val(data.nama);
                    search_customer();
                } else {
                    alert_pesan('error', data.pesan);
                    $('#customer').focus();
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(jqXHR);
            }
        });
    }
</script>