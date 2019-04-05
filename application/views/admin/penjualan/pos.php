<!-- JQUERY CORE -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- JQUERY UI -->
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<!-- CHART JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>

<!-- Function -->
<?php 
function formatRP($angka){
 $jadi = number_format($angka,0,',','.');
 return $jadi;
}

?>

<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    
    <title><?php echo $title ?></title>
    
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/base/assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/base/assets/images/favicon.ico">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/base/assets/css//site.min.css">
    
    <!-- Plugins -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/flag-icon-css/flag-icon.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/owl-carousel/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/slick-carousel/slick.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/base/assets/examples/css/uikit/carousel.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/asscrollable/asScrollable.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/base/assets/examples/css/advanced/scrollable.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/select2/select2.css">
    
    <!-- Fonts -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    
    <!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>assets/global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
    
    <!--[if lt IE 10]>
    <script src="<?php echo base_url(); ?>assets/global/vendor/media-match/media.match.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/respond/respond.min.js"></script>
    <![endif]-->
    
    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/global/vendor/breakpoints/breakpoints.js"></script>
    <script>
      Breakpoints();
    </script>
  </head>
  <body class="animsition">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    
      <div class="navbar-header" >
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
          data-toggle="collapse">
          <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
          <img class="navbar-brand-logo" src="<?php echo base_url(); ?>assets/base/assets/images/logo.png" title="Remark">
          <span class="navbar-brand-text hidden-xs-down"> Remark</span>
        </div>
      </div>
    
      <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
          <!-- Navbar Toolbar -->
          <ul class="nav navbar-toolbar">
            <li class="nav-item hidden-sm-down" id="toggleFullscreen">
              <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                <span class="sr-only">Toggle fullscreen</span>
              </a>
            </li>
          </ul>
          <!-- End Navbar Toolbar -->
    
          <!-- Navbar Toolbar Right -->
          <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
            <li>
              <a class="nav-link">
                Hello, <?php echo $this->session->userdata('nama'); ?>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link"  href="<?php echo base_url(); ?>dashboard" title="Home" role="button">
                <i class="wb-home" aria-hidden="true"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Penjulan Hari ini."
                aria-expanded="false" data-animation="scale-up" role="button">
                <i class="wb-shopping-cart" aria-hidden="true"></i>
                <!-- <span class="badge badge-pill badge-danger up">5</span> -->
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                <div class="dropdown-menu-header">
                  <h5>Penjualan Hari ini</h5>
                  <span class="badge badge-round badge-danger"><?php echo $transaksi->transaksi ?> Transaksi</span>
                </div>
    
                <div class="list-group">
                  <div data-role="container">
                    <div data-role="content">
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon wb-order bg-red-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Item terjual</h6>
                            <time class="media-meta" datetime="2018-06-12T20:50:48+08:00"><?php echo $todaysale->item ?> jenis item</time>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon wb-user bg-green-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Quantity terjual</h6>
                            <time class="media-meta" datetime="2018-06-11T18:29:20+08:00"><?php echo $todaysale->qty ?> buah barang</time>
                          </div>
                        </div>
                      </a>
                      <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                        <div class="media">
                          <div class="pr-10">
                            <i class="icon wb-settings bg-red-600 white icon-circle" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <h6 class="media-heading">Total Cash</h6>
                            <time class="media-meta" datetime="2018-06-11T14:05:00+08:00">Rp. <?php echo formatRP($transaksi->total) ?></time>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="dropdown-menu-footer">
                  <!-- <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                    <i class="icon wb-settings" aria-hidden="true"></i>
                  </a> -->
                  <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                    Terimakasih kerja kerasmu kawan.
                  </a>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                data-animation="scale-up" role="button">
                <span class="avatar avatar-online">
                  <img src="<?php echo base_url(); ?>assets/global/portraits/5.jpg" alt="...">
                  <i></i>
                </span>
              </a>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="<?php echo base_url(); ?>profil" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Profile</a>
                <!-- <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-payment" aria-hidden="true"></i> Billing</a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i> Settings</a> -->
                <div class="dropdown-divider" role="presentation"></div>
                <a class="dropdown-item" href="<?php echo base_url(); ?>user/logout" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
              </div>
            </li>
          </ul>
          <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->
      </div>
    </nav>
    <!-- Page -->
    <div class="page" style="margin-left: 0">
<!--       <div class="page-header">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
          <li class="breadcrumb-item active">Basic UI</li>
        </ol>
        <h1 class="page-title">Carousel</h1>
        <div class="page-header-actions">
          <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-toggle="tooltip"
            data-original-title="Edit">
            <i class="icon wb-pencil" aria-hidden="true"></i>
          </button>
          <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-toggle="tooltip"
            data-original-title="Refresh">
            <i class="icon wb-refresh" aria-hidden="true"></i>
          </button>
          <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-toggle="tooltip"
            data-original-title="Setting">
            <i class="icon wb-settings" aria-hidden="true"></i>
          </button>
        </div>
      </div> -->

      <div class="page-content">
        <!-- Panel Carousel -->
        <div class="panel">
          <div class="panel-body container-fluid">
            <div class="row row-lg">
              <div class="col-lg-3">
                <div class="form-group">
                  <button onclick="addPelanggan();" href="javascript:void(0);" type="button" class="btn btn-icon btn-block btn-primary btn-outline"><i class="icon wb-plus" aria-hidden="true"></i> Tambah Pelanggan</button>
                </div>
                <div class="panel panel-bordered panel-primary card border border-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title"><i class="icon wb-user" aria-hidden="true"></i>Informasi Pelanggan</h3>
                  </div>
                  <div class="panel-body container-fluid">
                    <!-- <form autocomplete="off" id="form" class="formmodaltambah"> -->
                  <!-- <div class="panel-body ">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer
                    nec odio. Praesent libero. Sed cursus ante dapibus diam.</div> -->
                    <div class="form-group form-material " data-plugin="formMaterial">
                      <span class="text-danger" id="error_pelanggan"></span>
                      <label class="form-control-label" for="inputText">Pelanggan</label>
                      <div class="input-group">
                        <div class="form-control-wrap">
                          <input type="text" class="form-control idpelanggan" id="idpelanggan" name="inputText" placeholder="Ketikan nama pelanggan" />
                          <!-- <select class="form-control idpelanggan" data-plugin="select2" id="idpelanggan" data-placeholder="Pilih Pelanggan"
                            data-allow-clear="true" name="idpelanggan">
                              <option></option> 
                              <?php foreach ($pelanggans as $ps) { ?>
                                 <option value="<?php echo $ps->id; ?>"><?php echo $ps->nama; ?></option>
                              <?php } ?>
                          </select> -->
                        </div>
                      </div>
                    </div>
                    <?php echo validation_errors(); ?>
                    <div class="form-group form-material " data-plugin="formMaterial">
                      <div class="form-control-wrap">
                        <label class="form-control-label" for="inputText">Telepon</label>
                        <input type="text" class="form-control" id="tel_pelanggan" name="inputText" placeholder="+628x xxxx xxxx" />
                      </div>
                    </div>
                    <div class="form-group form-material " data-plugin="formMaterial">
                      <div class="form-control-wrap">
                        <label class="form-control-label" for="inputText">Email</label>
                        <input type="text" class="form-control" id="email_pelanggan" name="inputText" placeholder="email@gmail.com" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-9">
                <?php
                  $alert_msg = $this->session->flashdata('alert_msg');
                  if (!empty($alert_msg)) {
                    $flash_status = $alert_msg[0];
                    $flash_header = $alert_msg[1];
                    $flash_desc = $alert_msg[2];

                    if ($flash_status == 'failure') {
                      ?>
                      <div class="alert alert-alt alert-danger alert-dismissible" style="text-align: left;" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <?php echo $flash_header; ?><br><a class="alert-link" style="margin-left: 0" href="javascript:void(0)"><?php echo $flash_desc; ?></a>
                      </div>
                      <?php 
                    }
                    if ($flash_status == 'success') {
                      ?>
                      <div class="alert alert-alt alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <?php echo $flash_header; ?>, <a class="alert-link" style="margin-left: 0" href="javascript:void(0)"><?php echo $flash_desc; ?></a>
                      </div>
                      <?php
                    }
                  }
                  ?>

                <i class="icon wb-shopping-cart" aria-hidden="true"></i> Penjualan > Transaksi
                <form autocomplete="off" id="form" class="formmodaltambah">
                  <div class="table-responsive">
                    <table class="table table-hover" id="cart">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama Barang</th>
                          <!-- <th style="width: 17%">Kode Barang</th> -->
                          <th style="width: 10%">Harga</th>
                          <th style="width: 7%">Stock</th>
                          <th style="width: 7%">Qty</th>
                          <th style="width: 17%">Sub Total</th>
                          <th class="text-nowrap">&nbsp;</th>
                        </tr>
                        <tbody>
                          <!-- Dynamic -->

                          <tr>
                            <td></td>
                            <td>Biaya jasa servis</td>
                            <td></td>
                            <td></td>
                            <td>1</td>
                            <td>
                              <input type="text" id="biayajasa" name="biayajasa" class="form-control hitungTotal" value="0">
                            </td>
                          </tr>
                        </tbody>
                      </thead>
                    </table>
                  </div>
                  <div class="panel panel-bordered panel-default">
                    <div class="panel-heading">
                      <div class="panel-title">
                        <div class="row">
                          <div class="col-md-6">
                            <button type="button" class="btn btn-info" id="tambah"><i class="icon wb-plus" aria-hidden="true"></i> Baris Baru (F7)</button>
                          </div>
                          <div class="col-md-6 text-right">
                            <h2><b>Total : Rp <span class="tampilTotalBeli"></span></b></h2>  
                            <input id="rupiah" type="hidden" name="total_pembelian" class="form-control">
                            <input id="rupiah" type="hidden" name="total_keuntungan" class="form-control">
                            <!-- input id pelanggan -->
                            <input id="pelanggan" type="hidden" name="pelanggan" class="form-control">
                            <input id="iddiskon" type="hidden" name="iddiskon" class="form-control">
                            <input id="nominaldiskon" type="hidden" name="nominaldiskon" class="form-control">
                            <input id="nominaljasa" type="hidden" name="nominaljasa" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class=""> -->
                    <div class="panel-heading clearfix">
                      <div class="row">
                        <div class="col-md-6">
                          <!-- Example Textarea -->
                          <div class="example-wrap">
                            <textarea class="form-control" name="catatan" id="textareaDefault" placeholder="Catatan Transaksi (jika ada)." rows="3"></textarea>
                          </div>
                          <!-- End Example Textarea -->
                        </div>
                        <div class="col-md-6 text-right">
                          <div class="row">
                            <div class="col-md-12">
                              <table style="float: right;">
                                <tr>
                                  <th><label class="form-control-label" for="inputText"><b>Voucher</b></label></th>
                                  <th>
                                    <span class="text-danger" id="error_diskon"></span>
                                    <input type="text" class="form-control diskon" id="diskon" name="diskon" value="" placeholder="Ketikkan kode voucher" /></th>
                                </tr>
                                <tr>
                                  <th><label class="form-control-label" for="inputText"><b>Bayar</b></label></th>
                                  <th>
                                    <span class="text-danger" id="error_bayar"></span>
                                    <input type="text" class="form-control kembalian" id="inputText" name="bayar"/></th>
                                </tr>
                                <tr>
                                  <th><label class="form-control-label"><b>Kembali</b></label></th>
                                  <th><input type="text" class="form-control tampilkembalian" disabled="disabled" /></th>
                                  <input type="hidden" class="form-control" name="kembaliannya" />
                                </tr>
                                </tr>
                              </table>
                            </div>
                            <div class="col-md-12">
                              <br><br>
                              <!-- <button type="button" class="btn btn-warning"><i class="icon wb-print" aria-hidden="true"></i> Cetak (F8)</button> -->
                              <button onclick="save()" href="javascript:void(0);" type="button" class="btn btn-primary"><i class="icon wb-add-file" aria-hidden="true"></i> Simpan (F8)</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- End Panel -->
      </div>
    <!-- End Page -->


    <!-- Footer -->
    <footer class="site-footer" style="margin-left: 0">
      <div class="site-footer-legal">© 2018 <a href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202">Remark</a></div>
      <div class="site-footer-right">
        Crafted with <i class="red-600 wb wb-heart"></i> by <a href="https://themeforest.net/user/creation-studio">Creation Studio</a>
      </div>
    </footer>
    <!-- Core  -->
    <script src="<?php echo base_url(); ?>assets/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/jquery/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/popper-js/umd/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/bootstrap/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/animsition/animsition.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/mousewheel/jquery.mousewheel.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/asscrollable/jquery-asScrollable.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
    
    <!-- Plugins -->
    <script src="<?php echo base_url(); ?>assets/global/vendor/switchery/switchery.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/intro-js/intro.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/screenfull/screenfull.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/vendor/slidepanel/jquery-slidePanel.js"></script>
        <script src="<?php echo base_url(); ?>assets/global/vendor/owl-carousel/owl.carousel.js"></script>
        <script src="<?php echo base_url(); ?>assets/global/vendor/slick-carousel/slick.js"></script>
        <script src="<?php echo base_url(); ?>assets/global/vendor/select2/select2.full.min.js"></script>
    
    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/global/js/Component.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/Plugin.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/Base.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/Config.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/base/assets/js/Section/Menubar.js"></script>
    <script src="<?php echo base_url(); ?>assets/base/assets/js/Section/GridMenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/base/assets/js/Section/Sidebar.js"></script>
    <script src="<?php echo base_url(); ?>assets/base/assets/js/Section/PageAside.js"></script>
    <script src="<?php echo base_url(); ?>assets/base/assets/js/Plugin/menu.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/global/js/config/colors.js"></script>
    <script src="<?php echo base_url(); ?>assets/base/assets/js/config/tour.js"></script>
    <script>Config.set('assets', '<?php echo base_url(); ?>assets/base/assets');</script>
    
    <!-- Page -->
    <script src="<?php echo base_url(); ?>assets/base/assets/js/Site.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/Plugin/asscrollable.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/Plugin/slidepanel.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/Plugin/switchery.js"></script>
        <script src="<?php echo base_url(); ?>assets/global/js/Plugin/owl-carousel.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/base/assets/examples/js/uikit/carousel.js"></script>
        <script src="<?php echo base_url(); ?>assets/global/js/Plugin/asscrollable.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/base/assets/examples/js/advanced/scrollable.js"></script>
        <!-- select 2 -->
        <script src="<?php echo base_url(); ?>assets/global/js/Plugin/select2.js"></script>
        <!-- <script src="<?php echo base_url(); ?>assets/base/assets/examples/js/forms/advanced.js"></script> -->
  </body>
</html>

<!-- Template digunakan untuk membuat input field -->
<template id="order-cart">
  <!-- #id# supaya membuat identik, sehingga value dapat diambil -->
  <tr data-row-id="#id#">
    <!-- Kode Ice Cream -->
    <td>#id#</td>
    <input type ="hidden" name = "order[#id#][id_produk]" class=""  id="id#id#">
    <!-- Nama Ice Cream -->
    <td>
      <input type ="text" name = "order[#id#][nama_produk]" class="form-control" id="autocomplete#id#" 
      placeholder = "Ketikan Nama Barang ..." autocomplete = "off">
      <!-- Autocomplete dibikin off supaya gak rese', karna kalau on suka keluar angka dari rekomendasi -->
    </td>
    <!-- <td> -->
      <!-- <input type ="text" name = "order[#id#][kode_produk]" class="form-control" disabled="disabled" id="kode_produk#id#" > -->
      <!-- Autocomplete dibikin off supaya gak rese', karna kalau on suka keluar angka dari rekomendasi -->
    <!-- </td> -->
    <td>
      <input type ="text" name = "order[#id#][harga_jual]" class="form-control" disabled="disabled" id="harga_jual#id#" >
      <input type ="hidden" name = "order[#id#][harga_produk]" class="form-control" disabled="disabled" id="harga_produk#id#" >
      <input type ="hidden" name = "order[#id#][het_produk]" class="form-control" disabled="disabled" id="het_produk#id#" >
    </td>
    <td>
      <input type ="text" name = "order[#id#][stock_produk]" class="form-control" disabled="disabled" id="stock_produk#id#" >
    </td>
    <td>
      <input type ="text" name = "order[#id#][quantity]" class="form-control" id="quantity#id#">
    </td>
    <td>
      <input type ="text" name = "order[#id#][sub_total]" class="form-control hitungTotal" id="sub_total#id#" >
      <input type ="hidden" name = "order[#id#][keuntungan]" class="form-control keuntungan" id="keuntungan#id#" >
    </td>
    <td>
      <button type="button" class="btn btn-sm btn-icon btn-flat btn-danger delete" data-id="#id#"><i class="wb-close"></i></button>
    </td>
  </tr>
</template>

<!-- Modal -->
<div class="modal fade modal-fade-in-scale-up" id="exampleNiftyFadeScale" aria-hidden="true"
  aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-simple">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">Form Tambah Pelanggan</h4>
      </div>
      <div class="modal-body">
        <form autocomplete="off" id="formpelanggan">
          <input type="hidden" name="id">
          <div class="form-group form-material floating" data-plugin="formMaterial">
            <input type="text" class="form-control" name="nama" data-hint="Masukkan nama pelanggan"
            />
            <label class="floating-label">Nama Lengkap</label>
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            <input type="email" class="form-control" name="email" data-hint="Masukkan e-mail pelanggan"
            />
            <label class="floating-label">E-mail</label>
          </div>
          <div class="form-group form-material" data-plugin="formMaterial">
            <label class="form-control-label" for="inputAddons">Telepon</label>
            <div class="input-group">
              <span class="input-group-addon">+62</span>
              <div class="form-control-wrap">
                <input type="text" name="telepon" class="form-control" id="inputPhone2" data-plugin="formatter"
                data-pattern=" [[999]]-[[9999]]-[[9999]]" />
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnSave" onclick="savePelanggan()" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->

<!-- JQUERY UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
  (function($) {
    function to_rupiah(angka){
      var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
      var rev2    = '';
      for(var i = 0; i < rev.length; i++){
        rev2  += rev[i];
        if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
          rev2 += '.';
        }
      }
      return rev2.split('').reverse().join('');
    } 

    //fungsi untuk mendelay event keyup agar request ke server tidak per ketikan keyboard
    var delay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

    //fungsi untuk menampilkan uang kembalian
    $(document).on('keyup', '.kembalian', function(e){
          // kembalian()
          delay(function (){
            harusbayar = $('input[name=total_pembelian]').val()
            bayar = $('.kembalian').val()
            diskon = $('.diskon').val()

            if (diskon) {
              kembali = parseInt(bayar)-(parseInt(harusbayar)-parseInt(diskon))
            }else{
              kembali = parseInt(bayar)-parseInt(harusbayar)
            }

            // console.log(parseInt(harusbayar));

            $('input[name=kembaliannya]').val(kembali)
            $('.tampilkembalian').val(to_rupiah(kembali))

          },1000);
    });


    $(document).on('click',"#idpelanggan",function(e){
      // console.log("sukses")

      $('#idpelanggan').autocomplete({
        minLength:1,
        source:function(request, result) {
          $.ajax({
            url: '<?php echo site_url('penjualan/autocomplete') ?>',
            dataType: "json",
            data: 'cari=' + request.term,
            success: function(data) {
              result($.map(data, function(item){
                return {
                  label: item.nama,
                  value: item.id,
                  data: item
                }
              }));
            },
            error: function(e){
              alert('Error: ' + request);
            }
          });
        },
        select: function( event, ui ) {
            // console.log(ui)
            $('#idpelanggan').val(ui.item.data.nama);
            $('#pelanggan').val(ui.item.data.id);
            $("#tel_pelanggan").val(ui.item.data.telepon);
            $("#email_pelanggan").val(ui.item.data.email);
            return false;
          },
        });
    })

    $(document).on('click',"#diskon",function(e){
      // console.log("sukses")

      $('#diskon').autocomplete({
        minLength:1,
        source:function(request, result) {
          $.ajax({
            url: '<?php echo site_url('penjualan/autocompletediskon') ?>',
            dataType: "json",
            data: 'cari=' + request.term,
            success: function(data) {
              result($.map(data, function(item){
                return {
                  label: item.card_number,
                  value: item.id,
                  data: item
                }
              }));
            },
            error: function(e){
              alert('Error: ' + request);
            }
          });
        },
        select: function( event, ui ) {
            // console.log(ui)
            $('#iddiskon').val(ui.item.data.id);
            $('#diskon').val(ui.item.data.value);
            $('#nominaldiskon').val(ui.item.data.value);
            return false;
          },
        });
    })


    var template = $('#order-cart').html()

    // Ambil Template HTML DARI Id product-cart
    // Function untuk tambah baris tabel
    function tambahBaris(){
      var currentId = $('#cart tbody tr:last-child').data('row-id') || 0
      // Ambil Nomor ID, Jika tidak ada diganti dengan 0
      $('#cart tbody').append(template.replace(/#id#/g, currentId + 1))
      // Fungsi Append buat menambah element, dari template tadi dan diganti #id# dengan currentID
      $('body').on('keyup','#quantity'+ (currentId + 1), function(){
        delay(function (){
          var qty = $('#quantity'+ (currentId + 1)).val() 
          var hargaJual = $('#harga_jual'+ (currentId + 1)).val()
          var subTotal  = qty * hargaJual
          $('#sub_total'+(currentId + 1)).val(subTotal)
          hitungTotal()

          var hargaProduk = $('#harga_produk'+ (currentId + 1)).val() * ((100 - $('#het_produk'+ (currentId + 1)).val()) / 100)
          var untung = hargaJual - hargaProduk 

          var keuntungan  = (qty * untung)

          $('#keuntungan'+(currentId + 1)).val(keuntungan)

          hitungTotalKeuntungan()

          // console.log(keuntungan)
          // console.log($('.tampilTotalBeli').html())
        },500);
      })

      ///fungsi auto complete
      $('body').on('click',"#autocomplete"+ (currentId + 1), function(){
        $("#autocomplete"+ (currentId + 1)).autocomplete({    
          minLength:1,
          source:function( request, result ) {
            $.ajax({
              url: '<?php echo site_url('penjualan/autocompleteproduk') ?>',
              dataType: "json",
              data: 'cari=' + request.term,
              success: function( data ) {
                result($.map(data, function (item) {
                  return {
                    label: item.search,
                    value: item.id,
                    data: item
                  };
                }));
              },
              error: function(e){  
                alert('Error: ' + request);  
              }  
            });
          },
          // appendTo : "#exampleNiftyFadeScale",
          select: function( event, ui ) {
            // console.log(ui)
            $('#harga_produk' + (currentId + 1)).val(ui.item.data.price);
            $('#harga_jual' + (currentId + 1)).val(ui.item.data.harga_jual);
            $('#id' + (currentId + 1)).val(ui.item.data.id);
            $("#autocomplete" + (currentId + 1)).val(ui.item.data.search);
            $("#het_produk" + (currentId + 1)).val(ui.item.data.het_bengkel);
            $("#stock_produk" + (currentId + 1)).val(ui.item.data.stock);

            // reset input text
            $('#sub_total'+(currentId + 1)).val('0')
            $('#quantity'+(currentId + 1)).val('')
            // end reset input text

            return false;
          },
        });

        $("#autocomplete"+ (currentId + 1)).autocomplete("option" , "appendTo", ".formmodaltambah")

      })

      // validasi input qty pembelian

      $('body').on('input',"#quantity"+ (currentId + 1), function(){
         stoknya = $("#stock_produk" + (currentId + 1)).val()
         qtybelinya = $("#quantity" + (currentId + 1)).val()
         sisanya = $("#stock_produk" + (currentId + 1)).val() - $("#quantity" + (currentId + 1)).val()

         if (sisanya < 0) {
          alert('Jumlah pembelian barang tidak boleh melebihi stok !!!')
         }
      })

      $('#sub_total'+ (currentId+1)).val(0)
      hitungTotal()   
    }

    // nambah baris 
    tambahBaris()

    // EVENT KLIK TOMBOL
    $('#tambah').on('click', function (e) {
      tambahBaris()
    })
    
    // DELETE
    $('body').on('click', '.delete', function (e) {
      $(this).parents('tr').remove()
      hitungTotal()
      hitungTotalKeuntungan()
    })

    $(document).on('keydown', 'body', function(e){
      var charCode = ( e.which ) ? e.which : event.keyCode;
      if(charCode == 118) //F7
      {
        tambahBaris();
        return false;
      }
    });

    function hitungTotal(){
      var total = 0
      $('.hitungTotal').each(function(){
        var totals = $(this).val()
        total = parseInt(total) + parseInt(totals)
        $('input[name=total_pembelian]').val(total)
        $('.tampilTotalBeli').html(to_rupiah(total))
      })
    }

    function hitungTotalKeuntungan(){
      var total = 0
      $('.keuntungan').each(function(){
        var totals = $(this).val()
        total = parseInt(total) + parseInt(totals)
        $('input[name=total_keuntungan]').val(total)
      })

    }

     $(document).on('keyup', '#biayajasa', function(e){
          // kembalian()
          hitungTotal()      
    });

  })(jQuery)

  function save()
  {
    // $('[name="nipy"]').removeAttr("disabled");
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('penjualan/addPenjualan')?>";

    $("#error_bayar").html('');
    $("#error_diskon").html('');

    // ajax adding data to database

    var formData = new FormData($('#form')[0]);
    $.ajax({
      url : url,
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {

        // var hasil = JSON.parse(data);

            if (data.hasil !== "sukses") {
                // tampilkan pesan error
                $("#error_bayar").html(data.error.bayar);
                $("#error_diskon").html(data.error.diskon);
            } else {
                // do something, misalnya menampilkan berhasil
                // $("#pesan").html("<div class=\"alert alert-success\">Data berhasil disimpan !</div>");
                // kosongkan lagi error form
                location.reload();
                // $("#error_bayar").val('');
                // $("#error_pelanggan").val('');
                
            }


          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            location.reload();
            // alert('Error adding / update data');
            // $('#btnSave').text('save'); //change button text
            // $('#btnSave').attr('disabled',false); //set button enable 

          }
        });
  }

  function addPelanggan()
    {
        // save_method = 'add';
        $('#formpelanggan')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#exampleNiftyFadeScale').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Pelanggan'); // Set Title to Bootstrap modal title
    }

  function savePelanggan()
    {
        // $('[name="nipy"]').removeAttr("disabled");
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url;

        url = "<?php echo site_url('penjualan/addPelanggan')?>";

        // ajax adding data to database

        var formData = new FormData($('#formpelanggan')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#exampleNiftyFadeScale').modal('hide');
                    // reload_table();
                    location.reload();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 

            }
        });
    }

    document.onkeydown = function (e) {
      switch (e.keyCode) {
          // f8:
          case 119:
              // setTimeout('self.location.href="logout.php"', 0);
              save()
              break;
      }
      //menghilangkan fungsi default tombol
      // e.preventDefault();
    };

  </script>


