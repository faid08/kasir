<!DOCTYPE html>
<html lang="en">
    <?php
    if (isset($this->session->userdata['logged_in'])) {
        $toko = ($this->session->userdata['logged_in']['toko']);
    }else {
        header("location:login");
    }
    ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Sip-BOS</title>
        <link rel="shortcut icon" href="<?= site_url(); ?>vendor/dist/img/bos.png" />
        <link rel="stylesheet" href="<?= site_url(); ?>vendor/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?= site_url(); ?>vendor/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="<?= site_url(); ?>vendor/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <link rel="stylesheet" href="<?= site_url(); ?>vendor/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="<?= site_url(); ?>vendor/plugins/EasyAutocomplete/easy-autocomplete.min.css">
        <link rel="stylesheet" href="<?= site_url(); ?>vendor/plugins/EasyAutocomplete/easy-autocomplete.themes.min.css">
        <link rel="stylesheet" type="text/css" href="<?= site_url(); ?>vendor/plugins/jquery-ui/jquery-ui.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed text-sm">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-dark navbar-info">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block" id="nama_link">
                        <a href="#" class="nav-link">Home / <small> Dashboard</small></a>
                    </li>                    
                </ul>

                <ul class="navbar-nav ml-auto">                    
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" title="keluar"  href="<?php echo site_url('out') ?>"><i class="fas fa-times"></i></a>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar elevation-4 sidebar-light-info">
                <a href="#" class="brand-link navbar-info">
                    <img src="<?= site_url(); ?>vendor/dist/img/bos.png" alt="Sip-Bos" class="brand-image img-circle elevation-3"
                         style="opacity: .8">
                    <span class="brand-text font-weight-dark" style="color: white">Sip-BOS</span>
                </a>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="<?= site_url(); ?>vendor/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"><?= $nama_user?></a>
                            <a href="#" class="d-block"><?=$level.' '. $nama_toko?></a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column  nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="#" class="nav-link active" onclick="home()">
                                    <i class="nav-icon fas fa-envelope "></i>
                                    <p>
                                        Home
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link ">
                                    <i class="nav-icon fas fa-wrench"></i>
                                    <p>
                                        Master
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link " onclick="barang()">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>Entri Barang</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" onclick="marketing()">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>Entri Marketing</p>
                                        </a>
                                    </li>
                                    <li class="nav-item" onclick="customer()">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>Entri Customer</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" onclick="suplayer()">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>Entri Suplayer</p>
                                        </a>
                                    </li>
                                    <li class="nav-item" onclick="petugas()">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>Entri Petugas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link ">
                                    <i class="nav-icon fas fa-users mr-2"></i>
                                    <p>
                                        Transaksi
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" onclick="transaksi_penjualan()"class="nav-link">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>Penjualan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" onclick="transaksi_pembelian()">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>Pembelian</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link"onclick="nota_pending()">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Nota Pending
                                    </p>
                                </a>
                            </li>                           
                            <li class="nav-item has-treeview ">
                                <a href="#" class="nav-link ">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Laporan
                                        <i class="fas fa-angle-left right"></i>              
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link"onclick="piutang_customer()">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p> Piutang Customer</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link"onclick="omset()">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>Omset</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" onclick="income()">
                                            <i class="far fa-circle nav-icon text-info"></i>
                                            <p>Income</p>
                                        </a>
                                    </li>
                                    <!--                                    <li class="nav-item">
                                                                            <a href="../layout/fixed-topnav.html" class="nav-link active">
                                                                                <i class="far fa-circle nav-icon text-info"></i>
                                                                                <p>Pembelian</p>
                                                                            </a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a href="../layout/fixed-footer.html" class="nav-link">
                                                                                <i class="far fa-circle nav-icon text-info"></i>
                                                                                <p>Penjualan</p>
                                                                            </a>
                                                                        </li>-->
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link " onclick="alert_pesan('info','Dalam proses upgrade fitur !')">
                                    <i class="nav-icon fa fa-chart-pie "></i>
                                    <p>
                                        Grafik
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content-wrapper">
                <div class="content-header"></div>
                <section class="content">
                    <!--konten-->
                </section> 
            </div>
            <aside class="control-sidebar control-sidebar-dark">
            </aside>
        </div>
        <script src="<?= site_url(); ?>vendor/plugins/jquery/jquery.min.js"></script>
        <!--<script scr="vendor/jquery-2.1.1.js"></script>-->
        <script src="<?= site_url(); ?>vendor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= site_url(); ?>vendor/plugins/moment/moment.min.js"></script>
        <script src="<?= site_url(); ?>vendor/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
        <script src="<?= site_url(); ?>vendor/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="<?= site_url(); ?>vendor/plugins/sweetalert2/sweetalert2.min.js"></script>       
        <!--<script src="<?= site_url(); ?>vendor/plugins/select2/js/select2.full.min.js"></script>-->
        <script type="text/javascript" src="<?= site_url(); ?>vendor/plugins/jquery-ui/jquery-ui.js"></script>
        <script src="<?= site_url(); ?>vendor/dist/js/adminlte.js"></script>
        <!--<script src="<?= site_url(); ?>vendor/dist/js/demo.js"></script>-->

        <script src="<?= site_url(); ?>vendor/plugins/chart.js/Chart.min.js"></script>
        <!-- JS file -->
        <script src="<?= site_url(); ?>vendor/plugins/EasyAutocomplete/jquery.easy-autocomplete.min.js"></script>


    </body>
    <script type="text/javascript">
                                            $(function () {
                                                home();
                                            });
                                            function remove_add_class() {
                                                $('.nav-pills li a').click(function () {
                                                    $('.nav-pills li a').removeClass('active');
                                                    $(this).addClass('active');
                                                });
                                            }
                                            function home() {
                                                $.post('Home', function (Res) {
                                                    $('.content').html(Res);
                                                    $('#nama_link').html('<a href="#" class="nav-link">Home / <small> Dashboard</small></a>');
                                                    remove_add_class();
                                                });
                                            }
                                            function barang() {
                                                $.post('Barang', function (Res) {
                                                    $('.content').html(Res);
                                                    $('#nama_link').html('<a href="#" class="nav-link">Master / <small> Entri Barang</small></a>');
                                                    remove_add_class();
                                                });
                                            }
                                            function customer() {
                                                $.post('Customer', function (Res) {
                                                    $('.content').html(Res);
                                                    $('#nama_link').html('<a href="#" class="nav-link">Master / <small> Entri Customer</small></a>');
                                                    remove_add_class();
                                                });
                                            }
                                            function marketing() {
                                                $.post('Marketing', function (Res) {
                                                    $('.content').html(Res);
                                                    $('#nama_link').html('<a href="#" class="nav-link">Master / <small> Entri Marketing</small></a>');
                                                    remove_add_class();
                                                });
                                            }
                                            function suplayer() {
                                                $.post('Suplayer', function (Res) {
                                                    $('.content').html(Res);
                                                    $('#nama_link').html('<a href="#" class="nav-link">Master / <small> Entri Suplayer</small></a>');
                                                    remove_add_class();
                                                });
                                            }
                                            function petugas() {
                                                $.post('Petugas', function (Res) {
                                                    $('.content').html(Res);
                                                    $('#nama_link').html('<a href="#" class="nav-link">Master / <small> Entri Petugas</small></a>');
                                                    remove_add_class();
                                                });
                                            }
                                            function transaksi_penjualan() {
                                                $.post('Transaksi-Penjualan', function (Res) {
                                                    $('.content').html(Res);
                                                    $('#nama_link').html('<a href="#" class="nav-link">Transaksi / <small> Penjualan </small></a>');
                                                    remove_add_class();
                                                });
                                            }
                                            function transaksi_pembelian() {
                                                $.post('Transaksi-Pembelian', function (Res) {
                                                    $('.content').html(Res);
                                                    $('#nama_link').html('<a href="#" class="nav-link">Transaksi / <small> Pembelian </small></a>');
                                                    remove_add_class();
                                                });
                                            }
                                            function nota_pending() {
                                                $.post('Nota-Pending', function (Res) {
                                                    $('.content').html(Res);
                                                    $('#nama_link').html('<a href="#" class="nav-link">Nota Pending </a>');
                                                    remove_add_class();
                                                });
                                            }
                                            function piutang_customer() {
                                                $.post('Piutang-Customer', function (Res) {
                                                    $('.content').html(Res);
                                                    $('#nama_link').html('<a href="#" class="nav-link">Laporan / <small> Piutang Customer </small></a>');
                                                    remove_add_class();
                                                });
                                            }
                                            function omset() {
                                                $.post('Laporan-Omset', function (Res) {
                                                    $('.content').html(Res);
                                                    $('#nama_link').html('<a href="#" class="nav-link">Laporan / <small> Omset </small></a>');
                                                    remove_add_class();
                                                });
                                            }
                                            function income() {
                                                $.post('Laporan-Income', function (Res) {
                                                    $('.content').html(Res);
                                                    $('#nama_link').html('<a href="#" class="nav-link">Laporan / <small> Income </small></a>');
                                                    remove_add_class();
                                                });
                                            }
                                            function rp(angkanya) {
                                                var rupiah = new Intl.NumberFormat(['ban', 'id']).format(angkanya);
                                                return rupiah;
                                            }
                                            function alert_pesan(statusnya, pesannya) {
                                                const Toast = Swal.mixin({
                                                    toast: true,
                                                    position: 'top-end',
                                                    showConfirmButton: false,
                                                    timer: 3500
                                                });
                                                Toast.fire({
                                                    type: statusnya,
                                                    title: pesannya
                                                });
                                            }
    </script>
</html>
