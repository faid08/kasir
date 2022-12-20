<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Tambahkan Data Petugas Baru</h3>
    </div>
    <div class="card-body p-0">
        <form class="form-horizontal " id="data_simpan_petugas">
            <div class="card-body">       
                <div class=" form-group row">
                    <label for="pilihtoko" class="col-sm-4 col-form-label"> Toko</label>
                    <div class="col-sm-8">
                        <select class="form-control form-control-sm" name="pilihtoko" id="pilihtoko">
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
                <div class="form-group row">
                    <label for="petugas" class="col-sm-4 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="petugas" name="petugas"placeholder="Nama Petugas">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">                                    
                        <textarea class=" form-control form-control-sm" id="alamat" name="alamat" placeholder="Alamat"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hp" class="col-sm-4 col-form-label">Handphone</label>
                    <div class="col-sm-4">
                        <input type="number" class=" form-control form-control-sm" id="hp" name="hp" placeholder=" Handphone">
                    </div>                    
                </div>                
                <div class="form-group row  " >
                    <small class="text-center text-red">Setting Akses Petugas </small>
                </div>
                <div class="form-group row">
                    <label for="uname" class="col-sm-4 col-form-label">Usernama</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="uname"  name="uname"placeholder="Username">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pass" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="akses" class="col-sm-4 col-form-label">Akses</label>
                    <div class="col-sm-8">
                        <select type="text" class="form-control form-control-sm" id="akses" name="akses" >
                            <option value="Kasir"> Kasir</option>
                            <option value="Supervisor"> Supervisor</option>                            
                        </select>
                    </div>
                </div>           
            </div>            
        </form>
        <div class="card-footer p-1">
            <button type="submit" class="btn btn-info" onclick="tambah_data_petugas()">Simpan Data Petugas</button>
                <button type="submit" class="btn btn-default float-right" onclick="cancel_petugas()">Cancel</button>
            </div>
    </div>
</div>
<script>
    function tambah_data_petugas() {
        $.ajax({
            url: '<?php echo site_url('Admin_master/simpan_petugas') ?>',
            type: 'POST',
            data: $('#data_simpan_petugas').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert_pesan('success', data.pesan);
                    $('#search_petugas_by').val(data.nama);
                    search_petugas();
                } else {
                    alert_pesan('error', data.pesan);
                    $('#petugas').focus();
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(jqXHR);
            }
        });
    }
</script>