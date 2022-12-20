<div class="content-header">                    
</div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="card card-dark card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="<?= site_url(); ?>vendor/dist/img/bos.png"
                                 alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= $nama ?></h3>

                        <p class="text-muted text-center">Petugas <?= $level . ' ' . $nama_toko ?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Username</b> <a class="float-right"><?= $uname ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Status</b> <a class="float-right"><?= $status ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>No. Handphone</b> <a class="float-right"><?= $hp ?></a>
                            </li>
                        </ul>


                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card card-dark card-outline">

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
                                <div class="form-group row ">
                                    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                                    <div class="col-sm-8">                                    
                                        <textarea class=" form-control form-control-sm" id="alamat" name="alamat" placeholder="Alamat"><?= $alamat ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label for="hp" class="col-sm-4 col-form-label">Handphone</label>
                                    <div class="col-sm-4">
                                        <input type="number" class=" form-control form-control-sm" id="hp" name="hp" placeholder=" Handphone"value="<?= $hp ?>">
                                    </div>                    
                                </div>
                                <small class="text-center text-red">Setting Akun Akses Anda ! </small>
                                <div class="form-group row">
                                    <label for="uname" class="col-sm-4 col-form-label">Usernama</label>
                                    <div class="col-sm-8">
                                        <input type="text" class=" form-control form-control-sm" id="uname"  name="uname"placeholder="Entri username baru jika ingin diubah">
                                        <input type="hidden" name="uname_lama"value="<?= $uname ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pass" class="col-sm-4 col-form-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class=" form-control form-control-sm" id="pass" name="pass" placeholder="Entri password baru jika ingin diubah ">
                                        <input type="hidden" name="pass_lama"value="<?= $pass ?>">
                                    </div>
                                </div>                                         
                            </div>
                        </form>
                        <div class="card-footer p-2">
                            <button type="submit" class="btn btn-warning" onclick="edit_data_petugas()">Edit Akun Anda</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#petugas').focus();
    });
    function edit_data_petugas() {
        $.ajax({
            url: '<?php echo site_url('Kasir_dashboard/update_petugas') ?>',
            type: 'POST',
            data: $('#data_edit_petugas').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert_pesan('info', data.pesan);
                    $('#search_petugas_by').val(data.nama);
                    kasir_profil();
                } else {
                    alert_pesan('error', data.pesan);
                    $('#petugas').focus();
                }
            }
        });
    }
</script>
