<!-- Function -->
<?php 
$user_id = $this->session->userdata('id');

  if (empty($user_id)) {
        redirect(base_url(), 'refresh');
    }

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
    
    <title>Laporan Order</title>
    
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/base/assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/base/assets/images/favicon.ico">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/base/assets/css/site.min.css">
    
    <!-- Plugins -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/vendor/flag-icon-css/flag-icon.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/base/assets/examples/css/pages/invoice.css">
    
    
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

     <style type="text/css" media="print">
      @page { size: a4; portrait;}
      body {border: 0px ; padding: 16px;} 
      th {vertical-align: middle !important; text-align: center;border: 0px ;}
      td {border: 0px s}
    </style>

  </head>
  <body onload="window.print()">
    <!-- Page -->
    <div class="">
      <!-- <div class="page-header">
        <h1 class="page-title">Laporan Pengeluaran</h1>
      </div> -->

      <div class="">
        <!-- Panel -->
        <div class="panel">
          <div class="panel-body container-fluid">
            <div class="row">
              <div class="col-2">
                <h3>
                  <img class="mr-10" style="height: 100px" src="<?php echo base_url(); ?>assets/images/logo-kop.png"
                    alt="...">
                </h3>
              </div>
              <div class="col-10 text-center">
                <p>
                  <b>PT. SURYA PRANA SESAMA</b>
                </p>
                <address>
                  Jl.Merak Raya Blok H1 No.120,Cikarang Baru, Jababeka, Cikarang  
                  <br>
                  <abbr title="Mail">E-mail:</abbr>&nbsp;&nbsp;suryamoto.sps@gmail.com
                  <br>
                  <abbr title="Phone">Phone:</abbr>&nbsp;&nbsp;021- 8932 4604 / 0812 9575 663
                </address>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-6">
                
              </div>
              <div class="col-6 text-right">
                <!-- <p>
                  Periode :
                  <br><b><?php echo $data['nama']; ?></b>
                </p> -->
                <address>
                  <abbr title="Trans">Total Transaksi:</abbr>&nbsp;&nbsp;<?php echo $judulorder->totaltransaksi; ?>
                  <br>
                  <abbr title="Order">Total Order:</abbr>&nbsp;&nbsp;Rp. <?php echo formatRP($judulorder->totalpembelian); ?>
                  <br>
                </address>
                <!-- <span>January 20, 2017</span> -->
                <span>Periode: <?php echo date("d M Y",strtotime($start)); ?> - <?php echo date("d M Y",strtotime($end)); ?></span>
              </div>
            </div>

            <div class="page-invoice-table table-responsive">
              <table class="table table-hover text-left">
                <thead>
                  <tr>
                    <!-- <th>#</th> -->
                    <th style="background:  #ececec;">#</th>
                    <!-- <th style="background:  #ececec;">Bengkel</th> -->
                    <th style="background:  #ececec;">Tanggal</th>
                    <th style="background:  #ececec;">Total Order</th>
                    <th style="background:  #ececec;">Status Order</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i=1;
                  if (!is_null($order))
                    foreach ($order as $or) {
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td class=""><?php echo date('d F Y',strtotime($or -> tanggal_order)); ?></td>
                        <td class="">Rp. <?php echo formatRP($or -> total_pembelian); ?></td>
                        <td class="">
                          <?php
                            if ($or -> status_order == '3') {
                              echo '<span class="badge badge-lg badge-success">Selesai '.date("d F Y",strtotime($or -> tanggal_selesai)).'</span>';
                            }elseif ($or -> status_order == '2') {
                              echo '<span class="badge badge-lg badge-warning">Validasi '.date("d F Y",strtotime($or -> tanggal_valid)).'</span>';
                            }elseif ($or -> status_order == '1') {
                              echo '<span class="badge badge-lg badge-info">Diproses '.date("d F Y",strtotime($or -> tanggal_diproses)).'</span>';
                            }else {
                              echo '<span class="badge badge-lg badge-dark">Menunggu</span>';
                            } 
                          ?>                          
                        </td>
                    </tr> 
                  <?php  $i++; } ?>
                  <tr>
                    <td></td>
                    <td><b>Grand Total</b></td>
                    <td class="page-invoice-amount"><b>Rp. <?php  echo formatRP($judulorder->totalpembelian) ?></b></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="text-right">
              <button type="button" class="btn btn-animate btn-animate-side btn-default btn-outline d-print-none"
                onclick="javascript:window.print();">
                <span><i class="icon wb-print" aria-hidden="true"></i> Print</span>
              </button>
            </div>
          </div>
        </div>
        <!-- End Panel -->
      </div>
    </div>
    <!-- End Page -->

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
    <script>Config.set('assets', '<?php echo base_url(); ?>assets/base/assets/assets');</script>
    
    <!-- Page -->
    <script src="<?php echo base_url(); ?>assets/base/assets/js/Site.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/Plugin/asscrollable.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/Plugin/slidepanel.js"></script>
    <script src="<?php echo base_url(); ?>assets/global/js/Plugin/switchery.js"></script>
    
    <script>
      (function(document, window, $){
        'use strict';
    
        var Site = window.Site;
        $(document).ready(function(){
          Site.run();
        });
      })(document, window, jQuery);
    </script>
  </body>
</html>
