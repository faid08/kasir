<html lang="en">
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
    <body class="hold-transition layout-top-nav text-sm">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand-md navbar-dark navbar-danger border-bottom-0 p-0">
                <div class="container ">
                    <a href="#" class="navbar-brand navbar-light navbar-white" style="width: 24%">
                        &nbsp;&nbsp;<img src="<?= site_url(); ?>vendor/dist/img/bos.png" alt="Sip-Bos" class="brand-image img-circle elevation-3"
                                         style="opacity: .8">
                        <span class="brand-text font-weight-dark " style="color: #000">&nbsp;<b>Sip-BOS</b>&nbsp;<small class="text-uppercase text-sm" >Toko Ali 1&nbsp;&nbsp;&nbsp;</small></span>
                    </a>
                    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                        <!-- Left navbar links -->
                        <ul class="navbar-nav">
                            <li class="nav-item ">
                                <a href="#" class="nav-link " onclick="kasir_transaksi_penjualan();">Transaksi Penjualan</a>
                            </li> 
                            <li class="nav-item ">
                                <a href="#" class="nav-link "> Stock Barang</a>
                            </li>     
                            <li class="nav-item dropdown">
                                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Report</a>
                                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                    <li><a href="#" class="dropdown-item">Nota Pending </a></li>
                                    <li><a href="#" class="dropdown-item">History</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <!-- Right navbar links -->
                    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Laka</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="#" class="dropdown-item">Some action </a></li>
                                <li><a href="#" class="dropdown-item">Some other action</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" title="keluar"  href="#">Petugas Kasir Toko</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" title="keluar"  href="<?php echo site_url('out') ?>"><i class="fas fa-times"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="content-wrapper content">
            </div>            
        </div>
        <script src="<?= site_url(); ?>vendor/plugins/jquery/jquery.min.js"></script>
       <!--<script scr="vendor/jquery-2.1.1.js"></script>-->
        <script src="<?= site_url(); ?>vendor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= site_url(); ?>vendor/plugins/moment/moment.min.js"></script>
        <script src="<?= site_url(); ?>vendor/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
        <script src="<?= site_url(); ?>vendor/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="<?= site_url(); ?>vendor/plugins/sweetalert2/sweetalert2.min.js"></script>  
        <script type="text/javascript" src="<?= site_url(); ?>vendor/plugins/jquery-ui/jquery-ui.js"></script>
        <script src="<?= site_url(); ?>vendor/dist/js/adminlte.js"></script>
        <script src="<?= site_url(); ?>vendor/plugins/EasyAutocomplete/jquery.easy-autocomplete.min.js"></script>
    </body>
    <script type="text/javascript" >
                                    $(function () {
                                        kasir_transaksi_penjualan();
                                    });
                                    function remove_add_class() {
                                        $('.nav-item li a').click(function () {
                                            $('.nav-item li a').removeClass('active');
                                            $(this).addClass('active');
                                        });
                                    }
                                    function kasir_transaksi_penjualan() {
                                        $.post('<?= site_url('Kasir_dashboard/transaksi_penjualan') ?>', function (Res) {
                                            $('.content').html(Res);
                                            remove_add_class();
                                        });
                                    }
    </script>
</html>
