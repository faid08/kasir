<div class="content-header">                    
    </div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-danger card-outline">
                    <div class="card-title">
                        <input type="hidden"id="pilihtoko"value="<?= $this->session->userdata['logged_in']['toko']?>">
                        <div class="row ">
                            <div class=" col-md-6 input-group input-group-sm" style="width: 300px;">
                                <input type="text" name="search_nama_barang" id="search_nama_barang" class="form-control float-right" placeholder="Cari Nama Barang">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-danger"  onclick="search_barang()"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <div class="form-check-inline">                                    
                                <input type="checkbox" class="form-check-input" id="filter_stock" onclick="search_barang()" >
                                <label class="form-check-label" for="filter_stock"style="width: 100px;">Stock Minim</label>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="list_barang">
            <div class="card">
                <div class="card-body table-responsive p-0 ">
                    <table class="table  table-hover text-nowrap">
                        <thead class="bg bg-danger">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th >Barcode</th>
                                <th >Nama Barang</th>
                                <th >Isi Dus</th>
                                <th >Ecer 1</th>
                                <th >Ecer 2</th>
                                <th >Grosir 1</th>
                                <th >Grosir 2</th>
                                <th >Grosir 3</th>
                                <th >Promo</th> 
                                <th >Stock</th>
                                <!-- <th >Aksi</th>      -->
                            </tr>
                        </thead>
                        <tbody class="data_list_barang">                        
                            <tr>
                                <td colspan="10">
                                    Silahkan tampilkan barang dengan mengisi kolom "<b> Cari Nama Barang </b>" diatas kemudian klik <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-search"></i></button> .<br>
                                    <span class="text-danger" ><b> ATAU </b></span> isi kolom "<b> Cari Nama Barang </b>"  dan centang "<b> Stock Minim</b>" untuk menampilkan barang dengan stok minimal .
                                </td>
                            </tr>

                        </tbody>
                         <tfoot >
                            <tr  >
                                <td colspan="5">
                                    <div class=" col-sm-12 form-group row float-left"style="margin-bottom:0px; ">                        
                                        <div class="col-sm-3">
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
                                <td colspan="5"style="text-align: right"><label> <small>Jumlah Barang </small> ( <?= $jbarang ?> )</label></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>        
    </div>
</div>
<script>
    $(function () {
         $("#search_nama_barang").focus();
        search_barang();
        $('#search_nama_barang').keyup(function () {
            if ($(this).val().length >= 0) {
                search_barang();
            }
        });
        $('#baris').change(function () {
            search_barang();
        });
    });    
    function search_barang() {
        var filter_stock = "";
        if ($('#filter_stock').is(':checked')) {
            filter_stock = 'true';
        }
        $.ajax({
            url: "<?= site_url('Admin_master/search_barang') ?>",
            type: 'POST',
            data: {search_nama_barang: $('#search_nama_barang').val(), filter_stock: filter_stock, toko:$('#pilihtoko').val(), baris: $('#baris').val()},
            dataType: 'JSON',
            success: function (data) {
                if (data.sukses === 'ya') {
                    $('.data_list_barang').html('`' + data.list_barang + '`');
                } else {
                    $('.data_list_barang').html('`' + data.list_barang + '`');
                }
                $('#search_nama_barang').focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    }
</script>