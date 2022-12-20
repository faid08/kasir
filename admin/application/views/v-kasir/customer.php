<div class="content-header">                    
    </div>
<div class="container"id="div_customer">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-yellow card-outline">
                    <div class="card-title">
                        <div class="row ">
                            <div class="form-check-inline">                                    
                                <input type="radio" class="form-check-input" id="filter_nama" name="filter_customer_by" value="filter_nama" checked onclick="search_customer()">
                                <label class="form-check-label small" for="filter_nama"style="width: 50px;">Nama</label>
                                <input type="radio" class="form-check-input" id="filter_alamat" name="filter_customer_by" value="filter_alamat" onclick="search_customer()">
                                <label class="form-check-label small " for="filter_alamat"style="width: 60px;">Alamat</label>
                                <input type="radio" class="form-check-input" id="filter_wilayah" name="filter_customer_by" value="filter_wilayah" onclick="search_customer()">
                                <label class="form-check-label small" for="filter_wilayah"style="width: 70px;">Wilayah</label>
                            </div>
                            <div class=" col-md-6 input-group input-group-sm" style="width: 300px;">
                                <input type="text" name="search_customer_by" id="search_customer_by" class="form-control float-right" placeholder="Berdasarkan Nama Customer">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-warning" onclick="search_customer()"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-tools">                        
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" data-toggle="tab" onclick="form_tambah_customer()"><i class="fa fa-plus-square"></i> Tambah Customer</a>
                            </li>                           
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="list_customer">
            <div class="card">
                <div class="card-body table-responsive p-0 ">
                    <table class="table table-hover text-nowrap">
                        <thead class="bg bg-warning">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th >Nama Customer</th>
                                <th >Alamat</th>
                                <th >Wilayah</th>
                                <th >Handphone 1</th>
                                <th >Status</th>
                                <th > Penjab (Marketing)</th>                                  
                            </tr>
                        </thead>
                        <tbody id="data_list_customer">
                        </tbody>
                        <tfoot >
                            <tr  >
                                <td colspan="6">
                                    <div class=" col-sm-12 form-group row float-left"style="margin-bottom:0px; ">                        
                                        <div class="col-sm-2">
                                            <select class=" form-control form-control-sm" name="baris" id="baris">
                                                <option value="10">10</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                                <option value="500">500</option>
                                                <option value="all">Semua</option>
                                            </select>
                                        </div>
                                        <label for="baris" class="col-sm-3 col-form-label">Baris Data</label>
                                    </div>
                                </td>
                                <td colspan="7"><label> <small>Total Customer </small> ( <?= $jcustomer?> )</label></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5" id="customer_tambah_edit">

        </div>
    </div>
</div>
<script>
    $(function () {
        $('#search_customer_by').focus();
        search_customer();        
        $('#search_customer_by').keyup(function () {
            if ($(this).val().length >= 0) {
                search_customer();
            }
        });
        $('#baris').change(function () {
            search_customer();
        });
        $('#filter_nama').click(function () {
            $('#search_customer_by').attr('placeholder', 'Berdasarkan Nama Customer');
            $('#search_customer_by').focus();
        });
        $('#filter_alamat').click(function () {
            $('#search_customer_by').attr('placeholder', 'Berdasarkan Alamat Customer');
            $('#search_customer_by').focus();
        });
        $('#filter_wilayah').click(function () {
            $('#search_customer_by').attr('placeholder', 'Berdasarkan Wilayah Customer');
            $('#search_customer_by').focus();
        });
    });
    function search_customer() {
        var fn = "";
        var fa = "";
        var fw = "";
        if ($('#filter_nama').is(':checked')) {
            fn = 'Nama';
        }
        if ($('#filter_alamat').is(':checked')) {
            fa = 'Alamat';
        }
        if ($('#filter_wilayah').is(':checked')) {
            fw = 'Wilayah';
        }
        $.ajax({
            url: "<?= site_url('Admin_master/search_customer') ?>",
            type: 'POST',
            data: {search_customer_by: $('#search_customer_by').val(), fn: fn, fa: fa, fw: fw,baris: $('#baris').val()},
            dataType: 'JSON',
            success: function (data) {
                if (data.sukses === 'ya') {
                    $('#data_list_customer').html('`' + data.list_customer + '`');
                } else {
                    $('#data_list_customer').html('`' + data.list_customer + '`');
                }
                cancel_customer();
                $('#search_customer_by').focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    }
    function form_tambah_customer() {
        $.post('<?= site_url("Kasir_dashboard/form_tambah_customer")?>', function (Res) {
            $('#list_customer').removeClass('col-md-12');
            $('#list_customer').addClass('col-md-7');
            $('#customer_tambah_edit').html(Res);
        });
    }
    function form_edit_customer(id) {
        $.post('<?= site_url("Kasir_dashboard/form_edit_customer")?>', {id: id}, function (Res) {
            $('#list_customer').removeClass('col-md-12');
            $('#list_customer').addClass('col-md-7');
            $('#customer_tambah_edit').html(Res);
        });
    }
    function cancel_customer() {
        $('#customer_tambah_edit').html('');
        $('#list_customer').removeClass('col-md-7');
        $('#list_customer').addClass('col-md-12');
    }
</script>