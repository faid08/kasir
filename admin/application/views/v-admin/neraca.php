<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="row ">
                            <div class=" col-md-3 input-group input-group-sm" style="width: 500px;">
                                <select class="form-control" name="pilihtoko" id="pilihtoko">
                                    <option value="">Pilin Toko</option>
                                    <?php
                                    foreach ($toko as $value) {
                                        ?>
                                        <option value="<?= $value->idtoko ?>"><?= $value->nama ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" id="list_pengeluaran">
            <div class="card">
                <div class="card-body table-responsive p-0 ">
                    <table class="table table-hover text-nowrap">
                        <thead class="bg bg-info">
                            <tr>
                                <!-- <th style="width: 10px">#</th> -->
                                <th colspan="2">Ket</th>
                            </tr>
                        </thead>
                        <tbody class="data_list_neraca">                       
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    $(function () {
        $('#pilihtoko').change(function () {
            search_pengeluaran();
        });
      
    });
    function search_pengeluaran() {
        $.ajax({
            url: "<?= site_url('Admin_master/search_neraca') ?>",
            type: 'POST',
            data: {toko: $('#pilihtoko').val()},
            dataType: 'JSON',
            success: function (data) {
                if (data.sukses === 'ya') {
                    $('.data_list_neraca').html('`' + data.list_neraca + '`');
                } else {
                    $('.data_list_neraca').html('`' + data.list_neraca + '`');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    }
</script>