<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Edit Data Petugas </h3>
    </div>
    <div class="card-body p-0">
        <form class="form-horizontal" id="data_edit_petugas">
            <div class="card-body">           
                <input type="hidden" name="id_petugas" value="<?= $id ?>">
                <div class="form-group row">
                    <label for="petugas" class="col-sm-4 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="petugas" name="petugas"placeholder="Nama Petugas" value="<?= $nama ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">                                    
                        <textarea class=" form-control form-control-sm" id="alamat" name="alamat" placeholder="Alamat"><?= $alamat ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hp" class="col-sm-4 col-form-label">Handphone</label>
                    <div class="col-sm-4">
                        <input type="number" class=" form-control form-control-sm" id="hp" name="hp" placeholder=" Handphone"value="<?= $hp ?>">
                    </div>                    
                </div>
                <div class="form-group row p-0">
                    <label for="status" class="col-sm-4 col-form-label">Status</label>
                    <div class="col-sm-8">
                        <select type="text" class="form-control form-control-sm" id="status" name="status" >
                            <?php
                            if ($jabatan == "Admin") {
                                ?>
                                <option value="aktif"> Aktif</option>
                                <?php
                            } elseif ($status == "aktif") {
                                ?>
                                <option value="aktif"> Aktif</option>
                                <option value="nonaktif"> Non aktif</option>  
                                <?php
                            }else{
                                ?>
                                <option value="nonaktif"> Non aktif</option>  
                                <option value="aktif"> Aktif</option>                                
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div> 
                    <small class="text-center text-red">Setting Akses Petugas </small>
                <div class="form-group row">
                    <label for="uname" class="col-sm-4 col-form-label">Usernama</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control form-control-sm" id="uname"  name="uname"placeholder="Username">
                        <input type="hidden" name="uname_lama"value="<?= $uname ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pass" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class=" form-control form-control-sm" id="pass" name="pass" placeholder="Password">
                        <input type="hidden" name="pass_lama"value="<?= $pass ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="akses" class="col-sm-4 col-form-label">Akses</label>
                    <div class="col-sm-8">
                        <select type="text" class="form-control form-control-sm" id="akses" name="akses" >
                            <?php
                            if ($jabatan == "Admin") {
                                ?>
                                <option value="Admin"> Admin</option>
                                <?php
                            } elseif ($jabatan == "Supervisor") {
                                ?>
                                <option value="Supervisor"> Supervisor</option>
                                <option value="Kasir"> Kasir</option> 
                                <?php
                            }else{
                                ?>
                                <option value="Kasir"> Kasir</option> 
                                <option value="Supervisor"> Supervisor</option>                                
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>           
            </div>
        </form>
        <div class="card-footer p-1">
            <button type="submit" class="btn btn-danger" onclick="edit_data_petugas()">Edit Data Petugas</button>
                <button type="submit" class="btn btn-default float-right" onclick="cancel_petugas()">Cancel</button>
            </div>
    </div>
</div>
<script>
    $(function () {
        $('#petugas').focus();
    });
    function edit_data_petugas() {
        $.ajax({
            url: '<?php echo site_url('Admin_master/update_petugas') ?>',
            type: 'POST',
            data: $('#data_edit_petugas').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert_pesan('info', data.pesan);
                    $('#search_petugas_by').val(data.nama);
                    search_petugas();
                } else {
                    alert_pesan('error', data.pesan);
                    $('#petugas').focus();
                }
            }
        });
    }
</script>