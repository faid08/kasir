<!DOCTYPE html>
<html>
     <?php
    if (isset($this->session->userdata['logged_in'])) {
        header("location:admin");
    }
    ?>
    <head>
        <!--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
        <title>Sip-BOS</title>
        <link rel="shortcut icon" href="vendor/dist/img/bos.png" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?= site_url();?>assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= site_url();?>assets/bootstrap/fonts/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="<?= site_url();?>assets/css/ionicons.css">
        <link rel="stylesheet" href="<?= site_url();?>assets/dist/css/AdminLTE.min.css">
        <script src="<?= site_url();?>assets/dist/js/jquery-3.1.0.min.js"></script>
        <script src="<?= site_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <style type="text/css">
            .panel-footer{padding-top: 0; padding-bottom:0;}
            .small-box{margin-bottom: 0;border: none;}
            #h1{font-family: Calibri;padding: 0;margin: 15px 0 0;font-size: 18px;}
            #h2{font-family: Calibri;padding: 0;margin: 0 0 15px;font-size: 30px;font-weight: bold;}
        </style>
    </head>
    <body class="hold-transition login-page" style="height: auto;">
        <div class="login-box ">
            <div class="panel panel-success">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h4 id="h1">Sip - <b>BOS</b></h4>
                        <h4 id="h2">Aplikasi Penjualan</h4>
                    </div>
                    <div class="icon">
                        <i class="fa fa-line-chart"></i>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="login-box-body text-center">
                            <form id="form_login">
                                <div class="form-group has-feedback">
                                    <input type="text" name="username" id="username" class="form-control " placeholder="Username" required="" style="font-family: Calibri">
                                    <span class="fa fa-user form-control-feedback" autofocus></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="" style="font-family: Calibri">
                                    <span class="ion-android-lock form-control-feedback"></span>
                                </div>
                                <div class="form-group" style="text-align: right;">
                                    <input type="button" value="Masuk" id="masuk" class="btn btn-primary btn-sm btn-flat" style="margin-right: 0px;font-family: Calibri" />
                                    <input id="batal" type="button" value="Batal" class="btn btn-default btn-sm btn-flat" style="margin-right: 0px;font-family: Calibri"/>
                                </div>
                                <div class="alert alert-danger" id="tampil_pesan" style="display: none;padding: 5px;margin-bottom: 0;"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var username, password, dataAkun, baseUrl_admin = "<?= site_url('admin'); ?>", baseUrl_kasir = "<?= site_url('kasir'); ?>";
            function tampil_pesan(teks){
                $("#tampil_pesan").html(teks);
                $("#tampil_pesan").fadeIn(2000);
                $("#tampil_pesan").fadeOut(1500);
            }
            $(document).ready(function () {
                $("#username").focus();
                 $("#username").keypress(function (e) {
                    keyCode = e.keyCode ? e.keyCode : e.which;
                    if (keyCode === 13) {
                        $("#password").focus();
                    }
                });
                $("#password").keypress(function (e) {
                    keyCode = e.keyCode ? e.keyCode : e.which;
                    if (keyCode === 13) {
                        $("#masuk").click();
                    }
                });
                $("#batal").click(function (e) {
                    $("#username").val("").focus();
                    $("#password").val("");
                    $("#tampil_pesan").fadeOut(1500);
                });
                $("#masuk").click(function (e) {
                    username = $("#username").val();
                    password = $("#password").val();
                    if (username === "") {
                        tampil_pesan("<i class='glyphicon glyphicon-alert'></i> Username tidak boleh kosong.");
                        $("#username").focus();
                    } else if (password === "") {
                        tampil_pesan("<i class='glyphicon glyphicon-alert'></i> Password tidak boleh kosong.");
                        $("#password").focus();
                    } else {
                        $.ajax({
                            type: "POST", url: "proses_login",
                            data: {username: username, password: password}, 
                            dataType: 'json',
                            success: function (data) {
                                if (data.pesan === "sukses") {
                                    if (data.level === "Kasir") {
                                        setTimeout(function () {
                                            window.location.href = baseUrl_kasir;
                                        }, 2);
                                    } else {
                                        setTimeout(function () {
                                            window.location.href = baseUrl_admin;
                                        }, 2);
                                    };
                                } else {
                                    tampil_pesan(data.pesan);
                                    $("#username").val("").focus();
                                    $("#password").val("");
                                }
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>